var f = document.forms.logForm;
f.elements.login.onclick = function() {
    if(validation()) {
        f.action ='/College-Management-System/login';
        f.submit();
    }
}


function validation() {
    var ret = true;
    var err = [];
    if (f.elements.email.value.trim()=='') {
        err.push('missing Email');
    }
    if (f.elements.password.value.trim()=='') {
        err.push('missing password');
    }
    if (err.length > 0) {
        ret = false;
        document.querySelector("form > div").className = "alert alert-danger";
        document.querySelector("form > div").innerHTML = (err.join('<br>'));
    }
    return ret;
}