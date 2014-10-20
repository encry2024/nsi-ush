@extends('layouts.default')

@section('title')
	Lead #{{ $lead->vici_lead_id }} Update
@endsection

@section('menu')
	<div class="row">
		<div class="large-2 large-offset-10 columns"><a href="{{ URL::to('lead/'.$lead->id); }}" data-tooltip class="has-tip tip-right" title="Back"><i class="general foundicon-left-arrow"></i></a></div>
	</div>
@endsection

@section('content')
<div class="row">
	<div class="section-container auto large-12" data-section>
		{{ Form::open(array('method' => 'post', 'class' => 'custom')) }}
		<section>
			<div class="content" data-slug="section2">
				<table class="large-8">
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Vici Disposition:</h6></td><td class="large-8">{{ $lead->vici_status }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">First Name:</h6></td><td class="large-8">{{ Form::text('firstName', $lead->firstName) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Last Name:</h6></td><td class="large-8">{{ Form::text('lastName', $lead->lastName) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Address 1:</h6></td><td class="large-8">{{ Form::text('address1', $lead->address1) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Address 2:</h6></td><td class="large-8">{{ Form::text('address2', $lead->address2) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">City:</h6></td><td class="large-8">{{ Form::text('city', $lead->city) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">County:</h6></td><td class="large-8">{{ Form::text('county', $lead->county) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">State:</h6></td><td class="large-8">{{ Form::text('state', $lead->state) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Zip:</h6></td><td class="large-8">{{ Form::text('zip', $lead->zip) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Email:</h6></td><td class="large-8">{{ Form::text('email', $lead->email) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Home Phone:</h6></td><td class="large-8">{{ Form::text('homephone', $lead->homephone) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Work Phone:</h6></td><td class="large-8">{{ Form::text('workphone', $lead->workphone) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Pref. Time:</h6></td><td class="large-8">{{ Form::text('preferredcontacttime', $lead->preferredcontacttime) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Birthdate:</h6></td><td class="large-8">{{ Form::text('birthdate', $lead->birthdate) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Smoke:</h6></td><td class="large-8">{{ Form::text('tobaccouser', $lead->tobaccouser) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Pregnant:</h6></td><td class="large-8">{{ Form::text('pregnant', $lead->pregnant) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Health Prob.:</h6></td><td class="large-8">{{ Form::text('majorhealthproblems', $lead->majorhealthproblems) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Current Carrier:</h6></td><td class="large-8">{{ Form::text('currentcarrier', $lead->currentcarrier) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Comments:</h6></td><td class="large-8">{{ Form::textarea('comments', $lead->comments) }}</td>
					</tr>
				</table>
			</div>
			<div class="row collapse">
					<div class="large-2 columns end">
						{{ Form::submit('UPDATE', array('class' => 'button small')) }}
					</div>
				</div>
		</section>
		{{ Form::close(); }}
	</div>
</div>
@endsection


@section('scripts')
@endsection