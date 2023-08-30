<h3>Ultimas 10 ordenes de compra</h3>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <th style="text-align: center">Número</th>
            <th style="text-align: center">Proveedor</th>
            <th style="text-align: center">Estado</th>
            <th style="text-align: center">Fecha</th>
            <th style="text-align: center">Total OC</th>
            <th style="text-align: center">Total Facturado</th>
            <th style="text-align: center">Items</th>
        </tr>
    </thead>
    <?php if (!is_empty($data['purchase_orders'])): ?>
        <?php foreach ($data['purchase_orders'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td class="truncate"><?php echo $row['provider_name']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right"
                <?php if ($row['bills_total'] > $row['total']):echo ' class="bg-danger" ';
                endif;
                ?>>
        <?php echo moneyFormat($row['bills_total']); ?>
                </td>
                <td style="text-align: right;">
        <?php echo $row['count_items']; ?>
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



<h3>Ultimas 10 facturas</h3>
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td style="text-align: center">Número</td>
            <td style="text-align: center">Proveedor</td>
            <td style="text-align: center">Orden de compra</td>
            <td style="text-align: center">Estado</td>
            <td style="text-align: center">Fecha</td>
            <td style="text-align: center">Total</td>
            <td style="text-align: center">Items</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['bills'])): ?>
    <?php foreach ($data['bills'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td class="truncate"><?php echo $row['provider_name']; ?></td>
                <td style="text-align: right;"><?php echo $row['po_number']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right;">
        <?php echo $row['count_items']; ?>
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


<h3>Ultimas 10 guías</h3>
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td style="text-align: center">Número</td>
            <td style="text-align: center">Proveedor</td>
            <td style="text-align: center">Orden de compra</td>
            <td style="text-align: center">Estado</td>
            <td style="text-align: center">Fecha</td>
            <td style="text-align: center">Total</td>
            <td style="text-align: center">Items</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['guides'])): ?>
        <?php foreach ($data['guides'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td class="truncate"><?php echo $row['provider_name']; ?></td>
                <td style="text-align: right;"><?php echo $row['po_number']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right;">
                    <?php echo $row['count_items']; ?>
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