$(document).ready(function() {
var $table = $('#sent_requests'),
arr = [];
selections = [];

$.ajax({
  url: "request/pending",
  dataType: 'json',
  success: function(json_data){
	  	console.log(json_data);
	    var data_array = json_data; // Do not parse json_data because dataType is 'json'
		    for(var x in data_array){
		 	  arr.push(data_array[x]);
		 	}
		 	console.log('requests' + arr);
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
		                    //     title: 'ID',
		                    //     field: 'id',
		                    //     rowspan: 2,
		                    //     align: 'center',
		                    //     valign: 'middle',
		                    //     sortable: true,
		                    //     footerFormatter: totalTextFormatter
		                   	// }, {
		                        title: 'Contributer Data',
		                        colspan: 5,
		                        align: 'center'
		                    }, {
		                        title: 'Item Detail',
		                        colspan: 5,
		                        align: 'center'
		                    }
		                ],
		                [
		                    {
		                    	field: 'sample_first_name',
		                        title: 'Contributer Name',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                        field: 'sample_last_name',
		                        title: 'Contributer Last Name',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
		                    	field: 'sample_institution_name',
		                        title: 'Institution Name',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    },{
		                    field: 'sample_institution_city',
		                        title: 'Institution City',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    },{
		                    	field: 'sample_email',
		                        title: 'Contributer Email',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    }, {
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
		                        title: 'Sex',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                    },{
		                        field: 'preservation_medium',
		                        title: 'Preservation Medium',
		                        sortable: true,
		                        footerFormatter: totalNameFormatter,
		                        align: 'center'
		                   }
		                ]
		            ]
		        });
			}
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
			        $(window).resize(function () {
			            $table.bootstrapTable('resetView', {
			                height: getHeight()
			            });
			        });
				},
		});
});