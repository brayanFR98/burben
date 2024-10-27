CREATE DATABASE `burben`; /*!40100 COLLATE 'utf8mb3_unicode_ci' */


CREATE TABLE usuarios(
oid VARCHAR(36) PRIMARY KEY,
name VARCHAR(100) NOT NULL,
telephone VARCHAR(14) UNIQUE,
email VARCHAR(100) UNIQUE,
rfc VARCHAR(13) UNIQUE,
password VARCHAR(32),
notes VARCHAR(500)
);

INSERT INTO `usuarios` (`oid`, `name`, `telephone`, `email`, `rfc`, `password`, `notes`) VALUES (UUID(), 'Emmma Stone', '(999)-999-9999', 'stone@gmail.com', 'EMMJ254665DF4', MD5(12345), 'atiende como es debido');
INSERT INTO `usuarios` (`oid`, `name`, `telephone`, `email`, `rfc`, `password`, `notes`) VALUES (UUID(), 'Pepe torres', '(555)-555-5555', 'pepe@gmail.com', 'PEPE901154JH2', MD5(12345), null);


