<?php

class LeadController extends BaseController {

	public function view($id)
	{
		$lead = Lead::find($id);
		return View::make('lead.view')
			->with('lead', $lead);
	}


	public function edit($id)
	{
		$lead = Lead::find($id);
		return View::make('lead.edit')
			->with('lead', $lead);
	}


	public function update($id)
	{
		$lead = Lead::tryUpdate($id, Input::all());
		return Redirect::to('lead/'.$id)
			->with('lead', $lead);
	}


	public function submit($id)
	{
		$lead = Lead::find($id);
		$lead->submit();

		return Redirect::to('lead/'.$id)
			->with('lead', $lead);
	}


	public function removeLead($id)
	{
		$lead = Lead::find($id);
		$lead->delete();
		
		return Redirect::to('unsubmitted-sales');
	}


	public function cancelLead($id)
	{
		$lead = Lead::find($id);
		$lead->cancel = 'Y';
		$lead->save();
		
		return Redirect::back();
	}

	public function enableLead($id)
	{
		$lead = Lead::find($id);
		$lead->cancel = 'N';
		$lead->save();
		
		return Redirect::back();
	}

}
