$(document).ready(function() {
var $table = $('#request_table'),
$request = $('#request'),
$remove = $('#remove'),
selections = [];

$.ajax({
	  type: "GET",
	  url: "/request/samples",
	  dataType: 'json',
	  success: function(json_data){
	    var data_array = json_data; // Do not parse json_data because dataType is 'json'
	    var arr = [];
	   	for(var x in data_array){
	 	  	arr.push(data_array[x]);
	 	}
	 	console.log('get all arr: ' + arr);

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
	var $table = $('#request_table'),
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
	                        field: 'genus',
	                        title: 'Genus',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'species',
	                        title: 'Species',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'sample_type',
	                        title: 'Sample Type',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'sex',
	                        title: 'sex',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    },{
	                        field: 'preservation_medium',
	                        title: 'Preservation Medium',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    },{
	                        field: 'sample_institution_name',
	                        title: 'Institution Name',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'sample_last_name',
	                        title: 'Contributer',
	                        sortable: true,
	                        footerFormatter: totalNameFormatter,
	                        align: 'center'
	                    }, {
	                        field: 'sample_current_country',
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
	            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
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
	        $remove.on('click', function(e){
	        	e.preventDefault();
	        	 $('#deleteModal').modal('show');
	        	});

	        $('#btnDelteYes').click(function () {
			    var ids = getIdSelections();
	            console.log('requsted ids: ' + ids);
	            var selections = {
	            	'id': ids
	            };
	            $.ajax({
	                type: "POST",
	                url: "request/delete",
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
	            $remove.prop('disabled', true);  
	            $request.prop('disabled', true);  
			    $('#deleteModal').modal('hide');
			    $table.bootstrapTable('refresh');
				});
	        $request.on('click', function(){
	        	var ids = getIdSelections();
	            console.log('email requsted ids: ' + ids);
	            var selections = {
	            	'id': ids
	            };
				$.ajax({
				  type: "POST",
				  url: "/request/select_contributer",
				  data: selections,
				  dataType: 'json',
				  success: function(json_data) {
				  	var data_array = json_data; // Do not parse json_data because dataType is 'json'
				    var options = '';
				    for (x in data_array) {
						options += "<option value=" + data_array[x]['id'] + "> "
						+ data_array[x]['first']
						+ " " 
						+ data_array[x]['last']
						+ ", " 
						+ data_array[x]['institution']
						+ ", " 
						+ data_array[x]['city']
						+ ", "
						+ data_array[x]['country'] 
						+ "</option><br>";
				    }
				 	console.log('requested successfully: ' + options);
				 	$('#contributer').html(options);				 		
					$('#choose_contributer').modal('show');
				},
					error: function(){ 
						console.log('error')
					}
				})
			});
			$( "#contributer_form" ).submit(function(e) {
			  e.preventDefault();
			   var data = $('#contributer').serialize();
					$.post('/request/email', data, function(res){
						var something = 'hello';
						arr=[];
						var data_array = JSON.parse(res);
					    for(var x in data_array){
					 	  arr.push(data_array[x]);
					 	}
					 	console.log('email data' + arr);	           
						var email = '<h5>Email From: </h5>' +
							'<input type="text" name="from_email" value="' + something +
							'"><h5>Email To: </h5>' +
							'<input type="text" name="to_email" value="' + something +
							'"><h5>Subject: </h5>' +
							'<input type="text" name="subject" value="' + something +
							'"><h5>Email Body: </h5>' +
							'<textarea name="body">Hello World!'+ something +'</textarea>';
						$("#compose").html(email);
					    $('#choose_contributer').modal('hide');
					    $('#compose_email').modal('show');
				})
			});
			$('#btnChooseContributer').on('click', function(e){
				e.preventDefault();
		        $('#contributer_form').submit(); 			
			});
	        $(window).resize(function () {
	            $table.bootstrapTable('resetView', {
	                height: getHeight()
	            });
	        });
	    };
	}
});
});