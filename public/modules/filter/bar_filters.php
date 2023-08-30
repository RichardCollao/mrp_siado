<!--Barra de filtros-->
<div <?php if (!$is_filtering): ?>class="collapse"<?php endif; ?> id="filter-collapse">
    <form id="filter" method="post" action="<?php echo $data['action_form']; ?>"> 
        <table class="table table-bordered table-condensed">
            <tr class="thead">
                <?php foreach ($data['headers'] AS $header): ?>
                    <td style="padding: 5px; width: 1%;text-align: center">
                        <?php echo $header; ?>
                    </td>
                <?php endforeach; ?>
                <td style="padding: 5px; width: 100%;text-align: right">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <?php foreach ($data['html'] AS $html): ?>
                    <td style="padding: 5px;">
                        <?php echo $html; ?>
                    </td>
                <?php endforeach; ?>
                <td style="padding: 5px; width: 100%; text-align: right">
                    <button type="submit" class="btn btn-primary" name="btn_filter">
                        <i class="fas fa-filter"></i>&nbsp;Filtrar
                    </button>
                    <button type="submit" class="btn btn-default" name="btn_reset">
                        <i class="fas fa-undo"></i>&nbsp;Resetear
                    </button>
                </td>
            </tr>
        </table>
    </form>
</div>
<!--Fin barra de filtros-->
