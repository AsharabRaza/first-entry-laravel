@extends('FrontEnd.layouts.template')

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center" style="background: url('../assets/images/public/lottery-hero-bg.jpg') center center no-repeat; !important;">
        <div class="container position-relative text-center" data-aos="fade-up" data-aos-delay="500">
            <h1>Create events/lotteries in minutes</h1>
            <h2>Our easy online platform enables anyone on your team to create an event or lottery, with intuitive web-based editing tools, ready-made event and email templates.</h2>
            <h2>CREATE - ENGAGE - INFORM - MANAGE</h2>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Features Section ======= -->
        <section id="services" class="services bg-white">
            <div class="container">

                <div class="section-title">
                    <span>Features</span>
                    <h2>Features</h2>
                    <p>Some of our current and future features.</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-lock"></i></div>
                                    <h4>Secure </h4>
                                </div>
                                <div class="back">
                                    <p>Each user has their own unique login credentials.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-calendar"></i></div>
                                    <h4>Easy Event Customization</h4>
                                </div>
                                <div class="back">
                                    <p>Following our step by step template system.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-qrcode"></i></div>
                                    <h4>QR Code Generator</h4>
                                </div>
                                <div class="back">
                                    <p>Each participant will receive an email including scannable QR code.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" >
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-envelope"></i></div>
                                    <h4>Built-in email server </h4>
                                </div>
                                <div class="back">
                                    <p>The system generates emails automatically, with predefined information created by user.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-key"></i></div>
                                    <h4>UID generator</h4>
                                </div>
                                <div class="back">
                                    <p>Each participant receives a unique number for their participation in the event/lottery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-file-edit"></i></div>
                                    <h4>Lottery Algorithm</h4>
                                </div>
                                <div class="back">
                                    <p>The platform has a built in algorithm that shuffles all participants and chooses the winners based on the users parameters. </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-chart-line"></i></div>
                                    <h4>Event Analitycs</h4>
                                </div>
                                <div class="back">
                                    <p>Event analytics -  Lottery participants, winners and losers, % of participants bringing guests.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <div class="icon"><i class="fas fa-chart-line"></i></div>
                                    <h4>Email Analitycs</h4>
                                </div>
                                <div class="back">
                                    <p>The number of total emails sent, number of winners, and losers, received by the recipient, bounced, the platform opened (Chrome, Safari, web app)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Services Section -->


        <!-- pricing  -->
    </main><!-- End #main -->

    <!-- Pricing Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Send Us Email</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form onsubmit="return sendPlanEmail(this);">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="full_name" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Choose Package</label>
                            <select name="package" class="form-control">
                                <option >Select Package</option>
                                <option value="Basic">Basic</option>
                                <option value="Plus">Plus</option>
                                <option value="Super">Super</option>
                                <option value="Plantinum">Plantinum</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Phone Number</label>
                            <input type="tel" name="phone_number" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control"/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Describe Your Event</label>
                            <textarea rows="3" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label>Estimated number of partipants </label>
                            <input type="text" name="estimated_participants" class="form-control"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Send</button>
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
        $(document).ready(function() {
            $('.btn_open_plan_modal').click(function() {
                $('[name="package"]').val($(this).attr('data-plan-name'));
            });
        });

        function sendPlanEmail(form_data_obj)
        {
            let formData = new FormData(form_data_obj);
            formData.append('send_plan_email', true);
            formData.append('POST', true);
            $.ajax({
                url: "../core/lotteries.php",
                type: 'post',
                data: formData,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                success: function (r) {
                    // r = JSON.parse(r);
                    // alert(r.msg);
                    if (r.success == true)
                    {
                        // alert(r.msg);
                        $(form_data_obj)[0].reset();
                        $('#pricingModal').modal('hide');
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
