$(document).ready(function(){
    $('#menu').on('click', '.menu-item', function(e){
        // e.preventDefault();
        var dropdown = $(this).find('.dropdown');

        if(dropdown.height() > 0){
            dropdown.css({
                'height': '0px'
            });
        }else{
            dropdown.css({
                'height': 'auto'
            });
        }
    });
});