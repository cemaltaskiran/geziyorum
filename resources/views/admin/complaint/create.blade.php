@extends('layouts.admin_layout') @section('title', 'Create Complaint') @section('content')
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
        <form method="POST" action="{{ route('admin.complaint.store') }}">
            @csrf

            <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-form-label text-md-right">name</label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required> 
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">description</label>

                <div class="col-md-8">
                    <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}"> 
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">type</label>
                <div class="col-md-8">
                    <select multiple class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type">
                        @if( old('type') !== null )
                            <option value="user" {{ old('type') == 'user' ? 'selected' : '' }}>user</option>
                            <option value="trip" {{ old('type') == 'trip' ? 'selected' : '' }}>trip</option>
                            <option value="media" {{ old('type') == 'user' ? 'selected' : '' }}>media</option>
                            <option value="comment" {{ old('type') == 'user' ? 'selected' : '' }}>comment</option>
                        @else
                            <option value="user">user</option>
                            <option value="trip">trip</option>
                            <option value="media">media</option>
                            <option value="comment">comment</option>
                        @endif
                    </select>
                    @if ($errors->has('type'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        create
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection