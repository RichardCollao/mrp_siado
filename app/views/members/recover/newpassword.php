<div class="panel panel-default" style="margin-top: 15px">
    <div class="panel-heading">
        <h3 class="panel-title">Restablecer contraseña</h3>
    </div>    
    <div class="panel-body">
        <p>Por favor ingrese una nueva contraseña</p>
        <form role="form"  method="post" action="<?php echo $data['action_form']; ?>" onkeypress="return event.keyCode != 13">
            <div class="form-group">
                <label for="mail">Nueva contraseña</label><br />
                <input type="password" class="form-control" style="width:200px;" name="pass" value="" maxlength="204" />
            </div>
            <div class="form-group">
                <label for="mail">Confirme contraseña</label><br />
                <input type="password" class="form-control" style="width:200px;" name="pass_confirm" value="" maxlength="20" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</div>
