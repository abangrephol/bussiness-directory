<style>
    body{
        background: transparent;
    }
    .panel {
        border:1px solid #aaa;
    }
</style>

<div class="container" style="margin-top:10px; background:none;">
    <div class="panel panel-default">
        <div class="panel-body">
            <div id="template" style="display: none"><div class="wnwidgets">{{$data->template}}</div></div>
            <form id="widgetAdd" action="" class="form form-horizontal" method="post" data-wid="{{$data->id}}" data-type="{{$data->type}}" data-name="{{$data->name}}">
                <?php
                $wdata = json_decode($data->data);
                $forms = $wdata->form;
                foreach($forms as $form){
                ?>
                    <div class="form-group">
                        {{ Form::label('name', $form->label, array('class' => ' col-sm-3 control-label required' )) }}
                        <div class="col-sm-7">
                            <?php
                            if($form->multi=="multi"){
                                $formArr = explode('.',$form->name);
                                $formName = $form->name;
                                if(count($formArr)>1){
                                    $formNameLast = $formArr[count($formArr)-1];
                                    array_pop($formArr);
                                    $formName = implode('.',$formArr);

                                }
                            }
                                switch($form->type){
                                    case 'date':
                                    case 'file':
                                    case 'text' :
                                        if($form->multi=="multi"){
                                            for($i=0;$i<$form->multiNumber;$i++){
                                                echo Form::text($formName.".$i.".$formNameLast, $form->default , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$form->label));
                                            }
                                        }else{
                                            echo Form::text($form->name, $form->default , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$form->label));
                                        }
                                        break;
                                    case 'textarea' :
                                        if($form->multi=="multi"){
                                            for($i=0;$i<$form->multiNumber;$i++){
                                                echo Form::textarea($formName.".$i.".$formNameLast, null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$form->label));
                                            }
                                        }else{
                                            echo Form::textarea($form->name, null , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$form->label));
                                        }
                                        break;
                                    case 'select':
                                        $cbArray = [];
                                        for($i=0;$i<count($form->{'cb_label[]'});$i++){
                                            $cbArray[$form->{'cb_value[]'}[$i]] = $form->{'cb_label[]'}[$i];
                                        }
                                        echo Form::select($form->name, $cbArray ,$form->default , array('class'=>'select2','required'=>'required','placeholder'=>'Select '.$form->label));
                                        break;
                                    case 'icon':
                                        echo Form::select($form->name, \Category::$completeIcons ,$form->default , array('id'=>'icon','required'=>'required','placeholder'=>'Select '.$form->label));
                                        break;
                                }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>

<script>

    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
     var addWidget = function(e){
        var oEditor = CKEDITOR.currentInstance;
         var data = {'formData':$('form').serializeObject(),'wId':$('form').data('wid')},
             template = $('#template').html();

        //$.get($(e).data('link'),function(data){
            //oEditor.insertHtml(data);
            //oEditor.widgets.checkWidgets();

             template = Mustache.to_html(template,data.formData);
            var dialog = CKEDITOR.dialog, customwidget = new CKEDITOR.dom.element.createFromHtml( template );
            var ed = oEditor;
            this.commitContent( data );

            //Object.keys(data).forEach(function(key) {
            //customwidget.setAttribute(data[key].name,data[key].value);
            //});

            var newFakeImage = ed.createFakeElement( customwidget, 'wnwidgets', 'wnwidget' );
            //$(newFakeImage).attr('title',data.title);
            //$(newFakeImage).attr('alt',data.title);

            ed.insertElement( customwidget );

            ed.widgets.initOn(customwidget,'widgets',data);

            //ed.widgets.checkWidgets();

            //dialog.getCurrent().hide();
        //})

         dialog.getCurrent().removeListener("ok", addWidget);
    }
    var CKEDITOR   = window.parent.CKEDITOR;
    var editor = window.parent.CKEDITOR.editor;
    var oEditor   = CKEDITOR.currentInstance;

    CKEDITOR.event.implementOn(CKEDITOR.dialog.getCurrent());
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
    jQuery(document).ready(function(){
        jQuery('.select2').select2({width:'100%',allowClear:true});
        jQuery('#icon').select2({
            width:'100%',
            allowClear:true,
            // Specify format function for dropdown item
            formatResult: formatResult,
            // Specify format function for selected item
            formatSelection: formatSelection
        });

    });

</script>