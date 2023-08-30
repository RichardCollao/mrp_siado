<input style="width: 150px" class="form-control" 
       <?php if (!empty($id)): ?>
           id="<?php echo $id; ?>" 
       <?php endif; ?>
       type="text" name="<?php echo $name; ?>" placeholder="Todos" value="<?php echo $value; ?>">

