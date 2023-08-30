<h3>Ordene de compra N°</h3>
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
            <th style="min-width: 100px">Número</th>
            <th style="min-width: 100px">Fecha</th>
            <th style="min-width: 100px">Estado</th>
            <th style="min-width: 100px">Solicitud</th>
            <th style="min-width: 100px">Observación</th>
            <th style="width:1%">Opciones</th>
        </tr>
    </thead>
    <tr class="force-one-row">
        <td style="text-align: right;"><?php echo $row['number']; ?></td>
        <td><?php echo $row['issue_date']; ?></td>
        <td style="max-width: 200px" class="truncate"><?php echo $row['status']; ?></td>
        <td style="max-width: 200px" class="truncate"><?php echo $row['observation']; ?></td>
        <td style="text-align: right;">
            <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_purchase_order']); ?>
            <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_purchase_order']); ?>
            &nbsp;
            <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_purchase_order']); ?> 
        </td>
    </tr>
</table>