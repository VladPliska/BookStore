let showAllFilter = document.getElementById('showAllFilter');
let mainFilter = document.getElementById('mainFilter')
if(showAllFilter != null){
  showAllFilter.addEventListener('click',function(){          //for animation show main filter
      mainFilter.style.display = "grid";
      window.setTimeout(function() {
       mainFilter.classList.toggle("active")
              }, 0)
      
  });
}