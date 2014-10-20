@extends('layouts.default')

@section('title')
	<div class="row">
		<div class="large-12 columns" data-section>
			Lead #{{ $lead->vici_lead_id }}
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns" data-section>
			<h5>Status: {{ $lead->status }}</h5>
		</div>
	</div>
	
@endsection

@section('menu')
	@if($lead->success == 'N')
	<div class="row">
		<div class="large-6 large-offset-6 columns">
			<a href="{{ URL::to('lead/'.$lead->id.'/edit'); }}" data-tooltip class="has-tip tip-right" title="Edit lead"><i class="general foundicon-edit"></i></a> - 
			@if($lead->cancel == 'N')
			<a href="{{ URL::to('lead/'.$lead->id.'/submit'); }}" data-tooltip class="has-tip tip-right" title="Submit this lead"><i class="general foundicon-refresh"></i></a> - 
			<a href="{{ URL::to('lead/'.$lead->id.'/cancel'); }}" data-tooltip class="has-tip tip-right" title="Cancel this lead"><i class="general foundicon-trash"></i></a>
			@else
			<a href="{{ URL::to('lead/'.$lead->id.'/enable'); }}" data-tooltip class="has-tip tip-right" title="Enable this lead"><i class="general foundicon-checkmark"></i></a>
			@endif
		</div>
	</div>
	@endif
@endsection

@section('content')
<div class="row">
	<div class="section-container auto large-12" data-section>
		<section>
			<div class="content" data-slug="section2">
				<table class="large-8">
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Vici Disposition:</h6></td><td class="large-8">{{ $lead->vici_status }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">First Name:</h6></td><td class="large-8">{{ $lead->firstName }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Last Name:</h6></td><td class="large-8">{{ $lead->lastName }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Address 1:</h6></td><td class="large-8">{{ $lead->address1 }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Address 2:</h6></td><td class="large-8">{{ $lead->address2 }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">City:</h6></td><td class="large-8">{{ $lead->city }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">County:</h6></td><td class="large-8">{{ $lead->county }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">State:</h6></td><td class="large-8">{{ $lead->state }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Zip:</h6></td><td class="large-8">{{ $lead->zip }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Email:</h6></td><td class="large-8">{{ $lead->email }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Home Phone:</h6></td><td class="large-8">{{ $lead->homephone }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Work Phone:</h6></td><td class="large-8">{{ $lead->workphone }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Pref. Time:</h6></td><td class="large-8">{{ $lead->preferredcontacttime }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Birthdate:</h6></td><td class="large-8">{{ $lead->birthdate }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Smoke:</h6></td><td class="large-8">{{ $lead->tobaccouser }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Pregnant:</h6></td><td class="large-8">{{ $lead->pregnant }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Health Prob.:</h6></td><td class="large-8">{{ $lead->majorhealthproblems }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Current Carrier:</h6></td><td class="large-8">{{ $lead->currentcarrier }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Comments:</h6></td><td class="large-8">{{ $lead->comments }}</td>
					</tr>
				</table>
			</div>
		</section>
	</div>
</div>
@endsection


@section('scripts')
@endsection