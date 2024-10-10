<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?> 
<?php include($_SERVER["DOCUMENT_ROOT"] . "/validateForms.php"); ?>

<?php


if($_SERVER['REQUEST_METHOD'] == "POST"):
    $stmt = $db->prepare("UPDATE orders SET name=:name, mobile=:mobile, mail=:mail, address=:address, status=:status WHERE id = :id;");

    $orderID = secureInput($_POST['orderID']);
    $updateName = secureInput($_POST['updateName']);
    $updateMail = secureInput($_POST['updateMail']);
    $updateAddress = secureInput($_POST['updateAddress']);
    $updateMobile = secureInput($_POST['updateMobile']);

    $stmt->bindParam(":id", $orderID);
    $stmt->bindParam(":name", $updateName);
    $stmt->bindParam(":mail", $updateMail);
    $stmt->bindParam(":address", $updateAddress);
    $stmt->bindParam(":mobile", $updateMobile);

    $status;
    if(isset($_POST['updateStatus']) == 1):
        $status = 1;
        $stmt->bindParam(":status", $status);
    elseif(empty($updateStatus)):
        $status = 0;
        $stmt->bindParam(":status", $status);
    endif;

    validateProduct($orderID);
    validateName($updateName);
    validateMail($updateMail);
    validateAddress($updateAddress);
    validateMobile($updateMobile);

    $stmt->execute();
    

    header("Location: http://localhost:5000/admin/");
    die();
else:
    header("Location: http://localhost:5000/admin/");
    die();
endif;

?>

