<!--div class="loader">
    <span class="loader1 block-loader"></span>
    <span class="loader2 block-loader"></span>
    <span class="loader3 block-loader"></span>
</div-->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="span2">
                <div id="logo" class="logo">
                    <a href="./" rel="home"><img src="{{ (CustomWebsiteData::get_key($id,'logo')) ?: Theme::asset()->url('images/logo.png')}}" alt="LOGO" /></a>
                </div><!-- /.logo -->
            </div><!-- /.roll-col2 -->
            <div class="span10">
                <div class="btn-menu"></div><!-- //mobile menu button -->
                <nav id="mainnav" class="mainnav">
                    <ul class="menu">
                        <li><a href="/" class="active">Home</a></li>
                        @foreach(CustomWebsite::getMenu($id) as $menu)
                        <li><a href="{{URL::to('/page/'.$menu->slug)}}">{{$menu->name}}</a></li>
                        @endforeach

                        <li class="social twitter"><a href="#"><i class="icon-twitter-circled"></i></a></li>
                        <li class="social facebook"><a href="#"><i class="icon-facebook-circled"></i></a></li>
                    </ul><!-- /.menu -->
                </nav><!-- /nav -->
            </div><!-- /.span10 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</header>

<section class="head-slider default parallax">
    <div class="overlay"></div>
    <ul class="image-bg">
        <li class="sleft"><img src="{{Theme::asset()->url('images/slider/1.jpg')}}" alt="image"></li>
        <li class="sright"><img src="{{Theme::asset()->url('images/slider/2.jpg')}}" alt="image"></li>
        <li class="stop"><img src="{{Theme::asset()->url('images/slider/1.jpg')}}" alt="image"></li>
        <li class="sbottom"><img src="{{Theme::asset()->url('images/slider/2.jpg')}}" alt="image"></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="content" >
                                <h2 class="title captionDelay2 FromTop">Relax during workdays</h2>
                                <p class="sub-title captionDelay2 FromBottom">At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of <br>call in the Pacific, where all the mail-steamers, and those carrying travellers between North </p>
                                <a href="#" class="read-more captionDelay2 FromLeft">READ MORE</a>
                            </div><!-- /.content -->
                        </li>
                        <li>
                            <div class="content">
                                <h2 class="title captionDelay2 FromBottom">Relax during workdays</h2>
                                <p class="sub-title captionDelay2 FromTop">At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of <br>call in the Pacific, where all the mail-steamers, and those carrying travellers between North </p>
                                <a href="#" class="read-more captionDelay2 FromRight">READ MORE</a>
                            </div><!-- /.content -->
                        </li>
                        <li>
                            <div class="content">
                                <h2 class="title captionDelay2 FromTop">Relax during workdays</h2>
                                <p class="sub-title captionDelay2 FromBottom">At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of <br>call in the Pacific, where all the mail-steamers, and those carrying travellers between North </p>
                                <a href="#" class="read-more captionDelay2 FromLeft">READ MORE</a>
                            </div><!-- /.content -->
                        </li>
                        <li>
                            <div class="content">
                                <h2 class="title captionDelay2 FromBottom">Relax during workdays</h2>
                                <p class="sub-title captionDelay2 FromTop">At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of <br>call in the Pacific, where all the mail-steamers, and those carrying travellers between North </p>
                                <a href="#" class="read-more captionDelay2 FromRight">READ MORE</a>
                            </div><!-- /.content -->
                        </li>
                    </ul>
                </div>
            </div><!-- /.span12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section class="roll-row main-page services-home roll-animation" style="padding: 52px 0 28px 0;" data-portfolio-effect="fadeInDown" data-animation-delay="0" data-animation-offset="75%">
    <div class="container" contenteditable="true">
        <div id="body">
            @if (isset($data->content))
            {{$data->content}}
            @else
            <div class="row">
                <div class="span12">
                    <div class="items">
                        <div class="col-sm-12">
                            <img src="{{Theme::asset()->url('images/home/1.jpg')}}" alt="image">
                            <h5 class="title">STELLAR BEHIND THE SCENES</h5>
                            <p>At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of call in the Pacific, where all the mail-steamers, and those </p>
                        </div>

                    </div><!-- /.items -->
                    <div class="items">
                        <div class="col-sm-12">
                            <img src="{{Theme::asset()->url('images/home/1.jpg')}}" alt="image">
                            <h5 class="title">AWESOME, OUT OF THE BOX</h5>
                            <p>At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of call in the Pacific, where all the mail-steamers, and those </p>
                        </div>
                    </div><!-- /.items -->
                    <div class="items">
                        <div class="col-sm-12">
                            <img src="{{Theme::asset()->url('images/home/1.jpg')}}" alt="image">
                            <h5 class="title">DREAM DEAL</h5>
                            <p>At dawn on the 13th the Carnatic entered the port of Yokohama.  This is an important port of call in the Pacific, where all the mail-steamers, and those </p>
                        </div>
                    </div><!-- /.items -->
                </div><!-- /.span12 -->
            </div><!-- /.row -->
            @endif
        </div>

    </div><!-- /.container -->
