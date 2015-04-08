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


	/*Route::post('submit-all', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('submitted', '=', 'N')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();

		foreach($sales as $sale) {
			$sale->submit();
		}

		return Redirect::to('unsubmitted-sales');
	});*/


	/*Route::post('resubmit-all', function()
	{
		//get all unsubmitted sales
		$sales = Lead::where('success', '=', 'N')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();

		foreach($sales as $sale) {
			$sale->submit();
		}

		return Redirect::to('unsubmitted-sales');
	});*/

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

	Route::get('summary', 'ReportController@getSummary');




    #JSONS
	Route::get('fetch/unsubmitted-sales', function() {
		$json = array();

		//get all unsubmitted sales
		$sales = Lead::where('submitted', '=', 'N')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();

		foreach ($sales as $sale) {
			$json[] = array(
				"id"    =>  $sale->id,
				"name"  =>  $sale->getName() . "(".$sale->workphone.")",
				"dispo" =>  $sale->vici_status,
				"workphone" =>  $sale->workphone,
				"state" =>  $sale->state,
				"sale_date" => date('M j, Y', strtotime($sale->vici_sale_date)),
				"entry_date" => date('M j, Y', strtotime($sale->created_at)),
			);
		}
		return json_encode($json);
	});

	//Summary List
	Route::get('fetch/sales/{date}', function( $date ) {
		$json = array();
		$ctr = 0;
		if($date) {
			$summary = Report::getSummary(date('Y-m-d', strtotime($date)));

			$list = Report::getList(date('Y-m-d', strtotime($date)));

			foreach ( $list as $sale ) {

				$json[] = array(
					'id'			=>	++$ctr,
					'campaign'		=>	$sale->campaign_id,
					'user'			=>	$sale->user,
					'phone_number' 	=>	$sale->phone_number,
					'status'		=>	$sale->status,
					'cdt'			=>	$sale->call_date,
				);
			}
			
		}
		return json_encode($json);
	});


	//Unsuccessful
	Route::get('fetch/unsuccessful-sales', function() {
		//get all unsubmitted sales
		$json = array();
		$sales = Lead::where('success', '=', 'N')->where('submitted', '=', 'Y')->where('cancel', '=', 'N')->orderBy('vici_sale_date', 'DESC')->get();
		
		foreach ($sales as $sale) {
			$json[] = array(
				'id'	=>	$sale->id,
				'name'	=>	$sale->getName() . "(".$sale->workphone.")",
				'dispo'	=>	$sale->vici_status,
				'state'	=>	$sale->state,
				'sub_status'	=> $sale->status,
				'last_submit'	=> date('M j, Y', strtotime($sale->submit_date)),

			);
		}

		return json_encode($json);
	});


	//Successful
	Route::get('fetch/successful-sales', function(){
		//get all unsubmitted sales
		$json = array();
		$sales = Lead::where('success', '=', 'Y')->orderBy('vici_sale_date', 'DESC')->get();
		
		foreach ($sales as $sale) {
			$json[] = array(
				'id'	=>	$sale->id,
				'user'	=>	$sale->getName() . "(".$sale->workphone.")",
				'dispo'	=>	$sale->vici_status,
				'sale_date'	=>	date('M j, Y', strtotime($sale->vici_sale_date)),
				'su_date'	=>	date('M j, Y', strtotime($sale->success_date)),
			);
		}
		return json_encode($json);
	});


	//Cancelled
	Route::get('fetch/cancelled-sales', function() {
		$json = array();

		//get all unsubmitted sales
		$sales = Lead::where('cancel', '=', 'Y')->orderBy('vici_sale_date', 'DESC')->get();

		foreach ($sales as $sale) {
			$json[] = array(
				"id"    =>  $sale->id,
				"name"  =>  $sale->getName() . "(".$sale->workphone.")",
				"dispo" =>  $sale->vici_status,
				"workphone" =>  $sale->workphone,
				"state" =>  $sale->state,
				"sale_date" => date('M j, Y', strtotime($sale->vici_sale_date)),
				"entry_date" => date('M j, Y', strtotime($sale->created_at)),
			);
		}
		return json_encode($json);
	});
});