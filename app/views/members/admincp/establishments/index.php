<h3>Obras</h3>
<hr />
<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_create'] ?>">
        <button type="button" class="btn btn-primary">Crear</button>
    </a>
</div>

<table class="table table-bordered table-condensed">
    <tr class="thead">
        <td><b>Nombre</b></td>
        <td><b>Direccion</b></td>
        <td><b>Telefono</b></td>
        <td><b>Constructora</b></td>
        <td><b>RUT</b></td>
        <td><b>Acciones</b></td>
    </tr>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['name_business']; ?></td>
                <td><?php echo $row['rut_business']; ?></td>
                <td>
                    <a href="<?php echo $data['link_edit'] . $row['id_establishment']; ?>">
                        <button type="button" class="btn btn-default btn-xs">Editar</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">
                No se encontró ningún dato, prube cambiando el filtro de busqueda.
            </td>
        </tr>
    <?php endif; ?>
</table>