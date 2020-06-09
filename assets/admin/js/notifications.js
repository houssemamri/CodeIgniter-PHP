jQuery(document).ready(function () {
    // this file contains send and update message's templates
    'use strict';
    var url = jQuery('.navbar-brand').attr('href');
    jQuery('#summernote').summernote();
    jQuery('.note-editable').on('blur', function ()
    {
        jQuery('.msg-body').val(jQuery('#summernote').summernote('code'));
    });
    jQuery('.send-mess').submit(function (e)
    {
        // send notifications by email
        e.preventDefault();
        var msg_body = btoa(encodeURIComponent(jQuery('.msg-body').val()));
        var msg_title = btoa(encodeURIComponent(jQuery('.msg-title').val()));
		msg_body = msg_body.replace('/', '-');
		msg_body = msg_body.replace(/=/g, '');
		msg_title = msg_title.replace('/', '-');
		msg_title = msg_title.replace(/=/g, '');		
        var template = jQuery('.template').val();
        var name = jQuery('input[name="csrf_test_name"]').val();
        // load gif loading icon
        jQuery('img.display-none').fadeIn('slow');
        // create an object with form data
        var data = {'title': msg_title, 'body': msg_body, 'template': template, 'csrf_test_name': name};
        // submit data via ajax
        jQuery.ajax({
            url: url + 'admin/notification/',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data)
            {
                jQuery('.alert-msg').show();
                jQuery('.alert-msg').html(data);
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                    jQuery('.merror').remove();
                    jQuery('.alert-msg').hide();
                });
                jQuery('.msuccess').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                    jQuery('.msuccess').remove();
                    jQuery('.alert-msg').hide();
                });
                // refresh sent notifications list
                load_all_sent_notifications();
            },
            complete: function () {
                jQuery('img.display-none').fadeOut('slow');
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed: ' + textStatus);
            }
        });
    });
    jQuery(document).on('click', '.list-group-item', function ()
    {
        if (jQuery(this).attr('data-id'))
        {
            var id = jQuery(this).attr('data-id');
            // add active class
            jQuery('.list-group-item').removeClass('active');
            jQuery(this).addClass('active');
            // submit data via ajax
            jQuery.ajax({
                url: url + 'admin/get-notification/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data)
                {
                    if (data[0].notification_body)
                    {
                        jQuery('#summernote').summernote('code', data[0].notification_body);
                        jQuery('.msg-body').val(data[0].notification_body);
                    }
                    if (data[0].notification_title)
                    {
                        jQuery('.msg-title').val(data[0].notification_title);
                    }
                    if (data[0].template_name)
                    {
                        jQuery('.template').val(data[0].template_name);
                        jQuery('.buttons>.btn-danger').hide();
                        jQuery('.buttons>.send-msg').hide();
                        jQuery('.buttons>.update-msg').show();
                    }
                    else
                    {
                        jQuery('.template').val('');
                        jQuery('.buttons>.btn-danger').show();
                        jQuery('.buttons>.btn-danger').attr('data-id', id);
                        jQuery('.buttons>.send-msg').show();
                        jQuery('.buttons>.update-msg').hide();
                    }
                },
                error: function (data, jqXHR, textStatus)
                {
                    console.log('Request failed: ' + textStatus);
                }
            });
        }
    });
    jQuery(document).on('click', '.delete-notification', function ()
    {
        if (jQuery(this).attr('data-id'))
        {
            var id = jQuery(this).attr('data-id');
            jQuery.ajax({
                url: url + 'admin/del-notification/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data)
                {
                    if (data.indexOf('msuccess') >= 0) {
                        document.getElementsByClassName('send-mess')[0].reset();
                        jQuery('#summernote').summernote('code', ' ')
                    }
                    jQuery('.alert-msg').show();
                    jQuery('.buttons>.btn-danger').hide();
                    jQuery('.alert-msg').html(data);
                    jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                        jQuery('.merror').remove();
                        jQuery('.alert-msg').hide();
                    });
                    jQuery('.msuccess').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                        jQuery('.msuccess').remove();
                        jQuery('.alert-msg').hide();
                    });
                },
                error: function (data, jqXHR, textStatus)
                {
                    console.log('Request failed: ' + textStatus);
                }
            });
            // refresh sent notifications list
            load_all_sent_notifications()
        }
    });
    function load_all_sent_notifications()
    {
        // get all sent notification
        jQuery.ajax({
            url: url + 'admin/get-notifications/',
            type: 'GET',
            dataType: 'json',
            success: function (data)
            {
                if (data)
                {
                    var notifications = '';
                    for (var u = 0; u < data.notification.length; u++) {
                        notifications += '<li class="list-group-item" data-id="' + data.notification[u].notification_id + '"><i class="fa fa-share" aria-hidden="true"></i> ' + data.notification[u].notification_title + ' <span class="pull-right">' + calculate_time(data.notification[u].sent_time, data.time) + '</span></li>';
                    }
                    jQuery('#sent .list-group').html(notifications);
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed: ' + textStatus);
                jQuery('#sent .list-group').html('<li class="list-group-item">'+translation.mm142+'</li>');
            }
        });
    }
});