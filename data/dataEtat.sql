CREATE TABLE proforma (
    id_proforma INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    id_fournisseur INT NOT NULL,
    id_demande INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    FOREIGN KEY (id_fournisseur) REFERENCES fournisseur(id_fournisseur),
    FOREIGN KEY (id_demande) REFERENCES demande_confirmer(id_demande)
);

CREATE TABLE proforma_details (
    id_proforma INT NOT NULL,
    id_charge INT NOT NULL,
    quantite INT NOT NULL,
    id_fournisseur_prix INT NOT NULL,
    FOREIGN KEY (id_proforma) REFERENCES proforma(id_proforma),
    FOREIGN KEY (id_charge) REFERENCES charge(id_charge),
    FOREIGN KEY (id_fournisseur_prix) REFERENCES fournisseur_prix(id_fournisseur)
);

CREATE TABLE bon_commande (
    id_bon_commande INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    id_proforma INT NOT NULL,
    is_valide_finance TINYINT(1) DEFAULT 1,
    is_valide_direction TINYINT(1) DEFAULT 1,
    FOREIGN KEY (id_proforma) REFERENCES proforma(id_proforma)
);

CREATE TABLE bon_commande_details (
    id_bon_commande INT NOT NULL,
    id_charge INT NOT NULL,
    quantite INT NOT NULL,
    id_fournisseur_prix INT NOT NULL,
    FOREIGN KEY (id_bon_commande) REFERENCES bon_commande(id_bon_commande),
    FOREIGN KEY (id_charge) REFERENCES charge(id_charge),
    FOREIGN KEY (id_fournisseur_prix) REFERENCES fournisseur_prix(id_fournisseur)
);

CREATE TABLE bon_livraison (
    id_bon_livraison INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    id_bon_commande INT NOT NULL,
    FOREIGN KEY (id_bon_commande) REFERENCES bon_commande(id_bon_commande)
);

CREATE TABLE bon_livraison_details (
    id_bon_livraison INT NOT NULL,
    id_charge INT NOT NULL,
    quantite INT NOT NULL,
    id_fournisseur_prix INT NOT NULL,
    FOREIGN KEY (id_bon_livraison) REFERENCES bon_livraison(id_bon_livraison),
    FOREIGN KEY (id_charge) REFERENCES charge(id_charge),
    FOREIGN KEY (id_fournisseur_prix) REFERENCES fournisseur_prix(id_fournisseur)
);

CREATE TABLE bon_reception (
    id_bon_reception INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    id_bon_livraison INT NOT NULL,
    FOREIGN KEY (id_bon_livraison) REFERENCES bon_livraison(id_bon_livraison)
);

CREATE TABLE bon_reception_details (
    id_bon_reception INT NOT NULL,
    id_charge INT NOT NULL,
    quantite INT NOT NULL,
    id_fournisseur_prix INT NOT NULL,
    FOREIGN KEY (id_bon_reception) REFERENCES bon_reception(id_bon_reception),
    FOREIGN KEY (id_charge) REFERENCES charge(id_charge),
    FOREIGN KEY (id_fournisseur_prix) REFERENCES fournisseur_prix(id_fournisseur)
);

CREATE TABLE facture (
    id_facture INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    id_bon_livraison INT NOT NULL,
    FOREIGN KEY (id_bon_livraison) REFERENCES bon_livraison(id_bon_livraison)
);

CREATE TABLE facture_details (
    id_facture INT NOT NULL,
    id_charge INT NOT NULL,
    quantite INT NOT NULL,
    id_fournisseur_prix INT NOT NULL,
    FOREIGN KEY (id_facture) REFERENCES facture(id_facture),
    FOREIGN KEY (id_charge) REFERENCES charge(id_charge),
    FOREIGN KEY (id_fournisseur_prix) REFERENCES fournisseur_prix(id_fournisseur)
);

CREATE TABLE caisse (
    montant DECIMAL(10, 2) NOT NULL
);

-- A revoir
CREATE TABLE historique_caisse (
    id_historique_caisse INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    is_entree TINYINT(1) DEFAULT 1,
    id_facture INT,
    FOREIGN KEY (id_facture) REFERENCES facture(id_facture) ON DELETE SET NULL
);

CREATE TABLE bon_commande_client (
    id_boncommande_client INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(250),
    produit VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    quantite INT,
    total DECIMAL(10, 2) NOT NULL,
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1
);

CREATE TABLE bon_livraison_client (
    id_bon_livraison_client INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    produit VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    quantite INT,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    id_boncommande_client INT NOT NULL,
    FOREIGN KEY (id_boncommande_client) REFERENCES bon_commande_client(id_boncommande_client)
);

CREATE TABLE bon_reception_client (
    id_bon_reception_client INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    produit VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    quantite INT,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    id_bon_livraison_client INT NOT NULL,
    FOREIGN KEY (id_bon_livraison_client) REFERENCES bon_livraison_client(id_bon_livraison_client)
);

CREATE TABLE facture_client (
    id_facture_client INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150),
    date DATE NOT NULL,
    emetteur VARCHAR(255) NOT NULL,
    recepteur VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    is_valide TINYINT(1) DEFAULT 1,
    id_bon_livraison_client INT NOT NULL,
    FOREIGN KEY (id_bon_livraison_client) REFERENCES bon_livraison_client(id_bon_livraison_client)
);

CREATE TABLE bonsortie (
    id_bonsortie INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT NOT NULL,
    qtt INT NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
);
