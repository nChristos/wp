<?php include("tools.php"); 
    head(); 

    $name = "";
    $email = "";
    $mobile = "";
    $remember = "";

    if($_SESSION){$name = $_SESSION['localData']['name'];}
    if($_SESSION){$email = $_SESSION['localData']['email'];}
    if($_SESSION){$mobile = $_SESSION['localData']['mobile'];}
    if($_SESSION){ $remember = "checked";}

$htmlForm = <<<FORM
        <body onload="validate()">
            <form action="index.php" method="post">
                <div class="formgrid">
                
                    <div>
                        <label for="name">Name</label>
                    </div>
                    <div>
                        <input id="name" class="textBox" type="text" name="name" placeholder="Name..." required autofocus oninput="validate()" value=$name>
                        <span id="nameWarn"></span>  
                    </div>
                    <div>
                        <label for="email">Email</label>
                    </div>
                    <div>
                        <input id="email" class="textBox" type="text" name="email" placeholder="Email..." reuired oninput="validate()" value=$email>
                        <span id="emailWarn"></span>
                    </div>
                    <div>
                        <label for="mobile">Mobile</label>
                    </div>
                    <div>
                        <input id="mobile" class="textBox" type="text" name="mobile" placeholder="Mobile..." oninput="validate()" value=$mobile>
                        <span id="mobileWarn"></span>
                    </div>
                    <div>
                        <label for="subject">Subject</label>
                    </div>
                    <div>
                        <input id="subject" class="textBox" type="text" name="subject" required placeholder="Subject...">
                    </div>
                    <div>
                        <label for="message">Message</label>
                    </div>
                    <div>
                        <textarea id="message" class="textBox" name="message" rows="10" cols="20" required placeholder="Type your message..."></textarea>
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