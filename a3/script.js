/* Insert your javascript here */


//////////////////////////script for tabs to switch content///////////////////////
  function tabSelect(active, tabClicked){
    var i;
    var content;
    var tabs;
    content = document.getElementsByClassName("mainContent");
    for(i=0 ; i < content.length; i++){
      content[i].style.display = "none";
    }
    
    tabs = document.getElementsByClassName("tab");
    for(i=0 ; i < tabs.length ; i++){
      tabs[i].className = tabs[i].className.slice(0,3);
    }

    document.getElementById(tabClicked).style.display = "block";
    active.currentTarget.className += " active";
  }


  //////////////////////script to expand letter/postcards////////////////////////

    window.onload = function() {
    var correspondence = document.getElementsByClassName("correspondence");
    
    var i;
    
    for(i=0 ; i < correspondence.length; i++){
      correspondence[i].addEventListener("click" , function(){
        this.classList.toggle("active");
        
        if(this.style.height){
          this.style.height = null;
          this.style.opacity = null;
        } else{
          this.style.height = "40vw";
          this.style.opacity = "1.0"
        }
      })
     }
    }


  //////////////////////////Regex real-time form validation///////////////////

  function validate() {

    var nameRegex = /^[A-Z][ a-zA-Z-,.']+$/;
    var mobileRegex = /(\(04\)|04|\+614)( ?\d){8}$/;//Thanks Trevor!

      var name = document.getElementById("name").value;
      
      var mobile = document.getElementById("mobile").value;

      var nameResult = name.search(nameRegex);
      
      var mobileResult = 0;
    if(mobile != ""){ mobileResult = mobile.search(mobileRegex);}

    
  
    if(nameResult != 0 ||  mobileResult != 0){ 
        document.getElementById("submit").disabled = true;
    }
    else{
      document.getElementById("submit").disabled = false;
    }

    if(nameResult != 0){
      document.getElementById("nameWarn").innerHTML = "valid name example: \"Jane R. Smith-Jones\"";
    } 
    else{ document.getElementById("nameWarn").innerHTML = null;}

    if(mobileResult != 0){
      document.getElementById("mobileWarn").innerHTML = "Australian \"04\" or \"+614\" mobile phone numbers only!";
    } 
    else{ document.getElementById("mobileWarn").innerHTML = null;}

    }

    

    
