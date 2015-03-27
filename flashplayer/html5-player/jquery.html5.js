$(document).ready(function(){

  var isiPad = navigator.userAgent.match(/iPad/i) != null;
 
  var playItem = 0;
 

  // Local copy of jQuery selectors, for performance.
  var jpPlayTime = $("#jplayer_play_time");
  var jpTotalTime = $("#jplayer_total_time");
 
  $("#jquery_jplayer").jPlayer({
    ready: function() {
      displayPlayList();
      playListInit(true); // Parameter is a boolean for autoplay.
    },
    oggSupport: true
  })
  .jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
    jpPlayTime.text($.jPlayer.convertTime(playedTime));
    jpTotalTime.text($.jPlayer.convertTime(totalTime));
 
  })
  .jPlayer("onSoundComplete", function() {
    playListNext();
    if (isiPad ==true) { 
      $j("#jquery_jplayer").jPlayer("pause"); 
    } 
  });
 
  $("#jplayer_previous").click( function() {
    playListPrev();
    $(this).blur();
    return false;
  });
 
  $("#jplayer_next").click( function() {
    playListNext();
    $(this).blur();
    return false;
  });
 
  function displayPlayList() {
    $("#jplayer_playlist ul").empty();
    for (i=0; i < myPlayList.length; i++) {
      var listItem = (i == myPlayList.length-1) ? "<li class='jplayer_playlist_item_last'>" : "<li>";
      listItem += "<span class='jplayer_playlist_item_status'>Now Playing</span><span class='jplayer_playlist_item_no'>Track "+i+":</span><span class='jplayer_playlist_item' id='jplayer_playlist_item_"+i+"' tabindex='1'>"+ myPlayList[i].name +"</span></li>";
      $("#jplayer_playlist ul").append(listItem);
      $("#jplayer_playlist_item_"+i).data( "index", i ).click( function() {
//er disable clicking. 
/*
	var index = $(this).data("index");
	if (playItem != index) {
	  playListChange( index );
	} else {
	  $("#jquery_jplayer").jPlayer("play");
	}
	$(this).blur();
	return false; */
      });
    }
  }
 
  function playListInit(autoplay) {
    if(autoplay) {
      playListChange( playItem );
    } else {
      playListConfig( playItem );
    }
  }
 
  function playListConfig( index ) {
    $("#jplayer_playlist_item_"+playItem).parent().removeClass("jplayer_playlist_current");

    $(".jplayer_playlist_current").removeClass("jplayer_playlist_current");
    $(".jplayer_playlist_next").removeClass("jplayer_playlist_next");
    $(".jplayer_playlist_prev").removeClass("jplayer_playlist_prev");

    $("#jplayer_playlist_item_"+(index-1)).parent().addClass("jplayer_playlist_prev");
    $("#jplayer_playlist_item_"+(index-1)).parent().addClass("jplayer_playlist_prev");
    $("#jplayer_playlist_item_"+index).parent().addClass("jplayer_playlist_current");
    $("#jplayer_playlist_item_"+(index+1)).parent().addClass("jplayer_playlist_next");

    playItem = index;
    $("#jquery_jplayer").jPlayer("setFile", myPlayList[playItem].mp3);
  }
 
  function playListChange( index ) {
    playListConfig( index );
    $("#jquery_jplayer").jPlayer("play");
  }
 
  function playListNext() {
    var index = (playItem+1 < myPlayList.length) ? playItem+1 : 0;
    playListChange( index );
  }
 
  function playListPrev() {
    var index = (playItem-1 >= 0) ? playItem-1 : myPlayList.length-1;
    playListChange( index );
  }
});

