<?php
include("csvCompile.php");
session_start();

//////////////validate, sanitise and write message to csv/////////////////////

function validateFormData(){

    $mobileRegex = 1;  
    
    if(isset($_POST['name'])){
        $_SESSION['tempData'] = $_POST;

        $nameRegex = preg_match( "/^[A-Z][ a-zA-Z-,.']+$/i", $_SESSION['tempData']['name']);
        if(isset($_SESSION['tempData']['mobile'])){
            $mobileRegex = preg_match( "/(\(04\)|04|\+614)( ?\d){8}$/", $_SESSION['tempData']['mobile']);
            }
        $_SESSION['tempData']['subject'] = filter_var($_SESSION['tempData']['subject'], FILTER_SANITIZE_STRING );
        $_SESSION['tempData']['message'] = filter_var($_SESSION['tempData']['message'], FILTER_SANITIZE_STRING );

        $_SESSION['tempData']['nameAlert'] = "";
        $_SESSION['tempData']['mobileAlert'] = "";
        $_SESSION['tempData']['emailAlert'] = "";
        $_SESSION['alertMessage'] = "";
        
          if( $nameRegex == 0){
            $_SESSION['tempData']['alert'] = "unset";
            $_SESSION['tempData']['nameAlert'] = "Name could not be validated by server. Please try again";
            header("Location: contactForm.php");
          }
          if( $mobileRegex == 0){
            $_SESSION['tempData']['alert'] = "unset";
            $_SESSION['tempData']['mobileAlert'] = "Mobile could not be validated by server. Please try again";
            header("Location: contactForm.php");
          }
    
          if(!filter_var($_SESSION['tempData']['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['tempData']['alert'] = "unset";
            $sanEmail = filter_var($_SESSION['tempData']['email'], FILTER_SANITIZE_EMAIL);
            $_SESSION['tempData']['emailAlert'] = "unable to verify email:  \"".$_SESSION['tempData']['email']."\"   ";
            $_SESSION['tempData']['emailAlert'] .= "suggested fix: ".$sanEmail."?";
            header("Location: contactForm.php");
          }
        
          if(isset($_SESSION['mailFlag'])){
            if($_SESSION['mailFlag'] == "set"){

            $mail = fopen("mail.txt" , "a");

            flock($mail , LOCK_EX);

            
                fputcsv($mail , $_SESSION['tempData']);
            

            flock($mail , LOCK_UN);

            fclose($mail);

            $_SESSION['mailFlag'] = "unset";
            $_SESSION['alertMessage'] = "alert(\"message sent!\");";
            
            }
        }


    }
    elseif(isset($_COOKIE['name'])){
        $_SESSION['tempData'] = $_COOKIE;
    }
}

//////////set/unset cookie variable///////////////////////////////

function addRemoveCookie(){

    if(isset($_POST['remember'])){
        setcookie(  "name" , $_POST['name'] , time()+(86400*30), "/");
        setcookie(  "email" , $_POST['email'] , time()+(86400*30), "/");
        setcookie(  "mobile" , $_POST['mobile'] , time()+(86400*30), "/");
        setcookie(  "remember" , "checked" , time()+(86400*30), "/");
        
    }
    elseif(isset($_POST['name']) && !isset($_POST['remember'])){
        unset($_SESSION['tempData']);
        setcookie(  "name" , "" , time()-3600, "/");
        setcookie(  "email" , "" , time()-3600, "/");
        setcookie(  "mobile" , "" , time()-3600, "/");
        setcookie(  "remember" , "" , time()-3600, "/");
    }
}


//////////upload, format and output online CSV document////////////

function csvCompile(){

echo buildCorrespondenceHTML(getCSV());

}

///////////build html head area////////////////////////////////////

function head(){

    $fmtime = filemtime("style.css");

$htmlHead = <<<HEAD
            <!DOCTYPE html>
            <html lang='en'>
                <head>                   
                    <meta charset="utf-8">
                    <meta name="description" content="Letters written by soldier ANZAC Douglas Raymond Baker during The Great War / World War 1 /  WWI ">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="keywords" content="HTML, CSS, JavaScript">
                    <title>Assignment 3 - Letters Home</title>                                        
                    <!-- Keep wireframe.css for debugging, add your css to style.css -->
                    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
                    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=$fmtime">
                    <script src='../wireframe.js'></script>
                    <script src='script.js'></script>                                       
                </head>
HEAD;

    echo $htmlHead;
}

//////////build upper area of index page html//////////////////////

function topModule(){

$htmlTop = <<<TOPDOC
                    <script> {$_SESSION['alertMessage']} </script>
                <body>
                    <header>
                        <div class="headergrid">
                            <div class="title a">LETTERS </div>
                            <div class="title b">HOME</div> 
                            <div class="c"><img id="displaypic" src="../../media/dougPic.png" alt="Picture of Douglas Raymond Baker"></div>
                            <div class="d"><img id="soldiers" src="../../media/Soldiers.png">
                        </div>
                    </header>                                       
                    <nav>
                        <button id="tab1914" class="tab" onclick="tabSelect(event,'content 1914')">1914</button>
                        <button id="tab1915" class="tab" onclick="tabSelect(event,'content 1915')">1915</button>
                        <button id="tab1916" class="tab" onclick="tabSelect(event,'content 1916')">1916</button>
                        <button id="tab1917" class="tab" onclick="tabSelect(event,'content 1917')">1917</button>
                        <button id="tab1918" class="tab" onclick="tabSelect(event,'content 1918')">1918</button>
                        <button id="tababout" class="tab active" onclick="tabSelect(event,'content About')">About</button>
                    </nav>
                        <div id="buffer">
                        </div>
                    <main>
TOPDOC;

    echo $htmlTop;
}

////////////build about section html////////////////////////////

function aboutSection(){

    $htmlAbout = <<<ABOUT
                        <section id="content About" class="mainContent about"> 
                            <article> 
                                <h1>The Great War as seen through the eyes of ANZAC Douglas Raymond Baker.</h1>
                                <br><br>
                                <p>These are copies of letters written by my father Douglas Raymond Baker who I share names with, during his service throughout the First World War (1914-1918). I have three thick exercise books in which the letters were copied in hand writing by my Aunt Alice, his sister. I understand that this was done so his letters could be sent on to other members of the family. I don’t know if the originals are still in existence, probably not.
                                <br>
                                <p style="font-size:3vw; text-align:right; ">-Douglas Raymond Baker </P>
                                </p>
                                <div class="anzacPin">
                                <img  src="../../media/risingSun.png">
                                </div>
                            </article>
                        </section>
                        <div id="articleWrapper">
ABOUT;

  echo $htmlAbout;

}

/////////////build bottom section of index page html/////////////

function endModule(){

    $updateTimestamp = date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME']));

    $htmlEnd = <<<ENDDOC
                        </div>
                    </main>
                    <footer>
                        <div>&copy;<script>
                        document.write(new Date().getFullYear());
                        </script> 
                        <form action="contactForm.php">
                        <button type="submit" >Contact us!</button>
                        </form>
                        <div><a href="https://www.aif.adfa.edu.au/showPerson?pid=11163">Douglas Raymond Baker's summary of service record in the AIF Project</a><br>
                        <a href="https://recordsearch.naa.gov.au/SearchNRetrieve/Interface/ViewImage.aspx?B=3009496&S=1">Douglas Raymond Baker's original service record</a><br>
                        </div>
                        <br>
                        <a href="https://github.com/nChristos/">Nathan Christos</a>, s3788418. Last modified $updateTimestamp.</div>
                        <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
                        <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
                    </footer>
                </body>
            </html>
ENDDOC;

echo $htmlEnd;

}


?>