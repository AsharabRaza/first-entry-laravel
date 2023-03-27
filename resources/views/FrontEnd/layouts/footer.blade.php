<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <h3>First Entry</h3>
                        <!-- <p>
                          <strong>Phone:</strong> +1 210 995 1253<br>
                          <strong>Email:</strong> info@firstentry.net<br>
                        </p> -->
                        <!--
                        <div class="social-links mt-3">
                          <a href="http://instagram.com/_u/first.entry/"class="instagram"><i class="bx bxl-instagram"></i></a>
                        </div>
                        -->
                    </div>
                </div>
                <!--
              <div class="col-lg-4 d-flex justify-content-center col-md-6 footer-links">
                <div>
                  <h4>Useful Links</h4>
                  <ul class="text-center">
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-lg-4 d-flex justify-content-center col-md-6 footer-links">
                <div>
                  <h4>Our Services</h4>
                  <ul>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Lottery System</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Movie Premier</a></li>
                  </ul>
                </div>
              </div>
            -->
                <!--               <div class="col-lg-4 col-md-6 footer-newsletter">
                                <h4>Our Newsletter</h4>
                                <p>Join our newsletter for getting emails regarding new events and movie premiers</p>
                                <form action="" method="post">
                                  <input type="email" name="email"><input type="submit" value="Subscribe">
                                </form>

                              </div> -->

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>First Entry</span></strong>. All Rights Reserved
        </div>
    </div>
    </div>
</footer><!-- End Footer -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

{{ Html::script('assets/js/jquery.min.js') }}
{{ Html::script('FrontEnd/vendor/aos/aos.js') }}
{{ Html::script('FrontEnd/vendor/bootstrap/js/bootstrap.bundle.min.js') }}
{{ Html::script('FrontEnd/vendor/glightbox/js/glightbox.min.js') }}
{{ Html::script('FrontEnd/vendor/isotope-layout/isotope.pkgd.min.js') }}
{{ Html::script('FrontEnd/vendor/swiper/swiper-bundle.min.js') }}
{{ Html::script('FrontEnd/vendor/php-email-form/validate.js') }}
{{ Html::script('assets/js/public.js') }}

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@stack('js')


