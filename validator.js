document.addEventListener("DOMContentLoaded", function() {
    var formTag = document.getElementsByTagName("form")[0];
    formTag.addEventListener("submit", function(e){
        var incomplete = false;
        var req = document.getElementsByClassName("required");
        for (var i = 0; i < req.length; i++){
            if (req[i].value.length == 0){
                incomplete = true;
                req[i].id = 'incomplete';
            }
            else{
                req[i].id = '';
            }            
        }
        if (incomplete){
            e.preventDefault();
        }
    });
}, false);