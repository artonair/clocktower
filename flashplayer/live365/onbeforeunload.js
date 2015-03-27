function closeBrPlayer() {
    msg = "Audio is still playing. Are you sure you want to leave this page?";
    return msg; 
}


window.onbeforeunload = closeBrPlayer;


