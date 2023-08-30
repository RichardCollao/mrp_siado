<h3>Guías</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <?php echo HelperWebIconFontAwesome::btnCreate($data['link_create']); ?>
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
<a href="index.php"></a>
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <th style="min-width: 30px"></th>
            <th style="min-width: 100px">Número</th>
            <th style="width: 100%">Proveedor</th>
            <th style="min-width: 100px">OC</th>
            <th style="min-width: 100px">observación</th>
            <th style="min-width: 100px">Fecha</th>
            <th style="min-width: 150px">Neto</th>
            <th style="width:1%">Items</th>
            <th style="width:1%">Ver</th>
            <th style="width:1%">Adjuntos</th>
            <th style="width:1%">Opciones</th>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;">
                    <?php
                    if ($row['locked']):
                        echo HelperWebIconFontAwesome::btnUnlock($data['link_unlock'] . $row['id_guide']);
                    else:
                        echo HelperWebIconFontAwesome::btnLock($data['link_lock'] . $row['id_guide']);
                    endif;
                    ?>
                </td>
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['provider_name']; ?></td>
                <td style="text-align: right;"><?php echo $row['po_number']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['observation']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right;">
                    <?php echo $row['count_items']; ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_guide']);?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnAttach($data['link_attachments'] . $row['id_guide'], $row['count_files']);?>
                </td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_guide']); ?>
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_guide']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_guide']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="11">
                No se encontro ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>