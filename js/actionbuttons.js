document.getElementById("editButton").onclick = function(e) {
    var id = e.target.getAttribute('data-id');
    var name = e.target.getAttribute('name');
    if(name=='course') {
        location.href = "/talcohenproject/editcourse/" + id;
    }
    else if(name=='student') {
        location.href = "/talcohenproject/editstudent/" + id;
    }
    else if(name=='admin') {
        location.href = "/talcohenproject/adminstration/edit/" + id;
    }
}