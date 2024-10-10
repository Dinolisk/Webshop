<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/validateForms.php"); ?>
<?php
$id = $_GET['id'];

$sql = "DELETE FROM contact WHERE id=:id";
$query = $db->prepare($sql);
$query->execute(array(':id' => secureInput($id)));
 
header("Location:index.php");
?>
