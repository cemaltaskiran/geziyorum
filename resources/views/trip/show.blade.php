@extends('layouts.user_layout')
@section('title')
    {{ $trip->name }}
@endsection
@section('main')
    <div class="trip-bg" style="background: url(' {{ $trip->cover_image_path }}')">
        <div class="container">
            <div class="traveller-avatar">
                <a href="{{ route('user.show', ['username' => $trip->user->username]) }}">
                    <img src="{{ $trip->user->getPhoto() }}" alt="">
                </a>
            </div>
            <div class="traveller-info">
                <div style="margin-bottom:5px;">
                <a href="{{ route('user.show', ['username' => $trip->user->username]) }}">&commat;{{ $trip->user->username }}</a>
                </div>
                <div>
                    <button class="follow-traveller-btn">follow</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <main>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="trip-title">{{ $trip->name }}</h1>
                </div>
                <div class="col-md-12 trip-social-counter">
                    <span>
                        <i class="fas fa-thumbs-up"></i> {{ count($trip->likes) }}</span>
                    <span>
                        <i class="fas fa-comment-alt"></i> {{ count($trip->comments) }}</span>
                </div>
                <div class="col-md-12 sum-info">
                    <span>
                        <i class="fas fa-calendar-alt"></i> {{ $trip->total_time }}
                    </span>
                    <span>
                        <i class="fas fa-road"></i> {{ $trip->total_distance }}
                    </span>
                    <span>
                        <i class="fas fa-money-bill-alt"></i> $500
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 trip-summary">
                    <h3>About Trip</h3>
                    <p class="about">{{ $trip->about }}</p>
                </div>
                <div class="col-md-6 mini-gallery">
                    <h3>Gallery
                        <a href="#tabs">show all</a>
                    </h3>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="http://images.parkrun.com/website/wallpapers/parkrun_Owl_916.png" class="portrait" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="http://images.parkrun.com/website/wallpapers/parkrun_Owl_916.png" class="portrait" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail collapse">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                    <div class="mg-thumbnail collapse">
                        <div class="thumbnail-content">
                            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 map-view">
                    <h3>Map View of Trip</h3>
                    <div id="map"></div>
                    <script>
                        var map;
                        function initMap() {
                          map = new google.maps.Map(document.getElementById('map'), {
                            center: {lat: -34.397, lng: 150.644},
                            zoom: 8
                          });
                        }
                      </script>
                      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzPRdqJQTDTft2k1Z7oXsvKX8glW4qkI4&callback=initMap"
                      async defer></script>
                </div>
            </div>
        </main>
        <div id="tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#overview" role="tab">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#day-by-day" role="tab">Day by Day</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#gallery" role="tab">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#comments" role="tab">Comments</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active show" id="overview" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            {{ $trip->about }}
                        </div>
                        <div class="col-md-6">
                            masraflar listesi
                            <ul>
                                <li>
                                    Yaşama : 200 $
                                </li>
                                <li>
                                    Yemek : 200 $
                                </li>
                                <li>
                                    Ulaşım : 200 $
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="day-by-day" role="tabpanel">day by day</div>
                <div class="tab-pane fade" id="gallery" role="tabpanel">gallery</div>
                <div class="tab-pane fade" id="comments" role="tabpanel">comments</div>
            </div>
        </div>
    </div>
@endsection