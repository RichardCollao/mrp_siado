<h3>Factura</h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <tr>
        <td  style="width:200px">Factura N°</td>
        <td><?php echo $data['bill']['number']; ?></td>
        <td  style="width:200px">Fecha</td>
        <td><?php echo $data['bill']['issue_date']; ?></td>
    </tr>
    <tr>
        <td>Proveedor</td>
        <td><?php echo $data['bill']['provider_name']; ?></td>
        <td>RUT</td>
        <td><?php echo rutFormat($data['bill']['provider_rut']); ?></td>
    </tr>
    <tr>
        <td>Orden de compra N°</td>
        <td colspan="3"><?php echo $data['bill']['po_number']; ?></td>
    </tr>
    <tr>
        <td>Observación</td>
        <td colspan="3"><?php echo $data['bill']['observation']; ?></td>
    </tr>
</table>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td style="width: 100%">Material</td>
            <td style="min-width: 100px">Unidad</td>
            <td style="min-width: 100px">Cantidad</td>
            <td style="min-width: 100px">Precio</td>
            <td style="min-width: 100px">Subtotal</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td><?php echo $row['name']; ?></td>
                <td style="text-align: center;"><?php echo $row['abbreviation']; ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['value']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['quantity'] * $row['value']); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="force-one-row">
            <td colspan="4" style="text-align: right;">Neto</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['bill']['total']); ?></td>
        </tr>
        <tr class="force-one-row">
            <td colspan="4" style="text-align: right;">Total con IVA</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['bill']['total'] + calculateIVA($data['bill']['total'])); ?></td>
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