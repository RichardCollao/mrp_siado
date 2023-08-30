<?php
Header::addJavascript(path::urlModules('/captcha/refresh.js'));

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Formulario de registro</h3>
    </div>

    <div class="panel-body">
       <form role="form" method="post" action="<?php echo $data['action_form']; ?>" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="col-lg-3 control-label">Nombre</label>
                <div class="col-lg-6">
                    <input class="form-control" id="name" name="name" type="text" maxlength="20" value="<?php echo $data['name']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="surname" class="col-lg-3 control-label">Apellido</label>
                <div class="col-lg-6">
                    <input class="form-control" name="surname" type="text" maxlength="20" value="<?php echo $data['surname']; ?>"/>
                </div>
            </div> 

            <div class="form-group">
                <label for="mail" class="col-lg-3 control-label">Correo</label>
                <div class="col-lg-6">
                    <input class="form-control" name="mail" type="text" maxlength="128" value="<?php echo $data['mail']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="password1" class="col-lg-3 control-label">Contraseña</label>
                <div class="col-lg-6">
                    <input class="form-control" name="password1" type="password" maxlength="20" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Confirmar contraseña</label>
                <div class="col-lg-6">
                    <input class="form-control" name="password2" type="password" maxlength="20" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class="col-lg-3 control-label">Telefono</label>
                <div class="col-lg-6">
                    <input class="form-control" name="phone" type="text" maxlength="12" value="<?php echo $data['phone']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="col-lg-3 control-label">Direccion</label>
                <div class="col-lg-6">
                    <input class="form-control" name="address" type="text" maxlength="128" value="<?php echo $data['address']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="captcha" class="col-lg-3 control-label">Imagen de seguridad</label>
                <div class="col-lg-6">
                    <div style="float: left">
                        <input class="form-control" type="text" style="width:100px" name="captcha" value="" size="8" maxlength="4" />
                    </div>

                    <div style="float: left; margin-left: 10px;padding: 5px">
                        <img id="img_captcha" src="<?php echo $data['img_captcha']; ?>" alt="" />
                        <img src="<?php echo $data['img_refresh']; ?>" onclick="captcha_refresh()" style="cursor:pointer;" alt="" /> 
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    <button type="reset" class="btn btn-default">Restablecer</button>
                </div>
            </div>
        </form>
    </div>
</div>