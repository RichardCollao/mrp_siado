<?php
header::addSheetsCSS(path::urlModules('/FilesExplorer/public/css/w3.css'), true);
header::addSheetsCSS(path::urlModules('/FilesExplorer/public/css/FilesExplorer.css'));
header::addJavascript(path::urlModules('/FilesExplorer/public/js/FilesExplorerClient.js'));
?>

<h3><?php echo $data['reference']; ?></h3>
<hr />
<!-- contenedor explorador de archivos -->
<div style="margin: 15px auto;" id="files_container_display"></div>

<div style="margin-bottom: 15px;">
    <a href="<?php echo $data['link_back'] ?>"><button type="button" class="btn btn-default">Volver</button></a>
</div>

<script type="text/javascript">
    window.onload = function () {
        let filesExplorerClient = new FilesExplorerClient("files_container_display");
        filesExplorerClient.setToken("<?php echo $data['token']; ?>");
        // Establece la url que apunta al controlador
        filesExplorerClient.setServerController("<?php echo $data['path_server_controller']; ?>");
        // Establece la url que apunta a la base url donde se encuentran los archivos
        // filesExplorerClient.setBaseUrlFiles("");

        // Permite posicionar el explorador en un nivel relativo a la ruta establecida como base
        filesExplorerClient.setPathRelative("<?php echo $data['path_relative']; ?>");
        // Es posible escoger entre varios layouts de acuerdo al framewrok css de turno  
        filesExplorerClient.setLayout("<?php echo $data['path_layout']; ?>");
        // Inicializa la clase
        filesExplorerClient.start();
    };
</script>