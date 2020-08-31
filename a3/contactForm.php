<?php include("tools.php"); 
    head(); 

    $name = "";
    $email = "";
    $mobile = "";
    $remember = "";
    $subject = "";
    $message = "";
    $nameAlert = "";
    $emailAlert= "";
    $mobileAlert= "";


    if(isset($_SESSION['tempData']['name'])){$name = $_SESSION['tempData']['name'];}
    if(isset($_SESSION['tempData']['email'])){$email = $_SESSION['tempData']['email'];}
    if(isset($_SESSION['tempData']['mobile'])){$mobile = $_SESSION['tempData']['mobile'];}
    if(isset($_SESSION['tempData']['alert'])){
        if(isset($_SESSION['tempData']['subject'])){$subject = $_SESSION['tempData']['subject'];}
        if(isset($_SESSION['tempData']['message'])){$message = $_SESSION['tempData']['message'];}
    }
    if(isset($_SESSION['tempData']['nameAlert'])){$nameAlert = $_SESSION['tempData']['nameAlert'];}
    if(isset($_SESSION['tempData']['emailAlert'])){$emailAlert = $_SESSION['tempData']['emailAlert'];}
    if(isset($_SESSION['tempData']['mobileAlert'])){$mobileAlert = $_SESSION['tempData']['mobileAlert'];}
    if(isset($_SESSION['tempData']['remember'])){ $remember = "checked";}
    
    $_SESSION['mailFlag'] = "set";

$htmlForm = <<<FORM
        <body onload="validate()">
            <form action="index.php" method="post">
                <div class="formgrid">
                    <div>
                        <label for="name">Name</label>
                    </div>
                    <div>
                        <span>$nameAlert</span>
                        <input id="name" class="textBox" type="text" name="name" placeholder="Name..." required  autofocus  value=$name>
                        <span id="nameWarn"></span>  
                    </div>
                    <div>
                        <label for="email">Email</label>
                    </div>
                    <div>
                        <span>$emailAlert</span>
                        <input id="email" class="textBox" type="text" name="email" placeholder="Email..." value=$email>
                        <span id="emailWarn"></span>
                    </div>
                    <div>
                        <label for="mobile">Mobile</label>
                    </div>
                    <div>
                        <span>$mobileAlert</span>
                        <input id="mobile" class="textBox" type="text" name="mobile" placeholder="Mobile..."   value=$mobile>
                        <span id="mobileWarn"></span>
                    </div>
                    <div>
                        <label for="subject">Subject</label>
                    </div>
                    <div>
                        <input id="subject" class="textBox" type="text" name="subject" required placeholder="Subject..." value=$subject>
                    </div>
                    <div>
                        <label for="message">Message</label>
                    </div>
                    <div>
                        <textarea id="message" class="textBox" name="message" rows="10" cols="20" required placeholder="Type your message..." >$message</textarea>
                    </div>
                    <div>
                        <input type="submit" id="submit">
                    </div>
                    <div>
                        <input type="checkbox" id="remember" name="remember"  $remember >
                        <label for="remember">Remember me</label>
                    </div>
                </div>
            </form>
        </body>
    </html>
FORM;

echo $htmlForm;

echo print_r($_SESSION);