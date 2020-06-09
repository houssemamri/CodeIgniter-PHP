jQuery(document).ready(function () {
    'use strict';
    var url = jQuery('.navbar-brand').attr('href');
    var update = {plan: 0};
    jQuery('.create-plan').submit(function (e) {
        // Create a new plan
        e.preventDefault();
        var plan_name = jQuery('.plan_name').val();
        var plan_price = jQuery('.plan_price').val();
        var currency_code = jQuery('.currency_code').val();
        var currency_sign = jQuery('.currency_sign').val();
        var allowed_accounts = jQuery('.allowed_accounts').val();
        var allowed_rss = jQuery('.allowed_rss').val();
        var accounts_number = jQuery('.accounts_number').val();
        var limit_posts_month = jQuery('.limit_posts_month').val();
        var limit_videos = jQuery('.limit_videos').val();
        var limit_images = jQuery('.limit_images').val();
        var features_plan = jQuery('.features_plan').val();
        var period_plan = jQuery('.period_plan').val();
        var name = jQuery('input[name="csrf_test_name"]').val();
        var emails = jQuery('.number_emails').val();
        var teams = jQuery('.teams').val();
        var status = jQuery('.plan-status').val();
        var allowed_networks = {};
        if ( typeof update.allowed_networks != 'undefined' ) {
            allowed_networks = update.allowed_networks;
        }
        // create an object with form data
        var data = {'plan_name': plan_name, 'plan_price': plan_price, 'allowed_accounts': allowed_accounts, 'allowed_rss': allowed_rss, 'accounts_number': accounts_number, 'limit_posts_month': limit_posts_month, 'limit_videos': limit_videos, 'limit_images': limit_images, 'features_plan': features_plan, 'period_plan': period_plan, 'update': update.plan, 'currency_code': currency_code, 'currency_sign': currency_sign, 'emails': emails, 'allowed_networks': allowed_networks, 'teams': teams, 'status': status, 'csrf_test_name': name};
        // submit data via ajax
        jQuery.ajax({
            url: url + 'admin/plan/',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
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
                show_plans();
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
            }
        });
    });
    jQuery(document).on('click', '.btn-get-plan', function (event) {
        // Get plan's data by plan_id
        event.preventDefault();
        var plan_id = jQuery(this).attr('data-plan');
        jQuery.ajax({
            url: url + 'admin/get-plan/' + plan_id,
            type: 'GET',
            dataType: 'json',
            success: function (data)
            {
                if (data.plan)
                {
                    jQuery('.plan_name').val(data.plan[0].plan_name);
                    jQuery('.plan_price').val(data.plan[0].plan_price);
                    jQuery('.currency_sign').val(data.plan[0].currency_sign);
                    jQuery('.currency_code').val(data.plan[0].currency_code);
                    jQuery('.allowed_accounts').val(data.plan[0].network_accounts);
                    jQuery('.allowed_rss').val(data.plan[0].rss_feeds);
                    jQuery('.accounts_number').val(data.plan[0].publish_accounts);
                    jQuery('.limit_posts_month').val(data.plan[0].publish_posts);
                    jQuery('.limit_videos').val(data.plan[0].limit_videos);
                    jQuery('.limit_images').val(data.plan[0].limit_images);
                    jQuery('.features_plan').val(data.plan[0].features);
                    jQuery('.period_plan').val(data.plan[0].period);
                    jQuery('.number_emails').val(data.plan[0].sent_emails);
                    jQuery('.teams').val(data.plan[0].teams);
                    jQuery('.plan-status').val(data.plan[0].visible);
                    var details = jQuery('.details h2').html();
                    details = details.replace(translation.ma18, data.plan[0].plan_name);
                    jQuery('.details h2').html(details);
                    jQuery('.save-plan').text(translation.ma91);
                    if (data.plan[0].plan_id > 1)
                    {
                        jQuery('.delete-plan').show();
                        jQuery('.delete-plan').attr('data-plan', data.plan[0].plan_id);
                    } else
                    {
                        jQuery('.delete-plan').hide();
                        jQuery('.delete-plan').attr('data-plan', 0);
                    }
                    update.plan = data.plan[0].plan_id;
                    if ( data.plan[0].allowed_networks != '' ) {
                        var allowed_networks = JSON.parse(data.plan[0].allowed_networks);
                        update.allowed_networks = allowed_networks;
                        jQuery( '.set_network' ).each(function() {
                            if ( allowed_networks[jQuery(this).attr('name')] ) {
                                jQuery(this).prop('checked', true);
                            } else {
                                jQuery(this).prop('checked', false);
                            }
                        });
                    } else {
                        update.allowed_networks = {};
                        jQuery( '.set_network' ).each(function() {
                            jQuery(this).prop('checked', false);
                        });
                    }
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
                jQuery('.show-plans').html('<p class="nofound">'+translation.mm187+'</p>');
            }
        });
    });
    jQuery(document).on('click', '.delete-plan', function (event) {
        // Try to delete a plan
        jQuery('.confirm').fadeIn('slow');
    });
    jQuery(document).on('click', '.plans .set_network', function (event) {
        delete update.allowed_networks;
        update.allowed_networks = {};
        jQuery( '.set_network' ).each(function() {
            if ( jQuery(this).is(':checked') ) {
                update.allowed_networks[jQuery(this).attr('name')] = '1';
            }
        });
    });    
    jQuery(document).on('click', '.confirm .no', function (e) {
        e.preventDefault();
        jQuery('.confirm').fadeOut('slow');
    });
    jQuery(document).on('click', '.confirm .yes', function (e) {
        e.preventDefault();
        // this function deletes plans
        var plan_id = jQuery(this).attr('data-plan');
        jQuery.ajax({
            url: url + 'admin/delete-plan/' + update.plan,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                jQuery('.alert-msg').show();
                jQuery('.alert-msg').html(data);
                jQuery('.msuccess').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                    jQuery('.msuccess').remove();
                    jQuery('.alert-msg').hide();
                    document.location.href = document.location.href;
                });
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                    jQuery('.merror').remove();
                    jQuery('.alert-msg').hide();
                });
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('.alert-msg').show();
                jQuery('.alert-msg').html('<p class="merror">'+translation.mm188+'</p>');
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                    jQuery('.merror').remove();
                    jQuery('.alert-msg').hide();
                });
            }
        });
    });
    function show_plans()
    {
        // Display all user's plans
        jQuery.ajax({
            url: url + 'admin/get-plans',
            type: 'GET',
            dataType: 'json',
            success: function (data)
            {
                if (data.plans)
                {
                    var plans = '';
                    for (var u = 0; u < data.plans.length; u++) {
                        plans += '<li><i class="fa fa-cube"></i>' + data.plans[u].plan_name + '<a href="#" data-plan="' + data.plans[u].plan_id + '" class="pull-right btn-get-plan"><button type="button" class="btn btn-edit"><i class="fa fa-pencil"></i></button></a></li>';
                    }
                    jQuery('.show-plans').html(plans);
                } else
                {
                    jQuery('.show-plans').html('<p class="nofound">'+translation.mm187+'</p>');
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed:' + textStatus);
                jQuery('.show-plans').html('<p class="nofound">'+translation.mm187+'</p>');
            }
        });
    }
    show_plans();
});