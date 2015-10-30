 $(function(){
  var default_view = 'grid';
  if($.cookie('view') !== 'undefined'){
	  $.cookie('view', default_view, { expires: 7, path: '/' });
  } 
  function get_grid(){
	  $('.list').removeClass('list-active');
	  $('.grid').addClass('grid-active');
	  $('.prod-cnt').animate({opacity:0},function(){
		  $('.prod-cnt').removeClass('dbox-list');
		  $('.prod-cnt').addClass('dbox');
		  $('.prod-cnt').stop().animate({opacity:1});
	  });
  }
  function get_list(){
	  $('.grid').removeClass('grid-active');
	  $('.list').addClass('list-active');
	  $('.prod-cnt').animate({opacity:0},function(){
		  $('.prod-cnt').removeClass('dbox');
		  $('.prod-cnt').addClass('dbox-list');
		  $('.prod-cnt').stop().animate({opacity:1});
	  });
  }
  if($.cookie('view') == 'list'){ 
	  $('.grid').removeClass('grid-active');
	  $('.list').addClass('list-active');
	  $('.prod-cnt').animate({opacity:0});
	  $('.prod-cnt').removeClass('dbox');
	  $('.prod-cnt').addClass('dbox-list');
	  $('.prod-cnt').stop().animate({opacity:1}); 
  } 

  if($.cookie('view') == 'grid'){ 
	  $('.list').removeClass('list-active');
	  $('.grid').addClass('grid-active');
	  $('.prod-cnt').animate({opacity:0});
		  $('.prod-cnt').removeClass('dboxlist');
		  $('.prod-cnt').addClass('dbox');
		  $('.prod-cnt').stop().animate({opacity:1});
  }

  $('#list').click(function(){   
	  $.cookie('view', 'list'); 
	  get_list()
  });

  $('#grid').click(function(){ 
	  $.cookie('view', 'grid'); 
	  get_grid();
  });

  /* filter */
  $('.menuSwitch ul li').click(function(){
	  var CategoryID = $(this).attr('category');
	  $('.menuSwitch ul li').removeClass('cat-active');
	  $(this).addClass('cat-active');
	  
	  $('.prod-cnt').each(function(){
		  if(($(this).hasClass(CategoryID)) == false){
			 $(this).css({'display':'none'});
		  };
	  });
	  $('.'+CategoryID).fadeIn(); 
	  
  });
});
