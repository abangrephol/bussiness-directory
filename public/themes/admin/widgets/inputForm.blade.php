@if ($type=="text")
<div class="form-group {{ $errors->has($id)?'has-error':'' }}">
    {{ Form::label($id, $label, array('class' => (isset($singleRow)?'col-sm-2':(isset($right)?'':'col-sm-offset-1 ').'col-sm-3').' control-label '.(isset($required)?($required ? 'required' : '' ):'') )) }}
    <div class="{{ (isset($singleRow)?'col-sm-9':'col-sm-7') }}">
        {{ Form::text($id, isset($value) ? $value : null , array('class'=>'form-control',isset($readonly)? 'readonly': 'noronly' ,isset($required)?($required ? 'required' : 'norequired' ):'norequired')) }}
        <label id="{{ $id }}_error" for="{{ $id }}" class=" error" style="display: inline-block;">{{ $errors->first($id) }}</label>
    </div>
</div>
@elseif ($type=="select")
<div class="form-group {{ $errors->has($id)?'has-error':'' }}">
    {{ Form::label($id, $label, array('class' => (isset($singleRow)?'col-sm-2':(isset($right)?'':'col-sm-offset-1 ').'col-sm-3').' control-label '.(isset($required)?($required ? 'required' : '' ):'') )) }}
    <div class="{{ (isset($singleRow)?'col-sm-9':'col-sm-7') }}">
        {{ Form::select($id,isset($value)?$value:array(),isset($selected)?$selected:'',array('class'=>'form-control',isset($readonly)? 'readonly': 'noronly' ,isset($required)?($required ? 'required' : 'norequired' ):'norequired')) }}
        <label id="{{ $id }}_error" for="{{ $id }}" class=" error" style="display: inline-block;"></label>
    </div>
</div>
@elseif ($type=="textarea")
<div class="form-group {{ $errors->has($id)?'has-error':'' }}">
    {{ Form::label($id, $label, array('class' => (isset($singleRow)?'col-sm-2':(isset($right)?'':'col-sm-offset-1 ').' col-sm-3').' control-label '.(isset($required)?($required ? 'required' : '' ):'') )) }}
    <div class="{{ (isset($singleRow)?'col-sm-9':'col-sm-7') }}">
        {{ Form::textarea($id, isset($value) ? $value : null , array('rows'=>4,'class'=>'form-control',isset($readonly)? 'readonly': 'noronly' ,isset($required)?($required ? 'required' : 'norequired' ):'norequired')) }}
        <label id="{{ $id }}_error" for="{{ $id }}" class=" error" style="display: inline-block;"></label>
    </div>
</div>
@endif