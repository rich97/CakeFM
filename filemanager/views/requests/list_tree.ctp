<ul class="jqueryFileTree" style="display: none;">
<?php
foreach ($files_inside as $type => $files) {
    if ($type == 0) {
        foreach ($files as $file) {
            ?>
            <li class="directory collapsed">
                <a href="#" rel="<?php echo htmlentities($list_dir . $file . DS); ?>">
                    <?php echo htmlentities($file); ?>
                </a>
            </li>
            <?php
        }
    }
}
?>
</ul>