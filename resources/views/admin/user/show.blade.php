@extends('layouts.admin_layout') @section('title', 'User:'.$user->username) @section('content') 
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.user.index') }}">< Back</a>
    </div>
</div>
<hr>
@if (Auth::user()->username == $user->username)
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Be aware you are editing your account!
            </div>
        </div>
    </div>
@endif
@if (session('update'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('update') }}</strong> is updated.
            </div>
        </div>
    </div>
@endif
@if (session('delete'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('delete') }}</strong> is deleted.
            </div>
        </div>
    </div>
@endif
@if (session('restore'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{ session('restore') }}</strong> is restored.
            </div>
        </div>
    </div>
@endif

<div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('admin.user.update', ['username' => $user->username]) }}">
                @csrf
                <div class="form-group row {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>
    
                    <div class="col-md-8">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') !== null ? old('username') : $user->username }}"
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
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') !== null ? old('email') : $user->email }}"
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
                        <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ old('birthdate') !== null ? old('birthdate') : $user->birthdate }}"
                            required> @if ($errors->has('birthdate'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('birthdate') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
    
                <div class="form-group row">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">
                                {{ __('update') }}
                            </button>
                        </div>
                        @if ($user->deleted_at == NULL)
                            <div class="col-md-1">
                                <a href="{{ route('admin.user.destroy', ['name' => $user->username]) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                    <button type="button" class="btn btn-danger">
                                        {{ __('delete') }}
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="col-md-1">
                                <a href="{{ route('admin.user.restore', ['name' => $user->username]) }}" onclick="return confirm('Are you sure you want to restore this item?');">
                                    <button type="button" class="btn btn-success">
                                        {{ __('restore') }}
                                    </button>
                                </a>
                            </div>
                        @endif
                        
                    </div>
            </form>
        </div>
    
    </div>
@endsection