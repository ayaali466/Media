$('.profile_sidebar_li').click(function() { // maje highligh on activr
    $('.profile_sidebar_li, .li_contain_ul').removeClass('showed');
    $(this).addClass('showed');
});

$('#li_general_info').click(function() {
    $('#medical_info, #edit_profile_logo, #edit_profile, #delete_profile').hide();
    $('#general_info').show();
})

$('#li_medical_info').click(function() {
    $('#general_info, #edit_profile_logo, #edit_profile, #delete_profile').hide();
    $('#medical_info').show();
})

$('#li_edit_profile_logo').click(function() {
    $('#general_info, #medical_info, #edit_profile, #delete_profile').hide();
    $('#edit_profile_logo').show();
})

$('#li_edit_profile').click(function() {
    $('#general_info, #medical_info, #edit_profile_logo, #delete_profile').hide();
    $('#edit_profile').show();
})

$('#li_delete_profile').click(function() {
    alert('Are You Sure, You\'re on your way to delete your account');
    $('#general_info, #medical_info, #edit_profile_logo, #edit_profile').hide();
    $('#delete_profile').show();
})

// #general_info, #medical_info, #edit_profile_logo, #edit_profile