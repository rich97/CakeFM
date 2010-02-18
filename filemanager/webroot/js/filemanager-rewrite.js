fmConfig = {
    
    basePath: '/',
    baseConnect: '/filemanager/request/ajax/method:',
    currentFolder: '',
    bindTo: window,
    modalContainer: null,
    connectors: [
        'listTree',
        'listFiles',
        'getFileInfo'
    ],
    
    init: function() {
        build = [];
        for (var x in fmConfig.connectors) {
            build[fmConfig.connectors[x]] = fmConfig.baseConnect + fmConfig.connectors[x];
        }
        fmConfig.connectors = build;
    }
    
};

fm = {
    
    init: function()
    {
        fmConfig.init();
        fm.setCurrentFolder(fmConfig.basePath);
        fm.setPannelDimentions();
        
        fm.listTree();
        fm.listFiles();
        fm.getFileInfo();
        fm.bindDraggable();
        fm.bindControls();
    },
    
    setCurrentFolder: function(setTo)
    {
        fmConfig.currentFolder = setTo;
    },

    setPannelDimentions: function()
    {
        var manager = $('#manager');
        var filelist = $('#filelist .border');
        
        var boundingBox = $(fmConfig.bindTo);
        var toolbar = $('#tools').outerHeight();
        
        var border = parseInt(manager.css('marginBottom'));
        var newHeight = boundingBox.height() - border - toolbar;
        
        manager.height(newHeight);
        filelist
            .height(
                newHeight - (
                    parseInt(filelist.css('paddingTop')) +
                    parseInt(filelist.css('paddingBottom'))
                )
            );
    },

    listTree: function()
    {
        $('#filetree .pad').fileTree(
            {
                root: fmConfig.currentFolder,
                script: fmConfig.connectors['listTree']
            //callback
            }, function(file, folder)
            {
                fm.setCurrentFolder(folder);
                fm.listFiles();
                fm.getFileInfo();
            }
        );
    },

    listFiles: function()
    {
        $('#filelist .pad').load(
            fmConfig.connectors['listFiles'],
            {
                dir: fmConfig.currentFolder
            }, function ()
            {
                fm.bindDraggable();
            }
        );

        fm.bindAction('#filelist a.fmFilename', 'getFileInfo');
    },
    
    getFileInfo: function (clicked) {
        var file = ($(clicked)) ? $(clicked).attr('rel') : '';
        $('#fileinfo .pad').load(
            fmConfig.connectors['getFileInfo'],
            {
                dir: fmConfig.currentFolder,
                file: file
            }
        )
    },
    
    folderNew: {

        test: function () {

            var successBinded = false;

            var options = { 
                target:        '#cboxLoadedContent div',
                url: fmConfig.baseConnect + 'folderNew',
                resetForm: true,
                success: function() {
                    $.fn.colorbox.resize();
                    successBinded = false;
                }
            };

            $.fn.colorbox(
                {
                    href: fmConfig.baseConnect + 'folderNew',
                    onComplete: function ()
                    {
                        $('#folderNew input').live(
                            'focus',
                            function()
                            {
                                if(successBinded === false) {
                                    $(this).parents('form').eq(0).submit(function() {
                                        $(this).ajaxSubmit(options);
                                        return false; 
                                    });
                                    successBinded = true;
                                }
                            }
                        );
                    }
                }
            );

        },

        test2: function () {
            alert('test2');
        }

    }, 
    
    uploader: function ()
    {
        
    },
    
    downloader: function ()
    {
        
    },
    
    imageEditor: function ()
    {
        
    },
    
    bindControls: function ()
    {
        $('.fmNewFolder').click (
            function (e) {
                e.preventDefault();
                fm.folderNew.test();
            }
        )   
        fm.bindAction('.fmUpload', 'uploader');
        fm.bindAction('.fmDownload', 'downloader');
    },

    bindAction: function(element, bindTo)
    {
        $(element).live (
            'click',
            function (e) {
                e.preventDefault();
                fm[bindTo](this);
            }
        )
    },
    
    bindDraggable: function() {
        $('#filelist a.fmDraggable').draggable(
            {
                helper: 'clone',
                opacity: 0.8
            }
        );
        $('#filetree a').droppable({
            drop: function (hey, there) {
                
            }
        });
    }
    
}

$(document).ready(function() {
    fm.init();
});