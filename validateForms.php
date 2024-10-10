
<?php

function secureInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateName($data) {
    if(strlen($data) >= 55 || !preg_match("/^[a-zA-Z ]*$/", $data) || empty($data)):
        echo "<p class='red center-align white-text' style='padding: 10px; margin-top: 10px'>Ej ett giltigt namn</p>";
        include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php");
        die();
    endif;
}
function validateMail($data) {
    if (strlen($data) >= 55 || !filter_var($data, FILTER_VALIDATE_EMAIL) || empty($data)) {
        echo "<p class='red center-align white-text' style='padding: 10px; margin-top: 10px'>Ej en giltig mailadress </p>";
        include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php");
        die();
    }
}
function validateAddress($data) {
    if(strlen($data) >=100) {
        echo "<p class='red center-align white-text' style='padding: 10px; margin-top: 10px'>Ej en giltig adress</p>";
        include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php");
        die();
    }
}
function validateMobile($data) {
    if(strlen($data) > 10 || strlen($data) < 8 || preg_match("/^[a-zA-Z ]*$/", $data)) {
        echo "<p class='red center-align white-text' style='padding: 10px; margin-top: 10px'>Ej giltigt mobilnummer</p>";
        include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php");
        die();
    }
}
function validateProduct($data) {
    include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); 
    $sel = $db->prepare("SELECT COUNT(*) from products");
    $sel->execute();
    $countRow = $sel->fetchColumn(); 

    if($data > $countRow + 1 || $data < 2) {
        echo "<p class='red center-align white-text' style='padding: 10px; margin-top: 10px'>Ej giltigt produkt</p>";
    }
}
function validateOrder($data) {
    include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); 
    $sel = $db->prepare("SELECT * FROM orders WHERE id=:id");
    $sel->bindParam(":id", $data);
    $sel->execute();
    $countRow = $sel->fetchColumn(); 

    if($data != $countRow) {
        return "<p class='red center-align white-text' style='padding: 10px; margin-top: 10px'>Ej giltigt order</p>";
    }
}


?>
