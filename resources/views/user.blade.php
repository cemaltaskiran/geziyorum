@extends('layouts.user_layout')
@section('title', 'Edit Account')
@section('main')
    <div class="container mt-12 mb-6">
        <div class="row">
            <div class="col-md-3">
                <div class="user-profile-image">
                    <img src="{{$user->getPhoto()}}" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Dashboard</h4>
                    </div>
                </div>
                <hr>
                
            </div>
        </div>
    </div>
@endsection