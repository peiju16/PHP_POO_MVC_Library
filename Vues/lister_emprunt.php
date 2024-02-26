<?php

if (isset($msg)) echo "<h2>$msg</h2>"; 

echo "<h2>Liste des Emprunts</h2>";
echo "<ul>";
foreach ($emprunts as $emprunt) {
    echo "<li> Livre Titre: " . htmlspecialchars($emprunt->titre) . " - Date Emprunt: " . htmlspecialchars($emprunt->date_emprunt) . " - Date Retour: " . htmlspecialchars($emprunt->date_retour) . "</li>";
}
echo "</ul>";



?>

<a href="?page=emprunt&action=add">Ajouter un emprunt</a>