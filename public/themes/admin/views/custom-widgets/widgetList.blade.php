<div class="container" style="margin-top:10px;">
    <div class="panel panel-default">
        <div class="panel-body">
            @foreach ($data as $widget)
            <a onclick="addWidget(this);return false;" data-link="{{URL::route('widget-data',array('id'=>$widget->id))}}" class="btn btn-default">{{$widget->name}}</a>
            @endforeach
        </div>
    </div>
</div>
<script>
    function addWidget(e){
        var oEditor = CKEDITOR.currentInstance;
        $.get($(e).data('link'),function(data){
            oEditor.insertHtml(data);
            CKEDITOR.dialog.getCurrent().hide();
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
</script>