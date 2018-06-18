@extends('layouts.user_layout')
@section('title', 'Explore')
@section('main')
    <div class="content explore-unit">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="{{route('search')}}" method="post" class="form-inline">
                        @csrf
                        <select name="type" id="type" class="home-select">
                            <option value="trip" {{(request()->input('type')=='trip' ? 'selected' : '')}} >Trip</option>
                            <option value="user" {{(request()->input('type')=='user' ? 'selected' : '')}}>User</option>
                        </select>
                        <input type="text" name="keyword" placeholder="Search anything" value="{{request()->input('keyword')}}" class="home-text">
                        <input type="submit" value="Search" class="home-submit" style="background:#000; color:#fff">
                    </form>
                </div>
            </div>
            <div class="row mt-6">
                @if (isset($trips))
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
                    @if(count($trips) == 0)
                        No result for this search.
                    @endif
                @elseif (isset($users))
                    @foreach ($users as $user)
                        <div class="col-md-4 explore-trip">
                            <div class="user" style="border-bottom:1px solid #ccc">
                                <a href="{{ route('user.show', ['username' => $user->username]) }}">
                                    <div class="pp float-left">
                                        <img src="{{ $user->getPhoto() }}" alt="">
                                    </div>
                                    {{ $user->username }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @if(count($users) == 0)
                        No result for this search.
                    @endif
                @endif
            </div>
        </div>
        @if (isset($trips))
            {{ $trips->links() }}
        @endif
        @if (isset($users))
            {{ $users->links() }}
        @endif
    </div>
@endsection