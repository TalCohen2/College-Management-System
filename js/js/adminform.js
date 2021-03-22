var f = document.forms.adminform;
if(f.elements.add) {
    f.elements.add.onclick = function() {
        if(validation()) {
            f.action ='/College-Managment-System/adminstration/manageadmin/add';
            f.submit();
        }
    }
}

if(f.elements.edit) {
    f.elements.edit.onclick = function(e) {
        if(validation()) {
            var id = e.target.getAttribute('data-id');
            f.action ='/College-Managment-System/adminstration/manageadmin/edit/' + id;
            f.submit();
        }
    }
}

if(f.elements.delete) {
    f.elements.delete.onclick = function(e) {
        if(confirm("are you sure?")) {
            var id = e.target.getAttribute('data-id');
            var name = e.target.getAttribute('name');
            location.href = "/College-Managment-System/adminstration/manageadmin/delete/" + id;
        }
    }
}

function validation() {
    var ret = true;
    var err = [];
    if (f.elements.firstName.value.trim()=='') {
        err.push('missing first name');
    }
    if (f.elements.lastName.value.trim()=='') {
        err.push('missing last name');
    }
    if (f.elements.phone.value.trim()=='') {
        err.push('missing phone');
    }
    if (isNaN(f.elements.phone.value.trim())) {
        err.push('phone can be numbers only');
    }
    if (f.elements.email.value.trim()=='') {
        err.push('missing email');
    }
    if(!f.elements.edit) {
        if (f.elements.image.value.trim()=='') {
            err.push('missing image');
        }
    }
    if (f.elements.role.value.trim()=='') {
        err.push('missing role');
    }
    if(!f.elements.edit) {
        if (f.elements.password.value.trim()=='') {
            err.push('missing password');
        }
    }
    if (err.length > 0) {
        ret = false;
        document.querySelector("form > section").className = "alert alert-danger col-md-6 col-md-push-3 text-center";
        document.querySelector("form > section").innerHTML = (err.join('<br>'));
    }
    return ret;
}