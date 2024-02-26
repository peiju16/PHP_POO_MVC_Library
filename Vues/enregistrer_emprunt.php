
<form method="post" action="index.php?page=emprunt&action=add">
    <label for="livre_id">Sélectionnez un livre:</label><br>
    <select id="livre_id" name="livre_id" required>
        <?php foreach ($livresDisponibles as $livre) {
            echo "<option value='" . $livre->id . "'>" . $livre->titre . "</option>";
        } ?>
    </select><br>
    <label for="date_retour_prevue">Date de retour prévue:</label><br>
    <input type="date" id="date_retour_prevue" name="date_retour" required><br><br>
    <input type="submit" value="Enregistrer Emprunt">
</form>

