<?php header::addSheetsCSS(path::urlLibraries("/datepicker/css/datepicker.css")); ?>
<?php header::addJavascript(path::urlLibraries("/datepicker/js/bootstrap-datepicker.js")); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker();
    });
</script>

<h3>Nueva orden de compra</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>">

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">  
                        <label for="number">Número</label>
                        <input type="text" class="form-control active-focus" name="number" value="<?php echo $data['number']; ?>" />
                    </div>
                    <div class="col-lg-6">  
                        <label for="issue_date">Fecha</label>
                        <div class="input-group date" id="datepicker" data-date="<?php echo $data['issue_date']; ?>" data-date-format="yyyy-mm-dd">
                            <input class="form-control " type="text" id="issue_date" name="issue_date" value="<?php echo $data['issue_date']; ?>" />
                            <div class="input-group-addon add-on" style="cursor: pointer">
                                <?php echo HelperWebIconFontAwesome::iconCalendar(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="fk_id_provider">Proveedor</label>
                <input id="fk_id_provider" name="fk_id_provider" type="text" style="width: 100%" class="fake-select form-control" />
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="vendor_name">Nombre vendedor</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="<?php echo $data['vendor_name']; ?>" />
                            <div class="input-group-addon add-on" style="cursor: pointer" onclick="loadContacts()"
                                 data-toggle="modal" data-target="#myModal">
                                     <?php echo HelperWebIconFontAwesome::iconSearch(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="vendor_contact">Contacto vendedor</label>
                        <input type="text" class="form-control" id="vendor_contact" name="vendor_contact" value="<?php echo $data['vendor_contact']; ?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="dispatch_name">Nombre recepcionador</label>
                        <input type="text" class="form-control" name="dispatch_name" value="<?php echo $data['dispatch_name']; ?>" />
                    </div>
                    <div class="col-lg-6">
                        <label for="dispatch_contact">Contacto recepcionador</label>
                        <input type="text" class="form-control" name="dispatch_contact" value="<?php echo $data['dispatch_contact']; ?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="number">Dirección recepción</label>
                <input type="text" class="form-control" name="dispatch_address" value="<?php echo $data['dispatch_address']; ?>" />
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label for="number_material_request">Número de solicitud de material</label>
                        <input type="text" class="form-control" name="number_material_request" value="<?php echo $data['number_material_request']; ?>" />
                    </div>
                    <div class="col-lg-6"> 
                        <label for="number_quotation">Número de cotización</label>
                        <input type="text" class="form-control" name="number_quotation" value="<?php echo $data['number_quotation']; ?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="way_to_pay">Forma de pago</label>
                <input type="text" class="form-control" name="way_to_pay" value="<?php echo $data['way_to_pay']; ?>" />
            </div>
            <div class="form-group">
                <label for="observation">Observación</label>
                <textarea class="form-control" rows="3" name="observation"><?php echo $data['observation']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="footer">Pie de pagina</label>
                <input type="text" class="form-control" name="footer" value="<?php echo $data['footer']; ?>" />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    var selectMultiColumn = new SelectMultiColumn("fk_id_provider");
    selectMultiColumn.setDataJsonArray(<?php echo $data['json_list_providers']; ?>);
    selectMultiColumn.setValue("<?php echo $data['fk_id_provider']; ?>");
    selectMultiColumn.setNameColumns(['Razon', 'RUT&nbsp;&nbsp;']);
    selectMultiColumn.setColumnsColSpan([3, 1]);
    selectMultiColumn.run();
    selectMultiColumn.setColumnsTextAlign(['left', 'right']);
</script>

<script>
    function loadContacts() {
        var id_provider = $('#fk_id_provider').val();
        $.ajax({
            url: '<?php echo $data['link_ajaxcontacts']; ?>' + id_provider,
            data: {provider: id_provider},
            type: 'GET',
            dataType: 'json',
            success: function (json) {
                makeTable(json);
            },
            error: function (xhr, status) {
                // ...
            },
            complete: function (xhr, status) {
                //alert('Petición realizada');
            }
        });
    }

    function makeTable(obj) {
        $('#tcontacts').remove();
        table = $('<table>');
        table.attr('id', 'tcontacts');
        table.addClass('table');
        table.addClass('table-hover ');
        table.addClass('table-striped');
        table.css({'margin-bottom': 0});
        tr = $('<tr>');
        $.each(obj, function (index, value) {
            tr = $('<tr>');
            tr.append('<td>' + value.name + '</td>');
            tr.append('<td>' + value.mail + '</td>');
            tr.append('<td>' + value.phone + '</td>');
            tr.click(function () {
                var vendor_contact = '';
                if (value.mail.length > 0) {
                    vendor_contact += 'Correo: ' + value.mail;
                }
                if (value.mail.length > 0 && value.phone.length > 0) {
                    vendor_contact += ', ';
                }
                if (value.phone.length > 0) {
                    vendor_contact += 'Fono: ' + value.phone;
                }
                $('#vendor_name').val(value.name);
                $('#vendor_contact').val(vendor_contact);
                $('#myModal').modal('toggle');
            });
            table.append(tr);
        });
        $('#contacts').append(table);
    }
</script>

<!-- Modal -->
<div id="myModal" class="modal fade"tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Contactos</h4>
            </div>
            <div class="modal-body" id="contacts">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>