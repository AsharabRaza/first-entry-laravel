@extends('FrontEnd.layouts.template')

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative text-center" data-aos="fade-up" data-aos-delay="500">
            <h1>Powerful Features for Creating and Organizing entry for <strong id="spin" class="text-danger"></strong> </h1>
            <h2>One platform for all of your interactive content needs. If you can dream it, we probably build features that let you easily do it </h2>
        </div>
    </section><!-- End Hero -->

    <main id="main">


        <!-- ======= Services Section ======= -->
        <section id="services" class="services bg-white">
            <div class="container">

                <div class="section-title">
                    <span>Services</span>
                    <h2>Services</h2>
                    <p>Some of our services</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="icon-box w-100">
                            <div class="icon"><i class="bx bx-credit-card-front"></i></div>
                            <h4><a href="javascript:void(0);">Lottery System</a></h4>
                            <p class="overlay">
                        <span class="service-box">
                            The user creates a lottery with all the lottery functions and options following our step-by-step template system.
                        </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex align-items-stretch" data-aos="fade-up">
                        <div class="icon-box w-100">
                            <div class="icon"><i class="bx bx-credit-card-front"></i></div>
                            <h4><a href="javascript:void(0);">Movie premier</a></h4>
                            <p class="overlay">
                        <span class="service-box">
                            Creating virtual tickets with built-in unique identifier number, and QR/Bar codes, allowing promotional partners such as radio and TV stations to give away the tickets.
                        </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
                        <div class="icon-box w-100">
                            <div class="icon"><i class="bx bx-video"></i></div>
                            <h4><a href="">Event organization</a></h4>
                            <p class="overlay">
                        <span class="service-box">
                            Create an online participation form or upload a guest list, determine the number of guests, determine the type of attire, and send email invitations with R.S.V.P. button.
                        </span>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Features Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <span>Features</span>
                    <h2>Features</h2>
                    <p>Some of our current and future features.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-file-edit"></i></div>
                                    <h4>Powerful algorithms</h4>
                                </div>
                                <div class="back">
                                    <p>Cloud-based backend server performs participants selection, randomization, queuing number assignments, QR/Bar code creation, and email creation, as well as provides a full array of analytical details.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-envelope"></i></div>
                                    <h4>Integrated email server and templates</h4>
                                </div>
                                <div class="back">
                                    <p>
                                        Participants receive pre-formatted emails:<br>
                                        <b>verification</b> email confirming participation
                                        <b>selected</b> verifying all details of the event
                                        <b>non-selected</b> thanking them for participation
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-users"></i></div>
                                    <h4>User dashboard</h4>
                                </div>
                                <div class="back">
                                    <p>The user accesses a password-controlled dashboard and controls all aspects of their event.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" >
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-table"></i></div>
                                    <h4>Templates for easy creation</h4>
                                </div>
                                <div class="back">
                                    <p>The User follows multiple templates to create an event.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-calendar"></i></div>
                                    <h4>Built in participant randomizer</h4>
                                </div>
                                <div class="back">
                                    <p>Platform automatically chooses the winner/s</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-link"></i></div>
                                    <h4>Custom URL for your event</h4>
                                </div>
                                <div class="back">
                                    <p>The user chooses the URL name for the event/lottery, allowing participants to enter the event/lottery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-calendar-week"></i></div>
                                    <h4>Start and finish times built in</h4>
                                </div>
                                <div class="back">
                                    <p>The user chooses the local time for the event/lottery entry form to be accessible by the participants.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-business-time"></i></div>
                                    <h4>Timezone selection of lottery</h4>
                                </div>
                                <div class="back">
                                    <p>The user chooses the local time for the event/lottery with our worldwide country and timezone drop-down menu. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" >
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-people-arrows"></i></div>
                                    <h4>Automatic queing number allocation</h4>
                                </div>
                                <div class="back">
                                    <p>Winning participants to event receive a queuing number to access event.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-person-booth"></i></div>
                                    <h4>Live entry process</h4>
                                </div>
                                <div class="back">
                                    <p>Using our built-in scanning system, an admin user can view the entry procedure in real-time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-envelope-open"></i></div>
                                    <h4>Email Analitics</h4>
                                </div>
                                <div class="back">
                                    <p> The platform provides information regarding email functions: sent, received, bounced, opened, and platform received.  </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-qrcode"></i></div>
                                    <h4>QR code creation</h4>
                                </div>
                                <div class="back">
                                    <p> Each user receives a unique QR, which allows a Verification agent to scan and process the participant's entry. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" >
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-user-shield"></i></div>
                                    <h4>Participant scanning system Built-in</h4>
                                </div>
                                <div class="back">
                                    <p> Our integrated scanning platform allows  selected agents to verify and scan participants into the event/lottery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-chart-line"></i></div>
                                    <h4>Event/Lottery Analitics</h4>
                                </div>
                                <div class="back">
                                    <p>The platform provides information regarding the event/lottery:  number of participants, number of arrivals, time of arrival, and Percentage of participants with guests.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <img src="{{ url('assets/images/public/coming-soon.jpg') }}" width="100px" class="coming-soon"/>
                                    <div class="icon"><i class="fas fa-barcode"></i></div>
                                    <h4>Bar code creation</h4>
                                </div>
                                <div class="back">
                                    <p> Each user receives a unique Bar code, which allows a Verification agent to scan and process the participant's entry. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <img src="{{ url('assets/images/public/coming-soon.jpg') }}" width="100px" class="coming-soon"/>
                                    <div class="icon"><i class="fas fa-comments"></i></div>
                                    <h4>SMS Server</h4>
                                </div>
                                <div class="back">
                                    <p>Provides a communication platform to advise participants of their entry status as well as last-minute changes for the event.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <img src="{{ url('assets/images/public/coming-soon.jpg') }}" width="100px" class="coming-soon"/>
                                    <div class="icon"><i class="fas fa-file-edit"></i></div>
                                    <h4>Landing Page</h4>
                                </div>
                                <div class="back">
                                    <p>The user creates a landing page for each event, informing the participants of details regarding the event and the link to participate.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">

                <div class="text-center">
                    <h3>Request for demo</h3>
                    <p>If you are interested in a demo, please send us an email, typicall demo is about 20 minutes. </p>
                    <a class="cta-btn" href="" data-bs-toggle="modal" data-bs-target="#demoModal">REQUEST DEMO</a>
                </div>
            </div>
        </section>
        <!-- End Cta Section -->

        <!-- ======= Usage Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <span>USAGE</span>
                    <h2>USAGE</h2>
                    <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                </div>
                <div class="row usage">
                    <div class="col-md-4">
                        <div>
                            <div class="icon">
                                <i class="bx bx-bookmark-plus"></i>
                            </div>
                            <h4>Venues</h4>
                            <p>Allowing venues to communicate & organize selected participants to an event. <span class="more d-none">Offering an online signup form created specifically for the event, FIRSTENTRY automatically randomizes all entries, selects the winners, and creates a winner and non-winner email.</span></p>
                            <a href="#" class="d-none text-danger fw-bold text-decoration-underline">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fas fa-handshake"></i></div>
                            <h4>Meet and greet</h4>
                            <p>Creating a lottery-based selection process, allowing interested participants to enter via an online form <span class="more d-none">with a custom URL, all participants selected and non-selected are advised on the status of their participation.  </span></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fab fa-product-hunt"></i></div>
                            <h4>Merchandise/products</h4>
                            <p>Creating a lottery-based selection process, allowing interested participants to enter a lottery in order to purchase <span class="more d-none">a limited item or win a certain promotional product.</span></p>
                        </div>
                    </div>
                </div>
                <div class="row usage mt-4">
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fas fa-credit-card"></i></div>
                            <h4>Corporate/Office Events</h4>
                            <p> Create an organizational style event, and communicate with the invited guests, the platform offers <span class="more d-none">an array of organizational tools: queuing arrival system, gifts giveaway lottery, and arrival instruction email. </span></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fas fa-calendar"></i></div>
                            <h4>Virtual events</h4>
                            <p>Create an organizational-style event, allowing interested participants to fill in the online form,  <span class="more d-none">communicate with the invited guests, screating a participation email with all instructions for the event. </span> </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fas fa-book-open-reader"></i></div>
                            <h4>Online courses/seminars</h4>
                            <p>Create an organizational-style event, allowing interested participants to fill in the online form, <span class="more d-none"> including a payment link, once each participant is approved, send email instructions for the event.</span> </p>
                        </div>
                    </div>
                </div>
                <div class="row usage mt-4  justify-content-center">
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fas fa-video"></i></div>
                            <h4>Movie premiers</h4>
                            <p> Creating virtual tickets with built-in unique identifier numbers and QR/Bar codes, the user defines  <span class="more d-none">the number of winning tickets, allowing promotional partners such as radio and TV stations to give away the tickets. The user creates a verification page allowing winners to enter their winning code and receive a virtual ticket via our email system. </span></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <div class="icon"><i class="fas fa-glass-cheers"></i></div>
                            <h4>Restaurant/Bars</h4>
                            <p>Create an organizational-style event for a limited space event, allowing interested participants to fill in the online form, <span class="more d-none">including an optional payment link, once each participant is randomly selected, FIRSTENTRY sends email confirmation with full instructions for the event.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <span>Contact</span>
                    <h2>Contact</h2>
                    <p>Please send us a message.</p>
                </div>

                <div class="row" data-aos="fade-up">

                    <div class="col-lg-8 offset-lg-2">
                        <form onsubmit="return sendContactInfo(this);" method="post" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">LOGIN</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Password</label>
                            <input type="password" class="form-control"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Login</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Register</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Address</label>
                            <input type="text" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Phone</label>
                            <input type="tel" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Email</label>
                            <input type="email" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Password</label>
                            <input type="password" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('FrontEnd/request_demo')

@endsection
@push('css')
@endpush

@push('js')
    <script>

        function sendContactInfo(form_data_obj)
        {
            let formData = new FormData(form_data_obj);
            formData.append('send_contact_info', true);
            formData.append('POST', true);
            $.ajax({
                url: '{{ route('contact-us') }}',
                type: 'post',
                data: formData,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                success: function (r) {
                     //r = JSON.parse(r);
                     //console.log(r);
                    // alert(r.msg);
                    if (r.success == true) {
                        // alert(r.msg);
                        $(form_data_obj)[0].reset();
                        $('#demoModal').modal('hide');
                        $('#thanksModal').modal('show');
                    }


                },
                error: function (error) {
                    console.log(error);

                }
            });

            return false;
        }
    </script>
@endpush
