<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/validateForms.php"); ?>


<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"): 
        $query = $db->prepare("INSERT INTO orders (product, name, mobile, mail, address, status) 
                            VALUES (:product, :name, :mobile, :mail, :address, :status);");
                            
        $id = secureInput($_POST['product']);
        $name = secureInput($_POST['name']);
        $mail = secureInput($_POST['mail']);
        $address = secureInput($_POST['address']);
        $mobile = secureInput($_POST['mobile']);
        $status = 0;

        $query->bindParam(":product", $id);
        $query->bindParam(":name", $name);
        $query->bindParam(":mobile", $mobile);
        $query->bindParam(":mail", $mail);
        $query->bindParam(":address", $address);
        $query->bindParam(":status", $status);

        validateProduct($id);
        validateName($name);
        validateMail($mail);
        validateAddress($address);
        validateMobile($mobile);

        $query->execute();
    
?>
    <h1>Tack för din beställning!</h1>
    <a href="/">Gå tillbaka till affären</a>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php"); ?>

<?php 
    else: 
        header("Location: http://localhost:5000/order/");
        exit;

    endif;
?>

