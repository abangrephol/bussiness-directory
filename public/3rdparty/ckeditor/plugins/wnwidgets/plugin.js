(function() {
    CKEDITOR.plugins.add('wnwidgets', {
        requires: ['iframedialog'],
        init: function(a) {
            CKEDITOR.dialog.addIframe('youtube_dialog', 'Insert Widgets', this.path + 'dialogs/youtube.html', 550, 200, function() { /*oniframeload*/ });
            a.addCommand('youtube', {
                exec: function(e) {
                    e.openDialog('youtube_dialog');
                }
            });
            a.ui.addButton('youtube', {
                label: 'Insert Widgets',
                command: 'youtube',
                //icon: this.path + 'images/redo.png',
                toolbar: 'mode,10'
            });
        }
    });
})();