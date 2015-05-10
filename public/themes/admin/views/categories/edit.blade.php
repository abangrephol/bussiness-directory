<div class="panel panel-alt panel-default">
    <div class="panel-heading">
        <a class="btn btn-danger pull-right mr10 mt5" href="{{ URL::route('admin/categories') }}">Back to list</a>
        <h4 class="panel-title-alt"><i class="fa fa-edit mr5"></i><span class="text-danger">Please enter category information</span></h4>
        <p>* = Required fields</p>
    </div>
    {{ Form::model($data, array('route' => array('admin.categories.update', $data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
    <div class="panel-body">

        <div class="alert {{ Session::get('messages')? Session::get('messages')->has('error')?'alert-danger':'alert-success' :'hidden' }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div id="successMessage text-center">{{ Session::get('messages')?Session::get('messages')->first('message'):'' }}</div>
        </div>
        <div class="row mb20">
            <div class="col-sm-12">
                {{ Widget::inputForm('text','name','name','Category Name',$errors,array('singleRow'=>true)) }}
                {{ Theme::widget('inputForm',array('id'=>'name','label'=>'Category Name','type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'slug','label'=>'URL Slug','type'=>'text','readonly'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'icon','label'=>'Icon'
                ,'type'=>'select', 'value'=>$icons
                ,'placeholder'=>'Select one icon or leave it default'
                ,'selected'=>$data->icon))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'parent_id','label'=>'Parent Category'
                ,'type'=>'select', 'value'=>$selectValue
                ,'placeholder'=>'Select one Parent Category or leave it empty as Parent Category'
                ,'selected'=>$data->parent_id))->render() }}

            </div>
        </div>


    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
<script>
    jQuery(document).ready(function(){
        // Basic Form
        jQuery(".form").validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });
        function formatResult(item) {
            if(!item.id) {
                // return `text` for optgroup
                return item.text;
            }
            // return item template

            return '<i class="fa '+item.id+' mr10"></i>' + item.text + '';
        }

        function formatSelection(item) {
            // return selection template
            return '<i class="fa '+item.id+' mr10"></i>' + item.text + '';
        }
        jQuery('#parent_id').select2({
            placeholder: "Select a parent",
            width:'100%',
            allowClear:true
        });
        jQuery('#icon').select2({
            width:'100%',
            allowClear:true,
            // Specify format function for dropdown item
            formatResult: formatResult,
            // Specify format function for selected item
            formatSelection: formatSelection
        });

        //jQuery('select').trigger("chosen:updated");

    });
</script>