<div id="sbheader">
<?php
if(isset($content->head)){
    echo $content->head;
}else{
?>
<div id="top-bar">
    <div class="container">

        <!-- Top Bar Menu -->
        <div class="ten columns">
            <ul class="top-bar-menu">
                <li><i class="fa fa-phone"></i> {{ CustomWebsiteData::get_key($id,'header-phone')}}</li>
                <li><i class="fa fa-envelope"></i> <a href="#">{{ CustomWebsiteData::get_key($id,'header-email')}}</a></li>
            </ul>
        </div>

        <!-- Social Icons -->
        <div class="six columns">
            <ul class="social-icons">
                <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                <li><a class="dribbble" href="#"><i class="icon-dribbble"></i></a></li>
                <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                <li><a class="pinterest" href="#"><i class="icon-pinterest"></i></a></li>
            </ul>
        </div>

    </div>
</div>

<div class="clearfix"></div>

<!-- Header
================================================== -->
<div class="container">


    <!-- Logo -->
    <div class="four columns">
        <div id="logo">
            <h1><a><img src="{{ (CustomWebsiteData::get_key($id,'logo')) ?: Theme::asset()->url('images/logo.png')}}" alt="Wirednest" /></a></h1>
        </div>
    </div>

    <!-- Searchbar -->
    <div class="twelve columns  margin-top-20">


        <!-- Search -->
        <nav class="top-search margin-top-20">
            <form action="#" method="get">
                <button><i class="fa fa-search"></i></button>
                <input class="search-field" type="text" placeholder="Search" value=""/>
            </form>
        </nav>

    </div>

</div>

<!-- Navigation
================================================== -->
<div class="container">
    <div class="sixteen columns">

        <a href="#menu" class="menu-trigger"><i class="fa fa-bars"></i> Menu</a>

        <nav id="navigation">
            <ul class="menu" id="responsive">
                <li><a href="/" class="current homepage" id="current">Home</a></li>
                @foreach(CustomWebsite::getMenu($id) as $menu)
                <li><a href="{{URL::to('/page/'.$menu->slug)}}" id="current">{{$menu->name}}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
<?php
}
?>
</div>
<div id="sbbody" >
<?php
if(isset($content->body)){
    echo $content->body;
}else{
?>


    <div class="container">
        <div></div>
    </div>


<?php
}
?>
</div>
<div id="sbfooter">
<?php
if(isset($content->foot)){
    echo $content->foot;
}else{
?>

<!-- Footer
================================================== -->
<div id="footer">

    <!-- Container -->
    <div class="container">

        <div class="six columns ">
            <h3 class="headline footer ">About</h3>
            <span class="line"></span>
            <div class="clearfix"></div>
            <p class="margin-top-15 ">
                Here for company short description
            </p>
        </div>


        <div class="four columns ">

            <!-- Headline -->
            <h3 class="headline footer ">Sitemaps</h3>
            <span class="line"></span>
            <div class="clearfix"></div>

            <ul class="footer-links">
                <li><a href="index.html">Homepage</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.html">Our Services</a></li>
                <li><a href="products.html">Our Products</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>

        </div>

        <div class="six columns ">

            <!-- Headline -->
            <h3 class="headline footer ">Newsletter</h3>
            <span class="line"></span>
            <div class="clearfix"></div>
            <p class="">Sign up to receive email updates on new product announcements, gift ideas, special promotions, sales and more.</p>

            <form action="#" method="get">
                <button class="newsletter-btn" type="submit">Join</button>
                <input class="newsletter" type="text" placeholder="mail@example.com" value=""/>
            </form>
        </div>

    </div>
    <!-- Container / End -->

</div>
<!-- Footer / End -->

<!-- Footer Bottom / Start -->
<div id="footer-bottom" class="">

    <!-- Container -->
    <div class="container">

        <div class="eight columns ">© Copyright 2014 by <a href="#">Wirednest</a>. All Rights Reserved.</div>


    </div>
    <!-- Container / End -->

</div>
<!-- Footer Bottom / End -->
</div>
<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a>
<?php
}
?>
</div>