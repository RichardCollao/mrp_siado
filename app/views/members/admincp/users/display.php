<h3>Usuario</h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <tr>
        <td  style="width:200px">Nombre</td>
        <td><?php echo $data['user']['name']; ?></td>
    </tr>
    <tr>
        <td>Correo</td>
        <td><?php echo $data['user']['mail']; ?></td>
    </tr>
    <tr>
        <td>Telefono</td>
        <td><?php echo $data['user']['phone']; ?></td>
    </tr>
    <tr>
        <td>Fecha de registro</td>
        <td><?php echo $data['user']['date_reg']; ?></td>
    </tr>
    <tr>
        <td>Tipo de usuario</td>
        <td><?php echo $data['user']['type_user']; ?></td>
    </tr>
    <tr>
        <td>Estado de la cuenta</td>
        <td><?php echo $data['user']['state_acount']; ?></td>
    </tr>
    <tr>
        <td>Ultima actividad</td>
        <td><?php echo $data['user']['last_activity']; ?></td>
    </tr>
</table>
<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
</div>
