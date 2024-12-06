-- ----------------------------------------------------------------------------
-- Inserts pour les tables dans un ordre évitant les erreurs de contraintes
-- ----------------------------------------------------------------------------

-- Table PERMISSION
INSERT INTO PERMISSION (NOMPERMISSION) VALUES
('Admin'),
('Utilisateur');

-- Table ADRESSE
INSERT INTO ADRESSE (NORUE, VILLE, CODEPOSTAL, PAYS) VALUES
(12, 'Toulouse', '31000', 'France'),
(45, 'Paris', '75000', 'France');

-- Table COMPTE
INSERT INTO COMPTE (IDADRESSE, IDPERMISSION, NOM, PRENOM, MAIL, MDP) VALUES
(1, 2, 'John', 'Doe', 'john.doe@example.com', 'password123'),
(2, 1, 'Jane', 'Smith', 'jane.smith@example.com', 'securePass!');

-- Table CATEGORIE
INSERT INTO CATEGORIE (NOMCATEG) VALUES
('Confiseries'),
('Chocolats');

-- Table PRODUIT
INSERT INTO PRODUIT (IDCATEG, NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION) VALUES
(1, 'Bonbon Rouge', 'Sucre, Colorant rouge', 'Note technique 1', 'Délicieux bonbon rouge'),
(2, 'Bonbon Bleu', 'Sucre, Colorant bleu', 'Note technique 2', 'Délicieux bonbon bleu');

-- Table CB
INSERT INTO CB (NUMCARTE, DATEEXPIRATION, CCV) VALUES
('1234567812345678', '2025-12-31', '123'),
('8765432187654321', '2026-06-30', '456');

-- Table PAYPAL
INSERT INTO PAYPAL (MAIL) VALUES
('user1@gmail.com'),
('user2@gmail.com');

-- Table OPTIONPAIEMENT
INSERT INTO OPTIONPAIEMENT (NOMOPTION) VALUES
('Carte Bancaire'),
('PayPal');

-- Table METHODEPAIEMENT
INSERT INTO METHODEPAIEMENT (IDCOMPTE, IDOPTION, NUMCARTE, IDPAYPAL, STATUS) VALUES
(1, 1, '1234567812345678', NULL, 'Valide'),
(2, 2, NULL, 1, 'Valide');

-- Table FORMATPROD
INSERT INTO FORMATPROD (NOMFORMAT) VALUES
('Petit'),
('Grand');

-- Table COULEUR
INSERT INTO COULEUR (NOMCOULEUR) VALUES
('Rouge'),
('Bleu');

-- Table CONDITIONNEMENT
INSERT INTO CONDITIONNEMENT (NOMCONDI) VALUES
('Sachet'),
('Boîte');

-- Table COMMANDE
INSERT INTO COMMANDE (IDADRESSE, IDPAIEMENT, IDCOMPTE, STATUS, DATECOMMANDE, DATELIVR) VALUES
(1, 1, 1, 'Livré', '2024-11-01', '2024-11-05'),
(2, 2, 2, 'En cours', '2024-11-02', NULL);

-- Table COMMENTAIRE
INSERT INTO COMMENTAIRE (IDCOMPTE, IDPROD, NBETOILE, CONTENU) VALUES
(1, 1, 5, 'Produit incroyable ! Très satisfait.'),
(2, 2, 3, 'Bon produit, mais quelques défauts.');

-- Table IMAGE
INSERT INTO IMAGE (IDPROD, NOMFICHIER) VALUES
(1, 'image1.jpg'),
(2, 'image2.jpg');

-- Table DISPONIBLECOULEUR
INSERT INTO DISPONIBLECOULEUR (IDCOULEUR, IDPROD) VALUES
(1, 1),
(2, 2);

-- Table DISPONIBLECONDITIONNEMENT
INSERT INTO DISPONIBLECONDITIONNEMENT (IDCONDI, IDPROD) VALUES
(1, 1),
(2, 2);

-- Table CONTIENT
INSERT INTO CONTIENT (IDCOMMANDE, IDPROD, QTE) VALUES
(1, 1, 2),
(2, 2, 1);

-- Table DISPOFORMAT
INSERT INTO DISPOFORMAT (IDFORMAT, IDPROD, PRIX) VALUES
(1, 1, 3.50),
(2, 2, 5.00);
