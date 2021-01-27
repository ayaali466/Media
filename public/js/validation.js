$(function(){
    'use strict';
    var passwordStrength = 0;
    var passwordStrengthFlags = {
        "lowerUpper" : false,
        "special" : false,
        "number" : false,
        "length8" : false
    };
    var formErrors=['.username', '.email', '.password', '.confirmed-password', '.image' ,'.selected-phone-code', '.phone-number', '.url-facebook', '.url-twitter', '.url-instagram', '.url-youtube', '.url-GoogleMap','.selected-governorate' ,'.selected-city'];
    var regExpValidation={
        "usernameMinMaxLength" : /^.{2,20}$/,
        "username" : /^[a-zA-Z][\w_\-]{2,20}$/,
        "email" : /^\w+([\._-]?\w+)*@\w+([\.-_]?\w+)*(\.\w{2,3})+$/,
        "email1" : /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
        "image" : /(?:\.jpg|\.jpeg|\.png)$/i,
        "password" : /^&/,
        "phonenumber" : /^\d{8}$/,
        "url" : /^(?:http(s)?:\/\/)?\w+(?:[\w\.]+)+[\w\/?#&=]+$/,
        "urlFacebook" : /^http(s)?:\/\/www.facebook.com\/[\w\.]+$/,
        "urlTwitter" : /^http(s)?:\/\/www.twitter.com\/[\w\.]+$/,
        "urlInstagram" : /^http(s)?:\/\/www.instagram.com\/[\w\.]+$/,
        "urlYoutube" : /^http(s)?:\/\/www.youtube.com\/[\w\.]+$/,
        "urlGoogleMap" : /^http(s)?:\/\/goo\.gl\/maps\/[\w\.]+$/,
    };
    var formErrorsMessage = {
        "username" : "Username must be between (3 - 20) characters A-Z, a-z, 0-9, -, _ and begining With alphabetic",
        "email" : "Email must be between (100 - 100) characters A-Z, a-z, 0-9, -, _",
        "Password" : "",
        "image" :"",
        "urlFacebook" : "URL , must be as http(s)://www.facebook.com/blablabla",
        "urlTwitter" : "URL , must be as http(s)://www.twitter.com/blablabla",
        "urlInstagram" : "URL , must be as http(s)://www.instagram.com/blablabla",
        "urlYoutube" : "URL , must be as http(s)://www.youtube.com/blablabla",
        "urlGoogleMap" : "URL , must be as http(s):https://goo.gl/maps/blablabla . You must use share to get it"        
    }

    function removeSpecificElement(arr, elementValue) {
        for( var i = 0; i < arr.length; i++)
            if ( arr[i] === elementValue)
                arr.splice(i, 1);
    }


    /*------------------------------- Remove Custom Error Div if I focus on any input  ------------------------------*/
    $('input').focusin(function () { 
        $('input').parent().parent().find('.custom-alert').fadeOut(250);
        $('select').parent().parent().find('.custom-alert').fadeOut(250);
     });
     $('select').focusin(function () { 
        $('input').parent().parent().find('.custom-alert').fadeOut(250);
        $('select').parent().parent().find('.custom-alert').fadeOut(250);
     });
    /*------------------------------- Username Validation -------------------------------*/
    $('.username').keyup(function(){//blur
        if(!regExpValidation.username.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.username);
            // Add username to Errors Array
            if(!formErrors.includes(".username"))
                formErrors.push('.username');
        }
        else {
             $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove username From Errors Array
            if(formErrors.includes(".username"))
                removeSpecificElement(formErrors,'.username');
        }
        
        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });


    /*------------------------------- Email Validation -------------------------------*/
    $('.email').keyup(function(){//blur
        if(!regExpValidation.email.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.username);
            // Add Email to Errors Array
            if(!formErrors.includes(".email"))
                formErrors.push('.email');
        }
        else {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Email From Errors Array
            if(formErrors.includes(".email"))
                removeSpecificElement(formErrors,'.email');
        }

        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });


    /*------------------------------- Password Validation -------------------------------*/

    // Show Password Strength When Focus on Password inPut Only
    $('.password').focusout(function(){
        $('#password-strength').fadeOut(100);;
     });
     $('.password').focusin(function(){
        $('#password-strength').fadeIn(500);
     });
     
     
    $('.password').keyup(function (){ 
        passwordStrength=0;

        //If password contains both lower and uppercase characters, increase strength value.
        if ($(this).val().match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            passwordStrength += 1;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa-times').addClass('fa-check');
        } else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa-times').removeClass('fa-check');
        }

        //If it has minimum one number, increase strength value.
        if ($(this).val().match(/([0-9])/)) {
            passwordStrength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa-times').addClass('fa-check');

        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa-times').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }
        
        //If it has one special character, increase strength value.
        if ($(this).val().match(/[~!@#$%<>\^\&\*_\+\-\|\?\.\,\[\]\{\}\(\)]/)) {
            passwordStrength += 1;
            $('.one-special-char').addClass('text-success');
            $('.one-special-char i').removeClass('fa-times').addClass('fa-check');
        } else {
            $('.one-special-char').removeClass('text-success');
            $('.one-special-char i').addClass('fa-times').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }
        //If its length is 8 characters or more.
        if ($(this).val().length > 7) {
            passwordStrength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa-times').addClass('fa-check');

        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa-times').removeClass('fa-check');
            $('#popover-password-top').removeClass('hide');
        }


        // Strength Message Value

        // If value is less than 2
        if (passwordStrength == 0) {
            $('#result').removeClass();
            $('#password-strength-progress').removeClass();
            $('#password-strength-progress').addClass('progress-bar bg-danger');
            $('#result').addClass('text-warning').text('')
            $('#password-strength-progress').css('width', '0%');
        }
        else if (passwordStrength <= 1) {
            $('#result').removeClass();
            $('#password-strength-progress').removeClass();

            $('#password-strength-progress').addClass('progress-bar bg-danger');
            $('#result').addClass('text-danger').text('Very Week');
            $('#password-strength-progress').css('width', '25%');
        } else if (passwordStrength == 2) {
            $('#result').removeClass();
            $('#password-strength-progress').removeClass();

            $('#password-strength-progress').addClass('progress-bar bg-warning');
            $('#result').addClass('text-warning').text('Week')
            $('#password-strength-progress').css('width', '50%');
        } else if (passwordStrength == 3) {
            $('#result').removeClass();
            $('#password-strength-progress').removeClass();

            $('#password-strength-progress').addClass('progress-bar bg-info');
            $('#result').addClass('text-info').text('Good')
            $('#password-strength-progress').css('width', '75%');
        }
        
        else if (passwordStrength == 4) {
            $('#result').removeClass();
            $('#password-strength-progress').removeClass();

            $('#password-strength-progress').addClass('progress-bar bg-success');
            $('#result').addClass('text-success').text('Strong');
            $('#password-strength-progress').css('width', '100%');
        }

        if(passwordStrength == 4) {
            $(this).removeClass('is-invalid').addClass('is-valid');
            // Remove Password From Errors Array
            if(formErrors.includes(".password"))
                removeSpecificElement(formErrors,'.password');
        }
        else {
            $(this).removeClass('is-valid').addClass('is-invalid');
            // Add password to Errors Array
            if(!formErrors.includes(".password"))
                formErrors.push('.password');
        }

        // Check if change password after edit Confirmed Password
        if($('.confirm-password').val() != '')
            $('.confirm-password').blur();

        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

     });


    /*------------------------------- Password Confirmation -------------------------------*/
     $('.confirm-password').blur(function() { // keyup
        if (passwordStrength == 4) {
            if($('.password').val() == $('.confirm-password').val()) {
                $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
                // Remove Confirmed Password Errors Array
                if(formErrors.includes(".confirmed-password"))
                    removeSpecificElement(formErrors,'.confirmed-password'); 
            }
            else {
                $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("The password you entered don't match. Please re-enter the confirmed password");
                // Add Confirmed Password to Errors Array
                if(!formErrors.includes(".confirmed-password"))
                    formErrors.push('.confirmed-password');
            }

        } else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("Main Password not available. Please check it !!!");
            // Add Confirmed Password to Errors Array
            if(!formErrors.includes(".confirmed-password"))
                formErrors.push('.confirmed-password');
        }

        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });
    
    /*------------------------------- Phone Number -------------------------------*/
    $('.selected-phone-code').change(function() {
        if($(this).val() == "02" || $(this).val() == "010" || $(this).val() == "011" || $(this).val() == "012" || $(this).val() == "015")
        {
            $(this).parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove Confirmed Password Errors Array
            if(formErrors.includes(".selected-phone-code"))
                removeSpecificElement(formErrors,'.selected-phone-code'); 
        }
        else {
            $(this).parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
            $(this).css("border-color", "#dc3545");
            // Add Confirmed Password to Errors Array
            if(!formErrors.includes(".selected-phone-code"))
                formErrors.push('.selected-phone-code');
        }

         // Check all fields Errors to Continue [ Submit ]
         if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });

    $('.phone-number').blur(function (){ 
        if(regExpValidation.phonenumber.test($(this).val()))
        {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            if(formErrors.includes(".phone-number"))
                removeSpecificElement(formErrors,'.phone-number'); 
            if(!$('.selected-phone-code').val())
                $(this).parent().parent().find('.custom-alert').fadeIn(500).html("Please select the code");
        }
        else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("Length of number must be 8.");
            // Add Confirmed Password to Errors Array
            if(!formErrors.includes(".phone-number"))
            formErrors.push('.phone-number');
        }

         // Check all fields Errors to Continue [ Submit ]
         if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

     });

    /*------------------------------- Profile Image Validation -------------------------------*/
    $('.image').change(function(){
        $('.input').parent().parent().find('.custom-alert').fadeOut(250);
            // console.log(this.files[0].name);
            // console.log(this.files[0].size);
            formErrorsMessage.image = "";

            if(!regExpValidation.image.test($(this).val())) {
                formErrorsMessage.image = "Invalid extension. available extensions are [ png | jpg | jpeg ]";
                // console.log("imageError1");
                }
            else if((this.files[0].size / 1024 / 1024).toFixed(2) > 4) {
                formErrorsMessage.image = `File size is: <b>${(this.files[0].size / 1024 / 1024).toFixed(2)}</b> mega bytes exceeds maximum size <b>4</b> mega bytes !!!!`;
                // console.log("imageError2");
            }

            // console.log(formErrorsMessage.image);
            if(formErrorsMessage.image == "") {/* If there is no Error */
                $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
                // console.log("image Valid");
                if(formErrors.includes(".image"))
                removeSpecificElement(formErrors,'.image');
            }
            else {
                $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.image);
                if(!formErrors.includes(".image"))
                    formErrors.push('.image');
            }

        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });

    /*------------------------------- Governorate -------------------------------*/
    $('.selected-governorate').change(function(){
        if($(this).val() >= 1 && $(this).val() <= 3)
        {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove Governorate Errors Array
            if(formErrors.includes(".selected-governorate"))
                removeSpecificElement(formErrors,'.selected-governorate'); 
        }
        else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
            $(this).css("border-color", "#dc3545");
            // Add Governorate to Errors Array
            if(!formErrors.includes(".selected-governorate"))
                formErrors.push('.selected-governorate');
        }

         // Check all fields Errors to Continue [ Submit ]
         if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }
    });
    /*------------------------------- City -------------------------------*/
    $('.selected-city').change(function(){
        if($(this).val() >= 1 && $(this).val() <= 8)
        {
            $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            $(this).css("border-color", "#28a745");
            // Remove City Errors Array
            if(formErrors.includes(".selected-city"))
                removeSpecificElement(formErrors,'.selected-city'); 
        }
        else {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html("You selected value not available <i class='fas fa-bug'></i>");
            $(this).css("border-color", "#dc3545");
            // Add City to Errors Array
            if(!formErrors.includes(".selected-city"))
                formErrors.push('.selected-city');
        }

         // Check all fields Errors to Continue [ Submit ]
         if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }
    });
    /*------------------------------- URL -------------------------------*/

    /*------------------------------- Facebook -------------------------------*/
    $('.url-facebook').keyup(function(){
        if(!regExpValidation.urlFacebook.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlFacebook);
            // Add Facebook to Errors Array
            if(!formErrors.includes(".url-facebook"))
                formErrors.push('.url-facebook');
        }
        else {
             $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Facebook From Errors Array
            if(formErrors.includes(".url-facebook"))
                removeSpecificElement(formErrors,'.url-facebook');
        }
        
        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });

    /*------------------------------- Twitter -------------------------------*/
    $('.url-twitter').keyup(function(){
        if(!regExpValidation.urlTwitter.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlTwitter);
            // Add Twitter to Errors Array
            if(!formErrors.includes(".url-twitter"))
                formErrors.push('.url-twitter');
        }
        else {
             $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Twitter From Errors Array
            if(formErrors.includes(".url-twitter"))
                removeSpecificElement(formErrors,'.url-twitter');
        }
        
        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });
    
    /*------------------------------- Instagram -------------------------------*/
    $('.url-instagram').keyup(function(){
        if(!regExpValidation.urlInstagram.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlInstagram);
            // Add Instagram to Errors Array
            if(!formErrors.includes(".url-instagram"))
                formErrors.push('.url-instagram');
        }
        else {
             $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Instagram From Errors Array
            if(formErrors.includes(".url-instagram"))
                removeSpecificElement(formErrors,'.url-instagram');
        }
        
        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });
       
    /*------------------------------- Youtube -------------------------------*/
    $('.url-youtube').keyup(function(){
        if(!regExpValidation.urlYoutube.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlYoutube);
            // Add Youtube to Errors Array
            if(!formErrors.includes(".url-youtube"))
                formErrors.push('.url-youtube');
        }
        else {
             $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Youtube From Errors Array
            if(formErrors.includes(".url-youtube"))
                removeSpecificElement(formErrors,'.url-youtube');
        }
        
        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });

    /*------------------------------- Google Map -------------------------------*/
    $('.url-GoogleMap').keyup(function(){
        if(!regExpValidation.urlGoogleMap.test($(this).val())) {
            $(this).removeClass('is-valid').addClass('is-invalid').parent().parent().find('.custom-alert').fadeIn(500).html(formErrorsMessage.urlGoogleMap);
            // Add Google Map to Errors Array
            if(!formErrors.includes(".url-GoogleMap"))
                formErrors.push('.url-GoogleMap');
        }
        else {
             $(this).removeClass('is-invalid').addClass('is-valid').parent().parent().find('.custom-alert').fadeOut(250);
            // Remove Google Map From Errors Array
            if(formErrors.includes(".url-GoogleMap"))
                removeSpecificElement(formErrors,'.url-GoogleMap');
        }
        
        // Check all fields Errors to Continue [ Submit ]
        if(formErrors.length == 0) {
            $('#all-field-well i').removeClass('fa-times').addClass('fa-check');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' All is Well';
            // Remove Disable from submit button
            //$(".ValidationForm button[type='submit']").removeAttr('disabled');
        }
        else {
            $('#all-field-well i').removeClass('fa-check').addClass('fa-times');
            document.getElementById('all-field-well').childNodes[1].nodeValue = ' Enter all fields to Continue';
            // Add Disable To submit button
            //$(".ValidationForm button[type='submit']").attr('disabled',true);
        }

    });


    // Submit Form Validation
    $('.ValidationForm').submit(function (e) { 
        if(formErrors.length != 0){ // If there is(are) Error(s)
            e.preventDefault();
            if(formErrors.includes(".password"))
                $('.password').focusin();// To Show Password Strength Must be the first as any focusin eventon any input remove custom alert
            
            $(formErrors.join(",")).keyup(); // To Show Error for Which element has event is Keyup and have Error
            $('.phone-number').blur(); // To Show Error for Confirmed Password has event is blur and have Error
            $('.image, .selected-governorate, .selected-city').change(); // To Show Error for Image has event is blur and have Error 
        }
        
    });

});