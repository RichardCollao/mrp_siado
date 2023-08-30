<h3>Vale de salida</h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <tr>
        <td  style="width:200px">Vale N°</td>
        <td><?php echo $data['voucher']['number']; ?></td>
    </tr>
    <tr>
        <td>Solicita</td>
        <td><?php echo $data['voucher']['user_name_requesting']; ?></td>
    </tr>
    <tr>
        <td>Autoriza</td>
        <td><?php echo $data['voucher']['name_autorized']; ?></td>
    </tr>
    <tr>
        <td>Destino</td>
        <td><?php echo $data['voucher']['destination']; ?></td>
    </tr>
    <tr>
        <td>Fecha</td>
        <td><?php echo $data['voucher']['issue_date']; ?></td>
    </tr>
    <tr>
        <td>Observación</td>
        <td><?php echo $data['voucher']['observation']; ?></td>
    </tr>
</table>

<br />
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td style="width: 100%">Material</td>
            <td style="min-width: 100px">Unidad</td>
            <td style="min-width: 100px">Cantidad</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td><?php echo $row['name']; ?></td>
                <td style="text-align: center;"><?php echo $row['abbreviation']; ?></td>
                <td style="text-align: right;"><?php echo numberFormat($row['quantity']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>

<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
</div>