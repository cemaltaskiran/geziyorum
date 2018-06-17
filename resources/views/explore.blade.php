@extends('layouts.user_layout')
@section('title', 'Explore')
@section('main')
    <div class="content explore-unit">
        <div class="container">
            <div class="row">
                @foreach ($trips as $trip)
                    <div class="col-md-6 explore-trip">
                        <div class="user">
                            <a href="{{ route('user.show', ['username' => $trip->user->username]) }}">
                                <div class="pp float-left">
                                    <img src="{{ $trip->user->getPhoto() }}" alt="">
                                </div>
                                {{ $trip->user->username }}
                            </a>
                        </div>
                        <a href="{{route('trip.show', ['url' => $trip->url])}}">
                        <div class="picture" style="background-image: url('{{ $trip->cover_image_path }}')">
                        </div>
                        </a>
                        <div class="title">
                            <a href="{{route('trip.show', ['url' => $trip->url])}}">{{ $trip->name }}</a>
                        </div>
                        <div class="details">
                            <div class="likes float-left">
                                <i class="fas fa-thumbs-up"></i> {{count($trip->likes)}}
                            </div>
                            <div class="">
                                <i class="fas fa-comment-alt"></i> {{count($trip->comments)}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $trips->links() }}
    </div>
@endsection