<div class="panel panel-default">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#pages" data-toggle="tab"><strong>Page List</strong></a></li>
        <li><a href="#custom-website" data-toggle="tab"><strong>Custom Website Data</strong></a></li>
        <!--li><a href="#site-setting" data-toggle="tab"><strong>Site Setting</strong></a></li>
        <li class="pull-right save"><a><i class="fa fa-file-text"></i>&nbsp;Save</a></li-->
    </ul>
    <div class="panel-body-nopadding">
        <div class="tab-content">
            <div class="tab-pane active" id="pages">
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
            <div class="tab-pane" id="custom-website" style="padding-top:15px">
                {{ Form::model($data, array('route' => array('admin.custom-website.update', $data->id),'method'=>'PUT','class'=>'form')) }}
                <div class="row mb20">
                    <div class="col-sm-12">
                        <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                            {{ Form::label('name', 'Website Name', array('class' => 'col-sm-offset-1 col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::text('name', null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter domain name without tld')) }}
                                <label id='name_error' for='name' class='error' style='display: inline-block;'>{{ $errors->first('name') }}</label>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('company_id')?'has-error':'' }}">
                            {{ Form::label('company_id', 'Company', array('class' => 'col-sm-offset-1 col-sm-3 control-label required' )) }}
                            <div class="col-sm-7">
                                {{ Form::select('company_id', $companies ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select Company')) }}
                                <label id='company_id_error' for='company_id' class='error' style='display: inline-block;'>{{ $errors->first('company_id') }}</label>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                            {{ Form::label('domain', 'Custom Domain (optional)', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-5">
                                {{ Form::text('domain', null , array('class'=>'form-control ','placeholder'=>'Enter domain name without tld')) }}
                                <label id='domain_error' for='domain' class='error' style='display: inline-block;'>{{ $errors->first('domain') }}</label>
                                <label id='tld_error' for='tld' class='error' style='display: inline-block;'>{{ $errors->first('tld') }}</label>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::select('tld', CustomWebsite::$tld ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select TLD','id'=>'tld')) }}

                            </div>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="tab-pane" id="site-setting" style="padding-top:15px">
                {{ Form::model($data, array('route' => array('admin.custom-website.update', $data->id),'method'=>'PUT','class'=>'form')) }}
                {{ Form::hidden('setting-type','site')}}
                <div class="row mb10">
                    <div class="col-sm-12">
                        <div class="form-group ">
                            <h4 class="col-sm-12 subtitle mb5">Header Setting</h4>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('logo', 'Logo', array('class' => 'col-sm-offset-1 col-sm-3 control-label required' )) }}
                            <div class="col-sm-5">
                                <div class="input-group">
                                    {{ Form::text('logo', CustomWebsiteData::get_key($id,'logo') , array('class'=>'form-control col-sm-9','required'=>'required','placeholder'=>'Select an image','id'=>'logo')) }}
                                    <div class="input-group-btn">
                                        <a href="{{URL::to('3rdparty/filemanager/dialog.php?type=0&field_id=logo')}}" class="btn btn-default iframe-btn" type="button">Select File</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('header-email', 'Email (header)', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-5">
                                {{ Form::text('header-email', CustomWebsiteData::get_key($id,'header-email') , array('class'=>'form-control','placeholder'=>'Optional email for header')) }}
                            </div>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('header-phone', 'Phone (header)', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-5">
                                {{ Form::text('header-phone', CustomWebsiteData::get_key($id,'header-phone') , array('class'=>'form-control','placeholder'=>'Optional phone for header')) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group ">
                            <h4 class="col-sm-12 subtitle mb5">Footer Setting</h4>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('footer-about', 'Footer About', array('class' => 'col-sm-offset-1 col-sm-3 control-label' )) }}
                            <div class="col-sm-5">
                                {{ Form::textarea('footer-about', CustomWebsiteData::get_key($id,'footer-about') , array('class'=>'form-control','placeholder'=>'Footer About Us')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>


    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery('.iframe-btn').live('click', function(e) {
            jQuery(this).fancybox({
                'width'		: 900,
                'height'	: 600,
                'type'		: 'iframe',
                'autoScale'    	: false
            });
            e.preventDefault();
        });
        // Basic Form
        jQuery(".form").validate({
            highlight: function(element) {
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
        })

        jQuery('#company_id').select2({width:'100%',allowClear:true});
        jQuery('#tld').select2({width:'100%',allowClear:true});
    });
</script>
