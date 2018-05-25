@extends('layouts.user_layout')
@section('title', 'Travelers Homestead')
@section('main')
    <div class="search-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <h1>Experience The World</h1>
                    <h2>Tell your story to everyone</h2>
                </div>
                <div class="col-md-4 offset-md-4">
                    <form action="index.php" method="post" class="form-inline">
                        <input type="text" placeholder="Search anything">
                        <input type="submit" value="Search">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <h2>Most Popular Trips</h2>
            </div>
            <div class="row">
                <h6>These trips are most populars. You can discover any of them.</h6>
            </div>
            <div class="row">
                <div class="col featured-trip">
                    <a href="{{route('trip.show', ['url' => 'demo-trip-1'])}}">
                        <div class="picture" style="background-image: url('images/moscow.jpg')">
                        </div>
                    </a>
                    <div class="title">
                        <h3>
                            <a href="{{route('trip.show', ['url' => 'demo-trip-1'])}}">Title brother with me</a>
                        </h3>
                    </div>
                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud
                    </div>
                    <div class="details">
                        <span>
                            <i class="fas fa-calendar-alt"></i> 12 Days
                        </span>
                        <span>
                            <i class="fas fa-road"></i> 120 KM
                        </span>
                        <span>
                            <i class="fas fa-money-bill-alt"></i> $500
                        </span>
                    </div>
                </div>
                <div class="col featured-trip">
                    <a href="{{route('trip.show', ['url' => 'demo-trip-1'])}}">
                        <div class="picture" style="background-image: url('images/istanbul.jpg')">
                        </div>
                    </a>
                    <div class="title">
                        <h3>
                            <a href="{{route('trip.show', ['url' => 'demo-trip-1'])}}">Title brother with me</a>
                        </h3>
                    </div>
                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud
                    </div>
                    <div class="details">
                        <span>
                            <i class="fas fa-calendar-alt"></i> 12 Days
                        </span>
                        <span>
                            <i class="fas fa-road"></i> 120 KM
                        </span>
                        <span>
                            <i class="fas fa-money-bill-alt"></i> $500
                        </span>
                    </div>
                </div>
                <div class="col featured-trip">
                    <a href="{{route('trip.show', ['url' => 'demo-trip-1'])}}">
                        <div class="picture" style="background-image: url('images/jungle.jpg')">
                        </div>
                    </a>
                    <div class="title">
                        <h3>
                            <a href="{{route('trip.show', ['url' => 'demo-trip-1'])}}">Title brother with me</a>
                        </h3>
                    </div>
                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud
                    </div>
                    <div class="details">
                        <span>
                            <i class="fas fa-calendar-alt"></i> 12 Days
                        </span>
                        <span>
                            <i class="fas fa-road"></i> 120 KM
                        </span>
                        <span>
                            <i class="fas fa-money-bill-alt"></i> $500
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content your-trip-style">
        <div class="container">
            <div class="row">
                <h2>Choose your style</h2>
            </div>
            <div class="row">
                <div class="col">
                    <div class="trip-style">
                        <a href="#">
                            <i class="fas fa-fire"></i>
                            <span>Camping</span>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="trip-style">
                        <a href="#">
                            <i class="fas fa-leaf"></i>
                            <span>Trekking</span>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="trip-style">
                        <a href="#">
                            <i class="fas fa-road"></i>
                            <span>Roads</span>
                        </a>
                    </div>

                </div>
                <div class="col">
                    <div class="trip-style">
                        <a href="#">
                            <i class="fas fa-ship"></i>
                            <span>Surfing</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection