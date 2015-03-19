
/*
 * Toolbox @copyright from imagefield_crop module with some minor modifications.
 * To be used with Jquery UI.
 */

$(document).ready(function(){

	if ($('#resizeMe').resizable) {	
	
	  $('#resizeMe').resizable({
		containment: $('#image-crop-container'),
		//transparent: true,
		aspectRatio: Drupal.settings.imagecrop.aspectRatio,
		autohide: true,
		handles: 'n, e, s, w, ne, se, sw, nw',

		resize: function(e, ui) {
		  
		  var curr_width = $('#resizeMe').width();
		  var curr_height = $('#resizeMe').height();
      if (curr_width < Drupal.settings.imagecrop.minWidth) {
        curr_width = Drupal.settings.imagecrop.minWidth;
        $('#resizeMe').width(curr_width + 'px');
        if (Drupal.settings.imagecrop.aspectRatio !== false) {
          curr_height = Drupal.settings.imagecrop.minWidth / Drupal.settings.imagecrop.aspectRatio;
          $('#resizeMe').height(curr_height + 'px');
        }
      }
      else if (curr_height < Drupal.settings.imagecrop.minHeight ) {
        curr_height = Drupal.settings.imagecrop.minHeight;
        $('#resizeMe').height(curr_height + 'px');
        if (Drupal.settings.imagecrop.aspectRatio !== false) {
          curr_width = Drupal.settings.imagecrop.minHeight * Drupal.settings.imagecrop.aspectRatio;
          $('#resizeMe').width(curr_width + 'px');
        }
      }
      
      var left = (ui.position.left > 0) ? ui.position.left : 0;
      var top = (ui.position.top > 0) ? ui.position.top : 0;
      this.style.backgroundPosition = '-' + left + 'px -' + top + 'px';
      $("#edit-image-crop-x").val(left);
      $("#edit-image-crop-y").val(top);		  
      
		  $("#edit-image-crop-width").val(curr_width);
		  $("#edit-image-crop-height").val(curr_height);

      if (curr_width < Drupal.settings.imagecrop.width || curr_height < Drupal.settings.imagecrop.height ) {
        $(this).addClass('boxwarning');
      }
      else {
        $(this).removeClass('boxwarning');
      }

		},
		stop: function(e, ui) {
  		  this.style.backgroundPosition = '-' + (ui.position.left) + 'px -' + (ui.position.top) + 'px';
  	    }
	  });
	  
	}

	$('#resizeMe').draggable({
		cursor: 'move',
		containment: $('#image-crop-container'),
		drag: function(e, ui) {
		  var left = (ui.position.left > 0) ? ui.position.left : 0;
		  var top = (ui.position.top > 0) ? ui.position.top : 0;
		  this.style.backgroundPosition = '-' + left + 'px -' + top + 'px';
		  $("#edit-image-crop-x").val(left);
		  $("#edit-image-crop-y").val(top);
		}
	});
	
	$('#image-crop-container').css({ opacity: 0.5 });
	$('#resizeMe').css({ position : 'absolute' });
	
    var leftpos = $('#edit-image-crop-x').val();
    var toppos = $('#edit-image-crop-y').val();
    $("#resizeMe").css({backgroundPosition: '-'+ leftpos + 'px -'+ toppos +'px'});
    $("#resizeMe").width($('#edit-image-crop-width').val() + 'px');
    $("#resizeMe").height($('#edit-image-crop-height').val() + 'px');
    $("#resizeMe").css({top: $('#edit-image-crop-y').val() +'px' });
    $("#resizeMe").css({left: $('#edit-image-crop-x').val() +'px' });
    
});
