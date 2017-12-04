function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("invisibleBox").style.display = "block";
    document.getElementById("body").style.overflow = "hidden";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("invisibleBox").style.display = "none";
    document.getElementById("body").style.overflow = "auto";
}

function open_search() {
    document.getElementById("mySearch").style.display = "block";
}

function close_search() {
    document.getElementById("mySearch").style.display = "none";
}

// var height = 0;
// var attempt = 0;
// var intS = 0;
//
// function scrollToEndPage() {
//     console.log("height:" + height + " scrollHeight:" + document.body.scrollHeight + " att:" + attempt );
//
//     if (height < document.body.scrollHeight) {
//         height = document.body.scrollHeight;
//         window.scrollTo(0, height); attempt++;
//     } else {
//         clearInterval(intS);
//     }
// } intS = setInterval(scrollToEndPage,5000);