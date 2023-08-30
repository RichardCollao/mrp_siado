-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2016 a las 22:00:54
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

-- 
-- Autor:Richard Collao Olivares
-- pagina web: http://www.richardcollao.cl
-- correo: richard.collao@outlook.cl

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: 'erp'
--


--
-- Estructura de tabla para la tabla 'bills'
--
CREATE TABLE IF NOT EXISTS bills (
  id_bill int(11) NOT NULL AUTO_INCREMENT,
  fk_id_purchase_order int(11) NOT NULL,
  number varchar(11) CHARACTER SET utf8 NOT NULL,
  issue_date date NOT NULL,
  created_at datetime NOT NULL,
  observation varchar(512) NOT NULL,
  status varchar(12) CHARACTER SET utf8 NOT NULL,
  locked tinyint(1) NOT NULL DEFAULT 0,
PRIMARY KEY (id_bill),
KEY fk_id_purchase_order (fk_id_purchase_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'bills_details'
--
CREATE TABLE IF NOT EXISTS bills_details (
  id_bill_detail int(11) NOT NULL AUTO_INCREMENT,
  fk_id_bill int(11) NOT NULL,
  fk_id_purchase_order_detail int(11) NOT NULL,
  quantity decimal(15,4) NOT NULL,
  value decimal(15,4) NOT NULL,
PRIMARY KEY (id_bill_detail),
KEY fk_id_bill (fk_id_bill),
KEY fk_id_purchase_order_detail (fk_id_purchase_order_detail)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'establishments'
--
CREATE TABLE IF NOT EXISTS establishments (
  id_establishment int(11) NOT NULL AUTO_INCREMENT,
  name_business varchar(128) NOT NULL,
  activity_business varchar(256) NOT NULL,
  rut_business varchar(10) NOT NULL,
  address_business varchar(128) NOT NULL,
  phone_business varchar(32) NOT NULL,
  name varchar(128) NOT NULL,
  address varchar(128) NOT NULL,
  phone varchar(32) NOT NULL,
PRIMARY KEY (id_establishment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'expense_accounts'
--
CREATE TABLE IF NOT EXISTS expense_accounts (
  id_expense_account int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  number varchar(16) NOT NULL,
  name text NOT NULL,
PRIMARY KEY (id_expense_account),
KEY fk_id_establishment (fk_id_establishment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'guides'
--
CREATE TABLE IF NOT EXISTS guides (
  id_guide int(11) NOT NULL AUTO_INCREMENT,
  fk_id_purchase_order int(11) NOT NULL,
  fk_id_bill int(11) NULL,
  number varchar(11) CHARACTER SET utf8 NOT NULL,
  issue_date date NOT NULL,
  created_at datetime NOT NULL,
  observation varchar(512) NOT NULL,
  status varchar(12) NOT NULL,
  locked tinyint(1) NOT NULL DEFAULT 0,
PRIMARY KEY (id_guide),
KEY fk_id_purchase_order (fk_id_purchase_order),
KEY fk_id_bill (fk_id_bill)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'guides_details'
--
CREATE TABLE IF NOT EXISTS guides_details (
  id_guide_detail int(11) NOT NULL AUTO_INCREMENT,
  fk_id_guide int(11) NOT NULL,
  fk_id_purchase_order_detail int(11) NOT NULL,
  quantity decimal(15,4) NOT NULL,
PRIMARY KEY (id_guide_detail),
KEY fk_id_guide (fk_id_guide),
KEY fk_id_purchase_order_detail (fk_id_purchase_order_detail)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla hash_security
--
CREATE TABLE IF NOT EXISTS hash_security (
  fk_id_user int(11) NOT NULL,
  operation varchar(16) NOT NULL,
  hash varchar(32) NOT NULL,
  date_creation datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla 'materials'
--
CREATE TABLE IF NOT EXISTS materials (
  id_material int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  fk_id_measure int(11) NOT NULL,
  fk_id_expense_account int(11) NOT NULL,
  name varchar(128) NOT NULL,
  critical_stock decimal(15,4) NOT NULL,
PRIMARY KEY (id_material),
KEY fk_id_establishment (fk_id_establishment),
KEY fk_id_measure (fk_id_measure),
KEY fk_id_expense_account (fk_id_expense_account)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'measures'
--
CREATE TABLE IF NOT EXISTS measures (
  id_measure int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  abbreviation varchar(16) NOT NULL,
  terminology varchar(32) NOT NULL,
PRIMARY KEY (id_measure),
KEY fk_id_establishment (fk_id_establishment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Table structure for table moldings
--

CREATE TABLE moldings (
  id_molding int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  fk_id_provider int(11) NOT NULL,
  fk_id_expense_account int(11) NOT NULL,
  name varchar(128) CHARACTER SET utf8 NOT NULL,
  created_at datetime NOT NULL,
  PRIMARY KEY (id_molding),
  KEY fk_id_establishment (fk_id_establishment),
  KEY fk_id_provider (fk_id_provider),
  KEY fk_id_expense_account (fk_id_expense_account)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table moldings_guides
--

CREATE TABLE moldings_guides (
  id_molding_guide int(11) NOT NULL AUTO_INCREMENT,
  fk_id_molding int(11) NOT NULL,
  type varchar(11) CHARACTER SET utf8 NOT NULL,
  number varchar(11) CHARACTER SET utf8 NOT NULL,
  issue_date date NOT NULL,
  created_at datetime NOT NULL,
  observation varchar(512) NOT NULL,
  status varchar(12) NOT NULL,
  PRIMARY KEY (id_molding_guide),
  KEY fk_id_molding (fk_id_molding)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table moldings_guides_details
--

CREATE TABLE moldings_guides_details (
  id_molding_guide_detail int(11) NOT NULL AUTO_INCREMENT,
  fk_id_molding_guide int(11) NOT NULL,
  fk_id_molding_piece int(11) NOT NULL,
  quantity int(11) NOT NULL,
  PRIMARY KEY (id_molding_guide_detail),
  KEY fk_id_molding_guide (fk_id_molding_guide),
  KEY fk_id_molding_piece (fk_id_molding_piece)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table moldings_pieces
--

CREATE TABLE moldings_pieces (
  id_molding_piece int(11) NOT NULL AUTO_INCREMENT,
  fk_id_molding int(11) NOT NULL,
  code varchar(32) NOT NULL,
  name varchar(255) NOT NULL,
  weight double(8,2) NOT NULL,
  PRIMARY KEY (id_molding_piece),
  KEY fk_id_molding (fk_id_molding)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--
-- Estructura de tabla para la tabla 'providers'
--
CREATE TABLE IF NOT EXISTS providers (
  id_provider int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  name varchar(256) NOT NULL,
  activity varchar(256) NOT NULL,
  rut varchar(10) NOT NULL,
  mail varchar(128) NOT NULL,
  address varchar(255) NOT NULL,
  phone varchar(32) NOT NULL,
PRIMARY KEY (id_provider),
KEY fk_id_establishment (fk_id_establishment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla providers_contacts
--
CREATE TABLE IF NOT EXISTS providers_contacts (
  id_provider_contact int(11) NOT NULL AUTO_INCREMENT,
  fk_id_provider int(11) NOT NULL,
  name varchar(64) NOT NULL,
  mail varchar(128) NOT NULL,
  phone varchar(32) NOT NULL,
PRIMARY KEY (id_provider_contact),
KEY fk_id_provider (fk_id_provider)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'purchase_orders'
--
CREATE TABLE IF NOT EXISTS purchase_orders (
  id_purchase_order int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  fk_id_provider int(11) NOT NULL,
  number varchar(16) NOT NULL,
  issue_date date NOT NULL,
  created_at datetime NOT NULL,
  status varchar(12) NOT NULL,
  locked tinyint(1) NOT NULL DEFAULT 0,
  vendor_name varchar(32) NOT NULL,
  vendor_contact varchar(256) NOT NULL,
  dispatch_name varchar(32) NOT NULL,
  dispatch_contact varchar(256) NOT NULL,
  dispatch_address varchar(128) NOT NULL,
  number_material_request varchar(16) NOT NULL,
  number_quotation varchar(16) NOT NULL,
  way_to_pay varchar(512) NOT NULL,
  observation varchar(512) NOT NULL,
  footer varchar(512) NOT NULL,
PRIMARY KEY (id_purchase_order),
KEY fk_id_establishment (fk_id_establishment),
KEY fk_id_provider  (fk_id_provider)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'purchase_orders_details'
--
CREATE TABLE IF NOT EXISTS purchase_orders_details (
  id_purchase_order_detail int(11) NOT NULL AUTO_INCREMENT,
  fk_id_purchase_order int(11) NOT NULL,
  fk_id_material int(11) NOT NULL,
  code varchar(16) NOT NULL,
  quantity decimal(15,4) NOT NULL,
  value decimal(15,4) NOT NULL,
PRIMARY KEY (id_purchase_order_detail),
KEY fk_id_purchase_order  (fk_id_purchase_order),
KEY fk_id_material  (fk_id_material)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'sessions'
--
CREATE TABLE IF NOT EXISTS sessions (
  fk_id_user int(11) NOT NULL,
  session_id varchar(32) NOT NULL,
  user_agent varchar(256) NOT NULL,
  ip_current int(11) unsigned NOT NULL,
  last_activity datetime NOT NULL,
  connection_status tinyint(1) NOT NULL,
PRIMARY KEY (fk_id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla 'users'
--
CREATE TABLE IF NOT EXISTS users (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  name varchar(32) NOT NULL,
  mail varchar(128) NOT NULL,
  password varchar(64) NOT NULL,
  phone varchar(32) NOT NULL,
  state_acount varchar(16) NOT NULL,
  type_user varchar(16) NOT NULL,
  date_reg datetime NOT NULL,
  last_logon datetime NOT NULL,
  date_current datetime NOT NULL,
PRIMARY KEY (id_user),
KEY name (name),
UNIQUE KEY mail_establishment (mail, fk_id_establishment),
KEY fk_id_establishment (fk_id_establishment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'users_permissions'
--
CREATE TABLE IF NOT EXISTS users_permissions (
  fk_id_user int(11) NOT NULL,
  permissions text CHARACTER SET utf8 NOT NULL,
  locked tinyint(1) NOT NULL,
PRIMARY KEY (fk_id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla 'vouchers'
--
CREATE TABLE IF NOT EXISTS vouchers (
  id_voucher int(11) NOT NULL AUTO_INCREMENT,
  fk_id_establishment int(11) NOT NULL,
  fk_id_user_typist int(11) NOT NULL,
  fk_id_user_autorized int(11) NOT NULL,
  user_name_requesting varchar(32) NOT NULL,
  number int(11) NOT NULL,
  issue_date date NOT NULL,
  created_at datetime NOT NULL,
  status varchar(12) NOT NULL,
  locked tinyint(1) NOT NULL DEFAULT 0,
  destination varchar(64) NOT NULL,
  observation varchar(512) NOT NULL,
PRIMARY KEY (id_voucher),
KEY fk_id_establishment (fk_id_establishment),
KEY fk_id_user_typist (fk_id_user_typist),
KEY fk_id_user_autorized (fk_id_user_autorized)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Estructura de tabla para la tabla 'vouchers_details'
--
CREATE TABLE IF NOT EXISTS vouchers_details (
  id_voucher_detail int(11) NOT NULL AUTO_INCREMENT,
  fk_id_voucher int(11) NOT NULL,
  fk_id_material int(11) NOT NULL,
  quantity decimal(15,4) NOT NULL,
PRIMARY KEY (id_voucher_detail),
KEY fk_id_voucher (fk_id_voucher),
KEY fk_id_material (fk_id_material)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla bills
--
ALTER TABLE bills
ADD CONSTRAINT bills_ibfk_1 FOREIGN KEY (fk_id_purchase_order) REFERENCES purchase_orders (id_purchase_order);

--
-- Filtros para la tabla bills_details
--
ALTER TABLE bills_details
ADD CONSTRAINT bills_details_ibfk_1 FOREIGN KEY (fk_id_bill) REFERENCES bills (id_bill),
ADD CONSTRAINT bills_details_ibfk_2 FOREIGN KEY (fk_id_purchase_order_detail) REFERENCES purchase_orders_details (id_purchase_order_detail);

--
-- Filtros para la tabla expense_accounts
--
ALTER TABLE expense_accounts
ADD CONSTRAINT expense_accounts_ibfk_1 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment);

--
-- Filtros para la tabla guides
--
ALTER TABLE guides
ADD CONSTRAINT guides_ibfk_1 FOREIGN KEY (fk_id_purchase_order) REFERENCES purchase_orders (id_purchase_order);

--
-- Filtros para la tabla guides_details
--
ALTER TABLE guides_details
ADD CONSTRAINT guides_details_ibfk_1 FOREIGN KEY (fk_id_guide) REFERENCES guides (id_guide),
ADD CONSTRAINT guides_details_ibfk_2 FOREIGN KEY (fk_id_purchase_order_detail) REFERENCES purchase_orders_details (id_purchase_order_detail);

--
-- Filtros para la tabla materials
--
ALTER TABLE materials
ADD CONSTRAINT materials_ibfk_1 FOREIGN KEY (fk_id_measure) REFERENCES measures (id_measure),
ADD CONSTRAINT materials_ibfk_2 FOREIGN KEY (fk_id_expense_account) REFERENCES expense_accounts (id_expense_account),
ADD CONSTRAINT materials_ibfk_3 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment);

--
-- Filtros para la tabla measures
--
ALTER TABLE measures
ADD CONSTRAINT measures_ibfk_1 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment);

--
-- Constraints for table moldings
--
ALTER TABLE moldings
ADD CONSTRAINT moldings_ibfk_1 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment),
ADD CONSTRAINT moldings_ibfk_2 FOREIGN KEY (fk_id_provider) REFERENCES providers (id_provider),
ADD CONSTRAINT moldings_ibfk_3 FOREIGN KEY (fk_id_expense_account) REFERENCES expense_accounts (id_expense_account);

--
-- Constraints for table moldings_guides
--
ALTER TABLE moldings_guides
ADD CONSTRAINT moldings_guides_ibfk_1 FOREIGN KEY (fk_id_molding) REFERENCES moldings (id_molding);

--
-- Constraints for table moldings_guides_details
--
ALTER TABLE moldings_guides_details
ADD CONSTRAINT moldings_guides_details_ibfk_1 FOREIGN KEY (fk_id_molding_guide) REFERENCES moldings_guides (id_molding_guide),
ADD CONSTRAINT moldings_guides_details_ibfk_2 FOREIGN KEY (fk_id_molding_piece) REFERENCES moldings_pieces (id_molding_piece);

--
-- Constraints for table moldings_pieces
--
ALTER TABLE moldings_pieces
ADD CONSTRAINT moldings_pieces_ibfk_1 FOREIGN KEY (fk_id_molding) REFERENCES moldings (id_molding);


--
-- Filtros para la tabla providers
--
ALTER TABLE providers
ADD CONSTRAINT providers_ibfk_1 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment);

--
-- Filtros para la tabla providers_contacts
--
ALTER TABLE providers_contacts
ADD CONSTRAINT providers_contacts_ibfk_1 FOREIGN KEY (fk_id_provider) REFERENCES providers (id_provider);

--
-- Filtros para la tabla purchase_orders
--
ALTER TABLE purchase_orders
ADD CONSTRAINT purchase_orders_ibfk_1 FOREIGN KEY (fk_id_provider) REFERENCES providers (id_provider),
ADD CONSTRAINT purchase_orders_ibfk_2 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment);

--
-- Filtros para la tabla purchase_orders_details
--
ALTER TABLE purchase_orders_details
ADD CONSTRAINT purchase_orders_details_ibfk_1 FOREIGN KEY (fk_id_purchase_order) REFERENCES purchase_orders (id_purchase_order),
ADD CONSTRAINT purchase_orders_details_ibfk_2 FOREIGN KEY (fk_id_material) REFERENCES materials (id_material);

--
-- Filtros para la tabla sessions
--
ALTER TABLE sessions
ADD CONSTRAINT sessions_ibfk_1 FOREIGN KEY (fk_id_user) REFERENCES users (id_user) ON DELETE CASCADE;

--
-- Filtros para la tabla users
--
ALTER TABLE users
ADD CONSTRAINT users_ibfk_1 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment);

--
-- Filtros para la tabla users_permissions
--
ALTER TABLE users_permissions
ADD CONSTRAINT users_permissions_ibfk_1 FOREIGN KEY (fk_id_user) REFERENCES users (id_user) ON DELETE CASCADE;

--
-- Filtros para la tabla vouchers
--
ALTER TABLE vouchers
ADD CONSTRAINT vouchers_ibfk_1 FOREIGN KEY (fk_id_user_autorized) REFERENCES users (id_user),
ADD CONSTRAINT vouchers_ibfk_2 FOREIGN KEY (fk_id_establishment) REFERENCES establishments (id_establishment),
ADD CONSTRAINT vouchers_ibfk_3 FOREIGN KEY (fk_id_user_typist) REFERENCES users (id_user);

--
-- Filtros para la tabla vouchers_details
--
ALTER TABLE vouchers_details
ADD CONSTRAINT vouchers_details_ibfk_1 FOREIGN KEY (fk_id_voucher) REFERENCES vouchers (id_voucher),
ADD CONSTRAINT vouchers_details_ibfk_2 FOREIGN KEY (fk_id_material) REFERENCES materials (id_material);


--
-- Estructura para la vistas `view_*`
--

CREATE VIEW view_materials AS SELECT materials.*, measures.abbreviation, measures.terminology, 
            expense_accounts.name AS ea_name, expense_accounts.number AS ea_number, 
                (SELECT COALESCE(SUM(guides_details.quantity), 0)  
                FROM guides_details, purchase_orders_details 
                WHERE purchase_orders_details.fk_id_material = materials.id_material 
                AND guides_details.fk_id_purchase_order_detail = purchase_orders_details.id_purchase_order_detail) 
                AS total_in_guides, 
                (SELECT COALESCE(SUM(vouchers_details.quantity), 0) 
                FROM vouchers_details 
                WHERE vouchers_details.fk_id_material = materials.id_material) 
                AS total_in_vouchers 
            FROM materials 
            INNER JOIN expense_accounts on expense_accounts.id_expense_account = materials.fk_id_expense_account 
            INNER JOIN measures on measures.id_measure = materials.fk_id_measure;

CREATE VIEW view_purchase_orders AS SELECT purchase_orders.*, providers.name AS provider_name, 
            (SELECT SUM(purchase_orders_details.quantity * purchase_orders_details.value) 
            FROM purchase_orders_details 
            WHERE purchase_orders_details.fk_id_purchase_order = purchase_orders.id_purchase_order 
            ) AS total, 
            (SELECT SUM(bills_details.quantity * bills_details.value) 
            FROM bills_details, bills 
            WHERE bills_details.fk_id_bill = bills.id_bill 
            AND bills.fk_id_purchase_order = purchase_orders.id_purchase_order 
            ) AS bills_total, 
            (SELECT COUNT(*) FROM purchase_orders_details 
            WHERE purchase_orders_details.fk_id_purchase_order = purchase_orders.id_purchase_order) AS count_items,
        (SELECT COUNT(*) FROM bills WHERE bills.fk_id_purchase_order = purchase_orders.id_purchase_order) AS count_bills,  
        (SELECT COUNT(*) FROM guides WHERE guides.fk_id_purchase_order = purchase_orders.id_purchase_order) AS count_guides  
        FROM purchase_orders 
        INNER JOIN providers on purchase_orders.fk_id_provider = providers.id_provider;

CREATE VIEW view_bills AS SELECT bills.*, 
        purchase_orders.fk_id_establishment, purchase_orders.number AS po_number, 
        providers.id_provider AS fk_id_provider, providers.name AS provider_name, 
            (SELECT COALESCE(SUM(quantity * value), 0) 
            FROM bills_details 
            WHERE fk_id_bill = bills.id_bill 
            ) AS total, 
            (SELECT COALESCE(SUM(guides_details.quantity * purchase_orders_details.value), 0) 
            FROM guides_details, purchase_orders_details, guides  
            WHERE guides.fk_id_bill = bills.id_bill 
            AND guides_details.fk_id_guide = guides.id_guide 
            AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail
            ) AS total_guides, 
        (SELECT COUNT(*) FROM bills_details WHERE bills_details.fk_id_bill = bills.id_bill) AS count_items, 
        (SELECT COUNT(*) FROM guides WHERE guides.fk_id_bill = bills.id_bill) AS count_guides 
        FROM bills 
        INNER JOIN purchase_orders on purchase_orders.id_purchase_order = bills.fk_id_purchase_order 
        INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider;

CREATE VIEW view_guides AS SELECT guides.*, 
        purchase_orders.fk_id_establishment, purchase_orders.number AS po_number, 
        (SELECT bills.number FROM bills WHERE bills.id_bill = guides.fk_id_bill) AS bill_number,  
        providers.id_provider AS fk_id_provider, providers.name AS provider_name,   
            (SELECT COALESCE(SUM(guides_details.quantity * purchase_orders_details.value), 0) 
            FROM guides_details, purchase_orders_details 
            WHERE guides_details.fk_id_guide = guides.id_guide 
            AND purchase_orders_details.id_purchase_order_detail = guides_details.fk_id_purchase_order_detail
            ) AS total, 
        (SELECT COUNT(*) FROM guides_details WHERE guides_details.fk_id_guide = guides.id_guide) AS count_items 
        FROM guides
        INNER JOIN purchase_orders on purchase_orders.id_purchase_order = guides.fk_id_purchase_order 
        INNER JOIN providers on providers.id_provider = purchase_orders.fk_id_provider;

CREATE VIEW view_vouchers AS SELECT vouchers.*, 
        users_a.name AS user_name_autorized, users_t.name AS user_name_typist,
        (SELECT COUNT(*) FROM vouchers_details WHERE vouchers_details.fk_id_voucher = vouchers.id_voucher) AS count_items 
        FROM vouchers
        INNER JOIN users AS users_a on users_a.id_user = vouchers.fk_id_user_autorized 
        INNER JOIN users AS users_t on users_t.id_user = vouchers.fk_id_user_typist;

INSERT INTO `establishments` (`id_establishment`, `name_business`, `activity_business`, `rut_business`, `address_business`, `phone_business`, `name`, `address`, `phone`) VALUES
(1, 'SIADO', '', '', '', '', 'SIADO', '', '');