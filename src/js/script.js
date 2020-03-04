// import '../sass/style.scss';




// Scroll to specific values
// scrollTo is the same

function scrollIt(destination, duration = 200, easing = 'linear', callback) {
    // object with some some timing functions
    // function body here
    const start = window.pageYOffset;
    const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();
    
}

window.addEventListener("load", function(){

    // Create dropdown for homepage feature section
    var navThang = document.querySelectorAll('.feature-page-subnav')[0],
        subNavThang = document.querySelectorAll('.feature-page-subnav .subnav')[0];

    if(navThang){
        navThang.addEventListener('mouseenter', function(event){
            subNavThang.classList.toggle('active') ;
        });

        navThang.addEventListener('mouseleave', function(event){
            subNavThang.classList.toggle('active') ;
        });
    }


    // Add active class to input's parents
    document.querySelectorAll('.wpcf7-form-control-wrap input').forEach(item => {
        // if( item ){
            item.addEventListener('focus', event => {
                item.parentElement.classList.toggle('active');
            });
            item.addEventListener('blur', event => {
                item.parentElement.classList.toggle('active');
            });
        // }  
    });
});

