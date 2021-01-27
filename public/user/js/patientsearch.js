$(function() {
    var A = document.getElementById("patient_search_input");
    A.focus();
    $('#patient_search_input').keyup(function() {
        // Send Ajax Request
        if ($(this).val().length >= 3)
            sendRequest($(this).val());
        else {
            $('.patient_search_result_container').html(''); // remove the data from container
            $('.patient_search_result_container').append('<p class = "text-muted text-center message" > Please Enter Patient National ID or Name </p>');
        }
    });

    $(document).ajaxSend(function() {
        // Show loading when request sended
        $("#loading_untill_request_done").fadeIn(300);　
    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); // For Send With POST
    function sendRequest(patientSearchValue) {
        $.ajax({
            // url: "{{ route('showCorrespondingCities') }}",=
            url: "http://localhost/medicalCareFinal/public/ajax/getPatients",
            method: "POST",
            // data: {category: selectedCategory},
            data: { _token: CSRF_TOKEN, SearchValue: patientSearchValue }, // For Send With POST
            dataType: "json",
            success: function(responseData) {
                // Function To Run If Request Is Successed
                $('.patient_search_result_container').html(''); // remove the data from container
                if (responseData.length == 0 && !$('#patient_search_input').val())
                    $('.patient_search_result_container').append('<p class = "text-muted text-center message" > Please Enter Patient National ID or Name </p>');

                else if (responseData.length == 0 && $('#patient_search_input').val())
                    $('.patient_search_result_container').append('<p class="text-center text-danger"><b>Please Enter Correct Patient National ID  or Name</b></p>'); // if no result display message
                var gender = 0;
                for (var i = 0; i < responseData.length; i++) {
                    if (responseData[i].gender)
                        gender = "Male";
                    else
                        gender = "Female";
                    $('.patient_search_result_container').append(`<div class="patient_search_result"> <a href=http://localhost/medicalCareFinal/public/org_admin/search_patient/${responseData[i].id}>${responseData[i].name} </a> <span>National ID: ${responseData[i].national_id}</span> <span>Gender: ${gender}</span> </div > `);
                }
                setTimeout(function() {
                    $("#loading_untill_request_done").fadeOut(300);
                }, 0);
            }
        })
    }
})