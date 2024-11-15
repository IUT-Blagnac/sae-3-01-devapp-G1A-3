-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                      Oracle Version 10g
--                        (13/11/2024 10:41:36)
-- -----------------------------------------------------------------------------
--      Nom de la base : SAEDevApp1A3
--      Projet : BDSAEDevApp
--      Auteur : IUT BLAGNAC
--      Date de dernière modification : 13/11/2024 10:40:08
-- -----------------------------------------------------------------------------


DROP TABLE IF EXISTS DISPONIBLECONDITIONNEMENT;

DROP TABLE IF EXISTS DISPONIBLECOULEUR;

DROP TABLE IF EXISTS DISPOFORMAT;

DROP TABLE IF EXISTS CONTIENT;

DROP TABLE IF EXISTS COMMENTAIRE;

DROP TABLE IF EXISTS COMMANDE;

DROP TABLE IF EXISTS IMAGE;

DROP TABLE IF EXISTS PRODUIT;

DROP TABLE IF EXISTS CATEGORIE;

DROP TABLE IF EXISTS METHODEPAIEMENT;

DROP TABLE IF EXISTS COMPTE;

DROP TABLE IF EXISTS ADRESSE;

DROP TABLE IF EXISTS OPTIONPAIEMENT;

DROP TABLE IF EXISTS PAYPAL;

DROP TABLE IF EXISTS CB;

DROP TABLE IF EXISTS CONDITIONNEMENT;

DROP TABLE IF EXISTS FORMATPROD;

DROP TABLE IF EXISTS COULEUR;

DROP TABLE IF EXISTS PERMISSION;

-- -----------------------------------------------------------------------------
--       TABLE : CB
-- -----------------------------------------------------------------------------

