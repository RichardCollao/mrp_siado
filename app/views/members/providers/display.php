<h3>Proveedor</h3>
<hr />

<table class="table table-bordered table-condensed table-hover table-striped">
    <tr>
        <td  style="width:200px">Razón social</td>
        <td><?php echo addslashes($data['provider']['name']); ?></td>
    </tr>
    <tr>
        <td>Giro</td>
        <td><?php echo $data['provider']['activity']; ?></td>
    </tr>
    <tr>
        <td>RUT</td>
        <td><?php echo $data['provider']['rut']; ?></td>
    </tr>
    <tr>
        <td>Correo</td>
        <td><?php echo $data['provider']['mail']; ?></td>
    </tr>
    <tr>
        <td>Direccion</td>
        <td><?php echo $data['provider']['address']; ?></td>
    </tr>
    <tr>
        <td>Telefono</td>
        <td><?php echo $data['provider']['phone']; ?></td>
    </tr>
</table>



<h3>Contactos</h3>
<hr />
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <td style="width: 100%">Nombre</td>
            <td style="min-width: 300px">Correo</td>
            <td style="min-width: 300px">Telefono</td>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td class="truncate"><?php echo $row['name']; ?></td>
                <td class="truncate"><?php echo $row['mail']; ?></td>
                <td class="truncate"><?php echo $row['phone']; ?></td>
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
    <a href="<?php echo $data['link_back'] ?>">
        <button type="button" class="btn btn-default">
            Volver
        </button>
    </a>
</div>
