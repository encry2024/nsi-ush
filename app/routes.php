<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', function()
{
	return View::make('login');
});

Route::post('login', 'UserController@authenticate');
Route::any('logout', function()
{
	Auth::logout();

	return Redirect::to('login');
});

Route::group(array('before' => 'auth'), function() {

	Route::get('/', function()
	{
		return View::make('index');
	});


	Route::post('sync', function()
	{
		$sync_count = 0;
		$leads = Lead::fetch(Input::get('date'));

		foreach($leads as $lead) {
			$sale = Lead::sync($lead);

			$sale?$sync_count++:$sync_count;
		}

		return Redirect::to('unsubmitted-sales')
			->with('result', array(
					'count' => $sync_count
				));	
	});

	Route::get('unsubmitted-sales', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('submitted', '=', 'N')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();
		return View::make('sale_submission')
			->with('sales', $sales);
	});


	Route::get('unsuccessful-sales', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('success', '=', 'N')->where('submitted', '=', 'Y')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();
		return View::make('sale_unsuccess')
			->with('sales', $sales);
	});


	Route::get('successful-sales', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('success', '=', 'Y')->orderBy('vici_sale_date', 'DESC')->get();
		return View::make('sale_success')
			->with('sales', $sales);
	});


	Route::get('cancel-sales', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('cancel', '=', 'Y')->orderBy('vici_sale_date', 'DESC')->get();
		return View::make('sale_cancel')
			->with('sales', $sales);
	});


	Route::post('submit-all', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('submitted', '=', 'N')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();

		foreach($sales as $sale) {
			$sale->submit();
		}

		return Redirect::to('unsubmitted-sales');
	});


	Route::post('resubmit-all', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('success', '=', 'N')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();

		foreach($sales as $sale) {
			$sale->submit();
		}

		return Redirect::to('unsubmitted-sales');
	});

	//Lead routes
	Route::get('lead/add', 'LeadController@add');
	Route::post('lead/add', 'LeadController@create');
	Route::get('lead/{id}', 'LeadController@view');
	Route::get('lead/{id}/edit', 'LeadController@edit');
	Route::post('lead/{id}/edit', 'LeadController@update');
	Route::get('lead/{id}/submit', 'LeadController@submit');
	Route::get('lead/{id}/enable', 'LeadController@enableLead');
	Route::get('lead/{id}/cancel', 'LeadController@cancelLead');
	Route::get('lead/{id}/removelead', 'LeadController@removeLead');
	

	//Report routes
	Route::get('reports', 'ReportController@index');
	Route::post('reports', 'ReportController@getReport');

});