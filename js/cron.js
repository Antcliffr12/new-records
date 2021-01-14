$( document ).ready(function() {
    $('#submission').click(function() {
        console.log(cron.ajaxpage);
        let field_name = $('#checked').attr("name");
        let new_value = $('#checked').val();

        $.post(cron.ajaxpage,
            {
                field_name: field_name,
                new_value: new_value
            }
            ).done(function(data){
                $(".test").append(data);
            })
            .fail(function(err){
                console.log(err);
            })
    });


});