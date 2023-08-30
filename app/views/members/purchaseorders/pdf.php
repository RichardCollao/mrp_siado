<html>
    <head>
        <style type="text/css">
            html {margin: 0;}

            body {
                /*font-family: "Times New Roman", serif;*/
                font-family: Verdana,Geneva,sans-serif;
                font-size: 22px;
                color:#000;
            }

            table{
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 5px;
            }

            td{padding: 5px;vertical-align: top;}

            /* Estilo para tabla solo con bordes internos*/
            .table-internal-border{border: 1px solid black; margin: 0}
            .table-internal-border td{border: 1px solid black;}
            .table-internal-border tr:first-child td {border-top: 0;}
            .table-internal-border tr:last-child td {border-bottom: 0;}
            .table-internal-border td:first-child {border-left: 0;}
            .table-internal-border td:last-child {border-right: 0;}

            /* fin estilos bordes de tabla */
            .default_border_color{border: 1px solid black;}

            .margin-top{margin-top: 15px;}
        </style>
    </head>
    <body>
        <div style="margin: 40px;">
            <div>
                <table>
                    <tr>
                        <td style="width:25%">
                            <div>
                                <img style="width: 400px; height: 150px" 
                                     src="<?php echo $data['src_logo']; ?>" alt="" />
                            </div>
                        </td>
                        <td style="width:50%;">
                            <div style="text-align: center;" >
                                <div style="font-size: 32px;">
                                    <b><?php echo $data['establishment']['name_business']; ?></b>
                                </div>
                                <div>
                                    <b>RUT: <?php echo rutFormat($data['establishment']['rut_business']); ?></b>
                                </div>
                                <div>
                                    <b><?php echo $data['establishment']['address_business']; ?></b>
                                </div>
                                <div>
                                    <b>Teléfono: <?php echo $data['establishment']['phone_business']; ?></b>
                                </div>
                            </div>
                        </td>
                        <td style="width:25%;padding: 0">
                            <div style="font-size: 32px;text-align: center;">
                                <div style="margin-top: 20px;margin-right: 0;">
                                    <b>ORDEN DE COMPRA</b>
                                </div>
                                <div style="margin-top: 20px;">
                                    <b><?php echo $data['purchase_order']['number']; ?></b>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="margin-top">
                <table>
                    <tr>
                        <td style="width: 50%; padding: 0">
                            <div style="border: 1px">
                                <table>
                                    <tr>
                                        <td style="width:250px">Proveedor</td>
                                        <td style="width:10px">:</td>
                                        <td><?php echo $data['provider']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>RUT</td>
                                        <td>:</td>
                                        <td><?php echo rutFormat($data['provider']['rut']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dirección</td>
                                        <td>:</td>
                                        <td><?php echo $data['provider']['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Atención</td>
                                        <td>:</td>
                                        <td><?php echo $data['purchase_order']['vendor_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contacto</td>
                                        <td>:</td>
                                        <td><?php echo $data['purchase_order']['vendor_contact']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div style="padding: 10px">
                                Agradecemos entregar por nuestra cuenta lo siguiente:
                            </div>
                        </td>
                        <td style="width: 10%;">
                            &nbsp;
                        </td>
                        <td style="width: 40%; padding: 0" >
                            <div style="border-width: 1px">
                                <table>
                                    <tr>
                                        <td style="width:250px">Fecha</td>
                                        <td style="width:10px">:</td>
                                        <td><?php echo $data['purchase_order']['issue_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cotización N°</td>
                                        <td>:</td>
                                        <td><?php echo $data['purchase_order']['number_quotation']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Solicitud de material N°</td>
                                        <td>:</td>
                                        <td><?php echo $data['purchase_order']['number_material_request']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Tabla dinámica -->
            <div class="margin-top default_border_color">
                <table class="table-internal-border"> 
                    <tr>
                        <td style="text-align: center;width:1%; min-width: 110px;">Código</td>
                        <td style="text-align: center;width:1%; min-width: 110px;">Cantidad</td>
                        <td style="text-align: center;width:1%; min-width: 100px;">Unidad</td>
                        <td style="text-align: center;">Descripción</td>
                        <td style="text-align: center;width: 180px">Precio unitario</td>
                        <td style="text-align: center;width: 180px">Subtotal</td>
                    </tr>
                    <?php
                    if (!is_empty($data['rows'])):
                        $items = 1;
                        ?>
                        <?php
                        foreach ($data['rows'] as $row):
                            ?>
                            <tr>
                                <td style="text-align: right"><?php echo $row['code']; ?></td>
                                <td style="text-align: right"><?php echo numberFormat($row['quantity']); ?></td>
                                <td style="text-align: center"><?php echo $row['abbreviation']; ?></td>
                                <td style="text-align: left;"><?php echo $row['name']; ?></td>
                                <td style="text-align: right"><?php echo moneyFormat($row['value']); ?></td>
                                <td style="text-align: right"><?php echo moneyFormat($row['quantity'] * $row['value']); ?></td>
                            </tr>
                            <?php
                            $items++;
                        endforeach;
                    endif;
                    while ($items < 21) {
                        ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php
                        $items++;
                    }
                    ?> 
                </table>
            </div>

            <div class="margin-top default_border_color">
                <table class="table-internal-border"> 
                    <tr>
                        <td style="text-align: right;">
                            Total neto $
                        </td>
                        <td style="text-align: right;width: 180px;">
                            <?php echo moneyFormat($data['purchase_order']['total']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            IVA $
                        </td>
                        <td style="text-align: right;">
                            <?php echo moneyFormat($data['purchase_order']['iva']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            Total $
                        </td>
                        <td style="text-align: right;">
                            <?php echo moneyFormat($data['purchase_order']['total_with_iva']); ?>
                        </td>
                    </tr>
                </table> 
            </div>

            <div class="margin-top">
                <table>
                    <tr>
                        <td style="width:60%">
                            <table> 
                                <tr>
                                    <td style="width:250px">Forma de pago</td>
                                    <td style="width:10px">:</td>
                                    <td><?php echo $data['purchase_order']['way_to_pay']; ?></td>
                                </tr>
                                <tr>
                                    <td>Comprador</td>
                                    <td>:</td>
                                    <td><?php echo $data['purchase_order']['dispatch_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Contacto comprador</td>
                                    <td>:</td>
                                    <td><?php echo $data['purchase_order']['dispatch_contact']; ?></td>
                                </tr>
                                <tr>
                                    <td>Obra</td>
                                    <td>:</td>
                                    <td><?php echo $data['establishment']['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dirección recepción</td>
                                    <td>:</td>
                                    <td><?php echo $data['purchase_order']['dispatch_address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Observaciones</td>
                                    <td>:</td>
                                    <td><?php echo $data['purchase_order']['observation']; ?></td>
                                </tr>
                            </table>


                        </td>
                        <td style="width:40%; text-align: center">
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            ____________________________<br />
                            Aprobador<br />
                            Gerencia <?php echo $data['establishment']['name_business']; ?><br />
                        </td>
                    </tr>                        
                </table>
            </div>
            <div class="margin-top" style="text-align: center;">
                <div style="margin:0 auto; max-width: 70%">
                    <b><?php echo $data['purchase_order']['footer']; ?></b>
                </div>
            </div>
            <br />
        </div>
    </body>
</html>