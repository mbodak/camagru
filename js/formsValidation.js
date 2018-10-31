

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
    let insert = document.getElementsByTagName('label')[1];
    let login = document.forms["create-form"]["login"].value.trim();
    let email = document.forms["create-form"]["email"].value;
    let password = document.forms["create-form"]["password"].value;
    let repeatedPassword = document.forms["create-form"]["repeat_password"].value;


    let filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let filterPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    let compare = password.localeCompare(repeatedPassword);

    let errorDiv = document.getElementsByClassName("error_div")[0];
    let div = document.createElement("div");

    if (errorDiv) {
        errorDiv.parentElement.removeChild(errorDiv);
    }
    if (login.length < 8 || login.length > 16) {
        div.className = "error_div";
        div.innerHTML = "Login must be between 8 and 16 symbols";
        insert.insertBefore(div, insert.firstChild);
        return (false);
    }
    if (!filterEmail.test(email)) {
        div.className = "error_div";
        div.innerHTML = "Please provide a valid email address";
        insert.insertBefore(div, insert.firstChild);
        return (false);
    }
    if (!filterPassword.test(password)) {
        div.className = "error_div";
        div.innerHTML = "Password must include minimum 8 symbols at least 1 uppercase alphabet, 1 lowercase alphabet and 1 number";
        insert.insertBefore(div, insert.firstChild);
        return (false);
    }
    if (compare) {
        document.forms["create-form"]["password"].style = "background: #D78A8A;";
        document.forms["create-form"]["repeat_password"].style = "background: #D78A8A;";

        div.className = "error_div";
        div.innerHTML = "Please provide a valid password";
        insert.insertBefore(div, insert.firstChild);
        return (false);
    }
    ajax('handlers/checkEmail.php', { email }, response => {
        if (response === "true") {
            div.className = "error_div";
            div.innerHTML = "Email is occupied! Chose another one!";
            insert.insertBefore(div, insert.firstChild);
            return
        }
        ajax('handlers/checkLogin.php', { login }, response => {
            console.log(response);
            if (response === "true") {
                div.className = "error_div";
                div.innerHTML = "Login is occupied! Chose another one!";
                insert.insertBefore(div, insert.firstChild);
                return
            }
            redirectPost('sign-up', { login, email, password });
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
