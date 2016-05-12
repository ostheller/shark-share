$(document).ready(function() {
var form1, form2, form3;

	$('#password').keyup(function(){
		//console.log($('#password').val());
        $('#result').html(checkStrength($('#password').val()))
    }); 

	function checkStrength(password){ 
		//initial strength 
		var strength = 0 

		//if the password length is less than 6, return message. 
		if (password.length < 7) { 
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
/* !!!!!!!!!!!!!!!!!! GENUS AJAX !!!!!!!!!!!!!!!!!! */

$.ajax({
  url: "/autofill/genus",
  dataType: 'json',
  success: function(json_data){
    var data_array = json_data; // Do not parse json_data because dataType is 'json'
    var arr = [];
    for(var x in data_array){
 	  arr.push(data_array[x]['taxonomy_genus']);
 	}

	var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	    var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        matches.push(str);
	      }
	    });

	    cb(matches);
	  };
	};

	$('#genus').typeahead({
	  hint: true,
	  highlight: true,
	  minLength: 1
	},
	{
	  name: 'arr',
	  source: substringMatcher(arr)
	});
	}, // end success,
	  error: function() {
	    alert("BAD");
	  }
});

/* !!!!!!!!!!!!!!!!!! SPECIES AJAX !!!!!!!!!!!!!!!!!! */
$.ajax({
  url: "/autofill/species",
  dataType: 'json',
  success: function(json_data){
    var data_array = json_data; // Do not parse json_data because dataType is 'json'
    var arr = [];
    for(var x in data_array){
 	  arr.push(data_array[x]['taxonomy_species']);
 	}

	var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	    var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        matches.push(str);
	      }
	    });

	    cb(matches);
	  };
	};

	$('#species').typeahead({
	  hint: true,
	  highlight: true,
	  minLength: 1
	},
	{
	  name: 'arr',
	  source: substringMatcher(arr)
	});
	}, // end success,
	  error: function() {
	    alert("BAD");
	  }
});

/* !!!!!!!!!!!!!!!!!! SUBMIT SET UP PROFILE FORM !!!!!!!!!!!!!!!!!! */
	$('#setup_password').on('click', function(e){
		e.preventDefault();
		$( "#setup" ).submit();
	})

$('#setup').submit(function(e){
	e.preventDefault();
	var data = $('#setup').serialize();
	console.log(data);
	$.post('/setup/submit', data, function(res){
		console.log(res);
		$( "#password_result" ).html('<i class="glyphicon glyphicon-check"></i>');
		$('#verify_changes').removeClass()
		$('#verify_changes').addClass('btn btn-primary submit')
		form1 = true;
		checkstatus();
	});
});
//  !!!!!!!!!!!!!!!!!! SUBMIT SET UP VERIFY FORM !!!!!!!!!!!!!!!!!! 
$('#verify_changes').on('click', function(e){
	e.preventDefault();
	$( "#verify" ).submit();
})


$('#verify').submit(function(e){
	e.preventDefault();
	var data = $('#verify').serialize();
	console.log(data);
	$.post('/update/user', data, function(res){
		console.log(res);
		$( "#verify_result" ).html('<i class="glyphicon glyphicon-check"></i>');
		$('#submit_tags').removeClass()
		$('#submit_tags').addClass('btn btn-primary submit')
		form2 = true;
		checkstatus();
	});
});

/* !!!!!!!!!!!!!!!!!! SUBMIT SET UP PREFERNCES FORM !!!!!!!!!!!!!!!!!! */
$('#setup_tags').on('click', function(e){
	e.preventDefault();
	$( "#tags" ).submit();
	$( "#tags_result" ).html('<i class="glyphicon glyphicon-check"></i>');
	form3 = true;
	checkstatus();
})

$('#tags').on('submit', function(e){
	e.preventDefault();
	var data = $('#tags').serialize();
	console.log(data);
	$.post('/setup/tags', data, function(res){
		var data_array = JSON.parse(res);
	    console.log(data_array);
	});
});

/* !!!!!!!!!!!!!!!!!! Move to the Main Site !!!!!!!!!!!!!!!!!! */
function checkstatus(){
	console.log(form1 + form2 + form3);
	if (form1 == true && form2 == true && form3 == true) {
		$('#success_button').removeClass()
		$('#success_button').addClass('btn btn-lg btn-success')
	}
}
});