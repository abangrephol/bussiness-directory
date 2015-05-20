<div class="headerbar">

    <a class="menutoggle"><i class="fa fa-bars"></i></a>



    <form class="searchform" action="index.html" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Search here...">
    </form><div class="header-right">
        <ul class="headermenu">

            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('themes/admin/assets/images/photos/loggeduser.png') }}" alt="">
                        John Doe
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="/admin/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div><!-- header-right -->

</div>