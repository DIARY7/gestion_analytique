CREATE DATABASE gestion_analytique;
use gestion_analytique;

CREATE TABLE nature(
    idNature INT PRIMARY KEY ,
    nomination VARCHAR(20)
);
INSERT INTO nature VALUES
    (0,'AUCUNE'),
    (1,'Variable'),
    (2,'Fixe');

CREATE TABLE secteur(
    idSecteur INT PRIMARY KEY,
    nomination VARCHAR(100),
    estOperationnel INT /* 0 true ou 1 False */
);

CREATE TABLE rubrique(
    idRubrique INT  PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    total DECIMAL,
    uniteOeuvre VARCHAR(15),
    idNature INT,
    FOREIGN KEY (idNature) REFERENCES nature(idNature)
);

CREATE TABLE rubriqueSecteur(
    idRubrique INT,
    idSecteur INT,
    pourcentage DECIMAL,
    cout DECIMAL,
    FOREIGN KEY (idRubrique) REFERENCES rubrique(idRubrique),
    FOREIGN KEY (idSecteur) REFERENCES secteur(idSecteur)  
);
CREATE or REPLACE view Vrubrique as 
SELECT r.*,n.nomination as nomNature FROM rubrique r
JOIN nature n On 
n.idNature = r.idNature;

CREATE OR REPLACE view VrubriqueSecteur as 
SELECT r.*,s.*,rs.pourcentage,rs.cout from rubrique r
JOIN rubriqueSecteur rs on rs.idRubrique = r.idRubrique 
JOIN secteur s on s.idSecteur = rs.idSecteur;

INSERT INTO Rubrique(idRubrique,nom,total,uniteOeuvre,idNature) VALUES
                    (0,'Achat SEMENCES',4321600,'kg',1),
                    (1,'ACHAT ENGRAIS&ASSIMILES',60000000,'kg',1),
                    (2,'ACHAT EMBALLAGE',7796400,'kg',0),
                    (3,'FOURNIT BUR ',2783700,'Cons periodique',2);
                    
INSERT INTO secteur VALUES
            (1,'ADM/DIST',1),
            (2,'Usine',0),
            (3,'Plantation',0);
/*
CREATE OR REPLACE view VTest as 
SELECT r.*,s.*,rs.pourcentage,rs.cout from rubrique r
LEFT JOIN rubriqueSecteur rs on rs.idRubrique = r.idRubrique 
LEFT JOIN secteur s on s.idSecteur = rs.idSecteur;
*/

/*Data test*/

                           
                    
                    