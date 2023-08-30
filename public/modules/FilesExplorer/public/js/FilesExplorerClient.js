/* global fetch, eval, browser, top */

class FilesExplorerClient {

    constructor(idElement) {
        // Formulario utilizado en alguna operaciones como cortar y 
        this.tempFormData = new FormData();
        this.idElement = idElement;
        this.element = document.querySelector('#' + this.idElement);

        // Obtiene la url real del script FilesExplorerClient.js
        var url = document.querySelector('script[src$="FilesExplorerClient.js"]').src;
        var name = url.split('/').pop();
        var dir = url.replace(name, '');
        var parser = new URL(dir + '../../');

        // Establece la ruta base correspondiente al modulo
        this.scriptPath = parser.origin + parser.pathname;
        // Establece la url por defecto del directorio publico de archivos
        this.baseUrlFiles = this.scriptPath + 'root_files/';
        // Establece la ruta por defecto del layout
        this.layout = 'public/views/default.layout.html';
    }

    start() {
        // Carga el layout y asigna los correspondientes eventos a los botones
        this.loadHtml(this.layout, function (str) {
            this.element.innerHTML = str;
            // Convierte rutas relativas en absolutas
            this.convertRelativeImagePathToAbsolute(this.element);

            // Asigna el evento click a todos los botones closet de los elementos .modal-container
            Array.from(this.element.querySelectorAll('[data-modal-close]')).forEach(link => {
                link.addEventListener('click', function (event) {
                    this.closest('[data-modal-container]').style.display = 'none';
                });
            });

            this.element.querySelector('[data-id="btnUpLevelDirectory"]').onclick = this.upLevelDirectory.bind(this);

            this.element.querySelector('[data-id="btnUploadFile"]').onclick = function () {
                this.setModalContent('template_form_upload');
                this.showModal();
                this.element.querySelector('[data-id="form_upload_files"]').onsubmit = this.uploadFiles.bind(this);

                this.element.querySelector('[data-id="form_upload_files"] input[name="files[]"]').onchange = function (event) {
                    var input = event.target;

                    var numFiles = input.files.length ? input.files.length : 1;
                    var nameFile = input.value.replace(/\\/g, '/').replace(/.*\//, '');
                    var textLabel = numFiles > 1 ? numFiles + ' files selected' : nameFile;
                    this.element.querySelector('[data-id="form_upload_files"] [data-out]').innerHTML = textLabel;
                }.bind(this);
            }.bind(this);

            this.element.querySelector('[data-id="btnAddFolder"]').onclick = function () {
                this.setModalContent('template_form_add_folder');
                this.showModal();
                this.element.querySelector('[data-id="form_add_folder"]').onsubmit = this.addFolder.bind(this);
            }.bind(this);

            let btnPaste = this.element.querySelector('[data-id="btnPaste"]');
            btnPaste.classList.add('icon-btn-disbled');

            // Actualiza por primera vez para mostrar listar los archivos.
            this.refresh();
        }.bind(this));
    }

    // Carga script y ejecuta el callback
    loadScript(url, callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = url;
        document.head.appendChild(script);
        script.onreadystatechange = callback;
        script.onload = callback;
    }

    // Carga archivo 
    loadHtml(filePath, callback) {
        var headers = new Headers({'Content-type': 'application/json;charset=utf-8'});
        var formData = new FormData();
        var request = new Request(filePath, {
            method: 'POST',
            headers: headers,
            mode: 'same-origin', // https://developer.mozilla.org/en-US/docs/Web/API/Request/mode
            credentials: 'include',
            body: formData,
            cache: 'default'
        });
        fetch(request)
                .then(function (response) {
                    return response.text();
                })
                .then(function (body) {
                    callback(body);
                });
    }

    setServerController(pathController) {
        this.serverController = pathController;
    }

    setLayout(layout) {
        this.layout = layout;
    }

    // Recibe token correspondiente al identificador en la sesssion 
    setToken(token) {
        this.token = token;
    }

    setBaseUrlFiles(baseUrlFiles) {
        this.baseUrlFiles = baseUrlFiles;
    }

    setPathRelative(pathRelative = '') {
        // Purga los modificadores de rutas ../ ./ \ 
        pathRelative = pathRelative.replace(/\.\.\//g, '').replace(/\.\//g, '').replace(/\\/g, '');
        // Guarda la ruta relativa como un arreglo, purgando elementos vacios
        this.pathRelativeArray = pathRelative.split('/').filter(Boolean);
    }

    getPathRelative() {
        if (this.pathRelativeArray.length > 0) {
            return this.pathRelativeArray.join('/') + '/';
        } else {
            return '';
        }
    }

    loadController(callback, formData = {}) {
        this.showLoading();

        formData.append('token', this.token);

        var headers = new Headers();
        var request = new Request(this.serverController, {
            method: 'POST',
            headers: headers,
            mode: 'same-origin', // https://developer.mozilla.org/en-US/docs/Web/API/Request/mode
            credentials: 'include',
            body: formData,
            cache: 'default'
        });
        fetch(request).then(function (response) {
            if (response.ok) {
                // Llama a la funcion callback y pasa el resultado como argumento
                response.text().then(
                        function (response) {
                             console.log(response);
                            try {
                                // Parsea los datos recibidos en un objeto json y llama la funcion callback
                                var json = JSON.parse(response);
                                callback(json);
                            } catch (e) {
                                console.log('error: ' + e);
                            }
                            this.hideLoading();
                        }.bind(this));
            } else {
                console.log('error' + response.status);
                this.hideLoading();
            }
        }.bind(this)).catch(function (err) {
            console.log('error', err);
            this.hideLoading();
        });
    }

    showLoading() {
        this.element.querySelector('.circle-loader').setAttribute('style', 'visibility: visible');
    }

    hideLoading() {
        this.element.querySelector('.circle-loader').setAttribute('style', 'visibility: hidden');
    }

    isEmptyArray(array) {
        if (typeof array !== 'undefined' && array !== null && array.length !== null && array.length > 0) {
            return false;
        }
        return true;
    }

    refresh() {
        var path_relative = this.getPathRelative();

        var formData = new FormData();
        formData.append('action', 'displaylist');
        formData.append('path_relative', path_relative);

        // Envia la peticion al servidor
        this.loadController(
                function (json) {
                    // Actualiza la lista de archivos
                    this.refreshDisplayList(json);
                    // Actualiza la barra de navegacion
                    this.refreshBreadcurmb();

                }.bind(this)
                , formData);
    }

    // reemplaza la url relativa por abosuluta
    convertRelativeImagePathToAbsolute(element) {
        Array.from(element.querySelectorAll('img')).forEach(img => {
            let src = img.dataset.src;
            if (src) {
                img.src = src.replace(/\.\//gi, this.scriptPath);
            }
        });
    }

    uploadFiles(e) {
        e.preventDefault();

        // obtiene los datos desde el formulario
        var path_relative = this.getPathRelative();
        var formData = new FormData(this.element.querySelector('[data-id="form_upload_files"]'));
        formData.append('action', 'upload');
        formData.append('path_relative', path_relative);

        // Oculta el modal
        this.hideModal();

        // Envia la peticion al servidor
        this.loadController(
                function (response) {
                    if (response.errors.length > 0) {
                        var content = '<p>La operación solicitada no se pudo realizar debido a los siguientes errores:</p>';
                        content += this.helperUl(response.errors);
                        this.setAlert('warning', 'Aviso!', content);
                        this.showModal();
                    } else {
                        this.refresh();
                        this.hideModal();
                    }
                }.bind(this)
                , formData);
    }

    upLevelDirectory() {
        this.pathRelativeArray.pop();
        this.refresh();
    }

    addFolder(e) {
        e.preventDefault();

        // Oculta el modal
        this.hideModal();
        var path_relative = this.getPathRelative();
        var formData = new FormData(this.element.querySelector('[data-id="form_add_folder"]'));
        formData.append('action', 'addfolder');
        formData.append('path_relative', path_relative);

        // Envia la peticion al servidor
        this.loadController(
                function (response) {
                    if (response.errors.length > 0) {
                        var content = '<p>La operación solicitada no se pudo realizar debido a los siguientes errores:</p>';
                        content += this.helperUl(response.errors);
                        this.setAlert('warning', 'Aviso!', content);
                        this.showModal();
                    } else {
                        this.refresh();
                        this.hideModal();
                    }
                }.bind(this)
                , formData);
    }

    goDirectory(folder = '') {
        this.pathRelativeArray.push(folder);
        this.refresh();
    }

    goHome(file) {
        this.pathRelativeArray = [];
        this.refresh();
    }

    btnBreadCrumb(level) {
        this.pathRelativeArray = this.pathRelativeArray.slice(0, level + 1);
        this.refresh();
    }

    downloadFileOld(file) {
        var path_relative = this.getPathRelative();
        if (path_relative.length > 0) {
            path_relative += '/';
        }
        var downloadUrl = path_relative + file;
        var a = document.createElement('a');

        // Corrige enlace con espacios en blanco
        a.href = downloadUrl.replace(' ', '%20');

        // Nombre para la descarga
        a.download = file;
        a.click();
    }

    downloadFile(file) {
        // Oculta el modal
        this.hideModal();
        var path_relative = this.getPathRelative();
        var formData = new FormData();
        formData.append('action', 'download');
        formData.append('file', file);
        formData.append('path_relative', path_relative);
        formData.append('token', this.token);

        var headers = new Headers();
        var request = new Request(this.serverController, {
            method: 'POST',
            headers: headers,
            mode: 'same-origin', // https://developer.mozilla.org/en-US/docs/Web/API/Request/mode
            credentials: 'include',
            body: formData,
            cache: 'default'
        });

        fetch(request).then(function (t) {
            return t.blob().then((b) => {
                var a = document.createElement('a');
                a.href = URL.createObjectURL(b);
                a.setAttribute('download', file);
                a.click();
            });
        });
    }

    prepareMoveFiles(file) {
        this.tempFormData = new FormData();
        var path_relative = this.getPathRelative();
        this.tempFormData.append('action', 'move');
        this.tempFormData.append('file', file);
        this.tempFormData.append('path_relative', path_relative);
        this.tempFormData.append('origin', path_relative + file);

        let btnPaste = this.element.querySelector('[data-id="btnPaste"]');

        btnPaste.onclick = this.doMoveFiles.bind(this, file);
        btnPaste.classList.remove('icon-btn-disbled');
        btnPaste.classList.add(btnPaste.dataset.classEnabled);
    }

    doMoveFiles(file) {
        this.tempFormData.append('destination', this.getPathRelative() + file);

        let btnPaste = this.element.querySelector('[data-id="btnPaste"]');
        btnPaste.onclick = null;
        btnPaste.classList.add('icon-btn-disbled');
        btnPaste.classList.remove(btnPaste.dataset.classEnabled);

        // Envia la peticion al servidor
        this.loadController(
                function (response) {
                    if (response.errors.length > 0) {
                        var content = '<p>La operación solicitada no se pudo realizar debido a los siguientes errores:</p>';
                        content += this.helperUl(response.errors);
                        this.setAlert('warning', 'Aviso!', content);
                        this.showModal();
                    } else {
                        this.refresh();
                        this.hideModal();
                    }
                }.bind(this)
                , this.tempFormData);

    }

    clipboardFile(file) {
        var path_relative = this.getPathRelative();
        var uri = this.baseUrlFiles + path_relative + file;

        var input = document.createElement('input');
        input.setAttribute('value', uri);
        document.body.appendChild(input);
        input.select();

        var result = document.execCommand('copy');
        document.body.removeChild(input);

        prompt('Link copied to the clipboard.', uri);
        return result;
    }

    showFormRenameFile(file) {
        this.setModalContent('template_form_rename_file');
        this.showModal();
        var newname = this.element.querySelector('[data-id="form_rename_file"] [name="newname"]');
        newname.value = file;
        this.element.querySelector('[data-id="form_rename_file"] [name="send"]').onclick = this.validateRenameFile.bind(this, file);
    }

    validateRenameFile(file) {
        this.sendRenameFile(file);
    }

    sendRenameFile(file) {
        // Oculta el modal
        this.hideModal();
        var path_relative = this.getPathRelative();
        var formData = new FormData(this.element.querySelector('[data-id="form_rename_file"]'));
        formData.append('action', 'rename');
        formData.append('oldname', file);
        formData.append('path_relative', path_relative);

        // Envia la peticion al servidor
        this.loadController(
                function (response) {
                    if (response.errors.length > 0) {
                        var content = '<p>La operación solicitada no se pudo realizar debido a los siguientes errores:</p>';
                        content += this.helperUl(response.errors);
                        this.setAlert('warning', 'Aviso!', content);
                        this.showModal();
                    } else {
                        this.refresh();
                        this.hideModal();
                    }
                }.bind(this)
                , formData);
    }

    confirmDeleteFile(file) {
        if (confirm('Esta seguro que desea borrar el archivo')) {
            this.deleteFile(file);
        }
    }

    deleteFile(file) {
        var path_relative = this.getPathRelative();
        var formData = new FormData();
        formData.append('action', 'delete');
        formData.append('file', file);
        formData.append('path_relative', path_relative);

        // Envia la peticion al servidor
        this.loadController(
                function (response) {
                    if (response.errors.length > 0) {
                        var content = '<p>La operación solicitada no se pudo realizar debido a los siguientes errores:</p>';
                        content += this.helperUl(response.errors);
                        this.setAlert('warning', 'Aviso!', content);
                        this.showModal();
                    } else {
                        this.refresh();
                        this.hideModal();
                    }
                }.bind(this)
                , formData);
    }

    refreshDisplayList(data) {
//        var thead = this.element.querySelector('');
        var tbody = this.element.querySelector('[data-id="files_display_content"] table>tbody');
        tbody.innerHTML = '';

        if (data.files.length < 1) {
            this.element.querySelector('[data-id="files_display_content"] table thead tr:last-child').style.display = 'table-row';
        } else {
            this.element.querySelector('[data-id="files_display_content"] table thead tr:last-child').style.display = 'none';
        }

        Array.from(data.files).forEach(function (val, index) {
            // Obtiene la extension del archivo a fin de vincular con una imagen representativa del mismo.
            var pos = val.basename.indexOf('.', 0);
            var ext = val.basename.substr(pos + 1);

            // Copia e inserta el template para que sea renderizado y asi poder asignar eventos
            var tpl = this.element.querySelector('#template_row');
            var copy = document.importNode(tpl.content, true);
            var tr = copy.querySelector("tr");
            // Convierte rutas relativas en absolutas
            this.convertRelativeImagePathToAbsolute(tr);

            var td = tr.querySelectorAll('td');

            var img_icon_type = td[0].querySelector('img');
            if (val.mime === 'directory') {
                // Cambia la imagen
                img_icon_type.src = this.scriptPath + 'external_libs/svg/folder.svg';
                img_icon_type.style.cursor = 'pointer';

                td[0].ondblclick = this.goDirectory.bind(this, val.basename);
                td[1].ondblclick = this.goDirectory.bind(this, val.basename);
                td[2].ondblclick = this.goDirectory.bind(this, val.basename);
                tr.style.cursor = 'pointer';
            } else {
                // Cambia la imagen
                img_icon_type.src = this.scriptPath + 'external_libs/svg/' + this.getClassByExts(ext) + '.svg';
                img_icon_type.style.cursor = 'default';
                tr.style.cursor = 'default';
            }

            td[1].innerHTML = val.basename;
            td[2].innerHTML = val.mime === 'directory' ? '...' : this.humanFileSize(val.size);

            // Asigna el metodo correspondiente al evento click en los botones
            var btnDownload = td[3].querySelector('img[name="download"]');
            var btnMove = td[3].querySelector('img[name="move"]');
            var btnShared = td[3].querySelector('img[name="shared"]');
            var btnEdit = td[3].querySelector('img[name="edit"]');
            var btnDelete = td[3].querySelector('img[name="delete"]');

            if (data.allowed_actions.indexOf('download') !== -1) {
                btnDownload.style.display = 'inline-block';
                if (val.mime === 'directory') {
                    btnDownload.disabled = true;
                    btnDownload.title = '';
                    // Asigna la clase CSS que deshabilita el boton "Download" por tratarse de un directorio
                    btnDownload.classList.add('icon-btn-disbled');
                } else {
                    btnDownload.onclick = this.downloadFile.bind(this, val.basename);
                }
            }

            if (data.allowed_actions.indexOf('move') !== -1) {
                btnMove.onclick = this.prepareMoveFiles.bind(this, val.basename);
            } else {
                btnMove.classList.add('icon-btn-disbled');
            }
            if (data.allowed_actions.indexOf('shared') !== -1) {
                btnShared.onclick = this.clipboardFile.bind(this, val.basename);
            } else {
                btnShared.classList.add('icon-btn-disbled');
            }
            if (data.allowed_actions.indexOf('rename') !== -1) {
                btnEdit.onclick = this.showFormRenameFile.bind(this, val.basename);
            } else {
                btnEdit.classList.add('icon-btn-disbled');
            }
            if (data.allowed_actions.indexOf('delete') !== -1) {
                btnDelete.onclick = this.confirmDeleteFile.bind(this, val.basename);
            } else {
                btnDelete.classList.add('icon-btn-disbled');
            }

            tbody.appendChild(tr);
        }.bind(this));
    }

    refreshBreadcurmb() {
        var list_breadcrumb = this.element.querySelector('[data-id="files_breadcrumb_content"] ul,ol');

        // Obtiene un arreglo con los elementos de la lista excluyento el primero que corresponde al home
        var items = list_breadcrumb.querySelectorAll('li:not(:first-child)');

        // Elimina los nodos seleccionados
        for (var k = 0; k < items.length; k++) {
            items[k].parentNode.removeChild(items[k]);
        }

        // Asigna evento al boton home
        var li = list_breadcrumb.querySelector('li');
        li.onclick = this.goHome.bind(this);

        // Crea las migas de pan
        for (var k = 0; k < this.pathRelativeArray.length; k++) {
            var li = document.createElement('li');
            li.onclick = this.btnBreadCrumb.bind(this, k);
            var a = document.createElement('a');
            a.innerHTML = this.pathRelativeArray[k];
            li.appendChild(a);
            list_breadcrumb.appendChild(li);
        }
        this.element.querySelector('[data-id="files_breadcrumb_content"]').appendChild(list_breadcrumb);
    }

    getClassByExts(ext) {
        var exts = {
            /*Text*/
            'file-alt': ['txt'],
            /*PDF*/
            'file-pdf': ['pdf'],
            /*Word*/
            'file-word': ['doc', 'docx'],
            /*Excel*/
            'file-excel': ['xls', 'xlsx', 'odt'],
            /*Powerpoint*/
            'file-powerpoint': ['ppt', 'pptx'],
            /*Image*/
            'file-image': ['gif', 'jpg', 'jpeg', 'png', 'bmp', 'tif'],
            /*Vector*/
            'file-vector': ['svg'],
            /*Archive*/
            'file-archive': ['zip', 'zipx', 'rar', 'tar', 'gz', 'dmg', 'iso'],
            /*Audio*/
            'file-audio': ['wav', 'mp3', 'fla', 'flac', 'ra', 'rma', 'aif', 'aiff', 'aa', 'aac', 'aax', 'ac3', 'au', 'ogg', 'avr', '3ga', 'flac', 'mid', 'midi', 'm4a', 'mp4a', 'amz', 'mka', 'asx', 'pcm', 'm3u', 'wma', 'xwma'],
            /*Video*/
            'file-video': ['avi', 'mpg', 'mp4', 'mkv', 'mov', 'wmv', 'vp6', '264', 'vid', 'rv', 'webm', 'swf', 'h264', 'flv', 'mk3d', 'gifv', 'oggv', '3gp', 'm4v', 'movie', 'divx'],
            /*code*/
            'file-code': ['css', 'js', 'py', 'git', 'py', 'cpp', 'h', 'ini', 'config'],
            /*Executable*/
            'terminal': ['exe', 'jar', 'dll', 'bat', 'pl', 'scr', 'msi', 'app', 'deb', 'apk', 'jar', 'vb', 'prg', 'sh'],
            /*link*/
            'globe': ['com', 'net', 'org', 'edu', 'gov', 'mil', 'html', 'htm', 'xhtml', 'jhtml', 'php', 'php3', 'php4', 'php5', 'phtml', 'asp', 'aspx', 'cfm']
        };
        for (var key in exts) {
            var el = exts[key];
            for (var k in el) {
                if (ext === el[k]) {
                    return key;
                }
            }
        }
        // Default file
        return 'file-alt';
    }

    setAlert(type, title, content) {
        this.setModalContent('template_alert');
        var filesModalBody = this.element.querySelector('[data-id="files-modal-content"]');

        var alertStyle;
        switch (type) {
            case 'danger':
                alertStyle = 'w3-container w3-pale-red';
                break;
            case 'warning':
                alertStyle = 'w3-container w3-pale-yellow';
                break;
            case 'success':
                alertStyle = 'w3-container w3-pale-green';
                break;
            default:
                alertStyle = 'w3-container w3-pale-blue';
        }
        filesModalBody.querySelector('[data-alert-container]').className = alertStyle;
        filesModalBody.querySelector('[data-alert-title]').innerHTML = title;
        filesModalBody.querySelector('[data-alert-content]').innerHTML = content;
    }

    setModalContent(id_template) {
        var filesModal = this.element.querySelector('[data-id="files-modal"]');
        var template = document.getElementById(id_template);
        var filesModalBody = this.element.querySelector('[data-id="files-modal-content"]');
        filesModalBody.innerHTML = '';
        var nodeClone = document.importNode(template.content, true);
        filesModalBody.appendChild(nodeClone);
        // Convierte rutas relativas en absolutas
        this.convertRelativeImagePathToAbsolute(filesModal);
    }

    showModal() {
        var filesModal = this.element.querySelector('[data-id="files-modal"]');
        filesModal.style.display = 'block';
    }

    hideModal() {
        var filesModal = this.element.querySelector('[data-id="files-modal"]');
        filesModal.style.display = 'none';
    }

    // Devuelve una lista desordenada de acuerdo al arreglo que recibe
    helperUl(arr) {
        var out = '<ul>';
        arr.forEach(function (valor, indice, array) {
            out += '<li>' + valor + '</li>';
        });
        out += '</ul>';
        return out;
    }

    humanFileSize(size) {
        var i = Math.floor(Math.log(size) / Math.log(1024));
        var decimal = i > 1 ? 2 : 0;
        return (size / Math.pow(1024, i)).toFixed(decimal) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }
}