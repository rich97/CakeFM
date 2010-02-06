<?php
class Folder extends FilemanagerAppModel
{
    
    public $belongsTo = array(
        'Repository' => array(
            'className' => 'Filemanager.Repository'
        )
    );
    
    public $hasMany = array(
        'File' => array(
            'className' => 'Filemanager.File'
        )
    );
    
}
?>