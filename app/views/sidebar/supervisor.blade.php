<?php 
	$summary = Lead::summary();
?>

<div class="row collapse">
<div class="large-12 columns">
	<ul class="side-nav">
		<li class="heading">{{ HTML::link("/", "Fetch Sales") }}</li>
		<li class="heading">{{ HTML::link("lead/add", "Add Lead") }}</li>
		<li class="heading">{{ HTML::link("reports", "Reports") }}</li>
		<li class="heading">{{ HTML::link("summary", "Summary") }}</li>
		<li class="divider"></li>
		<li class="heading">Lead Summary</li>
		<li>{{ HTML::link("unsubmitted-sales", " - Unsubmitted (" . $summary['unsubmitted'] . ")") }}</li>
		<li>{{ HTML::link("unsuccessful-sales", " - Unsuccessful (" . $summary['unsuccessful'] . ")") }}</li>
		<li>{{ HTML::link("successful-sales", " - Successful (" . $summary['successful'] . ")") }}</li>
		<li>{{ HTML::link("cancel-sales", " - Cancelled (" . $summary['cancel'] . ")") }}</li>
	</ul>
</div>
</div>
