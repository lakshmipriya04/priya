<?php 
$nameErr = $emailErr = $contactErr = $messageErr = "";
$name = $email = $contact = $message = "";

error_reporting(E_ALL & ~E_NOTICE);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$from = 'Portfolio Contact Form'; 
		$to = 'priyaindia95@gmail.com'; 
		$subject = 'Message from Contact Demo ';
		$body ="From: $name\n E-Mail: $email\n Message:\n $message";
    
  if (empty($_POST["name"])) {
    $nameErr = "Please enter your name";
  } else {
    $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Please enter your email";
  } else {
    $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; }
  }
    
  if (empty($_POST["contact"])) {
    $contact = "";
  } else {
    $contact = test_input($_POST["contact"]);
      // check if contact only contains numbers
    if (!(preg_match($mob="/^[1-9][0-9]*$/",$contact) || strlen($contact)==10)) {
      $contactErr = "Invalid mobile number format"; }
  }

  if (empty($_POST["message"])) {
    $messageErr = "Please type your message";
  } else {
    $message = test_input($_POST["message"]);
  }
    
    // If there are no errors, send the email
     if ($nameErr == "" && $emailErr == "" && $contactErr == "" && $messageErr == "") {
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //your site secret key
        $secret = '6LeVOBoUAAAAABEYS9HqXDyvsbDwllZ6NDghIko-';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
         if($responseData->success){
	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success">Submitted successfully! Thank You! I will be in touch</div>';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	} } }
}}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
    
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>portfolio</title>
        <link rel="shortcut icon" href="../favicon.ico">
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/icons.css" />
		<link rel="stylesheet" type="text/css" href="css/style55.css" />
		<script src="js/modernizr.custom.js"></script>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        
        <style>
        .error {color: #FF0000;}
        </style>
	</head>
	<body>
			<nav id="bt-menu" class="bt-menu">
				<a href="#" class="bt-menu-trigger"><span>Menu</span></a>
				<ul>
                    <li><a href="index.html"><img src=".//img/user.png"></a></li>
					<li><a href="education.html"><img src=".//img/mortarboard(1).png"></a></li>
                    <li><a href="skill.html"><img src=".//img/code(1).png"></a></li>
                    <li><a href="project.html"><img src=".//img/light-bulb.png"></a></li>
                    <li><a href="contact.php"><img src=".//img/send.png"></a></li>
				</ul>

				<ul>
					<li><a href="mailto:priyaindia95@gmail.com"><img src=".//img/envelope.png"></a></li>
					<li><a href="https://www.facebook.com/lakshmi.priya.04"><img src=".//img/facebook-logo.png"></a></li>
					<li><a href="https://github.com/lakshmipriya04"><img src=".//img/github.png"></a></li>
				</ul>
     </nav>
        
    <div class="contact">
      <div class="container">
       <div class="col-lg-12" align=center><h1>Get In Touch</h1><hr></div>
    <div class="col-sm-10">
        <br>
        <p><span class="error">* required field.</span></p>
            <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name"maxlength="20" value="<?php echo $name;?>">
                            <span class="error">* <?php echo $nameErr;?></span><br>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo $email;?>">
							<span class="error">* <?php echo $emailErr;?></span><br>
						</div>
					</div>
                <div class="form-group">
						<label for="contact" class="col-sm-2 control-label">Contact</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="contact" name="contact" placeholder="Mobile number" maxlength="10" value="<?php echo $contact;?>"><span class="error"> <?php echo $contactErr;?></span><br>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"><?php echo $message;?></textarea>
							<span class="error">* <?php echo $messageErr;?></span><br>
						</div>
					</div>
<br><div class="form-group">
<div class="g-recaptcha" data-sitekey="6LeVOBoUAAAAAKfM95KsX75unnUPWKpgueG7MTYn"></div></div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>	
						</div>
					</div>
</form> 
        </div>
       
          <div class="col-md-8" align="center"><h2><p>
          Download my Resume here &rsaquo;&rsaquo; <a href=".//doc/Lakshmi Priya.pdf"><input type="image" src=".//img/downloading-file.png"/></a></p></h2>
          </div></div></div>
<!-- /container -->
	</body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<script src="js/classie.js"></script>
	<script src="js/borderMenu.js"></script>
</html>