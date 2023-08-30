<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<h3>Materiales</h3>
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

<table class="table table-bordered table-condensed table-hover table-striped resizable-table"  data-resizable-columns-id="demo-table">
    <thead>
        <tr class="thead">
            <th style="text-align: center; width:300px">
                <b>Nombre</b>
            </th>
            <th  style="text-align: center">
                <b>Medida</b>
            </th>
            <th style="text-align: center;min-width:100px">
                <b>Número CC</b>
            </th>
            <th style="text-align: center;min-width:300px">
                <b>Nombre CC</b>
            </th>
            <th style="text-align: center;min-width:90px ">
                <b>Stock critico</b>
            </th>
            <th style="text-align: center;min-width:90px">
                <b>Recepcionado</b>
            </th>
            <th style="text-align: center;min-width:90px">
                <b>Rebajado</b>
            </th>
            <th style="text-align: center;min-width:90px">
                <b>Stock</b>
            </th>
            <th style="text-align: center; width:40px">
                <b>Rep.</b>
            </th>
            <th style="text-align: center">
                <b>Operacion</b>
            </th>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td class="truncate">
                    <?php echo $row['name']; ?>
                </td>
                <td style="text-align: center">
                    <span data-toggle="tooltip" data-placement="right"><?php echo $row['abbreviation']; ?></span>
                </td>
                <td style="text-align: center">
                    <span data-toggle="tooltip" data-placement="right"><?php echo $row['ea_number']; ?></span>
                </td>
                <td style="text-align: left" class="truncate">
                    <span data-toggle="tooltip" data-placement="right"><?php echo $row['ea_name']; ?></span>
                </td>
                <td style="text-align: right">
                    <?php echo numberFormat($row['critical_stock']); ?>
                </td>
                <td style="text-align: right">
                    <?php echo numberFormat($row['total_in_guides']); ?>
                </td>
                <td style="text-align: right">
                    <?php echo numberFormat($row['total_in_vouchers']); ?>
                </td>
                <td style="text-align: right">
                    <?php echo numberFormat($row['total_in_guides'] - $row['total_in_vouchers']); ?>
                </td>
                <td style="text-align: center">
                    <?php echo HelperWebIconFontAwesome::btnFileExcel($data['link_report_excel'] . $row['id_material']); ?>
                </td>
                <td style="text-align: right">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_material']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_material']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="10">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>