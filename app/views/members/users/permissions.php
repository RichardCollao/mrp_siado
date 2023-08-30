<style type="text/css">
    input[type=checkbox] {
        visibility: hidden;
    }

    .checkbox-2 {
        width: 60px;
        height: 24px;
        background: silver;
        border-radius: 20px;
        position: relative;
        font-size: 20px;
        line-height: 24px;
    }
    .checkbox-2:before {
        position: absolute;
        left: 2px;
        top: 2px;
        /*text-shadow: 0 0 2px #000000;*/
        color: #000;
    }
    .checkbox-2:after {
        position: absolute;
        right: 2px;
        top: 2px;
        /*        text-shadow: 0 0 2px #000000;*/
    }
    .checkbox-2 label { 
        background: lightgrey;
        display: block;
        width: 20px;
        height: 20px;
        border-radius: 20px;
        transition: all .3s ease;
        cursor: pointer;
        position: absolute;
        top: 2px;
        z-index: 1;
        left: 2px;
    }
    .checkbox-2 input[type=checkbox]:checked + label {
        left: 38px;
        background: #0072ab;
    }
</style>

<h3>Permisos de usuario: <?php echo $data['user_name']; ?></h3>
<hr />
<form role="form" method="post" action="<?php echo $data['action_form']; ?>" onsubmit="return loginValidate(this);" onkeypress="return event.keyCode != 13">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed table-hover table-striped">
                <thead>
                    <tr class="thead force-one-row">
                        <td>Modulo</td>
                        <td>Accion</td>
                        <td style="text-align: center; width: 200px">
                            <label>
                                Marcar/Desmarcar todo
                                <input id="check_all" type="checkbox" value="" style="margin-right: 8px">
                            </label>
                        </td>        
                    </tr>
                </thead>
                <?php foreach ($data['list_permissions'] as $key => $permissions): ?>
                    <tbody>
                        <?php
                        if (isset($last_key) && $last_key !== $permissions['title_module']) {
                            echo '<tr><td colspan="3">&nbsp;</td></tr>';
                        }
                        $last_key = $permissions['title_module'];
                        ?>
                        <tr>
                            <td><?php echo $permissions['title_module']; ?></td>
                            <td><?php echo $permissions['title_rule'] ?></td>
                            <td  style="width: 100px">
                                <div  style="margin: 0 auto" class="checkbox-2">
                                    <input type="checkbox" 
                                           id="permissions<?php echo "[$key]"; ?>" name="permissions<?php echo "[$key]"; ?>"
                                           <?php if (in_array($key, $data['permissions'])) echo ' checked ';?>/>
                                    <label for="permissions<?php echo "[$key]"; ?>"></label>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> 
    </div>
    <button name="save_permissions" type="submit" class="btn btn-primary">Guardar</button>
</form>

<script>
    $("#check_all").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
