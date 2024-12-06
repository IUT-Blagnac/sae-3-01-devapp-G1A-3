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
(45, 'Paris', '75000', 'France'),
(1, 'Marseille', '13000', 'France'),
(22, 'Lyon', '69000', 'France'),
(38, 'Nice', '06000', 'France'),
(14, 'Bordeaux', '33000', 'France'),
(56, 'Lille', '59000', 'France'),
(67, 'Strasbourg', '67000', 'France'),
(29, 'Nantes', '44000', 'France'),
(84, 'Montpellier', '34000', 'France'),
(99, 'Rennes', '35000', 'France'),
(10, 'Brest', '29200', 'France');

-- Table COMPTE
INSERT INTO COMPTE (IDADRESSE, IDPERMISSION, NOM, PRENOM, MAIL, MDP) VALUES
(1, 2, 'John', 'Doe', 'john.doe@example.com', 'password123'),
(2, 1, 'Jane', 'Smith', 'jane.smith@example.com', 'securePass!'),
(1, 1, 'David', 'Tran', 'david.tran@example.com', 'adminPass1'),
(2, 1, 'Pierre', 'Cornu', 'pierre.cornu@example.com', 'adminPass2'),
(3, 1, 'Raphael', 'Lamothe', 'raphael.lamothe@example.com', 'adminPass3'),
(4, 1, 'Naria', 'Savary', 'naria.savary@example.com', 'adminPass4'),
(5, 2, 'John', 'Doe', 'john.doe@example.com', 'password123'),
(6, 2, 'Jane', 'Smith', 'jane.smith@example.com', 'securePass!'),
(7, 2, 'Alice', 'Brown', 'alice.brown@example.com', 'alicePass2024'),
(8, 2, 'Michael', 'Johnson', 'michael.johnson@example.com', 'michael123'),
(9, 2, 'Sophia', 'Williams', 'sophia.williams@example.com', 'sophiaPass987'),
(10, 2, 'James', 'Jones', 'james.jones@example.com', 'james789Pass');

-- Table CATEGORIE
INSERT INTO CATEGORIE (NOMCATEG) VALUES
('GELIFIES'),
('ARTISANAUX'),
('K''ROKANTE'),
('VEGANDY'),
('CHOUPIPOP'),
('CHOCOBOOM'),
('PRALOUP'),
('FONDOO'),
('CHOCOCRAQ');

