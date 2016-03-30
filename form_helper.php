<?php

function select_options($array, $is_assoc = true) {
    foreach ($array as $key => $value) {
        if ($is_assoc)
            $k = $key;
        else 
            $k = $value;
    ?>
        <option value="<?= $value ?>"><?= $k ?></option>
    <?php
    }
}
