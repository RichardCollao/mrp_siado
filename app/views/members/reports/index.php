<style type="text/css">
    .btn-report{
        background-color: #66bb6a;
        color: #fafafa;
    }

    .btn-xs{
        font-size: 16px;        
    }
</style>

<h3>Reportes</h3>
<hr />
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr class="thead">
            <th>Nombre</th>
            <th>Descripción</th>
            <th></th>
        </tr>
    </thead>
    <tr>
        <td>
            Informe de Ordenes de compra
        </td>
        <td>
            Contiene el detalle de todas las ordenes de compra
        </td>
        <td>  
            <?php echo HelperWebIconFontAwesome::btnFileExcel(path::urlDomain('reports/purchaseorders')) , '&nbsp;Exportar a excel'; ?>
        </td>
    </tr>
    <tr>
        <td>
            Informe de facturas
        </td>
        <td>
            Contiene el detalle de todas las facturas
        </td>
        <td>  
            <?php echo HelperWebIconFontAwesome::btnFileExcel(path::urlDomain('reports/bills')) , '&nbsp;Exportar a excel'; ?>
        </td>
    </tr>
    <tr>
        <td>
            Informe de guías
        </td>
        <td>
            Contiene el detalle de todas las guías 
        </td>
        <td>  
            <?php echo HelperWebIconFontAwesome::btnFileExcel(path::urlDomain('reports/guides')) , '&nbsp;Exportar a excel'; ?>
        </td>
    </tr>
    <tr>
        <td>
            Informe de vales
        </td>
        <td>
            Contiene el detalle de todos los vales.
        </td>
        <td>  
            <?php echo HelperWebIconFontAwesome::btnFileExcel(path::urlDomain('reports/vouchers')) , '&nbsp;Exportar a excel'; ?>
        </td>
    </tr>
    <tr>
        <td>
            Informe de materiales
        </td>
        <td>
            Contiene el detalle de todos los materiales
        </td>
        <td>  
            <?php echo HelperWebIconFontAwesome::btnFileExcel(path::urlDomain('reports/materials')) , '&nbsp;Exportar a excel'; ?>
        </td>
    </tr>
</table>