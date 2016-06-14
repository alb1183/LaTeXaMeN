//	Tamano en mb o caca..
function filesize(size)
{
	var sizefinalnum = size;
	var sizefinalsuf = 0;
		if(sizefinalnum > 1024){
			sizefinalnum = sizefinalnum / 1024
			var original = parseFloat(sizefinalnum);
			var result = Math.round(original * 100) / 100;
			var sizefinal = result + " Kb"
		}
		if(sizefinalnum > 1024){
			sizefinalnum = sizefinalnum / 1024
			var original = parseFloat(sizefinalnum);
			var result = Math.round(original * 100) / 100;
			var sizefinal = result + " Mb"
		}
		if(sizefinalnum > 1024){
			sizefinalnum = sizefinalnum / 1024
			var original = parseFloat(sizefinalnum);
			var result = Math.round(original * 100) / 100;
			var sizefinal = result + " Gb"
		}
	return sizefinal;
}

function randomIntFromInterval(min,max)
{
	return Math.floor(Math.random()*(max-min+1)+min);
}

function problemas_add(id) {
	var problemas = Cookies.get('problemas');
	if(problemas) {
		// Compruebo si el problema ya esta añadido.
		var problems = problemas.split(',')
		for (var i in problems) {
		  if(id == problems[i]) {
			  alert("El problema ya esta añadido.");
			  return;
		  }
		}
		problemas = problemas + ',' + id;
		Cookies.set('problemas', problemas)
	} else {
		Cookies.set('problemas', id)
	}
	$("#problem_" + id).addClass('row_selected');
	$("#problemas_add_" + id).hide();
	$("#problemas_remove_" + id).show();
}

function problemas_remove(id) {
	var problemas = Cookies.get('problemas');
	if(problemas) {
		var problems = problemas.split(',')
		/*for (var i in problems) {
		  if(id != problems[i]) {
			  
		  }
		}*/
		var index = problems.indexOf("" + id + "");
		if (index > -1) {
			problems.splice(index, 1);
		}
		var problemas_f = problems.toString();
		Cookies.set('problemas', problemas_f)
		
		$("#problem_" + id).removeClass('row_selected');
		$("#problemas_remove_" + id).hide();
		$("#problemas_add_" + id).show();
	} else {
		alert("No hay problemas.");
	};
}

function preambulo_cambiar(id) {
	var preambulo = Cookies.get('preambulo');
	if(preambulo) {
		$("#pream_" + preambulo).removeClass('row_selected');
		Cookies.set('preambulo', id);
		$("#pream_" + id).addClass('row_selected');
	} else {
		Cookies.set('preambulo', id)
	}
}

