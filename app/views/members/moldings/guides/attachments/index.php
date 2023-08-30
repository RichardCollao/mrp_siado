<script type="text/javascript">
    $(function () {
        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });
        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                if (input.length) {
                    input.val(log);
                } else {
                    if (log)
                        alert(log);
                }
            });
        });
    });
</script>

<h3>Archivos</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo $data['action_form']; ?>">
            <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
<!--            <input type="hidden" name="MAX_FILE_SIZE" value="30" />-->
            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        <span class="glyphicon glyphicon-file"></span>&nbsp;Archivos
                        <input name="files[]" style="display: none;" multiple="multiple" type="file">
                    </span>
                </label>
                <input class="form-control" readonly="" type="text">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-send"></span>&nbsp;Subir
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered table-condensed table-hover" style="margin-top: 15px">
    <tr class="thead">
        <td style="text-align: center">Nombre de archivo</td>
        <td style="text-align: center; width: 200px">Ver</td>
        <td style="text-align: center; width: 200px">Opciones</td>
    </tr>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: left"><?php echo $row; ?></td>
                <td>
                    <a href="<?php echo $data['link_download'] . $row; ?>">
                        <button  type="button" class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-save"></span>&nbsp;Descargar
                        </button>
                    </a>
                </td>
                <td style="text-align: right;">
                    <form role="form" method="post" action="<?php echo $data['action_delete']; ?>">
                        <input type="hidden" name="file" value="<?php echo $row; ?>" />
                        <button type="submit" class="btn btn-danger btn-xs">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">
                No se encontro ningun archivo...
            </td>
        </tr>
    <?php endif; ?>
</table>