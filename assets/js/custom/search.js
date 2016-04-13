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
// $.ajax({
//   url: "autofill/family",
//   dataType: 'json',
//   success: function(json_data){
//     var data_array = json_data; // Do not parse json_data because dataType is 'json'
//     var arr = [];
//     for(var x in data_array){
//  	  arr.push(data_array[x]['taxonomy_family']);
//  	}

// 	var substringMatcher = function(strs) {
// 	  return function findMatches(q, cb) {
// 	    var matches, substringRegex;

// 	    // an array that will be populated with substring matches
// 	    matches = [];

// 	    // regex used to determine if a string contains the substring `q`
// 	    substrRegex = new RegExp(q, 'i');

// 	    // iterate through the pool of strings and for any string that
// 	    // contains the substring `q`, add it to the `matches` array
// 	    $.each(strs, function(i, str) {
// 	      if (substrRegex.test(str)) {
// 	        matches.push(str);
// 	      }
// 	    });

// 	    cb(matches);
// 	  };
// 	};

// 	$('#family').typeahead({
// 	  hint: true,
// 	  highlight: true,
// 	  minLength: 1
// 	},
// 	{
// 	  name: 'arr',
// 	  source: substringMatcher(arr)
// 	});
// 	}, // end success,
// 	  error: function() {
// 	    alert("BAD");
// 	  }
// });

/* !!!!!!!!!!!!!!!!!! ORDER AJAX !!!!!!!!!!!!!!!!!! */
// $.ajax({
//   url: "autofill/order",
//   dataType: 'json',
//   success: function(json_data){
//     var data_array = json_data; // Do not parse json_data because dataType is 'json'
//     var arr = [];
//     for(var x in data_array){
//  	  arr.push(data_array[x]['taxonomy_order']);
//  	}

// 	var substringMatcher = function(strs) {
// 	  return function findMatches(q, cb) {
// 	    var matches, substringRegex;

// 	    // an array that will be populated with substring matches
// 	    matches = [];

// 	    // regex used to determine if a string contains the substring `q`
// 	    substrRegex = new RegExp(q, 'i');

// 	    // iterate through the pool of strings and for any string that
// 	    // contains the substring `q`, add it to the `matches` array
// 	    $.each(strs, function(i, str) {
// 	      if (substrRegex.test(str)) {
// 	        matches.push(str);
// 	      }
// 	    });

// 	    cb(matches);
// 	  };
// 	};

// 	$('#order').typeahead({
// 	  hint: true,
// 	  highlight: true,
// 	  minLength: 1
// 	},
// 	{
// 	  name: 'arr',
// 	  source: substringMatcher(arr)
// 	});
// 	}, // end success,
// 	  error: function() {
// 	    alert("BAD");
// 	  }
// });

