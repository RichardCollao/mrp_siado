<?php header::addSheetsCSS(path::urlLibraries("/datepicker/css/datepicker.css")); ?>
<?php header::addJavascript(path::urlLibraries("/datepicker/js/bootstrap-datepicker.js")); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#<?php echo $name; ?>1').datepicker();
        $('#<?php echo $name; ?>2').datepicker();

        $('#<?php echo $name; ?>').on('change', function () {
            n = parseInt(this.value);
            switch (n) {
                case 1:
                    $('#<?php echo $name; ?>_div_1').show();
                    $('#<?php echo $name; ?>_div_2').hide();
                    break;
                case 2:
                    $('#<?php echo $name; ?>_div_1').show();
                    $('#<?php echo $name; ?>_div_2').hide();
                    break;
                case 3:
                    $('#<?php echo $name; ?>_div_1').show();
                    $('#<?php echo $name; ?>_div_2').hide();
                    break;
                case 4:
                    $('#<?php echo $name; ?>_div_1').show();
                    $('#<?php echo $name; ?>_div_2').show();
                    break;
                default:
                    $('#<?php echo $name; ?>_div_1').hide();
                    $('#<?php echo $name; ?>_div_2').hide();
            }
        });
<?php if ($values['select'] > 0): ?>
            $('#<?php echo $name; ?>').prop('selectedIndex', <?php echo $values['select']; ?>).change();
<?php endif; ?>
    });
</script>

<table style="width: 1%;">
    <tr>
        <td>
            <div style="width:150px">
                <select id="<?php echo $name; ?>" class="form-control" name="<?php echo $name; ?>[select]">
                    <option value="-1">Todas</option>
                    <option value="1">Igual</option>
                    <option value="2">Desde</option>
                    <option value="3">Hasta</option>
                    <option value="4">Entre</option>
                </select>
            </div>
        </td>
        <td>
            <div id="<?php echo $name; ?>_div_1" style="width:140px; margin-left: 10px; display: none">
                <div class="input-group date" id="<?php echo $name; ?>1" data-date="<?php echo $values['date1']; ?>" 
                     data-date-format="yyyy-mm-dd">
                    <input class="form-control" 
                           type="text" name="<?php echo $name; ?>[date1]" value="<?php echo $values['date1']; ?>" />
                    <div class="input-group-addon add-on" style="cursor: pointer">
                        <?php echo HelperWebIconFontAwesome::iconCalendar(); ?>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div id="<?php echo $name; ?>_div_2" style="width:140px; margin-left: 10px; display: none">
                <div class="input-group date" id="<?php echo $name; ?>2" data-date="<?php echo $values['date2']; ?>" 
                     data-date-format="yyyy-mm-dd">
                    <input class="form-control" 
                           type="text" name="<?php echo $name; ?>[date2]" value="<?php echo $values['date2']; ?>" />
                    <div class="input-group-addon add-on" style="cursor: pointer">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo HelperWebIconFontAwesome::iconCalendar(); ?>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>