<div class="btn-group btn-group-sm visible-lg">
    <a href="{{ URL::route('custom-website.builder', array('id'=>$model->custom_website()->get()->first()->id,'pageId'=>$model->id,'templateId'=>$model->custom_website()->get()->first()->template_id )) }}" class="btn btn-primary"><i class="fa fa-edit mr5"></i>Edit</a>
    <a href="{{ URL::route('custom-website.pages.delete', array('id'=>$model->custom_website()->get()->first()->id,'pageId'=>$model->id )) }}" class="btn btn-danger"><i class="fa fa-trash-o mr5"></i>Delete</a>
</div>

