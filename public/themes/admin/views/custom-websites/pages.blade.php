<div class="panel panel-default">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#page-editor" data-toggle="tab"><strong>Page List</strong></a></li>
        <li><a href="#site-setting" data-toggle="tab"><strong>Site Setting</strong></a></li>
        <li class="pull-right save"><a><i class="fa fa-file-text"></i>&nbsp;Save</a></li>
    </ul>
    <div class="panel-body">
        <div class=" pull-right">
            <div class="btn-group">
                <a class="btn btn-white" href="{{ URL::route('custom-website.builder',array('id'=>$id,'templateId'=>$templateId)) }}">Add New Page</a>
            </div>
        </div>
        <h5 class="subtitle mb5">{{ Theme::get('pageTitle') }} list</h5>
        <p class="text-muted">...</p>
        <div class="table-responsive">
            {{ Theme::widget('datatable', array('columns' => $columns, 'routeUrl' => $routeUrl,'dataRoute'=>array('id'=>$id)))->render() }}
        </div>
    </div>
</div>
