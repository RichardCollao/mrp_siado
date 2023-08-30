<?php Header::addJavascript(path::urlModules('/captcha/refresh.js')); ?>

<style>
    .logo{
        margin-top: 25px;
        border-radius: 15px 15px 15px 15px;
        -moz-border-radius: 15px 15px 15px 15px;
        -webkit-border-radius: 15px 15px 15px 15px;
    }

    .style-form{
        border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.25);
        -moz-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.25);
        box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.25);

        border:1px solid silver;
        padding:15px 30px;
        background-color: white;
    }
</style>

<div class="row" style="margin-top: 100px; display: flex">
    <div class="col-lg-5" style="text-align: center">
        <img class="logo" src="<?php echo $data['img_login']; ?>" title="Logo" />
    </div>

    <div class="col-lg-offset-2 col-lg-5">
        <div class="style-form">
            <h2><b>Recuperar contraseña</b></h2>
            <form id="form_recover_pass" method="post" action="<?php echo $data['link_form_action']; ?>" onkeypress="return event.keyCode != 13">
                <div class="form-group">
                    <p>Ingresa el correo con el cual te registraste y recibirás instrucciones de como recuperar tu contraseña.</p>
                </div> 
                <div class="form-group">
                    <label for="mail">Correo</label><br />
                    <input type="mail" class="form-control" name="mail" size="32" value="<?php echo $data['mail']; ?>"/>
                </div>
                <div class="form-group">
                    <label for="captcha">Imagen de seguridad</label><br />
                    <input type="text" class="form-control" style="width:100px;" name="captcha" value="" size="8" maxlength="4" />
                </div>
                <!-- Imagen captcha -->
                <div class="form-group">
                    <img id="img_captcha" src="<?php echo $data['img_captcha']; ?>" alt="" />
                    <img src="<?php echo $data['img_refresh']; ?>" onclick="captcha_refresh()" style="cursor:pointer;" alt="" />
                </div>
                <!-- End Imagen captcha -->
                <br />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
                    <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
                </div>

            </form>
        </div>
    </div>
</div>
