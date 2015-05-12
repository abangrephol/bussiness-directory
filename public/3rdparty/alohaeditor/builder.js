$(document).ready(function(){
    $("#body").gridmanager({
        debug: 1,
        colSelectEnabled : false,
        colClass :'editable-col',
        controlButtons: [['Full page',[12]],
            ['2 Columns',[6, 6]],
            ['3 Columns',[4, 4, 4]],
            ['2 Sidebar',[3, 6, 3]],
            ['Left Sidebar',[4, 8]],
            ['Right Sidebar',[8, 4]]],
        remoteURL: '/'
    });
});