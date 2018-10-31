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
    const clearHash = decodeURIComponent((hash + '').replace(/\+/g, '%20'));
    const str = clearHash.replace(/\s+/g,'', '');
    switch (str) {
        case 'registered':
            alert("Your CAMAGRU account was successfully created!");
            break;
        case 'notRegistered':
            alert("Ooops... Looks like this one login or email is already occupied.");
            break;
        case 'activated':
            alert("Your CAMAGRU account was successfully activated! Now you can login!");
            break;
        case 'notActivated':
            alert("Your CAMAGRU account was not activated. Please, try again.");
            break;
        case 'forgotSent':
            alert("Recover password code was sent to your email.");
            break;
        case 'forgotNotSent':
            alert("Email not found! Try again!");
            break;
        case 'changed':
            alert("Your password was successfully changed!");
            break;
        case 'notChanged':
            alert("Incorrect old password!");
            break;
        case 'recovered':
            alert("Your password was successfully recovered!");
            break;
        case 'notRecovered':
            alert("Something went wrong. Please, try again.");
            break;
        case 'loggedin':
            break;
        default:
            if (str) {
                alert(clearHash);
            }
            break;
    }
}

function showRomove(elem){
    elem.querySelector('.clear').style.display = "block";
}

function hideRomove(elem) {
    elem.querySelector('.clear').style.display = "none";
}

showSuccessRegisterModal();