</section><!-- /.services-home -->


<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="widget widget-about">
                        <h5 class="title">ABOUT AVENT</h5>
                        {{ CustomWebsiteData::get_key($id,'footer-about')}}
                    </div>
                </div><!-- /.span3 -->
                <!--div class="span3">
                    <div class="widget widget-recent-post">
                        <h5 class="title">RECENT POSTS</h5>
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{Theme::asset()->url('images/widget/1.jpg')}}" class="image" alt="image">
                                    <p>Mail-steamers, and those carrying travellers between </p>
                                    <span>NOVEMBER 20, 2013</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{Theme::asset()->url('images/widget/2.jpg')}}" class="image" alt="image">
                                    <p>America, China, Japan, and the Oriental islands put in.</p>
                                    <span>NOVEMBER 20, 2013</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div--><!-- /.span3 -->
                <div class="span4">
                    <div class="widget widget-newsletter">
                        <h5 class="title">NEWSLETTER SIGNUP</h5>
                        <p>It is situated in the bay of Yeddo, and at<br> but a short distance from that second </p>
                        <div class="event">
                            <form method="post" action="#" id="subscribe-form" data-mailchimp="true" class="form-letter">
                                <div id="subscribe-content">
                                    <div class="input">
                                        <input type="text" id="subscribe-email" class="your-email" name="subscribe-email" placeholder="E-MAIL">
                                    </div>
                                    <div class="button">
                                        <button type="button" id="subscribe-button" class="read-more subcrible" title="Subscribe now">SIGN UP</button>
                                    </div>
                                </div>
                                <div id="subscribe-msg"></div>
                            </form>
                        </div>
                    </div><!-- /.widget-newsletter -->
                </div><!-- /.span3 -->
                <div class="span4">
                    <div class="widget widget-recent-project">
                        <h5 class="title">RECENT PROJECTS</h5>
                        <ul>
                            <li>
                                <a href="#"><img src="{{Theme::asset()->url('images/widget/3.jpg')}}" alt="image"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{Theme::asset()->url('images/widget/4.jpg')}}" alt="image"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{Theme::asset()->url('images/widget/5.jpg')}}" alt="image"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{Theme::asset()->url('images/widget/6.jpg')}}" alt="image"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{Theme::asset()->url('images/widget/7.jpg')}}" alt="image"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{Theme::asset()->url('images/widget/8.jpg')}}" alt="image"></a>
                            </li>
                        </ul>
                    </div><!-- /.widget-recent-project -->
                </div><!-- /.span3 -->
            </div><!-- /.roll-rows -->
        </div><!-- /.roll-container -->
    </div><!-- /.footer-top -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="copyright">&copy; 2014 Avent Inc.</div><!-- /.copyright -->
                    <div class="link">
                        @foreach(CustomWebsite::getMenu($id) as $menu)
                        <a href="{{URL::to('/page/'.$menu->slug)}}">{{$menu->name}}</a>
                        @endforeach
                    </div><!-- /.link -->
                    <div class="social">
                        <a href="#"><i class="icon-twitter-circled"></i></a>
                        <a href="#"><i class="icon-facebook-circled"></i></a>
                        <a href="#"><i class="icon-gplus-circled"></i></a>
                        <a href="#"><i class="icon-linkedin-circled"></i></a>
                    </div><!-- /.social -->
                </div><!-- /.span12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.footer-bottom -->
</footer>

<!-- Go Top -->
<a class="go-top">
    <i class="icon-up-open"></i>
</a>