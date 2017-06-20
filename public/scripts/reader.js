/**
 * Created by sayaka on 2017/06/18.
 */
var data;
var i = 0;

function getData() {
   $.getJSON(window.location.pathname + "/reader", function (volume_data) {
       console.log(volume_data.cover);
       data = volume_data;
       $( ".current-page>img" ).attr( "src", volume_data.cover);
   });
}

$('.fa.fa-arrow-circle-left').click(function () {
    changePage(false);
});

$('.fa.fa-arrow-circle-right').click(function () {
    changePage(true);
});

function toggleFullScreen(elem) {
    // ## The below if statement seems to work better ## if ((document.fullScreenElement && document.fullScreenElement !== null) || (document.msfullscreenElement && document.msfullscreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}

function changePage(inc) {
    var path = window.location.pathname;
    var files = data.file_names;
    var file;
    if (inc && i < files.length - 1) {
        file = files[++i];
    } else if (!inc && i > 0) {
        file = files[--i];
    }
    if (file) {
        $( ".current-page>img" ).attr( "src", path + "/" + file);
    }
}

getData();
$(".fullscreenBtn").click(function() {
    toggleFullScreen($(".container")[0]);
});