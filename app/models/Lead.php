<?php 

class Lead extends Eloquent {

	 protected static $unguarded = true;

	/**
	 *	Fetch sale leads from vici
	 *
	*/
	public static function fetch($date) {
		//query to vicidial_list table
		//$queryString = "SELECT lead_id, list_id, last_local_call_time, state, status FROM vicidial_list WHERE list_id IN (1809, 1810, 1816, 1811, 1817) AND status IN ('SALEAP','SILO') AND date(last_local_call_time) = '$date'";
		$queryString = "
			SELECT a.lead_id, a.list_id, a.last_local_call_time, a.state, a.status 
			FROM vicidial_list a INNER JOIN vicidial_lists b on a.list_id = b.list_id
			WHERE a.status IN ('SALEAP','SILO') AND b.campaign_id like 'USHA_%' AND date(last_local_call_time) = '$date'
		";

		$sales = DB::connection('mysql_vici')->select($queryString);

		/*$sales = DB::connection('mysql_vici')->select("SELECT lead_id, list_id, last_local_call_time FROM vicidial_list WHERE list_id IN (1809, 1810, 1816, 1811) LIMIT 4");*/

		return $sales;
	}


	public static function tryCreate($data) {

		//validate
		$rules = array(
			'state' => 'required',
			'workphone' => 'required',
			'firstName' => 'required',
			'lastName' => 'required',
			'vici_status' => 'required'
		);

		$validation =  Validator::make($data,$rules);

		if($validation->fails()) {
			$failed = $validation->failed();
			return Redirect::to('lead/add')->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			unset($data['_token']);
			$data['user_id'] = Auth::user()->id;
			$lead = Lead::create($data);

			if($lead) {
				return Redirect::to('lead/' . $lead->id);
			}
		}
	}


	public static function sync($viciInfo) {
		$lead = false;
		$data = Lead::data($viciInfo->lead_id, $viciInfo->list_id);

		//check if lead_id already in the database
		$exist = parent::where('vici_lead_id', '=', $data->lead_id)->first();

		if(!$exist) {
			//insert in local database
			$info = array(
					'vici_lead_id' => $viciInfo->lead_id,
					'vici_list_id' => $viciInfo->list_id,
					'vici_sale_date' => $viciInfo->last_local_call_time,
					'vici_state' => $viciInfo->state,
					'vici_status' => $viciInfo->status,
					'user_id' => Auth::user()->id,
					'firstName' => $data->First_Name_2,
					'lastName' => $data->Last_Name_2,
					'address1' => $data->Mailing_Address,
					'address2' => '',
					'city' => $data->City_2,
					'county' => $data->County_2,
					'state' => $data->State_2,
					'zip' => $data->Zip2,
					'email' => $data->Lead_EmailAddress,
					'homephone' => $data->HomePhone,
					'workphone' => $data->WorkPhone,
					'preferredcontacttime' => $data->Q3,
					'birthdate' => '',
					'tobaccouser' => $data->Smoking,
					'pregnant' => 'NA',
					'majorhealthproblems' => 'NA',
					'currentcarrier' => $data->Current_Provider,
					'comments' => $data->Other_Notes,
				);

			if($viciInfo->state == 'TX') {
				//$info['AgentNumber'] = '4B9BAFCD-4D2A-455E-B813-077DE883FD6D';
				$info['AgentNumber'] = '0a673d32-f7ac-470a-92bd-7985d35c02d0'; //TX Market Rebecca Romo
			} else {
				$info['AgentNumber'] = 'b8e36e57-553a-4d2d-8eff-d6c491de967c'; //GA and TN Market Andy Montague
			}

			$lead = parent::create($info);
		}

		if($lead) {
			return true;
		} else {
			return false;
		}

	}


	public static function data($id, $list) {
		//query
		$queryString = "SELECT * FROM custom_".$list." WHERE lead_id = ".$id." LIMIT 1";

		$lead = DB::connection('mysql_vici')->select($queryString);

		return $lead[0];
	}


