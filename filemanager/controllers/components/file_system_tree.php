<?php
/**
 * Thank you Phally, you be awesome, now I don't have to write my own.
 * http://www.frankdegraaf.net/2009/03/11/nested-tree-of-folders-and-files/
 */
class FileSystemTreeComponent extends Object
{

    public $path = null;
    private $offset = 0;
    private $Folder = null;

    public function tree($path = null, $showHidden = false)
    {
        $this->path = !empty($path) ? $path : $this->path;

        if (!empty($path)) {
            $this->offset = strlen($this->path);
            $this->Folder = new Folder();

            return array_merge_recursive(
                $this->generateTree(false, $showHidden),
                $this->generateTree(true, $showHidden)
            );
        } else {
            return false;
        }
    }

    private function generateTree($files = false, $showHidden = false)
    {
        $tree = $this->Folder->tree(
            $this->path,
            $showHidden ? null : !$showHidden,
            $files ? 'file' : 'dir'
        );

        $tree = $files ? array_reverse($tree) : $tree;

        $t = array();
        foreach ($tree as $current_path) {
            if ($current_path == $this->path) continue;
            $t = array_merge_recursive(
                $this->nest(
                    explode(DS, substr($current_path, $this->offset)),
                    $files),
                $t
            );
        }
        return $t;
    }

    private function nest($paths, $files)
    {
        $count = count($paths);
        if ($count > 1) {
            return array(
                current($paths) => $this->nest(
                    array_slice($paths, 1, $count),
                    $files
                )
            );
        } else {
            if ($files) {
                return array(current($paths));
            } else {
                return array(current($paths) => array());
            }
        }
    }
}

?>