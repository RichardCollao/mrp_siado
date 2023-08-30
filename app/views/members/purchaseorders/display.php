<h3>Orden de compra</h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <tr>
        <td  style="width:200px">Orden de compra N°</td>
        <td><?php echo $data['purchase_order']['number']; ?></td>
        <td>Fecha</td>
        <td><?php echo $data['purchase_order']['issue_date']; ?></td>
    </tr>
    <tr>
        <td>Proveedor</td>
        <td><?php echo $data['purchase_order']['provider_name']; ?></td>
        <td>RUT</td>
        <td><?php echo rutFormat($data['purchase_order']['provider_rut']); ?></td>
    </tr>
    <tr>
        <td>Atención</td>
        <td><?php echo $data['purchase_order']['vendor_name']; ?></td>
        <td>Contacto</td>
        <td><?php echo $data['purchase_order']['vendor_contact']; ?></td>
    </tr>
    <tr>
        <td>Cotización N°</td>
        <td><?php echo $data['purchase_order']['number_quotation']; ?></td>
        <td>Solicitud N°</td>
        <td><?php echo $data['purchase_order']['number_material_request']; ?></td>
    </tr>
    <tr>
        <td>Comprador</td>
        <td><?php echo $data['purchase_order']['dispatch_name']; ?></td>
        <td>Contacto</td>
        <td><?php echo $data['purchase_order']['dispatch_contact']; ?></td>
    </tr>
    <tr>
        <td>Obra</td>
        <td><?php echo $data['purchase_order']['establishments_name']; ?></td>
        <td>Dirección recepción</td>
        <td><?php echo $data['purchase_order']['dispatch_address']; ?></td>
    </tr>
    <tr>
        <td colspan="1">Forma de pago</td>
        <td colspan="3"><?php echo $data['purchase_order']['way_to_pay']; ?></td>
    </tr>
    <tr>
        <td colspan="1">Observación</td>
        <td colspan="3"><?php echo $data['purchase_order']['observation']; ?></td>
    </tr>
</table>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <td style="min-width: 100px">Código</td>
            <td style="width: 100%">Material</td>
            <td style="min-width: 100px">Unidad</td>
            <td style="min-width: 100px">Cantidad</td>
            <td style="min-width: 100px">Recibido</td>
            <td style="min-width: 100px">Saldo</td>
            <td style="min-width: 100px">Precio</td>
            <td style="min-width: 100px">Subtotal</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: center"><?php echo $row['code']; ?></td>
                <td class="truncate"><?php echo $row['name']; ?></td>
                <td style="text-align: center"><?php echo $row['abbreviation']; ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity']); ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['received']); ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity'] - $row['received']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['value']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['quantity'] * $row['value']); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="force-one-row">
            <td colspan="7" style="text-align: right;">Total</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['purchase_order']['total']); ?></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="6">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>
<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
</div>