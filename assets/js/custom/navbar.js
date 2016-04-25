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
});