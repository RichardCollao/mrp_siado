<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Configuración de administracion</h3>
    </div>    
    <div class="panel-body">

        <h3>Datos del administrador</h3>

        <form class="form-horizontal" role="form"  method="post" action="<?php echo $data['action_form']; ?>" >
            <div class="form-group">
                <label class="col-lg-2 control-label">Nombre</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="name"  maxlength="20" value="<?php echo $data['name']; ?>" />
                </div>
            </div>   
            <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input type="email" class="form-control" name="mail" value="<?php echo $data['mail']; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Contraseña</label>
                <div class="col-lg-10">
                    <input type="password" class="form-control" name="pass" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Confirme contraseña</label>
                <div class="col-lg-10">
                    <input type="password" class="form-control" name="pass_confirm" value="" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </div>
            </div>
        </form>
    </div>
</div>
