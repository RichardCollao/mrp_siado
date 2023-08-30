<h3>Detalle Orden de compra N° <?php echo $data['purchase_order']['number']; ?></h3>
<hr />
<div class="row">
    <div class="col-lg-12">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>">
            <table style="width: 100%">
                <tr class="force-one-row">
                    <td style="padding:5px; min-width: 100px">Codigo</td>
                    <td style="padding:5px; width: 100%">Material</td>
                    <td style="padding:5px; min-width: 100px">Cantidad</td>
                    <td style="padding:5px; min-width: 120px">Valor</td>
                    <td style="padding:5px; width: 1%"></td>
                </tr>
                <tr class="force-one-row" >
                    <td style="padding:5px">
                        <input type="text" class="form-control active-focus" name="code" value="<?php echo $data['code']; ?>" />
                    </td>
                    <td style="padding:5px">
                        <input id="fk_id_material" name="fk_id_material" type="text" style="width: 100%" class="form-control fake-select" />
                    </td>
                    <td style="padding:5px">
                        <input type="text" class="form-control" name="quantity" value="<?php echo $data['quantity']; ?>" />
                    </td>
                    <td style="padding:5px">
                        <input type="text" class="form-control" name="value" value="<?php echo $data['value']; ?>" />
                    </td>
                    <td style="padding:5px">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<br />
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <td style="min-width: 100px">Codigo</td>
            <td style="width: 100%">Material</td>
            <td style="min-width: 100px">Unidad</td>
            <td style="min-width: 100px">Cantidad</td>
            <td style="min-width: 100px">Precio</td>
            <td style="min-width: 100px">Subtotal</td>
            <td style="width:1%">Opciones</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: center"><?php echo $row['code']; ?></td>
                <td class="truncate"><?php echo $row['name']; ?></td>
                <td style="text-align: center"><?php echo $row['abbreviation']; ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['value']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['quantity'] * $row['value']); ?></td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_edit'] . $row['id_purchase_order_detail']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete_item'] . $row['id_purchase_order_detail']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="force-one-row">
            <td colspan="5" style="text-align: right;">Neto:</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['purchase_order']['total']); ?></td>
            <td></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="7">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>
<div style="margin-bottom: 15px;">
    <?php echo HelperWebIconFontAwesome::btnTerminate($data['link_finish']); ?>
</div>
<script type="text/javascript">
    var selectMultiColumn = new SelectMultiColumn("fk_id_material");
    selectMultiColumn.setDataJsonArray(<?php echo $data['json_list_materials']; ?>);
    selectMultiColumn.setValue("<?php echo $data['fk_id_material']; ?>");
    selectMultiColumn.setNameColumns(['Material', 'Medida', 'Cuenta']);
    selectMultiColumn.setColumnsColSpan([3, 1, 2]);
    selectMultiColumn.run();
    selectMultiColumn.setColumnsTextAlign(['left', 'center', 'left']);
</script>