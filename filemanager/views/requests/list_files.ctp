<?php if(!empty($files_inside[1])) { ?>
<table id="list_files">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th class="iconpad">File Name</th>
            <th>Size</th>
            <th>Modified</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $root = Configure::read('Filemanager.root');
    $count = 0;
    foreach ($files_inside as $type => $files) {
        if ($type == 1) {
            foreach ($files as $file) {
                $info =& new File($root . $list_dir . $file);
                $class = $count % 2 ? 'odd' : '';
                $count++;
                ?>
                <tr class="<?php echo $class; ?>">
                    <td>
                        <?php echo $html->link('', '#', array('class' => 'fmDraggable')) ?>
                    </td>
                    <td>
                    <?php
                        $name = $info->name() . '.' . $info->ext();
                        $directory = $root . $list_dir;
                        echo $html->link(
                            $name,
                            array(
                                'controller' => 'requests',
                                'action' => 'dispatch',
                                'method' => 'getFileInfo'
                            ),
                            array(
                                'class' => 'fmFilename file ext_' . $info->ext(),
                                'rel' => $name
                            )
                        );
                    ?>
                    </td>
                    <td><?php echo $info->size(); ?></td>
                    <td><?php echo $time->niceShort($info->lastChange()); ?></td>
                </tr>
                <?php
            }
        }
    }
    ?>
    </tbody>
</table>
<?php } else {
?>
<strong>Folder is empty</strong>
<?php
}
?>