<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_AirShow = "tunderoccl.db.6142374.hostedresource.com";
$database_AirShow = "tunderoccl";
$username_AirShow = "tunderoccl";
$password_AirShow = "Boom123";
$AirShow = mysql_pconnect($hostname_AirShow, $username_AirShow, $password_AirShow) or trigger_error(mysql_error(),E_USER_ERROR); 
?>