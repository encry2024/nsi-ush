@extends('layouts.default')

@section('title')
	Sales Summary in Vici
@endsection


@section('content')
	{{ Form::open(array('url' => 'summary', 'method' => 'get', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Sale Date(EST)</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Date:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('date', '', array('data-value' => Input::get('date'), 'placeholder' => 'Enter sale date', 'id' => 'dp1')) }}
					</div>
				</div>
				<div class="row collapse">
					<div class="large-2 columns end">
						{{ Form::submit('SUBMIT', array('class' => 'button small')) }}
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	{{ Form::token(); }}
	{{ Form::close(); }}
	@if(count($summary) > 0)
	<h6>Summary Per Campaign</h6>
	<div class="row">
		<div class="large-8 columns">
			<table class="large-12">
				<thead>
					<tr>
						<th class="large-2">Campaign</th>
						<th class="large-2">Total Sale</th>
					</tr>
				</thead>
				<tbody>
					@foreach($summary as $info)
					<tr>
						<td>{{ $info->campaign_id }}</td>
						<td>{{ $info->total }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif

	@if(count($list) > 0)
	<h6>Sales</h6>
	<div class="row">
		<div class="large-12 columns">
			<table class="large-12">
				<thead>
					<tr>
						<th class="large-1">#</th>
						<th class="large-2">Campaign</th>
						<th class="large-2">Agent</th>
						<th class="large-2">BTN</th>
						<th class="large-2">Disposition</th>
						<th class="large-2">Call Date/Time</th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr = 0;?>
					@foreach($list as $sale)
					<tr>
						<td>{{ ++$ctr }}</td>
						<td>{{ $sale->campaign_id }}</td>
						<td>{{ $sale->user }}</td>
						<td>{{ $sale->phone_number }}</td>
						<td>{{ $sale->status }}</td>
						<td>{{ $sale->call_date }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
@endsection


@section('scripts')
	<script type="text/javascript">
		$('#dp1').pickadate({
			format: 'yyyy-mm-dd',
		});
	</script>
@endsection