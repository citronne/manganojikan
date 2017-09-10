/**
 * Created by sayaka on 2017/06/18.
 */
var data;
var pageNumber = 0;
var scrollLeft;

function getData() {
   $.getJSON(window.location.pathname + "/reader", function (volume_data) {
       data = volume_data;
       pageNumber = +data.page_number;
       $( ".current-page>img" ).attr( "src", volume_data.cover);
       var files = data.file_names;
       var file = files[pageNumber];
       changeToPageNumber(file);
   });
}

$(document).ready(function() {
    var current_page = $(".current-page");

    current_page.click(function(event) {

        var position_offset = $(this).offset();

        var position = event.pageX;

        var width = $(this).width();

        if(position < position_offset.left + width/2) {
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
    var files = data.file_names;
    var file;

    if (inc && pageNumber < files.length - 1) {
        pageNumber++;
        file = files[pageNumber];
        scrollLeft = 1000;
    } else if (!inc && pageNumber > 0) {
        pageNumber--;
        file = files[pageNumber];
        scrollLeft = 0;
    }
    if (file) {
       changeToPageNumber(file);
    }
    
}

function changeToPageNumber(file) {
    var path = window.location.pathname;
    var files = data.file_names;
    var img = $( ".current-page>img" );
    img.attr( "src", path + "/" + file);

    var next_image = new Image();
    next_image.src = path + "/" + files[pageNumber+1];

    $(".page_number").text( (pageNumber + 1) + "/" + files.length);

    $.ajax({
        url: path,
        type: 'PUT',
        data: {
            pageNumber: pageNumber
        }

    });
}

getData();

