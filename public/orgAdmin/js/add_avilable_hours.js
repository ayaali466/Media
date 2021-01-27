$(function() { //
    var counter = 2;
    var num_of_available_hours = $('.available_hours_container').length;
    $(document).on('click', "form .row .available_hours_container i.fa-plus", function() {
        if (num_of_available_hours < 7) { // max 7 times
            $($(this).parent().parent()).clone().find('.time-from').attr('name', `from-${counter}`). //change name attribute of time from
            parent().parent().parent().find('.time-to').attr('name', `to-${counter}`). //change name attribute of time to
            parent().parent().parent().find('.available_hours').attr('name', `day-${counter++}`). // change name attribute of day
            parent().parent().parent()
                .insertAfter($(this).parent().parent());

            num_of_available_hours = $('.available_hours_container').length;
        } else {
            // max-available-hours
            $('.max-available-hours').fadeIn(500).html("Max available Times for each doctor is 7.");
        }
    });
    $(document).on('click', "form .row .available_hours_container i.fa-times", function() {
        $(this).parent().parent().remove();
        num_of_available_hours = $('.available_hours_container').length;
        $('.max-available-hours').fadeOut(500);
    });
})