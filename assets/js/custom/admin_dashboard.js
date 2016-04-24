$(document).ready(function() {
	var $table = $('#potential_user_table'),
	$table2 = $('#email_sent_table'),
	$approve = $('#approve'),
	$reject = $('#reject'),
	selections = [];

	$.ajax({
	  type: "GET",
	  url: "admin/view/potential_users",
	  dataType: 'json',
	  success: function(json_data){
	    var data_array = json_data; // Do not parse json_data because dataType is 'json'
	    var arr = [];
	    var approved_arr = [];
	    for(var x in data_array){
	 	  if(data_array[x]['Token'] === null ) {
	 	  	arr.push(data_array[x]);
	 	  	console.log('pending: '+ data_array[x]['First Name']);
	 	  } else {
	 	  	approved_arr.push(data_array[x]);
	 	  	console.log('approved: ' + data_array[x])
	 	  } 	
	 	}
	 	console.log('arr: ' + arr);
	 	console.log('approved_arr: ' + approved_arr);
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
	            '<a class="state" href="javascript:void(0)" title="state">',
	            '<i class=""></i>',
	            '</a>'
	        ].join('');
	    }
	window.operateEvents = {
	        'click .like': function (e, value, row, index) {
	            alert('You click like action, row: ' + JSON.stringify(row));
	        },
	        'click .state': function (e, value, row, index) {
	            $table.bootstrapTable('state', {
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
                    }
                    , {
                        title: 'Item Detail',
                        colspan: 9,
                        align: 'center'
                    }
                ],
                [
                    {
                        field: 'First Name',
                        title: 'First Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Last Name',
                        title: 'Last Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Email',
                        title: 'Email',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Field',
                        title: 'Field',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    },{
                        field: 'Institution Name',
                        title: 'Institution Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    },{
                    	field: 'Institution City',
                        title: 'Institution City',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    },{
                        field: 'Academic Status',
                        title: 'Academic Status',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Reference Name',
                        title: 'Reference Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Reference Email',
                        title: 'Reference Email',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }
                ]
            ]
        });
		$table2.bootstrapTable({
        	data: approved_arr,
            height: getHeight(),
            columns: [
                [
                    {
                        title: 'ID',
                        field: 'id',
                        rowspan: 2,
                        align: 'center',
                        valign: 'middle',
                        sortable: true,
                        footerFormatter: totalTextFormatter
                    }
                    , {
                        title: 'Item Detail',
                        colspan: 4,
                        align: 'center'
                    }
                ],
                [
                    {
                        field: 'First Name',
                        title: 'First Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Last Name',
                        title: 'Last Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Email',
                        title: 'Email',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'Institution Name',
                        title: 'Institution Name',
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
	            $approve.prop('disabled', !$table.bootstrapTable('getSelections').length);
	            $reject.prop('disabled', !$table.bootstrapTable('getSelections').length);
	            // save your data, here just save the current page
	            selections = getIdSelections();
	            console.log(selections);
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
	        $approve.click(function () {
	            var ids = getIdSelections();
	            console.log('requsted ids: ' + ids);
	            var selections = {
	            	'id': ids
	            };
	            $.ajax({
	                type: "POST",
	                url: "admin/admit/potential_users",
	                data: selections,
	                cache: false,
	                success: function(res) {
	                	console.log(res + 'admitted successfully');
	                }
                });
	            $table.bootstrapTable('remove', {
	                field: 'id',
	                values: ids
	            });
	            $reject.prop('disabled', true);  
	            $approve.prop('disabled', true);
	            $table2.bootstrapTable('refresh', {
	            	url: "admin/view/potential_users"
	            })  
	        });
	        $reject.on('click', function(e){
	        	e.preventDefault();
	        	 $('#myModal').modal('show');
	        	});

	        $('#btnDelteYes').click(function () {
			    var ids = getIdSelections();
	            console.log('requsted ids: ' + ids);
	            var selections = {
	            	'id': ids
	            };
	            $.ajax({
	                type: "POST",
	                url: "admin/reject/potential_users",
	                data: selections,
	                cache: false,
	                success: function(res) {
	                	console.log('removed successfully');
	                }
                });
	            $table.bootstrapTable('remove', {
	                field: 'id',
	                values: ids
	            });
	            $reject.prop('disabled', true);  
	            $approve.prop('disabled', true);  
			    $('#myModal').modal('hide');
				});
	            
	        $(window).resize(function () {
	            $table.bootstrapTable('resetView', {
	                height: getHeight()
	            });
	        });
			// sometimes footer render error.
	        setTimeout(function () {
	            $table2.bootstrapTable('resetView');
	        }, 200);
	        $table2.on('check.bs.table uncheck.bs.table ' +
	                'check-all.bs.table uncheck-all.bs.table', function () {
	            // $approve.prop('disabled', !$table.bootstrapTable('getSelections').length);
	            // $reject.prop('disabled', !$table.bootstrapTable('getSelections').length);
	            // save your data, here just save the current page
	            selections = getIdSelections();
	            console.log(selections);
	        });
	        $table2.on('expand-row.bs.table', function (e, index, row, $detail) {
	            var html = [];
	            $.each(row, function (key, value) {
	            html.push('<p>' + key + ': ' + value + '</p>');
		        });
		        console.log(html.join(''));
		        $data = html.join('');
	            $detail.html($data);
	        });
	        $table2.on('all.bs.table', function (e, name, args) {
	            console.log(name, args);
	        });
	        $(window).resize(function () {
	            $table2.bootstrapTable('resetView', {
	                height: getHeight()
	            });
	        });
	    }
	}
});
});