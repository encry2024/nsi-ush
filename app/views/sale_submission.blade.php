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
						<th class="large-2">Name</th>
						<th class="large-2">Work Phone</th>
						<th class="large-2">State</th>
						<th class="large-2">Entry Date</th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr = 0;?>
					@foreach($sales as $sale)
					<tr>
						<td>{{ ++$ctr }}</td>
						<td><a href="{{ URL::to('lead/'.$sale->id); }}">{{ $sale->getName() }}</a></td>
						<td>{{ $sale->workphone }}</td>
						<td>{{ $sale->state }}</td>
						<td>{{ date('M j, Y', strtotime($sale->created_at)) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
@endsection