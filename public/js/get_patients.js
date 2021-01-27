$(function() {
    $('#city_id').hover(function() {
        if ($('#governorate_id').val() == null) {
            $('#city_id option[value=""]').html('Select Governorate First').parent().addClass('text-danger');
        }
    });
    $('#city_id').mouseleave(function() {
        $('#city_id option[value=""]').html('* City').parent().removeClass('text-danger');
    });
    var previous = $('#governorate_id').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); // For Send With POST
    $('#governorate_id').change(function(e) {
        e.preventDefault();
        if ($('#governorate_id').val() != null && $('#governorate_id').val() != previous) {
            previous = $('#governorate_id').val();
            sendRequest($(this).val());
        }
    });
    var city = "";
    $(document).ajaxSend(function() {
        // Show loading when request sended
        $("#loading_untill_request_done").fadeIn(300);　
    });

    function sendRequest(governorateId) {
        $.ajax({
            // url: "{{ route('showCorrespondingCities') }}",
            url: "http://localhost/medicalCareFinal/public/ajax/showCorrespondingCities",
            method: "POST",
            // data: {category: selectedCategory},
            data: { _token: CSRF_TOKEN, governorate: governorateId }, // For Send With POST
            dataType: "json",
            success: function(responseData) {
                // Function To Run If Request Is Successed
                $('#city_id').empty();
                $('#city_id').append("<option selected disabled value=\"\">* City</option>");
                for (var i = 0; i < responseData.length; i++) {
                    city = "<option value=" + responseData[i].id + " >" + responseData[i].city_name + "</option>";
                    $('#city_id').append(city);
                }
                // Remove Loading when repone come
                setTimeout(function() {
                    $("#loading_untill_request_done").fadeOut(300);
                }, 500);
            }
        })
    }
})