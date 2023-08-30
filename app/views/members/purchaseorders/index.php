<h3>Ordenes de compra</h3>
<hr />
<div style="margin-bottom: 15px;">
    <div style="float: left">
        <?php echo HelperWebIconFontAwesome::btnCreate($data['link_create']); ?>
    </div>

    <!--Boton de la barra de busqueda-->
    <?php echo HelperWebIconFontAwesome::btnSearchBar(); ?>

    <!--Paginador-->
    <div style="margin-bottom: 15px;float: right">
        <?php echo $data['pagination']; ?>
    </div>    
    <div style="clear: both"></div>
</div>

<?php echo $data['bar_filters']; ?>

<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead force-one-row">
            <th style="min-width: 30px"></th>
            <th style="min-width: 100px">Número</th>
            <th style="width: 100%">Proveedor</th>
            <th style="min-width: 100px">Observación</th>
            <th style="min-width: 100px">Fecha</th>
            <th style="min-width: 100px">Neto OC</th>
            <th style="min-width: 100px">Total FAC</th>
            <th style="width:1%">Items</th>
            <th style="width:1%">Ver</th>
            <th style="width:1%">Adjuntos</th>
            <th style="width:1%">Facturas</th>
            <th style="width:1%">Guías</th>
            <th style="width:1%">Opciones</th>
        </tr>
    </thead>
    <?php if (!is_empty($data['rows'])): ?>
        <?php foreach ($data['rows'] as $row): ?>
            <tr class="force-one-row">
                <td style="text-align: right;">
                    <?php
                    if ($row['locked']):
                        echo HelperWebIconFontAwesome::btnUnlock($data['link_unlock'] . $row['id_purchase_order']);
                    else:
                        echo HelperWebIconFontAwesome::btnLock($data['link_lock'] . $row['id_purchase_order']);
                    endif;
                    ?>
                </td>
                <td style="text-align: right;"><?php echo $row['number']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['provider_name']; ?></td>
                <td style="max-width: 200px" class="truncate"><?php echo $row['observation']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td style="text-align: right"><?php echo moneyFormat($row['total']); ?></td>
                <td style="text-align: right"
                <?php
                if ($row['bills_total'] > $row['total']):
                    echo ' class="bg-danger" ';
                endif;
                ?>>
                        <?php echo moneyFormat($row['bills_total']); ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $row['count_items']; ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnView($data['link_display'] . $row['id_purchase_order']); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnAttach($data['link_attachments'] . $row['id_purchase_order'], $row['count_files']); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnCountBills($data['link_view_bills'] . $row['id_purchase_order'], $row['count_bills']); ?>
                </td>
                <td>
                    <?php echo HelperWebIconFontAwesome::btnCountGuides($data['link_view_guides'] . $row['id_purchase_order'], $row['count_guides']); ?>
                </td>
                <td style="text-align: right;">
                    
                    <div class="dropdown" style="display: inline-block">
                        <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                            <?php echo HelperWebIconFontAwesome::iconMenu(); ?>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo $data['link_document'] . $row['id_purchase_order']; ?>">
<!--                                    
                                    <?php echo HelperWebIconFontAwesome::iconFilePdf(); ?>&nbsp;
                                    -->
                                    Ver / Descargar
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a role="menuitem" tabindex="-1" href="">
                                    Aprobar orden de compra
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a role="menuitem" tabindex="-1" href="#">Invalidar orden de compra</a>
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation" class="disabled">
                                <a role="menuitem" tabindex="-1" href="#">Elevar solicitud</a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a role="menuitem" tabindex="-1" href="#">Responder solicitud</a>
                            </li>
                        </ul>
                    </div>
                    

                    <?php echo HelperWebIconFontAwesome::btnEdit($data['link_edit'] . $row['id_purchase_order']); ?>
                    <?php echo HelperWebIconFontAwesome::btnDetail($data['link_details'] . $row['id_purchase_order']); ?>
                    &nbsp;
                    <?php echo HelperWebIconFontAwesome::btnDelete($data['link_delete'] . $row['id_purchase_order']); ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="14">
                No se encontró ningún dato...
            </td>
        </tr>
    <?php endif; ?>
</table>