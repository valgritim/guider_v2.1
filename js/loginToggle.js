jQuery(document).ready(function($){
	
	var screen = $(window);

	if(screen.width() > 740){
		// je cache le formulaire d'inscription à l'ouverture de la page
		document.getElementById('registerFormL');

		$('#registerFormL').hide();

		$('#registerBtnDisplayL').on('click', function(){

			//$('#registerMessageL').fadeOut();
			$('#registerMessageL,#registerBtnDisplayL').hide('slide',{direction:"up"}, 700)
			
			$('#registerFormL').delay(750).show('slide',{direction:'up'},700);

		

		});
	}
	if(screen.width() < 740){
		// je cache le formulaire d'inscription à l'ouverture de la page
		document.getElementById('registerFormS');

		$('#registerFormS').hide();

		$('#registerBtnDisplayS').on('click', function(){

			//$('#registerMessageL').fadeOut();
			$('#registerMessageS,#registerBtnDisplayS').hide('slide',{direction:"up"}, 700)
			
			$('#registerFormS').delay(750).show('slide',{direction:'up'},700);
			

		

		});
	}



});