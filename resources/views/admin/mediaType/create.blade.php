@extends('layouts.admin_layout') @section('title', 'Create Media Type') @section('content')
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
        <form method="POST" action="{{ route('admin.mediaType.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('name') }}</label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                        required autofocus> @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="path" class="col-md-4 col-form-label text-md-right">{{ __('media path') }}</label>

                <div class="col-md-8">
                    <input id="path" type="text" class="form-control{{ $errors->has('path') ? ' is-invalid' : '' }}" name="path" value="{{ old('path') }}"> @if ($errors->has('path'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('path') }}</strong>
                    </span>
                    @endif
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