ALTER TABLE `sections` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `menus` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `section_types` MODIFY `id` INT(11) NOT NULL;
ALTER TABLE `menu_types` MODIFY `id` INT(11) NOT NULL;
ALTER TABLE `customers` MODIFY `address` VARCHAR(255);
ALTER TABLE `groups` MODIFY `address` VARCHAR(255);
ALTER TABLE `users` MODIFY `email` VARCHAR(255);
ALTER TABLE `providers` MODIFY `email` VARCHAR(255);
ALTER TABLE `virtualmenu`.`products` ADD COLUMN `id_provider` INT NOT NULL  AFTER `base_price`;
ALTER TABLE `virtualmenu`.`products` 
  ADD CONSTRAINT `products_id_provider`
  FOREIGN KEY (`id_provider` )
  REFERENCES `virtualmenu`.`providers` (`id` )
  ON DELETE CASCADE
  ON UPDATE CASCADE
, ADD INDEX `products_id_provider` (`id_provider` ASC) ;

INSERT INTO menu_types (id, `name`, description) 
VALUES (1, 'Men� del d�a', 'Men� con la oferta del d�a, precio fijo m�s extras.');
INSERT INTO section_types (id, `name`, description) 
VALUES (1, 'Selecci�n simple', 'Puede escojer un producto de la lista, manteni�ndose fijo el precio final, independientemente del producto que escoja.');
INSERT INTO section_types (id, `name`, description) 
VALUES (2, 'Selecci�n m�ltiple', 'Puede escojer uno o varios productos (o ninguno). El precio final variar�, seg�n el precio de los productos escogidos.');
INSERT INTO section_types (id, `name`, description) 
VALUES (3, 'Selecci�n simple, precio variable', 'Puede escojer un producto de la lista, cambiando el precio final, seg�n el producto que escoja.');


/*Leo*/

ALTER TABLE `menu_types` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT 
ALTER TABLE `users` CHANGE `email` `email` VARCHAR( 255 ) NOT NULL  
ALTER TABLE `providers` ADD `name_uri` VARCHAR( 50 ) NOT NULL AFTER `web` 