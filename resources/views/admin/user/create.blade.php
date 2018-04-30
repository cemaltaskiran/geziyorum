@extends('layouts.admin_layout') @section('title', 'Create User') @section('content') 
@if (session('create'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('create') }}</strong> is created.
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <div class="form-group row {{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>

                <div class="col-md-8">
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                        required autofocus> @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('e-mail') }}</label>

                <div class="col-md-8">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                        required> @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('birthdate') ? ' has-error' : '' }}">
                <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('birthdate') }}</label>

                <div class="col-md-8">
                    <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}"
                        required> @if ($errors->has('birthdate'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('birthdate') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('password') }}</label>

                <div class="col-md-8">
                    <input id="password" type="password" class="form-control" name="password"
                        required> @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('password again') }}</label>

                <div class="col-md-8">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('create') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection