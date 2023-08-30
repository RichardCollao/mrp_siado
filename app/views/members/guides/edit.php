<?php header::addSheetsCSS(path::urlLibraries("/datepicker/css/datepicker.css")); ?>
<?php header::addJavascript(path::urlLibraries("/datepicker/js/bootstrap-datepicker.js")); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker();
    });
</script>
<h3>Editar guía</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>">
            <div class="form-group">
                <label for="number">Número</label>
                <input type="text" class="form-control active-focus" id="number" name="number" value="<?php echo $data['number']; ?>" />
            </div>
            <div class="form-group">
                <label for="fk_id_purchase_order">Orden de compra</label>
                 <input id="fk_id_purchase_order" name="fk_id_purchase_order" type="text" style="width: 100%" class="form-control fake-select" />
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
<script type="text/javascript">
    var selectMultiColumn = new SelectMultiColumn("fk_id_purchase_order");
    selectMultiColumn.setDataJsonArray(<?php echo $data['json_list_purchase_orders']; ?>);
    selectMultiColumn.setValue("<?php echo $data['fk_id_purchase_order']; ?>");
    selectMultiColumn.setNameColumns(['Numero', 'Proveedor']);
    selectMultiColumn.setColumnsColSpan([1, 1]);
    selectMultiColumn.run();
    selectMultiColumn.setColumnsTextAlign(['left', 'left']);
</script>