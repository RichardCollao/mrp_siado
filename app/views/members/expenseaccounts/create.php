<h3>Nueva cuenta</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>" onsubmit="return loginValidate(this);" onkeypress="return event.keyCode != 13">
            <div class="form-group">
                <label for="number">Número de cuenta</label>
                <input type="text" class="form-control" name="number" value="<?php echo $data['number']; ?>">
                <div class="form-group">
                </div>
                <label for="name">Nombre de cuenta</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    //<![CDATA[
    document.getElementById("form_mail").setAttribute("autocomplete", "off");
    //]]>
</script>