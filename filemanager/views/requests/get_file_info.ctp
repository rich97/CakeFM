<strong>Current File: <?php echo $name; ?></strong>
<?php
if (!empty($icon)) {
    if(!empty($image_size) && is_array($image_size)) {
        $image = $html->image(DS . 'app' . DS . 'webroot' . DS . $name . '.' . $icon);
        list($data['Width'], $data['Height']) = $image_size;
    }
    if(empty($image)) {
        $image = $html->image(DS . $this->plugin . DS . 'img' . DS . $icon . '.png');
    }
} else {
    $image = $html->image(DS . $this->plugin . DS . 'img' . DS . 'folder.png');
}
echo '<div class="bigIcon">' . $image . '</div>';
?>
<table>
    <tbody>
    <?php
    foreach ($data as $key => $value) {
        echo '<tr>';
            echo '<th>' . $key . '</th>';
            echo '<td>';
            if(is_array($value)) {
                foreach ($value as $sub) {
                    echo $sub . '<br>';
                }
            } else {
                echo $value;
            }
            echo '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>