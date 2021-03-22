document.getElementById("editButton").onclick = function(e) {
    var id = e.target.getAttribute('data-id');
    var name = e.target.getAttribute('name');
    if(name=='course') {
        location.href = "/College-Managment-System/editcourse/" + id;
    }
    else if(name=='student') {
        location.href = "/College-Managment-System/editstudent/" + id;
    }
    else if(name=='admin') {
        location.href = "/College-Managment-System/adminstration/edit/" + id;
    }
}