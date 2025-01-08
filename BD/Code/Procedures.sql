DROP PROCEDURE get_commande_details;

DELIMITER $$

CREATE PROCEDURE get_commande_details(IN commande_id INT)
BEGIN
	SELECT P.IDPROD, NOMPROD, F.IDFORMAT, NOMFORMAT, QTE
	FROM PRODUIT P, CONTIENT C, FORMATPROD F
	WHERE P.IDPROD = C.IDPROD  AND F.IDFORMAT = C.IDFORMAT
	AND C.IDCOMMANDE = commande_id;
END$$

DELIMITER ;

DROP PROCEDURE get_details_produit;

DELIMITER $$

CREATE PROCEDURE get_details_produit(IN id_prod INT, IN id_format INT)
BEGIN
	SELECT P.*, PRIX, NOMFORMAT
	FROM PRODUIT P, DISPOFORMAT DF, FORMATPROD F
	WHERE P.IDPROD = id_prod AND DF.IDPROD = id_prod AND DF.IDFORMAT = id_format AND F.IDFORMAT = id_format;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit(IN produit_id INT)
BEGIN
	SELECT 
    DF.IDPROD, 
    F.NOMFORMAT, 
    DF.PRIX, 
    C2.NOMCOULEUR, 
    C.NOMCONDI
FROM 
    DISPOFORMAT DF
JOIN 
    FORMATPROD F ON F.IDFORMAT = DF.IDFORMAT
LEFT JOIN 
    DISPONIBLECONDITIONNEMENT DC ON DC.IDPROD = DF.IDPROD
LEFT JOIN 
    CONDITIONNEMENT C ON C.IDCONDI = DC.IDCONDI
LEFT JOIN 
    DISPONIBLECOULEUR DC2 ON DC2.IDPROD = DF.IDPROD
LEFT JOIN 
    COULEUR C2 ON C2.IDCOULEUR = DC2.IDCOULEUR
WHERE 
    DF.IDPROD = produit_id;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_light;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_light(IN produit_id INT)
BEGIN
	SELECT DF.IDPROD, NOMFORMAT, PRIX
	FROM DISPOFORMAT DF, FORMATPROD F
	WHERE F.IDFORMAT = DF.IDFORMAT AND DF.IDPROD = produit_id;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_light_asc;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_light_asc(IN produit_id INT)
BEGIN
	SELECT DF.IDPROD, NOMFORMAT, PRIX
	FROM DISPOFORMAT DF, FORMATPROD F
	WHERE F.IDFORMAT = DF.IDFORMAT AND DF.IDPROD = produit_id
	ORDER BY DF.IDPROD ASC, PRIX ASC;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_light_desc;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_light_desc(IN produit_id INT)
BEGIN
	SELECT DF.IDPROD, NOMFORMAT, PRIX
	FROM DISPOFORMAT DF, FORMATPROD F
	WHERE F.IDFORMAT = DF.IDFORMAT AND DF.IDPROD = produit_id
	ORDER BY DF.IDPROD ASC, PRIX DESC;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_borne;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_borne(IN borne_inf FLOAT(6,2), IN borne_sup FLOAT(6,2))
BEGIN
	SELECT DF.IDPROD, NOMFORMAT, PRIX
	FROM DISPOFORMAT DF, FORMATPROD F
	WHERE PRIX >= borne_inf AND PRIX <= borne_sup;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_borne_asc;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_borne_asc(IN borne_inf FLOAT(6,2), IN borne_sup FLOAT(6,2))
BEGIN
	SELECT DF.IDPROD, NOMFORMAT, PRIX
	FROM DISPOFORMAT DF, FORMATPROD F
	WHERE PRIX >= borne_inf AND PRIX <= borne_sup
	ORDER BY DF.IDPROD ASC, PRIX ASC;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_borne_desc;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_borne_desc(IN borne_inf FLOAT(6,2), IN borne_sup FLOAT(6,2))
BEGIN
	SELECT DF.IDPROD, NOMFORMAT, PRIX
	FROM DISPOFORMAT DF, FORMATPROD F
	WHERE PRIX >= borne_inf AND PRIX <= borne_sup
	ORDER BY DF.IDPROD ASC, PRIX DESC;
END$$

DELIMITER ;

DROP PROCEDURE get_dispos_produit_borne_min;

DELIMITER $$

CREATE PROCEDURE get_dispos_produit_borne_min(IN borne_inf FLOAT(6,2), IN borne_sup FLOAT(6,2))
BEGIN
	SELECT IDPROD, MIN(PRIX) as PRIX
	FROM DISPOFORMAT
	WHERE PRIX >= borne_inf AND PRIX <= borne_sup
	GROUP BY IDProd;
