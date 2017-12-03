<?php
    //Avoid mysql_connect depreciation error
    error_reporting( ~E_DEPRECATED & ~E_NOTICE );
    
    define('DBHOST', localhost);
    define('DBUSER', 'x14402132');
    define('DBPASS', '');
    define('DBNAME', 'yaid');
    
    $conn = mysql_connect(DBHOST, DBUSER, DBPASS);
    $dbconn = mysql_select_db(DBNAME);
    
    if (!$conn) {
        die("The connection has failed : " . mysql_error());
    }
    
    if ( !$dbconn ) {
        die ("The Database Connection has failed : " . mysql_error());
    }

?>