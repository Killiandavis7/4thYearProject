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
  $name = trim($_POST['Mname']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['Memail']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $Phone = trim($_POST['Phone']);
  $Phone = strip_tags($Phone);
  $Phone = htmlspecialchars($Phone);
  
  $Club = trim($_POST['Club']);
  $Club = strip_tags($Club);
  $Club = htmlspecialchars($Club);
  
  $ClubHead = trim($_POST['ClubHead']);
  $ClubHead = strip_tags($ClubHead);
  $ClubHead = htmlspecialchars($ClubHead);
  
  $HeadPhone = trim($_POST['Phone']);
  $HeadPhone = strip_tags($HeadPhone);
  $HeadPhone = htmlspecialchars($HeadPhone);
  
  $AgeGroup = trim($_POST['AgeGroup']);
  $AgeGroup = strip_tags($AgeGroup);
  $AgeGroup = htmlspecialchars($AgeGroup);
  
  $League = trim($_POST['League']);
  $League = strip_tags($League);
  $League = htmlspecialchars($League);
 
  $District = trim($_POST['District']);
  $District = strip_tags($District);
  $District = htmlspecialchars($District);
 
  $pass = trim($_POST['Mpass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  

  
  // basic name validation
  
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleast 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  
    $email = $_POST['Memail'];
    $domain = explode('@',$email)[1];
   /* if($domain != '@')
    {
    $error = true;
    $emailError = "This domain does not have permission to sign up";
    }*/

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
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
  // league must be DDSL or NDSL
  /*if (empty($league)){
   $error = true;
   $LeagueErr = "Please enter DDSL or NDSL";}
   
   $League = $_POST['League'];
    $domain1 = explode('DDSL' || 'NDSL',$League)[1];
    if($domain1 != 'DDSL' || 'NDSL')
    {
    $error = true;
    $Leagueerr = "Please Choose Either 'DDSL' or 'NDSL'";
    }*/
 
  
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO manager(Mname,Memail,Phone, Club, ClubHead, HeadPhone, AgeGroup, League, District, Mpass, userDate) 
   VALUES('$name', '$email', '$Phone', '$Club', '$ClubHead', '$HeadPhone', '$AgeGroup', '$League', '$District', '$pass', NOW())";
                        
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
             <input type="text" name="Mname" class="form-control" placeholder="Enter Full Name" maxlength="50" value="<?php echo $nameError ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="Memail" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $emailError ?>" />
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
             <input type="club" name="Club" class="form-control" placeholder="Enter Club Name" maxlength="40" />
                </div>
                </div>
                
                
                <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="ClubHead" class="form-control" placeholder="Enter Club Secretary/Head Name" maxlength="50" value="<?php echo $ClubHead ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="HeadPhone" class="form-control" placeholder="Enter Secretary/Head's Number e.g 0851234567" maxlength="50" value="<?php echo $HeadPhone ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="AgeGroup" class="form-control" placeholder="Enter Teams Age Group" maxlength="50" value="<?php echo $AgeGroup ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="League" class="form-control" placeholder="Enter League e.g Premier, Major, A1" maxlength="50" value="<?php echo $Leagueerr ?>" />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="District" class="form-control" placeholder="Enter District e.g DDSL or NDSL" maxlength="50" value="<?php echo $District ?>" />
                </div>
            </div>
           
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="Mpass" class="form-control" placeholder="Enter Password" maxlength="15" />
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