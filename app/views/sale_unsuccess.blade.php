@extends('layouts.default')

@section('title')
	Unsuccessful Sales
@endsection


@section('content')
	@if(count($sales) > 0)
	<div class="row">
		<div class="large-12 columns">
			<table class="large-12">
				<thead>
					<tr>
						<th class="large-1">#</th>
						<th class="large-2">Name</th>
						<th class="large-2">Work Phone</th>
						<th class="large-2">State</th>
						<th class="large-2">Submit Status</th>
						<th class="large-2">Last Submit Date</th>
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
						<td>{{ $sale->status }}</td>
						<td>{{ date('M j, Y', strtotime($sale->submit_date)) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
@endsection