<h3>Editar pieza de moldaje</h3>
<hr />
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo $data['action_form']; ?>" >

            <div class="form-group">
                <label for="code">Codigo</label>
                <div class="row">
                    <div class="col-xs-3">
                        <input type="text" class="form-control" name="code" value="<?php echo $data['code']; ?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlentities($data['name']); ?>" />
            </div>
            <div class="form-group">
                <label for="weight">Peso</label>
                <div class="row">
                    <div class="col-xs-3">

                        <input type="text" class="form-control" name="weight" value="<?php echo $data['weight']; ?>" />
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

    </div>
</div>
