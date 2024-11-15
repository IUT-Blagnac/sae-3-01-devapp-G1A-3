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

DROP TABLE CB CASCADE CONSTRAINTS;

DROP TABLE COMMENTAIRE CASCADE CONSTRAINTS;

DROP TABLE IMAGE CASCADE CONSTRAINTS;

DROP TABLE PAYPAL CASCADE CONSTRAINTS;

DROP TABLE COMMANDE CASCADE CONSTRAINTS;

DROP TABLE FORMATPROD CASCADE CONSTRAINTS;

DROP TABLE ADRESSE CASCADE CONSTRAINTS;

DROP TABLE COULEUR CASCADE CONSTRAINTS;

DROP TABLE PERMISSION CASCADE CONSTRAINTS;

DROP TABLE PRODUIT CASCADE CONSTRAINTS;

DROP TABLE METHODEPAIEMENT CASCADE CONSTRAINTS;

DROP TABLE CATEGORIE CASCADE CONSTRAINTS;

DROP TABLE CONDITIONNEMENT CASCADE CONSTRAINTS;

DROP TABLE OPTIONPAIEMENT CASCADE CONSTRAINTS;

DROP TABLE COMPTE CASCADE CONSTRAINTS;

DROP TABLE DISPONIBLECOULEUR CASCADE CONSTRAINTS;

DROP TABLE DISPONIBLECONDITIONNEMENT CASCADE CONSTRAINTS;

DROP TABLE CONTIENT CASCADE CONSTRAINTS;

DROP TABLE DISPOFORMAT CASCADE CONSTRAINTS;

-- -----------------------------------------------------------------------------
--       CREATION DE LA BASE 
-- -----------------------------------------------------------------------------

CREATE DATABASE SAEDevApp1A3;

-- -----------------------------------------------------------------------------
--       TABLE : CB
-- -----------------------------------------------------------------------------

