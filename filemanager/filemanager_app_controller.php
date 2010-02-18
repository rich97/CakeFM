<?php
class FilemanagerAppController extends AppController
{

    public $protect = true;
    
    public $helpers = array('Time');

    public $components = array(
        'Filemanager.Config',
        'Filemanager.FileSystemTree'
    );

}
?>