CREATE TABLE CB
   (
    NUMCARTE CHAR(16)  NOT NULL,
    DATEEXPIRATION DATE  NOT NULL,
    CCV CHAR(3)  NOT NULL,
	CONSTRAINT PK_CB PRIMARY KEY (NUMCARTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMENTAIRE
-- -----------------------------------------------------------------------------

CREATE TABLE COMMENTAIRE
   (
    IDCOMMENTAIRE CHAR(6)  NOT NULL,
    IDCOMPTE CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    CONTENU VARCHAR(2047)  NOT NULL,
	CONSTRAINT PK_COMMENTAIRE PRIMARY KEY (IDCOMMENTAIRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : IMAGE
-- -----------------------------------------------------------------------------

CREATE TABLE IMAGE
   (
    IDIMAGE CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    NOMFICHIER VARCHAR(64)  NOT NULL,
	CONSTRAINT PK_IMAGE PRIMARY KEY (IDIMAGE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PAYPAL
-- -----------------------------------------------------------------------------

CREATE TABLE PAYPAL
   (
    IDPAYPAL CHAR(6)  NOT NULL,
    MAIL VARCHAR(128)  NOT NULL,
	CONSTRAINT PK_PAYPAL PRIMARY KEY (IDPAYPAL)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMANDE
-- -----------------------------------------------------------------------------

CREATE TABLE COMMANDE
   (
    IDCOMMANDE CHAR(6)  NOT NULL,
    IDADRESSE CHAR(6)  NOT NULL,
    IDPAIEMENT CHAR(6)  NOT NULL,
    IDCOMPTE CHAR(6)  NOT NULL,
    STATUS VARCHAR(16)  NOT NULL,
    DATECOMMANDE DATE  NOT NULL,
	CONSTRAINT PK_COMMANDE PRIMARY KEY (IDCOMMANDE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : FORMAT
-- -----------------------------------------------------------------------------

CREATE TABLE FORMATPROD
   (
    IDFORMAT CHAR(32)  NOT NULL,
    NOMFORMAT VARCHAR(32)  NOT NULL,
	CONSTRAINT PK_FORMAT PRIMARY KEY (IDFORMAT)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : ADRESSE
-- -----------------------------------------------------------------------------

CREATE TABLE ADRESSE
   (
    IDADRESSE CHAR(6)  NOT NULL,
    NORUE INT(4)  NOT NULL,
    VILLE VARCHAR(128)  NOT NULL,
    CODEPOSTAL CHAR(5)  NOT NULL,
    PAYS VARCHAR(128)  NOT NULL,
	CONSTRAINT PK_ADRESSE PRIMARY KEY (IDADRESSE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COULEUR
-- -----------------------------------------------------------------------------

CREATE TABLE COULEUR
   (
    IDCOULEUR CHAR(6)  NOT NULL,
    NOMCOULEUR VARCHAR(32)  NOT NULL,
	CONSTRAINT PK_COULEUR PRIMARY KEY (IDCOULEUR)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PERMISSION
-- -----------------------------------------------------------------------------

CREATE TABLE PERMISSION
   (
    IDPERMISSION CHAR(6)  NOT NULL,
    NOMPERMISSION VARCHAR(64)  NOT NULL,
	CONSTRAINT PK_PERMISSION PRIMARY KEY (IDPERMISSION)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PRODUIT
-- -----------------------------------------------------------------------------

CREATE TABLE PRODUIT
   (
    IDPROD CHAR(6)  NOT NULL,
    IDCATEG CHAR(6)  NOT NULL,
    NOMPROD VARCHAR(64)  NOT NULL,
    COMPOSITION VARCHAR(2047)  NOT NULL,
    NOTESTECH VARCHAR(2047)  NULL,
    DESCRIPTION VARCHAR(2047)  NULL,
	CONSTRAINT PK_PRODUIT PRIMARY KEY (IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : METHODEPAIEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE METHODEPAIEMENT
   (
    IDPAIEMENT CHAR(6)  NOT NULL,
    IDCOMPTE CHAR(6)  NULL,
    IDOPTION CHAR(6)  NOT NULL,
    NUMCARTE CHAR(16)  NULL,
    IDPAYPAL CHAR(6)  NULL,
    STATUS VARCHAR(16)  NOT NULL,
	CONSTRAINT PK_METHODEPAIEMENT PRIMARY KEY (IDPAIEMENT)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : CATEGORIE
-- -----------------------------------------------------------------------------

CREATE TABLE CATEGORIE
   (
    IDCATEG CHAR(6)  NOT NULL,
    NOMCATEG VARCHAR(32)  NOT NULL,
	CONSTRAINT PK_CATEGORIE PRIMARY KEY (IDCATEG)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : CONDITIONNEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE CONDITIONNEMENT
   (
    IDCONDI CHAR(6)  NOT NULL,
    NOMCONDI VARCHAR(32)  NOT NULL,
	CONSTRAINT PK_CONDITIONNEMENT PRIMARY KEY (IDCONDI)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : OPTIONPAIEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE OPTIONPAIEMENT
   (
    IDOPTION CHAR(6)  NOT NULL,
    NOMOPTION VARCHAR(32)  NOT NULL,
	CONSTRAINT PK_OPTIONPAIEMENT PRIMARY KEY (IDOPTION)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMPTE
-- -----------------------------------------------------------------------------

CREATE TABLE COMPTE
   (
    IDCOMPTE CHAR(6)  NOT NULL,
    IDADRESSE CHAR(6)  NOT NULL,
    IDPERMISSION CHAR(6)  NOT NULL,
    NOM VARCHAR(32)  NOT NULL,
    PRENOM VARCHAR(32)  NOT NULL,
    MAIL VARCHAR(128)  NOT NULL,
	CONSTRAINT PK_COMPTE PRIMARY KEY (IDCOMPTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : DISPONIBLECOULEUR
-- -----------------------------------------------------------------------------

CREATE TABLE DISPONIBLECOULEUR
   (
    IDCOULEUR CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
	CONSTRAINT PK_DISPONIBLECOULEUR PRIMARY KEY (IDCOULEUR, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : DISPONIBLECONDITIONNEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE DISPONIBLECONDITIONNEMENT
   (
    IDCONDI CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
	CONSTRAINT PK_DISPONIBLECONDITIONNEMENT PRIMARY KEY (IDCONDI, IDPROD)  
   ) ;


-- -----------------------------------------------------------------------------
--       TABLE : CONTIENT
-- -----------------------------------------------------------------------------

CREATE TABLE CONTIENT
   (
    IDCOMMANDE CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    QTE INT(4)  NOT NULL,
	CONSTRAINT PK_CONTIENT PRIMARY KEY (IDCOMMANDE, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : DISPOFORMAT
-- -----------------------------------------------------------------------------

CREATE TABLE DISPOFORMAT
   (
    IDFORMAT CHAR(32)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    PRIX DECIMAL(5,2)  NOT NULL,
	CONSTRAINT PK_DISPOFORMAT PRIMARY KEY (IDFORMAT, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE COMMENTAIRE ADD (
     CONSTRAINT FK_COMMENTAIRE_COMPTE
          FOREIGN KEY (IDCOMPTE)
               REFERENCES COMPTE (IDCOMPTE))   ;

ALTER TABLE COMMENTAIRE ADD (
     CONSTRAINT FK_COMMENTAIRE_PRODUIT
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;

ALTER TABLE IMAGE ADD (
     CONSTRAINT FK_IMAGE_PRODUIT
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;

ALTER TABLE COMMANDE ADD (
     CONSTRAINT FK_COMMANDE_ADRESSE
          FOREIGN KEY (IDADRESSE)
               REFERENCES ADRESSE (IDADRESSE))   ;

ALTER TABLE COMMANDE ADD (
     CONSTRAINT FK_COMMANDE_METHODEPAIEMENT
          FOREIGN KEY (IDPAIEMENT)
               REFERENCES METHODEPAIEMENT (IDPAIEMENT))   ;

ALTER TABLE COMMANDE ADD (
     CONSTRAINT FK_COMMANDE_COMPTE
          FOREIGN KEY (IDCOMPTE)
               REFERENCES COMPTE (IDCOMPTE))   ;

ALTER TABLE PRODUIT ADD (
     CONSTRAINT FK_PRODUIT_CATEGORIE
          FOREIGN KEY (IDCATEG)
               REFERENCES CATEGORIE (IDCATEG))   ;

ALTER TABLE METHODEPAIEMENT ADD (
     CONSTRAINT FK_METHODEPAIEMENT_COMPTE
          FOREIGN KEY (IDCOMPTE)
               REFERENCES COMPTE (IDCOMPTE))   ;

ALTER TABLE METHODEPAIEMENT ADD (
     CONSTRAINT FK_METHODEPAIEMENT_OPTIONPAIEM
          FOREIGN KEY (IDOPTION)
               REFERENCES OPTIONPAIEMENT (IDOPTION))   ;

ALTER TABLE METHODEPAIEMENT ADD (
     CONSTRAINT FK_METHODEPAIEMENT_CB
          FOREIGN KEY (NUMCARTE)
               REFERENCES CB (NUMCARTE))   ;

ALTER TABLE METHODEPAIEMENT ADD (
     CONSTRAINT FK_METHODEPAIEMENT_PAYPAL
          FOREIGN KEY (IDPAYPAL)
               REFERENCES PAYPAL (IDPAYPAL))   ;

ALTER TABLE COMPTE ADD (
     CONSTRAINT FK_COMPTE_ADRESSE
          FOREIGN KEY (IDADRESSE)
               REFERENCES ADRESSE (IDADRESSE))   ;

ALTER TABLE COMPTE ADD (
     CONSTRAINT FK_COMPTE_PERMISSION
          FOREIGN KEY (IDPERMISSION)
               REFERENCES PERMISSION (IDPERMISSION))   ;

ALTER TABLE DISPONIBLECOULEUR ADD (
     CONSTRAINT FK_DISPONIBLECOULEUR_COULEUR
          FOREIGN KEY (IDCOULEUR)
               REFERENCES COULEUR (IDCOULEUR))   ;

ALTER TABLE DISPONIBLECOULEUR ADD (
     CONSTRAINT FK_DISPONIBLECOULEUR_PRODUIT
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;

ALTER TABLE DISPONIBLECONDITIONNEMENT ADD (
     CONSTRAINT FK_DISPONIBLECONDITIONNEMENT_C
          FOREIGN KEY (IDCONDI)
               REFERENCES CONDITIONNEMENT (IDCONDI))   ;

ALTER TABLE DISPONIBLECONDITIONNEMENT ADD (
     CONSTRAINT FK_DISPONIBLECONDITIONNEMENT_P
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;

ALTER TABLE CONTIENT ADD (
     CONSTRAINT FK_CONTIENT_COMMANDE
          FOREIGN KEY (IDCOMMANDE)
               REFERENCES COMMANDE (IDCOMMANDE))   ;

ALTER TABLE CONTIENT ADD (
     CONSTRAINT FK_CONTIENT_PRODUIT
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;

ALTER TABLE DISPOFORMAT ADD (
     CONSTRAINT FK_DISPOFORMAT_FORMAT
          FOREIGN KEY (IDFORMAT)
               REFERENCES FORMATPROD (IDFORMAT))   ;

ALTER TABLE DISPOFORMAT ADD (
     CONSTRAINT FK_DISPOFORMAT_PRODUIT
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------