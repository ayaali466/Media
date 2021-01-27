$(function() {
    'use strict';
    var passwordStrength = 0;
    var passwordStrengthFlags = {
        "lowerUpper": false,
        "special": false,
        "number": false,
        "length8": false
    };
    var formErrors = ['.name', '.email', '.address', '.selected-phone-code', '.phone-number', '.url', '.url-facebook', '.url-twitter', '.url-instagram', '.url-youtube', '.url-GoogleMap', '.selected-governorate', '.selected-city', '.about_us'];
    var regExpValidation = {
        "nameMinMaxLength": /^.{4,100}$/,
        "name": /^[a-zA-Z0-9][\w_\-\s]{3,99}$/,
        "address": /^[\d a-zA-Z][\d a-zA-Z\s\.\-\_\,]{9,}$/,
        'about_us': /^[a-zA-Z0-9 .\s\.\/\_\-\,\.\!\#\$\%\\&\'\*\+\/\=\?\^\_\`\{\|\}\~\-]{10,5000}$/,
        "email": /^\w+([\._-]?\w+)*@\w+([\.-_]?\w+)*(\.\w{2,3})+$/,
        "email1": /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
        "password": /^&/,
        "phonenumber": /^\d{8}$/,
        "url": /^$|^(?:http(s)?:\/\/)?\w+(?:[\w\.]+)+[\w\/?#&=]+$/,
        "urlFacebook": /^$|^http(s)?:\/\/www.facebook.com\/[\w\.]+$/,
        "urlTwitter": /^$|^http(s)?:\/\/www.twitter.com\/[\w\.]+$/,
        "urlInstagram": /^$|^http(s)?:\/\/www.instagram.com\/[\w\.]+$/,
        "urlYoutube": /^$|^http(s)?:\/\/www.youtube.com\/(c\/)?[\w\.]+$/,
        "urlGoogleMap": /^$|^http(s)?:\/\/goo\.gl\/maps\/[\w\.]+$/,
    };
    var formErrorsMessage = {
        "name": "name must be between (3 - 20) characters A-Z, a-z, 0-9, -, _ and begining With alphabetic",
        "email": "Email must be between (100 - 100) characters A-Z, a-z, 0-9, -, _",
        "address": "Address may not be empty!!!",
        "describtion": "Describtion may not be empty!!!",
        "Password": "",
        "urlWebsite": "URL , must be as http(s)://www.example.com",
        "urlFacebook": "URL , must be as http(s)://www.facebook.com/blablabla",
        "urlTwitter": "URL , must be as http(s)://www.twitter.com/blablabla",
        "urlInstagram": "URL , must be as http(s)://www.instagram.com/blablabla",
        "urlYoutube": "URL , must be as http(s)://www.youtube.com/blablabla",
        "urlGoogleMap": "URL , must be as http(s)://goo.gl/maps/blablabla . You must use share to get it"
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


    /*------------------------------- Email Validation -------------------------------*/
    $('.email').keyup(function() { //blur
        if (!regExpValidation.email.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.name);
            // Add Email to Errors Array
            if (!formErrors.includes(".email"))
                formErrors.push('.email');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Email From Errors Array
            if (formErrors.includes(".email"))
                removeSpecificElement(formErrors, '.email');
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


    /*------------------------------- Password Validation -------------------------------*/



    /*------------------------------- Phone Number -------------------------------*/
    $('.selected-phone-code').change(function() {
        if ($(this).val() == "02" || $(this).val() == "010" || $(this).val() == "011" || $(this).val() == "012" || $(this).val() == "015" || $(this).val() == "hotline") {
            $(this).parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove Confirmed Password Errors Array
            if (formErrors.includes(".selected-phone-code"))
                removeSpecificElement(formErrors, '.selected-phone-code');
        } else {
            $(this).parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
            $(this).css("border-color", "#dc3545");
            // Add Confirmed Password to Errors Array
            if (!formErrors.includes(".selected-phone-code"))
                formErrors.push('.selected-phone-code');
        }
        /*  if($('.phone-number').val())
             $('.phone-number').trigger( "blur" ); */
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

    $('.phone-number').blur(function() {
        if (($('.selected-phone-code').val() != "hotline" && regExpValidation.phonenumber.test($(this).val())) || ($('.selected-phone-code').val() == "hotline" && $(this).val().length == 5)) {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            if (formErrors.includes(".phone-number"))
                removeSpecificElement(formErrors, '.phone-number');
            if (!$('.selected-phone-code').val())
                $(this).parent().parent().find('.custom-alert').fadeIn(500).html("Please select the code");
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("Length of number must be 8 or 5 for Hotline.");
            // Add Confirmed Password to Errors Array
            if (!formErrors.includes(".phone-number"))
                formErrors.push('.phone-number');
        }
        /* if($('.selected-phone-code').val())
                $('.selected-phone-code').trigger('change'); */
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
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
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
    /*------------------------------- City -------------------------------*/
    $('.selected-city').change(function() {
        if ($(this).val() != null) {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove City Errors Array
            if (formErrors.includes(".selected-city"))
                removeSpecificElement(formErrors, '.selected-city');
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
            $(this).css("border-color", "#dc3545");
            // Add City to Errors Array
            if (!formErrors.includes(".selected-city"))
                formErrors.push('.selected-city');
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

    /*------------------------------- Address Validation -------------------------------*/
    $('.address').keyup(function() { //blur
        if (!regExpValidation.address.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.address);
            // Add address to Errors Array
            if (!formErrors.includes(".address"))
                formErrors.push('.address');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove address From Errors Array
            if (formErrors.includes(".address"))
                removeSpecificElement(formErrors, '.address');
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
    $('.about_us').keyup(function() { //blur
        if (!regExpValidation.about_us.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.describtion);
            // Add about_us to Errors Array
            if (!formErrors.includes(".about_us"))
                formErrors.push('.about_us');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove about_us From Errors Array
            if (formErrors.includes(".about_us"))
                removeSpecificElement(formErrors, '.about_us');
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
    /*------------------------------- URL -------------------------------*/

    /*------------------------------- Website -------------------------------*/
    $('.url').keyup(function() {
        if (!regExpValidation.url.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlWebsite);
            // Add Facebook to Errors Array
            if (!formErrors.includes(".url"))
                formErrors.push('.url');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Facebook From Errors Array
            if (formErrors.includes(".url"))
                removeSpecificElement(formErrors, '.url');
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
    /*------------------------------- Facebook -------------------------------*/
    $('.url-facebook').keyup(function() {
        if (!regExpValidation.urlFacebook.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlFacebook);
            // Add Facebook to Errors Array
            if (!formErrors.includes(".url-facebook"))
                formErrors.push('.url-facebook');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Facebook From Errors Array
            if (formErrors.includes(".url-facebook"))
                removeSpecificElement(formErrors, '.url-facebook');
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

    /*------------------------------- Twitter -------------------------------*/
    $('.url-twitter').keyup(function() {
        if (!regExpValidation.urlTwitter.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlTwitter);
            // Add Twitter to Errors Array
            if (!formErrors.includes(".url-twitter"))
                formErrors.push('.url-twitter');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Twitter From Errors Array
            if (formErrors.includes(".url-twitter"))
                removeSpecificElement(formErrors, '.url-twitter');
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

    /*------------------------------- Instagram -------------------------------*/
    $('.url-instagram').keyup(function() {
        if (!regExpValidation.urlInstagram.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlInstagram);
            // Add Instagram to Errors Array
            if (!formErrors.includes(".url-instagram"))
                formErrors.push('.url-instagram');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Instagram From Errors Array
            if (formErrors.includes(".url-instagram"))
                removeSpecificElement(formErrors, '.url-instagram');
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

    /*------------------------------- Youtube -------------------------------*/
    $('.url-youtube').keyup(function() {
        if (!regExpValidation.urlYoutube.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlYoutube);
            // Add Youtube to Errors Array
            if (!formErrors.includes(".url-youtube"))
                formErrors.push('.url-youtube');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Youtube From Errors Array
            if (formErrors.includes(".url-youtube"))
                removeSpecificElement(formErrors, '.url-youtube');
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

    /*------------------------------- Google Map -------------------------------*/
    $('.url-GoogleMap').keyup(function() {
        if (!regExpValidation.urlGoogleMap.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlGoogleMap);
            // Add Google Map to Errors Array
            if (!formErrors.includes(".url-GoogleMap"))
                formErrors.push('.url-GoogleMap');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Google Map From Errors Array
            if (formErrors.includes(".url-GoogleMap"))
                removeSpecificElement(formErrors, '.url-GoogleMap');
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

    function hasSubArray(master, sub) {
        return sub.every((i => v => i = master.indexOf(v, i) + 1)(0));
    }
    // Submit Form Validation
    $('.ValidationForm').submit(function(e) {
        if (
            $.inArray('.name', formErrors) != -1 ||
            $.inArray('.email', formErrors) != -1 ||
            $.inArray('.selected-phone-code', formErrors) != -1 ||
            $.inArray('.phone-number', formErrors) != -1 ||
            $.inArray('.selected-governorate', formErrors) != -1 ||
            $.inArray('.selected-city', formErrors) != -1
        ) { // If there is(are) Error(s)
            e.preventDefault();
            console.log(formErrors.join(","));
            $(formErrors.join(",")).keyup(); // To Show Error for Which element has event is Keyup and have Error
            $('.phone-number').blur(); // To Show Error for Confirmed Password has event is blur and have Error
            $('.selected-city,.selected-governorate, .selected-phone-code ').change(); // To Show Error for Image has event is change and have Error 
        }
        // console.log(formErrors);
    });

});