<!--/*-->
<!-- * Register.php-->
<!-- *-->
<!-- * Date e.g. 8th May 2017-->
<!-- *-->
<!-- * @reference http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html-->
<!-- * @author Andre MacNamara X14380181-->
<!-- *-->
<!-- */ -->


<?php
    //Start Outputs
    ob_start();
    session_start();


    include 'Header.php';

    
 //if( isset($_SESSION['signed_in'])!="" ){
  //header("Location: ../index.html");
 //}
    include 'Db/db.php';



 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['Rname']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['Remail']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $Phone = trim($_POST['Phone']);
  $Phone = strip_tags($Phone);
  $Phone = htmlspecialchars($Phone);
  
  $Club = trim($_POST['RLicenseGrade']);
  $Club = strip_tags($Club);
  $Club = htmlspecialchars($Club);
  
  $ClubHead = trim($_POST['RLicenseNo']);
  $ClubHead = strip_tags($ClubHead);
  $ClubHead = htmlspecialchars($ClubHead);
 
  $pass = trim($_POST['Rpass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  /*$pass2 = trim($_POST['userPassCheck']);
  $pass2 = strip_tags($pass2);
  $pass2 = htmlspecialchars($pass2);*/
  
  // basic name validation
  
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  
    $email = $_POST['Memail'];
    $domain = explode('@',$email)[1];
    if($domain != '@')
    {
    $error = true;
    $emailError = "This domain does not have permission to sign up";
    }

  else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } 
  else {
   // check email exist or not
   $query = "SELECT Memail FROM manager WHERE Memail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO referee(Rname,Remail,Phone, RLicenseGrade, RLicenseNo, Rpass, userDate) 
   VALUES('$name', '$email', '$Phone', '$Club', '$ClubHead','$pass', NOW())";
   //$query1 = "INSERT INTO profile1(Status, userEmail,gender,birthday,bio, dateAdd) 
   //VALUES( 'Write status here!', '$email', 'Unknown', 0000-00-00, 'Write Bio here!', NOW())";
                        
                        
                        
                        
                        
                        
   $res = mysql_query($query);
   //$res1 = mysql_query($query1);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 

    
  }
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign Up now.</h2>
        </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
                if ( isset($errMSG) ) {
    
               ?>
               
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
                
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="Rname" class="form-control" placeholder="Enter Full Name" maxlength="50" value="<?php echo $name ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="Remail" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="phone" name="Phone" class="form-control" placeholder="Enter Phone Number e.g 0851234567" maxlength="15" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="club" name="RLicenseGrade" class="form-control" placeholder="Enter Referee License Grade e.g.A, B, C" maxlength="40" />
                </div>
                </div>
                
                
                <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="RLicenseNo" class="form-control" placeholder="Enter Referee License Number" maxlength="50" value="<?php echo $ClubHead ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="Rpass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
               
            </div>
            
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="Home.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>
<?php ob_end_flush(); ?>