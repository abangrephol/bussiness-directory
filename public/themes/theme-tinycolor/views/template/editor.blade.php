<div id="sbheader">
<?php
if(isset($content->head)){
    echo $content->head;
}else{
?>
    <nav class="navbar">
        <div class="container">
            <div class="col-sm-12 col-lg-7">
                <div class="social pull-right col-lg-6 col-sm-12">
                    <ul>
                        <li class="hidden-lg hidden-md">
                            <div class="custom-collapse">
                                <div class="collapse-togle visible-xs" data-toggle="collapse" data-parent="custom-collapse" data-target="#search">
                                    <a class="btn btn-prim btn-circle"><i class="fa fa-search"></i></a>
                                </div>

                                <div class="collapse" id="search">
                                    <form class="form-inline pull-right absolut">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Search...">
                                        </div>
                                        <button type="submit" class="btn btn-prim"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li><a class="btn btn-prim btn-circle hidden-lg hidden-md"><i class="fa fa-user fa-lg"></i></a></li>
                        <li><a class="btn btn-prim btn-circle hidden-lg hidden-md"><i class="fa fa-shopping-cart  fa-lg"></i></a></li>
                        <li><a class="btn btn-prim btn-circle hidden-lg hidden-md"><i class="fa fa-phone fa-lg"></i></a></li>
                        <li><a class="btn btn-prim btn-circle"><i class="fa fa-facebook fa-lg"></i></a></li>
                        <li><a class="btn btn-prim btn-circle"><i class="fa fa-twitter fa-lg"></i></a></li>
                        <li><a class="btn btn-prim btn-circle"><i class="fa fa-google-plus fa-lg"></i></a></li>
                        <li><a class="btn btn-prim btn-circle"><i class="fa fa-pinterest fa-lg"></i></a></li>
                    </ul>
                </div>
                <div class="search col-lg-12 hidden-xs hidden-sm">

                    <ul>
                        <li class="pull-right">
                            <div class="custom-collapse">
                                <div class="collapse-togle visible-xs" data-toggle="collapse" data-parent="custom-collapse" data-target="#search">
                                    <a class="btn btn-prim"><i class="fa fa-search"></i></a>
                                </div>

                                <div class="collapse" id="cari">
                                    <form class="form-inline pull-right ">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Search...">
                                        </div>
                                        <button type="submit" class="btn btn-prim"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ic"><i class="fa fa-user fa-2x"></i></div>
                            <div class="hidden-xs hidden-sm">
                                <h1>Sign in</h1>
                                <h2>My Account</h2>
                            </div>
                        </li>
                        <li>
                            <div class="ic"><i class="fa fa-shopping-cart fa-2x"></i></div>
                            <div class="hidden-xs hidden-sm">
                                <h1>Cart</h1>
                                <h2>&nbsp;</h2>
                            </div>
                        </li>
                        <li>
                            <div class="ic"><i class="fa fa-phone fa-2x"></i></div>
                            <div class="hidden-xs hidden-sm">
                                <h1>Help is here</h1>
                                <h2>085763534</h2>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="navbar-header">
                <div class="navbar-brand animated zoomInDown delay-md">
                    <img src="{{Theme::asset()->url('img/logo.png')}}"/>
                </div>
                <div id="dl-menu" class="dl-menuwrapper pull-right hidden-lg hidden-md">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li>
                            <a href="/">HOME</a>
                        </li>
                        @foreach(CustomWebsite::getMenu($id) as $menu)
                        <li><a href="{{URL::to('/page/'.$menu->slug)}}">{{$menu->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php
}
?>
</div>

<div id="sbbody">
    <?php
    if(isset($content->body)){
        echo $content->body;
    }else{
    ?>
        <header class="header-image" id="home">
            <div class="collapse navbar-collapse animated fadeInDown" id="navbar-menu">
                <div class="container">

                    <ul class="nav navbar-nav">
                        <li>
                            <a href="/">HOME</a>
                        </li>
                        @foreach(CustomWebsite::getMenu($id) as $menu)
                        <li><a href="{{URL::to('/page/'.$menu->slug)}}">{{$menu->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="headline">
                <div class="container">
                    <div class="blok-blue hidden-sm hidden-xs animated delay-xs fadeInLeft"><h1>FOR EVERY STAGE OF YOUR BUSINESS</h1>
                        <h2>We’ll help you get the word out and the customers in</h2>
                    </div>
                    <div class="blok-grey martop-20 animated delay-sm fadeInLeft">
                        <h3>Up to 40% off postcards, flyers, brochures and more.<br/>
                            Use promo code <b>MARKETING </b></h3>
                    </div>
                    <a class="btn btn-prim animated  delay-xs fadeInLeft">SHOP NOW!</a>
                </div>
        </header>

        <section>
            <div class="container">
                <div class="strip">
                    <span>Product Features</span>
                </div>
                <div class="row features">
                    <div class="col-lg-4 col-sm-12">
                        <h1>STARTING YOUR BUSINESS</h1>
                        <h2>Make it official with a business card – then widen your reach with a website.</h2>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="imagehover">
                            <figure class="effect-zoe">
                                <img class="img-thumbnail" src="{{Theme::asset()->url('img/f1.jpg')}}"/>
                                <figcaption>
                                    <h3>Website</h3>
                                    <p class="icon-links">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="num">(1024)</span>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="imagehover">
                            <figure class="effect-zoe">
                                <img class="img-thumbnail" src="{{Theme::asset()->url('img/f3.jpg')}}"/>
                                <figcaption>
                                    <h3>Website</h3>
                                    <p class="icon-links">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="num">(1024)</span>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="row features">
                    <div class="col-lg-4 col-sm-12">
                        <h1>GROWING YOUR BUSINESS</h1>
                        <h2>Promote sales and events or describe your business with flyers and brochures</h2>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="imagehover">
                            <figure class="effect-zoe">
                                <img class="img-thumbnail" src="{{Theme::asset()->url('img/f4.jpg')}}"/>
                                <figcaption>
                                    <h3>Website</h3>
                                    <p class="icon-links">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="num">(1024)</span>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="imagehover">
                            <figure class="effect-zoe">
                                <img class="img-thumbnail" src="{{Theme::asset()->url('img/f2.jpg')}}"/>
                                <figcaption>
                                    <h3>Website</h3>
                                    <p class="icon-links">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="num">(1024)</span>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="row features">
                    <div class="col-lg-4 col-sm-12">
                        <h1>MANAGING YOUR BUSINESS</h1>
                        <h2>Stay top of mind with postcards or menus and price lists customers can keep</h2>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="imagehover">
                            <figure class="effect-zoe">
                                <img class="img-thumbnail" src="{{Theme::asset()->url('img/f4.jpg')}}"/>
                                <figcaption>
                                    <h3>Website</h3>
                                    <p class="icon-links">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="num">(1024)</span>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="imagehover">
                            <figure class="effect-zoe">
                                <img class="img-thumbnail" src="{{Theme::asset()->url('img/f2.jpg')}}"/>
                                <figcaption>
                                    <h3>Website</h3>
                                    <p class="icon-links">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="num">(1024)</span>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
        </section>

        <section>
            <div class="container">
                <div class="strip">
                    <span>CUSTOMIZE WITH CONFIDENCE</span>
                </div>
                <div class="center strong font-18 marbot-20">GET REAL-TIME DESIGN HELP,<span class="blue"> 7 DAYS A WEEK</span><br/>
                    1.866.614.8002
                </div>
                <div class="row confidence">
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <span class="font-16 strong blok">DESIGN IT YOUR SELF!</span>
                        <span class="blok">Start from scratch, customize a template, or upload your own logo or complete design.</span>
                        <span class="blue miring">Business Cards, Flyers, Banners</span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <span class="font-16 strong blok">LET US HELP YOU DESIGN IT!</span>
                        <span class="blok">We offer a range of design services to help you get exactly what you want</span>
                        <span class="blue miring">Design Services</span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <span class="font-16 strong blok">QUALITY VALUE</span>
                        <span class="blok">Professional quality at affordable prices, Our customers agree.</span>
                        <span class=" miring">Source : Bazaarvoice customer ratings, July 2015</span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <span class="font-16 strong blok">Absolutely Guaranteed</span>
                        <span class="blok">Every time, Any reason. Or we'll make it right.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-grey">
            <div class="container">
                <div class="strip">
                    <span>CUSTOMER REVIEWS</span>
                </div>
                <div class="row customer responsive">
                    <div class="col-lg-3 col-sm-12 ">
                        <div class="col-lg-5 col-sm-5 marbot-20">
                            <img src="{{Theme::asset()->url('img/t1.jpg')}}" class="img-circle">
                            <span class="strong blok">Nikel</span>
                            <span class="blue font-12 blok">Kill Devil Hills, NC</span>
                        </div>
                        <div class="col-lg-7 col-sm-7">
                            <span class="strong marbot-10 blok">Very Nice Looking!</span>
                            <span class="miring">They came out exactly the way I wanted them to. So nice and cheaper than what we've previously been getting.</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12 ">
                        <div class="col-lg-5 col-sm-5">
                            <img src="{{Theme::asset()->url('img/t2.jpg')}}" class="img-circle">
                            <span class="strong blok">Nikel</span>
                            <span class="blue font-12 blok">Kill Devil Hills, NC</span>
                        </div>
                        <div class="col-lg-7">
                            <span class="strong marbot-20 blok">Very Nice Looking!</span>
                            <span class="miring">They came out exactly the way I wanted them to. So nice and cheaper than what we've previously been getting.</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <div class="col-lg-5">
                            <img src="{{Theme::asset()->url('img/t3.jpg')}}" class="img-circle">
                            <span class="strong blok">Nikel</span>
                            <span class="blue font-12 blok">Kill Devil Hills, NC</span>
                        </div>
                        <div class="col-lg-7">
                            <span class="strong marbot-20 blok">Very Nice Looking!</span>
                            <span class="miring">They came out exactly the way I wanted them to. So nice and cheaper than what we've previously been getting.</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <div class="col-lg-5">
                            <img src="{{Theme::asset()->url('img/t4.jpg')}}" class="img-circle">
                            <span class="strong blok">Nikel</span>
                            <span class="blue font-12 blok">Kill Devil Hills, NC</span>
                        </div>
                        <div class="col-lg-7">
                            <span class="strong marbot-20 blok">Very Nice Looking!</span>
                            <span class="miring">They came out exactly the way I wanted them to. So nice and cheaper than what we've previously been getting.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        <section class="bg-dark" style="margin-top:0px;">
            <div class="container">
                <div class="row block-footer">
                    <div class="col-lg-3 col-sm-12 marbot-30 martop-20">
                        <span class="blok marbot-20"><img src="{{Theme::asset()->url('img/logo.png')}}"/></span>
                        <span class="blok ">
                            Lorem ipsum dolor sit amet,
                            consectetuer adipiscing elit,
                            sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna
                            aliquam erat volutpat.
                            Ut wisi enim ad minim veniam,
                            quis nostrud exerci tation
                            ullamcorper suscipit lobortis
                            nisl ut aliquip ex ea commodo consequat. <br/>
                            <a href="about.html">READ MORE</a>
                        </span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-30 martop-20">
                        <h5>RELY ON TINY COLOR COMPANY</h5>
                        <span class="blok ">
                            Absolutely Guaranteed<br/>
                            Every time. Any reason. Or we’ll make it right.
                        </span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-30 martop-20">
                        <h5> NEWS LETTER SIGN UP</h5>
                        <span class="blok marbot-20">By subscribing to our mailing list you will get the latest news from us.</span>
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter your Email & get 10% off">
                            </div>
                            <button type="submit" class="btn btn-dark">SIGN UP</button>
                        </form>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-30 martop-20">
                        <h5>GET IN TOUCH</h5>
                        <span class="blok marbot-20">If you have any questions, you can connect us via contact  <a href="kontak.html">here</a>, or follow us on social networks.</span>
                        <a class="btn btn-square"><i class="fa fa-lg fa-facebook"></i></a>
                        <a class="btn btn-square"><i class="fa fa-lg fa-twitter"></i></a>
                        <a class="btn btn-square"><i class="fa fa-lg fa-google-plus"></i></a>
                        <a class="btn btn-square"><i class="fa fa-lg fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="row block-list">
                    <div class="col-lg-3 col-sm-12">
                        <div class="custom-collapse">
                            <div class="collapse-togle visible-xs center top-border" data-toggle="collapse" data-parent="custom-collapse" data-target="#side-menu-collapse">LET US HELP <i class="fa fa-chevron-down"></i></div>
                            <h5 class="hidden-sm hidden-xs">LET US HELP</h5>
                            <ul class="collapse" id="side-menu-collapse">
                                <li class="center dropdown-toggle"><a href="#">Help center</a></li>
                                <li class="center dropdown-toggle"><a href="#">Contact us</a></li>
                                <li class="center dropdown-toggle"><a href="#">Shipping & delivery</a></li>
                                <li class="center dropdown-toggle"><a href="#">Request samples</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <div class="custom-collapse">
                            <div class="collapse-togle visible-xs center" data-toggle="collapse" data-parent="custom-collapse" data-target="#offer">WHAT WE OFFER <i class="fa fa-chevron-down"></i></div>
                            <h5 class="hidden-sm hidden-xs">WHAT WE OFFER</h5>
                            <ul class="collapse" id="offer">
                                <li class="center dropdown-toggle"><a href="#">Our products</a></li>
                                <li class="center dropdown-toggle"><a href="#">Upload Designs</a></li>
                                <li class="center dropdown-toggle"><a href="#">Partner with us</a></li>
                                <li class="center dropdown-toggle"><a href="#">Advertising with us</a></li>
                                <li class="center dropdown-toggle"><a href="#">Reseller program</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <div class="custom-collapse">
                            <div class="collapse-togle visible-xs center" data-toggle="collapse" data-parent="custom-collapse" data-target="#company">OUR COMPANY <i class="fa fa-chevron-down"></i></div>
                            <h5 class="hidden-sm hidden-xs">OUR COMPANY</h5>
                            <ul class="collapse" id="company">
                                <li class="center dropdown-toggle"><a href="#">About us</a></li>
                                <li class="center dropdown-toggle"><a href="#">Careers</a></li>
                                <li class="center dropdown-toggle"><a href="#">For investors</a></li>
                                <li class="center dropdown-toggle"><a href="#">Webs</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <div class="custom-collapse">
                            <div class="collapse-togle visible-xs center" data-toggle="collapse" data-parent="custom-collapse" data-target="#polici">OUR POLICIES <i class="fa fa-chevron-down"></i></div>
                            <h5 class="hidden-sm hidden-xs">OUR POLICIES</h5>
                            <ul class="collapse" id="polici">
                                <li class="center dropdown-toggle"><a href="#">Copyright matters</a></li>
                                <li class="center dropdown-toggle"><a href="#">Trademark matters</a></li>
                                <li class="center dropdown-toggle"><a href="#">Patents & trademarks</a></li>
                                <li class="center dropdown-toggle"><a href="#">Processing fees</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
        </section>
        <footer>
            <div class="container grey-footer font-12 center">
                <span class="blok martop-10"> Home | Site Map | Privacy Policy | Terms of Use | a Cimpress company</span>
                © 2001-2015 <span class="blue">TINY COLOR</span> All rights reserved.
            </div>
        </footer>
    <?php
    }
    ?>
</div>

