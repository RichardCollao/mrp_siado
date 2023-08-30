<h3>Nuevo contacto</h3>
<hr />
<h5><?php echo $data['provider']['name']; ?></h5>
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>" onsubmit="return loginValidate(this);" onkeypress="return event.keyCode != 13">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['name'];?>" />
            </div>
            <div class="form-group">
                <label for="mail">Correo</label>
                <input type="text" class="form-control" name="mail" value="<?php echo $data['mail'];?>" />
            </div>
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $data['phone'];?>" />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    //<![CDATA[
    document.getElementById("form_mail").setAttribute("autocomplete", "off");
    //]]>
</script>