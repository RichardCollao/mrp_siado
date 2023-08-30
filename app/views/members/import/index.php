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
    <div style="float: left;margin-left:15px">
        <button class="btn btn-default" type="button" data-toggle="collapse" 
                data-target="#filter-collapse" aria-expanded="true" aria-controls="collapseExample">
            <span class="glyphicon glyphicon-search"></span>&nbsp;Buscar
        </button>
    </div>

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
                <b>Medida</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Número CC</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Nombre CC</b>
            </td>
            <td style="text-align: center;min-width:90px ">
                <b>Stock critico</b>
            </td>
            <td style="text-align: center;min-width:90px">
                <b>Recepcionado</b>
            </td>
            <td style="text-align: center;min-width:90px">
                <b>Rebajado</b>
            </td>
            <td style="text-align: center;min-width:90px">
                <b>Stock</b>
            </td>
            <td>
                <b>Rep.</b>
            </td>
            <td style="text-align: center">
                <b>Operacion</b>
            </td>
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
                    <?php echo numberFormat($row['stock']); ?>
                </td>
                <td style="text-align: center">
                    <a href="<?php echo path::urlDomain('reports/material/' . $row['id_material']); ?>"  data-toggle="tooltip" title="Exportar detalle">
                        <button type="button" class="btn btn-xs" style="background-color: #66bb6a; color: #fafafa;">
                            <span class="glyphicon glyphicon-export"></span>
                        </button>
                    </a>
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