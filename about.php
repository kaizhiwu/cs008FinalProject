<?php
include ('top.php');
?>

<div id="videoMain">
    <div id="videoInterface">
        <div id="flip"> 
            <div class="face"> 
                <video tabindex="0" id="video" autoplay height="360" width="640">
                    <source src="media/vid1.mp4" type="video/mp4">
                </video>
            </div>
            <div class="face back"></div> 
        </div>   
        <div id="progressBar">
            <span id="progress"></span>
        </div>
        <div id="time">
            <span id="current_time">00:00</span>/<span id="duration">00:00</span>
        </div>

        <div id="b1">
            <button id="playpause" title="PAUSE" onclick="togglePlayPause()">PAUSE</button>
            <button id="vp" title="VOLUME UP" onclick="document.getElementById('video').volume += 0.1">VOL UP</button>
            <button id="vd" title="VOLUME DOWN" onclick="document.getElementById('video').volume -= 0.1">VOL DOWN</button>
            <button id="mute" title="MUTE" onclick="toggleMute()">MUTE</button>
            <button id="fsb" title="FUlL SCREEN" onclick="fullScreen()">FULL SCREEN</button>
        </div>

    </div>
    <div id="dark"></div>

    <div id="menu">	
        <ul id="playlist" class="font face">
            <li><a href="#" onclick="playlistClick('media/vid1');"><img src="media/vid1.png" title="Burlington Harbor, Lake Champlain." alt="Burlington Harbor, Lake Champlain"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid2');"><img src="media/vid2.png" title="Ira Alen Chapel" alt="Ira Alen Chapel"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid3');"><img src="media/vid3.png" title="Close up view from the golden dome" alt="Close up view from the golden dome"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid4');"><img src="media/vid4.png" title="University of Vermont " alt="University of Vermont"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid5');"><img src="media/vid5.png" title="Beautiful Mountains of Vermont" alt="Beautiful Mountains of Vermont"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid6');"><img src="media/vid6.png" title="More Mountains of Vermont" alt="More Mountains of Vermont"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid7');"><img src="media/vid7.png" title="The City of Burlington during Summer" alt="The City of Burlington during Summer"></a></li>
            <li><a href="#" onclick="playlistClick('media/vid8');"><img src="media/vid8.png" title="State Capital Montpelier" alt="State Capital Montpelier"></a></li>
        </ul>
    </div>
</div>
</body>
</html>