@extends('layouts.user_layout')
@section('title', ' - Trip Name')
@section('main')
    <div class="trip-bg" style="background: url('images/home_search_bg.jpeg')">
        <div class="container">
            <div class="traveller-avatar">
                <a href="profile.html">
                    <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="">
                </a>
            </div>
            <div class="traveller-info">
                <div style="margin-bottom:5px;">
                    <a href="profile.html">@traveller</a>
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
                    <h1 class="trip-title">City Tours In Europe, Paris</h1>
                </div>
                <div class="col-md-12 trip-social-counter">
                    <span>
                        <i class="fas fa-thumbs-up"></i> 17</span>
                    <span>
                        <i class="fas fa-comment-alt"></i> 5</span>
                    <span>
                        <i class="fas fa-eye"></i> 124</span>
                </div>
                <div class="col-md-12 sum-info">
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
            <div class="row">
                <div class="col-md-6 trip-summary">
                    <h3>About Trip</h3>
                    <p>Lorem ipsum dolor sit amet, sea id solum vidisse appetere, vis aeque neglegentur et. Mei habeo vitae
                        fabulas ea, cu paulo praesent cotidieque eos. Clita commodo ullamcorper nec te, eum eros admodum
                        te. Cu aliquam interesset eos, eu diceret deleniti vel.</p>

                    <p>Ei duo homero elaboraret, at eum dicam accusata suavitate. Ut nostrud saperet appetere pro, probo argumentum
                        contentiones et his. His simul omnes persius et, inani facilisi ut usu. Ut eam delicata scripserit,
                        erant debitis luptatum duo at. Ei ullum accusata sadipscing quo.</p>
                </div>
                <div class="col-md-6 mini-gallery">
                    <h3>Gallery
                        <a href="gallery.html">show all</a>
                    </h3>
                    <div class="mg-thumbnail">
                        <div class="thumbnail-content">
                            <img src="images/istanbul.jpeg" alt="">
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
                    </script>
                </div>
            </div>
        </main>
        <div id="tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Day by Day</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Comments</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">overview</div>
                <div class="tab-pane" id="profile" role="tabpanel">day by day</div>
                <div class="tab-pane" id="messages" role="tabpanel">gallery</div>
                <div class="tab-pane" id="settings" role="tabpanel">comments</div>
            </div>
        </div>
    </div>
@endsection