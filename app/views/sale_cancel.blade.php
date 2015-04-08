@extends('layouts.default')

@section('title')
	Cancelled Sales
@endsection


@section('content')
	@if(count($sales) > 0)
	<div class="row">
		<div class="large-12 columns">
<<<<<<< HEAD
			<table class="large-12" id="cancel"></table>
		</div>
	</div>
	@endif
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready( function() {
	$.getJSON("{{ URL::to('/') }}/fetch/cancelled-sales",function(data) {
		$('#cancel').dataTable({
			"aaData": data,
			"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
			"aaSorting": [[ 4, 'desc' ]],
			"oLanguage": {
				"sLengthMenu": "No. of Unsubmitted Sales to display _MENU_",
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
				{"sTitle": "Name", "mDataProp": "name", "sClass": "size-14"},
				{"sTitle": "Disposition", "mDataProp": "dispo", "sClass": "size-14"},
				{"sTitle": "State", "mDataProp": "status", "sClass": "size-14"},
				{"sTitle": "Sale Date(EST)", "mDataProp": "sale_date", "sClass": "size-14"},
				{"sTitle": "Entry Date", "mDataProp": "entry_date", "sClass": "size-14"}

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
						return '<a href="{{ URL::to('/') }}/lead/' + full['id'] + '">' + full['name'] + "</a>";
					}
				},
				//DEVICE NAME
				{
					"aTargets": [ 2 ], // Column to target
					"mRender": function ( data, type, full ) {
						// 'full' is the row's data object, and 'data' is this column's data
						// e.g. 'full[0]' is the comic id, and 'data' is the comic title
						return '<label>' + full["dispo"] + '</label>';
					}
				},
				//AVAILABILITY
				{
					"aTargets": [ 3 ], // Column to target
					"mRender": function ( data, type, full ) {
						// 'full' is the row's data object, and 'data' is this column's data
						// e.g. 'full[0]' is the comic id, and 'data' is the comic title
						return '<label>' + full["state"] + '</label>';
					}
				},
				//UPDATED AT
				{
					"aTargets": [ 4 ], // Column to target
					"mRender": function ( data, type, full ) {
					// 'full' is the row's data object, and 'data' is this column's data
					// e.g. 'full[0]' is the comic id, and 'data' is the comic title
					return '<label>' + full["sale_date"] + '</label>';
					}
				},
				{
					"aTargets": [ 5 ], // Column to target
					"mRender": function ( data, type, full ) {
					// 'full' is the row's data object, and 'data' is this column's data
					// e.g. 'full[0]' is the comic id, and 'data' is the comic title
					return '<label >' + full["entry_date"] + '</label>';
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
	$('div.dataTables_filter input').attr('placeholder', 'Enter Filter');
	});
});
</script>
=======
			<table class="large-12">
				<thead>
					<tr>
						<th class="large-1">#</th>
						<th class="large-2">Name</th>
						<th class="large-2">Disposition</th>
						<th class="large-2">State</th>
						<th class="large-2">Sale Date(EST)</th>
						<th class="large-2">Entry Date</th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr = 0;?>
					@foreach($sales as $sale)
					<tr>
						<td>{{ ++$ctr }}</td>
						<td><a href="{{ URL::to('lead/'.$sale->id); }}">{{ $sale->getName() }} ({{ $sale->workphone }})</a></td>
						<td>{{ $sale->vici_status }}</td>
						<td>{{ $sale->state }}</td>
						<td>{{ date('M j, Y', strtotime($sale->vici_sale_date)) }}</td>
						<td>{{ date('M j, Y', strtotime($sale->created_at)) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
>>>>>>> 009d2c22f225c0165c13b9312195f9568bdb5a99
@endsection