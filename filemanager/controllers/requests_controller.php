<?php
class RequestsController extends FilemanagerAppController
{
    
    public $uses = array();
    
    public $layout = 'empty';
    
    public $autoRender = false;
    
    private $__rootDir = '';
    
    private $__saveToDb = false;

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
        $list_dir = $this->data['dir'];
        $folder =& new Folder($this->__rootDir . DS . $list_dir);

        $files_inside = $folder->read(true, true);

        $this->set(compact('list_dir'));
        $this->set(compact('files_inside'));
    }
    
    public function listFiles ()
    {
        $list_dir = $this->data['dir'];
        $folder =& new Folder($this->__rootDir . DS . $list_dir);

        $files_inside = $folder->read(true, true);

        $this->set(compact('list_dir'));
        $this->set(compact('files_inside'));
    }
    
    public function getFileInfo ()
    {
        $file = $this->data['file'] !== 'null'? $this->data['file'] : '';
        $full_path = $this->__rootDir . $this->data['dir'] . $file;

        $path = str_replace($this->__rootDir, '', $full_path);
        if (file_exists($full_path) and is_dir($full_path)) {
            $folder =& new Folder($full_path);
            list($folders, $files) = $folder->read(true, true);
            $name = basename(rtrim($full_path, '/'));
            $data = array(
                'Path' => $path,
                'Contains' => array (
                    count($files) . ' file(s)',
                    count($folders) . ' folder(s)'
                ),
                'Total Size' => $folder->dirsize()
            );
        } else {
            $file =& new File($full_path);
            $name = $file->name();
            $ext = $file->ext();
            $this->set('icon', $ext);
            $this->set('image_size', getimagesize($full_path));
            $data = array(
                'Type' => $file->ext(),
                'Size' => $file->size(),
                'Modified' => $file->lastChange(),
            );
        }
        $this->set(compact('name'));
        $this->set(compact('full_path'));
        $this->set(compact('data'));
    }
    
    public function folderNew ()
    {
        if (!empty($_POST)) {
            debug($_POST);
        }
    }
    
    private function __config()
    {
        //Absolute path no trailing slash
        $this->__rootDir = Configure::read('Filemanager.root');
    }
    
}
?>