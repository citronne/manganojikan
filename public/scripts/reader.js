/**
 * Created by sayaka on 2017/06/18.
 */
var data;
var i = 0;
var scrollLeft;

function getData() {
   $.getJSON(window.location.pathname + "/reader", function (volume_data) {
       //console.log(volume_data.cover);
       data = volume_data;
       $( ".current-page>img" ).attr( "src", volume_data.cover);
   });
}

$(document).ready(function() {
    var current_page = $(".current-page");

    current_page.click(function(event) {

        var position_offset = $(this).offset();

        var positon = event.pageX;

        var width = $(this).width();

        if(positon < position_offset.left + width/2) {
            changePage(true);
        } else {
            changePage(false);
        }
    });

    $('.icon_left').click(function () {
        changePage(true);
    });

    $('.icon_right').click(function () {
        changePage(false);
    });

    $(".fullscreenBtn").click(function() {
        toggleFullScreen($(".container")[0]);
    });

    var img=$(".current-page>img");

    img.on("load", function () {
        console.log("load");
        current_page.scrollLeft(scrollLeft);
    });

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
        i++;
        file = files[i];
        scrollLeft = 1000;
    } else if (!inc && i > 0) {
        i--;
        file = files[i];
        scrollLeft = 0;
    }
    if (file) {
        var images = {};
        var img = $( ".current-page>img" );
        img.attr( "src", path + "/" + file);

        //for (var j = i + 1; j < i + 3; j++) {
        //    images[j] = new Image();
        //    file = files[j];

        var next_image = new Image();
        next_image.src = path + "/" + files[i+1];
    }
}

/*$(function(){
    $( ".container" ).bind( "tap", tapHandler );
    changePage(inc);
    });
*/


getData();

