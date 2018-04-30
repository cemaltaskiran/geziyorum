@extends('layouts.admin_layout') @section('title', 'Media Type:'.$mediaType->name) @section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.mediaType.index') }}">< Back</a>
    </div>
</div>
<hr> 
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
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.mediaType.update', ['name' => $mediaType->name]) }}">
            @csrf
            <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('name') }}</label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') !== null ? old('name') : $mediaType->name }}"
                        required autofocus> 
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="path" class="col-md-4 col-form-label text-md-right">{{ __('media path') }}</label>

                <div class="col-md-8">
                    <input id="path" type="text" class="form-control{{ $errors->has('path') ? ' is-invalid' : '' }}" name="path"
                        value="{{ old('path') !== null ? old('path') : $mediaType->path }}"> @if ($errors->has('path'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('path') }}</strong>
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
                <div class="col-md-1">
                    <a href="{{ route('admin.mediaType.destroy', ['name' => $mediaType->name]) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                        <button type="button" class="btn btn-danger">
                            {{ __('delete') }}
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection