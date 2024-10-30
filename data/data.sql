CREATE DATABASE gestion_analytique_test;
use gestion_analytique_test;

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

create or replace view vuecoutparsecteuretnature as SELECT 
    s.nomination AS secteur,
    n.nomination AS nature,
    SUM(rs.cout) AS total_cout
FROM 
    rubriqueSecteur rs
JOIN 
    secteur s ON rs.idSecteur = s.idSecteur
JOIN 
    rubrique r ON rs.idRubrique = r.idRubrique
JOIN 
    nature n ON r.idNature = n.idNature
GROUP BY 
    s.nomination, n.nomination
ORDER BY 
    s.nomination, n.nomination;

 
/*
CREATE OR REPLACE view VTest as 
SELECT r.*,s.*,rs.pourcentage,rs.cout from rubrique r
LEFT JOIN rubriqueSecteur rs on rs.idRubrique = r.idRubrique 
LEFT JOIN secteur s on s.idSecteur = rs.idSecteur;
*/

/*Data test*/
                    
INSERT INTO secteur VALUES
            (1,'ADM/DIST',1),
            (2,'Usine',0),
            (3,'importation',0);

INSERT INTO rubrique (idRubrique, nom, total, uniteOeuvre, idNature) VALUES
(1, 'Achat machines à coudre industrielles', 2000000, 'Cons periodique', 2),
(2, 'Achat surjeteuses', 1500000, 'Cons periodique', 2),
(3, 'Achat Ciseaux', 10000, 'piece', 2),
(4, 'Achat Coupe-fils industriels', 20000, 'Cons periodique', 2),
(5, 'Achat tables de coupe', 100000, 'Cons periodique', 2),
(6, 'Achat de cutter circulaire', 30000, 'Piece', 2),
(7, 'Achat emballage', 200000, 'Metre', 2),
(8, 'Achat de fer à repasser industriel', 150000, 'Cons periodique', 2),
(9, 'Achat des tissus', 60000000, 'Metre', 1),
(10, 'Achat des fils', 10000000, 'tube', 1),
(11, 'Achat d etiqueteuses', 100000, 'Piece', 2),
(12, 'Achat étagères de stockage', 400000, 'Cons periodique', 2),
(13, 'Eau et electricite', 24000000, 'KW', 1),
(14, 'Impots et taxes', 2000000, 'Cons periodique', 2),
(15, 'Salaire des personnels', 24000000, 'Nombre de T-shirt', 1),
(16, 'Frais de transport', 1000000, 'Cons periodique', 1),
(17, 'Entretient des outils', 500000, 'Cons periodique', 1),
(18, 'Loyer', 12000000, 'mois', 2),
(19, 'Fourniture de bureau', 1000000, 'Cons periodique', 2),
(20, 'Salaire temporaire( ex: mpibata entana)', 1000000, 'Cons periodique', 1),
(21, 'Achat aiguille', 40000, 'Boite', 1),
(22, 'Achat craies tailleur', 10000, 'Pieces', 1);

INSERT INTO rubriqueSecteur (idRubrique, idSecteur, pourcentage, cout) VALUES
-- Achat machines à coudre industrielles
(1, 1, 0, 0),
(1, 2, 100, 2000000),
(1, 3, 0, 0),

-- Achat surjeteuses
(2, 1, 0, 0),
(2, 2, 100, 1500000),
(2, 3, 0, 0),

-- Achat Ciseaux
(3, 1, 0, 0),
(3, 2, 100, 10000),
(3, 3, 0, 0),

-- Achat Coupe-fils industriels
(4, 1, 0, 0),
(4, 2, 100, 20000),
(4, 3, 0, 0),

-- Achat tables de coupe
(5, 1, 0, 0),
(5, 2, 100, 100000),
(5, 3, 0, 0),

-- Achat de cutter circulaire
(6, 1, 0, 0),
(6, 2, 100, 30000),
(6, 3, 0, 0),

-- Achat emballage
(7, 1, 0, 0),
(7, 2, 80, 160000),
(7, 3, 20, 40000),

-- Achat de fer à repasser industriel
(8, 1, 0, 0),
(8, 2, 100, 150000),
(8, 3, 0, 0),

-- Achat des tissus
(9, 1, 0, 0),
(9, 2, 80, 48000000),
(9, 3, 20, 12000000),

-- Achat des fils
(10, 1, 0, 0),
(10, 2, 80, 8000000),
(10, 3, 20, 2000000),

-- Achat d'Étiqueteuses
(11, 1, 0, 0),
(11, 2, 80, 80000),
(11, 3, 20, 20000),

-- Achat étagères de stockage
(12, 1, 0, 0),
(12, 2, 100, 400000),
(12, 3, 0, 0),

-- Eau et electricite
(13, 3, 0, 0),
(13, 1, 20, 4800000),
(13, 2, 80, 19200000),

-- Impots et taxes
(14, 1, 30, 600000),
(14, 2, 30, 600000),
(14, 3, 40, 800000),

-- Salaire des personnels
(15, 1, 20, 4800000),
(15, 2, 70, 16800000),
(15, 3, 10,2400000 ),

-- Frais de transport
(16, 1, 10, 100000),
(16, 2, 20, 200000),
(16, 3, 70, 700000),

-- Entretient des outils
(17, 1, 10, 50000),
(17, 2, 90, 450000),
(17, 3, 0,0),

-- Loyer
(18, 1, 30, 3600000),
(18, 2, 70, 8400000),
(18, 3, 0,0),

-- Fourniture de bureau
(19, 1,90, 900000),
(19, 2,10, 100000 ),
(19, 3,0,0 ),

-- Salaire temporaire
(20, 1, 0, 0),
(20, 2, 30, 300000),
(20, 3, 70, 700000),

-- Achat aiguille
(21, 1, 0, 0),
(21, 2, 50, 20000),
(21, 3, 50, 20000),

-- Achat craies tailleur
(22, 1, 0, 0),
(22, 2, 50, 5000),
(22, 3, 50, 5000);



                           
                    
                    