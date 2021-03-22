document.getElementById("editButton").onclick = function(e) {
    var id = e.target.getAttribute('data-id');
    var name = e.target.getAttribute('name');
    if(name=='course') {
        location.href = "/College-Management-System/editcourse/" + id;
    }
    else if(name=='student') {
        location.href = "/College-Management-System/editstudent/" + id;
    }
    else if(name=='admin') {
        location.href = "/College-Management-System/adminstration/edit/" + id;
    }
}