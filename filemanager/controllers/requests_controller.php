<?php
class RequestsController extends FilemanagerAppController
{
    
    public $uses = array();
    
    public $layout = 'empty';
    
    public $autoRender = false;
    
    private $__rootDir = '';
    
    private $__saveToDb = false;
    
    private $__folderObject = null;

    private $__fileObject = null;
    
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
        $this->render($method);
    }

    public function listTree ()
    {
        $folder = $this->__folderObject;
        $list_dir = $this->data['dir'];

        $folder->cd($this->__rootDir . DS . $list_dir);
        $files_inside = $folder->read(true, true);

        $this->set(compact('list_dir'));
        $this->set(compact('files_inside'));
    }
    
    public function listFiles ()
    {
        $folder = $this->__folderObject;
        $list_dir = $this->data['dir'];

        $folder->cd($this->__rootDir . DS . $this->data['dir']);
        $files_inside = $folder->read(true, true);

        $this->set(compact('list_dir'));
        $this->set(compact('files_inside'));
    }
    
    private function __config()
    {
        //Absolute path no trailing slash
        $this->__rootDir = Configure::read('Filemanager.root');
        if (!$this->__folderObject || !$this->__fileObject) {
            uses('Folder');
            uses('File');
            $this->__folderObject =& new Folder; 
        }
    }
    
}
?>