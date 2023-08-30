<h3>Facturas asociadas a orden de compra N° <?php echo $data['number']; ?></h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <td style="min-width: 100px">Número</td>
            <td style="width: 100%">Proveedor</td>
            <td style="min-width: 100px">OC</td>
            <td style="min-width: 100px">Fecha</td>
            <td style="min-width: 100px">Total</td>
            <td style="width:1%">Ver</td>
            <td style="width:1%">Guías asociadas</td>
            <td style="width:1%">Items</td>
            <td style="width:1%">Opciones</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td class="truncate"><?php echo $row['provider_name']; ?></td>
                <td style="text-align: right;"><?php echo $row['po_number']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right;"><?php echo moneyFormat($row['total']); ?></td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_bill']);?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnCountGuides($data['link_guides'] . $row['id_bill'], $row['count_guides']);?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnAssociate($data['link_guides'] . $row['id_bill'], ' Asociar');?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row['count_items']; ?>
                </td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_bill']); ?>
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_bill']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_bill']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="10">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>