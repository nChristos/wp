<?php
  session_start();

// Put your PHP functions and modules here

$csv = fopen("http://titan.csit.rmit.edu.au/~e54061/wp/letters-home.txt","r");

$correspondence;
// populate headings array with first line of CSV
$headings = fgetcsv($csv,0,"\t");

$x =0;

$output = "";

while($row = fgetcsv($csv,0,"\t")){

    $title = $row[0];

    for($i=0 ; $i<count($row) ; $i++){

      $correspondence[$row[0]][$headings[$i]] = $row[$i] ;
      }
    
$x++;
}

sort($correspondence);

$year = 1914;

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
      .date('l jS F Y', strtotime($val['DateStart']))
      ."<h3>".$val['Town']."</h2>"
      ."<h4>".$val['Country']."</h3>"
      ."</div>"
      ."<div class = 'cardback'><article><p1 >".$val['Content']. "</p1></article> </div>"
      
      ."</article>";

    }
}

$output .= "</section>";

echo $output;

fclose($csv);

?>