$(document).ready(function() {
	$.ajax({
	  type: "GET",
	  url: "/request/count",
	  dataType: 'json',
	  success: function(json_data){
	  	var data_array = json_data; // Do not parse json_data because dataType is 'json'
	    var arr = [];
	   	for(var x in data_array){
	 	  	arr.push(data_array[x]['id']);
	 	}
	  	console.log(arr);
	  	console.log('count: ' + arr.length);
	  	if(arr.length > 0) {
	  		$("#sample_requests").html('Sample Requests: <span id="request_count">('+arr.length+')</span>');
	  	} else {
	  		$("#sample_requests").html('Sample Requests');
	  	}
	  }
	});

	$("#forgot_password").on('click', function(e){
		e.preventDefault();
		$('#myModal').modal('show');
	});

	$('#reset_email').on('click', function(e){
		e.preventDefault();
		$( "#new_password" ).submit();
	})

	$( "#new_password" ).submit(function(e) {
			  e.preventDefault();
			  var data = $('#new_password').serialize();
			  console.log(data);
				$.post('/reset', data, function(res){
	            	console.log(res);	            	
	            	if (res == 1) {
	            			$('#myModal').modal('hide');
	            			alert('Email sent!')
	            	} else if (res == 2) {
	            			$('#errors').html('Error in sending mail. Please contact administrator.');
	            	} else if (res == 3) {
	            			$('#errors').html('Error in updating password. Please contact administrator.');
	            	} else if (res == 4) {
	            			$('#errors').html('Email does not match any on file. If you think this is in error, please contact administrator.');
	            	} else {
	            			console.log('Something is going wrong here');
	            	}
	            });     
			});

	$('#password').keyup(function(){
		//console.log($('#password').val());
        $('#result').html(checkStrength($('#password').val()))
    }); 

	$('#confirm_password').keyup(function(){
		//console.log($('#confirm_password').val())
		$('#confirm_result').html(checkMatch($('#password').val(), $('#confirm_password').val()))
	})

	function checkStrength(password){ 
		//initial strength 
		var strength = 0 

		//if the password length is less than 6, return message. 
		if (password.length < 6) { 
			$('#result').removeClass() 
			$('#result').addClass('short') 
			return 'Too short' } 

		//length is ok, lets continue. 

		//if length is 8 characters or more, increase strength value 
		if (password.length > 7) strength += 1 

		//if password contains both lower and uppercase characters, increase strength value 
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1 

		//if it has numbers and characters, increase strength value 
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1 

		//if it has one special character, increase strength value 

		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1 

		//if it has two special characters, increase strength value 

		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1 

		//now we have calculated strength value, we can return messages 

		//if value is less than 2 
		if (strength < 2 ) { 
			$('#result').removeClass() 
			$('#result').addClass('weak') 
			return 'Weak, add special characters (!,%,&,@,# etc.)' 
		} else if (strength == 2 ) { 
			$('#result').removeClass() 
			$('#result').addClass('good')
			return 'Good' 
		} else { 
			$('#result').removeClass() 
			$('#result').addClass('strong')
			return 'Strong' } 
	} 
	function checkMatch(password, confirm){
		var match = true;
		if (password.length == confirm.length) {
			for (var i = 0; i < confirm.length; i++) {
				if (password[i] === confirm[i]) {
					continue
				} else {
					match = false;
					$('#confirm_result').removeClass() 
					$('#confirm_result').addClass('weak') 
					return 'Passwords must match';
				}
			}
		} else {
			match = false;
			$('#confirm_result').removeClass() 
			$('#confirm_result').addClass('weak')
			$('#reset_email').removeClass()
			$('#reset_email').addClass('btn btn-primary disabled') 
			return 'Passwords must match';
		}
		if (match == true) {
			$('#confirm_result').removeClass() 
			$('#confirm_result').addClass('weak') 
			$('#reset_email').removeClass()
			$('#reset_email').addClass('btn btn-primary')
			return ''
		}
	}
//Validaiton code from: http://mrbool.com/how-to-validate-password-strength-using-jquery/26760#ixzz48NF1j600
});