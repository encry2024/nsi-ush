<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nothstart Solutions Inc. USHA Sales Submission Portal</title>
		{{ HTML::style('packages/foundation-5.4.0/css/normalize.css') }}
		{{ HTML::style('packages/foundation-5.4.0/css/foundation.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::style('assets/css/classic.css') }}
		{{ HTML::style('assets/css/classic.date.css') }}
		{{ HTML::style('packages/foundation-icons-general/stylesheets/general_foundicons.css') }}
		{{ HTML::script('packages/foundation-5.4.0/js/vendor/modernizr.js') }}
</head>
<body>
	<div class="row" id="login">
		<div class="large-12 columns">
			<div class="row">
				<div class="large-4 large-centered columns" id="login-content">
					<div class="row">
						<div class="large-12 columns">
							<h1>
								Sign in to
								<span>USHA Administrator Login</span>
							</h1>
							<div class="separator"></div>
						</div>
					</div>
					{{ Form::open(array('url' => 'login')) }}
					<div class="row" style="margin-top: 30px">
						<div class="large-10 large-offset-1 columns">
							{{ Form::label('username', 'User:') }}
							{{ Form::text('username', Input::old('username'), array('placeholder' => 'Enter your username here')) }}
							
							{{ Form::label('password', 'Password:') }}
							{{ Form::password('password') }}
							<br/>
							@if (Session::has('flash_error'))
							<small class="error">{{ Session::get('flash_error') }}</small>
							@endif
							{{ Form::submit('Login', array('class' => 'button radius')) }}
						</div>
					</div>
					{{ Form::token() }}
					{{ Form::close(); }}
				</div>
			</div>
		</div>
	</div>
	
	{{ HTML::script('packages/foundation-5.4.0/js/vendor/jquery.js') }}
	{{ HTML::script('packages/foundation-5.4.0/js/foundation.min.js') }}

	<script>
		$(function(){
		    $(document).foundation();    
		})
	</script>
	@yield('scripts')
	<div id="alerts">
		@if(Session::has('message'))
			<div class="alert-box success">
				{{ Session::get('message') }}
				<a href="" class="close">&times;</a>
			</div>
		@elseif(Session::has('error'))
			<div class="alert-box alert">
				{{ Session::get('error') }}
				<a href="" class="close">&times;</a>
			</div>
		@endif

		@if($errors->has())
			<script type="text/javascript">

				@foreach(Session::get('error_index') as $key => $value)
					if($("input[name='{{ $key }}']").length){
						var form = $("input[name='{{ $key }}']").addClass("error").after('<small class="error">{{ $errors->first($key) }}</small>').parents('form:first');
					} else if($("select[name='{{ $key }}']").length) {
						var form = $("select[name='{{ $key }}']").addClass("error").after('<small class="error">{{ $errors->first($key) }}</small>').parents('form:first');
					} else if($("textarea[name='{{ $key }}']").length) {
						var form = $("textarea[name='{{ $key }}']").addClass("error").after('<small class="error">{{ $errors->first($key) }}</small>').parents('form:first');
					}
				@endforeach

				@if(Session::has('form'))
					$("#{{ Session::get('form') }}").reveal();
				@else
					var parent = form.parent();
					if(parent.attr('id').indexOf("modal") !== -1) {
						parent.foundation('reveal', 'open');
					}
				@endif
			</script>
		@endif
	</div>
</body>
</html>    