<h3>Guía</h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <tr>
        <td  style="width:200px">Guía N°</td>
        <td><?php echo $data['guide']['number']; ?></td>
        <td>Fecha</td>
        <td><?php echo $data['guide']['issue_date']; ?></td>
    </tr>
    <tr>
        <td>Proveedor</td>
        <td><?php echo $data['guide']['provider_name']; ?></td>
        <td>RUT</td>
        <td><?php echo rutFormat($data['guide']['provider_rut']); ?></td>
    </tr>
    <tr>
        <td>Orden de compra N°</td>
        <td colspan="3"><?php echo $data['guide']['po_number']; ?></td>
    </tr>
    <tr>
        <td>Observación</td>
        <td colspan="3"><?php echo $data['guide']['observation']; ?></td>
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
                <td style="text-align: right;"><?php echo moneyFormat($row['po_value']); ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="force-one-row">
            <td colspan="4" style="text-align: right;">Total</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['guide']['total']); ?></td>
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