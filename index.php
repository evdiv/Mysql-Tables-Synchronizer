<?php

require "config.php";


//*************************************************************
// Backup tables

$Backup = new Backup();

$sql = $Backup->create(TABLES);
$status = $Backup->store($sql) ? 'Success' : 'Error';

echo "<p>Backup result: " . $status . "</p>";



//*************************************************************
//Restore the backuped tables


$Restore = new Restore();

$status = $Restore->create() ? 'Success' : 'Error';

echo "<p>Restore result: " . $status . "</p>";

