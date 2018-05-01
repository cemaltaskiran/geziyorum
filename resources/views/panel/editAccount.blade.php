@extends('layouts.user_layout') @section('title', 'Edit Account') @section('main')
<div class="container mt-12 mb-6">
    <div class="row">
        <div class="col-md-3 mb-6">
            @include('panel.menu')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <h4>Edit Account</h4>
                </div>
            </div>
            <hr>
            @if (session('create'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    You created your account successfully. You can change your account details below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    You updated your account.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->has('photo'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('photo') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form method="POST" action="{{ route('panel.updateAccount') }}"  enctype="multipart/form-data">
                <div class="form-group">
                    <img class="account-image" src="{{ $user->getPhoto() }}" height="80px" alt="">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input{{ $errors->has('photo') ? ' is-invalid' : '' }}" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">change photo</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name_surname">name surname</label>
                        <input name="name_surname" type="text" class="form-control{{ $errors->has('name_surname') ? ' is-invalid' : '' }}" id="name_surname" value="{{ old('name_surname') !== null ? old('name_surname') : $user->name_surname }}"> @if ($errors->has('name_surname'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name_surname') }}</strong>
                        </span> @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="birthdate">birthdate</label>
                        <input id="birthdate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate"
                            value="{{ old('birthdate') !== null ? old('birthdate') : $user->birthdate }}"> @if ($errors->has('birthdate'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('birthdate') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">username</label>
                        <input name="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" value="{{ old('username') !== null ? old('username') : $user->username }}"
                           > @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span> @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">email</label>
                        <input name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email') !== null ? old('email') : $user->email }}"
                           > @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="location">location</label>
                        <input name="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" id="location" value="{{ old('location') !== null ? old('location') : $user->location }}">
                        @if ($errors->has('location'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bio">bio</label>
                        <input name="bio" type="bio" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" id="bio" value="{{ old('bio') !== null ? old('bio') : $user->bio }}">
                        @if ($errors->has('bio'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('bio') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @csrf
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection