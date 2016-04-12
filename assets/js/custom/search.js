$(document).ready(function() {

/* !!!!!!!!!!!!!!!!!! GENUS AJAX !!!!!!!!!!!!!!!!!! */

$.ajax({
  url: "autofill/genus",
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
  url: "autofill/species",
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

/* !!!!!!!!!!!!!!!!!! FAMILY AJAX !!!!!!!!!!!!!!!!!! */
$.ajax({
  url: "autofill/family",
  dataType: 'json',
  success: function(json_data){
    var data_array = json_data; // Do not parse json_data because dataType is 'json'
    var arr = [];
    for(var x in data_array){
 	  arr.push(data_array[x]['taxonomy_family']);
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

	$('#family').typeahead({
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

/* !!!!!!!!!!!!!!!!!! ORDER AJAX !!!!!!!!!!!!!!!!!! */
$.ajax({
  url: "autofill/order",
  dataType: 'json',
  success: function(json_data){
    var data_array = json_data; // Do not parse json_data because dataType is 'json'
    var arr = [];
    for(var x in data_array){
 	  arr.push(data_array[x]['taxonomy_order']);
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

	$('#order').typeahead({
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

/* !!!!!!!!!!!!!!!!!! FORM SUBMIT !!!!!!!!!!!!!!!!!! */

$('#search').on('submit', function(e){
//	e.preventDefault();
	var data = $('#search_submit').serialize();
	console.log(data);
	$.post('/search', data, function(res){
		console.log('made it');
	})
})

});