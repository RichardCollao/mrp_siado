<h3>Guías asociadas a factura N° <?php echo $data['bill']['number']; ?></h3>
<hr />
<div class="row">
    <div class="col-lg-2">
        <h5>Factura N°</h5>
        <h5>Proveedor</h5>
        <h5>Orden de compra</h5>
        <h5>Fecha</h5>
    </div>
    <div class="col-lg-6">
        <h5><?php echo $data['bill']['number']; ?></h5>
        <h5><?php echo $data['bill']['provider_name']; ?></h5>
        <h5><?php echo $data['bill']['po_number']; ?></h5>
        <h5><?php echo $data['bill']['issue_date']; ?></h5>
    </div>
</div>
<br />

<?php if (!is_empty($data['guides'])): ?>
    <div class="row">
        <div class="col-lg-9">
            <form role="form" method="post" action="<?php echo $data['action_form']; ?>" >
                <div class="form-group">
                    <label for="fk_id_guide">Guía</label>
                    <select class="form-control" id="id_guide" name="id_guide" style="width: 200px">
                        <?php
                        foreach ($data['guides'] as $guide) {
                            echo helper_option($guide['id_guide'], $guide['number']);
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Asociar</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<hr />
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <td style="min-width: 100px">Número</td>
            <td style="width: 100%">Proveedor</td>
            <td style="min-width: 100px">OC</td>
            <td style="min-width: 100px">Fecha</td>
            <td style="min-width: 100px">Neto</td>
            <td style="width: 1%">Ver</td>
            <td style="width: 1%">Opciones</td>
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
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_guide']);?>
                </td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnDisassociate($data['link_disassociate'] . $row['id_guide'], ' Desasociar');?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>