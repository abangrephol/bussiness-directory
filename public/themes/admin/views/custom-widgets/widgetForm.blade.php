<?php
function formCreate($groupName,$input,$index=0){
    $inputName = $groupName=='none'? $input->name : $groupName.".$index.".$input->name;
    $inputNameFile = str_replace('.','',$inputName);
    switch($input->type){
        case 'date':
        case 'file':
            echo '<div class="input-group">';
            echo Form::text($inputName, $input->default , array('id'=>$inputNameFile,'class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$input->label));
            ?>
            <div class="input-group-btn"><a href="{{URL::to('3rdparty/filemanager/dialog.php?type=0&field_id='.$inputNameFile)}}" class="btn btn-default iframe-btn" type="button">Select File</a></div>
            <?php
            echo '</div>';
            break;
        case 'text' :
            echo Form::text($inputName, $input->default , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$input->label));
            break;
        case 'textarea' :
            echo Form::textarea($inputName, $input->default , array('class'=>'form-control','required'=>'required','placeholder'=>'Enter '.$input->label));
            break;
        case 'select':
            $cbArray = [];
            if(count($input->{'cb_label[]'})==1){
                $cbArray[$input->{'cb_value[]'}] = $input->{'cb_label[]'};
            }else{
                for($i=0;$i<count($input->{'cb_label[]'});$i++){
                    $cbArray[$input->{'cb_value[]'}[$i]] = $input->{'cb_label[]'}[$i];
                }
            }

            echo Form::select($inputName, $cbArray ,$input->default , array('class'=>'select2','required'=>'required','placeholder'=>'Select '.$input->label));
            break;
        case 'icon':
            echo Form::select($inputName, \Category::$completeIcons ,$input->default , array('id'=>'icon','required'=>'required','placeholder'=>'Select '.$input->label));
            break;
    }
}
?>
<style>
    body{
        background: transparent;
    }
    .panel {
        border:1px solid #aaa;
    }
    #fancybox-wrap,#fancybox-content{
        width:100% !important;
        height:100% !important;
        top:0!important;
        left:0!important;
    }
    #fancybox-wrap{
        position: fixed;
    }
</style>

<div class="container" style="margin-top:10px; background:none;">
    <div class="panel panel-default">
        <div class="panel-body panel-body-nopadding">
            <div id="template" style="display: none"><?php
                $tmplt = $data->template;
                if($data->type!='raw')
                    $tmplt = '<div class="wnwidgets">'.$tmplt.'</div>';
                echo $tmplt;
                ?></div>
            <form id="widgetAdd" action="" class="form form-horizontal form-bordered" method="post" data-wid="{{$data->id}}" data-type="{{$data->type}}" data-name="{{$data->name}}">
                <?php
                $wdata = json_decode($data->data);
                $groups = $wdata->group;
                array_push($groups,(object)['name'=>'none','label'=>'','multi'=>'single']);

                $forms = $wdata->form;
                if(count($groups)>0){
                    foreach($groups as $group){
                        foreach($forms as $form){
                            if($form->group == $group->name){
                                $group->input[] = $form;
                            }
                        }
                    }
                }
                //dd($groups);
                foreach($groups as $group){
                    //dd($group->input);
                    if($group->multi=='single'){
                        $groupName = $group->name=='none'?'none':$group->name;
                        if(isset($group->input)):
                    ?>
                    <div class="form-group">
                        {{ Form::label('name', $group->label, array('class' => ' col-sm-3 control-label required' )) }}
                        <div class="col-sm-7">
                            <?php
                            foreach($group->input as $input){
                            ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{ Form::label('name', $input->label, array('class' => '' )) }}
                                        <?php
                                        formCreate($groupName,$input,0);
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>

                        </div>
                    </div>
                    <?php

                        endif;
                    }else if($group->multi=='multi'){

                        $groupName = $group->name=='none'?'none':$group->name;
                        if(isset($group->input)){
                            ?>
                            <div class="form-group">
                                {{ Form::label($group->name, $group->label, array('class' => ' col-sm-3 control-label required' )) }}
                                <div class="col-sm-7">
                                    <?php
                            for($i=0;$i<$group->multiNumber;$i++){

                                foreach($group->input as $input){
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12 mb20">
                                            {{ Form::label('name', $input->label." ".($i+1), array('class' => '' )) }}
                                            <?php
                                            formCreate($groupName,$input,$i);
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>

                                </div>
                            </div>
                            <?php
                        }

                    }else{

                    }
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
        jQuery('.iframe-btn').live('click', function(e) {
            jQuery(this).fancybox({
                'width'		: '100%',
                'type'		: 'iframe',
                'centerOnScroll' : true
            });
            e.preventDefault();
        });

    });

</script>