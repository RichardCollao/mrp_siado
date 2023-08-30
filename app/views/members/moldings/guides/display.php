
<h3>Detalle Guía N° <?php echo $data['molding_guide']['number']; ?></h3>
<hr />

<br />
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <td style="min-width: 100px">Codigo</td>
            <td style="width: 100%">Pieza</td>
            <td style="min-width: 100px">Cantidad</td>
            <td style="min-width: 100px">Peso</td>
            <td style="min-width: 100px">Subtotal</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr  class="force-one-row">
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity']); ?></td>
                <td style="text-align: right;"><?php echo $row['weight']; ?></td>
                <td style="text-align: right;"><?php echo $row['total']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4" style="text-align: right;">Total</td>
            <td style="text-align: right;"><?php echo moneyFormat($data['guide']['total']); ?></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="5">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>
<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
</div>