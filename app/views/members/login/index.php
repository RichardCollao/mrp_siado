<style type="text/css">
    .spinner {
        height: 25px;
        width: 25px;
        border: 8px solid #8798A3;
        border-radius: 50%;
        border-left-color: #A4B1BA;
        animation: spin 0.75s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<style type="text/css">
    .transparency{
        background: rgba(0, 0, 0, 0.5)!important;
        color:whitesmoke; 
    }

    .logo{
        margin-top: 25px;
        border-radius: 15px 15px 15px 15px;
        -moz-border-radius: 15px 15px 15px 15px;
        -webkit-border-radius: 15px 15px 15px 15px;
    }

    .style-form{
        border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.25);
        -moz-box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.25);
        box-shadow: 10px 10px 20px -4px rgba(0,0,0,0.25);

        border:1px solid silver;
        padding:15px 30px;
        background-color: white;
    }

</style>

<script type="text/javascript">
    function loginValidate(obj) {
        if (obj.pass.value.length === 0) {
            obj.pass.focus();
            return false;
        }
        if (obj.id_establishment.value.length === 0) {
            obj.id_establishment.focus();
            return false;
        }
        if (obj.mail.value.length === 0) {
            obj.mail.focus();
            return false;
        }
    }
</script>

<style type="text/css">
    .loader {
        border: 5px solid #f3f3f3; /* Light grey */
        border-top: 5px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        display: inline-block;
        visibility: hidden;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="row" style="margin-top: 100px; display: flex">
    <div class="col-lg-5" style="text-align: center">
        <img class="logo" src="<?php echo $data['img_login']; ?>" title="Logo" />
    </div>
    <div class="col-lg-offset-2 col-lg-5">
        <div class="style-form">
            <h2 style="text-align: left"><b>Iniciar sesión</b></h2>
            <form  class="form" role="form" method="post" action="<?php echo $data['link_form_action']; ?>" onsubmit="return loginValidate(this);" >
                <div class="form-group">
                    <label for="mail" class="control-label">Correo</label>
                    <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $data['mail']; ?>">
                </div>
                <div class="form-group">
                    <label for="text" class="control-label">Obra <div class="loader"></div></label>
                    <!--  <div id="spinner"></div>   -->

                    <select disabled="true" class="form-control" id="id_establishment" name="id_establishment"></select>
                </div>
                <div class="form-group">
                    <label for="pass" class="control-label">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" value="">
                </div>
                <div class="form-group">
                    <button disabled="true" id="btn_login" type="submit" class="btn btn-primary">Iniciar sesion</button>
                </div>
                <p>Si ¿Olvidaste tu contraseña? Haz clic <a href="<?php echo $data['link_recoverpass']; ?>"><b>aqui</b></a></p>
            </form>
        </div>
    </div>
</div>

<script>

    class Establishments {
        constructor() {
            this.disableFields();
            this.loadEstablishments();

            document.querySelector('#mail').addEventListener("change", () => {
                this.disableFields();
                document.querySelector('.loader').style.visibility = 'visible';
                this.loadEstablishments();
            });
        }

        loadEstablishments() {
            var email = document.querySelector('#mail').value;
            var formData = new FormData();
            formData.append('mail', email);
            var request = new Request('<?php echo $data['link_establishmentsassociated']; ?>', {
                method: 'POST',
                headers: new Headers(),
                mode: 'same-origin', // https://developer.mozilla.org/en-US/docs/Web/API/Request/mode
                credentials: 'include',
                body: formData,
                cache: 'default'
            });

            fetch(request).then(response => {
                if (response.ok) {
                    response.json().then(data => {
                        this.actualizeSelect(data);
                    }).catch(function (err) {
                        console.log("Not Jason response");
                    });
                }
                document.querySelector('.loader').style.visibility = 'hidden';
            }).catch(function (err) {
                document.querySelector('.loader').style.visibility = 'hidden';
            });
        }

        disableFields() {
            document.querySelector('#id_establishment').disabled = true;
            document.querySelector('#btn_login').disabled = true;
            var select = document.querySelector('#id_establishment');
            Array.from(select.querySelectorAll('option')).forEach(element => {
                select.remove(element);
            });
        }

        activeFields() {
            document.querySelector('#id_establishment').disabled = false;
            document.querySelector('#btn_login').disabled = false;
        }

        actualizeSelect(data) {
            Array.from(data.establishments).forEach(establishment => {
                let option = document.createElement('option');
                option.value = establishment.id_establishment;
                option.innerHTML = establishment.establishments_name;
                document.querySelector('#id_establishment').appendChild(option);
                this.activeFields();
            });
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        new Establishments();
    }, false);
</script>

<!--<div class="spinner"></div>-->



