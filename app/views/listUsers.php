<?php
$title = "Usagers";
ob_start();
?>

<p>Liste des utilisateurs</p>

<?php
$content = ob_get_clean();
require("layout.php");