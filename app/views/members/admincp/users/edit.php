<h3>Editar usuario</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form action="<?php echo $data['action_form']; ?>" method="post" autocomplete="off">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" maxlength="20" value="<?php echo $data['name']; ?>" />
            </div>    
            <div class="form-group">
                <label for="mail">Mail</label>
                <input type="email" class="form-control" name="mail" maxlength="64" value="<?php echo $data['mail']; ?>" autocomplete="off" />
            </div>
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" class="form-control" name="phone" maxlength="32" value="<?php echo $data['phone']; ?>" />
            </div> 
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" maxlength="64" value="<?php echo $data['password']; ?>" />
            </div>
            <div class="form-group">
                <label for="fk_id_establishment">Obra</label>
                <select class="form-control" name="fk_id_establishment">
                    <?php foreach ($data['list_establishments'] as $key => $value): ?>
                        <?php echo helper_option($key, $value, $data['fk_id_establishment']); ?>
                    <?php endforeach; ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="state_acount">Estado</label>
                <select class="form-control" name="state_acount" >
                    <?php foreach ($data['list_state_acounts'] as $key => $value): ?>
                        <?php echo helper_option($key, $value, $data['state_acount']); ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <button name="send" type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>