/* Insert your javascript here */


//script for tabs to switch content
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


  //script to expand letter/postcards

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
          this.style.height = "70vw";
          this.style.opacity = "1.0"
          
         
        }

      })
    }
    }


