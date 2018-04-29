<?php
include ('top.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8"> 
<title>DISNEY WORLD!</title>
<link rel="stylesheet" type="text/css" href="css/video.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="video.js"></script>
</head>

<div id="main">
<div id="ppp"></div>
    <div id="interface">
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
    <button id="dimon" title="DIM ON" onclick="toggleDim()">DIM ON</button>
    <button id="fsb" title="FUlL SCREEN" onclick="fullScreen()">FULL SCREEN</button>
    </div>

    </div>
    <div id="dark"></div>
    
<div id="menu">	
<ul id="playlist" class="font face">
<li><a href="#" onclick="playlistClick('media/vid1');"><img src="media/vid1.png" title="A buffalo is singing." alt="A buffalo is singing."></a></li>
<li><a href="#" onclick="playlistClick('media/vid2');"><img src="media/vid2.png" title="A fragment of zootopia." alt="A fragment of zootopia."></a></li>
<li><a href="#" onclick="playlistClick('media/vid3');"><img src="media/vid3.png" title="Animals' music carnival." alt="Animals' music carnival."></a></li>
<li><a href="#" onclick="playlistClick('media/vid4');"><img src="media/vid4.png" title="Sorry,I don't know this cartoon's name." alt="Sorry,I don't know this cartoon's name."></a></li>
<li><a href="#" onclick="playlistClick('media/vid5');"><img src="media/vid5.png" title="Well,I don't know this cartoon's name, too." alt="Well,I don't know this cartoon's name, too."></a></li>
<li><a href="#" onclick="playlistClick('media/vid6');"><img src="media/vid6.png" title="The advanture of kitchenette Moli." alt="The advanture of kitchenette Moli."></a></li>
<li><a href="#" onclick="playlistClick('media/vid7');"><img src="media/vid7.png" title="The story of dogs and cats in City." alt="The story of dogs and cats in City."></a></li>
<li><a href="#" onclick="playlistClick('media/vid8');"><img src="media/vid8.png" title="It describes a big dog teases a smaller one." alt="It describes a big dog teases a smaller one."></a></li>
</ul>
</div>
</div>
</body>
</html>