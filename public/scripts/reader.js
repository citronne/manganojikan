/**
 * Created by sayaka on 2017/06/18.
 */
function getData() {
   $.getJSON(window.location.pathname + "/reader", function (volume_data) {
        //console.log(data)
       console.log(volume_data.volumeNumber);
   });
}

$( ".current-page" ).attr( "src", volume.volumeNumber);

$('.fa fa-arrow-circle-left').click(function () {
    pagePlusOne();
});

$('.fa fa-arrow-circle-right').click(function () {
    pageMinusOne();
});

function pagePlusOne() {

}

getData();