<select style="width: 200px" class="form-control" 
        <?php if (!empty($id)): ?>
            id="<?php echo $id; ?>"
        <?php endif; ?>
        name="<?php echo $name; ?>">
    <option value="-1">Todos</option>
    <?php
    foreach ($options as $k => $v):
        echo helper_option($k, $v, $value) . PHP_EOL;
    endforeach;
    ?>
</select>