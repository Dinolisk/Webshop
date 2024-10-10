<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>

<?php

$getOrders = $db->prepare("SELECT * FROM orders;");
$getOrders->execute();
$orders = $getOrders->fetchAll();

?>
<h1>Admin portal - <em>ordrar</em></h1>
<table class="striped responsive-table">
    <thead>
        <tr>
            <th># Order nr.</th>
            <th>Produkt</th>
            <th>Namn</th>
            <th>Mobil nr.</th>
            <th>Mail</th>
            <th>Adress</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($orders as $order): ?>
        <tr>
            <td><b>#<?= $order['id']; ?></b></td>
            <td><?= $order['product']; ?></td>
            <td><?= $order['name']; ?></td>
            <td><?= $order['mobile']; ?></td>
            <td><?= $order['mail']; ?></td>
            <td><?= $order['address']; ?></td>
            <td>
            <?= ($order['status'] == 0 ? "Ej klar" : "Klar"); ?>
            </td>
            <td><a href="/admin/update.php/?orderID=<?= $order['id']; ?>" class="btn yellow black-text">Ändra</a></td>
            <td>
                <form action="/admin/delete.php" method="POST">
                    <input type="hidden" name="deleteOrder" value="<?= $order['id']; ?>"> 
                    <input type="submit" value="DELETE" class="btn red">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>



<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php"); ?>