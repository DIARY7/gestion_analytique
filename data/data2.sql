use gestion_analytique;
CREATE TABLE profil(
    id_profil INTEGER PRIMARY KEY,
    titre VARCHAR(75),
    mdp VARCHAR(75)
);
CREATE TABLE fournisseur(
    id_fournisseur INTEGER PRIMARY KEY,
    nom VARCHAR(75)
);
CREATE TABLE charge(
    id_charge INTEGER PRIMARY KEY,
    nom VARCHAR(255) 
);
CREATE TABLE fournisseur_prix(
    id_fournisseur INTEGER,
    id_charge INTEGER,
    prix_unitaire DECIMAL(16,2),
    UNIQUE(id_fournisseur,id_charge),
    FOREIGN KEY(id_fournisseur) REFERENCES fournisseur(id_fournisseur),
    FOREIGN KEY(id_charge) REFERENCES charge(id_charge)
);
CREATE TABLE gestion_stock(
    id_charge INTEGER,
    quantite DECIMAL(16,2),
    prix_unitaire DECIMAL(16,2),
    total DECIMAL (16,2),
    date DATE,
    isEntree TINYINT(1), /* 0 (oui) ou 1 (faux) */
    FOREIGN KEY(id_charge) REFERENCES charge(id_charge)
);

/* A revoir */
CREATE TABLE demande (
    id_demande INTEGER AUTO_INCREMENT,
    id_profil INTEGER,
    id_charge INTEGER,
    quantite INTEGER,
    daty DATE,
    PRIMARY KEY (id_demande),
    FOREIGN KEY (id_charge) REFERENCES charge(id_charge)
);

CREATE OR REPLACE VIEW v_demande_charge AS
SELECT 
    d.id_demande AS demande_id,
    d.id_profil,
    d.id_charge,
    d.quantite,
    d.daty,
    c.nom AS charge_nom
FROM 
    demande d
JOIN 
    charge c ON d.id_charge = c.id_charge;

CREATE TABLE demande_confirmer(
    id_demande int,
    daty DATE,
    quantite INTEGER,
	foreign key (id_demande) references demande(id_demande)
);

CREATE OR REPLACE VIEW v_demande_confirmer AS
SELECT d.id_demande, d.id_profil, d.id_charge, d.quantite AS demande_quantite, 
       dc.daty AS date_confirmation, dc.quantite AS quantite_confirmee
FROM demande d
JOIN demande_confirmer dc ON d.id_demande = dc.id_demande;

CREATE TABLE caisse( /* Atao updtate foana */
    montant DECIMAL
);

/* vue de liaison */
CREATE OR REPLACE view v_fournisseur_prix as 
SELECT fp.*,f.nom as nom_fournisseur,c.nom as nom_charge from fournisseur_prix fp 
JOIN fournisseur f on fp.id_fournisseur = f.id_fournisseur
JOIN charge c on fp.id_charge = c.id_charge;

CREATE OR REPLACE view v_gestion_stock as 
SELECT gs.*, c.nom as nom_charge FROM gestion_stock gs 
JOIN charge c on gs.id_charge = c.id_charge; 


/* Data */
INSERT INTO profil (id_profil,titre,mdp) VALUES
        (0,'Direction','root'),
        (1,'Chef departement Achat','root'),
        (2,'chef departement Finance','root'),
        (3,'Chef departement confection','root'),
        (4,'Chef departement Vente','root'),
        (5,'Super U','root'),
        (6,'client','root');
INSERT INTO fournisseur(id_fournisseur,nom) VALUES
        (0,'Fournisseur1'),
        (1,'Fournisseur2');
INSERT INTO charge(id_charge,nom) VALUES
        (0,'Ciseau'),
        (1,'Emballage'),
        -- Mila tohizana ito
        (2,'Tissus jogging');
        
INSERT INTO gestion_stock(id_charge,quantite,prix_unitaire,total,date,isEntree) VALUES
                (0,2,5000,10000,'2016-02-01',0),
                -- Possible tohizana
                (1,3,1000,3000,'2017-04-15',0);
                
/**/
