<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <!-- <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">info@firstentry.net</a>
            <i class="bi bi-phone-fill phone-icon"></i> +1 210 995 1253 -->
        </div>
        <!--
        <div class="social-links d-none d-md-block">
          <a href="http://instagram.com/_u/first.entry/" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>
        -->
    </div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('index') }}" class="logo"><img src="{{ url('assets/images/public/logo.png') }}" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('event-lottery') }}">Event / Lottery System</a></li>
                <li><a class="nav-link scrollto" href="{{ url('/') }}#contact">Contact</a></li>
                <li><a href="{{ route('user.login') }}">Login</a></li>
                <li><a class="cta-btn" href="" data-bs-toggle="modal" data-bs-target="#demoModal">Request DEMO</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
