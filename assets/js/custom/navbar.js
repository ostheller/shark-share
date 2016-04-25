$(document).ready(function() {
 console.log('doing ajax');
	$.ajax({
	  type: "GET",
	  url: "/request/count",
	  dataType: 'json',
	  success: function(json_data){
	  	var data_array = json_data; // Do not parse json_data because dataType is 'json'
	    var arr = [];
	   	for(var x in data_array){
	 	  	arr.push(data_array[x]);
	 	}
	  	console.log('count: ' + arr);
	  	if(arr > 0) {
	  		$("#sample_requests").append('<span id="request_count">('+arr+')</span>');
	  	}
	  }
	});
});