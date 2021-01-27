$(function() {
    'use strict';
    var formErrors = ['.textcontent'];
    var regExpValidation = {
        "textcontent": /^[a-zA-Z.].{10,}$/,
    };
    var formErrorsMessage = {
        "textcontent": "Content is very short",
    }

    function removeSpecificElement(arr, elementValue) {
        for (var i = 0; i < arr.length; i++)
            if (arr[i] === elementValue)
                arr.splice(i, 1);
    }

    /*------------------------------- Text Content -------------------------------*/

    $('.textcontent').blur(function() { //blur
        if (!regExpValidation.textcontent.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.textcontent);
            // Add textcontent to Errors Array
            if (!formErrors.includes(".textcontent"))
                formErrors.push('.textcontent');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove textcontent From Errors Array
            if (formErrors.includes(".textcontent"))
                removeSpecificElement(formErrors, '.textcontent');
        }
        if (formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        } else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });


    // Submit Form Validation
    $('.ValidationForm').submit(function(e) {
        if ($.inArray('.textcontent', formErrors) != -1) { // If there is(are) Error(s)
            e.preventDefault();
            $('.textcontent').blur(); // To Show Error for Image has event is blur and have Error 
        }
        // console.log(formErrors);
    });

});