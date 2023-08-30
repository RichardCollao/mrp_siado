function captcha_refresh() {
    var $path = document.getElementById("img_captcha").src.split('?')[0];
    document.getElementById("img_captcha").src = $path + '?nocache=' + parseInt(Math.random() * 999999);
}

