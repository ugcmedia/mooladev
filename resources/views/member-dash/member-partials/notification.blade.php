@if ($message = Session::get('success'))

			<div class="alert alert-success alert-icon-block alert-dismissible" role="alert">
					<div class="alert-icon">
							<span class="icon-checkmark-circle"></span>
					</div>
					<strong>Success!</strong> {{$message}}.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
			</div>
	@endif

	@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-icon-block alert-dismissible" role="alert">
			<div class="alert-icon">
					<span class="icon-menu-circle"></span>
			</div>
			<strong>Error!</strong>	{{$message}}.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
		</div>
		@endif
		@if ($message = Session::get('merror'))

			<div class="alert alert-danger alert-icon-block alert-dismissible" role="alert">
				<div class="alert-icon">
						<span class="icon-menu-circle"></span>
				</div>
				<strong>Error!</strong>	{{ $message['msg'] }}.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
			</div>
			@endif
	@if (count($errors) > 0)
			<div class="alert alert-danger alert-icon-block alert-dismissible" role="alert">
					<div class="alert-icon">
							<span class="icon-menu-circle"></span>
					</div>
					<strong>Error!</strong>
					<ul>
							@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
							@endforeach
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
			</div>
	@endif
