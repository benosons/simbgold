$( function() {
	$("#delConfDialog").dialog({
    	autoOpen: false,
    	height: 'auto',
    	width: 775
  	});
	
	$( '#delConfDialog' ).dialog({
		 	/*
		 	buttons: {
        	'Ya': function() {
                //display ajax loader animation here...
                $( '#ajaxLoadAni' ).fadeIn( 'slow' );
                $( this ).dialog( 'close' );
                $.ajax({
                    url: delHref,
                    success: function( response ) {
                        //hide ajax loader animation here...
                        $( '#ajaxLoadAni' ).fadeOut( 'slow' );
                        
                        $( '#msgDialog > p' ).html( response );
                        $( '#msgDialog' ).dialog( 'option', 'title', 'Success' ).dialog( 'open' );
					    
					
                    } //end success
                });
                
            },//end Yes
			
        'Tidak': function() {
                $( this ).dialog( 'close' );
            }
        }, //end buttons
        */
    }); //end dialog
		
		
});
		
function open1(){
	//alert('xx');
	$( '#delConfDialog' ).dialog( 'open' );		
	return false;
}
