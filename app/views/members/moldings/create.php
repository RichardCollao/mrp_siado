<h3>Nuevo moldaje</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>" >
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" />
            </div>

            <div class="form-group">
                <label for="fk_id_provider">Proveedor</label>
                <input id="fk_id_provider" name="fk_id_provider" type="text" style="width: 100%" class="fake-select form-control" />
            </div>

            <div class="form-group">
                <label for="fk_id_expense_account">Cuenta de costo</label>
                <input id="fk_id_expense_account" name="fk_id_expense_account" type="text" style="width: 100%" class="fake-select form-control" />
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    </div>
</div>
<script type="text/javascript">
    var selectMultiColumn = new SelectMultiColumn("fk_id_provider");
    selectMultiColumn.setDataJsonArray(<?php echo $data['json_list_providers']; ?>);
    selectMultiColumn.setValue("<?php echo $data['fk_id_provider']; ?>");
    selectMultiColumn.setNameColumns(['Proveedor', 'RUT&nbsp;']);
    selectMultiColumn.setColumnsColSpan([3, 1]);
    selectMultiColumn.run();
    selectMultiColumn.setColumnsTextAlign(['left', 'right']);

    var selectMultiColumn2 = new SelectMultiColumn("fk_id_expense_account");
    selectMultiColumn2.setDataJsonArray(<?php echo $data['json_list_expense_accounts']; ?>);
    selectMultiColumn2.setValue("<?php echo $data['fk_id_expense_account']; ?>");
    selectMultiColumn2.setNameColumns(['Numero', 'Nombre de la cuenta']);
    selectMultiColumn2.setColumnsColSpan([1, 1]);
    selectMultiColumn2.run();
    selectMultiColumn2.setColumnsTextAlign(['left', 'right']);
</script>