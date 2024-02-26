CREATE DATABASE libraryphp;

USE libraryphp;

CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    annee_publication YEAR,
    disponible BOOLEAN DEFAULT TRUE
);

CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livre_id INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY(livre_id) REFERENCES livres(id)
);