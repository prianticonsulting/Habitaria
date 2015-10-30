$(window).load(function() {
	$('#slider').nivoSlider({
	  prevText: '',
	  nextText: '',
	  controlNav: false,
	});
});
	
 $(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
	  $(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
		  $('#back-top').fadeIn();
		} else {
		  $('#back-top').fadeOut();
		}
	  });

	  // scroll body to 0px on click
	  $('#back-top a').click(function () {
		$('body,html').animate({
		  scrollTop: 0
		}, 800);
		return false;
	  });
	});

});

function toggle_visibility(id) {
	 var e = document.getElementById(id);
	 if(e.style.display == 'block'){
		e.style.display = 'none';
		$('#togg').text('show footer');
	}
	 else {
		e.style.display = 'block';
		$('#togg').text('hide footer');
	}
}
	
