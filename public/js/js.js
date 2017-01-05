$(document.body).ready(function () {
    $(document).on('keyup', '#new-post-title', function(event){
        $("#new-post-title-num-of-chars").html(150-$("#new-post-title").val().length);
    });
    $(document).on('change', 'select[name=measure]', function(event){
        var measureVal = $("select[name=measure]").val();
        measureVal!="" 
          ? $("input.create-ballot").removeClass('hidden')
          : $("input.create-ballot").addClass('hidden');
        measureVal=="ban user" || measureVal=="new mod" || measureVal=='remove mod' 
          || measureVal=='new rule' || measureVal=='remove rule'
          ? $("div#text-input").removeClass('hidden')
          : $("div#text-input").addClass('hidden');
        switch(measureVal){
            case "new mod":
                $("#text-input-caption").html("New Moderator's Username:");
                break;
            case "remove mod":
                $("#text-input-caption").html("Moderator's Username:");
                break;
            case "new rule":
                $("#text-input-caption").html("New Rule:");
                break;
            case "remove rule":
                $("#text-input-caption").html("Rule #:");
                break;
            case "ban user":
                $("#text-input-caption").html("Username:");
                break;
                
        }
        
    });
    $(document).on('click', '.abandon-btn', function(event){
        if (confirm("Are you sure you want to abandon this?")){
            event.target.form.submit();
        }
    });
});
