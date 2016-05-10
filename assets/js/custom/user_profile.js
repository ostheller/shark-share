$(document).ready(function() {
	
	function getModalHeight() {
    	return $(window).height()/2 - $('h1').outerHeight(true);
	}

	$('#edit_modal').on('click', function(e){
		e.preventDefault();
		$('#edit_user').modal('show');
	});
}