$(function() {

    $('#type_id').hover(function() {
        if ($('#category_id').val() == null) {

            $('#type_id option[value=""]').html('Select Category First').parent().addClass('text-danger');
        }
    });
    $('#type_id').mouseleave(function() {
        $('#type_id option[value=""]').html('* Type').parent().removeClass('text-danger');
    });


    var previous = $('#category_id').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); // For Send With POST
    $('#category_id').change(function(e) {
        e.preventDefault();
        if ($('#category_id').val() == 5 || $('#category_id').val() == 6) {
            $('#type_id').parent().fadeOut(300);
            previous = $('#category_id').val();
        } else if ($('#category_id').val() != null && $('#category_id').val() != previous) {
            $('#type_id').parent().fadeIn(300);
            previous = $('#category_id').val();
            sendRequest($(this).val());
        }
    });
    var city = "";
    $(document).ajaxSend(function() {
        // Show loading when request sended
        $("#loading_untill_request_done").fadeIn(300);　
    });

    function sendRequest(category_id) {
        $.ajax({
            // url: "{{ route('showCorrespondingCities') }}",
            url: "http://localhost/medicalCareFinal/public/ajax/showCorrespondingCategory",
            method: "POST",
            // data: {category: selectedCategory},
            data: { _token: CSRF_TOKEN, category_id: category_id }, // For Send With POST
            dataType: "json",
            success: function(responseData) {
                // Function To Run If Request Is Successed
                $('#type_id').empty();
                $('#type_id').append("<option selected disabled value=\"\">* Type</option>");
                // console.log(responseData);
                if (responseData.length != 0) {
                    for (var i = 0; i < responseData.length; i++) {
                        types = "<option value=" + responseData[i].id + " >" + responseData[i].name + "</option>";
                        $('#type_id').append(types);
                    }
                }
                // Remove Loading when repone come
                setTimeout(function() {
                    $("#loading_untill_request_done").fadeOut(300);
                }, 0);
            }
        })
    }
})