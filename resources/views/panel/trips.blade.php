@extends('layouts.user_layout') @section('title', 'Your Trips') @section('main')
<div class="container mt-12 mb-6">
    <div class="row">
        <div class="col-md-3">
            @include('panel.menu')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <h4>Your Trips</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach ($user->createdTrips as $trip)
                <div class="col-md-6">
                    <div class="trip-card">
                        <div class="image">
                            <a href="{{ route('trip.show', ['url' => $trip->url]) }}"><img src="{{ $trip->cover_image_path }}" alt=""></a>
                            <a href="{{ route('panel.showTrip', ['id' => $trip->id]) }}" class="edit-trip-icon"><i class="fas fa-cog"></i></a>
                        </div>
                        <div>
                            <div class="float-left">
                                <a href="{{ route('trip.show', ['url' => $trip->url]) }}">{{ $trip->name }}</a>
                            </div>
                            <div class="float-right">
                                <span>
                                    <i class="fas fa-thumbs-up"></i> {{ count($trip->likes) }}
                                </span>
                                <span>
                                    <i class="fas fa-comment-alt"></i> {{ count($trip->comments) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection