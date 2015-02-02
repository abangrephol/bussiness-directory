<header id="header">
<div class="header-top-bar">
    <div class="container">
        <!-- HEADER-LOGIN -->
        <div class="header-login">

            <a href="#" class=""><i class="fa fa-power-off"></i> Login</a>

            <div>
                <form action="#">
                    <input type="text" class="form-control" placeholder="Username">
                    <input type="password" class="form-control" placeholder="Password">
                    <input type="submit" class="btn btn-default" value="Login">
                    <a href="#" class="btn btn-link">Forgot Password?</a>
                </form>
            </div>

        </div> <!-- END .HEADER-LOGIN -->

        <!-- HEADER REGISTER -->
        <div class="header-register">
            <a href="#" class=""><i class="fa fa-plus-square"></i> Register</a>

            <div>
                <form action="#">
                    <input type="text" class="form-control" placeholder="Username">
                    <input type="email" class="form-control" placeholder="Email">
                    <input type="password" class="form-control" placeholder="Password">
                    <input type="submit" class="btn btn-default" value="Register">
                </form>
            </div>

        </div> <!-- END .HEADER-REGISTER -->

        <!-- HEADER-LOG0 -->
        <div class="header-logo text-center">
            <h2><a href="index.html">WN<i class="fa fa-globe"></i>DIRECTORY</a></h2>
        </div>
        <!-- END HEADER LOGO -->

        <!-- HEADER-SOCIAL -->
        <div class="header-social">
            <a href="#">
                <span><i class="fa fa-share-alt"></i></span>
                <i class="fa fa-chevron-down social-arrow"></i>
            </a>

            <ul class="list-inline">
                <li class="active"><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        <!-- END HEADER-SOCIAL -->

        <!-- HEADER-LANGUAGE -->
        <div class="header-language">
            <a href="#">
                <span>EN</span>
                <i class="fa fa-chevron-down"></i>
            </a>

            <ul class="list-unstyled">
                <li class="active"><a href="#">EN</a></li>
                <li><a href="#">FR</a></li>
                <li><a href="#">PT</a></li>
                <li><a href="#">IT</a></li>
            </ul>
        </div> <!-- END HEADER-LANGUAGE -->

        <!-- CALL TO ACTION -->
        <div class="header-call-to-action">
            <a href="#" class="btn btn-default"><i class="fa fa-plus"></i> Add Listing</a>
        </div><!-- END .HEADER-CALL-TO-ACTION -->

    </div><!-- END .CONTAINER -->
</div>
<!-- END .HEADER-TOP-BAR -->

<!-- HEADER SEARCH SECTION -->
<div class="header-search company-profile-height">
    <div class="header-search-bar">
        <form action="#">

            <div class="search-toggle">
                <div class="container">
                    <div class="distance-range">
                        <p>
                            <label for="amount-search">Distance:</label>
                            <input type="text" id="amount-search">
                        </p>

                        <div id="slider-range-search"></div>
                    </div>  <!-- end #distance-range -->

                    <div class="distance-range">
                        <p>
                            <label for="amount-search">Days published:</label>
                            <input type="text" id="amount-search-day">
                        </p>

                        <div id="slider-range-search-day"></div>
                    </div>  <!-- end #distance-range -->

                    <p>Location:</p>
                    <div class="select-country">
                        <select class="" data-placeholder="-Select Country-">
                            <option value="option1">option 1</option>
                            <option value="option2">option 2</option>
                            <option value="option3">option 3</option>
                        </select>
                    </div>

                    <div class="region">
                        <input type="text" placeholder="-Region-">
                    </div>

                    <div class="address">
                        <input type="text" placeholder="-Address-">
                    </div>

                    <div class="category-search">
                        <select class="" data-placeholder="-Select category-">
                            <option value="option1">option 1</option>
                            <option value="option2">option 2</option>
                            <option value="option3">option 3</option>
                        </select>
                    </div>

                    <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>

                </div>
            </div>  <!-- END .search-toggle -->


            <div class="container">
                <button class="toggle-btn" type="submit"><i class="fa fa-bars"></i></button>

                <div class="search-value">
                    <div class="keywords">
                        <input type="text" class="form-control" placeholder="Keywords">
                    </div>

                    <div class="select-location">
                        <select class="" data-placeholder="-Select location-">
                            <option value="option1">option 1</option>
                            <option value="option2">option 2</option>
                            <option value="option3">option 3</option>
                            <option value="option4">option 4</option>
                        </select>
                    </div>

                    <div class="category-search">
                        <select class="" data-placeholder="-Select category-">
                            <option value="option1">option 1</option>
                            <option value="option2">option 2</option>
                            <option value="option3">option 3</option>
                            <option value="option4">option 4</option>
                        </select>
                    </div>

                    <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div> <!-- END .CONTAINER -->
        </form>
    </div> <!-- END .header-search-bar -->

    <div class="company-heading-view">
        <div class="container">
            <div class="button-content">
                <button class="general-view-btn active"><i class="fa fa-newspaper-o"></i><span>General</span></button>
                <button class="map-view-btn"><i class="fa fa-map-marker"></i><span>Map</span></button>
                <button class="male-view-btn"><i class="fa fa-male"></i><span>Street</span></button>
            </div>
        </div>

        <div class="company-slider-content">

            <div class="general-view">
                <span></span> <!-- for dark-overlay on the bg -->
                <div class="container">

                    <div class="logo-image">
                        <img src="{{URL::to('/') }}/themes/default/assets/img/content/company-logo.jpg" alt="">
                    </div>

                    <h1>{{Theme::getCompanyName()}}</h1>
                </div>
            </div> <!-- END .general-view -->

            <div class="company-map-view">
                <div id="company_map_canvas"></div>
            </div> <!-- END .company-map-view -->

            <div class="company-map-street">
                <div id="company_map_canvas_street"></div>
            </div> <!-- END .company-map-view-street -->

        </div> <!-- END .company-slider-content -->

    </div> <!-- END .about-us-heading -->

</div> <!-- END .SEARCH and slide-section -->


<div class="header-nav-bar">
    <div class="container">
        <nav>

            <button><i class="fa fa-bars"></i></button>

            <ul class="primary-nav list-unstyled">
                <li ><a href="{{ URL::to('/') }}">Home<i class="fa fa-angle-down"></i></a></li>

                <li><a href="{{ URL::to('/companies') }}">Companies<i class="fa fa-angle-down"></i></a></li>
                <li><a href="{{ URL::to('/price-listing') }}">Price Listing</a></li>
                <li><a href="{{ URL::to('/about-us') }}">About Us</a></li>
                <li><a href="{{ URL::to('/contact-us') }}">Contact Us</a></li>
            </ul>
        </nav>
    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->
</header>