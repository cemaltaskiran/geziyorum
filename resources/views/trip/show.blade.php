@extends('layouts.user_layout') @section('title') {{ $trip->name }} @endsection @section('main')
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
        @auth
        <div class="btn-group dropleft">
            <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#share">Share</a>
                @if ($trip->user_id == Auth::user()->id)
                    <a class="dropdown-item" href="{{route('panel.trip.edit', ['id' => $trip->id])}}">Edit trip</a>
                @endif
                @if ($trip->user_id !== Auth::user()->id)
                    <a class="dropdown-item" href="#download">Download to Phone</a>
                    @if (!Auth::user()->isUserComplained($trip->id, 'trip'))
                        <a class="dropdown-item" href="#report" onclick="$('#reportTripModal').modal('show')">Report</a>
                    @else
                        <a class="dropdown-item disabled bg-warning" href="#report">Reported!</a>
                    @endif 
                @endif
            </div>
        </div>
        @if (!Auth::user()->isUserComplained($trip->id, 'trip'))
        <div class="modal fade" id="reportTripModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Report This Trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="complaintForm" action="{{ route('report.store') }}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="complaintable_type" value="trip">
                            <input type="hidden" name="complaintable_id" value="{{$trip->id}}">
                            @foreach ($complaints->where('type', 'trip') as $complaint)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="complaint" id="c_{{ $complaint->id }}" value="{{ $complaint->id }}">
                                <label class="form-check-label" for="c_{{ $complaint->id }}">{{ $complaint->name }}</label>
                            </div>
                            <div class="complaint-description">{{ $complaint->description }}</div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('complaintForm').submit();">Send complaint</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif @endauth
        <div class="row">
            <div class="col-md-12">
                <h1 class="trip-title">{{ $trip->name }}</h1>
            </div>
            <div class="col-md-12 trip-social-counter">
                @if (Auth::check())
                    @if ($trip->likes->where('user_id', Auth::user()->id)->first())
                        <form action="{{ route('trip.unlike')}}" method="post" id="likeForm">
                            @csrf
                            <input type="hidden" name="trip_id" value="{{$trip->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </form>
                        <span>
                            <i class="fas fa-thumbs-up liked" onclick="$('#likeForm').submit();"></i> {{ count($trip->likes) }}
                        </span>
                    @else
                        <form action="{{ route('trip.like')}}" method="post" id="likeForm">
                            @csrf
                            <input type="hidden" name="trip_id" value="{{$trip->id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </form>
                        <span>
                            <i class="fas fa-thumbs-up" onclick="$('#likeForm').submit();"></i> {{ count($trip->likes) }}
                        </span>
                    @endif
                @else
                    <span>
                        <i class="fas fa-thumbs-up"></i> {{ count($trip->likes) }}
                    </span>
                @endif

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
            @if (session('report'))
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Your report has been sent to website content manager.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif @if ($trip->freeze)
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    This trip is
                    <strong>freezed!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif @if ($trip->deleted_at)
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    This trip is
                    <strong>deleted by admin!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
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
                        <img src="/images/parkrun_Owl_916.png" class="portrait" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//parkrun_Owl_916.png" class="portrait" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail collapse">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
                    </div>
                </div>
                <div class="mg-thumbnail collapse">
                    <div class="thumbnail-content">
                        <img src="/images//img_avatar2.png" alt="">
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
                            center: {
                                lat: -34.397,
                                lng: 150.644
                            },
                            zoom: 8
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzPRdqJQTDTft2k1Z7oXsvKX8glW4qkI4&callback=initMap" async
                    defer></script>
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
            <div class="tab-pane fade" id="comments" role="tabpanel">
                <div class="comments">
                    @auth
                        @if ($errors->has('comment'))
                            <div>
                                <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            </div>
                        @endif
                        <div class="comment-wrap">
                            <div class="photo">
                                <div class="avatar" style="background-image: url('{{Auth::user()->getPhoto()}}')"></div>
                            </div>
                            <div class="comment-block">
                                <form action="{{route('trip.comment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <textarea name="comment" id="comment" cols="30" rows="3" placeholder="Add comment..." maxlength="255" required>{{old('comment')}}</textarea>
                                    <span id="chars">255</span>
                                    <button type="submit" class="btn btn-primary float-right">send</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    
                    @foreach ($trip->comments as $comment)
                        <div class="comment-wrap">
                            <div class="photo">
                                <div class="avatar" style="background-image: url('{{$comment->user->getPhoto()}}')"></div>
                            </div>
                            <div class="comment-block">
                                <a href="{{route('user.show', ['username' => $comment->user->username])}}">{{$comment->user->username}}</a>
                                <p class="comment-text">{{$comment->comment}}</p>
                                <div class="bottom-comment">
                                    <div class="comment-date">{{$comment->created_at}}</div>
                                    <ul class="comment-actions">
                                        <li class="complain" @if (Auth::check() && !Auth::user()->isUserComplained($comment->id, 'comment')) onclick="commentReport({{$comment->id}});" @endif>Report</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @auth
                <div class="modal fade" id="reportCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Report Comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" id="complaintFormComment" action="{{ route('report.store') }}">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="complaintable_type" value="comment">
                                    <input type="hidden" name="complaintable_id" id="complaintable_id" value="">
                                    @foreach ($complaints->where('type', 'comment') as $complaint)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="complaint" id="c_{{ $complaint->id }}" value="{{ $complaint->id }}">
                                            <label class="form-check-label" for="c_{{ $complaint->id }}">{{ $complaint->name }}</label>
                                        </div>
                                        <div class="complaint-description">{{ $complaint->description }}</div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('complaintFormComment').submit();">Send complaint</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection 
@section('script')
    <script>
        
        $('#comment').keyup(function() {
            var length = $(this).val().length;
            var length = 255-length;
            $('#chars').text(length);
        });

        function commentReport(cid){
            $('#complaintable_id').val(""+cid);
            $('#reportCommentModal').modal('show');
        }
    </script>
    
@endsection