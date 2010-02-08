fmConfig = {
    
    basePath: '/',
    baseConnect: '/filemanager/request/ajax/method:',
    currentFolder: '',
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
    },
    
    setCurrentFolder: function(setTo)
    {
        fmConfig.currentFolder = setTo;
        $('#uploader h1').text('Current Folder: ' + fmConfig.currentFolder);
    },

    setPannelDimentions: function()
    {
        $('#splitter, #filetree, #fileinfo, #fileinfo, .vsplitbar')
            .height(
                $(window).height() - 50
            );
        $('#splitter')
            .splitter({sizeLeft: 200});
        $('#splitter #filemanager')
            .splitter({sizeRight: 300});
    },

    listTree: function()
    {
        $('#filetree').fileTree(
            {
                root: fmConfig.currentFolder,
                script: fmConfig.connectors['listTree'],
                multiFolder: false
            //callback
            }, function(file, folder)
            {
                fm.setCurrentFolder(folder);
                fm.listFiles();
            }
        );
    },

    listFiles: function()
    {
        $('#filelist').load(
            fmConfig.connectors['listFiles'],
            {
                dir: fmConfig.currentFolder
            }
        );

        fm.bindAction('#filelist a', 'getFileInfo')
    },
    
    getFileInfo: function (clicked) {
        var file = (clicked) ? clicked.attr('rel') : '';
        $('#fileinfo').load(
            fmConfig.connectors['getFileInfo'],
            {
                dir: fmConfig.currentFolder,
                file: file
            }
        )
    },

    bindAction: function(element, bindTo)
    {
        $(element).live(
            'click',
            function (e) {
                e.preventDefault();
                fm[bindTo](this);
            }
        )
    },
    
}

$(document).ready(function() {
    fm.init();
});