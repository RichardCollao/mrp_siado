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

<style type="text/css">
    .frame{
        width: 100%;
        height: 280px;
        border: 1px solid silver;
    }

    .logo {
        max-width: 500px;
        max-height: 200px;
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>

<h3>Logo</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <div class="frame">
            <img class="logo" src="<?php echo $data['src_logo']; ?>" title="logo" alt="" />
        </div>
    </div>
</div>

<br />
<div class="row">
    <div class="col-lg-6">
        <p>La imagen no debe superar los 400px de ancho y 150px de alto.</p>
        <!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo $data['action_form']; ?>">
            <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30" />-->
            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        <i class="fas fa-file"></i>&nbsp;Archivos
                        <input name="logo" style="display: none;" type="file">
                    </span>
                </label>
                <input class="form-control" readonly="" type="text">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="fas fa-paper-plane"></i>&nbsp;Subir
                    </button>
                </span>
            </div>
        </form>
        <div style="margin-bottom: 15px; margin-top: 15px">
            <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
        </div>
    </div>
</div>