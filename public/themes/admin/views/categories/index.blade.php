<div class="panel panel-default">
    <div class="panel-body">
        <div class=" pull-right">
            <div class="btn-group">
                <a class="btn btn-white" href="{{ URL::route('admin.categories.create') }}">Add New Category</a>
            </div>
        </div>
        <h5 class="subtitle mb5">{{ Theme::get('pageTitle') }} list</h5>
        <p class="text-muted">...</p>
        <div class="table-responsive">
            {{ Theme::widget('datatable', array('columns' => $columns, 'routeUrl' => $routeUrl))->render() }}
        </div>
    </div>
</div>
