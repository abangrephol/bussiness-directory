<div class="btn-group btn-group-sm visible-lg">
    <a href="{{ route($route.'.edit', $model->id ) }}" class="btn btn-primary"><i class="fa fa-edit mr5"></i>Edit</a>
    <a href="{{ route($route.'.destroy', $model->id ) }}" class="btn btn-danger"><i class="fa fa-trash-o mr5"></i>Delete</a>
</div>
<div class="btn-group btn-group-sm hidden-lg">
    <a href="{{ route($route.'.edit', $model->id ) }}" class="btn btn-primary"><i class="fa fa-edit mr5"></i></a>
    <a href="{{ route($route.'.destroy', $model->id ) }}" class="btn btn-danger"><i class="fa fa-trash-o mr5"></i></a>
</div>
