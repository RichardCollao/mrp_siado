<?php

/**
 * Description of permissionhandler
 *
 * @author richard
 */
class PermissionsHandler {

    private $array_permissions_rules = [
        'members/establishments/view' => [
            'title_module' => 'Obra',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/establishments/index',
                'members/establishments/display'
            ]
        ],
        'members/establishments/edit' => [
            'title_module' => 'Obra',
            'title_rule' => 'Editar',
            'controllers' => [
                'members/establishments/logo',
                'members/establishments/modify'
            ]
        ],
        'members/users/view' => [
            'title_module' => 'Usuarios',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/users/index',
                'members/users/display'
            ]
        ],
        'members/users/manage' => [
            'title_module' => 'Usuarios',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/users/create',
                'members/users/edit',
                'members/users/delete',
                'members/users/details/*'
            ]
        ],
        'members/users/permissions' => [
            'title_module' => 'Usuarios',
            'title_rule' => 'Gestionar permisos',
            'controllers' => [
                'members/users/permissions'
            ]
        ],
        'members/expenseaccounts/view' => [
            'title_module' => 'Cuentas contables',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/expenseaccounts/index',
                'members/expenseaccounts/display'
            ]
        ],
        'members/expenseaccounts/manage' => [
            'title_module' => 'Cuentas contables',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/expenseaccounts/create',
                'members/expenseaccounts/edit',
                'members/expenseaccounts/delete',
                'members/expenseaccounts/details/*'
            ]
        ],
        'members/providers/view' => [
            'title_module' => 'Proveedores',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/providers/index',
                'members/providers/display'
            ]
        ],
        'members/providers/manage' => [
            'title_module' => 'Proveedores',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/providers/create',
                'members/providers/edit',
                'members/providers/delete',
                'members/providers/details/*'
            ]
        ],
        'members/providers/contacts' => [
            'title_module' => 'Proveedores',
            'title_rule' => 'Gestionar contactos',
            'controllers' => [
                'members/providers/contacts/*'
            ]
        ],
        'members/measures/view' => [
            'title_module' => 'Unidades de medida',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/measures/index',
                'members/measures/display'
            ]
        ],
        'members/measures/manage' => [
            'title_module' => 'Unidades de medida',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/measures/create',
                'members/measures/edit',
                'members/measures/delete',
                'members/measures/details/*'
            ]
        ],
        'members/materials/view' => [
            'title_module' => 'Materiales',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/materials/index',
                'members/materials/display',
                'members/materials/criticalstock'
            ]
        ],
        'members/materials/manage' => [
            'title_module' => 'Materiales',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/materials/create',
                'members/materials/edit',
                'members/materials/delete',
                'members/materials/details/*'
            ]
        ],
        'members/purchaseorders/view' => [
            'title_module' => 'Ordenes de compra',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/purchaseorders/index',
                'members/purchaseorders/display'
            ]
        ],
        'members/purchaseorders/manage' => [
            'title_module' => 'Ordenes de compra',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/purchaseorders/create',
                'members/purchaseorders/edit',
                'members/purchaseorders/delete',
                'members/purchaseorders/details/*'
            ]
        ],
        'members/purchaseorders/attachments' => [
            'title_module' => 'Ordenes de compra',
            'title_rule' => 'Gestionar archivos adjuntos',
            'controllers' => [
                'members/purchaseorders/attachments'
            ]
        ],
        'members/purchaseorders/locked' => [
            'title_module' => 'Ordenes de compra',
            'title_rule' => 'Bloquear y desbloquear',
            'controllers' => [
                'members/purchaseorders/locked/*'
            ]
        ],
        'members/purchaseorders/document' => [
            'title_module' => 'Ordenes de compra',
            'title_rule' => 'Generar documento PDF',
            'controllers' => [
                'members/purchaseorders/document'
            ]
        ],
        'members/guides/view' => [
            'title_module' => 'Guias',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/guides/index',
                'members/guides/display'
            ]
        ],
        'members/guides/manage' => [
            'title_module' => 'Guias',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/guides/create',
                'members/guides/edit',
                'members/guides/delete',
                'members/guides/details/*'
            ]
        ],
        'members/guides/bill' => [
            'title_module' => 'Guias',
            'title_rule' => 'Listar guias asociadas',
            'controllers' => [
                'members/guides/bill'
            ]
        ],
        'members/guides/locked' => [
            'title_module' => 'Guias',
            'title_rule' => 'Bloquear y desbloquear',
            'controllers' => [
                'members/guides/locked/*'
            ]
        ],
        'members/guides/attachments' => [
            'title_module' => 'Guias',
            'title_rule' => 'Gestionar archivos adjuntos',
            'controllers' => [
                'members/guides/attachments'
            ]
        ],
        'members/bills/view' => [
            'title_module' => 'Facturas',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/bills/index',
                'members/bills/display'
            ]
        ],
        'members/bills/manage' => [
            'title_module' => 'Facturas',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/bills/create',
                'members/bills/edit',
                'members/bills/delete',
                'members/bills/details/*'
            ]
        ],
        'members/bills/locked' => [
            'title_module' => 'Facturas',
            'title_rule' => 'Bloquear y desbloquear',
            'controllers' => [
                'members/bills/locked/*'
            ]
        ],
        'members/bills/attachments' => [
            'title_module' => 'Facturas',
            'title_rule' => 'Gestionar archivos adjuntos',
            'controllers' => [
                'members/bills/attachments'
            ]
        ],
        'members/vouchers/view' => [
            'title_module' => 'Vales',
            'title_rule' => 'Listar y ver',
            'controllers' => [
                'members/vouchers/index',
                'members/vouchers/display'
            ]
        ],
        'members/vouchers/manage' => [
            'title_module' => 'Vales',
            'title_rule' => 'Crear, editar y borrar',
            'controllers' => [
                'members/vouchers/create',
                'members/vouchers/edit',
                'members/vouchers/delete',
                'members/vouchers/details/*'
            ]
        ],
        'members/vouchers/locked' => [
            'title_module' => 'Vales',
            'title_rule' => 'Bloquear y desbloquear',
            'controllers' => [
                'members/vouchers/locked/*'
            ]
        ],
        'members/vouchers/attachments' => [
            'title_module' => 'Vales',
            'title_rule' => 'Gestionar archivos adjuntos',
            'controllers' => [
                'members/vouchers/attachments'
            ]
        ],
        'members/moldings/guides' => [
            'title_module' => 'Moldaje',
            'title_rule' => 'Gestionar',
            'controllers' => [
                'members/moldings/guides/*'
            ]
        ],
        'members/others/authorize_vouchers' => [
            'title_module' => 'Otros permisos',
            'title_rule' => 'Autorizar vales',
            'controllers' => [
                'members/authorize_vouchers'
            ]
        ]
    ];

    public function getArrayPermissions() {
        return $this->array_permissions_rules;
    }

    public function getControllersByKey($key) {
        return $this->array_permissions_rules[$key];
    }

    public function isControllerMemberOfRulesArray($controller, Array $rules) {
        if (in_array($controller, $this->getControllerFromRulesArray($rules))) {
            return true;
        }
        return false;
    }

    private function getControllerFromRulesArray(Array $rules) {
        $out = array();
        foreach ($rules as $rule) {
            if (array_key_exists($rule, $this->array_permissions_rules)) {
                $out = array_merge($out, $this->array_permissions_rules[$rule]['controllers']);
            }
        }
        return $out;
    }

}
