<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
chdir('..');
print shell_exec('git pull');


?>