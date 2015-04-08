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
<<<<<<< HEAD
			<table class="large-12" id="sales"></table>
=======
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
>>>>>>> 009d2c22f225c0165c13b9312195f9568bdb5a99
		</div>
	</div>
	@endif
@endsection


@section('scripts')
	<script type="text/javascript">
<<<<<<< HEAD
	$(document).ready( function() {
		$('#dp1').pickadate({
			format: 'yyyy-mm-dd',
		});
		$.getJSON("{{ URL::to('/') }}/fetch/sales/{{ Input::get('date') }}", function(data) {
			$('#sales').dataTable({
				"aaData": data,
				"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
				"aaSorting": [[ 5, 'desc' ]],
				"oLanguage": {
					"sLengthMenu": "No. of Sales to display _MENU_",
					"oPaginate": {
					"sFirst": "First ", // This is the link to the first
					"sPrevious": "&#8592; Previous", // This is the link to the previous
					"sNext": "Next &#8594;", // This is the link to the next
					"sLast": "Last " // This is the link to the last
					}
				},
				//DISPLAYS THE VALUE
				//sTITLE - HEADER
				//MDATAPROP - TBODY
				"aoColumns":
				[
					{"sTitle": "#", "mDataProp": "id", "sClass": "size-14"},
					{"sTitle": "Campaign", "mDataProp": "campaign", "sClass": "size-14"},
					{"sTitle": "Agent", "mDataProp": "user", "sClass": "size-14"},
					{"sTitle": "BTN", "mDataProp": "phone_number", "sClass": "size-14"},
					{"sTitle": "Disposition", "mDataProp": "status", "sClass": "size-14"},
					{"sTitle": "Call Date/Time", "mDataProp": "cdt", "sClass": "size-14"}

				],
				"aoColumnDefs":
				[
					//FORMAT THE VALUES THAT IS DISPLAYED ON mDataProp
					//ID
					{ "bSortable": false, "aTargets": [ 0 ] },
					{
						"aTargets": [ 0 ], // Column to target
						"mRender": function ( data, type, full ) {
						// 'full' is the row's data object, and 'data' is this column's data
						// e.g. 'full[0]' is the comic id, and 'data' is the comic title

						return '<label class="text-center size-14">' + data + '</label>';
						}
					},
					//CATEGORY NAME
					{
						"aTargets": [ 1 ], // Column to target
						"mRender": function ( data, type, full ) {
							// 'full' is the row's data object, and 'data' is this column's data
							// e.g. 'full[0]' is the comic id, and 'data' is the comic title
							return '<label>' + full['campaign'] + "</label>";
						}
					},
					//DEVICE NAME
					{
						"aTargets": [ 2 ], // Column to target
						"mRender": function ( data, type, full ) {
							// 'full' is the row's data object, and 'data' is this column's data
							// e.g. 'full[0]' is the comic id, and 'data' is the comic title
							return '<label>' + full["user"] + '</label>';
						}
					},
					//AVAILABILITY
					{
						"aTargets": [ 3 ], // Column to target
						"mRender": function ( data, type, full ) {
							// 'full' is the row's data object, and 'data' is this column's data
							// e.g. 'full[0]' is the comic id, and 'data' is the comic title
							return '<label>' + full["phone_number"] + '</label>';
						}
					},
					//UPDATED AT
					{
						"aTargets": [ 4 ], // Column to target
						"mRender": function ( data, type, full ) {
						// 'full' is the row's data object, and 'data' is this column's data
						// e.g. 'full[0]' is the comic id, and 'data' is the comic title
						return '<label>' + full["status"] + '</label>';
						}
					},
					{
						"aTargets": [ 5 ], // Column to target
						"mRender": function ( data, type, full ) {
						// 'full' is the row's data object, and 'data' is this column's data
						// e.g. 'full[0]' is the comic id, and 'data' is the comic title
						return '<label >' + full["cdt"] + '</label>';
						}
					}
				],

				"fnDrawCallback": function( oSettings ) {
					/* Need to redo the counters if filtered or sorted */
					if ( oSettings.bSorted || oSettings.bFiltered )
					{
						for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
						{
							$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( "<label>" + (i+1) + "</label>" );
						}
					}
				}
			});
			$('div.dataTables_filter input').attr('placeholder', 'Filter Sales');
		});
	});
=======
		$('#dp1').pickadate({
			format: 'yyyy-mm-dd',
		});
>>>>>>> 009d2c22f225c0165c13b9312195f9568bdb5a99
	</script>
@endsection