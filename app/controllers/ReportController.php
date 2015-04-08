<?php

class ReportController extends BaseController {

	/**
	 * Show report page
	 * @return View
	 */
	public function index() {
		return View::make('report.index');
	}


	/**
	 * Generate reports data
	 * @return void
	 */
	public function getReport() {
		header( 'Content-Type: text/csv' );
        header( 'Content-Disposition: attachment;filename=USHA Lead Export File '.time().'.csv');
		$outstream = fopen("php://output", 'w');
		fputcsv($outstream, Schema::getColumnListing('leads')); //generate headers
		if(Input::get('date')) {
			$leads = Lead::whereRaw("date(vici_sale_date) = ?", array(Input::get('date')))->get();
		} else {
			$leads = Lead::all();
		}
	    foreach ($leads as $row) {
	        fputcsv($outstream, $row->toArray());
	    }
	    fclose($outstream);
	    //return Redirect::to('consolidated');
	}


	/**
	 * Generate sale summary and sales list in vici
	 * @return void
	 */
	public function getSummary() {
		$summary = NULL;
		$list = NULL;

		$json = array();

		if(Input::get('date')) {
			$summary = Report::getSummary(date('Y-m-d', strtotime(Input::get('date'))));

			$list = Report::getList(date('Y-m-d', strtotime(Input::get('date'))));
		}



		return View::make('report.summary')
			->with('summary', $summary)
			->with('list', $list);
	}

}	