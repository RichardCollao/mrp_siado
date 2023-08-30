<h3>Editar obra</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form action="<?php echo $data['action_form']; ?>" method="post">
            <div class="form-group">
                <label for="name">Nombre constructora</label>
                <input type="text" class="form-control" name="name_business"  value="<?php echo $data['name_business']; ?>" />
            </div>    

            <div class="form-group">
                <label for="name">Giro</label>
                <input type="text" class="form-control" name="activity_business" value="<?php echo $data['activity_business']; ?>" />
            </div>

            <div class="form-group">
                <label for="rut">Rut constructora</label>
                <input type="text" class="form-control" name="rut_business" value="<?php echo $data['rut_business']; ?>" />
            </div>

            <div class="form-group">
                <label for="address">Direccion constructora</label>
                <input type="text" class="form-control" name="address_business" value="<?php echo $data['address_business']; ?>" />
            </div>

            <div class="form-group">
                <label for="phone">Telefono constructora</label>
                <input type="text" class="form-control" name="phone_business"  value="<?php echo $data['phone_business']; ?>" />
            </div>


            <div class="form-group">
                <label for="name">Nombre obra</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" />
            </div>    

            <div class="form-group">
                <label for="address">Direccion obra</label>
                <input type="text" class="form-control" name="address" value="<?php echo $data['address']; ?>" />
            </div>

            <div class="form-group">
                <label for="phone">Telefono obra</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $data['phone']; ?>" />
            </div>


            <button name="send"  type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
