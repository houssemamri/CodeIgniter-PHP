jQuery(document).ready(function ()
{
    'use strict';
    //var url = jQuery('.navbar-brand').attr('href');
	var url=jQuery('#base_url').val();
    jQuery('.advanced-settings').submit(function (e)
    {
        // this function updates user data
        e.preventDefault();
        // check if the password match
        if (jQuery('.password').val() !== jQuery('.rpassword').val()) {
            // Display error message
            popup_fon('sube', translation.mm139, 1500, 2000);
            return;
        }
        var name = jQuery('input[name="csrf_test_name"]').val();
        // create an object with form data
        var data = {password: jQuery('.password').val(), email: jQuery('.email').val(), csrf_test_name: name};
        // submit data via ajax
		
        jQuery.ajax({
            url: url + 'user/update-userinfo',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data)
            {
                jQuery('.alert-msg').show();
                jQuery('.alert-msg').html(data);
                jQuery('.success').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.success').remove();
                    jQuery('.alert-msg').hide();
                });
                jQuery('.error').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.error').remove();
                    jQuery('.alert-msg').hide();
                });
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('.delete-account').click(function ()
    {
        jQuery('.confirm').fadeIn('slow');
    });
    jQuery(document).on('click', '.confirm .no', function (e)
    {
        e.preventDefault();
        jQuery('.confirm').fadeOut('slow');
    });
    jQuery(document).on('click', '.delete-user-account', function (e)
    {
        // this function deletes user account
        e.preventDefault();
		
        jQuery.ajax({
            url: url + 'user/delete-account/',
            dataType: 'json',
            type: 'GET',
            success: function (data)
            {
                if (data.data)
                {
                    jQuery('.alert-msg').show();
                    jQuery('.alert-msg').html(data.data);
                    jQuery('.success').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                    {
                        jQuery('.success').remove();
                        jQuery('.alert-msg').hide();
                    });
                    jQuery('.error').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                    {
                        jQuery('.error').remove();
                        jQuery('.alert-msg').hide();
                    });
                }
                if (data.success == 1)
                {
                    // redirect to home after 5 seconds
                    setTimeout(redirect_to_login, 5000);
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed: ' + textStatus);
                jQuery('.alert-msg').show();
                jQuery('.alert-msg').html(data);
                jQuery('.error').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.error').remove();
                    jQuery('.alert-msg').hide();
                });
            },
        });
    });
    function redirect_to_login()
    {
		
        document.location.href = url;
    }
});