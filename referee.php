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
    
        ?>
        
        <html>
            <head>
                
            </head>
            <body>
                <div class="text-center" style="padding-top:50px;">
                <h2 > Referees will use the YouthAppId mobile application to view a teams players</h2>
                </div>
            </body>
        </html>
        
        <?php
        
        
        
    }
        
?>