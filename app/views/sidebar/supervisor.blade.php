<?php 
	$summary = Lead::summary();
?>

<div class="row collapse">
<div class="large-12 columns">
	<ul class="side-nav">
		<li>{{ HTML::link("/", "Fetch Sales") }}</li>
		<li>{{ HTML::link("unsubmitted-sales", "Unsubmitted (" . $summary['unsubmitted'] . ")") }}</li>
		<li>{{ HTML::link("unsuccessful-sales", "Unsuccessful (" . $summary['unsuccessful'] . ")") }}</li>
		<li>{{ HTML::link("successful-sales", "Successful (" . $summary['successful'] . ")") }}</li>
		<li>{{ HTML::link("cancel-sales", "Cancelled (" . $summary['cancel'] . ")") }}</li>
		<li>{{ HTML::link("reports", "Reports") }}</li>
	</ul>
</div>
</div>
