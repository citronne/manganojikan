/**
 * Created by sayaka on 2017/06/18.
 */
function getData() {
   $.getJSON(window.location.pathname + "/reader", function (data) {
        //console.log(data);
   });
}

$('.fa fa-arrow-circle-left').click(function () {
    pagePlusOne();
});

$('.fa fa-arrow-circle-right').click(function () {
    pageMinusOne();
});

function pagePlusOne() {

}

getData();