<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<h3>Piezas de moldaje: <?php echo $data['molding']['name']; ?></h3>
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
        <tr class="thead">
            <td style="text-align: center;min-width:100px;width: 1%">
                <b>Codigo</b>
            </td>
            <td style="text-align: center;width:100%">
                <b>Nombre</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Peso</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Recibido</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Devuelto</b>
            </td>
            <td style="text-align: center;min-width:100px">
                <b>Saldo en obra</b>
            </td>
            <td style="text-align: center">
                <b>Operacion</b>
            </td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td>
                    <?php echo $row['code']; ?>
                </td>
                <td>
                    <?php echo $row['name']; ?>
                </td>
                <td style="text-align: right">
                    <?php echo $row['weight']; ?>
                </td>
                <td style="text-align: right">
                    <?php echo $row['total_reception']; ?>
                </td>
                <td style="text-align: right">
                    <?php echo $row['total_returned']; ?>
                </td>
                <td style="text-align: right">
                    <?php echo $row['total_reception'] - $row['total_returned']; ?>
                </td>
                <td style="text-align: right">
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_edit'] . $row['id_molding_piece']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_molding_piece']); ?>
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