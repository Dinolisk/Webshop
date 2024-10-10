<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/validateForms.php"); ?>


<?php

if($_SERVER['REQUEST_METHOD'] == "POST"):
    $orderID = secureInput($_POST['deleteOrder']);
    if(!empty(validateOrder($orderID))) {
        echo validateOrder($orderID);
        include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php");  
    }
    $deleteOrder = $db->prepare("DELETE FROM orders WHERE id=:orderID");
    $deleteOrder->bindParam(":orderID", $orderID);
    $deleteOrder->execute();

endif;

header("Location: http://localhost:5000/admin");
exit();
?>


<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php"); ?>
