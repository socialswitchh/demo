<?php 
    include('header.php');
    if(empty($_SESSION['is_login'])){ 
            header("Location: https://switchh.in"); 
            die(); 
        }
    $sql = "SELECT * FROM gt_users WHERE id = '".$_SESSION['id']."'"; 
      $query_retrived = mysqli_query($conn, $sql) or die("Error:".mysqli_error($conn)); 
      $row = mysqli_fetch_assoc($query_retrived);  
      $result = mysqli_num_rows($query_retrived); 
      // Followers 
      /* $sql_followers = "SELECT * FROM gt_friend_request WHERE request_to_id = '".@$row['id']."' AND request_status='Accept'";*/

      $sql_followers = "SELECT usr.id, usr.fname, usr.lname, usr.photo, usr.gender, usr.dummy_id, fr.request_to_id, fr.request_from_id, fr.request_status, fr.request_type  FROM gt_friend_request as fr INNER JOIN gt_users as usr ON usr.id = fr.request_from_id WHERE request_to_id = '".@$row['id']."' AND request_status='Accept'"; 
      $query_retrived_followers = mysqli_query($conn, $sql_followers) or die("Error:".mysqli_error($conn)); 
     // $row_followers = mysqli_fetch_assoc($query_retrived_followers);

      //Following

      /*$sql_following = "SELECT * FROM gt_friend_request WHERE request_from_id='".@$row['id']."' AND request_status='Accept'";*/  
      $sql_following = "SELECT usr.id, usr.fname, usr.lname, usr.photo, usr.gender, usr.dummy_id, fr.request_from_id, fr.request_from_id, fr.request_status, fr.request_type FROM gt_friend_request as fr INNER JOIN gt_users as usr ON usr.id = fr.request_to_id WHERE request_from_id = '".@$row['id']."'"; 

      $query_retrived_following = mysqli_query($conn, $sql_following) or die("Error:".mysqli_error($conn));  
