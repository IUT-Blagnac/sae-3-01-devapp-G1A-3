<?php
require_once('connect.inc.php');

if (isset($_GET['query'])) {
    $search = htmlentities($_GET['query']);

    $sql = "SELECT * FROM PRODUIT WHERE NOMPROD LIKE :search OR DESCRIPTION LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	
    if ($results) {
        echo "<h1>Résultats pour : " . htmlspecialchars($search) . "</h1>";
        foreach ($results as $row) {
            echo "<h2>" . htmlspecialchars($row['NOMPROD']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['DESCRIPTION']) . "</p>";
        }
    } else {
        echo "<p>Aucun résultat trouvé pour : " . htmlspecialchars($search) . "</p>";
    }
}
?>