DROP TABLE Utilisateur;
DROP TABLE Photo;
DROP TABLE Concours;
DROP TABLE Compteur;
DROP TABLE Soiree;
DROP TABLE Commentaire;


CREATE TABLE Utilisateur (
Identifiant VARCHAR (12) PRIMARY KEY,
Mdp VARCHAR (20) ,
Nom VARCHAR (20),
Prenom VARCHAR (20),
Promo INTEGER,
Surnom VARCHAR (20),
Quote VARCHAR (255));



CREATE TABLE Soiree (
IdSoiree INTEGER PRIMARY KEY,
Theme Varchar (20),
Annee DATE,
Description VARCHAR (300));


CREATE TABLE Concours (
IdConcours INTEGER PRIMARY KEY,
Nom VARCHAR (20),
Description VARCHAR(300),
Winner INTEGER,
EnCours BOOLEAN);

CREATE TABLE Photo (
IdPhoto INTEGER PRIMARY KEY,
IdSoiree INTEGER,
Date_MeL DATE,
Heure TIME,
ComPosteur VARCHAR (255),
NbLike INTEGER,
IdPosteur VARCHAR(12),

CONSTRAINT lien_soiree FOREIGN KEY (IdSoiree) REFERENCES Soiree(IdSoiree),
CONSTRAINT lien_posteur FOREIGN KEY (IdPosteur) REFERENCES Utilisateur(Identifiant)
);


CREATE TABLE Identification (
IdPhoto INTEGER,
IdUtilisateur VARCHAR(12),

CONSTRAINT lien_photo FOREIGN KEY (IdPhoto) REFERENCES Photo(IdPhoto),
CONSTRAINT lien_identifie FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur(Identifiant)
);








CREATE TABLE Commentaire (
IdCom INTEGER PRIMARY KEY,
IdPhoto INTEGER ,
IdAuteur VARCHAR (12),
Date_Post DATE,
contenu VARCHAR (255),

CONSTRAINT lien_photo FOREIGN KEY (IdPhoto) REFERENCES Photo(IdPhoto),
CONSTRAINT lien_auteur FOREIGN KEY (IdAuteur) REFERENCES Utilisateur(Identifiant)
);




CREATE TABLE Compteur (
IdPhoto INTEGER,
IdConcours INTEGER,
nbre_votes INTEGER,

CONSTRAINT lien_photo FOREIGN KEY (IdPhoto) REFERENCES Photo(IdPhoto),
CONSTRAINT lien_concours FOREIGN KEY (IdConcours) REFERENCES Concours(IdConcours)
);




CREATE TABLE Vote (
IdPhoto INTEGER,
IdUtilisateur VARCHAR(12),
IdConcours INTEGER,


CONSTRAINT lien_concours FOREIGN KEY (IdConcours) REFERENCES Concours(IdConcours),
CONSTRAINT lien_photo FOREIGN KEY (IdPhoto) REFERENCES Photo(IdPhoto),
CONSTRAINT lien_utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur(Identifiant)

);


CREATE SEQUENCE photo_id_seq;
ALTER TABLE photo ALTER idphoto SET DEFAULT NEXTVAL('photo_id_seq');

CREATE SEQUENCE soiree_id_seq;
ALTER TABLE soiree ALTER idsoiree SET DEFAULT NEXTVAL('soiree_id_seq');
