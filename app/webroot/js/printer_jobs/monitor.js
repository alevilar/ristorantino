

   var fs = require('fs'),
    	os = require('os'),
		sys = require('sys'),
		exec = require('child_process').exec;

	var child;
	
	var $activity = $('#activity');
	
	function getPrinterJobs () {
		$.getJSON("http://localhost/chocha012/printer_jobs/index.json")
			.done(function(data){
				var $el = $("<li>Nuevo coso</li>");
				$el.appendTo($activity);
				console.info("vino la data esta: %o", data);

				child = exec("./spooler -p NOMBRE -f ARCHIVO", function (error, stdout, stderr) {

				});
			})
			.error(function(err, coss){
				console.info("Hay erro %o y cos %o", err, coss);
			}); 
	}
	

	
	getPrinterJobs();
	setInterval(function(){
		getPrinterJobs();
	}, reloadInterval); // cada 3 segundos
