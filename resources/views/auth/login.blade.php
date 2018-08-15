@extends('layouts.index')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
	<section class="hero is-success is-fullheight">
		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="column is-4 is-offset-4">
					<h3 class="title has-text-grey">Login</h3>
					<p class="subtitle has-text-grey">Please login to proceed.</p>
					<div class="box">
						<figure class="avatar">
							<img src="{{ asset('images/if_lock-128.png') }}">
						</figure>
						<form class="form" method="POST" action="{{ route('login') }}">
	            			@csrf
							<div class="field">
								<div class="control">
									<input class="input is-large {{ $errors->has('email') ? 'is-danger' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email" required autofocus>
								</div>
								@if ($errors->has('email'))
									<p class="help is-danger">{{ $errors->first('email') }}</p>
								@endif
							</div>
							<div class="field">
								<div class="control">
									<input class="input is-large {{ $errors->has('password') ? 'is-danger' : '' }}" type="password" name="password" id="password" placeholder="Your Password" required>
								</div>
								@if ($errors->has('password'))
									<p class="help is-danger">{{ $errors->first('password') }}</p>
								@endif
							</div>
							<button type="submit" class="button is-block is-info is-large is-fullwidth">Login</button>
						</form>
					</div>
					<p class="has-text-grey">
						<a href="{{ url('register') }}">Sign Up</a>
					</p>
				</div>
			</div>
		</div>
	</section>
@endsection
