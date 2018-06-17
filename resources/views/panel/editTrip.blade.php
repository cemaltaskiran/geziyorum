@extends('layouts.user_layout') @section('title', 'Your Trips') @section('main')
<div class="container mt-12 mb-6">
    <div class="row">
        <div class="col-md-3">
            @include('panel.menu')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <h4>Edit Trip</h4>
                </div>
            </div>
            <hr>
            @if (session('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    You updated this trip successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form method="POST" action="{{route('panel.trip.update', ['id' => $trip->id])}}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control {{($errors->has('name') ? 'is-invalid' : '')}}" id="name" value="{{(old('name') ? old('name') : $trip->name)}}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                        <textarea name="about" id="about" rows="8" class="form-control {{($errors->has('about') ? 'is-invalid' : '')}}">{{(old('about') ? old('about') : $trip->about)}}</textarea>
                        @if ($errors->has('about'))
                            <div class="invalid-feedback">
                                {{$errors->first('about')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Freeze</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="freeze" name="freeze" {{($trip->freeze) ? 'checked' : ''}}>
                            <label class="form-check-label" for="freeze">
                                Freeze this trip
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection