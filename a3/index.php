<?php
include('tools.php');

setLocalVariables();

head();

topModule();

aboutSection();

csvCompile();

endModule();

print_r($_POST);
print_r($_COOKIE);
print_r($_SESSION);
?>
