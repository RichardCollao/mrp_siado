<h3>Editar proveedor</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>" onsubmit="return loginValidate(this);" onkeypress="return event.keyCode != 13">
            <div class="form-group">
                <label for="name">Razón social</label>
                <input type="text" class="form-control" name="name" value="<?php echo addslashes($data['name']);?>" />
            </div>
            <div class="form-group">
                <label for="name">Giro</label>
                <input type="text" class="form-control" name="activity" value="<?php echo $data['activity'];?>" />
            </div>
            <div class="form-group">
                <label for="rut">RUT</label>
                <input type="text" class="form-control" name="rut" value="<?php echo $data['rut'];?>" />
            </div>
            <div class="form-group">
                <label for="mail">Correo</label>
                <input type="text" class="form-control" name="mail" value="<?php echo $data['mail'];?>" />
            </div>
            <div class="form-group">
                <label for="address">Direccion</label>
                <input type="text" class="form-control" name="address" value="<?php echo $data['address'];?>" />
            </div>
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $data['phone'];?>" />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>