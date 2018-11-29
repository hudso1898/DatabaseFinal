<!-- created by Matt Hudson for CS2830 Fall '17 Final Project -->
<?php
    if(!session_start()) {
        header("Location: sessionError.php");
        exit;
    }
    $loggedIn = empty($_SESSION["loggedIn"]) ? false : $_SESSION["loggedIn"];

?>
<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="UTF-8">
    <title>ΦΜΑ Zeta Music Library</title>
    <link rel="stylesheet" type="text/css" href="app.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1.custom/jquery-ui.theme.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    
    <script>
        
    $(document).ready(function() {
        var seek = false;
        var audio = document.getElementById("mainAudio");
        $("#timeSlider").slider( {
            min: 0,
            max: 1000,
            value: 0,
            slide: function() {
                seek = true;
            },
            stop: function( event, ui) {
                seek = false;
                if($("#mainAudio").attr("src") == null) return;
                audio.currentTime = audio.duration * (ui.value / 1000);
            }
        });
        $("#mainAudio").bind('timeupdate', function() {
            if (!seek) {
                $("#timeSlider").slider('value', (audio.currentTime
                / audio.duration) * 1000);
            }
            
        });
        $("#playPauseButton").button( {
            icon: "ui-icon-play"
        });
        $("#stopButton").button( {
            icon: "ui-icon-stop"
        });
        $("#rewindButton").button( {
            icon: "ui-icon-seek-prev"
        });
        $("#muteButton").button( {
            icon: "ui-icon-volume-on"
        });
        $("#volumeSlider").slider( {
            orientation: "vertical",
            min: 0,
            max: 100,
            value: 100,
            slide: function( event, ui ) {
                $("#volume").html( "Volume " + ui.value );
                document.getElementById("mainAudio").volume = 0.01 * ui.value;
            }
        });
        
    });
        
    function playPause() {
        
        var audio = document.getElementById("mainAudio");
        if($("#mainAudio").attr("src") == null) return;
        if (audio.paused) {
            audio.play();
            $("#playPauseButton").children().removeClass("ui-icon-play");
            $("#playPauseButton").children().addClass("ui-icon-pause");
        }
        else {
            audio.pause();
            $("#playPauseButton").children().removeClass("ui-icon-pause");
            $("#playPauseButton").children().addClass("ui-icon-play");
            
        }
    }
        
    function setPlay() {
        $("#playPauseButton").children().removeClass("ui-icon-pause");
        $("#playPauseButton").children().addClass("ui-icon-play");
    }
    function rewind() {
        var audio = document.getElementById("mainAudio")
        audio.currentTime = 0;
        if(audio.paused) {
            audio.play();
            $("#playPauseButton").children().removeClass("ui-icon-play");
            $("#playPauseButton").children().addClass("ui-icon-pause");
        }
    }
    function mute() {
        var audio = document.getElementById("mainAudio");
        if (audio.muted) {
            audio.muted = false;
            $("#muteButton").children().removeClass("ui-icon-volume-off");
            $("#muteButton").children().addClass("ui-icon-volume-on");
        }
        else {
            audio.muted = true;
            $("#muteButton").children().removeClass("ui-icon-volume-on");
            $("#muteButton").children().addClass("ui-icon-volume-off");
        }
        
    }
        
    function menuReady() {
        $("#musicMenu").menu();
    }
    function playSong(button, filepath, imagepath) {
        $("#mainAudio").attr('src', filepath);
        $("#mainImage").attr('src', imagepath);
        $("#mainAudio").attr('autoplay', true);
        $("#playPauseButton").children().removeClass("ui-icon-play");
        $("#playPauseButton").children().addClass("ui-icon-pause");
        $("#nowPlaying").html("Now Playing: " + button.innerHTML);
        getSongInfo(button.innerHTML);
        
    }
    
        function getSongInfo(title) {
        $("#songInfo").html("Now loading song data...");
        $.get("get_song.php", {
            "title": title
        }, function(data) {
            $("#songInfo").html(data);
        });
    }
    </script>
    </head>
<body onload="menuReady()">
    <?php $fromRequired = true; require "navigation.php"; ?>
    <h1>ΦΜΑ Zeta Chapter Digital Music Library</h1>
    <div class="musicWrapper">
    <div class="musicMenu">
    <?php require_once 'music_menu.php'; ?>
    </div>
    <div id="imageHolder">
    <h2 id="nowPlaying" class="nowPlaying">Now Playing: </h2>
    <image id="mainImage" src='images/songs/default.png' alt='/images/songs/default.png'></image>
    <div id="timeSlider"></div>
    <div class="controls">
        <button class="control" id="playPauseButton" onClick="playPause()"></button>
        <button class="control" id="rewindButton" onClick="rewind()"></button>
        <button class="control" id="muteButton" onClick="mute()"></button>
        <div class="volumes">
        <p id="volume">Volume 100</p>
        <div id="volumeSlider"></div>
        </div>
        </div>
        </div>
        
    </div>
    <div id="songInfo" class="songInfo">
    </div>
    
    
    
    <audio id='mainAudio' type='audio/mpeg' onended="setPlay()"></audio>
    
    </body>
</html>