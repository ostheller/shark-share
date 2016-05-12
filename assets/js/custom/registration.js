$(document).ready(function() {
	console.log('works');

	$('#terms').click(function(e){
		e.preventDefault();
		window.location.href = "/download/terms";
	})
});