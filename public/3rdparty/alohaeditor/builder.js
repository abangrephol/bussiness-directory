$(window).load(function(){
    /*Aloha.ready( function() {
        $('.editable').each(function(i,el){
            $(el).aloha();
        })

    });*/
    //$('a').bind("click.myDisable", function() { return false; });


})
$(document).ready(function(){
    $("#body").gridmanager({
        debug: 1,
        colSelectEnabled : false,
        colClass :'editable-col',
        controlButtons: [['Full page',[12]],
            ['2 Columns',[6, 6]],
            ['3 Columns',[4, 4, 4]],
            ['4 Columns',[3, 3, 3, 3]],
            ['6 Columns',[2, 2, 2, 2, 2, 2]],
            ['2 Sidebar',[2, 8, 2]],
            ['Left Sidebar',[4, 8]],
            ['Right Sidebar',[8, 4]]],
        remoteURL: '/'
    });
});