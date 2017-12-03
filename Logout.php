<!--/*-->
<!-- * Logout.php-->
<!-- *-->
<!-- * Date e.g. 11th May 2017-->
<!-- *-->
<!-- * @author Andre MacNamara X14380181-->
<!-- *-->
<!-- */ -->

<?php
 session_start();
 session_destroy();
 include 'Db/Db.php';

 header("Location: index.php");
 exit();

 
 ?>