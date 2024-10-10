<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/validateForms.php"); ?>

<?php

if(isset($_GET["productID"])):
    $orderProduct = secureInput($_GET["productID"]);
    validateProduct($orderProduct);
    $getOrder = $db->prepare("SELECT * FROM products WHERE id=:productID;");
    $getOrder->bindParam(":productID", $orderProduct);
    $getOrder->execute();
    $order = $getOrder->fetchAll();
    foreach($order as $ord):
?>

    <h1>Beställ</h1>
    <div class="row">
        <div class="col s12 m4">
            <div class="card large">
                <div class="card-image">
                    <img class="" style="padding: 10px" src="<?= $ord['image']; ?> ">
                </div>
                <div class="card-content">
                    <h5><?= $ord['title']; ?></h5>
                    <p><?= $ord['about'] ?></p>
                    <p> <b>Pris: <?= $ord['price'] ?> kr</b></p>
                </div>
            </div>
        </div>
        <div class="col s12 m8">
            <div class="row">
                <form action="orderstatus.php" method="POST" class="col s12">
                    <input type="hidden" name="product" value="<?= $orderProduct; ?>">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="name" id="icon_prefix" type="text" class="validate" required>
                            <label for="icon_prefix">Full name</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input name="mobile" id="icon_telephone" type="tel" class="validate" required>
                            <label for="icon_telephone">Mobile number</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">contact_mail</i>
                            <input name="mail" id="icon_mail" type="email" class="validate" required>
                            <label for="icon_mail">Mail</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">business</i>
                            <input name="address" id="icon_prefix2" type="text" class="validate" required>
                            <label for="icon_prefix2">Leverans address</label>
                            <span class="helper-text">Stad Adress</span>
                        </div> 
                        <div class="input-field col s12 m6 right-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">
                                KÖP
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>


<?php 
    endforeach;
else:
    header("Location: http://localhost:5000/");
    exit;
endif; 
?>


<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php"); ?>