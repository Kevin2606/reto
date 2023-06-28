-- Active: 1687979892591@@localhost@3306@campuslands
CREATE DATABASE campuslands;
USE campuslands;

CREATE TABLE pais (
    id_pais INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombrePais VARCHAR(50) NOT NULL /*Lo muestra como entero en la imagen*/
);
CREATE TABLE departamento(
    idDep INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreDep VARCHAR(50) NOT NULL,
    id_pais INT NOT NULL
);
CREATE TABLE region(
    idReg INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreReg VARCHAR(50) NOT NULL,
    idDep INT NOT NULL
);
CREATE TABLE campers(
    idCamper INT NOT NULL AUTO_INCREMENT PRIMARY KEY, /* Lo muestra como string en la imagen */
    nombreCamper VARCHAR(50) NOT NULL,
    apellidoCamper VARCHAR(50) NOT NULL,
    fechaNac DATE NOT NULL,
    idReg INT NOT NULL
);

ALTER TABLE departamento ADD FOREIGN KEY (id_pais) REFERENCES pais(id_pais);
ALTER TABLE region ADD FOREIGN KEY (idDep) REFERENCES departamento(idDep);
ALTER TABLE campers ADD FOREIGN KEY (idReg) REFERENCES region(idReg);

INSERT INTO pais (nombrePais) VALUES ('Colombia');
INSERT INTO departamento (nombreDep, id_pais) VALUES ('Santander', 1);
INSERT INTO region (nombreReg, idDep) VALUES ('Bucaramanga', 1);
INSERT INTO campers (nombreCamper, apellidoCamper, fechaNac, idReg) VALUES ('Kevin', 'Gallardo', '2000-01-01', 1);
