<?php


//////gather data from online CSV document and place in local array///////////////////

function getCSV(){

$csv = fopen("http://titan.csit.rmit.edu.au/~e54061/wp/letters-home.txt","r");

$headings = fgetcsv($csv,0,"\t");

$x =0;

while($row = fgetcsv($csv,0,"\t")){

    $title = $row[0];

    for($i=0 ; $i<count($row) ; $i++){

      $correspondence[$row[0]][$headings[$i]] = $row[$i] ;
      }
    
$x++;
}
fclose($csv);

return $correspondence;

}


/////////////////////////build letter/poscard HTML structure//////////////////////////////

function buildCorrespondenceHTML($correspondence){

sort($correspondence);

$startYear = 1914;
$year = $startYear;
$output = "";

$output .= "<section id='content ".$year."' class='mainContent'>";

foreach($correspondence as $var => $val){


    if(substr($val['DateStart'] , 0, 4) != $year){
        $output .= "</section>";
        $year = substr($val['DateStart'] , 0, 4);
        $output .= "<section id='content ".$year."' class='mainContent'>";
    }

    if( substr($val['DateStart'] , 0, 4) == $year ){
      $output .= "<article class='correspondence ".$val['Type']."'>"
      
      ."<div class='cardfront'>" 
      .date('l jS F Y', strtotime($val['DateStart']))."<br>"
      .$val['Town']."<br>"
      .$val['Country']."<br>"
      ."</div>"
      ."<div class = 'cardback'><article><p1 >".nl2br($val['Content']). "</p1></article> </div>"
      
      ."</article>";

    }
}

$output .= "</section>";

return $output;

}






?>