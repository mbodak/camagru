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
            setTimeout(function() { alert("Your CAMAGRU account was successfully created!") },1);
            break;
        case 'notRegistered':
            setTimeout(function() { alert("Ooops... Looks like this one login or email is already occupied.") }, 1);
            break;
        case 'activated':
            setTimeout(function() { alert("Your CAMAGRU account was successfully activated! Now you can login!") }, 1);
            break;
        case 'notActivated':
            setTimeout(function() { alert("Your CAMAGRU account was not activated. Please, try again.") }, 1);
            break;
        case 'forgotSent':
            setTimeout(function() { alert("Recover password code was sent to your email.") }, 1);
            break;
        case 'forgotNotSent':
            setTimeout(function() { alert("Email not found! Try again!") }, 1);
            break;
        case 'changed':
            setTimeout(function() { alert("Your password was successfully changed!") }, 1);
            break;
        case 'notChanged':
            setTimeout(function() { alert("Incorrect old password!") }, 1);
            break;
        case 'recovered':
            setTimeout(function() { alert("Your password was successfully recovered!") }, 1);
            break;
        case 'notRecovered':
            setTimeout(function() { alert("Something went wrong. Please, try again.") }, 1);
            break;
        case 'loggedin':
            break;
        default:
            if (str) {
                setTimeout(function() { alert(clearHash) }, 1);
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