$(document).ready(function() {
$("#submit").prop('disabled', true);

$('#check_for_errors').on('click', function(){
	$('#validation').submit();
})

$("#validation").submit(function(e){
	e.preventDefault();
	var data = $('#validation').serialize();
	$.post('/validations/validate_all', data, function(res){
		console.log(res);
		var data_array = JSON.parse(res);
		var arr = [];
	    for(var x in data_array){
	 	  	arr.push(data_array[x]);
	 	}
		console.log(arr);
		for (var i = arr.length - 1; i >= 0; i--) {
			$("#"+arr[0][i]).css('background-color', 'pink');
			$("#"+arr[1][i]).css('background-color', '');
		};
		if (arr[0].length == 0) {
			$("#"+arr[1][i]).css('background-color', '');
			$('#message').html('Data is valid. Go ahead and submit when ready!')
			$('#submit').prop('disabled', false);
		}
	});
});

$('#submit').on('click', function(){
	var data = $('#validation').serialize();
	$.post('/upload/submit/final', data, function(res){
		console.log(res);
		if(res != 'Failure') {
			$('#result_table').hide();
			$('#message').html('Thank you! <a href="/collection/'+res+'">Click here to visit your collection.</a>')
		}
		})
});
});