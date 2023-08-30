<?php header::addSheetsCSS(path::urlLibraries("/datepicker/css/datepicker.css")); ?>
<?php header::addJavascript(path::urlLibraries("/datepicker/js/bootstrap-datepicker.js")); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker();
    });
</script>
<h3>Nueva guía de moldaje</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>">
            <div class="form-group">
                <label for="number">Número</label>
                <div class="row">
                    <div class="col-xs-3">
                        <input type="text" class="form-control active-focus" id="number" name="number" value="<?php echo $data['number']; ?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select class="form-control" id="type" name="type" style="width: 200px">
                        <?php
                        foreach ($data['list_guides_types'] as $key => $value) {
                            echo helper_option($key, $value, $data['type']);
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="issue_date">Fecha</label>
                <div class="input-group date" id="datepicker" data-date="<?php echo $data['issue_date']; ?>" data-date-format="yyyy-mm-dd">
                    <input class="form-control" type="text" id="issue_date" name="issue_date" value="<?php echo $data['issue_date']; ?>" />
                    <div class="input-group-addon add-on" style="cursor: pointer">
                        <?php echo HelperWebIconFontAwesome::iconCalendar(); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="observation">Observación</label>
                <textarea class="form-control" rows="3" name="observation"><?php echo $data['observation']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>