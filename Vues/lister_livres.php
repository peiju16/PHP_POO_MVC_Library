<?php

if (isset($msg)) echo "<h2>$msg</h2>"; 

echo "<h2>Liste des Livres</h2>";
echo "<ul>";
foreach ($livres as $livre) {
    echo "<a href='?page=livre&action=modify&id=$livre->id'>" . htmlspecialchars($livre->titre) . " par " . htmlspecialchars($livre->auteur) . " (" . htmlspecialchars($livre->annee_publication) . ") - " . ($livre->disponible ? 'Disponible' : 'Emprunté') . " -<a href='?page=livre&action=delete&id=$livre->id'>Supprimer</a></a><br>";
}
echo "</ul>";


?>

<a href="?page=livre&action=add">Ajouter un livre</a>