END$$

DELIMITER ;

DROP PROCEDURE get_client_cb;

DELIMITER $$

CREATE PROCEDURE get_client_cb(IN client_id INT)
BEGIN
	SELECT CB.*
	FROM CB, METHODEPAIEMENT M
	WHERE CB.NUMCARTE = M.NUMCARTE
	AND M.IDCOMPTE = client_id;
END$$

DELIMITER ;

DROP PROCEDURE get_client_paypal;

DELIMITER $$

CREATE PROCEDURE get_client_paypal(IN client_id INT)
BEGIN
	SELECT PAYPAL.*
	FROM PAYPAL, METHODEPAIEMENT M
	WHERE  PAYPAL.IDPAYPAL= M.IDPAYPAL
	AND M.IDCOMPTE = client_id;
END$$

DELIMITER ;

DROP PROCEDURE get_moyenne_prod;

DELIMITER $$

CREATE PROCEDURE get_moyenne_prod(IN produit_id INT)
BEGIN  
	SELECT AVG(SUM(NBETOILE)) AS noteAvg
	FROM COMMENTAIRE
	WHERE IDPROD = produit_id
	GROUP BY IDPROD;
END$$

DELIMITER ;

DROP PROCEDURE del_cb;

DELIMITER $$

CREATE PROCEDURE del_cb(IN id_cb CHAR(16))

BEGIN
	DELETE FROM METHODEPAIEMENT
	WHERE NUMCARTE = id_cb;
	DELETE FROM CB
	WHERE NUMCARTE = id_cb;
END$$

DELIMITER ;

DROP PROCEDURE del_paypal;

DELIMITER $$

CREATE PROCEDURE del_paypal(IN id_paypal INT)
BEGIN
	DELETE FROM METHODEPAIEMENT
	WHERE IDPAYPAL = id_paypal;
	DELETE FROM PAYPAL
	WHERE IDPAYPAL = id_paypal;
END$$

DELIMITER ;

DROP PROCEDURE get_panier;

DELIMITER $$

CREATE PROCEDURE get_panier(IN id_compte INT)
BEGIN
	SELECT IDCOMMANDE
	FROM COMMANDE
	WHERE IDCOMPTE = id_compte
	AND STATUSCOMMANDE = 'Panier';
END$$

DELIMITER ;	

DROP PROCEDURE get_wishlist;

DELIMITER $$

CREATE PROCEDURE get_wishlist(IN id_compte INT)
    BEGIN
        SELECT IDCOMMANDE
        FROM COMMANDE
        WHERE IDCOMPTE = id_compte
        AND STATUSCOMMANDE = 'Wishlist';
END$$

DELIMITER ;

-- Tests de la procédure get_commande_details
CALL get_commande_details(1);
CALL get_commande_details(2);

-- Tests de la procédure get_dispos_produit
CALL get_dispos_produit(10);
CALL get_dispos_produit(15);

-- Tests de la procédure get_dispos_produit_light
CALL get_dispos_produit_light(10);
CALL get_dispos_produit_light(15);

-- Tests de la procédure get_dispos_produit_borne
CALL get_dispos_produit_borne(10.00, 20.00);
CALL get_dispos_produit_borne(5.00, 15.00);

-- Tests de la procédure get_client_cb
CALL get_client_cb(1);
CALL get_client_cb(2);

-- Tests de la procédure get_client_paypal
CALL get_client_paypal(1);
CALL get_client_paypal(2);

-- Tests de la procédure del_cb
CALL del_cb('1010101010101010');
CALL del_cb('9999888877776666');

-- Tests de la procédure del_paypal
CALL del_paypal(1);
CALL del_paypal(2);

-- Tests de la procédure get_moyenne_prod
CALL get_moyenne_prod(10);
CALL get_moyenne_prod(15);

-- Tests de la procédure get_panier
CALL get_panier(1);
CALL get_panier(2);

DELIMITER ;

DROP PROCEDURE get_prix_commande;

DELIMITER $$

CREATE PROCEDURE get_prix_commande(IN id_commande INT) as Prix
BEGIN
	SELECT SUM(PRIX * QTE)
	FROM CONTIENT C, PRODUIT P, DISPOFORMAT D
	WHERE C.IDCOMMANDE = id_commande
	AND C.IDPROD = P.IDPROD
	AND C.IDFORMAT = D.IDFORMAT
	AND D.IDPROD = P.IDPROD;
END$$

DELIMITER ;	