?>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQHJPZP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Pageloader -->
    <div class="pageloader" ></div>
    <div class="infraloader is-active"></div>
    <div class="app-overlay"></div>

     

        <!-- Container -->
        <div class="container is-custom" style="margin-top:60px;">

            <!-- Profile page main wrapper -->
            <div id="profile-main" class="view-wrap is-headless">
                <div class="columns is-multiline no-margin">
                    <!-- Left side column -->
                    <div class="column is-paddingless">
                        <!-- Timeline Header -->
                        <!-- html/partials/pages/profile/timeline/timeline-header.html -->
                        <div class="cover-bg">
                            <img class="cover-image" src="https://via.placeholder.com/1600x460" data-demo-src="assets/img/demo/bg/4.png" alt="">
                            <div class="avatar">
                                <img id="user-avatar" class="avatar-image" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">

                            <div class="avatar-button">
                                <div class="modal-trigger" data-modal="change-profile-modal"> 
                                <i data-feather="camera"></i>
                            </div>
                                </div> 
                            </div>
                            <div class="cover-overlay"></div>
                            <div class="cover-edit modal-trigger" data-modal="change-cover-modal">
                                <i class="mdi mdi-camera"></i>
                                <span>Edit cover image</span>
                            </div>
                            <!--/html/partials/pages/profile/timeline/dropdowns/timeline-mobile-dropdown.html-->
                            <div class="dropdown is-spaced is-right is-accent dropdown-trigger timeline-mobile-dropdown is-hidden-desktop">
                                <div>
                                    <div class="button">
                                        <i data-feather="more-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="/profile-main.html" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="activity"></i>
                                                <div class="media-content">
                                                    <h3>Timeline</h3>
                                                    <small>Open Timeline.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="/profile-about.html" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="align-right"></i>
                                                <div class="media-content">
                                                    <h3>About</h3>
                                                    <small>See about info.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="/profile-friends.html" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="heart"></i>
                                                <div class="media-content">
                                                    <h3>Friends</h3>
                                                    <small>See friends.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="/profile-photos.html" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="image"></i>
                                                <div class="media-content">
                                                    <h3>Photos</h3>
                                                    <small>See all photos.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-menu is-hidden-mobile">
                            <div class="menu-start">
                                <a href="profile-main.html" class="button has-min-width">Timeline</a>
                                <a href="profile-about.html" class="button has-min-width">About</a>
                            </div>
                            <div class="menu-end">
                                <a id="profile-friends-link" href="profile-friends.html" class="button has-min-width">Friends</a>
                                <a href="profile-photos.html" class="button has-min-width">Photos</a>
                            </div>
                        </div>

                        <div class="profile-subheader">
                            <div class="subheader-start">
                                <span>670</span>
                                <span>Following</span> 
                            </div> 
                            <div class="subheader-middle">
                                <h2><?php echo $row['fname'].' '.$row['lname']?></h2>
                                <span>Developer</span>
                            </div>
                            <div class="subheader-end subheader-start">
                                <span>390</span>
                                <span>Followers</span> 
                            </div> 
                        </div>
                    </div>

                </div>

                <div class="columns">
                    <div id="profile-timeline-widgets" class="column is-4">

                        <!-- Basic Infos widget -->
                        <!-- html/partials/pages/profile/timeline/widgets/basic-infos-widget.html -->
                        <div class="box-heading">
                            <h4>Basic Infos</h4>
                            <!-- <div class="button-wrap">
                                <button type="button" class="button is-active">Edit Profile</button> 
                            </div>  -->

                            <div class="cover-overlay"></div>
                            <div class="cover-edit modal-trigger" data-modal="change-edit-profile"> 
                                <button type="button" class="button is-active">Edit Profile</button> 
                            </div>



                        </div>

                        <div class="basic-infos-wrapper">
                            <div class="card is-profile-info">
                                <div class="info-row">
                                    <div>
                                        <span>Studied at</span>
                                        <a class="is-inverted">Georgetown University</a>
                                    </div>
                                    <i class="mdi mdi-school"></i>
                                </div>
                                <div class="info-row">
                                    <div>
                                        <span>Married to</span>
                                        <a class="is-inverted">Dan Walker</a>
                                    </div>
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <div class="info-row">
                                    <div>
                                        <span>From</span>
                                        <a class="is-inverted">Melbourne, AU</a>
                                    </div>
                                    <i class="mdi mdi-earth"></i>
                                </div>
                                <div class="info-row">
                                    <div>
                                        <span>Lives in</span>
                                        <a class="is-inverted">Los Angeles, CA</a>
                                    </div>
                                    <i class="mdi mdi-map-marker"></i>
                                </div>
                                <div class="info-row">
                                    <div>
                                        <span>Followers</span>
                                        <a class="is-muted">258 followers</a>
                                    </div>
                                    <i class="mdi mdi-bell-ring"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Photos widget -->
                        <!-- html/partials/pages/profile/timeline/widgets/photos-widget.html -->
                        <div class="box-heading">
                            <h4>Photos</h4>
                            <div class="dropdown is-neutral is-spaced is-right dropdown-trigger">
                                <div>
                                    <div class="button">
                                        <i data-feather="more-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="image"></i>
                                                <div class="media-content">
                                                    <h3>View Photos</h3>
                                                    <small>View all your photos</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="tag"></i>
                                                <div class="media-content">
                                                    <h3>Tagged</h3>
                                                    <small>View photos you are tagged in.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="folder"></i>
                                                <div class="media-content">
                                                    <h3>Albums</h3>
                                                    <small>Open my albums.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="is-photos-widget">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/1.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/2.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/3.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/4.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/5.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/6.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/7.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/8.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/9.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/10.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/11.jpg" alt="">
                            <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/photos/12.jpg" alt="">
                        </div>
                        <!-- Star friends widget -->
                        <!-- html/partials/pages/profile/timeline/widgets/star-friends-widget.html -->
                        <div class="box-heading">
                            <h4>Friends</h4>
                            <div class="dropdown is-neutral is-spaced is-right dropdown-trigger">
                                <div>
                                    <div class="button">
                                        <i data-feather="more-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="users"></i>
                                                <div class="media-content">
                                                    <h3>All Friends</h3>
                                                    <small>View all friends.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="heart"></i>
                                                <div class="media-content">
                                                    <h3>Family</h3>
                                                    <small>View family members.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="briefcase"></i>
                                                <div class="media-content">
                                                    <h3>Work Relations</h3>
                                                    <small>View work related friends.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="friend-cards-list">
                            <div class="card is-friend-card">

                                <div class="friend-item">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="" data-user-popover="1">
                                    <div class="text-content">
                                        <a>Dan Walker</a>
                                        <span>4 mutual friend(s)</span>
                                    </div>
                                    <div class="star-friend">
                                        <i data-feather="star"></i>
                                    </div>
                                </div>

                                <div class="friend-item">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="" data-user-popover="7">
                                    <div class="text-content">
                                        <a>Milly Augustine</a>
                                        <span>3 mutual friend(s)</span>
                                    </div>
                                    <div class="star-friend is-active">
                                        <i data-feather="star"></i>
                                    </div>
                                </div>

                                <div class="friend-item">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="" data-user-popover="5">
                                    <div class="text-content">
                                        <a>Edward Mayers</a>
                                        <span>35 mutual friend(s)</span>
                                    </div>
                                    <div class="star-friend is-active">
                                        <i data-feather="star"></i>
                                    </div>
                                </div>

                                <div class="friend-item">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="" data-user-popover="2">
                                    <div class="text-content">
                                        <a>Stella Bergmann</a>
                                        <span>48 mutual friend(s)</span>
                                    </div>
                                    <div class="star-friend">
                                        <i data-feather="star"></i>
                                    </div>
                                </div>

                                <div class="friend-item">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="" data-user-popover="6">
                                    <div class="text-content">
                                        <a>Elise Walker</a>
                                        <span>1 mutual friend(s)</span>
                                    </div>
                                    <div class="star-friend">
                                        <i data-feather="star"></i>
                                    </div>
                                </div>

                                <div class="friend-item">
                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="" data-user-popover="9">
                                    <div class="text-content">
                                        <a>Nelly Schwartz</a>
                                        <span>11 mutual friend(s)</span>
                                    </div>
                                    <div class="star-friend">
                                        <i data-feather="star"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Videos widget -->
                        <!-- html/partials/pages/profile/timeline/widgets/videos-widget.html -->
                        <div class="box-heading">
                            <h4>Videos</h4>
                            <div class="dropdown is-neutral is-spaced is-right dropdown-trigger">
                                <div>
                                    <div class="button">
                                        <i data-feather="more-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="video"></i>
                                                <div class="media-content">
                                                    <h3>View Videos</h3>
                                                    <small>View all your videos</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="tag"></i>
                                                <div class="media-content">
                                                    <h3>Tagged</h3>
                                                    <small>View videos you are tagged in.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="is-videos-widget">

                            <div class="video-container">
                                <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/videos/1.jpg" alt="">
                                <div class="video-button">
                                    <img src="assets/img/icons/video/play.svg" alt="">
                                </div>
                                <div class="video-overlay"></div>
                            </div>

                            <div class="video-container">
                                <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/videos/2.jpg" alt="">
                                <div class="video-button">
                                    <img src="assets/img/icons/video/play.svg" alt="">
                                </div>
                                <div class="video-overlay"></div>
                            </div>

                            <div class="video-container">
                                <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/videos/3.jpg" alt="">
                                <div class="video-button">
                                    <img src="assets/img/icons/video/play.svg" alt="">
                                </div>
                                <div class="video-overlay"></div>
                            </div>

                        </div>
                        <!-- Trips widget -->
                        <!-- html/partials/pages/profile/timeline/widgets/trips-widget.html -->
                        <div class="box-heading">
                            <h4>Trips</h4>
                            <div class="dropdown is-neutral is-spaced is-right dropdown-trigger">
                                <div>
                                    <div class="button">
                                        <i data-feather="more-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="globe"></i>
                                                <div class="media-content">
                                                    <h3>View my Trips</h3>
                                                    <small>View all your trips</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="compass"></i>
                                                <div class="media-content">
                                                    <h3>Suggestions</h3>
                                                    <small>View trendy suggestions.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="trip-cards-list">
                            <div class="card is-trip-card">

                                <div class="trip-item">
                                    <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/trips/1.jpg" alt="">
                                    <div class="text-content">
                                        <a>New York, NY, USA</a>
                                        <span>4 months ago</span>
                                    </div>
                                </div>
                                <div class="trip-item">
                                    <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/trips/2.jpg" alt="">
                                    <div class="text-content">
                                        <a>Paris, France</a>
                                        <span>8 months ago</span>
                                    </div>
                                </div>
                                <div class="trip-item">
                                    <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/trips/3.jpg" alt="">
                                    <div class="text-content">
                                        <a>Madrid, Spain</a>
                                        <span>a year ago</span>
                                    </div>
                                </div>
                                <div class="trip-item">
                                    <img src="https://via.placeholder.com/200x200" data-demo-src="assets/img/demo/widgets/trips/4.jpg" alt="">
                                    <div class="text-content">
                                        <a>Marrakech, Morocco</a>
                                        <span>a year ago</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-heading">
                            <h4>Events</h4>
                            <div class="dropdown is-neutral is-spaced is-right dropdown-trigger">
                                <div>
                                    <div class="button">
                                        <i data-feather="more-vertical"></i>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="calendar"></i>
                                                <div class="media-content">
                                                    <h3>All Events</h3>
                                                    <small>View all your events</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="search"></i>
                                                <div class="media-content">
                                                    <h3>Search</h3>
                                                    <small>Search for events.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="compass"></i>
                                                <div class="media-content">
                                                    <h3>Suggestions</h3>
                                                    <small>View trendy suggestions.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule calendar widget -->
                        <!-- html/partials/widgets/schedule/schedule-widget.html -->
                        <div class="schedule">
                            <div class="schedule-day-container hidden">
                                <div class="day-header day-header--large">
                                    <div class="day-header-bg"></div>
                                    <div class="day-header-close">
                                        <i data-feather="x"></i>
                                    </div>
                                    <div class="day-header-content">
                                        <div class="day-header-title">
                                            <div class="day-header-title-day">24</div>
                                            <div class="day-header-title-month">October</div>
                                        </div>
                                        <div class="day-header-event">Workout Session</div>
                                    </div>
                                </div>
                                <div class="day-content has-slimscroll">

                                    <!-- Event 1 details -->
                                    <!-- html/partials/widgets/schedule/event-details/event-1.html -->
                                    <div id="event-1" class="event-details-wrap">
                                        <div class="meta-block">
                                            <i class="mdi mdi-lock"></i>
                                            <div class="meta">
                                                <span>Private</span>
                                                <span>This is a private event</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-map-marker"></i>
                                            <div class="meta">
                                                <span>Where</span>
                                                <span>@ Mom and Dad's house</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-progress-clock"></i>
                                            <div class="meta">
                                                <span>When</span>
                                                <span>02:00pm - 03:30pm</span>
                                            </div>
                                        </div>
                                        <div class="participants-wrap">
                                            <label>4 Participants</label>
                                            <div class="participants">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="" data-user-popover="0">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="" data-user-popover="9">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="" data-user-popover="2">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="" data-user-popover="7">
                                            </div>
                                        </div>
                                        <div class="event-description">
                                            <label>Description</label>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis commodi accusamus dolores itaque repudiandae.</p>
                                        </div>
                                        <hr>
                                        <div class="button-wrap">
                                            <a class="button is-bold">Participating</a>
                                            <a class="button is-bold">Details</a>
                                        </div>
                                    </div>
                                    <!-- Event 2 details -->
                                    <!-- html/partials/widgets/schedule/event-details/event-2.html -->
                                    <div id="event-2" class="event-details-wrap">
                                        <div class="meta-block">
                                            <i class="mdi mdi-lock"></i>
                                            <div class="meta">
                                                <span>Private</span>
                                                <span>This is a private event</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-map-marker"></i>
                                            <div class="meta">
                                                <span>Where</span>
                                                <span>@ <a class="is-inverted">Wayne's Coffeeshop</a>, LA</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-progress-clock"></i>
                                            <div class="meta">
                                                <span>When</span>
                                                <span>11:00am - 12:30pm</span>
                                            </div>
                                        </div>
                                        <div class="participants-wrap">
                                            <label>3 Participants</label>
                                            <div class="participants">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="" data-user-popover="0">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="" data-user-popover="4">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/rolf.jpg" alt="" data-user-popover="13">
                                            </div>
                                        </div>
                                        <div class="event-description">
                                            <label>Description</label>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis commodi accusamus dolores itaque repudiandae.</p>
                                        </div>
                                        <hr>
                                        <div class="button-wrap">
                                            <a class="button is-bold">Participating</a>
                                            <a class="button is-bold">Details</a>
                                        </div>
                                    </div>
                                    <!-- Event 3 details -->
                                    <!-- html/partials/widgets/schedule/event-details/event-3.html -->
                                    <div id="event-3" class="event-details-wrap">
                                        <div class="meta-block">
                                            <i class="mdi mdi-earth"></i>
                                            <div class="meta">
                                                <span>Public</span>
                                                <span>This is a public event</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-map-marker"></i>
                                            <div class="meta">
                                                <span>Where</span>
                                                <span>@ Frank's appartment</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-progress-clock"></i>
                                            <div class="meta">
                                                <span>When</span>
                                                <span>08:00pm - 02:00am</span>
                                            </div>
                                        </div>
                                        <div class="participants-wrap">
                                            <label>29 Participants</label>
                                            <div class="participants">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="" data-user-popover="0">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="" data-user-popover="6">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="" data-user-popover="3">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/rolf.jpg" alt="" data-user-popover="13">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="" data-user-popover="7">
                                                <div class="is-more">+24</div>
                                            </div>
                                        </div>
                                        <div class="event-description">
                                            <label>Description</label>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis commodi accusamus dolores itaque repudiandae.</p>
                                        </div>
                                        <hr>
                                        <div class="button-wrap">
                                            <a class="button is-bold">Participating</a>
                                            <a class="button is-bold">Details</a>
                                        </div>
                                    </div>
                                    <!-- Event 4 details -->
                                    <!-- html/partials/widgets/schedule/event-details/event-4.html -->
                                    <div id="event-4" class="event-details-wrap">
                                        <div class="meta-block">
                                            <i class="mdi mdi-lock"></i>
                                            <div class="meta">
                                                <span>Private</span>
                                                <span>This is a private event</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-map-marker"></i>
                                            <div class="meta">
                                                <span>Where</span>
                                                <span>@ <a class="is-inverted">Gold Gym</a>, LA</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-progress-clock"></i>
                                            <div class="meta">
                                                <span>When</span>
                                                <span>05:00pm - 07:00pm</span>
                                            </div>
                                        </div>
                                        <div class="participants-wrap">
                                            <label>2 Participants</label>
                                            <div class="participants">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="" data-user-popover="0">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/lana.jpeg" alt="" data-user-popover="10">
                                            </div>
                                        </div>
                                        <div class="event-description">
                                            <label>Description</label>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis commodi accusamus dolores itaque repudiandae.</p>
                                        </div>
                                        <hr>
                                        <div class="button-wrap">
                                            <a class="button is-bold">Participating</a>
                                            <a class="button is-bold">Details</a>
                                        </div>
                                    </div>
                                    <!-- Event 5 details -->
                                    <!-- html/partials/widgets/schedule/event-details/event-5.html -->
                                    <div id="event-5" class="event-details-wrap">
                                        <div class="meta-block">
                                            <i class="mdi mdi-lock"></i>
                                            <div class="meta">
                                                <span>Private</span>
                                                <span>This is a private event</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-map-marker"></i>
                                            <div class="meta">
                                                <span>Where</span>
                                                <span>@ <a class="is-inverted">Massive Dynamics Office</a>, LA</span>
                                            </div>
                                        </div>
                                        <div class="meta-block">
                                            <i class="mdi mdi-progress-clock"></i>
                                            <div class="meta">
                                                <span>When</span>
                                                <span>08:30am - 10:00am</span>
                                            </div>
                                        </div>
                                        <div class="participants-wrap">
                                            <label>29 Participants</label>
                                            <div class="participants">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="" data-user-popover="0">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="" data-user-popover="1">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="" data-user-popover="5">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/mike.jpg" alt="" data-user-popover="12">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/gaelle.jpeg" alt="" data-user-popover="11">
                                                <div class="is-more">+4</div>
                                            </div>
                                        </div>
                                        <div class="event-description">
                                            <label>Description</label>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis commodi accusamus dolores itaque repudiandae.</p>
                                        </div>
                                        <hr>
                                        <div class="button-wrap">
                                            <a class="button is-bold">Participating</a>
                                            <a class="button is-bold">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="schedule-header">
                                <div class="nav-icon">
                                    <i data-feather="chevron-left"></i>
                                </div>
                                <div class="month">October</div>
                                <div class="nav-icon">
                                    <i data-feather="chevron-right"></i>
                                </div>
                            </div>
                            <div class="schedule-calendar">
                                <div class="calendar-row day-row">
                                    <div class="day day-name">M</div>
                                    <div class="day day-name">T</div>
                                    <div class="day day-name">W</div>
                                    <div class="day day-name">T</div>
                                    <div class="day day-name">F</div>
                                    <div class="day day-name">S</div>
                                    <div class="day day-name">S</div>
                                </div>
                                <div class="calendar-row">
                                    <div class="day">&nbsp;</div>
                                    <div class="day">&nbsp;</div>
                                    <div class="day">1</div>
                                    <div class="day event green" data-content="1" data-day="2" data-event="Eat at mom and dad's">2</div>
                                    <div class="day">3</div>
                                    <div class="day">4</div>
                                    <div class="day">5</div>
                                </div>
                                <div class="calendar-row">
                                    <div class="day">6</div>
                                    <div class="day event purple" data-content="2" data-day="7" data-event="Meet customer in LA">7</div>
                                    <div class="day">8</div>
                                    <div class="day">9</div>
                                    <div class="day">10</div>
                                    <div class="day">11</div>
                                    <div class="day">12</div>
                                </div>
                                <div class="calendar-row">
                                    <div class="day">13</div>
                                    <div class="day">14</div>
                                    <div class="day">15</div>
                                    <div class="day">16</div>
                                    <div class="day">17</div>
                                    <div class="day">18</div>
                                    <div class="day">19</div>
                                </div>
                                <div class="calendar-row">
                                    <div class="day">20</div>
                                    <div class="day">21</div>
                                    <div class="day event green" data-content="3" data-day="22" data-event="Frank's birthday">22</div>
                                    <div class="day">23</div>
                                    <div class="day event primary" data-content="4" data-day="24" data-event="Workout Session">24</div>
                                    <div class="day">25</div>
                                    <div class="day event purple" data-content="5" data-day="26" data-event="Project review">26</div>
                                </div>
                                <div class="calendar-row">
                                    <div class="day">27</div>
                                    <div class="day">28</div>
                                    <div class="day">29</div>
                                    <div class="day">30</div>
                                    <div class="day"></div>
                                    <div class="day"></div>
                                    <div class="day"></div>
                                </div>
                                <div class="next-fab">
                                    <i data-feather="chevron-down"></i>
                                </div>
                            </div>
                            <div class="schedule-divider"></div>
                            <div class="schedule-events">
                                <div class="schedule-events-title">
                                    Upcoming events
                                </div>
                                <div class="schedule-event">
                                    <div class="event-date green">2</div>
                                    <div class="event-title">
                                        <span>Eat at mom and dad's</span>
                                        <span>07:30pm | Home</span>
                                    </div>
                                </div>
                                <div class="schedule-event">
                                    <div class="event-date purple">7</div>
                                    <div class="event-title">
                                        <span>Meet customer in LA</span>
                                        <span>11:00am | St Luc Café</span>
                                    </div>
                                </div>
                                <div class="schedule-event">
                                    <div class="event-date green">22</div>
                                    <div class="event-title">
                                        <span>Frank's birthday</span>
                                        <span>03:00pm | Frank's home</span>
                                    </div>
                                </div>
                                <div class="schedule-event">
                                    <div class="event-date primary">24</div>
                                    <div class="event-title">
                                        <span>Workout session</span>
                                        <span>07:00am | Gold Gym</span>
                                    </div>
                                </div>
                                <div class="schedule-event">
                                    <div class="event-date purple">26</div>
                                    <div class="event-title">
                                        <span>Project review</span>
                                        <span>08:00am | Office</span>
                                    </div>
                                </div>
                                <div class="button-wrap">
                                    <a class="button is-fullwidth has-icon"><i data-feather="plus"></i>New Event</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column is-8">
                        <div id="profile-timeline-posts" class="box-heading">
                            <h4>Posts</h4>
                            <div class="button-wrap">
                                <button type="button" class="button is-active">Recent</button>
                                <button type="button" class="button">Popular</button>
                            </div>
                        </div>

                        <div class="profile-timeline">

                            <!-- Timeline post 1 -->
                            <!-- html/partials/pages/profile/posts/timeline-post1.html -->
                            <!-- Timeline POST #1 -->
                            <div class="profile-post">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Jenna Davis</a>
                                                    <span class="time">October 17 2018, 11:03am</span>
                                                </div>
                                            </div>

                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>Today i visited this amazing little fashion store in Church street. Everything is handmade, from skirts
                                                    to bags. Their products really have an outstanding quality. If you don't know them already, well
                                                    it's time to make your move!
                                                <p>
                                            </div>
                                            <!-- Featured image -->
                                            <div class="post-image">
                                                <a data-fancybox="profile-post1" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/8.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/8.jpg">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/8.jpg" alt="">
                                                </a>
                                                <!-- Post actions -->
                                                <div class="like-wrapper">
                                                    <a href="javascript:void(0);" class="like-button">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-share">
                                                    <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                        <i data-feather="link-2"></i>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-comment">
                                                    <a href="javascript:void(0);" class="small-fab">
                                                        <i data-feather="message-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" data-user-popover="7" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p>
                                                    <a href="#">Milly</a>,
                                                    <a href="#">David</a>
                                                </p>
                                                <p>and 1 more liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>32</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>4</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                    <!-- Comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments
                                                <small>(5)</small>
                                            </h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body has-slimscroll">

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/bobby.jpg" data-user-popover="8" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Bobby Brown</a>
                                                    <span class="time">1 hour ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Daniel Wellington</a>
                                                            <span class="time">3 minutes ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>4</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/mike.jpg" data-user-popover="12" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Mike Lasalle</a>
                                                    <span class="time">Yesterday</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>3</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/lana.jpeg" data-user-popover="10" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Lana Henrikssen</a>
                                                            <span class="time">3 minutes ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>4</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Nelly Schwartz</a>
                                                    <span class="time">2 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->
                                        </div>
                                        <!-- Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- /Timeline POST #3 -->
                            <!-- Timeline post 2 -->
                            <!-- html/partials/pages/profile/posts/timeline-post2.html -->
                            <!-- Timeline POST #2 -->
                            <div class="profile-post">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post has-nested">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Elise Walker shared
                                                        <span>Dan Walker's post</span> on your feed</a>
                                                    <span class="time">July 19 2018, 19:42pm</span>
                                                </div>
                                            </div>

                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>My brother went to their concert last night, and looks like he had tons of fun. We should really do things
                                                    like this together.
                                                <p>
                                            </div>
                                            <!-- Featured image -->

                                            <!-- Nested Post (Shared) -->
                                            <div class="card is-post is-nested">
                                                <!-- Main wrap -->
                                                <div class="content-wrap">
                                                    <!-- Post header -->
                                                    <div class="card-heading">
                                                        <!-- User meta -->
                                                        <div class="user-block">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" data-user-popover="1" alt="">
                                                            </div>
                                                            <div class="user-info">
                                                                <a href="#">Dan Walker</a>
                                                                <span class="time">July 26 2018, 01:03pm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Post header -->

                                                    <!-- Post body -->
                                                    <div class="card-body">
                                                        <!-- Post body text -->
                                                        <div class="post-text">
                                                            <p>Yesterday with
                                                                <a href="#">@Karen Miller</a> and
                                                                <a href="#">@Marvin Stemperd</a> at the
                                                                <a href="#">#Rock'n'Rolla</a> concert in LA. Was totally fantastic! People were really excited about
                                                                this one!
                                                            </p>
                                                        </div>
                                                        <!-- Featured image -->
                                                        <div class="post-image">
                                                            <a data-fancybox="profile-post2" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/1.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/1.jpg">
                                                                <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- /Post body -->
                                                </div>
                                                <!-- /Main wrap -->
                                            </div>
                                            <!-- /Nested Post (Shared) -->
                                            <div class="action-wrap">
                                                <!-- Post actions -->
                                                <div class="like-wrapper">
                                                    <a href="javascript:void(0);" class="like-button">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-share">
                                                    <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                        <i data-feather="link-2"></i>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-comment">
                                                    <a href="javascript:void(0);" class="small-fab">
                                                        <i data-feather="message-circle"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/rolf.jpg" data-user-popover="13" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p>
                                                    <a href="#">Jenna</a>,
                                                    <a href="#">Edward</a>
                                                </p>
                                                <p>and 3 more liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>5</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>0</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                    <!-- Comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments
                                                <small>(4)</small>
                                            </h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body has-slimscroll">

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">David Kim</a>
                                                    <span class="time">5 hours ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Daniel Wellington</a>
                                                            <span class="time">3 minutes ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>4</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Edward Mayers</a>
                                                    <span class="time">Yesterday</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>3</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Nelly Schwartz</a>
                                                    <span class="time">2 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->
                                        </div>
                                        <!-- Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- /Timeline POST #2 -->
                            <!-- Timeline post 3 -->
                            <!-- html/partials/pages/profile/posts/timeline-post3.html -->
                            <!-- Timeline POST #3 -->
                            <div class="profile-post">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Jenna Davis</a>
                                                    <span class="time">October 09 2018, 11:03am</span>
                                                </div>
                                            </div>

                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>Today i visited this amazing little fashion store in Church street. Everything is handmade, from skirts
                                                    to bags. Their products really have an outstanding quality. If you don't know them already, well
                                                    it's time to make your move!
                                                <p>
                                            </div>
                                            <!-- Featured image -->
                                            <div class="post-image">
                                                <a data-fancybox="profile-post3" data-lightbox-type="comments" data-thumb="/assets/img/demo/video/dress.jpg" href="#myVideo">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="/assets/img/demo/video/dress.jpg" alt="">
                                                </a>
                                                <!-- Post actions -->
                                                <div class="like-wrapper">
                                                    <a href="javascript:void(0);" class="like-button">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-share">
                                                    <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                        <i data-feather="link-2"></i>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-comment">
                                                    <a href="javascript:void(0);" class="small-fab">
                                                        <i data-feather="message-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" data-user-popover="1" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" data-user-popover="7" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p>
                                                    <a href="#">Milly</a>,
                                                    <a href="#">David</a>
                                                </p>
                                                <p>and 56 more liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>58</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>12</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>9</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                    <!-- Comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments
                                                <small>(9)</small>
                                            </h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body has-slimscroll">

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" data-user-popover="7" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Milly Augustine</a>
                                                    <span class="time">1 hour ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Edward Mayers</a>
                                                            <span class="time">30 minutes ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>3</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Elise Walker</a>
                                                            <span class="time">15 minutes ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>0</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Stella Bergmann</a>
                                                    <span class="time">1 hour ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>5</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Jenna Davis</a>
                                                            <span class="time">30 minutes ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>0</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" data-user-popover="5" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Edward Mayers</a>
                                                    <span class="time">Yesterday</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>3</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" data-user-popover="9" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Nelly Schwartz</a>
                                                    <span class="time">2 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Jenna Davis</a>
                                                            <span class="time">2 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>3</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Elise Walker</a>
                                                            <span class="time">2 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>0</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->
                                        </div>
                                        <!-- Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- Timeline POST #3 -->

                            <video width="800" height="450" controls id="myVideo" style="display:none;">
                                <source src="assets/img/demo/video/source/dress.mp4" type="video/mp4">
                                <source src="assets/img/demo/video/source/dress.webm" type="video/webm">
                                <source src="assets/img/demo/video/source/dress.ogg" type="video/ogg">
                                Your browser doesn't support HTML5 video tag.
                            </video>
                            <!-- Timeline post 4 -->
                            <!-- html/partials/pages/profile/posts/timeline-post4.html -->
                            <!-- Timeline POST #4 -->
                            <div class="profile-post">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Jenna Davis</a>
                                                    <span class="time">September 26 2018, 11:18am</span>
                                                </div>
                                            </div>
                                            <!-- Right side dropdown -->
                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>Hello everyone! Today iam posting a review of the latest shoe trends. I tried for you more than 30 pairs of shoes. I had some crushes and some deceptions, However, it was a great experience i would like to share with you.
                                                <p>
                                            </div>
                                            <!-- Featured image -->
                                            <div class="post-image">
                                                <!-- CSS masonry wrap -->
                                                <div class="masonry-grid">
                                                    <!-- Left column -->
                                                    <div class="masonry-column-left">
                                                        <a data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/9.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/9.jpg">
                                                            <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/9.jpg" alt="">
                                                        </a>
                                                        <a data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/10.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/10.jpg">
                                                            <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/10.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <!-- Right column -->
                                                    <div class="masonry-column-right">
                                                        <a data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/11.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/11.jpg">
                                                            <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/11.jpg" alt="">
                                                        </a>
                                                        <a data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/12.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/12.jpg">
                                                            <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/12.jpg" alt="">
                                                        </a>
                                                        <a data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/13.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/13.jpg">
                                                            <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/13.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <!-- Post actions -->
                                                    <div class="like-wrapper">
                                                        <a href="javascript:void(0);" class="like-button">
                                                            <i class="mdi mdi-heart not-liked bouncy"></i>
                                                            <i class="mdi mdi-heart is-liked bouncy"></i>
                                                            <span class="like-overlay"></span>
                                                        </a>
                                                    </div>

                                                    <div class="fab-wrapper is-share">
                                                        <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                            <i data-feather="link-2"></i>
                                                        </a>
                                                    </div>

                                                    <div class="fab-wrapper is-comment">
                                                        <a href="javascript:void(0);" class="small-fab">
                                                            <i data-feather="message-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/rolf.jpg" data-user-popover="13" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/mike.jpg" data-user-popover="12" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p>
                                                    <a href="#">Mike</a>,
                                                    <a href="#">Rolf</a>
                                                </p>
                                                <p>and 31 more liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>33</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>3</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>8</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- Main wrap -->

                                    <!-- Comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments
                                                <small>(8)</small>
                                            </h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body has-slimscroll">

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Stella Bergmann</a>
                                                    <span class="time">17 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>0</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Jenna Davis</a>
                                                            <span class="time">17 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>4</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">David Kim</a>
                                                            <span class="time">17 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>1</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" data-user-popover="7" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Milly Augustine</a>
                                                            <span class="time">17 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>1</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Daniel Wellington</a>
                                                    <span class="time">17 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>6</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">David Kim</a>
                                                    <span class="time">18 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>5</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Stella Bergmann</a>
                                                            <span class="time">18 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>7</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/mike.jpg" data-user-popover="12" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Mike Lasalle</a>
                                                    <span class="time">20 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt.</p>
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>5</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Load More comments -->
                                            <div class="load-more has-text-centered">
                                                <button class="load-more-button">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- /timeline POST #4 -->
                            <!-- Timeline post 5 -->
                            <!-- html/partials/pages/profile/posts/timeline-post5.html -->
                            <!-- Timeline POST #5 -->
                            <div class="profile-post is-simple">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <!-- User image -->
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Jenna Davis</a>
                                                    <span class="time">September 17 2018, 10:23am</span>
                                                </div>
                                            </div>

                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>Hello guys, I need a ride because I need to go to <a href="#">#Los Angeles</a> to see a customer. I didn't have time to buy a train ticket so can anyone pick me up in the morning if he is going there too ?
                                                <p>
                                            </div>
                                            <!-- Post actions -->
                                            <div class="post-actions">
                                                <div class="like-wrapper">
                                                    <a href="javascript:void(0);" class="like-button">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-share">
                                                    <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                        <i data-feather="link-2"></i>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-comment">
                                                    <a href="javascript:void(0);" class="small-fab">
                                                        <i data-feather="message-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p><a href="#">Daniel</a> and <a href="#">Elise</a></p>
                                                <p>liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>2</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>0</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>2</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                    <!-- Post #6 comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments (<small>2</small>)</h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body has-slimscroll">

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Elise Walker</a>
                                                    <span class="time">2 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.</p>
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <!-- Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Jenna Davis</a>
                                                            <span class="time">2 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>0</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                        </div>
                                        <!-- /Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Post #6 comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- /timeline POST #5 -->
                            <!-- Timeline post 6 -->
                            <!-- html/partials/pages/profile/posts/timeline-post6.html -->
                            <!-- Timeline POST #6 -->
                            <div class="profile-post is-simple">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <!-- User image -->
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Stella Bergmann shared a status on your feed</a>
                                                    <span class="time">September 12 2018, 05:49pm</span>
                                                </div>
                                            </div>

                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>Are we going to see a movie tonight ? From what i can tell, that's what you said last week.
                                                <p>
                                            </div>
                                            <!-- Post actions -->
                                            <div class="post-actions">
                                                <div class="like-wrapper">
                                                    <a href="javascript:void(0);" class="like-button">
                                                        <i class="mdi mdi-heart not-liked bouncy"></i>
                                                        <i class="mdi mdi-heart is-liked bouncy"></i>
                                                        <span class="like-overlay"></span>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-share">
                                                    <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                        <i data-feather="link-2"></i>
                                                    </a>
                                                </div>

                                                <div class="fab-wrapper is-comment">
                                                    <a href="javascript:void(0);" class="small-fab">
                                                        <i data-feather="message-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p><a href="#">Daniel</a> and <a href="#">Elise</a></p>
                                                <p>liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>2</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>0</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>2</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- /Main wrap -->

                                    <!-- Post #6 comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments (<small>2</small>)</h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body">

                                            <!-- Comment -->
                                            <div class="media is-comment has-slimscroll">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Jenna Davis</a>
                                                    <span class="time">sep 12</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>1</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="2" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Stella Bergmann</a>
                                                            <span class="time">sep 12</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>0</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                        </div>
                                        <!-- /Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Post #6 comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- /timeline POST #6 -->
                            <!-- Timeline post 7 -->
                            <!-- html/partials/pages/profile/posts/timeline-post7.html -->
                            <!-- Timeline POST #7 -->
                            <div class="profile-post">
                                <!-- Timeline -->
                                <div class="time is-hidden-mobile">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                    </div>
                                </div>
                                <!-- Post -->
                                <div class="card is-post">
                                    <!-- Main wrap -->
                                    <div class="content-wrap">
                                        <!-- Header -->
                                        <div class="card-heading">
                                            <div class="user-block">
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                </div>
                                                <div class="user-info">
                                                    <a href="#">Jenna Davis</a>
                                                    <span class="time">September 26 2018, 11:18am</span>
                                                </div>
                                            </div>
                                            <!-- Right side dropdown -->
                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                <div>
                                                    <div class="button">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bookmark"></i>
                                                                <div class="media-content">
                                                                    <h3>Bookmark</h3>
                                                                    <small>Add this post to your bookmarks.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="bell"></i>
                                                                <div class="media-content">
                                                                    <h3>Notify me</h3>
                                                                    <small>Send me the updates.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <i data-feather="flag"></i>
                                                                <div class="media-content">
                                                                    <h3>Flag</h3>
                                                                    <small>In case of inappropriate content.</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Header -->

                                        <!-- Post body -->
                                        <div class="card-body">
                                            <!-- Post body text -->
                                            <div class="post-text">
                                                <p>Hello everyone! Today iam posting a review of the latest shoe trends. I tried for you more than 30 pairs of shoes. I had some crushes and some deceptions, However, it was a great experience i would like to share with you.
                                                <p>
                                            </div>
                                            <!-- Featured image -->
                                            <div class="post-image">
                                                <!-- CSS triple wrap -->
                                                <div class="triple-grid">
                                                    <a data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/16.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/16.jpg">
                                                        <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/16.jpg" alt="">
                                                    </a>
                                                    <a class="is-half" data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/14.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/14.jpg">
                                                        <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/14.jpg" alt="">
                                                    </a>
                                                    <a class="is-half" data-fancybox="profile-post4" data-lightbox-type="comments" data-thumb="assets/img/demo/unsplash/15.jpg" href="https://via.placeholder.com/1600x900" data-demo-href="assets/img/demo/unsplash/15.jpg">
                                                        <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/15.jpg" alt="">
                                                    </a>
                                                    <!-- Post actions -->
                                                    <div class="like-wrapper">
                                                        <a href="javascript:void(0);" class="like-button">
                                                            <i class="mdi mdi-heart not-liked bouncy"></i>
                                                            <i class="mdi mdi-heart is-liked bouncy"></i>
                                                            <span class="like-overlay"></span>
                                                        </a>
                                                    </div>

                                                    <div class="fab-wrapper is-share">
                                                        <a href="javascript:void(0);" class="small-fab share-fab modal-trigger" data-modal="share-modal">
                                                            <i data-feather="link-2"></i>
                                                        </a>
                                                    </div>

                                                    <div class="fab-wrapper is-comment">
                                                        <a href="javascript:void(0);" class="small-fab">
                                                            <i data-feather="message-circle"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post body -->

                                        <!-- Post footer -->
                                        <div class="card-footer">
                                            <!-- Followers -->
                                            <div class="likers-group">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/rolf.jpg" data-user-popover="13" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/mike.jpg" data-user-popover="12" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="3" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" data-user-popover="6" alt="">
                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt="">
                                            </div>
                                            <div class="likers-text">
                                                <p>
                                                    <a href="#">Mike</a>,
                                                    <a href="#">Rolf</a>
                                                </p>
                                                <p>and 31 more liked this</p>
                                            </div>
                                            <!-- Post statistics -->
                                            <div class="social-count">
                                                <div class="likes-count">
                                                    <i data-feather="heart"></i>
                                                    <span>33</span>
                                                </div>
                                                <div class="shares-count">
                                                    <i data-feather="link-2"></i>
                                                    <span>3</span>
                                                </div>
                                                <div class="comments-count">
                                                    <i data-feather="message-circle"></i>
                                                    <span>8</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Post footer -->
                                    </div>
                                    <!-- Main wrap -->

                                    <!-- Comments -->
                                    <div class="comments-wrap is-hidden">
                                        <!-- Header -->
                                        <div class="comments-heading">
                                            <h4>Comments
                                                <small>(8)</small>
                                            </h4>
                                            <div class="close-comments">
                                                <i data-feather="x"></i>
                                            </div>
                                        </div>
                                        <!-- /Header -->

                                        <!-- Comments body -->
                                        <div class="comments-body has-slimscroll">

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="4" alt=""> data-user-popover="2" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Stella Bergmann</a>
                                                    <span class="time">17 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>0</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="4" alt=""> data-user-popover="0" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Jenna Davis</a>
                                                            <span class="time">17 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>4</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt=""> data-user-popover="4" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">David Kim</a>
                                                            <span class="time">17 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>1</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" data-user-popover="4" alt=""> data-user-popover="7" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Milly Augustine</a>
                                                            <span class="time">17 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>1</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" data-user-popover="4" alt=""> data-user-popover="3" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Daniel Wellington</a>
                                                    <span class="time">17 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo.</p>
                                                    <!-- Comment actions -->
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>6</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" data-user-popover="4" alt=""> data-user-popover="4" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">David Kim</a>
                                                    <span class="time">18 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                        et dolore magna aliqua.</p>
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>5</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>

                                                    <!-- Nested Comment -->
                                                    <div class="media is-comment">
                                                        <!-- User image -->
                                                        <div class="media-left">
                                                            <div class="image">
                                                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" data-user-popover="4" alt=""> data-user-popover="2" alt="">
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="media-content">
                                                            <a href="#">Stella Bergmann</a>
                                                            <span class="time">18 days ago</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore
                                                                et dolore magna aliqua.</p>
                                                            <!-- Comment actions -->
                                                            <div class="controls">
                                                                <div class="like-count">
                                                                    <i data-feather="thumbs-up"></i>
                                                                    <span>7</span>
                                                                </div>
                                                                <div class="reply">
                                                                    <a href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right side dropdown -->
                                                        <div class="media-right">
                                                            <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                                <div>
                                                                    <div class="button">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-menu" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <a class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="x"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Hide</h3>
                                                                                    <small>Hide this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <i data-feather="flag"></i>
                                                                                <div class="media-content">
                                                                                    <h3>Report</h3>
                                                                                    <small>Report this comment.</small>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Nested Comment -->

                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Comment -->
                                            <div class="media is-comment">
                                                <!-- User image -->
                                                <div class="media-left">
                                                    <div class="image">
                                                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/mike.jpg" data-user-popover="4" alt=""> data-user-popover="12" alt="">
                                                    </div>
                                                </div>
                                                <!-- Content -->
                                                <div class="media-content">
                                                    <a href="#">Mike Lasalle</a>
                                                    <span class="time">20 days ago</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt.</p>
                                                    <div class="controls">
                                                        <div class="like-count">
                                                            <i data-feather="thumbs-up"></i>
                                                            <span>5</span>
                                                        </div>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Right side dropdown -->
                                                <div class="media-right">
                                                    <div class="dropdown is-spaced is-right is-neutral dropdown-trigger">
                                                        <div>
                                                            <div class="button">
                                                                <i data-feather="more-vertical"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-menu" role="menu">
                                                            <div class="dropdown-content">
                                                                <a class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="x"></i>
                                                                        <div class="media-content">
                                                                            <h3>Hide</h3>
                                                                            <small>Hide this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <i data-feather="flag"></i>
                                                                        <div class="media-content">
                                                                            <h3>Report</h3>
                                                                            <small>Report this comment.</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Comment -->

                                            <!-- Load More comments -->
                                            <div class="load-more has-text-centered">
                                                <button class="load-more-button">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /Comments body -->

                                        <!-- Comments footer -->
                                        <div class="card-footer">
                                            <div class="media post-comment has-emojis">
                                                <!-- Textarea -->
                                                <div class="media-content">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea comment-textarea" rows="5" placeholder="Write a comment..."></textarea>
                                                        </p>
                                                    </div>
                                                    <!-- Additional actions -->
                                                    <div class="actions">
                                                        <div class="image is-32x32">
                                                            <img class="is-rounded" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" data-user-popover="0" alt="">
                                                        </div>
                                                        <div class="toolbar">
                                                            <div class="action is-auto">
                                                                <i data-feather="at-sign"></i>
                                                            </div>
                                                            <div class="action is-emoji">
                                                                <i data-feather="smile"></i>
                                                            </div>
                                                            <div class="action is-upload">
                                                                <i data-feather="camera"></i>
                                                                <input type="file">
                                                            </div>
                                                            <a class="button is-solid primary-button raised">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Comments footer -->
                                    </div>
                                    <!-- /Comments -->
                                </div>
                                <!-- /Post -->
                            </div>
                            <!-- /timeline POST #7 -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profile page main wrapper -->

        </div>
        <!-- /Container -->

         <!-- Change cover edit profile modal -->
        <!--html/partials/pages/profile/timeline/modals/change-cover-modal.html-->
        <div id="change-edit-profile" class="modal change-cover-modal is-medium has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Edit Prfile</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div id="signup-panel-1" class="process-panel-wrap is-active step1" style="padding: 20px 25px;">
					<form>
						<div class="form-panel">
							<div class="field">
								<!-- <label>First Name</label> -->
								<div class="control">
									<input type="text" class="input" name="firstname" id="first_name" placeholder="Enter your first name">
								</div>
							</div>
							<div class="field">
								<!-- <label>Last Name</label> -->
								<div class="control">
									<input type="text" class="input" name="lastname" placeholder="Enter your last name">
								</div>
							</div>
							<div class="field">
								<!-- <label>Website</label> -->
								<div class="control">
									<input type="text" class="input" name="web" id="web" placeholder="Enter Website Url">
								</div>
							</div>
							<div class="field">
								<!-- <label>Location</label> -->
								<div class="control">
									<input type="text" class="input" name="location" id="location" placeholder="Enter location">
								</div>
							</div>
							<div class="field">
								<!-- <label>Email</label> -->
								<div class="control">
									<input type="text" class="input" name="email"  id="reg_email" placeholder="Enter your email address">
								</div>
							</div> 
							<div class="field">
								<!-- <label>Bio</label> -->
								<div class="control">
									<input type="text" class="input" name="bio" placeholder="Enter Bio">
								</div>
							</div> 
						</div> 
					</form>
                </div> 
                </div>

            </div>
        </div>

        <!-- Change cover image modal -->
        <!--html/partials/pages/profile/timeline/modals/change-cover-modal.html-->
        <div id="change-cover-modal" class="modal change-cover-modal is-medium has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Update Cover</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Placeholder -->
                        <div class="selection-placeholder">
                            <div class="columns">
                                <div class="column is-6">
                                    <!-- Selection box -->
                                    <div class="selection-box modal-trigger" data-modal="upload-crop-cover-modal">
                                        <div class="box-content">
                                            <img src="assets/img/illustrations/profile/upload-cover.svg" alt="">
                                            <div class="box-text">
                                                <span>Upload</span>
                                                <span>From your computer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <!-- Selection box -->
                                    <div class="selection-box modal-trigger" onClick="alert('Are you sure you want to delete?')">
                                        <div class="box-content">
                                            <img src="assets/img/illustrations/profile/change-cover.svg" alt="">
                                            <div class="box-text" >
                                                <span>Remove</span>
                                                <span>Cover Photo</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Change profile pic modal -->
        <!--html/partials/pages/profile/timeline/modals/change-profile-pic-modal.html--> 
        <div id="change-profile-modal" class="modal change-cover-modal is-medium has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Update Profile Photo</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Placeholder -->
                        <div class="selection-placeholder">
                            <div class="columns">
                                <div class="column is-6">
                                    <!-- Selection box -->
                                    <div class="selection-box modal-trigger" data-modal="upload-crop-profile-modal">
                                        <div class="box-content">
                                            <img src="assets/img/illustrations/profile/upload-cover.svg" alt="">
                                            <div class="box-text">
                                                <span>Upload</span>
                                                <span>From your computer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <!-- Selection box -->
                                    <div class="selection-box modal-trigger" onClick="alert('Are you sure you want to delete?')">
                                        <div class="box-content">
                                            <img src="assets/img/illustrations/profile/change-cover.svg" alt="">
                                            <div class="box-text" >
                                                <span>Remove</span>
                                                <span>Profile Photo</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- User photos and albums -->
        <!--html/partials/pages/profile/timeline/modals/user-photos-modal.html-->
        <div id="user-photos-modal" class="modal user-photos-modal is-medium has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">
                <!-- Card -->
                <div class="card">
                    <div class="card-heading">
                        <h3>Choose a picture</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Tabs -->
                        <div class="nav-tabs-wrapper">
                            <div class="tabs">
                                <ul class="is-faded">
                                    <li class="is-active" data-tab="recent-photos"><a>Recent</a></li>
                                    <li data-tab="all-photos"><a>Photos</a></li>
                                    <li data-tab="photo-albums"><a>Albums</a></li>
                                </ul>
                            </div>

                            <!-- Recent Photos -->
                            <div id="recent-photos" class="tab-content has-slimscroll-md is-active">
                                <!-- Grid -->
                                <div class="image-grid">
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/9.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/13.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/11.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/17.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/8.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/21.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- All photos -->
                            <div id="all-photos" class="tab-content has-slimscroll-md">
                                <!-- Grid -->
                                <div class="image-grid">
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/25.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/23.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/28.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/34.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/27.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/30.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/26.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/29.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/17.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/11.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/24.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/31.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/33.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/35.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Load more images -->
                                <div class=" load-more-wrap has-text-centered">
                                    <a href="#" class="load-more-button">Load More</a>
                                </div>
                                <!-- /Load more images -->
                            </div>

                            <!-- Albums -->
                            <div id="photo-albums" class="tab-content has-slimscroll-md">
                                <!-- Grid -->
                                <div class="albums-grid">
                                    <div class="columns is-multiline">
                                        <!-- Album item -->
                                        <div class="column is-6">
                                            <div class="album-wrapper" data-album="album-photos-1">
                                                <div class="album-image">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/35.jpg" alt="">
                                                </div>
                                                <div class="album-meta">
                                                    <div class="album-title">
                                                        <span>Design and Colors</span>
                                                        <span>Added on sep 06 2018</span>
                                                    </div>
                                                    <div class="image-count">
                                                        <i data-feather="image"></i>
                                                        <span>8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Album item -->
                                        <div class="column is-6">
                                            <div class="album-wrapper" data-album="album-photos-2">
                                                <div class="album-image">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                </div>
                                                <div class="album-meta">
                                                    <div class="album-title">
                                                        <span>Friends and Family</span>
                                                        <span>Added on jun 10 2016</span>
                                                    </div>
                                                    <div class="image-count">
                                                        <i data-feather="image"></i>
                                                        <span>29</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Album item -->
                                        <div class="column is-6">
                                            <div class="album-wrapper" data-album="album-photos-3">
                                                <div class="album-image">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                </div>
                                                <div class="album-meta">
                                                    <div class="album-title">
                                                        <span>Trips and Travel</span>
                                                        <span>Added on feb 14 2017</span>
                                                    </div>
                                                    <div class="image-count">
                                                        <i data-feather="image"></i>
                                                        <span>12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Album item -->
                                        <div class="column is-6">
                                            <div class="album-wrapper" data-album="album-photos-4">
                                                <div class="album-image">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                </div>
                                                <div class="album-meta">
                                                    <div class="album-title">
                                                        <span>Summer 2017</span>
                                                        <span>Added on aug 23 2017</span>
                                                    </div>
                                                    <div class="image-count">
                                                        <i data-feather="image"></i>
                                                        <span>32</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Album item -->
                                        <div class="column is-6">
                                            <div class="album-wrapper" data-album="album-photos-5">
                                                <div class="album-image">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                </div>
                                                <div class="album-meta">
                                                    <div class="album-title">
                                                        <span>Winter 2017</span>
                                                        <span>Added on jan 07 2017</span>
                                                    </div>
                                                    <div class="image-count">
                                                        <i data-feather="image"></i>
                                                        <span>7</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Album item -->
                                        <div class="column is-6">
                                            <div class="album-wrapper" data-album="album-photos-6">
                                                <div class="album-image">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                </div>
                                                <div class="album-meta">
                                                    <div class="album-title">
                                                        <span>Thanksgiving 2017</span>
                                                        <span>Added on nov 30 2017</span>
                                                    </div>
                                                    <div class="image-count">
                                                        <i data-feather="image"></i>
                                                        <span>6</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Grid | Design and colors -->
                                <div id="album-photos-1" class="album-image-grid is-hidden">
                                    <div class="album-info">
                                        <h4>Design and Colors | <small>8 photo(s)</small></h4>
                                        <a class="close-nested-photos">Go Back</a>
                                    </div>
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/35.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/17.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/30.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/28.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/27.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/26.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Load more images -->
                                    <div class=" load-more-wrap has-text-centered">
                                        <a href="#" class="load-more-button">Load More</a>
                                    </div>
                                    <!-- /Load more images -->
                                </div>

                                <!-- Hidden Grid | Friends and Family -->
                                <div id="album-photos-2" class="album-image-grid is-hidden">
                                    <div class="album-info">
                                        <h4>Friends and Family | <small>29 photo(s)</small></h4>
                                        <a class="close-nested-photos">Go Back</a>
                                    </div>
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/23.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/21.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/38.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/36.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/37.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Load more images -->
                                    <div class=" load-more-wrap has-text-centered">
                                        <a href="#" class="load-more-button">Load More</a>
                                    </div>
                                    <!-- /Load more images -->
                                </div>

                                <!-- Hidden Grid | Trips and Travel -->
                                <div id="album-photos-3" class="album-image-grid is-hidden">
                                    <div class="album-info">
                                        <h4>Trips and Travel | <small>12 photo(s)</small></h4>
                                        <a class="close-nested-photos">Go Back</a>
                                    </div>
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/6.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/5.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/38.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/37.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Grid | Summer 2017 -->
                                <div id="album-photos-4" class="album-image-grid is-hidden">
                                    <div class="album-info">
                                        <h4>Summer 2017 | <small>32 photo(s)</small></h4>
                                        <a class="close-nested-photos">Go Back</a>
                                    </div>
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/4.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/6.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/5.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/38.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/37.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/18.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/3.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/32.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Load more images -->
                                    <div class=" load-more-wrap has-text-centered">
                                        <a href="#" class="load-more-button">Load More</a>
                                    </div>
                                    <!-- /Load more images -->
                                </div>

                                <!-- Hidden Grid | Winter 2017 -->
                                <div id="album-photos-5" class="album-image-grid is-hidden">
                                    <div class="album-info">
                                        <h4>Winter 2017 | <small>7 photo(s)</small></h4>
                                        <a class="close-nested-photos">Go Back</a>
                                    </div>
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/24.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/36.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/25.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/8.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/12.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Grid | Thanksgiving 2017 -->
                                <div id="album-photos-6" class="album-image-grid is-hidden">
                                    <div class="album-info">
                                        <h4>Thanksgiving 2017 | <small>6 photo(s)</small></h4>
                                        <a class="close-nested-photos">Go Back</a>
                                    </div>
                                    <div class="columns is-multiline">
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/23.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/22.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/19.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/20.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/2.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid item -->
                                        <div class="column is-4">
                                            <div class="grid-image">
                                                <input type="radio" name="selected_photos">
                                                <div class="inner">
                                                    <img src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/21.jpg" alt="">
                                                    <div class="inner-overlay"></div>
                                                    <div class="indicator gelatine">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="button is-solid accent-button replace-button is-disabled">Use Picture</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Profile picture crop modal -->
        <!--html/partials/pages/profile/timeline/modals/upload-crop-profile-modal.html-->
        <div id="upload-crop-profile-modal" class="modal upload-crop-profile-modal is-xsmall has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Upload Picture</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <label class="profile-uploader-box" for="upload-profile-picture">
                            <span class="inner-content">
                                    <img src="assets/img/illustrations/profile/add-profile.svg" alt="">
                                    <span>Click here to <br>upload a profile picture</span>
                            </span>
                            <input type="file" id="upload-profile-picture" accept="image/*">
                        </label>
                        <div class="upload-demo-wrap is-hidden">
                            <div id="upload-profile"></div>
                            <div class="upload-help">
                                <a id="profile-upload-reset" class="profile-reset is-hidden">Reset Picture</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="submit-profile-picture" class="button is-solid accent-button is-fullwidth raised is-disabled">Use Picture</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Cover image crop modal -->
        <!--html/partials/pages/profile/timeline/modals/upload-crop-cover-modal.html-->
        <div id="upload-crop-cover-modal" class="modal upload-crop-cover-modal is-large has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <h3>Upload Cover</h3>
                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <label class="cover-uploader-box" for="upload-cover-picture">
                            <span class="inner-content">
                                    <img src="assets/img/illustrations/profile/add-cover.svg" alt="">
                                    <span>Click here to <br>upload a cover image</span>
                            </span>
                            <input type="file" id="upload-cover-picture" accept="image/*">
                        </label>
                        <div class="upload-demo-wrap is-hidden">
                            <div id="upload-cover"></div>
                            <div class="upload-help">
                                <a id="cover-upload-reset" class="cover-reset is-hidden">Reset Picture</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="submit-cover-picture" class="button is-solid accent-button is-fullwidth raised is-disabled">Use
                            Picture</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Share modal -->
        <!-- /partials/pages/feed/modals/share-modal.html -->
        <div id="share-modal" class="modal share-modal is-xsmall has-light-bg">
            <div class="modal-background"></div>
            <div class="modal-content">

                <div class="card">
                    <div class="card-heading">
                        <div class="dropdown is-primary share-dropdown">
                            <div>
                                <div class="button">
                                    <i class="mdi mdi-format-float-left"></i> <span>Share in your feed</span> <i
                                            data-feather="chevron-down"></i>
                                </div>
                            </div>
                            <div class="dropdown-menu" role="menu">
                                <div class="dropdown-content">
                                    <div class="dropdown-item" data-target-channel="feed">
                                        <div class="media">
                                            <i class="mdi mdi-format-float-left"></i>
                                            <div class="media-content">
                                                <h3>Share in your feed</h3>
                                                <small>Share this publication on your feed.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-item" data-target-channel="friend">
                                        <div class="media">
                                            <i class="mdi mdi-account-heart"></i>
                                            <div class="media-content">
                                                <h3>Share in a friend's feed</h3>
                                                <small>Share this publication on a friend's feed.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-item" data-target-channel="group">
                                        <div class="media">
                                            <i class="mdi mdi-account-group"></i>
                                            <div class="media-content">
                                                <h3>Share in a group</h3>
                                                <small>Share this publication in a group.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-item" data-target-channel="page">
                                        <div class="media">
                                            <i class="mdi mdi-file-document-box"></i>
                                            <div class="media-content">
                                                <h3>Share in a page</h3>
                                                <small>Share this publication in a page.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="dropdown-divider">
                                    <div class="dropdown-item" data-target-channel="private-message">
                                        <div class="media">
                                            <i class="mdi mdi-email-plus"></i>
                                            <div class="media-content">
                                                <h3>Share in message</h3>
                                                <small>Share this publication in a private message.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Close X button -->
                        <div class="close-wrap">
                            <span class="close-modal">
                                    <i data-feather="x"></i>
                                </span>
                        </div>
                    </div>
                    <div class="share-inputs">
                        <div class="field is-autocomplete">
                            <div id="share-to-friend" class="control share-channel-control is-hidden">
                                <input id="share-with-friend" type="text" class="input is-sm no-radius share-input simple-users-autocpl" placeholder="Your friend's name">
                                <div class="input-heading">
                                    Friend :
                                </div>
                            </div>
                        </div>

                        <div class="field is-autocomplete">
                            <div id="share-to-group" class="control share-channel-control is-hidden">
                                <input id="share-with-group" type="text" class="input is-sm no-radius share-input simple-groups-autocpl" placeholder="Your group's name">
                                <div class="input-heading">
                                    Group :
                                </div>
                            </div>
                        </div>

                        <div id="share-to-page" class="control share-channel-control no-border is-hidden">
                            <div class="page-controls">
                                <div class="page-selection">

                                    <div class="dropdown is-accent page-dropdown">
                                        <div>
                                            <div class="button page-selector">
                                                <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/hanzo.svg" alt=""> <span>Css Ninja</span> <i
                                                        data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <div class="dropdown-item">
                                                    <div class="media">
                                                        <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/hanzo.svg" alt="">
                                                        <div class="media-content">
                                                            <h3>Css Ninja</h3>
                                                            <small>Share on Css Ninja.</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="dropdown-item">
                                                    <div class="media">
                                                        <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/icons/logos/nuclearjs.svg" alt="">
                                                        <div class="media-content">
                                                            <h3>NuclearJs</h3>
                                                            <small>Share on NuclearJs.</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="dropdown-item">
                                                    <div class="media">
                                                        <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/icons/logos/slicer.svg" alt="">
                                                        <div class="media-content">
                                                            <h3>Slicer</h3>
                                                            <small>Share on Slicer.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="alias">
                                    <img src="https://via.placeholder.com/150x150" data-demo-src="assets/img/avatars/jenna.png" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="field is-autocomplete">
                            <div id="share-to-private-message" class="control share-channel-control is-hidden">
                                <input id="share-with-private-message" type="text" class="input is-sm no-radius share-input simple-users-autocpl" placeholder="Message a friend">
                                <div class="input-heading">
                                    To :
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="control">
                            <textarea class="textarea comment-textarea" rows="1" placeholder="Say something about this ..."></textarea>
                            <button class="emoji-button">
                                <i data-feather="smile"></i>
                            </button>
                        </div>
                        <div class="shared-publication">
                            <div class="featured-image">
                                <img id="share-modal-image" src="https://via.placeholder.com/1600x900" data-demo-src="assets/img/demo/unsplash/1.jpg" alt="">
                            </div>
                            <div class="publication-meta">
                                <div class="inner-flex">
                                    <img id="share-modal-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" data-user-popover="1" alt="">
                                    <p id="share-modal-text">Yesterday with <a href="#">@Karen Miller</a> and <a href="#">@Marvin Stemperd</a> at the
                                        <a href="#">#Rock'n'Rolla</a> concert in LA. Was totally fantastic! People were really
                                        excited about this one!
                                    </p>
                                </div>
                                <div class="publication-footer">
                                    <div class="stats">
                                        <div class="stat-block">
                                            <i class="mdi mdi-earth"></i>
                                            <small>Public</small>
                                        </div>
                                        <div class="stat-block">
                                            <i class="mdi mdi-eye"></i>
                                            <small>163 views</small>
                                        </div>
                                    </div>
                                    <div class="publication-origin">
                                        <small>Friendkit.io</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bottom-share-inputs">

                        <div id="action-place" class="field is-autocomplete is-dropup is-hidden">
                            <div id="share-place" class="control share-bottom-channel-control">
                                <input type="text" class="input is-sm no-radius share-input simple-locations-autocpl" placeholder="Where are you?">
                                <div class="input-heading">
                                    Location :
                                </div>
                            </div>
                        </div>

                        <div id="action-tag" class="field is-autocomplete is-dropup is-hidden">
                            <div id="share-tags" class="control share-bottom-channel-control">
                                <input id="share-friend-tags-autocpl" type="text" class="input is-sm no-radius share-input" placeholder="Who are you with">
                                <div class="input-heading">
                                    Friends :
                                </div>
                            </div>
                            <div id="share-modal-tag-list" class="tag-list no-margin"></div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="action-wrap">
                            <div class="footer-action" data-target-action="tag">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <div class="footer-action" data-target-action="place">
                                <i class="mdi mdi-map-marker"></i>
                            </div>
                            <div class="footer-action dropdown is-spaced is-neutral dropdown-trigger is-up" data-target-action="permissions">
                                <div>
                                    <i class="mdi mdi-lock-clock"></i>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="globe"></i>
                                                <div class="media-content">
                                                    <h3>Public</h3>
                                                    <small>Anyone can see this publication.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="users"></i>
                                                <div class="media-content">
                                                    <h3>Friends</h3>
                                                    <small>only friends can see this publication.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="user"></i>
                                                <div class="media-content">
                                                    <h3>Specific friends</h3>
                                                    <small>Don't show it to some friends.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="lock"></i>
                                                <div class="media-content">
                                                    <h3>Only me</h3>
                                                    <small>Only me can see this publication.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-wrap">
                            <button type="button" class="button is-solid dark-grey-button close-modal">Cancel</button>
                            <button type="button" class="button is-solid primary-button close-modal">Publish</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="chat-wrapper">
        <div class="chat-inner">

            <!-- Chat top navigation -->
            <div class="chat-nav">
                <div class="nav-start">
                    <div class="recipient-block">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        </div>
                        <div class="username">
                            <span>Dan Walker</span>
                            <span><i data-feather="star"></i> <span>| Online</span></span>
                        </div>
                    </div>
                </div>
                <div class="nav-end">

                    <!-- Settings icon dropdown -->
                    <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                        <div>
                            <a class="chat-nav-item is-icon">
                                <i data-feather="settings"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="message-square"></i>
                                        <div class="media-content">
                                            <h3>Details</h3>
                                            <small>View this conversation's details.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="settings"></i>
                                        <div class="media-content">
                                            <h3>Preferences</h3>
                                            <small>Define your preferences.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="bell"></i>
                                        <div class="media-content">
                                            <h3>Notifications</h3>
                                            <small>Set notifications settings.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="bell-off"></i>
                                        <div class="media-content">
                                            <h3>Silence</h3>
                                            <small>Disable notifications.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="box"></i>
                                        <div class="media-content">
                                            <h3>Archive</h3>
                                            <small>Archive this conversation.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="trash-2"></i>
                                        <div class="media-content">
                                            <h3>Delete</h3>
                                            <small>Delete this conversation.</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-search">
                        <div class="control has-icon">
                            <input type="text" class="input" placeholder="Search messages">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="at-sign"></i>
                    </a>
                    <a class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="star"></i>
                    </a>

                    <!-- More dropdown -->
                    <div class="dropdown is-spaced is-neutral is-right dropdown-trigger">
                        <div>
                            <a class="chat-nav-item is-icon no-margin">
                                <i data-feather="more-vertical"></i>
                            </a>
                        </div>
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="#" class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="file-text"></i>
                                        <div class="media-content">
                                            <h3>Files</h3>
                                            <small>View all your files.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="users"></i>
                                        <div class="media-content">
                                            <h3>Users</h3>
                                            <small>View all users you're talking to.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="gift"></i>
                                        <div class="media-content">
                                            <h3>Daily bonus</h3>
                                            <small>Get your daily bonus.</small>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="download-cloud"></i>
                                        <div class="media-content">
                                            <h3>Downloads</h3>
                                            <small>See all your downloads.</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item">
                                    <div class="media">
                                        <i data-feather="life-buoy"></i>
                                        <div class="media-content">
                                            <h3>Support</h3>
                                            <small>Reach our support team.</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="chat-nav-item is-icon close-chat">
                        <i data-feather="x"></i>
                    </a>
                </div>
            </div>
            <!-- Chat sidebar -->
            <div id="chat-sidebar" class="users-sidebar">
                <!-- Header -->
                <div class="header-item">
                    <img class="light-image" src="assets/img/logo/friendkit-bold.svg" alt="">
                    <img class="dark-image" src="assets/img/logo/friendkit-white.svg" alt="">
                </div>
                <!-- User list -->
                <div class="conversations-list has-slimscroll-xs">
                    <!-- User -->
                    <div class="user-item is-active" data-chat-user="dan" data-full-name="Dan Walker" data-status="Online">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                            <div class="user-status is-online"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="stella" data-full-name="Stella Bergmann" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="daniel" data-full-name="Daniel Wellington" data-status="Away">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                            <div class="user-status is-away"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="david" data-full-name="David Kim" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="edward" data-full-name="Edward Mayers" data-status="Online">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                            <div class="user-status is-online"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="elise" data-full-name="Elise Walker" data-status="Away">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                            <div class="user-status is-away"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="nelly" data-full-name="Nelly Schwartz" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                    <!-- User -->
                    <div class="user-item" data-chat-user="milly" data-full-name="Milly Augustine" data-status="Busy">
                        <div class="avatar-container">
                            <img class="user-avatar" src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                            <div class="user-status is-busy"></div>
                        </div>
                    </div>
                </div>
                <!-- Add Conversation -->
                <div class="footer-item">
                    <div class="add-button modal-trigger" data-modal="add-conversation-modal"><i data-feather="user"></i></div>
                </div>
            </div>

            <!-- Chat body -->
            <div id="chat-body" class="chat-body is-opened">
                <!-- Conversation with Dan -->
                <div id="dan-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:03am</span>
                            <div class="message-text">Hi Jenna! I made a new design, and i wanted to show it to you.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:03am</span>
                            <div class="message-text">It's quite clean and it's inspired from Bulkit.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:12am</span>
                            <div class="message-text">Oh really??! I want to see that.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                        <div class="message-block">
                            <span>8:13am</span>
                            <div class="message-text">FYI it was done in less than a day.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:17am</span>
                            <div class="message-text">Great to hear it. Just send me the PSD files so i can have a look at it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:18am</span>
                            <div class="message-text">And if you have a prototype, you can also send me the link to it.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Stella -->
                <div id="stella-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>10:34am</span>
                            <div class="message-text">Hey Stella! Aren't we supposed to go the theatre after work?.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>10:37am</span>
                            <div class="message-text">Just remembered it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                        <div class="message-block">
                            <span>11:22am</span>
                            <div class="message-text">Yeah you always do that, forget about everything.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Daniel -->
                <div id="daniel-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Yesterday</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>3:24pm</span>
                            <div class="message-text">Daniel, Amanda told me about your issue, how can I help?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                        <div class="message-block">
                            <span>3:42pm</span>
                            <div class="message-text">Hey Jenna, thanks for answering so quickly. Iam stuck, i need a car.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                        <div class="message-block">
                            <span>3:43pm</span>
                            <div class="message-text">Can i borrow your car for a quick ride to San Fransisco? Iam running behind and
                                there' no train in sight.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with David -->
                <div id="david-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>12:34pm</span>
                            <div class="message-text">Damn you! Why would you even implement this in the game?.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>12:32pm</span>
                            <div class="message-text">I just HATE aliens.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:09pm</span>
                            <div class="message-text">C'mon, you just gotta learn the tricks. You can't expect aliens to behave like
                                humans. I mean that's how the mechanics are.</div>
                        </div>
                    </div>
                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:11pm</span>
                            <div class="message-text">I checked the replay and for example, you always get supply blocked. That's not
                                the right thing to do.</div>
                        </div>
                    </div>
                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>13:12pm</span>
                            <div class="message-text">I know but i struggle when i have to decide what to make from larvas.</div>
                        </div>
                    </div>
                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                        <div class="message-block">
                            <span>13:17pm</span>
                            <div class="message-text">Join me in game, i'll show you.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Edward -->
                <div id="edward-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Monday</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>4:55pm</span>
                            <div class="message-text">Hey Jenna, what's up?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>4:56pm</span>
                            <div class="message-text">Iam coming to LA tomorrow. Interested in having lunch?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:21pm</span>
                            <div class="message-text">Hey mate, it's been a while. Sure I would love to.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>5:27pm</span>
                            <div class="message-text">Ok. Let's say i pick you up at 12:30 at work, works?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:43pm</span>
                            <div class="message-text">Yup, that works great.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>5:44pm</span>
                            <div class="message-text">And yeah, don't forget to bring some of my favourite cheese cake.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                        <div class="message-block">
                            <span>5:27pm</span>
                            <div class="message-text">No worries</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Edward -->
                <div id="elise-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">September 28</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>11:53am</span>
                            <div class="message-text">Elise, i forgot my folder at your place yesterday.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>11:53am</span>
                            <div class="message-text">I need it badly, it's work stuff.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                        <div class="message-block">
                            <span>12:19pm</span>
                            <div class="message-text">Yeah i noticed. I'll drop it in half an hour at your office.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Nelly -->
                <div id="nelly-conversation" class="chat-body-inner has-slimscroll is-hidden">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">September 17</span>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:22pm</span>
                            <div class="message-text">So you watched the movie?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>8:22pm</span>
                            <div class="message-text">Was it scary?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                        <div class="message-block">
                            <span>9:03pm</span>
                            <div class="message-text">It was so frightening, i felt my heart was about to blow inside my chest.</div>
                        </div>
                    </div>
                </div>
                <!-- Conversation with Milly -->
                <div id="milly-conversation" class="chat-body-inner has-slimscroll">
                    <div class="date-divider">
                        <hr class="date-divider-line">
                        <span class="date-divider-text">Today</span>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:01pm</span>
                            <div class="message-text">Hello Jenna, did you read my proposal?</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:01pm</span>
                            <div class="message-text">Didn't hear from you since i sent it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:02pm</span>
                            <div class="message-text">Hello Milly, Iam really sorry, Iam so busy recently, but i had the time to read
                                it.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:04pm</span>
                            <div class="message-text">And what did you think about it?</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:05pm</span>
                            <div class="message-text">Actually it's quite good, there might be some small changes but overall it's
                                great.</div>
                        </div>
                    </div>

                    <div class="chat-message is-sent">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                        <div class="message-block">
                            <span>2:07pm</span>
                            <div class="message-text">I think that i can give it to my boss at this stage.</div>
                        </div>
                    </div>

                    <div class="chat-message is-received">
                        <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                        <div class="message-block">
                            <span>2:09pm</span>
                            <div class="message-text">Crossing fingers then</div>
                        </div>
                    </div>
                </div>
                <!-- Compose message area -->
                <div class="chat-action">
                    <div class="chat-action-inner">
                        <div class="control">
                            <textarea class="textarea comment-textarea" rows="1"></textarea>
                            <div class="dropdown compose-dropdown is-spaced is-accent is-up dropdown-trigger">
                                <div>
                                    <div class="add-button">
                                        <div class="button-inner">
                                            <i data-feather="plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="code"></i>
                                                <div class="media-content">
                                                    <h3>Code snippet</h3>
                                                    <small>Add and paste a code snippet.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="file-text"></i>
                                                <div class="media-content">
                                                    <h3>Note</h3>
                                                    <small>Add and paste a note.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="server"></i>
                                                <div class="media-content">
                                                    <h3>Remote file</h3>
                                                    <small>Add a file from a remote drive.</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item">
                                            <div class="media">
                                                <i data-feather="monitor"></i>
                                                <div class="media-content">
                                                    <h3>Local file</h3>
                                                    <small>Add a file from your computer.</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="chat-panel" class="chat-panel is-opened">
                <div class="panel-inner">
                    <div class="panel-header">
                        <h3>Details</h3>
                        <div class="panel-close">
                            <i data-feather="x"></i>
                        </div>
                    </div>

                    <!-- Dan details -->
                    <div id="dan-details" class="panel-body is-user-details">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/dan.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Dan Walker</h3>
                                <h4>IOS Developer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">WebSmash Inc.</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-school"></i>
                                    <div class="about-text">
                                        <span>Studied at</span>
                                        <span><a class="is-inverted" href="#">Riverdale University</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Stella details -->
                    <div id="stella-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Stella Bergmann</h3>
                                <h4>Shop Owner</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-purple">
                                    <div>
                                        <i class="mdi mdi-bomb"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-check-decagram"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Trending Fashions</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Oklahoma City</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Daniel details -->
                    <div id="daniel-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/daniel.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Daniel Wellington</h3>
                                <h4>Senior Executive</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-google-cardboard"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-pizza"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-linux"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-puzzle"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Peelman & Sons</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Los Angeles</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- David details -->
                    <div id="david-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/david.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>David Kim</h3>
                                <h4>Senior Developer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Frost Entertainment</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Chicago</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Edward details -->
                    <div id="edward-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/edward.jpeg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Edward Mayers</h3>
                                <h4>Financial analyst</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Brettmann Bank</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Santa Fe</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Elise details -->
                    <div id="elise-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/elise.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Elise Walker</h3>
                                <h4>Social influencer</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Social Media</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">London</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Nelly details -->
                    <div id="nelly-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/nelly.png" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Nelly Schwartz</h3>
                                <h4>HR Manager</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Carrefour</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Melbourne</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Milly details -->
                    <div id="milly-details" class="panel-body is-user-details is-hidden">
                        <div class="panel-body-inner">

                            <div class="subheader">
                                <div class="action-icon">
                                    <i class="mdi mdi-video"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-camera"></i>
                                </div>
                                <div class="action-icon">
                                    <i class="mdi mdi-microphone"></i>
                                </div>
                                <div class="dropdown details-dropdown is-spaced is-neutral is-right dropdown-trigger ml-auto">
                                    <div>
                                        <div class="action-icon">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="#" class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-content">
                                                        <h3>View profile</h3>
                                                        <small>View this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="mail"></i>
                                                    <div class="media-content">
                                                        <h3>Send message</h3>
                                                        <small>Send a message to the user's inbox.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="share-2"></i>
                                                    <div class="media-content">
                                                        <h3>Share profile</h3>
                                                        <small>Share this user's profile.</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <div class="media">
                                                    <i data-feather="x"></i>
                                                    <div class="media-content">
                                                        <h3>Block user</h3>
                                                        <small>Block this user permanently.</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="details-avatar">
                                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/milly.jpg" alt="">
                                <div class="call-me">
                                    <i class="mdi mdi-phone"></i>
                                </div>
                            </div>

                            <div class="user-meta has-text-centered">
                                <h3>Milly Augustine</h3>
                                <h4>Sales Manager</h4>
                            </div>

                            <div class="user-badges">
                                <div class="hexagon is-red">
                                    <div>
                                        <i class="mdi mdi-heart"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-green">
                                    <div>
                                        <i class="mdi mdi-dog"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-accent">
                                    <div>
                                        <i class="mdi mdi-flash"></i>
                                    </div>
                                </div>
                                <div class="hexagon is-blue">
                                    <div>
                                        <i class="mdi mdi-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="user-about">
                                <label>About Me</label>
                                <div class="about-block">
                                    <i class="mdi mdi-domain"></i>
                                    <div class="about-text">
                                        <span>Works at</span>
                                        <span><a class="is-inverted" href="#">Salesforce</a></span>
                                    </div>
                                </div>
                                <div class="about-block">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div class="about-text">
                                        <span>From</span>
                                        <span><a class="is-inverted" href="#">Seattle</a></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add-conversation-modal" class="modal add-conversation-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3>New Conversation</h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                                <i data-feather="x"></i>
                            </span>
                    </div>
                </div>
                <div class="card-body">

                    <img src="assets/img/icons/chat/bubbles.svg" alt="">

                    <div class="field is-autocomplete">
                        <div class="control has-icon">
                            <input type="text" class="input simple-users-autocpl" placeholder="Search a user">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="help-text">
                        Select a user to start a new conversation. You'll be able to add other users later.
                    </div>

                    <div class="action has-text-centered">
                        <button type="button" class="button is-solid accent-button raised">Start conversation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="explorer-menu">
        <div class="explorer-inner">
            <div class="explorer-container">
                <!--Header-->
                <div class="explorer-header">
                    <h3>Explore</h3>
                    <div class="control">
                        <input type="text" class="input is-rounded is-fade" placeholder="Filter">
                        <div class="form-icon">
                            <i data-feather="filter"></i>
                        </div>
                    </div>
                </div>
                <!--List-->
                <div class="explore-list has-slimscroll">
                    <!--item-->
                    <a href="/navbar-v1-feed.html" class="explore-item">
                        <img src="assets/img/icons/explore/clover.svg" alt="">
                        <h4>Feed</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-profile-friends.html" class="explore-item">
                        <img src="assets/img/icons/explore/friends.svg" alt="">
                        <h4>Friends</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-videos-home.html" class="explore-item">
                        <img src="assets/img/icons/explore/videos.svg" alt="">
                        <h4>Videos</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-pages-main.html" class="explore-item">
                        <img src="assets/img/icons/explore/tag-euro.svg" alt="">
                        <h4>Pages</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-ecommerce-products.html" class="explore-item">
                        <img src="assets/img/icons/explore/cart.svg" alt="">
                        <h4>Commerce</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-groups.html" class="explore-item">
                        <img src="assets/img/icons/explore/house.svg" alt="">
                        <h4>Interests</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-stories-main.html" class="explore-item">
                        <img src="assets/img/icons/explore/chrono.svg" alt="">
                        <h4>Stories</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-questions-home.html" class="explore-item">
                        <img src="assets/img/icons/explore/question.svg" alt="">
                        <h4>Questions</h4>
                    </a>
                    <!--item-->
                    <a href="news.html" class="explore-item">
                        <img src="assets/img/icons/explore/news.svg" alt="">
                        <h4>News</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-groups.html" class="explore-item">
                        <img src="assets/img/icons/explore/cake.svg" alt="">
                        <h4>Groups</h4>
                    </a>
                    <!--item-->
                    <a href="https://envato.com" class="explore-item">
                        <img src="assets/img/icons/explore/envato.svg" alt="">
                        <h4>Envato</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-events.html" class="explore-item">
                        <img src="assets/img/icons/explore/calendar.svg" alt="">
                        <h4>Events</h4>
                    </a>
                    <!--item-->
                    <a href="https://cssninja.io" target="_blank" class="explore-item">
                        <img src="assets/img/icons/explore/pin.svg" alt="">
                        <h4>Css Ninja</h4>
                    </a>
                    <!--item-->
                    <a href="/elements.html" class="explore-item">
                        <img src="assets/img/icons/explore/idea.svg" alt="">
                        <h4>Elements</h4>
                    </a>
                    <!--item-->
                    <a href="/navbar-v1-settings.html" class="explore-item">
                        <img src="assets/img/icons/explore/settings.svg" alt="">
                        <h4>Settings</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="end-tour-modal" class="modal end-tour-modal is-xsmall has-light-bg">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="card">
                <div class="card-heading">
                    <h3></h3>
                    <!-- Close X button -->
                    <div class="close-wrap">
                        <span class="close-modal">
                                <i data-feather="x"></i>
                            </span>
                    </div>
                </div>
                <div class="card-body has-text-centered">

                    <div class="image-wrap">
                        <img src="assets/img/logo/friendkit.svg" alt="">
                    </div>

                    <h3>That's all folks!</h3>
                    <p>Thanks for taking the friendkit tour. There are still tons of other features for you to discover!</p>

                    <div class="action">
                        <a href="/#demos-section" class="button is-solid accent-button raised is-fullwidth">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Concatenated js plugins and jQuery -->
    <script src="assets/js/app.js"></script>
    <!-- <script src="https://js.stripe.com/v3/"></script> -->
    <script src="assets/data/tipuedrop_content.js"></script>

    <!-- Core js -->
    <script src="assets/js/global.js"></script>

    <!-- Navigation options js -->
    <script src="assets/js/navbar-v1.js"></script>
    <script src="assets/js/navbar-v2.js"></script>
    <script src="assets/js/navbar-mobile.js"></script>
    <script src="assets/js/navbar-options.js"></script>
    <script src="assets/js/sidebar-v1.js"></script>

    <!-- Core instance js -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/touch.js"></script>
    <script src="assets/js/tour.js"></script>

    <!-- Components js -->
    <script src="assets/js/explorer.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/modal-uploader.js"></script>
    <script src="assets/js/popovers-users.js"></script>
    <script src="assets/js/popovers-pages.js"></script>
    <script src="assets/js/lightbox.js"></script>

    <!-- Landing page js -->

    <!-- Signup page js -->

    <!-- Feed pages js -->
    <script src="assets/js/feed.js"></script>

    <!-- profile js -->
    <script src="assets/js/profile.js"></script>

    <!-- stories js -->

    <!-- friends js -->

    <!-- questions js -->

    <!-- video js -->

    <!-- events js -->

    <!-- news js -->

    <!-- shop js -->

    <!-- inbox js -->

    <!-- settings js -->

    <!-- map page js -->

    <!-- elements page js -->
</body>

</html>