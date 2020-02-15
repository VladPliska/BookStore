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


let adminNav = document.getElementsByClassName('showWork');

for(let i=0;adminNav.length>i;i++){
  adminNav[i].addEventListener('click',showAdminWorkSpace);
}

function showAdminWorkSpace(e){
let showArea = e.target.getAttribute('data-open');
// e.target.classList.add('active')
for(let i = 0;adminNav.length > i;i++){
 adminNav[i].classList.remove('active');
 if(adminNav[i].getAttribute('data-open') == showArea){
   adminNav[i].classList.add('active');
 }

}

let adminWorkSpace = document.querySelectorAll('.admin-workspace .tab');
for(let a = 0; adminWorkSpace.length > a ; a++ ){
  adminWorkSpace[a].classList.add('hide');
  if(adminWorkSpace[a].getAttribute('data-target') == showArea){
    adminWorkSpace[a].classList.remove('hide');
  }
}
}

$('.searchCatalog').on('click',function(){
   let searchQuery = $('#filter-search').val();
   let mainFilter = $('#main-filters');
   let filterOn = false;

    if(mainFilter.hasClass('active')){
        filterOn = true;
    }

    $.ajax({
        method:"POST",
        url:"searchCatalog",
        data: {
            'query': searchQuery,
            'filter': filterOn
        },
        success:function(res){
            console.log(res);
        }
    })

});
