$(function() {
    'use strict';
    var formErrors = ['.name', '.imageprofile', '.textcontent', '.selected-governorate'];
    var regExpValidation = {
        "nameMinMaxLength": /^.{4,100}$/,
        "name": /^[a-zA-Z0][\w_\-\s\d]{3,99}$/,
        "image": /(?:\.jpg|\.jpeg|\.png)$/i,

        "textcontent": /^[a-zA-Z0-9 .\s\.\/\_\-\,\.\!\#\$\%\\&\'\*\+\/\=\?\^\_\`\{\|\}\~\-]{99,5000}$/,
    };
    var formErrorsMessage = {
        "name": "Article title must be between (4 - 100) characters A-Z, a-z, 0-9, -, _ and begining With alphabetic",
        "textcontent": "Content is very short",
        "image": "",
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
    /*------------------------------- title Validation -------------------------------*/
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

    /*------------------------------- Governorate -------------------------------*/
    $('.selected-governorate').change(function() {
        if ($(this).val() != null) {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove Governorate Errors Array
            if (formErrors.includes(".selected-governorate"))
                removeSpecificElement(formErrors, '.selected-governorate');
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available");
            $(this).css("border-color", "#dc3545");
            // Add Governorate to Errors Array
            if (!formErrors.includes(".selected-governorate"))
                formErrors.push('.selected-governorate');
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

    /*------------------------------- Text Content -------------------------------*/

    $('.textcontent').change(function() { //blur
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
    $('.imageprofile').change(function() {
        $('.input').parent().parent().find('.custom-alert').fadeOut(250);
        // console.log(this.files[0].name);
        // console.log(this.files[0].size);
        formErrorsMessage.image = "";
        if ($('.imageprofile').val() == "") {
            formErrorsMessage.image = "The article image is required";
        } else {
            if (!regExpValidation.image.test($(this).val())) {
                formErrorsMessage.image = "Invalid extension. available extensions are [ png | jpg | jpeg ]";
                // console.log("imageError1");
            } else if ((this.files[0].size / 1024 / 1024).toFixed(2) > 4) {
                formErrorsMessage.image = `File size is: <b>${(this.files[0].size / 1024 / 1024).toFixed(2)}</b> mega bytes exceeds maximum size <b>4</b> mega bytes !!!!`;
                // console.log("imageError2");
            }
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

    // Submit Form Validation
    $('.ValidationForm').submit(function(e) {
        if ($.inArray('.name', formErrors) != -1 || $.inArray('.imageprofile', formErrors) != -1 || $.inArray('.textcontent', formErrors) != -1 || $.inArray('.selected-governorate', formErrors) != -1) { // If there is(are) Error(s)
            e.preventDefault();
            $('.name').keyup(); // To Show Error for Which element has event is Keyup and have Error
            $('.imageprofile , .textcontent ,.selected-governorate').change(); // To Show Error for Image has event is change and have Error 
        }
        // console.log(formErrors);
    });

});