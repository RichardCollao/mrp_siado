<h3>Usuarios</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <a href="<?php echo $data['link_create'] ?>">
            <button type="button" class="btn btn-primary">Crear</button>
        </a>
    </div>
    <!--Boton de la barra de busqueda-->
    <?php echo HelperWebIconFontAwesome::btnSearchBar(); ?>

    <!--Paginador-->
    <div style="margin-bottom: 15px;float: right">
        <?php echo $data['pagination']; ?>
    </div> 
    <div style="clear: both"></div>
</div>

<?php echo $data['bar_filters']; ?>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td><b>Nombre</b></td>
            <td><b>Correo</b></td>
            <td><b>Obra</b></td>
            <td><b>Telefono</b></td>
            <td><b>Tipo</b></td>
            <td><b>Estado</b></td>
            <td><b>Fecha de registro</b></td>
            <td><b>Ver</b></td>
            <td style="text-align: right"><b>Opciones</b></td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr>
                <td><?php echo $row['name']; ?> </td> 
                <td><?php echo $row['mail']; ?> </td>
                <td><?php echo $row['establishment']; ?></td>
                <td><?php echo $row['phone']; ?> </td>
                <td><?php echo $row['type_user']; ?> </td>
                <td><?php echo $row['state_acount']; ?> </td>
                <td><?php echo $row['date_reg']; ?> </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_user']); ?>
                </td>
                <td style="text-align: right">
                    <?php echo HelperWebIconFontAwesome::btnUserConfig($data['link_permissions'] . $row['id_user'], ' Permisos'); ?>
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_user']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_user']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>