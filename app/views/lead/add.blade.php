@extends('layouts.default')

@section('title')
	Create Lead
@endsection

@section('menu')
	<div class="row">
		
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
						<td class="large-4 text-right"><h6 class="subheader">First Name:</h6></td><td class="large-8">{{ Form::text('firstName', Input::old('firstName')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Last Name:</h6></td><td class="large-8">{{ Form::text('lastName', Input::old('lastName')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Address 1:</h6></td><td class="large-8">{{ Form::text('address1', Input::old('address1')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Address 2:</h6></td><td class="large-8">{{ Form::text('address2', Input::old('address2')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">City:</h6></td><td class="large-8">{{ Form::text('city', Input::old('city')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">County:</h6></td><td class="large-8">{{ Form::text('county', Input::old('county')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">State:</h6></td><td class="large-8">{{ Form::text('state', Input::old('state')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Zip:</h6></td><td class="large-8">{{ Form::text('zip', Input::old('zip')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Email:</h6></td><td class="large-8">{{ Form::text('email', Input::old('email')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Home Phone:</h6></td><td class="large-8">{{ Form::text('homephone', Input::old('homephone')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Work Phone:</h6></td><td class="large-8">{{ Form::text('workphone', Input::old('workphone')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Pref. Time:</h6></td><td class="large-8">{{ Form::text('preferredcontacttime', Input::old('preferredcontacttime')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Birthdate:</h6></td><td class="large-8">{{ Form::text('birthdate', Input::old('birthdate')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Smoke:</h6></td><td class="large-8">{{ Form::text('tobaccouser', Input::old('tobaccouser')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Pregnant:</h6></td><td class="large-8">{{ Form::text('pregnant', Input::old('pregnant')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Health Prob.:</h6></td><td class="large-8">{{ Form::text('majorhealthproblems', Input::old('majorhealthproblems')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Current Carrier:</h6></td><td class="large-8">{{ Form::text('currentcarrier', Input::old('currentcarrier')) }}</td>
					</tr>
					<tr>
						<td class="large-4 text-right"><h6 class="subheader">Comments:</h6></td><td class="large-8">{{ Form::textarea('comments', Input::old('comments')) }}</td>
					</tr>
				</table>
			</div>
			<div class="row collapse">
				<div class="large-2 columns">
					{{ Form::submit('SAVE', array('class' => 'button small')) }}
				</div>
				<div class="large-2 columns end">
					{{ HTML::link("lead/add", "CANCEL", array('class' => 'button small')) }}
				</div>
			</div>
		</section>
		{{ Form::close(); }}
	</div>
</div>
@endsection


@section('scripts')
@endsection