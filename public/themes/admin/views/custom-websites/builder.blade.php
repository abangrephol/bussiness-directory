<div class="panel panel-default ">
    <div class="panel-heading isSticky editable">
        Pages
    </div>
    <div class="panel-body-nopadding">
        <div class="toolbar ">
            <ul class="filemanager-options panel-primary">
                <li>
                    <span>Choose one element</span>
                </li>
                <li>
                    <span class=" itemopt ">Text</span>
                </li>
                <li>
                    <span class=" itemopt ">Image</span>
                </li>
                <li class=" filter-type">
                    <span class="preview">Preview</span>
                </li>
                <li class=" filter-type">
                    <span class="save">Save</span>
                </li>
            </ul>
        </div>

        <iframe id="builder" width="100%" scrolling="no" class=""></iframe>

    </div>
</div>
<style>
    #builder {
        border: none;
    }
    .panel-default {
        border: 1px solid #aaa;
    }
    .filemanager-options li.btn {
        color: #fff;
    }
</style>
<script>
    jQuery(document).ready(function(){
        $('#builder').iFrameResize();

        jQuery('body').addClass('leftpanel-collapsed');
        jQuery('.menutoggle').addClass('menu-collapsed');
        jQuery('.nav-bracket .children').css({display: ''});

        jQuery('.toolbar').sticky({ topSpacing: 0 });
        var preview = false;
        jQuery('.preview').live('click',function(){
            if(preview){
                var windowjQuery = $('#builder')[0].contentWindow.$;
                var f = $('#builder').contents().find('#body');
                windowjQuery.data(f[0], 'gridmanager').initCanvas();
                preview = false;
            }else{
                var windowjQuery = $('#builder')[0].contentWindow.$;
                var f = $('#builder').contents().find('#body');
                windowjQuery.data(f[0], 'gridmanager').cleanup();
                windowjQuery.data(f[0], 'gridmanager').deinitCanvas();
                preview = true;
            }

        });
        jQuery('.save').live('click',function(){
            var windowjQuery = $('#builder')[0].contentWindow.$;
            var f = $('#builder').contents().find('#body');
            windowjQuery.data(f[0], 'gridmanager').saveremote();
        });


    });
    jQuery(window).load(function(){
        $('#builder').attr('src',"{{ route('custom-website.builderEditor',array('templateId'=>$templateId,'id'=>$id)) }}");
    })

</script>