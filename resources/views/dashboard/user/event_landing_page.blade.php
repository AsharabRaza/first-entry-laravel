<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>First Entry</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('user/images/favicon.png') }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    {{ Html::style('assets/plugin/bootstrap/css/bootstrap.min.css') }}
    {{ Html::style('assets/css/event.css') }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
</head>
<body>

<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.php"> {{ $data['user']->first_name . ' ' . $data['user']->last_name }} </a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#work">How it Works</a></li>
                <li><a class="nav-link scrollto " href="#future">Future Events</a></li>
                <li><a class="nav-link scrollto" href="#details">Details</a></li>

            </ul>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->

<section id="hero"
         style="background-image: url('../assets/images/media/{{ $data['event']->image }}');background-position: center;">
    <div class="hero-container">
        <h3>Welcome to </h3>
        <h1> {{ $data['event']->name }} </h1>
        <h2></h2>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
</section><!-- End Hero -->

<section class="about" id="about">
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="section-title">
                    <h2>About</h2>
                    <h3>Learn About <span>Event</span></h3>
                </div>
                <p> {{ $data['event']->about_event }}</p>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="../../assets/images/media/{{ $data['event']->about_event_image }}" width="300px"
                     height="300px"/>
            </div>
        </div>
    </div>
</section>
<section class="how-it-work bg-light" id="work">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2><strong>How it Works</strong></h2>
                </div>
                <p> {{ $data['event']->how_it_works }}</p>
            </div>
        </div>
    </div>
</section>
<section class="about" id="future">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="section-title text-center">
                    <h3>More Events from this <span>Organizer</span></h3>
                </div>
            </div>
        </div>
        <div class="row">


            @foreach($data['other_events'] as $event)
                <div class="col-md-3 mb-4">
    {{--                <a href="<?php echo '/public_pages/event-landing.php?event=' . $event['slug']?>" class="text-white">--}}
                    <a href="{{ route('user.event-landing',['event'=>$event->slug]) }}" class="text-white">
                        <img src="{{ url('assets/images/event-thumb.jpg') }}" width="100%" height="150px"/>
                        <table class="w-100 border bg-dark">
                            <tr>
                                <td class="w-25 border text-center"><strong><span
                                            class="text-light"> {{ date('F', strtotime($event->date)) }} </span><br>{{ date('d', strtotime($event->date)) }}
                                    </strong></td>
                                <td class="w-75 border text-center"> {{ $event->name }} </td>
                            </tr>
                        </table>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</section>
<section class="how-it-work bg-light" id="details">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2><strong>Event Details</strong></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <i class="fas fa-calendar-day mx-2"></i> Date
                    </div>
                    <div class="card-body text-center">
                        {{ $data['event']->date }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <span class="fas fa-clock mx-2"></span> Time
                    </div>
                    <div class="card-body text-center">
                        {{ $data['event']->time }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <span class="fas fa-map-marker-alt mx-2"></span> Location
                    </div>
                    <div class="card-body text-center">
                        {{ $data['event']->location }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="bg-dark py-2">
    <p class="text-center text-white">Copyright @ 2023</p>

</footer>
{{ Html::script('user/js/event.js?t='.rand(0,10000)) }}
{{ Html::script('assets/plugin/bootstrap/js/bootstrap.bundle.min.js') }}

</body>

</html>