	public function submit() {
		$url = $this->generateURL();
		
		/*$out = "POST /ssl/ws/wsImportLeads/v1.0/Leads.asmx/wsInsertLeadByAgentComments HTTP/1.1\r\n";
	    $out.= "Host: www.ushealthgroup.com\r\n";
	    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
	    $out.= "Content-Length: ".strlen($url)."\r\n";
	    $out.= "Connection: Close\r\n\r\n";
	    $out.= $url;

	   	echo '<pre>';
		print_r($out);
		echo '</pre>';*/
		$fp = fsockopen("www.ushealthgroup.com", 80, $errno, $errstr, 30);

	    $out = "POST /ssl/ws/wsImportLeads/v1.0/Leads.asmx/wsInsertLeadByAgentComments HTTP/1.1\r\n";
	    $out.= "Host: www.ushealthgroup.com\r\n";
	    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
	    $out.= "Content-Length: ".strlen($url)."\r\n";
	    $out.= "Connection: Close\r\n\r\n";
	    $out.= $url;

	    fwrite($fp, $out);
	    $contents = "";
		//Waits for the web server to send the full response. On every line returned we append it onto the $contents 
		//variable which will store the whole returned request once completed.
		while (!feof($fp)) {
			$contents .= fgets($fp, 4096);
		}
		//Close are request or the connection will stay open untill are script has completed.
		fclose($fp);

		//get response code
		preg_match("/([a-zA-Z_]+)\<\/string\>/", $contents, $matches);
		$code = $matches[1];

		//insert new record in Link table
		$link = Link::create(array(
			'user_id' => Auth::user()->id,
			'lead_id' => $this->vici_lead_id,
			'url' => $url,
			'status' => $code,
			'response' => $contents
		));

		//update lead table entry
		$this->submitted = 'Y';
		$this->cancel = 'N';
		$this->submit_date = date('Y-m-d H:i:s');
		$this->success = $code=='NO_ERROR'?'Y':'N';
		$this->success_date = $code=='NO_ERROR'?date('Y-m-d H:i:s'):NULL;
		$this->status = $code;
		$this->save();
		
		/*if($result = file_get_contents($url)) {
			//insert new record in Link table
			$link = Link::create(array(
				'lead_id' => $this->vici_lead_id,
				'url' => $url,

			));
		} else {

		}*/
	}

	private function generateURL() {
		$url = "http://www.ushealthgroup.com/ssl/ws/wsImportLeads/v1.0/Leads.asmx/wsInsertLeadByAgentComments?";
		$param = array(
			'currentcarrier='.$this->currentcarrier,
			'firstName='.$this->firstName,
			'lastName='.$this->lastName,
			'address1='.$this->address1,
			'address2='.$this->address2,
			'city='.$this->city,
			'county='.$this->county,
			'state='.$this->state,
			'zip='.$this->zip,
			'email='.$this->email,
			'homephone='.$this->workphone,
			'workphone='.$this->homephone,
			'preferredcontacttime='.$this->preferredcontacttime,
			'birthdate='.$this->birthdate,
			'tobaccouser='.$this->tobaccouser,
			'pregnant='.$this->pregnant,
			'majorhealthproblems='.$this->majorhealthproblems,
			'comments='.urlencode($this->comments),
			'AgentNumber='.$this->AgentNumber,
			'Password='.$this->Password,
			'Vendor='.$this->Vendor
		);
		$param = implode("&", $param);

		$url .= $param;

		return $param;
	}


	public static function tryUpdate($id, $input) {
		unset($input['_token']);
		$lead = Lead::where('id', '=', $id)->update($input);

		return $lead;
	}

	public static function summary() {
		$stats = array();

		//get unsubmitted count
		$unsubmitted = Lead::where('submitted', '=', 'N')->where('cancel', '=', 'N')->count();
		$stats['unsubmitted'] = $unsubmitted;

		//get unsuccessful count
		$unsuccessful = Lead::where('submitted', '=', 'Y')->where('success', '=', 'N')->where('cancel', '=', 'N')->count();
		$stats['unsuccessful'] = $unsuccessful;

		//get successful count
		$successful = Lead::where('submitted', '=', 'Y')->where('success', '=', 'Y')->where('cancel', '=', 'N')->count();
		$stats['successful'] = $successful;

		//get calcelled count
		$cancel = Lead::where('cancel', '=', 'Y')->count();
		$stats['cancel'] = $cancel;

		return $stats;

	}

	public function getName() {
		return $this->lastName . ', ' . $this->firstName;
	}
}