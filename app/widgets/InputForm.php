<?php
class InputForm {

    protected $type;

    public function register($type,$id,$name,$label='',$errors=array(),$option=[])
    {
        $this->$type = $type;
        $options = [
            'required' => false,
            'right' => false,
            'singleRow' => false,
            'placeholder' => '',
        ];
        $options = array_merge($options,$option);
        $template = "<div class='form-group {{errorclass}}'>"
            .Form::label($id, $label, array('class' => ($options['singleRow']?'col-sm-2':($options['right']?'':'col-sm-offset-1 ').'col-sm-3').' control-label '.($options['required']?'required':'') ))
            ."<div class='". ($options['singleRow']?'col-sm-9':'col-sm-7') ."'>"
            ."{{form}}"
            ."<label id='".$id."_error' for='".$id."' class=' error' style='display: inline-block;'>".$errors->first($id)."</label>"
            ."</div></div>";
        switch($type){
            case "text":
                $errorClass = $errors->has($id)?'has-error':'';
                $html = str_replace("{{errorclass}}",$errorClass,$template);
                $html = str_replace("{{form}}",Form::text($id, isset($options['value']) ? $options['value']: null , array('class'=>'form-control',isset($options['readonly'])? 'readonly': 'noronly' ,isset($options['required'])?($options['required'] ? 'required' : 'norequired' ):'norequired','placeholder'=>isset($options['placeholder'])?$options['placeholder']:'')),$html);
                return $html;
            break;
            case "select":
                $errorClass = $errors->has($id)?'has-error':'';
                $html = str_replace("{{errorclass}}",$errorClass,$template);
                $html = str_replace("{{form}}",Form::select($id,isset($options['value'])?$options['value']:array(),isset($options['selected'])?$options['selected']:null,array('class'=>'select2',!isset($options['multiple'])?:'multiple','data-placeholder'=>isset($options['placeholder'])?$options['placeholder']:'',isset($options['readonly'])? 'readonly': 'noronly' ,$options['required']?'required' : 'norequired')),$html);
                return $html;
                break;
            case "textarea":
                $errorClass = $errors->has($id)?'has-error':'';
                $html = str_replace("{{errorclass}}",$errorClass,$template);
                $html = str_replace("{{form}}",Form::textarea($id, isset($options['value']) ? $options['value'] : null , array('rows'=>4,'class'=>'form-control',isset($options['readonly'])? 'readonly': 'noronly' ,$options['required']?'required' : 'norequired')),$html);
                return $html;

                break;
            case "map":
                $errorClass = $errors->has($id)?'has-error':'';
                $html = str_replace("{{errorclass}}",$errorClass,$template);
                $html = str_replace("{{form}}",'<div id="'.$id.'" class="map" style="height: 300px"></div>',$html);
                return $html;
                break;
        }
    }

}

Widget::register('inputForm','InputForm');