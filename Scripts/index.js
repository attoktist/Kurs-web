var exit = $('#exit'); //Кнопка для закрытия окна
var enter = $('#enter_i'); //Кнопка для всплытия окна

$(document).ready(function(){
	
	enter.click(function(){
		$('.okno').fadeIn();
		
	});
	
	exit.click(function(){
		$('.okno').fadeOut();
	});
});