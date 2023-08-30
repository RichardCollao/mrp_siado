<?php Header::styleCssStart();?>
.list_li li{
    list-style: disc;
}
<?php Header::styleCssEnd();?>

<div class="content default_bg_1">
    <?php echo helper_title_bar('Condiciones de registro');?>
    
    <div style="max-width:700px; border:0px; padding:5px; margin:auto;">
        <fieldset class="fieldset"><legend>&nbsp;<b>Normas del foro</b>&nbsp;</legend>
            <p>&nbsp;<b>Para seguir, debes de estar de acuerdo con las siguientes normas:</b></p>
            <div style="margin:5px auto;padding:5px; background:#FFF; overflow:auto; width:auto; height:250px;">
                La participación en este foro es completamente gratuita y cualquier persona puede ser parte de esta comunidad.<br />
                Por suspuesto existen normas para una sana convivencia las cuales debes aceptar para integrarte.<br />
                <br />
                <ul class="list_li">
                    <li>No se permite insultar a otros usuarios.</li>
                    <li>No se permite publicar material de propiedad intelectual sin autorizacion del autor.</li>
                    <li>No se permite publicar material ilegal.</li>
                    <li>No se permite pornografia y ningun tipo de contenido no apto para menores de edad.</li>
                    <li>No hacer spam ( publicidad a otras paginas ).</li>
                    <li>El propietario de este foro se reserva el derecho de eliminar, editar, mover o cerrar cualquier tema.</li>
                </ul>
                <br />
                Si estas de acuerdo con los terminos, por favor selecciona la casilla abajo y pulsa el boton &quot;Continuar&quot;<br />
                Si quieres anular el proceso de registro haz click <?php echo $data['url_base'];?> para regresar al indice del foro.<br />
                <p>El foro es revisado constantemente, pero en caso de que alguna situación no haya sido controlada,<br /> 
                pueden dar aviso al administrador en caso de cualquier anomalía.<br />
                Por ultimo todos los mensajes expresan el punto de vista de su autor , y no representan al foro o la comunidad.</p>
            </div>
         
            <form action="<?php echo $data['action_form'];?>" method="post">
                <input name="accept_rules" type="checkbox" /> 
                <label>He leído y estoy de acuerdo con las reglas del foro.</label>
                <br />
                <div style="text-align:center;">
                <input name="continuar" type="submit" value="Continuar"/>
                </div>
            </form>
        </fieldset>
    </div>
</div>