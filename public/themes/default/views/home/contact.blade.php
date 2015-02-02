<div id="page-content">
    <div class="container">
        <div class="page-content">
            <div class="contact-us">
                <div class="row">
                    <div class="col-md-6">
                        <h3><strong>Our</strong> Hq</h3>

                        <div class="contacy-us-map-section">
                            <div id="contact_map_canvas">

                            </div>
                        </div> <!-- end .map-section -->

                        <div class="row">
                            <div class="col-sm-6">
                                <h5>Address Details</h5>

                                <div class="address-details clearfix">
                                    <i class="fa fa-map-marker"></i>

                                    <p>
                                        <span>39B, Jalan Kuning 2,</span>
                                        <span>Taman Perlangi,</span>
                                        <span>80400 Johor Bahru,</span>
                                        <span>Johor, Malaysia</span>
                                    </p>
                                </div>

                                <div class="address-details clearfix">
                                    <i class="fa fa-phone"></i>

                                    <p>
                                        <span><strong>Phone:</strong> +1 123-456-7890</span>
                                        <span><strong>Fax:</strong> +1 123-456-7891</span>
                                    </p>
                                </div>

                                <div class="address-details clearfix">
                                    <i class="fa fa-envelope-o"></i>

                                    <p>
                                        <span><strong>E-mail:</strong> shawn@wirednest.com</span>
                                        <span><span><strong>Website:</strong> www.wirednest.com</span></span>
                                    </p>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <h5>Openig Hours</h5>

                                <div class="address-details clearfix">
                                    <i class="fa fa-clock-o"></i>

                                    <p>
                                        <span><strong>Mo-Fri:</strong> 9AM - 5PM</span>
                                        <span><span><strong>Saturday:</strong> 10AM - 2PM</span></span>
                                        <span><strong>Sunday:</strong> Closed</span>
                                    </p>
                                </div>

                            </div>
                        </div> <!-- end .nasted row -->

                    </div> <!-- end main grid layout -->

                    <div class="col-md-6">
                        <h3><strong>Message</strong> Us</h3>

                        <div class="contact-form">
                            <form action="#" class="comment-form">

                                <input type="text" placeholder="Name" required>

                                <input type="email" placeholder="Email" required>

                                <input type="text" placeholder="Website">

                                <input type="text" placeholder="Subject">

                                <textarea placeholder="How Can We Help You?" required></textarea>

                                <a class="btn btn-default" href="#"><i class="fa fa-envelope-o"></i>Send Message</a>

                            </form>

                        </div> <!-- end .contact-form -->

                    </div> <!-- end main grid layout -->
                </div> <!-- end .row -->

            </div> <!-- end .about-us -->
        </div> <!-- end .page-content -->
    </div> <!-- end .container -->

</div> <!-- end #page-content -->
<script>
    $(document).ready(function(){
        $("#contact_map_canvas").goMap({
            maptype: 'ROADMAP',
            zoom: 15,
            scrollwheel: false,

            markers: [{
                address : '39B, Jalan Kuning 2,Taman Perlangi,80400 Johor Bahru,Johor, Malaysia',
                icon: '{{URL::to("/themes/default/assets")}}/img/content/map-marker-company.png',
                html: 'WN Directory'
            }]
        });
    })
</script>