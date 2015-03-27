var currentItem = -1; 
var previousItem = -1;
var currentState;

function closeHpPlayer() {
  if (player.getConfig().state == "PLAYING") {
    msg = "Audio is still playing! Are you sure you want to leave this page?";
    return msg; // Firefox
  } 
}


$(document).ready(function() {
  var uAgent = navigator.userAgent;
  if(uAgent.search("Chrome") == -1) {  /*if the browser ain't chrome */ 
    window.resizeTo(420, 590); /* the 110 px  is for the browser status bar & toolbar, etc */
  }
  window.onbeforeunload = closeHpPlayer;
});



function playerReady(thePlayer) { 
  player = document.getElementById(thePlayer.id); 
  addListeners();
}


function stateListener(obj) { 
    currentState = obj.newstate; 
    previousState = obj.oldstate;

    if((currentState == "COMPLETED") && (currentItem > (player.getPlaylist().length -2))) {
	/* if playlist is over */
      forwardPlayer();
    }
    /*if player is not playing, then it's okay to close the window. */    /*this code doesn't work, for some reason  -- or it works when it's commented out. */
/*    if(currentState == "PAUSED") { window.onbeforeunload = null; }
    else { window.onbeforeunload = closeHpPlayer; } 
    if(currentState == "PLAYING") { window.onbeforeunload = closeHpPlayer; }*/
}
 
 
function addListeners() {
  if (player) { 
    player.addControllerListener("ITEM", "itemListener");
    player.addModelListener("STATE", "stateListener");
  } else {
    setTimeout("addListeners()",100);
  }
}

 
function itemListener(obj) { 
  if (obj.index != currentItem) {
    previousItem = currentItem;
    currentItem = obj.index;
 
    getPlaylistData(currentItem);
  }
}
 


function getPlaylistData(theIndex) {
  var plst = null;
  plst = player.getPlaylist();
 
  if (plst) {

    var txt = '';

    txt += '<div class="player-playlist">';
    for(var i = theIndex - 1; i <= theIndex + 1; i++) {
      if(plst[i]) {  

	if(i == theIndex) {
	  txt += '<div class="player-playlist-item now">';
	  txt += '<div class="player-status">Now Playing</div>';
	} else if(i < theIndex) {
	  txt += '<div class="player-playlist-item past">';
	  txt += '<div class="player-status">&nbsp;</div>';
	} else {
	  txt += '<div class="player-playlist-item future">';
	  txt += '<div class="player-status">&nbsp;</div>';
	}

	txt += '<div class="player-no">Track '+(i+1)+':</div>';
	txt += '<div class="player-title">'+plst[i].title+'</div>';
	//txt += '<div class="player-artist">'+plst[i].description+'</div>';
	txt += ' - <div class="player-author">'+plst[i].author+'</div>';
	//txt += '<div class="player-file">'+plst[theIndex].file+'</div>';
	//txt += '<div class="player-image">'+plst[theIndex].image+'</div>';
	//txt += '<div class="player-divnk">'+plst[theIndex].divnk+'</div>';
	//txt += '<div class="player-description">'+plst[theIndex].description+'</div>';
	txt += '</div>';
 
      }
    }
    txt += '</div>';

   var tmp = document.getElementById("plstDat");
    if (tmp) { tmp.innerHTML = txt; }
  }   
}
 