-- Table PRODUIT
INSERT INTO PRODUIT (IDCATEG, NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION) VALUES
(1, 'Bonbon Rouge', 'Sucre, Colorant rouge', 'Note technique 1', 'Délicieux bonbon rouge'),
(2, 'Bonbon Bleu', 'Sucre, Colorant bleu', 'Note technique 2', 'Délicieux bonbon bleu'),
(1, 'Bonbon Cerise', 'Sucre, Colorant rouge, Arôme cerise', 'Note technique 3', 'Délicieux bonbon au goût de cerise'),
(1, 'Bonbon Pêche', 'Sucre, Colorant orange, Arôme pêche', 'Note technique 4', 'Bonbon fruité à la saveur de pêche'),
(2, 'Bonbon Miel', 'Sucre, Miel, Arôme naturel', 'Note technique 5', 'Bonbon au goût doux et sucré de miel'),
(2, 'Bonbon Noisette', 'Sucre, Noisette grillée', 'Note technique 6', 'Bonbon aux saveurs délicates de noisette grillée'),
(3, 'Bonbon Crousti-Pop', 'Sucre, Riz soufflé, Arôme caramel', 'Note technique 7', 'Bonbon croquant avec du riz soufflé au caramel'),
(3, 'Bonbon Croque-Cacao', 'Sucre, Pépites de cacao', 'Note technique 8', 'Bonbon croquant avec des morceaux de cacao intense'),
(4, 'Bonbon Veggie', 'Sucre, Carottes, Arôme naturel', 'Note technique 9', 'Bonbon à la carotte avec une touche sucrée et saine'),
(4, 'Bonbon Pomme Verte', 'Sucre, Colorant vert, Arôme pomme', 'Note technique 10', 'Bonbon frais au goût de pomme verte'),
(5, 'Bonbon Popcorn', 'Sucre, Popcorn, Arôme caramel', 'Note technique 11', 'Bonbon au goût popcorn sucré avec un arôme de caramel'),
(5, 'Bonbon Cola', 'Sucre, Arôme cola', 'Note technique 12', 'Bonbon au goût rafraîchissant de cola'),
(6, 'Bonbon Épicé', 'Sucre, Cannelle, Gingembre', 'Note technique 13', 'Bonbon épicé avec une combinaison de cannelle et gingembre'),
(6, 'Bonbon Curry', 'Sucre, Curry, Arôme naturel', 'Note technique 14', 'Bonbon au goût spécial et épicé de curry'),
(7, 'Bonbon Praliné', 'Sucre, Praliné, Chocolat', 'Note technique 15', 'Bonbon crémeux au praliné avec une enrobée de chocolat'),
(7, 'Bonbon Chocolat', 'Sucre, Cacao, Lait', 'Note technique 16', 'Bonbon au chocolat riche et crémeux'),
(8, 'Bonbon Fondant', 'Sucre, Sirop de glucose', 'Note technique 17', 'Bonbon fondant avec une texture douce et sucrée'),
(8, 'Bonbon Fondue', 'Sucre, Chocolat fondu', 'Note technique 18', 'Bonbon à la texture fondante avec du chocolat fondu'),
(9, 'Bonbon Craquant', 'Sucre, Amandes grillées', 'Note technique 19', 'Bonbon croquant avec des morceaux d’amandes grillées'),
(9, 'Bonbon Fudge', 'Sucre, Beurre, Lait', 'Note technique 20', 'Bonbon au goût crémeux et sucré de fudge'),
(1, 'Bonbon Fraise', 'Sucre, Colorant rouge, Arôme fraise', 'Note technique 23', 'Bonbon sucré au délicieux goût de fraise'),
(1, 'Bonbon Framboise', 'Sucre, Colorant rose, Arôme framboise', 'Note technique 24', 'Bonbon fruité avec une saveur douce de framboise'),
(2, 'Bonbon Vanille', 'Sucre, Vanille naturelle', 'Note technique 25', 'Bonbon au goût crémeux de vanille pure'),
(2, 'Bonbon Praliné Caramel', 'Sucre, Caramel, Praliné', 'Note technique 26', 'Bonbon savoureux avec une touche de praliné et caramel'),
(3, 'Bonbon Caramel Croquant', 'Sucre, Caramel, Amandes', 'Note technique 27', 'Bonbon croquant avec du caramel et des amandes grillées'),
(3, 'Bonbon Pop Corn', 'Sucre, Riz soufflé, Beurre', 'Note technique 28', 'Bonbon à la texture légère de popcorn avec un goût sucré'),
(4, 'Bonbon Mangue', 'Sucre, Mangue, Arôme tropical', 'Note technique 29', 'Bonbon fruité avec une saveur exotique de mangue'),
(4, 'Bonbon Citron Vert', 'Sucre, Arôme citron vert', 'Note technique 30', 'Bonbon au goût rafraîchissant de citron vert'),
(5, 'Bonbon Sucette', 'Sucre, Arôme fruits rouges', 'Note technique 31', 'Sucette au goût de fruits rouges sucrés'),
(5, 'Bonbon Cola Fizz', 'Sucre, Arôme cola, Acide citrique', 'Note technique 32', 'Bonbon au goût cola avec une touche acidulée'),
(6, 'Bonbon Gingembre Citron', 'Sucre, Gingembre, Citron', 'Note technique 33', 'Bonbon épicé et frais avec du gingembre et du citron'),
(6, 'Bonbon Chili Mangue', 'Sucre, Piment, Mangue', 'Note technique 34', 'Bonbon avec un mélange piquant de chili et mangue'),
(7, 'Bonbon Chocolat Noir', 'Sucre, Cacao pur', 'Note technique 35', 'Bonbon au chocolat noir intense et riche'),
(7, 'Bonbon Chocolat Praliné', 'Sucre, Chocolat, Praliné', 'Note technique 36', 'Bonbon au chocolat avec une garniture crémeuse de praliné'),
(8, 'Bonbon Crème Brûlée', 'Sucre, Crème, Vanille', 'Note technique 37', 'Bonbon au goût de crème brûlée avec une texture fondante'),
(8, 'Bonbon Tiramisu', 'Sucre, Café, Mascarpone', 'Note technique 38', 'Bonbon au goût de tiramisu, crémeux et raffiné'),
(9, 'Bonbon Amandes Salées', 'Sucre, Amandes, Sel', 'Note technique 39', 'Bonbon sucré-salé avec des amandes grillées et un peu de sel'),
(9, 'Bonbon Nougat', 'Sucre, Amandes, Miel', 'Note technique 40', 'Bonbon au nougat doux avec des amandes croquantes'),
(1, 'Bonbon Cerise Noire', 'Sucre, Arôme cerise noire', 'Note technique 43', 'Bonbon au délicieux goût de cerise noire'),
(2, 'Bonbon Orange Sanguine', 'Sucre, Arôme orange sanguine', 'Note technique 44', 'Bonbon fruité avec un goût d’orange sanguine'),
(1, 'Bonbon Ananas', 'Sucre, Arôme ananas', 'Note technique 45', 'Bonbon sucré au goût frais d\'ananas'),
(1, 'Bonbon Melon', 'Sucre, Arôme melon', 'Note technique 46', 'Bonbon avec un goût sucré et rafraîchissant de melon'),
(2, 'Bonbon Pistache', 'Sucre, Pistache, Arôme naturel', 'Note technique 47', 'Bonbon avec une saveur douce et légèrement salée de pistache'),
(2, 'Bonbon Banane', 'Sucre, Arôme banane', 'Note technique 48', 'Bonbon au goût exotique de banane mûre'),
(3, 'Bonbon Chocolat Caramel', 'Sucre, Cacao, Caramel', 'Note technique 49', 'Bonbon au chocolat avec une touche de caramel sucré'),
(3, 'Bonbon Chocolat au Lait Praliné', 'Sucre, Chocolat au lait, Praliné', 'Note technique 50', 'Bonbon crémeux au chocolat au lait et à la garniture de praliné'),
(4, 'Bonbon Ananas-Coco', 'Sucre, Ananas, Coco', 'Note technique 51', 'Bonbon avec une saveur tropicale d\'ananas et de noix de coco'),
(4, 'Bonbon Kiwi', 'Sucre, Arôme kiwi', 'Note technique 52', 'Bonbon fruité avec une saveur acidulée de kiwi'),
(5, 'Bonbon Framboise-Litchi', 'Sucre, Framboise, Litchi', 'Note technique 53', 'Bonbon au goût sucré et exotique de framboise et litchi'),
(5, 'Bonbon Orange Menthe', 'Sucre, Arôme orange, Menthe', 'Note technique 54', 'Bonbon frais avec un mélange d\'orange et de menthe'),
(6, 'Bonbon Pomme Cannelle', 'Sucre, Pomme, Cannelle', 'Note technique 55', 'Bonbon doux et épicé avec des arômes de pomme et de cannelle'),
(6, 'Bonbon Poivre-Rose', 'Sucre, Poivre rose, Arôme fruité', 'Note technique 56', 'Bonbon épicé avec une pointe de poivre rose et de fruits'),
(7, 'Bonbon Chocolat Amandes', 'Sucre, Chocolat, Amandes', 'Note technique 57', 'Bonbon au chocolat intense avec des morceaux croquants d\'amandes'),
(7, 'Bonbon Praliné Coco', 'Sucre, Praliné, Noix de coco', 'Note technique 58', 'Bonbon au praliné doux et à la noix de coco râpée'),
(8, 'Bonbon Caramel Vanille', 'Sucre, Caramel, Vanille', 'Note technique 59', 'Bonbon au goût riche de caramel et de vanille'),
(8, 'Bonbon Chocolat Blanc Vanille', 'Sucre, Chocolat blanc, Vanille', 'Note technique 60', 'Bonbon au chocolat blanc crémeux et à la vanille douce'),
(9, 'Bonbon Fruits Secs', 'Sucre, Raisins secs, Amandes', 'Note technique 61', 'Bonbon croquant avec des fruits secs et des raisins'),
(9, 'Bonbon Cacao Noisettes', 'Sucre, Cacao, Noisettes', 'Note technique 62', 'Bonbon avec une saveur riche de cacao et de noisettes grillées'),
(1, 'Bonbon Abricot', 'Sucre, Arôme abricot', 'Note technique 65', 'Bonbon sucré au goût d\'abricot bien mûr'),
(1, 'Bonbon Framboise Menthe', 'Sucre, Arôme framboise, Menthe', 'Note technique 66', 'Bonbon rafraîchissant avec un mélange de framboise et menthe'),
(2, 'Bonbon Caramel Beurre Salé', 'Sucre, Beurre salé, Caramel', 'Note technique 67', 'Bonbon doux et salé au caramel beurre salé'),
(2, 'Bonbon Café Noisette', 'Sucre, Café, Noisette', 'Note technique 68', 'Bonbon énergisant avec un mélange de café et de noisettes grillées'),
(3, 'Bonbon Choco-Coco', 'Sucre, Chocolat, Noix de coco râpée', 'Note technique 69', 'Bonbon au chocolat avec une garniture de noix de coco râpée'),
(3, 'Bonbon Choco-Menthe', 'Sucre, Chocolat, Menthe', 'Note technique 70', 'Bonbon au chocolat avec une touche rafraîchissante de menthe'),
(4, 'Bonbon Citron Basilic', 'Sucre, Arôme citron, Basilic', 'Note technique 71', 'Bonbon au goût sucré-acidulé de citron et une pointe de basilic frais'),
(4, 'Bonbon Fraise-Banane', 'Sucre, Arôme fraise, Arôme banane', 'Note technique 72', 'Bonbon sucré avec un mélange de fraise et banane'),
(5, 'Bonbon Orange Miel', 'Sucre, Arôme orange, Miel', 'Note technique 73', 'Bonbon doux et fruité avec un mélange d\'orange et de miel'),
(5, 'Bonbon Citron-Pamplemousse', 'Sucre, Arôme citron, Arôme pamplemousse', 'Note technique 74', 'Bonbon fruité avec une saveur rafraîchissante de citron et pamplemousse'),
(6, 'Bonbon Gingembre Orange', 'Sucre, Gingembre, Arôme orange', 'Note technique 75', 'Bonbon épicé et rafraîchissant avec du gingembre et de l\'orange'),
(6, 'Bonbon Citron Piment', 'Sucre, Citron, Piment', 'Note technique 76', 'Bonbon épicé et citronné pour les amateurs de saveurs fortes'),
(7, 'Bonbon Chocolat Fraise', 'Sucre, Chocolat, Arôme fraise', 'Note technique 77', 'Bonbon au chocolat avec une touche fruitée de fraise'),
(7, 'Bonbon Chocolat Caramel Noisettes', 'Sucre, Chocolat, Caramel, Noisettes', 'Note technique 78', 'Bonbon au chocolat avec une touche de caramel et des noisettes croquantes'),
(8, 'Bonbon Praliné Café', 'Sucre, Praliné, Café', 'Note technique 79', 'Bonbon doux au praliné avec une touche de café intense'),
(8, 'Bonbon Crème de Marron', 'Sucre, Crème de marron', 'Note technique 80', 'Bonbon crémeux à la saveur douce et sucrée de marron'),
(9, 'Bonbon Pépites de Chocolat', 'Sucre, Chocolat, Pépites de chocolat', 'Note technique 81', 'Bonbon croquant avec des morceaux de chocolat fondant'),
(9, 'Bonbon Amande Chocolat', 'Sucre, Amandes, Chocolat', 'Note technique 82', 'Bonbon avec des amandes croquantes et une couverture de chocolat fondant');

-- Table CB
INSERT INTO CB (NUMCARTE, DATEEXPIRATION, CCV) VALUES
('1234567812345678', '2025-12-31', '123'),
('8765432187654321', '2026-06-30', '456');

-- Table PAYPAL
INSERT INTO PAYPAL (MAIL) VALUES
('john.doe@example.com'),
('jane.smith@example.com');

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
