function menu_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("invisibleBox").style.display = "block";
    document.getElementById("body").style.overflow = "hidden";
}

function menu_close() {
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
    // urldecode(hash)
    switch (hash) {
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

function showLikesCover(elem) {
    const isLiked = false;
    if (isLiked) {
        elem.querySelector('.dislike').style.display = "block";
        elem.querySelector('.like').style.display = "none";
    } else {
        elem.querySelector('.like').style.display = "block";
        elem.querySelector('.dislike').style.display = "none";
    }
    elem.querySelector('.photo-hover').style.display = "block";
}

function hideLikesCover(elem) {
    elem.querySelector('.photo-hover').style.display = "none";
}

function setLike(photo) {

}

function removeLike(photo) {

}

function showRomove(elem){
    elem.querySelector('.clear').style.display = "block";
}

function hideRomove(elem) {
    elem.querySelector('.clear').style.display = "none";
}

showSuccessRegisterModal();