CREATE TABLE CB
   (
    NUMCARTE CHAR(16)  NOT NULL,
    DATEEXPIRATION DATE  NOT NULL,
    CCV CHAR(3)  NOT NULL
,   CONSTRAINT PK_CB PRIMARY KEY (NUMCARTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMENTAIRE
-- -----------------------------------------------------------------------------

CREATE TABLE COMMENTAIRE
   (
    IDCOMMENTAIRE CHAR(6)  NOT NULL,
    IDCOMPTE CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    CONTENU VARCHAR2(2047)  NOT NULL
,   CONSTRAINT PK_COMMENTAIRE PRIMARY KEY (IDCOMMENTAIRE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMMENTAIRE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMMENTAIRE_COMPTE
     ON COMMENTAIRE (IDCOMPTE ASC)
    ;

CREATE  INDEX I_FK_COMMENTAIRE_PRODUIT
     ON COMMENTAIRE (IDPROD ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : IMAGE
-- -----------------------------------------------------------------------------

CREATE TABLE IMAGE
   (
    IDIMAGE CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    NOMFICHIER VARCHAR2(64)  NOT NULL
,   CONSTRAINT PK_IMAGE PRIMARY KEY (IDIMAGE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE IMAGE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_IMAGE_PRODUIT
     ON IMAGE (IDPROD ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : PAYPAL
-- -----------------------------------------------------------------------------

CREATE TABLE PAYPAL
   (
    IDPAYPAL CHAR(6)  NOT NULL,
    MAIL VARCHAR2(128)  NOT NULL
,   CONSTRAINT PK_PAYPAL PRIMARY KEY (IDPAYPAL)  
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
    STATUS VARCHAR2(16)  NOT NULL,
    DATECOMMANDE DATE  NOT NULL
,   CONSTRAINT PK_COMMANDE PRIMARY KEY (IDCOMMANDE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMMANDE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMMANDE_ADRESSE
     ON COMMANDE (IDADRESSE ASC)
    ;

CREATE  INDEX I_FK_COMMANDE_METHODEPAIEMENT
     ON COMMANDE (IDPAIEMENT ASC)
    ;

CREATE  INDEX I_FK_COMMANDE_COMPTE
     ON COMMANDE (IDCOMPTE ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : FORMAT
-- -----------------------------------------------------------------------------

CREATE TABLE FORMAT
   (
    IDFORMAT CHAR(32)  NOT NULL,
    NOMFORMAT VARCHAR2(32)  NOT NULL
,   CONSTRAINT PK_FORMAT PRIMARY KEY (IDFORMAT)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : ADRESSE
-- -----------------------------------------------------------------------------

CREATE TABLE ADRESSE
   (
    IDADRESSE CHAR(6)  NOT NULL,
    NORUE NUMBER(4)  NOT NULL,
    VILLE VARCHAR2(128)  NOT NULL,
    CODEPOSTAL CHAR(5)  NOT NULL,
    PAYS VARCHAR2(128)  NOT NULL
,   CONSTRAINT PK_ADRESSE PRIMARY KEY (IDADRESSE)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COULEUR
-- -----------------------------------------------------------------------------

CREATE TABLE COULEUR
   (
    IDCOULEUR CHAR(6)  NOT NULL,
    NOMCOULEUR VARCHAR2(32)  NOT NULL
,   CONSTRAINT PK_COULEUR PRIMARY KEY (IDCOULEUR)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PERMISSION
-- -----------------------------------------------------------------------------

CREATE TABLE PERMISSION
   (
    IDPERMISSION CHAR(6)  NOT NULL,
    NOMPERMISSION VARCHAR2(64)  NOT NULL
,   CONSTRAINT PK_PERMISSION PRIMARY KEY (IDPERMISSION)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : PRODUIT
-- -----------------------------------------------------------------------------

CREATE TABLE PRODUIT
   (
    IDPROD CHAR(6)  NOT NULL,
    IDCATEG CHAR(6)  NOT NULL,
    NOMPROD VARCHAR2(64)  NOT NULL,
    COMPOSITION VARCHAR2(2047)  NOT NULL,
    NOTESTECH VARCHAR2(2047)  NULL,
    DESCRIPTION VARCHAR2(2047)  NULL
,   CONSTRAINT PK_PRODUIT PRIMARY KEY (IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PRODUIT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PRODUIT_CATEGORIE
     ON PRODUIT (IDCATEG ASC)
    ;

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
    STATUS VARCHAR2(16)  NOT NULL
,   CONSTRAINT PK_METHODEPAIEMENT PRIMARY KEY (IDPAIEMENT)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE METHODEPAIEMENT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_METHODEPAIEMENT_COMPTE
     ON METHODEPAIEMENT (IDCOMPTE ASC)
    ;

CREATE  INDEX I_FK_METHODEPAIEMENT_OPTIONPAI
     ON METHODEPAIEMENT (IDOPTION ASC)
    ;

CREATE  INDEX I_FK_METHODEPAIEMENT_CB
     ON METHODEPAIEMENT (NUMCARTE ASC)
    ;

CREATE  INDEX I_FK_METHODEPAIEMENT_PAYPAL
     ON METHODEPAIEMENT (IDPAYPAL ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CATEGORIE
-- -----------------------------------------------------------------------------

CREATE TABLE CATEGORIE
   (
    IDCATEG CHAR(6)  NOT NULL,
    NOMCATEG VARCHAR2(32)  NOT NULL
,   CONSTRAINT PK_CATEGORIE PRIMARY KEY (IDCATEG)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : CONDITIONNEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE CONDITIONNEMENT
   (
    IDCONDI CHAR(6)  NOT NULL,
    NOMCONDI VARCHAR2(32)  NOT NULL
,   CONSTRAINT PK_CONDITIONNEMENT PRIMARY KEY (IDCONDI)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : OPTIONPAIEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE OPTIONPAIEMENT
   (
    IDOPTION CHAR(6)  NOT NULL,
    NOMOPTION VARCHAR2(32)  NOT NULL
,   CONSTRAINT PK_OPTIONPAIEMENT PRIMARY KEY (IDOPTION)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : COMPTE
-- -----------------------------------------------------------------------------

CREATE TABLE COMPTE
   (
    IDCOMPTE CHAR(6)  NOT NULL,
    IDADRESSE CHAR(6)  NOT NULL,
    IDPERMISSION CHAR(6)  NOT NULL,
    NOM VARCHAR2(32)  NOT NULL,
    PRENOM VARCHAR2(32)  NOT NULL,
    MAIL VARCHAR2(128)  NOT NULL
,   CONSTRAINT PK_COMPTE PRIMARY KEY (IDCOMPTE)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE COMPTE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_COMPTE_ADRESSE
     ON COMPTE (IDADRESSE ASC)
    ;

CREATE  INDEX I_FK_COMPTE_PERMISSION
     ON COMPTE (IDPERMISSION ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : DISPONIBLECOULEUR
-- -----------------------------------------------------------------------------

CREATE TABLE DISPONIBLECOULEUR
   (
    IDCOULEUR CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL
,   CONSTRAINT PK_DISPONIBLECOULEUR PRIMARY KEY (IDCOULEUR, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE DISPONIBLECOULEUR
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_DISPONIBLECOULEUR_COULEUR
     ON DISPONIBLECOULEUR (IDCOULEUR ASC)
    ;

CREATE  INDEX I_FK_DISPONIBLECOULEUR_PRODUIT
     ON DISPONIBLECOULEUR (IDPROD ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : DISPONIBLECONDITIONNEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE DISPONIBLECONDITIONNEMENT
   (
    IDCONDI CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL
,   CONSTRAINT PK_DISPONIBLECONDITIONNEMENT PRIMARY KEY (IDCONDI, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE DISPONIBLECONDITIONNEMENT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_DISPONIBLECONDITIONNEMENT
     ON DISPONIBLECONDITIONNEMENT (IDCONDI ASC)
    ;

CREATE  INDEX I_FK_DISPONIBLECONDITIONNEMEN1
     ON DISPONIBLECONDITIONNEMENT (IDPROD ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CONTIENT
-- -----------------------------------------------------------------------------

CREATE TABLE CONTIENT
   (
    IDCOMMANDE CHAR(6)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    QTE NUMBER(4)  NOT NULL
,   CONSTRAINT PK_CONTIENT PRIMARY KEY (IDCOMMANDE, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CONTIENT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CONTIENT_COMMANDE
     ON CONTIENT (IDCOMMANDE ASC)
    ;

CREATE  INDEX I_FK_CONTIENT_PRODUIT
     ON CONTIENT (IDPROD ASC)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : DISPOFORMAT
-- -----------------------------------------------------------------------------

CREATE TABLE DISPOFORMAT
   (
    IDFORMAT CHAR(32)  NOT NULL,
    IDPROD CHAR(6)  NOT NULL,
    PRIX NUMBER(5,2)  NOT NULL
,   CONSTRAINT PK_DISPOFORMAT PRIMARY KEY (IDFORMAT, IDPROD)  
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE DISPOFORMAT
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_DISPOFORMAT_FORMAT
     ON DISPOFORMAT (IDFORMAT ASC)
    ;

CREATE  INDEX I_FK_DISPOFORMAT_PRODUIT
     ON DISPOFORMAT (IDPROD ASC)
    ;


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
               REFERENCES FORMAT (IDFORMAT))   ;

ALTER TABLE DISPOFORMAT ADD (
     CONSTRAINT FK_DISPOFORMAT_PRODUIT
          FOREIGN KEY (IDPROD)
               REFERENCES PRODUIT (IDPROD))   ;


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------