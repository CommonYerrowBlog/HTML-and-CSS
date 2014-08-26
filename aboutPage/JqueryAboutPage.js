var index = 0;

var sliderItems = $(".item");
function next() {
    index++;
    if (index >= sliderItems.length) {
        index = 0;
    }
    sliderItems.hide();
    var nextItem = $(sliderItems[index]);
    nextItem.show();
}

function prev() {
    index--;
    if (index < 0) {
        index = sliderItems.length - 1;
    }
    sliderItems.hide();
    var nextItem = $(sliderItems[index]);
    nextItem.show();
}

$("#nextButton").click(function () {
    next();
})

$("#prevButton").click(function () {
    prev();
})

next();
var myTimer = setInterval(function () {
    next();
}, 10000);