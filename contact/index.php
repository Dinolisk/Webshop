<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/base-top.php"); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/db.php"); ?>

<?php 
$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'];
$email = $_POST['mail'];
$message = $_POST['message'];
if(empty($name) || empty($email) || empty($message)) {
$status = "All fields are compulsory.";
} else {
if(strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
  $status = "Please enter a valid name";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $status = "Please enter a valid email";
} else {
  $sql = "INSERT INTO contact (name, mail, message) VALUES (:name, :email, :message)";
  $stmt = $db->prepare($sql);
  
  $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);
  $status = "Thank you, we'll get back to you shortly";
  $name = "";
  $email = "";
  $message = "";
}
}
}
?>

<div class="wrapper">
<h1>About Us</h1>
  <div class="team">
  <div class="team_member">
  <div class="team_img">
    <img src="team1.png" alt="Team_image">
</div>
<h3>Oskar Wulff</h3>
  <p class="role">Developer</p>
  <p>Lorem ipsum dolor sit amet consectetur. Est quaerat tempora, aut cumque nihil nulla harum nemo distinctio quam blanditiis dignissimos.</p>
  <br>
  <div class="w3-container">
  <p><i class="tiny material-icons blue-grey-text">work </i> Student</p>
      <p><i class="tiny material-icons blue-grey-text">location_on </i> Stockholm, SWE</p>
      <p><i class="tiny material-icons blue-grey-text">drafts </i> test@test.com</p>
      <p><i class="tiny material-icons blue-grey-text">phone_android </i> 0000000000</p>
      <br>
  </p></div>
</div>
<div class="team_member">
  <div class="team_img">
    <img src="https://i.ibb.co/BCDScn5/team1.jpg" alt="Team_image">
  </div>
  <h3>Jose Ore</h3>
  <p class="role">Quality Assurance Student</p>
  <p>Jose is someone who enjoys technology a lot, his other passions are animals, nature, travelling and gaming.</p>
  <br>
  <div class="w3-container">
      <p><i class="tiny material-icons blue-grey-text">work </i> Student</p>
      <p><i class="tiny material-icons blue-grey-text">location_on </i> Stockholm, SWE</p>
      <p><i class="tiny material-icons blue-grey-text">drafts </i> jhose_tito@hotmail.com</p>
      <p><i class="tiny material-icons blue-grey-text">phone_android </i> 070044662</p>
      <br>
  </p></div>
  </div>
</div>

<div class="container">
    <h1>Contact Us</h1>

<form action="" method="POST" class="main-form">

<div class="row">
  <div class="input-field col s12">
      <i class="material-icons prefix">account_circle</i>
      <input id="icon_prefix" type="text" name="name" class="gt-input"
      value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $name ?>">
      <label for="icon_prefix">Name</label>
  </div>
  

<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">email</i>
    <input type="text" name="mail" id="email" class="gt-input"
    value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $email ?>">
    <label for="email">Email</label>
  </div>
    

<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">insert_comment</i>
    <textarea id="message" type="text" class="materialize-textarea" name="message"  
      class="gt-input gt-text"><?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $message ?></textarea>
    <label for="message">Message</label>
</div>

<div class="input-field col s12 m6 center-align">
    <button class="btn waves-effect waves-light" type="submit" name="action">
    Submit
    <i class="material-icons right">send</i>
    </button>
  </div>
  <div class="form-status">
        <?php echo $status ?>
    </div>
  </div>
</form>
</div>