@extends('layouts.default')

@section('title')
	Fetch Sales From ViCi Dialer
@endsection


@section('content')
	{{ Form::open(array('url' => 'sync', 'method' => 'post', 'class' => 'custom')) }}
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Please Enter Call Date(EST)</legend>
				<div class="row collapse">
					<div class="small-4 large-3 columns">
						<span class="prefix">Date:</span>
					</div>
					<div class="small-8 large-9 columns">
						{{ Form::text('date', Input::old('date'), array('placeholder' => 'Enter sale date', 'id' => 'dp1')) }}
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

	@if(isset($result))
	<div class="row">
		<div class="large-8 columns">
			<fieldset>
				<legend>Result</legend>
				
			</fieldset>
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