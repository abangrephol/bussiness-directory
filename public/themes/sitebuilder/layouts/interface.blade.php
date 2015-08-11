<!DOCTYPE html>
<!--
Author : Shinta RE
-->
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title> Interface</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        {{ Theme::asset()->styles() }}
        {{ Theme::asset()->container('editor')->styles() }}
        {{ Theme::asset()->scripts() }}

    </head>
    <body>
        <nav class="navbar navbar-fixed-top nav-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"></span>
                        <span class="icon-bar">test</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="{{ Theme::asset()->url('img/logointerface.png'); }}"/></a>
                    <div class="pull-left header-button">
                        <a class="btn btn-blue" href="#" data-toggle="modal" data-target="#mod">General Setting</a>
                        <!--a class="btn btn-grey" href="#">Ok Sip</a-->
                    </div>
                </div>
                <div  class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right navbar-header">
                        <li><a href="#" title="Fullscreen"><i class="fa fa-arrows-alt"></i></a></li>
                        <li><a href="#"><i class="fa fa-save"></i><span>Save</span></a></li>
                        <li><a href="{{ URL::route('custom-website.pages',array('id'=>Theme::place('id'))) }}"><span>Exit</span><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-blue">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <nav>
                <!--ul>
                    <li> 
                        <a href="#"><i class="fa fa-home"></i> 
                            <span class="menu-item-parent">Widgets & Template Panel</span>
                        </a>
                        <ul>
                            <li>
                                <a href=""><i class="fa fa-home"></i> <span>signal</span></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-home"></i> </a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-home"></i> </a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-home"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-home"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-home"></i><span>signal</span></a>
                            </li>
                        </ul>
                    </li>



                    <li><a ><i class="fa fa-whatsapp "></i></a></li>
                    <li><a ><i class="fa fa-facebook"></i></a></li>
                    <li><a ><i class="fa fa-youtube"></i></a></li>
                </ul-->
            </nav>
        </div>


        <span id="showLeftPush" class="menu-button"><i class ="fa fal-lg  fa-wrench  "></i></span>
        <div class="main-content">
            <div class="panel pan">
                <div class="panel-body pan-bod">
                    Toolbox
                </div>
            </div>
            {{ Theme::content() }}
            <div class="right-sidebar cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="push">

                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#layouts" data-toggle="tab">Layouts</a></li>
                    <li role="presentation"><a href="#elements" data-toggle="tab">Elements</a></li>
                    <li role="presentation"><a href="#property" data-toggle="tab">Property</a></li>
                </ul>
                <div  class="tab-content ">
                    <div class="tab-pane fade in active" id="layouts" >
                        <div class="tab-block">
                            yuhuuu
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="elements">
                        <div class="tab-block">
                            holaa
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="property">
                        <div class="tab-block">
                            oksip
                        </div>
                    </div>
                </div>


            </div>
        </div>




        {{ Theme::asset()->container('editor')->scripts() }}
        {{ Theme::asset()->container('footer')->scripts() }}

    </body>
</html>
