<style type="text/css">
    .navbar-custom {
        background-color: #0088cc;
        border-color: #0072ab;
        background-image: -webkit-gradient(linear, left 0%, left 100%, from(#00aaff), to(#0088cc));
        background-image: -webkit-linear-gradient(top, #00aaff, 0%, #0088cc, 100%);
        background-image: -moz-linear-gradient(top, #00aaff 0%, #0088cc 100%);
        background-image: linear-gradient(to bottom, #00aaff 0%, #0088cc 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff00aaff', endColorstr='#ff0088cc', GradientType=0);
        z-index: 10001; /*sobre componente SelectMultiColumn*/
    }
    .navbar-custom .navbar-brand {
        color: #ffffff;
    }
    .navbar-custom .navbar-brand:hover,
    .navbar-custom .navbar-brand:focus {
        color: #e6e6e6;
        background-color: transparent;
    }
    .navbar-custom .navbar-text {
        color: #ffffff;
    }
    .navbar-custom .navbar-nav > li:last-child > a {
        border-right: 1px solid #0072ab;
    }
    .navbar-custom .navbar-nav > li > a {
        color: #ffffff;
        border-left: 1px solid #0072ab;
    }
    .navbar-custom .navbar-nav > li > a:hover,
    .navbar-custom .navbar-nav > li > a:focus {
        color: #c0c0c0;
        background-color: transparent;
    }
    .navbar-custom .navbar-nav > .active > a,
    .navbar-custom .navbar-nav > .active > a:hover,
    .navbar-custom .navbar-nav > .active > a:focus {
        color: #c0c0c0;
        background-color: #0072ab;
        background-image: -webkit-gradient(linear, left 0%, left 100%, from(#0072ab), to(#0094de));
        background-image: -webkit-linear-gradient(top, #0072ab, 0%, #0094de, 100%);
        background-image: -moz-linear-gradient(top, #0072ab 0%, #0094de 100%);
        background-image: linear-gradient(to bottom, #0072ab 0%, #0094de 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0072ab', endColorstr='#ff0094de', GradientType=0);
    }
    .navbar-custom .navbar-nav > .disabled > a,
    .navbar-custom .navbar-nav > .disabled > a:hover,
    .navbar-custom .navbar-nav > .disabled > a:focus {
        color: #cccccc;
        background-color: transparent;
    }
    .navbar-custom .navbar-toggle {
        border-color: #dddddd;
    }
    .navbar-custom .navbar-toggle:hover,
    .navbar-custom .navbar-toggle:focus {
        background-color: #dddddd;
    }
    .navbar-custom .navbar-toggle .icon-bar {
        background-color: #cccccc;
    }
    .navbar-custom .navbar-collapse,
    .navbar-custom .navbar-form {
        border-color: #0070a8;
    }
    .navbar-custom .navbar-nav > .dropdown > a:hover .caret,
    .navbar-custom .navbar-nav > .dropdown > a:focus .caret {
        border-top-color: #c0c0c0;
        border-bottom-color: #c0c0c0;
    }
    .navbar-custom .navbar-nav > .open > a,
    .navbar-custom .navbar-nav > .open > a:hover,
    .navbar-custom .navbar-nav > .open > a:focus {
        background-color: #0072ab;
        color: #c0c0c0;
    }
    .navbar-custom .navbar-nav > .open > a .caret,
    .navbar-custom .navbar-nav > .open > a:hover .caret,
    .navbar-custom .navbar-nav > .open > a:focus .caret {
        border-top-color: #c0c0c0;
        border-bottom-color: #c0c0c0;
    }
    .navbar-custom .navbar-nav > .dropdown > a .caret {
        border-top-color: #ffffff;
        border-bottom-color: #ffffff;
    }
    @media (max-width: 767) {
        .navbar-custom .navbar-nav .open .dropdown-menu > li > a {
            color: #ffffff;
        }
        .navbar-custom .navbar-nav .open .dropdown-menu > li > a:hover,
        .navbar-custom .navbar-nav .open .dropdown-menu > li > a:focus {
            color: #c0c0c0;
            background-color: transparent;
        }
        .navbar-custom .navbar-nav .open .dropdown-menu > .active > a,
        .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:hover,
        .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:focus {
            color: #c0c0c0;
            background-color: #0072ab;
        }
        .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a,
        .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:hover,
        .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:focus {
            color: #cccccc;
            background-color: transparent;
        }
    }
    .navbar-custom .navbar-link {
        color: #ffffff;
    }
    .navbar-custom .navbar-link:hover {
        color: #c0c0c0;
    }

</style>

<!-- La clase navbar-default es referenciada solo para obtener el mismo color de fondo en el div -->
<div class="row navbar-custom navbar-fixed-top" >
    <div style="padding: 0;margin-left: 40px; margin-right: 40px;width: 1280px">
        <div class="col-lg-9">
            <nav class="navbar navbar-custom" role="navigation" style="margin: 0;border: 0">
                <div class="navbar-header" style="text-align: left;min-width: 300px;max-width: 300px">
                    <a class="navbar-brand" href="<?php echo path::urlDomain(''); ?>">
                        <?php echo HelperWebIconFontAwesome::iconHome(); ?>
                        <?php echo $data['name_establishment']; ?></a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <?php if (AUTH_TYPE_USER == 'super_admin'): ?>
                            <li class="dropdown">
                                <a href="<?php echo path::urlDomain(''); ?>" class="dropdown-toggle" data-toggle="dropdown">
                                    Administración <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo path::urlDomain('admincp/establishments'); ?>">Obras</a></li>
                                    <li><a href="<?php echo path::urlDomain('admincp/users'); ?>">Usuarios</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Administración <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo path::urlDomain('establishments'); ?>">Obra</a></li>
                                    <li><a href="<?php echo path::urlDomain('users'); ?>">Usuarios</a></li>
                                    <li><a href="<?php echo path::urlDomain('expenseaccounts'); ?>">Cuentas de costos</a></li>
                                    <li><a href="<?php echo path::urlDomain('providers'); ?>">Proveedores</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Materiales <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo path::urlDomain('measures'); ?>">Unidades de medida</a></li>
                                    <li><a href="<?php echo path::urlDomain('materials'); ?>">Materiales</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Documentos <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <!--<li><a href="<?php echo path::urlDomain('materialsrequests'); ?>">Solicitudes de materiales</a></li>-->
                                    <li><a href="<?php echo path::urlDomain('purchaseorders'); ?>">Ordenes de compra</a></li>
                                    <li><a href="<?php echo path::urlDomain('bills'); ?>">Facturas</a></li>
                                    <li><a href="<?php echo path::urlDomain('guides'); ?>">Guías</a></li>
                                    <li><a href="<?php echo path::urlDomain('vouchers'); ?>">Vales</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="<?php echo path::urlDomain('moldings'); ?>">Moldajes</a>
                            </li>
                            <li>
                                <a href="<?php echo path::urlDomain('reports'); ?>">Informes</a>
                            </li>
                            <li>
                                <a href="<?php echo path::urlDomain('attachments'); ?>">Archivos</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="col-lg-3" style="text-align: right;">
            <a class="navbar-brand" href="#" style="text-decoration:none; color:#f5f5f5" title="">
                <?php echo HelperWebIconFontAwesome::iconUser(); ?>
                <?php echo $data['auth_name']; ?>
            </a>
            &nbsp;
            <?php if (constant('AUTHENTICATED')): ?>
                <a class="navbar-brand" href="<?php echo $data['link_out']; ?>" style="text-decoration:none; color:#f5f5f5" title="Cerrar sesion">
                    <?php echo HelperWebIconFontAwesome::iconSignOut(); ?>
                    Salir
                </a>
            <?php endif; ?> 
        </div>
    </div>
</div>