<?php include_once("includes/base-top.php"); ?>
<?php include("db.php"); ?>

<?php 
$getProducts = $db->prepare("SELECT * FROM products;");
$getProducts->execute();
$products = $getProducts->fetchAll();
?>
	<br>
	<div class="row green lighten-4 z-depth-1" style="padding: 20px; margin-top: 25px;">
		<h1>Nackademins Spel Butik</h1>
		<p class="" style="font-size: 16px">De bästa PC-spelen till oslagsbara priser!</p>
	</div>
	<br>
	<div class="row">
	<?php foreach($products as $p): ?>
		<div class="col s12 m4">
			<div class="card large">
				<div class="card-image">
					<img style="padding: 12px" class="" src="<?= $p['image']; ?>">
				</div>
				<div class="card-content">
					<h5><?= $p['title']; ?> </h5>
					<p><?= $p['about'] ?></p>
					<p> <b>Pris: <?= $p['price'] ?> kr</b></p>
				</div>
				<div class="card-action">
					<a href="/order/?productID=<?= $p['id']; ?>" class="btn-small green lighten-1">Buy</a>
				</div>
			</div>
		</div>
	<?php endforeach ?>	
	</div>

<?php include_once("includes/base-bottom.php"); ?>
