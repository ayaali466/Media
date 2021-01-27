$(function() {
    'use strict';
    var passwordStrength = 0;
    var passwordStrengthFlags = {
        "lowerUpper": false,
        "special": false,
        "number": false,
        "length8": false
    };
    var formErrors = ['.name', '.imageprofile', '.selected-department', '.description', '.job-title', '.fees'];
    if (profileImageSkip) {
        removeSpecificElement(formErrors, '.imageprofile');
    }
    var regExpValidation = {
        "nameMinMaxLength": /^.{4,100}$/,
        "name": /^[a-zA-Z][\w_\-\s]{3,49}$/,
        "title": /^[a-zA-Z][\d a-zA-Z][\d a-zA-Z\s\.\-\_\,.&]{3,150}$/,
        'description': /^.{10,255}$/,
        'fees': /^[1-9][\d]{1,4}$/,
        "image": /(?:\.jpg|\.jpeg|\.png)$/i,
    };
    var formErrorsMessage = {
        "name": "Doctor name must be between (4 - 50) characters A-Z, a-z, 0-9, -, _ , space and begining With alphabetic",
        "title": "Doctor name must be between (4 - 60) characters A-Z, a-z, 0-9, -, _ , space and begining With alphabetic",
        "describtion": "Describtion may not be empty!!! and not more than 200 Character",
    }

    function removeSpecificElement(arr, elementValue) {
        for (var i = 0; i < arr.length; i++)
            if (arr[i] === elementValue)
                arr.splice(i, 1);
    }


    /*------------------------------- Remove Custom Error Div if I focus on any input  ------------------------------*/
    $('input').focusin(function() {
        $('input').parent().parent().find('.custom-alert').fadeOut(250);
        $('select').parent().parent().find('.custom-alert').fadeOut(250);
    });
    $('select').focusin(function() {
        $('input').parent().parent().find('.custom-alert').fadeOut(250);
        $('select').parent().parent().find('.custom-alert').fadeOut(250);
    });
    /*------------------------------- name Validation -------------------------------*/
    $('.name').keyup(function() { //blur
        if (!regExpValidation.name.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.name);
            // Add name to Errors Array
            if (!formErrors.includes(".name"))
                formErrors.push('.name');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove name From Errors Array
            if (formErrors.includes(".name"))
                removeSpecificElement(formErrors, '.name');
        }

        // Check all fields Errors to Continue [ Submit ]
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

    /*------------------------------- Job Title -------------------------------*/
    $('.job-title').keyup(function() { //blur
        if (!regExpValidation.title.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.title);
            // Add job-title to Errors Array
            if (!formErrors.includes(".job-title"))
                formErrors.push('.job-title');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove job-title From Errors Array
            if (formErrors.includes(".job-title"))
                removeSpecificElement(formErrors, '.job-title');
        }

        // Check all fields Errors to Continue [ Submit ]
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
    /*------------------------------- Profile Image Validation -------------------------------*/
    if (!profileImageSkip) {
        $('.imageprofile').change(function() {
            $('.input').parent().parent().find('.custom-alert').fadeOut(250);
            // console.log(this.files[0].name);
            // console.log(this.files[0].size);
            formErrorsMessage.image = "";

            if (!regExpValidation.image.test($(this).val())) {
                formErrorsMessage.image = "Invalid extension. available extensions are [ png | jpg | jpeg ]";
                // console.log("imageError1");
            } else if ((this.files[0].size / 1024 / 1024).toFixed(2) > 4) {
                formErrorsMessage.image = `File size is: <b>${(this.files[0].size / 1024 / 1024).toFixed(2)}</b> mega bytes exceeds maximum size <b>4</b> mega bytes !!!!`;
                // console.log("imageError2");
            }

            // console.log(formErrorsMessage.image);
            if (formErrorsMessage.image == "") { /* If there is no Error */
                $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
                // console.log("image Valid");
                if (formErrors.includes(".imageprofile"))
                    removeSpecificElement(formErrors, '.imageprofile');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.image);
                if (!formErrors.includes(".imageprofile"))
                    formErrors.push('.imageprofile');
            }

            // Check all fields Errors to Continue [ Submit ]
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
    }


    /*------------------------------- Governorate -------------------------------*/
    $('.selected-department').change(function() {
        if ($(this).val() != null) {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove Governorate Errors Array
            if (formErrors.includes(".selected-department"))
                removeSpecificElement(formErrors, '.selected-department');
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
            $(this).css("border-color", "#dc3545");
            // Add Governorate to Errors Array
            if (!formErrors.includes(".selected-department"))
                formErrors.push('.selected-department');
        }

        // Check all fields Errors to Continue [ Submit ]
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


    /*------------------------------- AboutUs Validation -------------------------------*/
    $('.description').keyup(function() { //blur
        if (!regExpValidation.description.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.describtion);
            // Add description to Errors Array
            if (!formErrors.includes(".description"))
                formErrors.push('.description');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove description From Errors Array
            if (formErrors.includes(".description"))
                removeSpecificElement(formErrors, '.description');
        }

        // Check all fields Errors to Continue [ Submit ]
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

    /*------------------------------- AboutUs Validation -------------------------------*/
    $('.fees').change(function() { //blur
        if (!regExpValidation.fees.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("Doctor fees must be between (2 - 5) digits and fiest digit not Zero.");
            // Add fees to Errors Array
            if (!formErrors.includes(".fees"))
                formErrors.push('.fees');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove fees From Errors Array
            if (formErrors.includes(".fees"))
                removeSpecificElement(formErrors, '.fees');
        }

        // Check all fields Errors to Continue [ Submit ]
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
        if (profileImageSkip) {
            if (
                ($.inArray('.name', formErrors) != -1 ||
                    $.inArray('.job-title', formErrors) != -1 ||
                    $.inArray('.selected-department', formErrors) != -1 ||
                    $.inArray('.description', formErrors) != -1 ||
                    $.inArray('.fees', formErrors) != -1)
            ) { // If there is(are) Error(s)
                e.preventDefault();
                $('.name, .job-title, .description').keyup(); // To Show Error for Which element has event is Keyup and have Error
                $('.phone-number').blur(); // To Show Error for Confirmed Password has event is blur and have Error
                $('.selected-department , .fees').change(); // To Show Error for Image has event is blur and have Error 
            }
        } else if (
            ($.inArray('.name', formErrors) != -1 ||
                $.inArray('.job-title', formErrors) != -1 ||
                $.inArray('.imageprofile', formErrors) != -1 ||
                $.inArray('.selected-department', formErrors) != -1 ||
                $.inArray('.description', formErrors) != -1 ||
                $.inArray('.fees', formErrors) != -1)
        ) { // If there is(are) Error(s)
            e.preventDefault();
            $('.name, .job-title, .description').keyup(); // To Show Error for Which element has event is Keyup and have Error
            $('.phone-number').blur(); // To Show Error for Confirmed Password has event is blur and have Error
            $('.imageprofile, .selected-department , .fees').change(); // To Show Error for Image has event is blur and have Error 
        }
        $('.available_hours_container').each(function(index) {
                $(this).find('.time-from').attr('name', `from-${index+1}`);
                $(this).find('.time-to').attr('name', `to-${index+1}`);
                $(this).find('.available_hours').attr('name', `day-${index+1}`);
            })
            // console.log(formErrors);
    });

});