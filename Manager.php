<?php
    ob_start();
    session_start();
    include 'Db/db.php';
    include 'Header.php';

    if(isset($_SESSION['signed_in']) == false){
        echo'<div class="text-center" style="padding-top:3%">';
     echo '<h3>You must be logged in <a href="Mlog.php">Login</a></h3><br/><br/>';
          echo '<h3>Register <a href="Mreg.php">Here</a></h3>';
          echo'</div>';

    } else {  
        echo htmlentities($_SESSION['Mname']);
       
   
    if(isset($_POST['submit'])){
             move_uploaded_file($_FILES['file']['tmp_name'],"TeamPic/".$_FILES['file']['name']);
              
              
   $query3 = "INSERT INTO mteam1(Memail, Pname, Pdob, Ppic) 
   VALUES( '".$_SESSION['Memail']."', '".$_POST['Pname']."', '".$_POST['Pdob']."','".$_FILES['file']['name']."' )";

   //$q = mysql_query("UPDATE mteam SET Ppic = '".$_FILES['file']['name']."' WHERE Pname = '".$_POST['Pname']."'");
    
     $res = mysql_query($query3);
     
    if ($res) {
    $errTyp = "success";
    $errMSG = "Player Successfully Registered";
 
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   }
        }
        
    
    
?>
<html>
    <head>
        
    </head>
    <body>
     <div class="container">   
            <div class="form-group">
        
        <br/>
         <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
        <div align="center"><form action="" method="post" enctype="multipart/form-data">
                <h3>Upload player picture</h3><input class="" type="file" name="file">
                <br/>

             <div class="form-group">
           
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="Pname" class="form-control" placeholder=" <?php echo $_SESSION['Memail'] ?>" maxlength="50" value="<?php echo $nameError ?>" />
                </div>
                </div>
            
            
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="Pdob" class="form-control" placeholder="Players Date of Birth YYYY/MM/DD e.g. 1994/09/23" maxlength="50" value="<?php echo $nameError ?>" />
                </div>
            
                <input type="submit" class="btn btn-primary btn-md" name="submit" value="Submit" >
                
                </form>
                </div>
            </div>
            </div>
            <?php
             echo '   <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" style"padding-left:100px;">';
             
             $aVar = mysqli_connect('localhost','x14402132','','yaid');
              $sql = "SELECT * FROM mteam1 WHERE Memail = ' ".$_SESSION['Memail']." '";
             $result = mysqli_query($aVar, $sql);
             $sqlpic = "SELECT Ppic FROM mteam1 WHERE Memail = '".$_SESSION['Memail']." ' ";
            $resultpic = mysqli_query($aVar,$sqlpic);
            /* if ($resultpic->num_rows > 0) {
                                 // output data of each row
                                 while($row = $resultpic->fetch_assoc()) {
                                 echo "<img width='200' height='200' src='TeamPic/".$row['Ppic']."' alt='Profile Pic'> <br/>";
                                 }
                                 
                            }*/
                            echo'
                    <div class="panel panel-default text-center">
                        <div class="panel-body">';
                        
            $statme = "SELECT Ppic, Pname, Pdob FROM mteam1 WHERE Memail = '".$_SESSION['Memail']."'";
            $printStat = mysqli_query($aVar,$statme) or die('error getting data');
            
                    echo "<h3> Player's </h3>";
                    
                   
                while($row = $printStat->fetch_assoc()) {
                    echo "<table>";
                     echo "<tr><th>Club Player</th></tr>";
                    echo "<tr><td>";
                    echo "<img width='200' height='200' src='TeamPic/".$row['Ppic']."' alt='Player Pic'> ";
                    echo "</td><br/><hr><td style='padding-left:20px'>";
                    echo $row['Pname'];
                    echo "</td><br/><hr><td style='padding-left:20px'>";
                	echo $row['Pdob'];
                	echo "</td><br/></tr>";
                	echo "<br/></table>";
                };
                		echo'
                        </div>
                    </div>
                </div>';
    }
                ?>
    </div>
    
    </body>
</html>