<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/db.php"); ?>

<?php

$stmt = $db->prepare("SELECT * FROM contact");
$stmt->execute();
$records = $stmt->fetchAll();

?>
<h3>Admin portal - <em>Radera meddelanden</em></h3>
<table class="striped responsive-table">
    <thead>
        <tr>
            <th>Nr</th>
            <th>Namn</th>
            <th>Email</th>
            <th>Meddelande</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($records as $r): ?>
        <tr>
            <td><b>#<?= $r['id']; ?></b></td>
            <td><?= $r['name']; ?></td>
            <td><?= $r['mail']; ?></td>
            <td><?= $r['message']; ?></td>
            <td>
            </td>
            <td><a href="delete.php?id=<?= $r['id']; ?>" class="btn red">Radera</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-bottom.php"); ?>