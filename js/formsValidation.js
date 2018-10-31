
function redirectPost(url, data) {
    const form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (let name in data) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}

function formValidationSignUp() {
    let login = document.forms["create-form"]["login"].value.trim();
    let email = document.forms["create-form"]["email"].value;
    let password = document.forms["create-form"]["password"].value;
    let repeatedPassword = document.forms["create-form"]["repeat_password"].value;


    let filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let filterPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    let compare = password.localeCompare(repeatedPassword);

    if (login.length < 8 || login.length > 16) {
        document.forms["create-form"]["login"].style = "background: red;";
        alert("Login must be between 8 and 16 symbols");
        return (false);
    }
    if (!filterEmail.test(email)) {
        document.forms["create-form"]["email"].style = "background: red;";
        alert("Please provide a valid email address");
        return (false);
    }
    if (!filterPassword.test(password)) {
        document.forms["create-form"]["password"].style = "background: red;";
        alert("Password must include minimum 8 symbols at least 1 uppercase alphabet, 1 lowercase alphabet and 1 number");
        return (false);
    }
    if (compare) {
        document.forms["create-form"]["password"].style = "background: red;";
        document.forms["create-form"]["repeat_password"].style = "background: red;";

        alert("Passwords does not match. Try again.");
        return (false);
    }
    ajax('emailoccupied', { email }, response => {
        console.log('email', response);
        if (response === "true") {
            alert("Email is occupied! Chose another one!");
            return
        }
        ajax('logioccupied', { login }, response => {
            console.log(login);
            console.log('login', response);
            if (response === "true") {
                alert("Login is occupied! Chose another one!");
                return
            }
            // redirectPost('sign-up', { login, email, password });
        });
    });
    return false;
}

function forgotPassword() {
    let email = document.forms["forgot-form"]["username"].value;
    redirectPost('forgot', { email: email });
    return false;
}

function recoverPassword() {
    let password = document.forms["recover-form"]["password"].value;
    let repeatedPassword = document.forms["recover-form"]["repeat_password"].value;
    redirectPost('recover?code='+getQueryStringValue('code'), { password });
    return false;
}

function changePassword() {
    let oldPassword = document.forms["change-form"]["old_password"].value;
    let newPassword = document.forms["change-form"]["new_password"].value;
    redirectPost('change', { old_password: oldPassword, new_password: newPassword });
    return false;
}

function removePhoto(id) {
    if(confirm("Are you sure you want to delete image?")) {
        redirectPost('remove', { id });
    }
    return false;
}

function showLikesCover(id, elem) {
    ajax('isliked', { id }, response => {
        const isLiked = response === 'true';
        const dislikeElement = elem.querySelector('.dislike');
        const likeElement = elem.querySelector('.like');
        if (isLiked) {
            dislikeElement ? dislikeElement.style.display = "block" : "";
            likeElement ? likeElement.style.display = "none" : "";
        } else {
            likeElement ? likeElement.style.display = "block" : "";
            dislikeElement ? dislikeElement.style.display = "none" : "";
        }
        elem.querySelector('.photo-hover').style.display = "block";
    });
}

function hideLikesCover(elem) {
    elem.querySelector('.photo-hover').style.display = "none";
}

function setLike(id, elem) {
    ajax('like', { id }, response => {
    });
    let count = elem.querySelector('.lco').innerHTML;
    count = parseInt(count) + 1;
    elem.querySelector('.lco').innerHTML = count;
    elem.querySelector('.dislike').style.display = "block";
    elem.querySelector('.like').style.display = "none";
}

function removeLike(id, elem) {
    ajax('dislike', { id }, response => {
    });
    let count = elem.querySelector('.lco').innerHTML;
    count = parseInt(count) - 1;
    elem.querySelector('.lco').innerHTML = count;
    elem.querySelector('.like').style.display = "block";
    elem.querySelector('.dislike').style.display = "none";
}

function login() {
    let email = document.forms["login-form"]["email"].value;
    let password = document.forms["login-form"]["password"].value;
    redirectPost('login', { email, password });
    return false;
}

function getQueryStringValue (key) {
    return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

function ajax(address, otherBody, onloadFunc) {
    let body = 'type=POST';
    if (otherBody) {
        for (let prop in otherBody) {
            body += '&' + prop + '=' + otherBody[prop];
        }
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', address, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    if (onloadFunc) {
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                onloadFunc(xhr.responseText);
            }
        };
    }
    xhr.send(body);
}
