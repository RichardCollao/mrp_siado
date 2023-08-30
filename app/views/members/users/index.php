<h3>Usuarios</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <a href="<?php echo $data['link_create'];?>">
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
            <th><b>Nombre</b></th>
            <th><b>Correo</b></th>
            <th><b>Telefono</b></th>
            <th><b>Estado</b></th>
            <th><b>Fecha registro</b></th>
            <th style="text-align: right"><b>Opciones</b></th>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr>
                <td>
                    <?php echo $row['name']; ?>
                </td>
                <td>
                    <?php echo $row['mail']; ?>
                </td>
                <td>
                    <?php echo $row['phone']; ?>
                </td>
                <td>
                    <?php echo $row['state_acount']; ?>
                </td>
                <td>
                    <?php
//                    $date = date_create($row['date_reg']);
                    echo date_format(date_create($row['date_reg']), 'Y-m-d');
//                    echo $row['date_reg'];
                    ?>
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
            <td colspan="7">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>