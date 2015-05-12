<ul class="filemanager-options">
    <li>
        <span>Choose one template</span>
    </li>
</ul>
<div class="row">
    <div class="col-sm-9">
        <div class="row filemanager">
            @foreach ($templates as $template)
            <div class="col-sm-4">
                <div class="thmb">
                    <!--div class="ckbox ckbox-default" style="display: none;">
                        <input type="checkbox" id="check2" value="1">
                        <label for="check2"></label>
                    </div>
                    <div class="btn-group fm-group" style="display: none;">
                        <button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu fm-menu" role="menu">
                            <li><a href="#"><i class="fa fa-share"></i> Share</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> Email</a></li>
                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                            <li><a href="#"><i class="fa fa-download"></i> Download</a></li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                        </ul>
                    </div><!-- btn-group -->
                    <div class="thmb-prev">
                        <a href="http://placehold.it/250x150" data-rel="prettyPhoto" rel="prettyPhoto">
                            <img src="http://placehold.it/250x150" class="img-responsive" alt="">
                        </a>
                    </div>
                    <h5 class="fm-title">{{ $template->name }}</h5>
                    <small class="text-muted">Author: {{ $template->author }}</small>
                    <a class="btn btn-primary btn-block" href="{{ route('custom-website.pages',array('id'=>$id)) }}">Choose</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
