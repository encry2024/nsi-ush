<?php 

class Report extends Eloquent {

	public static function getSummary($date) {
		//query summary
		$summary = DB::connection('mysql_vici')->select("call getUSHASalesSummaryPerCampaign('$date')");

		return $summary;
	}

	public static function getList($date) {
		//query summary
		$list = DB::connection('mysql_vici')->select("call getUSHASales('$date')");

<<<<<<< HEAD

=======
>>>>>>> 009d2c22f225c0165c13b9312195f9568bdb5a99
		return $list;
	}
}
