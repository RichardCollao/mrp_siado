<h3>Contactos</h3>
<hr />
<h4><?php echo $data['provider']['name']; ?></h4>
<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_create'] ?>">
        <button type="button" class="btn btn-primary">Crear</button>
    </a>
</div>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td style="width: 100%">Nombre</td>
            <td style="min-width: 300px">Correo</td>
            <td style="min-width: 300px">Telefono</td>
            <td style="min-width: 100px">Operacion</td>        
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td class="truncate"><?php echo $row['name']; ?></td>
                <td class="truncate"><?php echo $row['mail']; ?></td>
                <td class="truncate"><?php echo $row['phone']; ?></td>
                <td style="text-align: right;">
                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_provider_contact']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_provider_contact']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>
<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_back'] ?>">
        <button type="button" class="btn btn-default">
            Volver
        </button>
    </a>
</div>
