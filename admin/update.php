<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/validateForms.php"); ?>

    <h1>Uppdatera ordern</h1>
    <br> 
<?php
if(isset($_GET['orderID'])):
    $orderID = secureInput($_GET['orderID']);
    validateOrder($orderID);
    $updateOrder = $db->prepare("SELECT * FROM orders WHERE id=:orderID;");
    $updateOrder->bindParam(":orderID", $orderID);
    $updateOrder->execute();

    $order = $updateOrder->fetchAll();
endif;

foreach($order as $o):
?>
    <div class="row">
        <form action="/admin/updated.php" method="POST" class="col s12">
            <input type="hidden" name="orderID" value="<?= $o['id']; ?>">
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="updateName" value="<?=$o['name']; ?>" id="first_name2">
                    <label for="first_name2">Name</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">email</i>
                    <input type="email" name="updateMail" value="<?=$o['mail']; ?>" id="mail">
                    <label for="mail">Mail</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">home</i>
                    <input type="text" name="updateAddress" value="<?=$o['address']; ?>" id="address">
                    <label for="address">Adress</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">phone</i>
                    <input type="tel" name="updateMobile" value="<?=$o['mobile']; ?>" id="mobile" required>
                    <label for="mobile">Mobil nr.</label>
                </div>
            </div>
            <div class="row center-align">
                <div class="col m4">
                    <p>Order: #<?= $o['id'] ?></p>
                </div> 
                <div class="col m4">
                    <p>Produkt: <?= $o['product'] ?></p>
                </div> 
                <div class="col m4">
                    <p>
                        <label>
                            <input value="1" type="checkbox" name="updateStatus" class="filled-in"
                                <?= $o['status'] == 1 ? 'checked="checked"' : ''; ?>" >
                            <span>Orden klar</span>
                        </label>
                    </p>
                </div> 
            </div>
            <br>
            <div class="row">
                <div class="col m12 right-align">
                    <input type="submit" class="btn">
                </div>
            </div> 
        </form>
    </div>

<?php endforeach; ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php"); ?>