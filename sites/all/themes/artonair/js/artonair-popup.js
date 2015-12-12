$( window ).load(function() {
  var listen = $('#listennow');
  if(!$.cookie('clocktower_stream')) {
    listen[0].click();
    $.cookie("clocktower_stream", 1, { expires : 1 });
  }
});