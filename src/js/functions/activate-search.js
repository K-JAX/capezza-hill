// search functionality

(function () {
    function activateSearch() {
        var form = document.querySelectorAll(".search-form")[0],
            field = document.querySelectorAll(".search-field")[0],
            sub = document.querySelectorAll(".search-submit")[0];
    

        document.addEventListener("click", function(event){
            
            if(event.target == sub || event.target == field){
                if (window.innerWidth < 766) {
                    if( !form.matches('.mobile-expand') ){
                        form.classList.add('mobile-expand');
                        event.preventDefault();
                    }
                }
    
                if(field.value == '' ){
                    event.preventDefault();
                    console.error('You need to put shit in there')
                }
    
            }else{
                form.classList.remove('mobile-expand');
            }
        }); 
    }
    activateSearch();
})();
