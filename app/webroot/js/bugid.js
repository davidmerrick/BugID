$(document).ready(function(){
        $('html').click(function() {
            //Hide the loginbar if visible
            $("#loginbar-popover").hide();
        });

        $('#loginbar').click(function(event){
                event.stopPropagation();
                $("#loginbar-popover").toggle();
	});
        
        $("#loginbar-popover").click(function(event){
            //Allow clicking inside loginbar without hiding it
            event.stopPropagation();
        });
});