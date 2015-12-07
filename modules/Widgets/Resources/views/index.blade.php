<style>
    body{
        background: transparent;
    }
    .panel {
        border:1px solid #aaa;
    }
    ol.sortable,ol{
        list-style: none;
        margin:0;
        -webkit-padding-start: 20px;
    }
    .panel-heading{
        padding:10px !important;
    }
    .placeholder {
        outline: 1px dashed #4183C4;
    }
</style>
<div class="container" style="margin-top:10px; background:none;">
    <div class="form form-horizontal">
        <div class="form-group {{ $errors->has('slug')?'has-error':'' }}">
            {{ Form::label('navigationId', 'Navigation template', array('class' => ' col-sm-4 control-label required' )) }}
            <div class="col-sm-7">
                {{ Form::select('navigationId', $navigations ,null , array('class'=>'select2','required'=>'required','placeholder'=>'Select Page Status')) }}
            </div>
        </div>
    </div>
    <ol class="sortable">
        @if(isset($menus))
            @foreach ($menus as $page)
            <li id="menu-{{$page->id}}" >
                <div class="panel panel-default  panel-alt">
                    <div class="panel-heading">

                        <div class="panel-btns">
                            <a href="" class="minimize maximize">+</a>
                        </div>
                        <h3 class="panel-title">{{$page->name}}</h3>
                    </div>
                    <div class="panel-body" style="display: none">
                        <form id="menuForm-{{$page->id}}" class="form form-horizontal">
                            <div class="form-group ">
                                {{ Form::label('name', 'Title', array('class' => ' col-sm-3 control-label required' )) }}
                                <div class="col-sm-7">
                                    {{ Form::text('name', $page->name , array('class'=>'form-control','required'=>'required',
                                    'placeholder'=>'Enter Menu Title')) }}
                                </div>
                            </div>
                            <div class="form-group ">
                                {{ Form::label('link', 'URL', array('class' => ' col-sm-3 control-label required' )) }}
                                <div class="col-sm-7">
                                    {{ Form::text('link', $page->link , array('class'=>'form-control','required'=>'required',
                                    'placeholder'=>'Enter Menu URL')) }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($page->children))
                <ol>
                    @foreach ($page->children as $page)
                        <li id="menu-{{$page->id}}" >
                            <div class="panel panel-default  panel-alt">
                                <div class="panel-heading">

                                    <div class="panel-btns">
                                        <a href="" class="minimize maximize">+</a>
                                    </div>
                                    <h3 class="panel-title">{{$page->name}}</h3>
                                </div>
                                <div class="panel-body" style="display: none">
                                    <form id="menuForm-{{$page->id}}" class="form form-horizontal">
                                        <div class="form-group ">
                                            {{ Form::label('name', 'Title', array('class' => ' col-sm-3 control-label required' )) }}
                                            <div class="col-sm-7">
                                                {{ Form::text('name', $page->name , array('class'=>'form-control','required'=>'required',
                                                'placeholder'=>'Enter Menu Title')) }}
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            {{ Form::label('link', 'URL', array('class' => ' col-sm-3 control-label required' )) }}
                                            <div class="col-sm-7">
                                                {{ Form::text('link', $page->link , array('class'=>'form-control','required'=>'required',
                                                'placeholder'=>'Enter Menu URL')) }}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
                @endif
            </li>
            @endforeach
        @else
            @foreach ($pages as $page)
            <li id="menu-{{$page->id}}" >
                <div class="panel panel-default  panel-alt">
                    <div class="panel-heading">

                        <div class="panel-btns">
                            <a href="" class="minimize maximize">+</a>
                        </div>
                        <h3 class="panel-title">{{$page->name}}</h3>
                    </div>
                    <div class="panel-body" style="display: none">
                        <form id="menuForm-{{$page->id}}" class="form form-horizontal">
                            <div class="form-group ">
                                {{ Form::label('name', 'Title', array('class' => ' col-sm-3 control-label required' )) }}
                                <div class="col-sm-7">
                                    {{ Form::text('name', $page->title , array('class'=>'form-control','required'=>'required',
                                    'placeholder'=>'Enter Menu Title')) }}
                                </div>
                            </div>
                            <div class="form-group ">
                                {{ Form::label('link', 'URL', array('class' => ' col-sm-3 control-label required' )) }}
                                <div class="col-sm-7">
                                    {{ Form::text('link', url($page->slug) , array('class'=>'form-control','required'=>'required',
                                    'placeholder'=>'Enter Menu URL')) }}
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </li>
            @endforeach
        @endif
    </ol>
</div>
<script>
    $(window).ready(function(){
        $('.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            items: 'li',
            helper:	'clone',
            opacity: .6,
            toleranceElement: '> div',
            placeholder: 'placeholder',
            isTree:true,
            maxLevels:2,
            excludeRoot:true,
            update:function(event,ui){
                console.log(ui);
            }
        });
        jQuery('.select2').select2({width:'100%',allowClear:true});
    });
    var CKEDITOR   = window.parent.CKEDITOR;
    var editor = window.parent.CKEDITOR.editor;
    var oEditor   = CKEDITOR.currentInstance;
    var okListener = function(ev) {
        var ed = this._.editor;
        var template = "<wnav><span>Menu</span></wnav>";
        var dialog = this,
                data = {},
                customwidget= new CKEDITOR.dom.element.createFromHtml( template ,ed.document);

        var menus = $('.sortable'),
            menusHierarchy = menus.nestedSortable('toHierarchy');
        var menusArray = [];
        function addMenus (item){
            if($.isArray(item)){
                $.each(item,function(i,val){
                    var formData = $('#menu-'+val.id).find('#menuForm-'+val.id).serializeObject();
                    val['name']= formData.name;
                    val['link']= formData.link;
                    if(!$.isEmptyObject(val.children)){
                        addMenus(val.children);
                    }
                });
            }else if(!$.isEmptyObject(item)){

                var formData = $('#menu-'+item.id).find('#menuForm-'+item.id).serializeObject();
                val['name']= formData.name;
                val['link']= formData.link;
                if(!$.isEmptyObject(item.children)){
                    addMenus(item.children);
                }

            }

        }

//        $.each(menusHierarchy,function(i,val){
//            var formData = $('#menu-'+val.id).find('#menuForm-'+val.id).serializeObject();
//            val['name']= formData.name;
//            val['link']= formData.link;
//            if(!$.isEmptyObject(val.children)){
//                val['children'] =
//            }
//        });

        addMenus(menusHierarchy);

        var navId = "{{$menuId}}";
        $.ajax({
            type: "GET",
            url:  window.location.origin + '/admin/widgets/navigation/save/'+navId,
            data: {
                "navigationId":$('#navigationId').val(),
                "menus":JSON.stringify(menusHierarchy)
            }
        }).done(function( result ) {
            data.navId = result;
            $(customwidget).attr('navId',result);
            ed.insertElement( customwidget );
            ed.widgets.initOn(customwidget,'wnnavigation',data);
        });
         // remove the listeners to avoid any JS exceptions
         CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
    };
    var cancelListener = function(ev) {

         // remove the listeners to avoid any JS exceptions
         CKEDITOR.dialog.getCurrent().removeListener("cancel", cancelListener);
     };

    CKEDITOR.event.implementOn(CKEDITOR.dialog.getCurrent());
    CKEDITOR.dialog.getCurrent().on("ok", okListener);
    CKEDITOR.dialog.getCurrent().on("cancel", cancelListener);

</script>