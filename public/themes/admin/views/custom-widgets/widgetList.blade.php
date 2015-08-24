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
            @foreach ($data as $widget)
            <a href="{{URL::route('widget-form',array('id'=>$widget->id))}}" data-link="{{URL::route('widget-form',array('id'=>$widget->id))}}" class="btn btn-default">{{$widget->name}}</a>
            @endforeach
        </div>
    </div>
</div>
<script>
    var CKEDITOR   = window.parent.CKEDITOR;
    function selectWidget(e){

        var oEditor = CKEDITOR.currentInstance , dialog = CKEDITOR.dialog.getCurrent();
        dialog.definition.contents[0].elements[0].src = $(e).data('link');
        dialog.show();
        console.log(dialog.definition.contents[0].elements[0]);
        //dialog = 'formWidget';
    }
</script>
<!--script>
    function addWidget(e){
        var oEditor = CKEDITOR.currentInstance;
        $.get($(e).data('link'),function(data){
            //oEditor.insertHtml(data);
            //oEditor.widgets.checkWidgets();

            var dialog = CKEDITOR.dialog, customwidget = new CKEDITOR.dom.element.createFromHtml( data );
            var ed = oEditor;
            //this.commitContent( data );

            //Object.keys(data).forEach(function(key) {
             //customwidget.setAttribute(data[key].name,data[key].value);
             //});

            var newFakeImage = ed.createFakeElement( customwidget, 'wnwidgets', 'wnwidget', true );
            //$(newFakeImage).attr('title',data.title);
            //$(newFakeImage).attr('alt',data.title);

            ed.insertElement( customwidget );
            ed.widgets.initOn(customwidget,'widgets');
            ed.widgets.checkWidgets();
            dialog.getCurrent().hide();
        })

    }
    var CKEDITOR   = window.parent.CKEDITOR;
    var editor = window.parent.CKEDITOR.editor;
    var oEditor   = CKEDITOR.currentInstance;
    /*var okListener = function(ev) {
        var dialog = this, data = {}, customwidget = new CKEDITOR.dom.element( 'widget' );
        var ed = this._.editor;
        this.commitContent( data );
        customwidget.setAttribute( 'id', data.id );
        customwidget.setAttribute( 'title', data.title );

        var newFakeImage = ed.createFakeElement( customwidget, 'wnwidgets', 'widget', true );
        $(newFakeImage).attr('title',data.title);
        $(newFakeImage).attr('alt',data.title);
        ed.insertElement( newFakeImage );
        // remove the listeners to avoid any JS exceptions
        CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
        CKEDITOR.dialog.getCurrent().removeListener("cancel", cancelListener);
    };
    var cancelListener = function(ev) {

        // remove the listeners to avoid any JS exceptions
        CKEDITOR.dialog.getCurrent().removeListener("ok", okListener);
        CKEDITOR.dialog.getCurrent().removeListener("cancel", cancelListener);
    };

    CKEDITOR.event.implementOn(CKEDITOR.dialog.getCurrent());
    //CKEDITOR.dialog.getCurrent().on("ok", okListener);
    CKEDITOR.dialog.getCurrent().on("cancel", cancelListener);*/
</script-->