/* !!!!!!!!!!!!!!!!!! FORM SUBMIT !!!!!!!!!!!!!!!!!! */
$('#search').on('submit', function(e){
	e.preventDefault();
	var data = $('#search').serialize();
	$.post('/search', data, function(res){
		var data_array = JSON.parse(res);
	    var arr = [];
	    for(var x in data_array){
	 	  arr.push(data_array[x]);
	 	}
	 	console.log(arr);

		function getIdSelections() {
	        return $.map($table.bootstrapTable('getSelections'), function (row) {
	            return row.id
	        });
	    }
	    function responseHandler(res) {
	        $.each(res.rows, function (i, row) {
	            row.state = $.inArray(row.id, selections) !== -1;
	        });
	        return res;
	    }
	    function detailFormatter(index, row) {
	        var html = [];
	        $.each(row, function (key, value) {
	            html.push('<p><b>' + key + ':</b> ' + value + '</p>');
	        });
	        console.log(html.join(''));
	        return html.join('');
	    }
	    function operateFormatter(value, row, index) {
	        return [
	            '<a class="like" href="javascript:void(0)" title="Like">',
	            '<i class="glyphicon glyphicon-heart"></i>',
	            '</a>  ',
	            '<a class="request" href="javascript:void(0)" title="request">',
	            '<i class=""></i>',
	            '</a>'
	        ].join('');
	    }
	    window.operateEvents = {
	        'click .like': function (e, value, row, index) {
	            alert('You click like action, row: ' + JSON.stringify(row));
	        },
	        'click .request': function (e, value, row, index) {
	            $table.bootstrapTable('request', {
	                field: 'id',
	                values: [row.id]
	            });
	        }
	    };
	    function totalTextFormatter(data) {
	        return 'Total';
	    }
	    function totalNameFormatter(data) {
	        return data.length;
	    }
	    function totalPriceFormatter(data) {
	        var total = 0;
	        $.each(data, function (i, row) {
	            total += +(row.price.substring(1));
	        });
	        return '$' + total;
	    }
	    function getHeight() {
	        return $(window).height() - $('h1').outerHeight(true);
	    }
	    $(function () {
	        var scripts = [
	                location.search.substring(1) || 'assets/bootstrap-table/src/bootstrap-table.js',
	                'assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js',
	                'http://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js',
	                'assets/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js',
	                'http://rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/js/bootstrap-editable.js'
	            ],
	            eachSeries = function (arr, iterator, callback) {
	                callback = callback || function () {};
	                if (!arr.length) {
	                    return callback();
	                }
	                var completed = 0;
	                var iterate = function () {
	                    iterator(arr[completed], function (err) {
	                        if (err) {
	                            callback(err);
	                            callback = function () {};
	                        }
	                        else {
	                            completed += 1;
	                            if (completed >= arr.length) {
	                                callback(null);
	                            }
	                            else {
	                                iterate();
	                            }
	                        }
	                    });
	                };
	                iterate();
	            };
	        eachSeries(scripts, getScript, initTable);
	    });
	    function getScript(url, callback) {
	        var head = document.getElementsByTagName('head')[0];
	        var script = document.createElement('script');
	        script.src = url;
	        var done = false;
	        // Attach handlers for all browsers
	        script.onload = script.onreadystatechange = function() {
	            if (!done && (!this.readyState ||
	                    this.readyState == 'loaded' || this.readyState == 'complete')) {
	                done = true;
	                if (callback)
	                    callback();
	                // Handle memory leak in IE
	                script.onload = script.onreadystatechange = null;
	            }
	        };
	        head.appendChild(script);
	        // We handle everything using the script element injection
	        return undefined;
	    }
	var $table = $('#search_results_table'),
	        $request = $('#request'),
	        selections = [];
	    function initTable() {
	        $table.bootstrapTable({
	        	data: arr,
	            height: getHeight(),
	            columns: [
	                [
	                    {
	                        field: 'state',
	                        checkbox: true,
	                        rowspan: 2,
	                        align: 'center',
	                        valign: 'middle'
	                    }, {
	                        title: 'ID',
	                        field: 'id',
	                        rowspan: 2,
	                        align: 'center',
	                        valign: 'middle',
	                        sortable: true,
	                        footerFormatter: totalTextFormatter
	                    }, {
	                        title: 'Item Detail',
	                        colspan: 5,
	                        align: 'center'
	                    }, {
	                        title: 'Location',
	                        colspan: 3,
	                        align: 'center'
	                    }
	                ],
	                [
	                    {
	                        field: 'Genus',
	                        title: 'Genus',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'Species',
	                        title: 'Species',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'Sample Type',
	                        title: 'Sample Type',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'Sex',
	                        title: 'Sex',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    },{
	                        field: 'Preservation Medium',
	                        title: 'Preservation Medium',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    },{
	                        field: 'Institution Name',
	                        title: 'Institution Name',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'Last Name',
	                        title: 'Contributer',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'Current Country Location',
	                        title: 'Current Country Location',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }
	                ]
	            ]
	        });
	        // sometimes footer render error.
	        setTimeout(function () {
	            $table.bootstrapTable('resetView');
	        }, 200);
	        $table.on('check.bs.table uncheck.bs.table ' +
	                'check-all.bs.table uncheck-all.bs.table', function () {
	            $request.prop('disabled', !$table.bootstrapTable('getSelections').length);
	            // save your data, here just save the current page
	            selections = getIdSelections();
	            // push or splice the selections if you want to save all data selections
	        });
	        $table.on('expand-row.bs.table', function (e, index, row, $detail) {
	            var html = [];
	            $.each(row, function (key, value) {
	            html.push('<p>' + key + ': ' + value + '</p>');
		        });
		        console.log(html.join(''));
		        $data = html.join('');
	            $detail.html($data);
	        });
	        $table.on('all.bs.table', function (e, name, args) {
	            console.log(name, args);
	        });
	        $request.click(function () {
	            var ids = getIdSelections();
	            $table.bootstrapTable('request', {
	                field: 'id',
	                values: ids
	            });
	            $request.prop('disabled', true);
	        });
	        $(window).resize(function () {
	            $table.bootstrapTable('resetView', {
	                height: getHeight()
	            });
	        });
	    }
	})
})
});