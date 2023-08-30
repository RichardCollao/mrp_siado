<h3>Proveedores</h3>
<hr  />
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
<style>
    .width-col-1{min-width: 200px; max-width: 200px}
    .width-col-2{min-width: 200px; max-width: 200px}
    .width-col-3{min-width: 100px; max-width: 100px}
    .width-col-4{min-width: 250px; max-width: 200px}
    .width-col-5{min-width: 100px; max-width: 100px}
    .width-col-6{min-width: 50px; max-width: 80px; text-align: center}
    .width-col-7{min-width: 50px; max-width: 40px; text-align: center}
    .width-col-8{min-width: 100px; max-width: 70px; text-align: right}
</style>
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <th class="width-col-1">Razón social</th>
            <th class="width-col-2">Giro</th>
            <th class="width-col-3">RUT</th>
            <th class="width-col-4">Direccion</th>
            <th class="width-col-5">Telefono</th>
            <th class="width-col-6">Contactos</th>
            <th class="width-col-7">ver</th>
            <th class="width-col-8">Operacion</th>        
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td class="truncate width-col-1"><?php echo $row['name']; ?></td>
                <td class="truncate width-col-2"><?php echo $row['activity']; ?></td>
                <td class="truncate width-col-3"><?php echo $row['rut']; ?></td>
                <td class="truncate width-col-4"><?php echo $row['address']; ?></td>
                <td class="truncate width-col-5"><?php echo $row['phone']; ?></td>
                <td class="truncate width-col-6">
                    <?php echo HelperWebIconFontAwesome::btnAddressBook($data['link_contacts'] . $row['id_provider'], $row['count_contacts']); ?>
                </td>
                <td class="truncate width-col-7">
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_provider']); ?>
                </td>
                <td class="truncate width-col-8">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_provider']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_provider']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>