let showAllFilter = document.getElementById('showAllFilter');
let mainFilter = document.getElementById('mainFilter')
showAllFilter.addEventListener('click',function(){          //for animation show main filter
    mainFilter.style.display = "grid";
//   document.getElementById('mainFilter').classList.add('active');
  window.setTimeout(function() {
    mainFilter.classList.add("active")
            }, 0)
    
});