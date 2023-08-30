<h3>Facturas</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <?php echo HelperWebIconFontAwesome::btnCreate($data['link_create']); ?>
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
        <tr class="thead force-one-row">
            <th style="min-width: 30px"></th>
            <th style="min-width: 100px">Número</th>
            <th style="width: 100%">Proveedor</th>
            <th style="min-width: 100px">OC</th>
            <th style="min-width: 100px">Observación</th>
            <th style="min-width: 100px">Fecha</th>
            <th style="min-width: 100px">Neto Fact.</th>
            <th style="min-width: 100px">Neto GD</th>
            <th style="width:1%">Items</th>
            <th style="width:1%">Ver</th>
            <th style="width:1%">Adjuntos</th>
            <th style="min-width: 100px">Guías asociadas</th>
            <th style="width:1%">Opciones</th>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;">
                    <?php
                    if ($row['locked']):
                        echo HelperWebIconFontAwesome::btnUnlock($data['link_unlock'] . $row['id_bill']);
                    else:
                        echo HelperWebIconFontAwesome::btnLock($data['link_lock'] . $row['id_bill']);
                    endif;
                    ?>
                </td>
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['provider_name']; ?></td>
                <td style="text-align: right;"><?php echo $row['po_number']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['observation']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total_guides']); ?></td>
                <td style="text-align: right;">
                    <?php echo $row['count_items']; ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_bill']); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnAttach($data['link_attachments'] . $row['id_bill'], $row['count_files']); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnCountGuides($data['link_view_guides'] . $row['id_bill'], $row['count_guides']);?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnAssociate($data['link_guides'] . $row['id_bill'], ' Asociar');?>
                </td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_bill']); ?>
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_bill']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_bill']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="13">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>