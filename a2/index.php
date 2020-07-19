<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <script src='../wireframe.js'></script>
  </head>

  <body>

    <header>
    
      <div class="headergrid">
      <div class="title a">LETTERS </div>
      <div class="title b">HOME</div> 
      <div class="c"><img id="displaypic" src="../../media/dougPic.png" ></div>
      <div class="d"><img id="soldiers" src="../../media/Soldiers.png"></div>
        
      </div>
    </header>

    <nav>
      <button class="button fourteen">1914</button>
      <button class="button fifteen">1915</button>
      <button class="button sixteen">1916</button>
      <button class="button seventeen">1917</button>
      <button class="button eighteen">1918</button>
      <button class="button about">About</button>
      
    </nav>

    <main>
      <article id='Website Under Construction'>
    
      <button class="accordion accone">one</button>
      <div class="letter"> 
      </div>
      <button class="accordion accone">two</button>
      <div class="letter"> 
      </div>
      <button class="accordion accone">three</button>
      <div class="letter">
      </div>
      <button class="accordion accone">four</button>
      <div class="letter">
      </div>
      </article>
    </main>

    <footer>
      <div>&copy;<script>
        document.write(new Date().getFullYear());
      </script> Put your name(s), student number(s) and group name here. Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
      <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
    </footer>

    <script>
      
      var accordion = document.getElementsByClassName("accordion");
      var i;
      for(i=0 ; i < accordion.length; i++){
        accordion[i].addEventListener("click" , function(){
          this.classList.toggle("active");
          var panel = this.nextElementSibling;

          if(panel.style.maxHeight){
            panel.style.maxHeight = null;
          } else{
            panel.style.maxHeight = "1000px";
          }

        })
      }

    </script>

  </body>
</html>
