CREATE  TABLE `virtualmenu`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_user` INT NOT NULL ,
  `comments` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `user_id_by_order` (`id_user` ASC) );

CREATE TABLE `products_by_order` (
  `id_order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id_order`,`id_menu`,`id_product`),
  KEY `order_id_by_products_by_order` (`id_order`),
  KEY `menu_and_product_id_by_products_by_order` (`id_product`,`id_menu`),
  CONSTRAINT `menu_and_product_id_by_products_by_order` FOREIGN KEY (`id_product`, `id_menu`) REFERENCES `products_by_menu` (`id_product`, `id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_id_by_products_by_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE );

ALTER TABLE `sections` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `menus` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `section_types` MODIFY `id` INT(11) NOT NULL;
ALTER TABLE `menu_types` MODIFY `id` INT(11) NOT NULL;
ALTER TABLE `customers` MODIFY `address` VARCHAR(255);
ALTER TABLE `groups` MODIFY `address` VARCHAR(255);
ALTER TABLE `users` MODIFY `email` VARCHAR(255) NOT NULL;
ALTER TABLE `providers` MODIFY `email` VARCHAR(255);
ALTER TABLE `providers` ADD `name_uri` VARCHAR(50) NOT NULL AFTER `web`;
ALTER TABLE `virtualmenu`.`products` ADD COLUMN `id_provider` INT NOT NULL  AFTER `base_price`;
ALTER TABLE `virtualmenu`.`products` 
  ADD CONSTRAINT `products_id_provider`
  FOREIGN KEY (`id_provider` )
  REFERENCES `virtualmenu`.`providers` (`id` )
  ON DELETE CASCADE
  ON UPDATE CASCADE
, ADD INDEX `products_id_provider` (`id_provider` ASC) ;
ALTER TABLE group_types MODIFY `id` INT(11) NOT NULL;

INSERT INTO menu_types (id, `name`, description) 
	VALUES (1, 'Menú del día', 'Menú con la oferta del día, precio fijo más extras.');
INSERT INTO section_types (id, `name`, description) 
	VALUES (1, 'Selección simple', 'Puede escojer un producto de la lista, manteniéndose fijo el precio final, independientemente del producto que escoja.');
INSERT INTO section_types (id, `name`, description) 
	VALUES (2, 'Selección múltiple', 'Puede escojer uno o varios productos (o ninguno). El precio final variará, según el precio de los productos escogidos.');
INSERT INTO section_types (id, `name`, description) 
	VALUES (3, 'Selección simple, precio variable', 'Puede escojer un producto de la lista, cambiando el precio final, según el producto que escoja.');

ALTER TABLE `users` ADD `password_code` VARCHAR( 50 ) NULL AFTER `phone`;
ALTER TABLE  `users` ADD  `active` TINYINT NOT NULL DEFAULT  '1' AFTER  `password_code`;
 