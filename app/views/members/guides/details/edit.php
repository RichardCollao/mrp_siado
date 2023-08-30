<h3>Editar detalle en Guía N° <?php echo $data['guide']['number']; ?></h3>
<hr />
<div class="row">
    <div class="col-lg-12">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>">
            <table style="width: 100%">
                <tr class="force-one-row">
                    <td style="padding:5px; width: 100%">Material</td>
                    <td style="padding:5px; min-width: 100px">Cantidad</td>
                    <td style="padding:5px; width: 1%"></td>
                </tr>
                <tr class="force-one-row" >
                    <td style="padding:5px">
                        <input id="fk_id_purchase_order_detail" name="fk_id_purchase_order_detail" type="text" style="width: 100%" class="form-control fake-select" />
                    </td>
                    <td style="padding:5px">
                        <input type="text" class="form-control" name="quantity" 
                               value="<?php echo $data['quantity']; ?>" />
                    </td>
                    <td style="padding:5px">
                        <button type="submit" class="btn btn-primary">Editar</button>
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
            <tr  class="force-one-row">
                <td><?php echo $row['name']; ?></td>
                <td style="text-align: center;"><?php echo $row['abbreviation']; ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['po_value']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_edit'] . $row['id_guide_detail']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete_item'] . $row['id_guide_detail']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4" style="text-align: right;">Total</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['guide']['total']); ?></td>
            <td></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="6">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>
<?php echo HelperWebIconFontAwesome::btnTerminate($data['link_finish']); ?>

<script type="text/javascript">
    var selectMultiColumn = new SelectMultiColumn("fk_id_purchase_order_detail");
    selectMultiColumn.setDataJsonArray(<?php echo $data['json_list_materials']; ?>);
    selectMultiColumn.setValue("<?php echo $data['fk_id_purchase_order_detail']; ?>");
    selectMultiColumn.setNameColumns(['Material', 'Medida', 'Cuenta']);
    selectMultiColumn.setColumnsColSpan([3, 1, 1, 2]);
    selectMultiColumn.run();
    selectMultiColumn.setColumnsTextAlign(['left', 'right', 'center', 'left']);
</script>