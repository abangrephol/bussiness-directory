<div id="sbheader">
<?php
if(isset($content->head)){
    echo $content->head;
}else{
?>
<header class="header">
    <nav id="house" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" ><img src="aset/img/logo.png"/></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li  class="active">
                        <a href="index.html">HOME</a>
                    </li>
                    @foreach(CustomWebsite::getMenu($id) as $menu)
                    <li><a href="{{URL::to('/page/'.$menu->slug)}}">{{$menu->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
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
    <section class="main-page services-home" style="padding: 52px 0 28px 0;" data-portfolio-effect="fadeInDown" data-animation-delay="0" data-animation-offset="75%">
        <div class="container" >
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
                            <span><img src="{{Theme::asset()->url('images/home/1.jpg')}}" alt="image"></span>
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
            <div class="row">
                <div class="span12">
                    <p></p>
                </div>
            </div>


        </div><!-- /.container -->
    </section><!-- /.services-home -->
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
        <section class="sec-dark">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <img src="aset/img/logo.png"/>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <h3>ABOUT US</h3>
                        <span>OEM is an electronic version of a printed hard copy of exhibitor manual. The online exhibitor manual included static informative section, which provides information on health and safety and rules and regulations. <br/>
                            <a href="about.html">Read More <i class="but fa fa-angle-right"></i></a></span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <h3>contact us</h3>
                        <span>
                            OEM -Online Exhibition Manual <br/>
                            69A, B, C, Jalan Ibrahim Sultan<br/>
                            80300 Johor Bahru<br/>
                            Tel: 607-2222608 / 607-2223719<br/>
                            Fax: 607-2229435<br/>
                        </span>
                    </div>
                    <div class="col-lg-3 col-sm-12 marbot-20">
                        <h3>get in touch</h3>
                        <span class="blok marbot-10">If you have any questions, you can connect us via contact  <a href="contact.html">here</a>, or follow us on social networks.</span>
                        <a class="btn square"><i class="fa fa-lg fa-facebook-square"></i></a>
                        <a class="btn square"><i class="fa fa-lg fa-twitter-square"></i></a>
                        <a class="btn square"><i class="fa fa-lg fa-google-plus-square"></i></a>
                        <a class="btn square"><i class="fa fa-lg fa-pinterest-square"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="container grey-footer font-12">
                <span class="blok martop-20"> Copyright @ <span class="strong"> www.oem.com.sg</span> | Privacy Policy | Term of Use | Power <span class="strong">by www.oem.sg</span></span>
            </div>
        </footer>
    <?php
    }
    ?>
</div>