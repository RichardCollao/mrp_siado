<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Requerimientos de entorno</h3>
    </div>    
    <div class="panel-body">
        <ul>
            <li>La version de PHP requerida es <b><?php echo $data['minimum_required_php_version']; ?></b> o superior.</li>
            <li>La directiva <b>get_magic_quotes_gpc()</b> debe estar desactivada.</li>
            <li>La libreria <b>PDO</b> es requerida.</li>
            <li>La libreria <b>Json</b> es requerida.</li>
            <li>La libreria <b>GD</b> es requerida.</li>
        </ul>
        <br />

        <!-- Solo si no existen conflictos se muestra el boton Siguiente -->
        <?php if (is_empty($data['conflicts'])): ?>
            No se han encontrado conflictos puede continuar.
            <br /><hr style="margin-left:0;"/>
            <a href="<?php echo $data['link_next'] ?>"><button type="button" class="btn btn-default">Siguiente</button></a>

        <?php endif; ?>
    </div>
</div>