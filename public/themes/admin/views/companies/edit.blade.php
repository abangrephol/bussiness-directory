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
                {{ Widget::inputForm('text','name','name','Company Name',$errors,array('required'=>true)) }}
                {{ Widget::inputForm('text','contact_name','contact_name','Contact Name',$errors,array('required'=>true)) }}
                {{ Widget::inputForm('text','phone','phone','Telephone',$errors,array('required'=>true)) }}
                {{ Widget::inputForm('text','email','email','Email',$errors) }}
                {{ Widget::inputForm('text','address_1','address_1','Address',$errors,array('required'=>true)) }}
                {{ Widget::inputForm('text','address_2','address_2','Address',$errors) }}


            </div>
            <div class="col-sm-6">
                {{ Widget::inputForm('text','postcode','postcode','Postcode',$errors,['right'=>true,'required'=>true]) }}
                {{ Widget::inputForm('text','city','city','City',$errors,['right'=>true,'required'=>true]) }}
                {{ Widget::inputForm('select','state_id','state_id','State',$errors,array('required'=>true,'right'=>true, 'value'=>$state,'selected'=>$data->state_id)) }}
                {{ Widget::inputForm('text','country','country','Country',$errors,['value'=>'Malaysia','right'=>true,'required'=>true,'readonly'=>'readonly']) }}
                {{ Widget::inputForm('text','website','website','Website',$errors,['right'=>true,'required'=>true]) }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{ Widget::inputForm('select','categories[]','categories[]','Categories',$errors,array('required'=>true,'singleRow'=>true,'right'=>true, 'value'=>$category,'multiple'=>true,'selected'=>$categories)) }}
                {{ Widget::inputForm('map','map','map','Address on Map',$errors,['right'=>true,'required'=>true,'singleRow'=>true]) }}
                {{ Widget::inputForm('textarea','short_description','short_description','Short Description',$errors,['right'=>true,'required'=>true,'singleRow'=>true]) }}
                {{ Widget::inputForm('textarea','description','description','Description',$errors,['right'=>true,'required'=>true,'singleRow'=>true]) }}
                {{ Widget::inputForm('text','tags','tags','Tags',$errors,['right'=>true,'required'=>true,'singleRow'=>true]) }}

            </div>
        </div>


    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-primary">Update</button>
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
        //jQuery('#state_id').chosen({allow_single_deselect:true,width:'100%'});
        jQuery('#state_id').select2({width:'100%',allowClear:true});
        jQuery('select[name^="categories"]').select2({width:'100%',allowClear:true});
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