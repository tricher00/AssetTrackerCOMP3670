document.addEventListener('DOMContentLoaded', function() {
    var formTag = document.getElementByTagName("form");
    formTag.addEventListener("submit", function(e){
        var incomplete = false;
        var req = document.getElementsById("required");
        for (var i = 0; i < req.length; i++){
            if (req[i].value.length == 0){
                incomplete = true;
                req[i].class = 'incomplete'
            }   
        }
        if (incomplete){
            e.preventDefault();
        }
    });
}, false);