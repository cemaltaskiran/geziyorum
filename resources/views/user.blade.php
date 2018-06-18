@extends('layouts.user_layout')
@section('title', 'Edit Account')
@section('main')
    <div class="container mt-12 mb-6">
        <div class="row">
            <div class="col-md-3">
                <div class="user-profile-image card" data-toggle="tooltip" data-placement="top" title="Click to see full size image">
                    <a href="{{$user->getPhoto()}}" target="_blank"><img src="{{$user->getPhoto()}}" alt=""></a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <h4>&commat;{{$user->username}}</h4>
                        @if ($user->name_surname)
                            {{$user->name_surname}}
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                        @foreach ($user->createdTrips as $trip)
                        <div class="col-md-6">
                            <div class="trip-card">
                                <div class="image">
                                    @if ($trip->cover_image_path)
                                        <a href="{{ route('trip.show', ['url' => $trip->url]) }}"><img src="{{ $trip->cover_image_path }}" alt=""></a>
                                    @else
                                        <i class="fas fa-sync-alt"></i>
                                    @endif
                                    <a href="{{ route('panel.trip.edit', ['id' => $trip->id]) }}" class="tc-icon edit-trip-icon"><i class="fas fa-cog"></i></a>
                                    @if ($trip->freeze)
                                        <div class="tc-icon sync-trip-icon" data-toggle="tooltip" data-placement="left" title="Freezed trip"><i class="fas fa-snowflake"></i></div>
                                    @endif
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

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection