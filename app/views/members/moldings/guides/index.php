<h3>Guías de moldaje: <pan><?php echo $data['molding']['name']; ?></pan></h3>
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
<a href="index.php"></a>
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <td style="min-width: 100px">Número</td>
            <td style="width: 100%">Tipo</td>
            <td style="width: 100%">Observación</td>
            <td style="min-width: 100px">Fecha</td>
            <td style="width:1%">Items</td>
            <td style="width:1%">Ver</td>
            <td style="width:1%">Adjuntos</td>
            <td style="width:1%">Opciones</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td class="truncate"><?php echo $row['type']; ?></td>
                <td class="truncate" style="min-width: 400px">
                    <?php
                    if (strlen($row['observation']) > 48) {
                        echo substr($row['observation'], 0, 48) . '...';
                    } else {
                        echo $row['observation'];
                    }
                    ?>
                </td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right;">
                    <?php echo $row['count_items']; ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_molding_guide']); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnAttach($data['link_attachments'] . $row['id_molding_guide'], ' ' .$row['count_files']); ?>
                </td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_molding_guide']); ?>
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_molding_guide']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_molding_guide']); ?>
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