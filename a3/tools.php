<?php
include("csvCompile.php");
session_start();



//////////upload, format and output online CSV document////////////

function csvCompile(){

echo buildCorrespondenceHTML(getCSV());

}

?>