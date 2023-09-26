function check_name(value) {
    var url = "backend_register.php?sector=1&name=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "") {
                document.getElementById("name").style.borderColor = "green";
                document.getElementById("name-warn").innerHTML = xmlhttp.responseText;
            } else {
                document.getElementById("name").style.borderColor = "red";
                document.getElementById("name-warn").innerHTML = xmlhttp.responseText;
            }
        }
    };
}

function check_username(value) {
    //check availability of username in database with ajax
    var url = "backend_register.php?sector=2&username=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "") {
                document.getElementById("username").style.borderColor = "green";
                document.getElementById("username-warn").innerHTML = xmlhttp.responseText;
            } else {
                document.getElementById("username").style.borderColor = "red";
                document.getElementById("username-warn").innerHTML = xmlhttp.responseText;
            }
        }
    };
}

function check_email(value) {
    //check availability of username in database with ajax
    var url = "backend_register.php?sector=3&email=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "") {
                document.getElementById("email").style.borderColor = "green";
                document.getElementById("email-warn").innerHTML = xmlhttp.responseText;
            } else {
                document.getElementById("email").style.borderColor = "red";
                document.getElementById("email-warn").innerHTML = xmlhttp.responseText;
            }
        }
    };
}

function check_pass(value) {
    //check availability of username in database with ajax
    var url = "backend_register.php?sector=4&pass=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "") {
                document.getElementById("password").style.borderColor = "green";
                document.getElementById("password-warn").innerHTML = xmlhttp.responseText;
            } else {
                document.getElementById("password").style.borderColor = "red";
                document.getElementById("password-warn").innerHTML = xmlhttp.responseText;
            }
        }
    };
}

function check_confirmpass(value) {
    //check availability of username in database with ajax
    var pass = document.getElementById("password").value;
    var url = "backend_register.php?sector=5&pass=" + pass + "&confirmpass=" + value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "") {
                document.getElementById("confirmpass").style.borderColor = "green";
                document.getElementById("confirmpass-warn").innerHTML = xmlhttp.responseText;
            } else {
                document.getElementById("confirmpass").style.borderColor = "red";
                document.getElementById("confirmpass-warn").innerHTML = xmlhttp.responseText;
            }
        }
    };
}

// const button = document.getElementById("submit");
// button.addEventListener("click", function() {
//     var name = document.getElementById("name").value;
//     var username = document.getElementById("username").value;
//     var email = document.getElementById("email").value;
//     var pass = document.getElementById("password").value;
//     var confirmpass = document.getElementById("confirmpass").value;
//     var url = "backend_register.php?sector=6&name=" + name + "&username=" + username + "&email=" + email + "&pass=" + pass + "&confirmpass=" + confirmpass;
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.open("GET", url, true);
//     xmlhttp.send();
//     xmlhttp.onreadystatechange = function() {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             if (xmlhttp.responseText == "") {
//                 alert("Registration Successful!");
//                 window.location.href = "login.php";
//             } else {
//                 alert(xmlhttp.responseText);
//             }
//         }
//     };
// });
