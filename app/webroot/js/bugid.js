$(document).ready(function(){
        $('html').click(function() {
            //Hide the Loginbar if visible
            $("#loginbar-popover").hide();
        });

        $('#loginbar').click(function(event){
                event.stopPropagation();
		//$(this).toggleClass('lblue');
                //$(this).find('h1').toggleClass('lblue');
                $("#loginbar-popover").toggle();
	});
        
        $("#loginbar-popover").click(function(event){
            //Allow clicking inside loginbar without hiding it
            event.stopPropagation();
        });
});