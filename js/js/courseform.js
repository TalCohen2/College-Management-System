var f = document.forms.courseform;
if(f.elements.add) {
    f.elements.add.onclick = function() {
        if(validation()) {
            f.action ='/College-Managment-System/managecourse/add';
            f.submit();
        }
    }
}

if(f.elements.edit) {
    f.elements.edit.onclick = function(e) {
        if(validation()) {
            var id = e.target.getAttribute('data-id');
            f.action ='/College-Managment-System/managecourse/edit/' +id;
            f.submit();
        }
    }
}

if(f.elements.delete) {
    f.elements.delete.onclick = function(e) {
        if(confirm("are you sure?")) {
            var id = e.target.getAttribute('data-id');
            var name = e.target.getAttribute('name');
            location.href = "/College-Managment-System/managecourse/delete/" + id;
        }
    }
}


function validation() {
    var ret = true;
    var err = [];
    if (f.elements.course.value.trim()=='') {
        err.push('missing course name');
    }
    if (f.elements.description.value.trim()=='') {
        err.push('missing description');
    }
    if(!f.elements.edit){
        if (f.elements.image.value.trim()=='') {
            err.push('missing image');
        }
    }
    if (err.length > 0) {
        ret = false;
        document.querySelector("form > section").className = "alert alert-danger col-md-6 col-md-push-3 text-center";
        document.querySelector("form > section").innerHTML = (err.join('<br>'));
    }
    return ret;
}