<style type="text/css">
    .frame{
        width: 100%;
        height: 280px;
        border: 1px solid silver;
    }

    .logo {
        max-width: 500px;
        max-height: 200px;
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>

<h3>Obra</h3>
<hr />

<div class="row">
    <div class="col-lg-6">
        <table>
            <tr>
                <td style="width: 250px"><h4>Nombre constructora</h4></td>
                <td style="width: 10px">:</td>
                <td><h4><?php echo $data['name_business']; ?></h4></td>
            </tr> 
            <tr>
                <td style="width: 250px"><h4>Giro</h4></td>
                <td style="width: 10px">:</td>
                <td><h4><?php echo $data['activity_business']; ?></h4></td>
            </tr> 
            <tr>
                <td><h4>Rut constructora</h4></td>
                <td>:</td>
                <td><h4><?php echo $data['rut_business']; ?></h4></td>
            </tr> 
            <tr>
                <td><h4>Direccion constructora</h4></td>
                <td>:</td>
                <td><h4><?php echo $data['address_business']; ?></h4></td>
            </tr> 
            <tr>
                <td><h4>Telefono constructora</h4></td>
                <td>:</td>
                <td><h4><?php echo $data['phone_business']; ?></h4></td>
            </tr> 
            <tr>
                <td colspan="3"><hr /></td>
            </tr> 
            <tr>
                <td><h4>Nombre obra</h4></td>
                <td>:</td>
                <td><h4><?php echo $data['name']; ?></h4></td>
            </tr> 
            <tr>
                <td><h4>Direccion obra</h4></td>
                <td>:</td>
                <td><h4><?php echo $data['address']; ?></h4></td>
            </tr> 
            <tr>
                <td><h4>Telefono obra</h4></td>
                <td>:</td>
                <td><h4><?php echo $data['phone']; ?></h4></td>
            </tr> 
        </table>
        <hr />

        <a href="<?php echo $data['link_modify'] . $data['id_establishment']; ?>">
            <button  type="button" class="btn btn-default">Editar</button>
        </a>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <p>Imagen de referencia para los documentos generados, ordenes de compra, guías, etc.</p>

                <div class="frame">
                    <img class="logo" src="<?php echo $data['src_logo']; ?>" title="logo" alt="" />
                </div>
            </div>
        </div>
        <br />
        <a href="<?php echo $data['link_logo'] . $data['id_establishment']; ?>">
            <button  type="button" class="btn btn-default">Editar logo</button>
        </a>
    </div>
</div>