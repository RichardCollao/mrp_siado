<?php header::addSheetsCSS(path::urlLibraries("/datepicker/css/datepicker.css")); ?>
<?php header::addJavascript(path::urlLibraries("/datepicker/js/bootstrap-datepicker.js")); ?>
<?php header::addSheetsCSS(path::urlCss("/loadings.css")); ?>

<style type="text/css">
    datalist {
        max-height: 100px !important;
        overflow-y: auto;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        // Implementar Calendario
        $('#datepicker').datepicker();
    });
</script>

<h3>Nuevo vale</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">  
                        <label for="number">Número</label>
                        <input type="text" class="form-control active-focus" id="number" name="number" value="<?php echo $data['number']; ?>" />
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
                <label for="fk_id_user_autorized">Autoriza</label>
                <select class="form-control" name="fk_id_user_autorized">
                    <?php foreach ($data['list_supervisors'] as $key => $value): ?>
                        <?php echo helper_option($key, $value, $data['fk_id_user_autorized']); ?>
                    <?php endforeach; ?>
                </select>
            </div> 
            <div class="form-group">
                <label for="user_name_requesting">Solicita <div id="loader_requesting" class="loader" style="visibility: hidden"></div></label>
                <input type="text" id="user_name_requesting" name="user_name_requesting" class="form-control" 
                       list="list_user_name_requesting" value="<?php echo $data['user_name_requesting']; ?>" 
                       autocomplete="off" data-last-value=""/>
                <datalist id="list_user_name_requesting"></datalist>
            </div>
            <div class="form-group">
                <label for="destination">Destino <div id="loader_destination" class="loader" style="visibility: hidden"></div></label>
                <input type="text" id="destination" name="destination" class="form-control" 
                       list="list_destination" value="<?php echo $data['destination']; ?>" 
                       autocomplete="off" data-last-value=""/>
                <datalist id="list_destination"></datalist>
            </div>
            <div class="form-group">
                <label for="observation">Observación</label>
                <textarea class="form-control" rows="3" name="observation"><?php echo $data['observation']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script>
    var xhr = null;
    function callAjaxUX(action, str, callback) {
        // cancela peticiones anteriores
        if (xhr && xhr.readyState !== 4) {
            xhr.abort();
        }

        xhr = $.ajax({
            url: '<?php echo path::urlDomain('./ajaxux'); ?>',
            data: {action: action, str: str},
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                callback(response);
            },
            error: function (xhr, status) {
                console.log('Ajax error: ' + status);
                hideLoaders();
            },
            complete: function (xhr, status) {
                hideLoaders();
            }
        });
    }

    document.querySelector('#user_name_requesting').addEventListener('keyup', (event) => {
        var str = document.querySelector('#user_name_requesting').value;
        // Condicion que evalua un minimo de caracteres para realizar una peticion al servidor
        if (str.length < 4) {
            hideLoaders();
            return;
        }
        // Comprueba si el nuevo valor es igual al ultimo consultado 
        if (str === document.querySelector('#user_name_requesting').dataset.lastValue) {
            return;
        } else {
            document.querySelector('#user_name_requesting').dataset.lastValue = str;
        }
        clearDataList("#list_user_name_requesting");
        document.querySelector('#loader_requesting').style.visibility = 'visible';
        callAjaxUX('loadRequesting', str, actualizeRequesting);
    });

    document.querySelector('#destination').addEventListener('keyup', (event) => {
        var str = document.querySelector('#destination').value;
        // Condicion que evalua un minimo de caracteres para realizar una peticion al servidor
        if (str.length < 4) {
            hideLoaders();
            return;
        }
        // Comprueba si el nuevo valor es igual al ultimo consultado 
        if (str === document.querySelector('#destination').dataset.lastValue) {
            return;
        } else {
            document.querySelector('#destination').dataset.lastValue = str;
        }
        clearDataList('#list_destination');
        document.querySelector('#loader_destination').style.visibility = 'visible';
        callAjaxUX('loadDestination', str, actualizeDestination);
    });

    function hideLoaders() {
        document.querySelector('#loader_requesting').style.visibility = 'hidden';
        document.querySelector('#loader_destination').style.visibility = 'hidden';
    }

    function actualizeRequesting(response) {
        actualizeDataList('#list_user_name_requesting', response);
    }

    function actualizeDestination(response) {
        actualizeDataList('#list_destination', response);
    }

    function actualizeDataList(selector, arr) {
        var dataList = document.querySelector(selector);
        arr.forEach(item => {
            let option = document.createElement('option');
            option.value = item;
            dataList.appendChild(option);
        });
        // Muestra el DataList actualizado
        dataList.style.visibility = "visible";
    }

    function clearDataList(selector) {
        var dataList = document.querySelector(selector);
        // Oculta el DataList
        dataList.style.visibility = 'hidden';
        // Eliminando todos los hijos de un elemento
        while (dataList.firstChild) {
            dataList.removeChild(dataList.firstChild);
        }
    }
</script>