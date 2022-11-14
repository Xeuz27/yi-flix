function volumeToggle (button){
    var muted = $(".previewVideo").prop("muted");
    $(".previewVideo").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-xmark");
    $(button).find("i").toggleClass("fa-volume-high");
}

function previewEnded() {
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
}

function goBack(){
    window.history.back();
}

function startHideTimer(){
    var timeout = null;
    $(document).on("mousemove", function() {
        clearTimeout(timeout);
        $(".watchNav").fadeIn();
        timeout = setTimeout(function() {
            $(".watchNav").fadeOut();

        }, 1350);
    })
}

function initVideo (videoId, username){
    startHideTimer();
    updateProgessTimer(videoId, username)
    
}
function updateProgessTimer(videoId, username){
    addDuration(videoId, username)

    var timer;
    $("video").on("playing", function(event){
        window.clearInterval(timer);
        timer = window.setInterval(function(){
            updateProgress(videoId, username, event.target.currentTime);
        }, 3000);
    })
    .on("ended", function(){
        window.clearInterval(timer);
    })


}

function addDuration (videoId, username){
    $.post("ajax/addDuration.php",{videoId: videoId, username: username}, function (data){
        if (data !== null && data !== "" ) {
            alert(data);
        }
    })
}
function updateProgress(videoId, username, progress){
    $.post("ajax/updateDuration.php",{videoId: videoId, username: username, progress: progress}, function (data){
        if (data !== null && data !== "" ) {
            alert(data);
        }
    })
}