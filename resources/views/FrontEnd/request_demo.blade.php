

    <!-- Demo Modal -->
    <div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Request for Demo</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return sendRequestForDemo(this);" novalidate>
                        @csrf
                        <div class="alert" role="alert"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group mt-2">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group mt-2">
                                    <label>Phone</label>
                                    <input type="tel" name="phone_number" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group mt-2">
                                    <label>Country</label>
                                    <select class="form-control" name="country" required >
                                        <?php
                                          $countries = getCountriesNames();
                                          if (!empty($countries)){
                                            foreach ($countries as $key => $country):?>
                                             <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                                            <?php
                                            endforeach;
                                          }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group mt-2">
                                    <label>Usage</label>
                                    <select class="form-control" name="usage" required >
                                        <option>Select One </option>
                                        <option>Venues</option>
                                        <option>Meet and greet</option>
                                        <option>Merchandise/products</option>
                                        <option>Corporate/Office events</option>
                                        <option>Virtual events</option>
                                        <option>Online courses and seminar</option>
                                        <option>Movie premiers</option>
                                        <option>Restaurant/bars</option>
                                        <option>Others (Please Describe)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="description_section" style="display: none;">
                                <div class="form-group mt-2">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name="description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Thankyou Modal -->
    <div class="modal fade" id="thanksModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="thanks_icon">
                        <i class="fas fa-check "></i>
                    </div>
                    <h4 class="pt-4 my-4 fw-bold">Thank you!</h4>
                    <p class="my-3">For showing your interest in FirstEntry, we will respond as soon as posssible</p>
                    <button type="button" class="btn btn-danger my-4 btn-block col-md-8" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                $('[name="usage"]').change(function() {
                    if($(this).val() == 'Others (Please Describe)') {
                        $('#description_section').show();
                    } else {
                        $('#description_section').hide();
                    }
                });
            });

            function sendRequestForDemo(form_data_obj)
            {
                let formData = new FormData(form_data_obj);
                formData.append('send_request_for_demo', true);
                formData.append('POST', true);
                $.ajax({
                    url: '{{ route('request-demo') }}',
                    type: 'post',
                    data: formData,
                    cache: false,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function (r)
                    {
                        if (r.success == true)
                        {
                            // alert(r.msg);
                            $(form_data_obj)[0].reset();
                            $('#demoModal').modal('hide');
                            $('#thanksModal').modal('show');
                        }
                        else{
                            $('.alert').addClass('alert-danger');
                            $('.alert-danger').text(r.msg);
                            console.log(r);
                        }
                    },
                    error: function (error) {

                    }
                });

                return false;
            }
        </script>
    @endpush

