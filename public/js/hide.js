$(document.body).ready(function () {
    $(document).on('click', '.cancel-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        console.log(id);
        $("#" + id).addClass('hidden');
        $("#show-" + id).removeClass('hidden');
    });
    $(document).on('click', '.cover-button', function(event){
        var id = event.target.id.substr(6, event.target.id.length-6);
        $("#cover-" + id).addClass('hidden');
        $("#expose-" + id).removeClass('hidden');
        $("#" + id).addClass('hidden');
        $("#" + id + "-cover").removeClass('hidden');
    });
    $(document).on('click', '.expose-button', function(event){
        var id = event.target.id.substr(7, event.target.id.length-7);
        $("#cover-" + id).removeClass('hidden');
        $("#expose-" + id).addClass('hidden');
        $("#" + id).removeClass('hidden');
        $("#" + id + "-cover").addClass('hidden');
    });
   
    $(document).on('click', '.replace-primary-button', function(event){
        var id = event.target.id.substr(16, event.target.id.length-16);
        $("#" + id + "-primary").addClass('hidden');
        $("#" + id + "-secondary").removeClass('hidden');
    });
    $(document).on('click', '.replace-secondary-button', function(event){
        var id = event.target.id.substr(18, event.target.id.length-18);
        $("#" + id + "-primary").removeClass('hidden');
        $("#" + id + "-secondary").addClass('hidden');
    });
    $(document).on('click', '.show-button', function(event){
        var id = event.target.id.substr(5, event.target.id.length-5);
        $("#" + id).removeClass('hidden');
        $("#show-" + id).addClass('hidden');
    });
});
