CREATE TABLE `rol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `material` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`)
);

CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `productos` json NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `rol` VALUES (1,'ADMIN'),(2,'USER');
INSERT INTO `usuarios` VALUES (2,'admin','admin@admin.com','HolaHola01',1),(4,'Francisco','franc1sc0.sv.xd@gmail.com','HolaHola01',2),(5,'Francisco Josue','diego.tomas0917@gmail.com','HolaHola2023',2);
INSERT INTO `productos` VALUES (1,'Coyar de perlas','Coyar hermoso de perlas',245.00,'Perlas','498.jpg'),(4,'Collar regular','nose collar regular',123.00,'Plastico','929202-800-800.webp'),(5,'Collar de cuarzo','Collar verde de cuarzo',12.00,'cuarzo','0016825_collar-de-cuarzo_510.jpeg'),(6,'Coyar de Jade','Es jade bro',1234.00,'Jade','0_874ekdih.jpg');
INSERT INTO `pedidos` VALUES (2,'Francisco','nose cada ranfom','[{\"id\": 1, \"cantidad\": 1}, {\"id\": 5, \"cantidad\": 1}, {\"id\": 4, \"cantidad\": 4}]',4),(3,'Francisco','nose cada ranfom','[{\"id\": 1, \"cantidad\": 1}, {\"id\": 4, \"cantidad\": 1}, {\"id\": 5, \"cantidad\": 1}]',4);
