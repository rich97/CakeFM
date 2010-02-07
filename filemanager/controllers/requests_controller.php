<?php
class RequestsController extends FilemanagerAppController
{
    
    public $uses = array();
    
    public $autoRender = false;
    
    public $layout = 'empty';
    
    private $__rootDir = '';
    
    private $__saveToDb = false;
    
    private $__folderObject = null;
    
    public function dispatch()
    {
        if (empty($this->params['named']['method'])) {
            die ('No method to call');
        }

        $method = $this->params['named']['method'];
        if (!method_exists($this, $method)) {
            die ('Call to undefined method ' . $method . ' in RequestsContoller');
        }

        $this->__config();
        $this->data = $_POST;
        $this->$method();
    }

    public function listTree ()
    {
        $folder = $this->__folderObject;
        $folder->cd($this->__rootDir . DS . $this->data['dir']);
        $files_inside = $folder->read(true, true);
        echo '<ul class="jqueryFileTree" style="display: none;">';
        foreach ($files_inside as $type => $files) {
            if ($type == 0) {
                foreach ($files as $file) {
                    echo
                    '<li class="directory collapsed">' .
                        '<a href="#" rel="' .
                            htmlentities($this->data['dir'] . $file . DS) .
                        '">' .
                            htmlentities($file) .
                        '</a>' .
                    '</li>';
                }
            }
        }
        echo '</ul>';
    }
    
    private function __config()
    {
        //Absolute path no trailing slash
        $this->__rootDir = Configure::read('Filemanager.root');
        if (!$this->__folderObject) {
            uses('Folder');
            $this->__folderObject =& new Folder; 
        }
    }
    
}
?>