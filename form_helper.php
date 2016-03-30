<?php

function select_options($array, $is_assoc = true, $selected = '') {
    foreach ($array as $key => $value) {
        if ($is_assoc)
            $k = $key;
        else 
            $k = $value;
    ?>
        <option <?= $value === $selected ? 'selected=selected' : '' ?> value="<?= $value ?>"><?= $k ?></option>
    <?php
    }
}
