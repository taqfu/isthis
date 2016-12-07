console.log("test1"); 
$(document.body).ready(function () {
console.log("test2"); 
    $(document).on('keyup', '#new-post-title', function(event){
        $("#new-post-title-num-of-chars").html(150-$("#new-post-title").val().length);
    });
});
