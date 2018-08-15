@extends('layouts.dashboard')

@section('cl-profile', 'is-active')

@section('main')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('dashboard') }}">Admin.</a></li>
            <li class="is-active"><a href="{{ url('dashboard/profile') }}" aria-current="page">Profile</a></li>
        </ul>
    </nav>
    <h1 class="title">Profile</h1>
	<h2 class="subtitle">user profile</h2>
    <div class="columns">
        <div class="column is-6 is-offset-3">
            <form class="form" method="POST" action="{{ route('profile') }}">
                @csrf
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control has-icons-left">
                        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" name="name" id="name" value="{{ $user->name }}" placeholder="Name" autocomplete="fullname" required="" autofocus="">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left">
                        <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" type="email" name="email" id="email" value="{{ $user->email }}" placeholder="Your Email" autocomplete="email" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left">
                        <input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" type="password" name="password" id="password" value="{{ $user->password }}" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    @if ($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="field">
                    <label class="label">Password Confirmation</label>
                    <div class="control has-icons-left">
                        <input class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}" type="password" name="password_confirmation" id="password-confirm" value="{{ $user->password }}" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
                <button type="submit" class="button is-block is-info is-fullwidth">Update</button>
            </form>
        </div>
    </div>
@endsection
