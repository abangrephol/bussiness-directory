<div class="panel panel-alt panel-default">
    <div class="panel-heading">
        <a class="btn btn-danger pull-right mr10 mt5" href="{{ URL::route('admin/companies') }}">Back to list</a>
        <h4 class="panel-title-alt"><i class="fa fa-edit mr5"></i><span class="text-danger">Please enter company information</span></h4>
        <p>* = Required fields</p>
    </div>
    {{ Form::model($data, array('route' => array('admin.companies.update', $data->id),'method'=>'PUT','class'=>'form form-horizontal')) }}
    <div class="panel-body">

        <div class="alert {{ Session::get('messages')? Session::get('messages')->has('error')?'alert-danger':'alert-success' :'hidden' }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div id="successMessage" class="text-center">{{ Session::get('messages')?Session::get('messages')->first('message'):'' }}</div>
        </div>
        <div class="row mb20">
            <div class="col-sm-6">
                {{ Theme::widget('inputForm',array('id'=>'name','label'=>'Company Name','type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'contact_name','label'=>'Contact Name','type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'phone','label'=>'Telephone','type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'email','label'=>'Email','type'=>'text'))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'address_1','label'=>'Address','type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'address_2','label'=>'Address','type'=>'text'))->render() }}


            </div>
            <div class="col-sm-6">
                {{ Theme::widget('inputForm',array('id'=>'postcode','label'=>'Postcode','right'=>true,'type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'city','label'=>'City','right'=>true,'type'=>'text','required'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'state_id','label'=>'State','right'=>true,'type'=>'select','required'=>true , 'value'=>$state,'selected'=>$data->state_id))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'country','label'=>'Country','right'=>true,'type'=>'text','value'=>'Malaysia','readonly'=>'readonly'))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'website','label'=>'Website','right'=>true,'type'=>'text'))->render() }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{ Theme::widget('inputForm',array('id'=>'categories[]','label'=>'Categories','right'=>true,'type'=>'select','required'=>true,'singleRow'=>true , 'value'=>$category,'multiple'=>true,'selected'=>$categories))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'map','label'=>'Address on Map','type'=>'map','required'=>true,'singleRow'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'short_description','label'=>'Short Description','type'=>'textarea','singleRow'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'description','label'=>'Description','type'=>'textarea','required'=>true,'singleRow'=>true))->render() }}
                {{ Theme::widget('inputForm',array('id'=>'tags','label'=>'Tags','type'=>'text','singleRow'=>true))->render() }}
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
                console.log('er');
                jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            ignore: [],
            rules: {
                description: {
                    required: function()
                    {
                        CKEDITOR.instances.description.updateElement();
                    }
                }
            },
            messages: {

                description: "This field is required."
            },
            /* use below section if required to place the error*/
            errorPlacement: function(error, element)
            {
                if (element.attr("name") == "description")
                {
                    error.insertBefore("textarea#description");
                } else {
                    error.insertBefore(element);
                }
            }
        });
        jQuery('#tags').tagsInput({width:'auto'});
        jQuery('#description').ckeditor();
        jQuery('#state_id').chosen({allow_single_deselect:true,width:'100%'});
        jQuery('select[name^="categories"]').chosen({allow_single_deselect:true,width:'100%'});
        /*map = new GMaps({
            div: '#map',
            lat: -12.043333,
            lng: -77.028333
        });*/
        GMaps.geocode({
            address: new Array($('#address_1').val(),
                $('#city').val()+" "+$('#postcode').val()

            ).join(',') ,
            callback: function(results, status) {
                if (status == 'OK') {
                    var latlng = results[0].geometry.location;
                    /*map.setCenter(latlng.lat(), latlng.lng());
                    map.addMarker({
                        lat: latlng.lat(),
                        lng: latlng.lng()
                    });*/
                    url = GMaps.staticMapURL({
                        size: [610, 300],
                        lat: latlng.lat(),
                        lng: latlng.lng(),
                        markers: [
                            {lat: latlng.lat(), lng: latlng.lng()}
                        ]
                    });

                    $('<img/>').attr('src', url)
                        .appendTo('#map');
                }
            }
        });
    });
</script>