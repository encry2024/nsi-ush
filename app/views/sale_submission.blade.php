@extends('layouts.default')

@section('title')
	Unsubmitted Sales
@endsection


@section('content')
	@if(count($sales) > 0)
	<div class="row">
		<div class="large-12 columns">
			<table class="large-12" id="submission"></table>
		</div>
	</div>
	@endif
@endsection

@section('scripts')
<script>
$(document).ready( function() {
	//DATE FORMATTER
	jQuery.fn.dataTableExt.oSort['custom_euro_date-asc'] = function(x, y) {
	    var xVal = getCustomEuroDateValue(x);
	    var yVal = getCustomEuroDateValue(y);
	 
	    if (xVal < yVal) {
	        return -1;
	    } else if (xVal > yVal) {
	        return 1;
	    } else {
	        return 0;
	    }
	}
	 
	jQuery.fn.dataTableExt.oSort['custom_euro_date-desc'] = function(x, y) {
	    var xVal = getCustomEuroDateValue(x);
	    var yVal = getCustomEuroDateValue(y);
	 
	    if (xVal < yVal) {
	        return 1;
	    } else if (xVal > yVal) {
	        return -1;
	    } else {
	        return 0;
	    }
	}
	 
	function getCustomEuroDateValue(strDate) {
	    var frDatea = $.trim(strDate).split(' ');
	    var frDatea2 = frDatea[0].split('/');
	     
	    var x = Date.parse(frDatea2[2] + frDatea2[1] + frDatea2[0]);
	    x = x * 1;
	 
	    return x;
	}

	$.getJSON("{{ URL::to('/') }}/fetch/unsubmitted-sales",function(data) {
		$('#submission').dataTable({
			"aaData": data,
			"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
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
				{},
				{},
				{},
				{ "sType":"custom_euro_date" },
				{ "sType":"custom_euro_date" },
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
					return '<label><input type="hidden" value="<label>' +full['dte_1'] + '</label>">' + full["sale_date"] + '</label>';
					}
				},
				{
					"aTargets": [ 5 ], // Column to target
					"mRender": function ( data, type, full ) {
					// 'full' is the row's data object, and 'data' is this column's data
					// e.g. 'full[0]' is the comic id, and 'data' is the comic title
					return '<label><input type="hidden" value="<label>' +full['dte_2'] + '</label>">' + full["entry_date"] + '</label>';
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
	$('div.dataTables_filter input').attr('placeholder', 'State/Sale Date');
	});
});
</script>
@endsection