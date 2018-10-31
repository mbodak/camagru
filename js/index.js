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

function showSuccessRegisterModal() {
    let hash = location.hash.substr(1);
    switch (urldecode(hash)) {
        case 'registered':
            alert("Your CAMAGRU account was successfully created!");
            break;
        case 'notRegistered':
            alert("Ooops... Looks like this one login or email is already occupied.");
            break;
        case 'activated':
            alert("Your CAMAGRU account was successfully activated!");
            break;
        case 'notActivated':
            alert("Your CAMAGRU account was not activated. Please, try again.");
            break;
        case 'forgotSent':
            alert("Recover password code was sent to your email.");
            break;
        case 'forgotNotSent':
            alert("Something went wrong. Please, try again.");
            break;
        case 'changed':
            alert("Your password was successfully changed!");
            break;
        case 'notChanged':
            alert("Something went wrong. Please, try again.");
            break;
        case 'recovered':
            alert("Your password was successfully recovered!");
            break;
        case 'notRecovered':
            alert("Something went wrong. Please, try again.");
            break;
        default:
            break;
    }
}

function showLikesCover() {
    document.getElementById("like-img").className = "isLike";
    document.getElementById("like-cover").style.display = "block";
}

function hideLikesCover() {
    document.getElementById("like-cover").style.display = "none";
}

function setLike() {

}

showSuccessRegisterModal();