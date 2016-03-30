<?php

function select_tag($array, $is_assoc = true) {
    echo '<select class="form-control">';
    foreach ($array as $key => $value) {
        if ($is_assoc)
            $k = $key;
        else 
            $k = $value;
    ?>
        <option value="<?= $value ?>"><?= $k ?></option>
    <?php
    }
    echo '</select>';
}
