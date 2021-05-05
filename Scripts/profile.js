var exit = $('#exit'); //Кнопка для закрытия окна
var edit = $('#edit'); //Кнопка для всплытия окна

$(document).ready(function(){
	
	edit.click(function(){
		$('.data_change').fadeIn();
		
	});
	
	exit.click(function(){
		$('.data_change').fadeOut();
	});
});