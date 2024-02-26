<form method="post" action="index.php?page=livre&action=<?= $_GET["action"]; ?>">

    <?php if(isset($_GET["action"]) && $_GET["action"] == "modify") {?>
        <input type="hidden" name="id" value="<?= $livre->id ?>">
    <?php } ?>

    <label for="titre">Titre:</label><br>
    <input value="<?= isset($livre) ? $livre->titre : "" ?>" type="text" id="titre" name="titre" required><br>

    <label for="auteur">Auteur:</label><br>
    <input value="<?= isset($livre) ? $livre->auteur : "" ?>" type="text" id="auteur" name="auteur" required><br>

    <label for="annee_publication">Année de Publication:</label><br>
    <input value="<?= isset($livre) ? $livre->annee_publication : "" ?>" type="number" id="annee_publication" name="annee_publication" required><br><br>

    <?php
        if(isset($_GET["action"]) && $_GET["action"] == "modify") {?>
            <label for=""> Disponibilité
                <input type="checkbox" <?= (isset($livre) && $livre->disponible == "1") ? "checked" : "" ?> name="disponible" id="disponible">
            </label>
            <br>
            <input type="submit" value="Modifier Livre">

        <?php } else { ?>
                <input type="submit" value="Ajouter Livre">
        <?php } ?>
</form>