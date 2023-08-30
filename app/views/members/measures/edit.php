<h3>Editar medida</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>" onsubmit="return loginValidate(this);" onkeypress="return event.keyCode != 13">
            <div class="form-group">
                <label for="abbreviation">Abreviacion</label>
                <input type="text" class="form-control" name="abbreviation" value="<?php echo $data['abbreviation']; ?>">
                <div class="form-group">
                </div>
                <label for="terminology">Terminologia</label>
                <input type="text" class="form-control" name="terminology" value="<?php echo $data['terminology']; ?>">
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