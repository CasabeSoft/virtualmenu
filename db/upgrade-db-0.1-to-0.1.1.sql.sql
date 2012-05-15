ALTER TABLE `sections` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `menus` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `section_types` MODIFY `id` INT(11) NOT NULL;
ALTER TABLE `menu_types` MODIFY `id` INT(11) NOT NULL;
ALTER TABLE `customers` MODIFY `address` VARCHAR(255);
ALTER TABLE `groups` MODIFY `address` VARCHAR(255);
ALTER TABLE `users` MODIFY `email` VARCHAR(255) NOT NULL;
ALTER TABLE `providers` MODIFY `email` VARCHAR(255);
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
