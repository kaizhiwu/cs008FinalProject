//arry to store color values.
var colorVal = new Array();      
var colorIndex=15;
var dimSpeed = 30;  //dim speed; number of milliseconds to wait before change the color value 
var dark;
var video;
var time;
			
window.onload = init;

function init() {
    dimInit();
    videoInit();
	drag();
}

function dimInit() {
    dark = document.getElementById("dark");
                 
    colorVal[0] = "#000";
    colorVal[1] = "#111";
    colorVal[2] = "#222";
    colorVal[3] = "#333";
    colorVal[4] = "#444";
    colorVal[5] = "#555";
    colorVal[6] = "#666";
    colorVal[7] = "#777";
    colorVal[8] = "#888";
    colorVal[9] = "#999";
    colorVal[10] = "#AAA";
    colorVal[11] = "#BBB";
    colorVal[12] = "#CCC";
    colorVal[13] = "#DDD";
    colorVal[14] = "#EEE";
    colorVal[15] = "#FFF";
}
            
//change color value from #fff to #000
function DimOn() { 
    dark.style.zIndex = 2;
    if (dark && (colorIndex > 0)) {
        dark.style.backgroundColor = colorVal[colorIndex];
        colorIndex--;
        setTimeout("DimOn()", dimSpeed);
    }
    else {
        clearTimeout();
					
    }
}
            
//change color value from #000 to $fff
function DimOff() {			
    if (dark && (colorIndex <15)) {
        dark.style.backgroundColor = colorVal[colorIndex];
        colorIndex++;
        setTimeout("DimOff()", dimSpeed);
    }
    else {
        dark.style.zIndex  = -1;
        clearTimeout();
    }
     
}
            
function toggleDim() {
    btnDimon = document.getElementById("dimon");
                
    if (btnDimon.childNodes[0])
    {
        if (btnDimon.childNodes[0].nodeValue=="DIM ON") {
            btnDimon.childNodes[0].nodeValue="DIM OFF";
            btnDimon.title = "DIM OFF";
            DimOn();
        }
        else {
            btnDimon.childNodes[0].nodeValue="DIM ON";
            btnDimon.title = "DIM ON";
            DimOff();
        }            
    }
    else if (btnDimon.value)
    {
        if (btnDimon.value=="DIM ON") {
            btnDimon.value="DIM OFF";
            btnDimon.title = "DIM OFF";
            DimOn();
        }
        else {
            btnDimon.value="DIM ON";
            btnDimon.title = "DIM ON";
            DimOff();
        }
    }
    else //if (button.innerHTML)
    {
        if (btnDimon.innerHTML=="DIM ON") {
            btnDimon.innerHTML="DIM OFF";
            btnDimon.title = "DIM OFF";
            DimOn();
        }
        else {
            btnDimon.innerHTML="DIM ON";
            btnDimon.title = "DIM ON";
            DimOff();
        }
    }
}
	
            
function videoInit() {
                

    // Grab a handle to the video (used throughout the functions)
    video = document.getElementById("video"); 
	// Initiate the timer
	time = document.getElementById("time");
	if (video.duration)
		time.innerHTML ="00:00 / " + formatTime(video.duration);
	else
		time.innerHTML ="00:00 / 00:00";

    // Turn off the default controls
    video.controls = false;
			
    // Event Listening
    // Listens for the 'timeupdate' event to be raised by the video, and calls the updateProgress() function to update the progress bar
    video.addEventListener("timeupdate", updateProgress, false);
    // Listens for the 'play' event to be raised and changes the play/pause button's text to 'pause'
    video.addEventListener('PLAY', function() {
        var playpause = document.getElementById("playpause");
        playpause.title = "PAUSE";
        playpause.innerHTML = "PAUSE";
    }, false);
    // Listens for the 'pause' event to be raised and changes the play/pause button's text to 'play'
    video.addEventListener('PAUSE', function() {
        var playpause = document.getElementById("playpause");
        playpause.title = "PLAY";
        playpause.innerHTML = "PLAY";
    }, false);
    // Listens for the 'ended' event to be raised and pauses the video (which has the effect of updating the play/pause button's text to 'play')
    video.addEventListener("ended", function() {
        this.pause();
    }, false);
}
			
