CREATE TABLE fabricants(
    id INT AUTO_INCREMENT PRIMARY KEY ,
    nom VARCHAR(225) NOT NULL ,
    adresse VARCHAR(100),
    site_web VARCHAR(225)
);

CREATE TABLE médicaments (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    nom VARCHAR(255) NOT NULL ,
    description TEXT ,
    dosage VARCHAR(100),
    form VARCHAR(100),
    indication TEXT 
);

CREATE TABLE fabricant_médicament (
    fabricant_id INTEGER,
    médicament_id INTEGER,
    PRIMARY KEY (fabricant_id, médicament_id),
    FOREIGN KEY (fabricant_id) REFERENCES fabricants(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (médicament_id) REFERENCES médicaments(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    médicament_id INT , 
    quantite INT NOT NULL,
    date_expiration DATE ,
    FOREIGN KEY (médicament_id) REFERENCES médicaments(id)
);

CREATE TABLE roles(
    id INT AUTO_INCREMENT PRIMARY KEY ,
    nom VARCHAR(50) NOT NULL 
);

CREATE table utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    nom VARCHAR(225) NOT NULL , 
    email VARCHAR(255) NOT NULL UNIQUE ,
    mode_de_passe VARCHAR(255) NOT NULL ,
    id_role INT ,
    code VARCHAR(4),
    FOREIGN KEY (id_role) REFERENCES roles(id)
);

INSERT INTO roles (nom) VALUES('admin');
INSERT INTO roles (nom) VALUES('utilisateur');