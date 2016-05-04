DROP TABLE utilisateur CASCADE;
DROP TABLE photo CASCADE;
DROP TABLE concours CASCADE;
DROP TABLE compteur CASCADE;
DROP TABLE soiree CASCADE;
DROP TABLE commentaire CASCADE;
DROP TABLE identification CASCADE;
DROP TABLE vote CASCADE;


CREATE TABLE utilisateur (
identifiant VARCHAR (12) PRIMARY KEY,
mdp VARCHAR (100) ,
nom VARCHAR (20),
prenom VARCHAR (20),
promo INTEGER,
surnom VARCHAR (20),
quote VARCHAR (255),
avatar VARCHAR (3));



CREATE TABLE soiree (
idsoiree SERIAL PRIMARY KEY,
theme VARCHAR (20),
description VARCHAR (300),
annee INTEGER,
d DATE);


CREATE TABLE concours (
idconcours SERIAL PRIMARY KEY,
nom VARCHAR (20),
description VARCHAR(300),
winner INTEGER,
encours BOOLEAN);

CREATE TABLE photo (
idphoto SERIAL PRIMARY KEY,
idsoiree INTEGER,
date_mel DATE,
heure TIME,
composteur VARCHAR (255),
nblike INTEGER,
idposteur VARCHAR(12),
extension VARCHAR(3),
heure_mel TIME,

CONSTRAINT lien_soiree FOREIGN KEY (idsoiree) REFERENCES soiree(idsoiree),
CONSTRAINT lien_posteur FOREIGN KEY (idposteur) REFERENCES utilisateur(identifiant)
);


CREATE TABLE identification (
idphoto INTEGER,
idutilisateur VARCHAR(12),

CONSTRAINT lien_photo FOREIGN KEY (idphoto) REFERENCES photo(idphoto),
CONSTRAINT lien_identifie FOREIGN KEY (idutilisateur) REFERENCES utilisateur(identifiant)
);



CREATE TABLE commentaire (
idcom SERIAL PRIMARY KEY,
idphoto INTEGER ,
idauteur VARCHAR (12),
date_post DATE,
heure_post TIME,
contenu VARCHAR (255),

CONSTRAINT lien_photo FOREIGN KEY (idphoto) REFERENCES photo(idphoto),
CONSTRAINT lien_auteur FOREIGN KEY (idauteur) REFERENCES utilisateur(identifiant)
);


CREATE TABLE compteur (
idphoto INTEGER,
idconcours INTEGER,
nbre_votes INTEGER,

CONSTRAINT lien_photo FOREIGN KEY (idphoto) REFERENCES photo(idphoto),
CONSTRAINT lien_concours FOREIGN KEY (idconcours) REFERENCES concours(idconcours)
);




CREATE TABLE vote (
idphoto INTEGER,
idutilisateur VARCHAR(12),
idconcours INTEGER,


CONSTRAINT lien_concours FOREIGN KEY (idconcours) REFERENCES concours(idconcours),
CONSTRAINT lien_photo FOREIGN KEY (idphoto) REFERENCES photo(idphoto),
CONSTRAINT lien_utilisateur FOREIGN KEY (idutilisateur) REFERENCES utilisateur(identifiant)

);


INSERT INTO utilisateur(identifiant, mdp, nom, prenom, promo, surnom, quote, avatar) VALUES ('administrat', 'rootroot', 'norris', 'chuck', '2000', '', '', '');


