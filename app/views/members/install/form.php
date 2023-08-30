<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Configuración de base de datos</h3>
    </div>

    <div class="panel-body">
        <div>
            <p>Para una instalacion local use "<b>localhost</b>", para una instalacion en servidor remoto use el nombre de su dominio ejemplo "<b>www.mypage.com</b>"</p>
        </div>
        <form class="form-horizontal" role="form" method="post" action="<?php echo $data['action_form']; ?>" >
            <div class="form-group">
                <label for="db_host" class="col-lg-3 control-label">Host</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="db_host" value="<?php echo $data['db_host'];?>">
                </div> 
            </div>
            <div class="form-group">
                <label for="db_type" class="col-lg-3 control-label">Gestor de base de datos</label>
                <div class="col-lg-6">
                    <select class="form-control" name="db_type">
                        <option>mysql</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="db_name" class="col-lg-3 control-label">Nombre base de datos</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="db_name" value="<?php echo $data['db_name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="db_user" class="col-lg-3 control-label">Usuario</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="db_user" value="<?php echo $data['db_user'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="db_pass" class="col-lg-3 control-label">Contraseña</label>
                <div class="col-lg-6">
                    <input type="password" class="form-control" name="db_pass" value="<?php echo $data['db_pass'];?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </div>
            </div>
        </form>
    </div>
</div>