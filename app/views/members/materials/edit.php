<h3>Editar material</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>"  onkeypress="return event.keyCode != 13">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlentities($data['name']); ?>" 
                       list="list_materials" 
                       autocomplete="off"/>
            </div>
            <datalist id="list_materials">
                <?php
                foreach ($data['list_materials'] as $key => $value):
                    echo '<option value="' . htmlentities($value['name']) . '">';
                endforeach;
                ?>
            </datalist>
            <div class="form-group">
                <label for="critical_stock">Stock critico</label>
                <input type="text" class="form-control" name="critical_stock" value="<?php echo $data['critical_stock']; ?>" />
            </div>
            <div class="form-group">
                <label for="id_measure">Medida</label>
                <input id="fk_id_measure" name="fk_id_measure" type="text" style="width: 100%" class="fake-select form-control" />
            </div>
            <div class="form-group">
                <label for="id_expense_account">Cuenta de costo</label>
                <input id="fk_id_expense_account" name="fk_id_expense_account" type="text" style="width: 100%" class="fake-select form-control" />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    var selectMultiColumn = new SelectMultiColumn("fk_id_measure");
    selectMultiColumn.setDataJsonArray(<?php echo $data['json_list_measures']; ?>);
    selectMultiColumn.setValue("<?php echo $data['fk_id_measure']; ?>");
    selectMultiColumn.setNameColumns(['Abreviacion', 'Terminologia']);
    selectMultiColumn.setColumnsColSpan([1, 1]);
    selectMultiColumn.run();
    selectMultiColumn.setColumnsTextAlign(['left', 'left']);
    
    var selectMultiColumn2 = new SelectMultiColumn("fk_id_expense_account");
    selectMultiColumn2.setDataJsonArray(<?php echo $data['json_list_expense_accounts']; ?>);
    selectMultiColumn2.setValue("<?php echo $data['fk_id_expense_account']; ?>");
    selectMultiColumn2.setNameColumns(['Numero', 'Nombre de la cuenta']);
    selectMultiColumn2.setColumnsColSpan([1, 1]);
    selectMultiColumn2.run();
    selectMultiColumn2.setColumnsTextAlign(['left', 'left']);
</script>