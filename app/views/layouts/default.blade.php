<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Nothstart Solutions Inc. USHA Sales Submission Portal</title>
		{{ HTML::style('packages/foundation-5.4.0/css/normalize.css') }}
		{{ HTML::style('packages/foundation-5.4.0/css/foundation.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::style('assets/css/classic.css') }}
		{{ HTML::style('assets/css/classic.date.css') }}
		{{ HTML::style('packages/foundation-icons-general/stylesheets/general_foundicons.css') }}
		{{ HTML::script('packages/foundation-5.4.0/js/vendor/modernizr.js') }}
		{{ HTML::style('packages/DataTables-1.10.4/media/css/jquery.dataTables.min.css') }}
		{{ HTML::style('packages/DataTables-1.10.4/media/css/jquery.dataTables.css') }}
	</head>

	<body>
		<div id="content">
			<nav class="top-bar">
				<ul class="title-area">
				    <li class="name">
				      	<h1><a href="#">Northstar Solutions Inc.</a></h1>
				    </li>
    				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			  	</ul>
			  	<section class="top-bar-section">
			  		<ul class="right">
			  			<li class="divider"></li>
			  			<li><a href="#">Welcome Admin</a></li>
			  			<li class="divider"></li>
			  			<li>{{ HTML::link("logout", "Logout") }}</li>
			  		</ul>
			  	</section>
			</nav>
			<div class="row">
				<div class="large-12 columns">
					<h1><a href="#">USHA Sales Submission Portal v0.1</a></h1>
				</div>
			</div>
			<div class="row collapse">
				<div class="large-2 columns sidebar">
					@include('sidebar.supervisor')
				</div>
				<div class="large-10 columns main-content">
					<div class="row">
						<div class="large-12 columns">
							<div class="row collapse">
								<div class="large-6 columns">
									<h3>@yield('title')</h3>
								</div>
								<div class="large-6 columns">
									<h3>@yield('menu')</h3>
								</div>
								<hr />
							</div>
						</div>
					</div>
					<div class="row" id="body-content">
						<div class="large-12 columns">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<hr>
					<h6><small>Copyright 2014 Northstar Solutions Inc.</small></h6>
				</div>
			</div>
			@yield('popups')
		</div>
		{{ HTML::script('packages/DataTables-1.10.4/media/js/jquery.js') }}
		{{ HTML::script('packages/foundation-5.4.0/js/vendor/jquery.js') }}
		{{ HTML::script('packages/foundation-5.4.0/js/foundation.min.js') }}
		{{ HTML::script('assets/js/picker.js') }}
		{{ HTML::script('assets/js/picker.date.js') }}
		{{ HTML::script('packages/DataTables-1.10.4/media/js/jquery.dataTables.min.js') }}
        {{ HTML::script('packages/DataTables-1.10.4/media/js/jquery.dataTables.js') }}
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