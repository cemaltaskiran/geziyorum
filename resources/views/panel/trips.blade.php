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
                            <img src="{{ $trip->media->getMedia() }}" alt="" style="width:100%">
                        </div>
                    </div>
                    <div>
                        <div class="float-left">
                            {{ $trip->name }}
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection