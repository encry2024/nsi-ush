@extends('layouts.default')

@section('title')
	Unsubmitted Sales
@endsection


@section('content')
	@if(count($sales) > 0)
	{{ Form::open(array('url' => 'submit-all', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-12 columns">
				<div class="row collapse">
					<div class="large-2 columns end">
						{{ Form::submit('SUBMIT ALL', array('class' => 'button small')) }}
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	{{ Form::token(); }}
	{{ Form::close(); }}
	<div class="row">
		<div class="large-12 columns">
			<table class="large-12">
				<thead>
					<tr>
						<th class="large-1">#</th>
						<th>Lead ID</th>
						<th class="large-2">Disposition</th>
						<th class="large-2">Name</th>
						<th class="large-2">Sale Date</th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr = 0;?>
					@foreach($sales as $sale)
					<tr>
						<td>{{ ++$ctr }}</td>
						<td><a href="{{ URL::to('lead/'.$sale->id); }}">{{ $sale->vici_lead_id }}</a></td>
						<td>{{ $sale->vici_status }}</td>
						<td>{{ $sale->getName() }}</td>
						<td>{{ date('M j, Y', strtotime($sale->vici_sale_date)) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
@endsection