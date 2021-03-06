<?php
if(isset($content->head)){
    echo $content->head;
}else{
?>
<div id="sbheader">

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

</div>
<?php
}
?>
<?php
if(isset($content->body)){
    echo $content->body;
}else{
?>
<div id="sbbody">

        <section class="main-page services-home" style="padding: 52px 0 28px 0;" data-portfolio-effect="fadeInDown" data-animation-delay="0" data-animation-offset="75%">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="main-404">
                            <h1 class="number">404</h1><span>error</span>
                            <h1 class="info">Sorry, this pages does not exist anymore.</h1>

                        </div>
                    </div><!-- /.span12 -->
                </div><!-- /.row -->
            </div>
        </section><!-- /.services-home -->

</div>
<?php
}
?>
<footer class="footer" id="sbfooter">
    <?php
    if(isset($content->foot)){
        echo $content->foot;
    }else{
        ?>
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
    <?php
    }
    ?>
</footer>

<!-- Go Top -->
<a class="go-top">
    <i class="icon-up-open"></i>
</a>