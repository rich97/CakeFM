<?php
class Folder extends FilemanagerAppModel
{

    public $hasMany = array(
        'Folder' => array(
            'className' => 'Filemanager.Folder'
        )
    );
    
}
?>