use gestion_analytique;
CREATE TABLE profil(
    id INTEGER PRIMARY KEY,
    titre VARCHAR(75),
    mdp VARCHAR(75)
);
CREATE TABLE fournisseur(
    id INTEGER PRIMARY KEY,
    nom VARCHAR(75)
);
CREATE TABLE charge(
    id INTEGER PRIMARY KEY,
    nom VARCHAR(255) 
);
CREATE TABLE fournisseur_prix(
    id_fournisseur INTEGER,
    id_charge INTEGER,
    prix_unitaire DECIMAL(16,2),
    UNIQUE(id_fournisseur,id_charge),
    FOREIGN KEY(id_fournisseur) REFERENCES fournisseur(id),
    FOREIGN KEY(id_charge) REFERENCES charge(id)
);
CREATE TABLE gestion_stock(
    id_charge INTEGER,
    quantite DECIMAL(16,2),
    prix_unitaire DECIMAL(16,2),
    total DECIMAL (16,2),
    date DATE,
    isEntree TINYINT(1), /* 0 (oui) ou 1 (faux) */
    FOREIGN KEY(id_charge) REFERENCES charge(id)
);
CREATE OR REPLACE VIEW v_demande_charge AS
SELECT 
    d.id AS demande_id,
    d.id_profil,
    d.id_charge,
    d.quantite,
    d.daty,
    c.nom AS charge_nom
FROM 
    demande d
JOIN 
    charge c ON d.id_charge = c.id;

/* A revoir */
CREATE TABLE demande(
    id INTEGER AUTO_INCREMENT,
    id_profil INTEGER,
    id_charge INTEGER,
    quatite INTEGER,
    daty DATE,
    FOREIGN KEY id_charge REFERENCES charge(id)
); 
CREATE TABLE demande_confirmer(
    id_demande int,
    daty DATE,
    reste NUMBER
);
CREATE OR REPLACE VIEW v_demande_confirmer as 
SELECT d.*,dc.daty,dc.reste from demande d 
JOIN demande_confirmer dc on d.id = dc.id_commande;


CREATE TABLE caisse( /* Atao updtate foana */
    montant DECIMAL
);

-- CREATE TABLE confirmation(

-- );

/* vue de liaison */
CREATE OR REPLACE view v_fournisseur_prix as 
SELECT fp.*,f.nom as nom_fournisseur,c.nom as nom_charge from fournisseur_prix fp 
JOIN fournisseur f on fp.id_fournisseur = f.id 
JOIN charge c on fp.id_charge = c.id;

CREATE OR REPLACE view v_gestion_stock as 
SELECT gs.*, c.nom as nom_charge FROM gestion_stock gs 
JOIN charge c on gs.id_charge = c.id; 


/* Data */
INSERT INTO profil (id,titre,mdp) VALUES
        (0,'Direction','root'),
        (1,'Chef departement Achat','root'),
        (2,'chef departement Finance','root'),
        (3,'Chef departement confection','root');
INSERT INTO fournisseur(id,nom) VALUES
        (0,'Fournisseur1'),
        (1,'Fournisseur2');
INSERT INTO charge(id,nom) VALUES
        (0,'Ciseau'),
        (1,'Emballage'),
        -- Mila tohizana ito
        (2,'Tissus joging');
        
INSERT INTO gestion_stock(id_charge,quantite,prix_unitaire,total,date,isEntree) VALUES
                (0,2,5000,10000,'2016-02-01',0),
                -- Possible tohizana
                (1,3,1000,3000,'2017-04-15',0);
                
/**/