// Functions
// togglePlayPause - toggles the play/pause button
function togglePlayPause() {
    // Grab a handle to the play/pause button
    var playpause = document.getElementById("playpause");
    // If the video is currently paused or has ended
    if (video.paused || video.ended) {
        // Change the title and the text of the button to "pause"
        playpause.title = "PAUSE";
        playpause.innerHTML = "PAUSE";
        // Start playing the video
        video.play();
    }
    // Otherwise it must currently be playing
    else {
        // Change the title and the text of the button to "play"
        playpause.title = "PLAY";
        playpause.innerHTML = "PLAY";
        // Pause the video
        video.pause();
    }
}
			
			
// updateProgress - updates the video's progress bar
function updateProgress() {
    var progress = document.getElementById("progress");
    var value = 0;
    if (video.currentTime > 0) {
        value = Math.floor((100 / video.duration) * video.currentTime);
    }
    progress.style.width = value + "%";
	time.innerHTML = formatTime(video.currentTime) + " / " + formatTime(video.duration);
}

						
function formatTime(seconds) {
    var seconds = Math.round(seconds);
    var minutes = Math.floor(seconds / 60);
    // Remaining seconds
    seconds = Math.floor(seconds % 60);
    // Add leading Zeros
    minutes = (minutes >= 10) ? minutes : "0" + minutes;
    seconds = (seconds >= 10) ? seconds : "0" + seconds;
    return minutes + ":" + seconds;
}

// toggleMute - mutes or unmutes the video's sound
			function toggleMute() {
				video.muted = !video.muted;
			}





// Make the progress bar draggable.
function drag (){
	var timeDrag = false;	/* check for drag event */
	$('#progressBar').on('mousedown', function(e) {
		timeDrag = true;
		updatebar(e.pageX);
	});
	$(document).on('mouseup', function(e) {
		if(timeDrag) {
			timeDrag = false;
			updatebar(e.pageX);
		}
	});
	$(document).on('mousemove', function(e) {
		if(timeDrag) {
			updatebar(e.pageX);
		}
	});
	var updatebar = function(x) {
		var progress = $('#progressBar');
		
		//calculate drag position
		//and update video currenttime
		//as well as progress bar
		var maxduration = video.duration;
		var position = x - progress.offset().left;
		var percentage = 100 * position / progress.width();
		if(percentage > 100) {
			percentage = 100;
		}
		if(percentage < 0) {
			percentage = 0;
		}
		$('#progress').css('width',percentage+'%');	
		video.currentTime = maxduration * percentage / 100;
	};
}



//full screen
function fullScreen(){
	video = document.getElementById("video"); 
	if (video.requestFullscreen) {
	  video.requestFullscreen();
	} else if (video.mozRequestFullScreen) {
	  video.mozRequestFullScreen();
	} else if (video.webkitRequestFullscreen) {
	  video.webkitRequestFullscreen();
	}
}



function playlistClick(file) {
    // Create a new video element
    var v = document.createElement("video");
    // Check which type the browser can play and change the video's source file to the appropriate filename
    if (v.canPlayType("video/mp4") != "") changeSource(file + ".mp4");
    else if (v.canPlayType("video/webm") != "") changeSource(file + ".webm");
    // Prevent the default action for the link by returning false
    return false;
}
			
function changeSource(src) {
    // Reset the player
    resetPlayer();
    // Change the video source
    video.src = src;
    // Load the video (required by Safari)
    video.load();
}
			
function resetPlayer() {
    // Reset the play/pause button's text
    var playpause = document.getElementById("playpause");
    playpause.title = "PLAY";
    playpause.innerHTML = "PLAY";
    // Reset the video's currentTime
    if (video.currentTime > 0) video.currentTime = 0;
    // Update the progress (i.e. reset it)
    updateProgress();
}
