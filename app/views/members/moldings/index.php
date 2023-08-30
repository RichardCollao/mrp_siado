<h3>Moldajes</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <a href="<?php echo $data['link_create'] ?>">
            <button type="button" class="btn btn-primary">Crear</button>
        </a>
    </div>
    <!--botón de la barra de búsqueda-->
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
            <td style="text-align: center">
                <b>Nombre</b>
            </td>
            <td style="text-align: center">
                <b>Proveedor</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Número CC</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Nombre CC</b>
            </td>
            <td style="text-align: center;min-width:100px ">
                <b>Piezas</b>
            </td>
            <td style="text-align: center;min-width:100px ">
                <b>Guías</b>
            </td>
            <td style="text-align: left" class="truncate">
                <b>Generar Reporte</b>
            </td>
            <td style="text-align: center">
                <b>operación</b>
            </td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td class="truncate">
                    <?php echo $row['name']; ?>
                </td>
                <td style="text-align: left">
                    <span data-toggle="tooltip" data-placement="right"><?php echo $row['providers_name']; ?></span>
                </td>
                <td style="text-align: center">
                    <span data-toggle="tooltip" data-placement="right"><?php echo $row['ea_number']; ?></span>
                </td>
                <td style="text-align: left" class="truncate">
                    <span data-toggle="tooltip" data-placement="right"><?php echo $row['ea_name']; ?></span>
                </td>
                <td style="text-align: center">
                    <?php echo HelperWebIconFontAwesome::btnGo($data['link_pieces'] . $row['id_molding'], ' Modulo'); ?>
                </td>
                <td style="text-align: center">
                    <?php echo HelperWebIconFontAwesome::btnGo($data['link_guides'] . $row['id_molding'], ' Modulo'); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnFileExcel('reports/moldings/' . $row['id_molding'], ' Exportar a excel'); ?>
                </td>
                <td style="text-align: right">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_molding']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_molding']); ?>
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