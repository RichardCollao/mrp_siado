<h3>Vales</h3>
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

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <th style="min-width: 30px"></th>
            <th style="min-width: 100px">Número</th>
            <th style="width: 100%">Solicita</th>
            <th style="min-width: 200px">Autoriza</th>
            <th style="min-width: 100px">Fecha</th>
            <th style="min-width: 100px">Destino</th>
            <th style="min-width: 100px">observación</th>
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
                        echo HelperWebIconFontAwesome::btnUnlock($data['link_unlock'] . $row['id_voucher']);
                    else:
                        echo HelperWebIconFontAwesome::btnLock($data['link_lock'] . $row['id_voucher']);
                    endif;
                    ?>
                </td>
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td><?php echo $row['user_name_requesting']; ?></td>
                <td><?php echo $row['user_name_autorized']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['destination']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['observation']; ?></td>
                <td style="text-align: right;"><?php echo $row['count_items']; ?></td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_voucher']);?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnAttach($data['link_attachments'] . $row['id_voucher'], $row['count_files']); ?>
                </td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_voucher']); ?>
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_voucher']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_voucher']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="11">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>