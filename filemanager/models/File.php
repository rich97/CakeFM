<?php
class File extends FilemanagerAppModel
{
    
    public $belongsTo = array(
        'Folder' => array(
            'className' => 'Filemanager.Folder'
        )
    );
    
}
?>