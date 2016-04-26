$(document).ready(function() {
var $table = $('#collection_table'),
$remove = $('#remove'),
$edit = $('#edit'),
arr = [];
selections = [];
var path = window.location.pathname;
$.ajax({
	  url: '/data'+path,
	  dataType: 'json',
	  success: function(json_data){
	    var data_array = json_data; // Do not parse json_data because dataType is 'json'
		    for(var x in data_array){
		 	  arr.push(data_array[x]);
		 	}
		 	console.log(arr);
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
		                        colspan: 12,
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
		                    }, {
		                        field: 'Size (mm)',
		                        title: 'Size (mm)',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'Photo Available',
		                        title: 'Photo Available',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'Lat. Decimal',
		                        title: 'Lat. Decimal',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'Long. Decimal',
		                        title: 'Long. Decimal',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'Lat. Degree',
		                        title: 'Lat. Degree',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'Long. Degree',
		                        title: 'Long. Degree',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'Avail. Until',
		                        title: 'Avail. Until',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }
		                ]
		            ]
		        });
			};
			/* !!!!!!!!!!!!!!!!!! SETUP TABLE !!!!!!!!!!!!!!!!!! */
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
			            '<a class="remove" href="javascript:void(0)" title="remove">',
			            '<i class=""></i>',
			            '</a>'
			        ].join('');
			    }
			    window.operateEvents = {
			        'click .like': function (e, value, row, index) {
			            alert('You click like action, row: ' + JSON.stringify(row));
			        },
			        'click .edit': function (e, value, row, index) {
			             $table.bootstrapTable('edit', {
			                field: 'id',
			                values: [row.id]
			            });
			        },
			        'click .remove': function (e, value, row, index) {
			            $table.bootstrapTable('remove', {
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
			        // sometimes footer render error.
			        setTimeout(function () {
			            $table.bootstrapTable('resetView');
			        }, 200);
			        $table.on('check.bs.table uncheck.bs.table ' +
			                'check-all.bs.table uncheck-all.bs.table', function () {
			            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
			            $edit.prop('disabled', !$table.bootstrapTable('getSelections').length);
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
			        $request.click(function () {
			            var ids = getIdSelections();
			            console.log('requsted ids: ' + ids);
			            var selections = {
			            	'sample_id': ids
			            };
			            // $table.bootstrapTable('request', {
			            //     field: 'id',
			            //     values: ids
			            // });
			             $.ajax({
			                type: "POST",
			                url: "samples/request",
			                data: selections,
			                cache: false,
			                success: function(res) {
			                	console.log(res);
			                	if(res == 'false') {
			                		alert('Selection already requested');
			                	} else {
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
										  	console.log('count: ' + arr.length);
										  	if(arr.length > 0) {
										  		$("#sample_requests").html('Sample Requests: <span id="request_count">('+arr.length+')</span>');
										  	} else {
										  		$("#sample_requests").html('Sample Requests');
										  	}
										  }
										});
			                	}  	
			                }
		                });
			            $request.prop('disabled', true);
			        });
			        $(window).resize(function () {
			            $table.bootstrapTable('resetView', {
			                height: getHeight()
			            });
			        });
			},
		});
		});