jQuery(document).ready(function() {
    'use strict';
    var url = jQuery('.navbar-brand').attr('href');
    var emails = {
        page: 1,
        limit: 10,
        publish: 1,
        edit: 0,
    },lists = {
        page: 1,
        limit: 10,
        list_id: 0,
        fcon: 0,
        selist: 0,
        templates: []
    },composer = {
        paragraph: '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pretium risus sapien, vel mollis neque lobortis et. Morbi consectetur elementum risus eu dignissim.</p>',
        header: '<h3 style="margin: 0;">Praesent ornare dui id enim tempor auctor</h3>',
        table: '<table cellpadding="0" data-rows="1" data-columns="2" data-border="0" data-border-color="" data-first-column="50" data-second-column="50" data-third-column="" data-fourth-column=""><tr><td width="50%"></td><td width="50%"></td></tr></table>',
        list: '<ol><li style="font-size:14px;color:#333333;">Lorem ipsum dolor sit amet.</li><li style="font-size:14px;color:#333333;">Consectetur adipiscing elit.</li><li style="font-size:14px;color:#333333;">Nullam pretium risus sapien.</li></ol>',
        button: '<a href="" class="tab-button" style="color:#333333;display: inline-block;background-color:#ffffff;border: 1px solid #cccccc;padding: 6px 12px;font-size: 14px;font-weight: 400;line-height: 1.42857143;text-align: center;border-radius: 4px;">Button</a>',
        photo: '<button class="insert-image-in-template"><i class="fa fa-picture-o"></i></button>',
        space: '<div class="tab-space" style="width:100%;height:40px;"></div>',
        line: '<hr style="height: 20px;border: 0;border-top: 1px solid #eeeeee;">',
        html: '<div class="html"><button class="insert-html-in-template"><i class="fa fa-code"></i></button></div>',
    },medias = {
        ipage:1,
    },stats = {
        time: 30,
        template_id: 0
    };
    if(jQuery('#show-emails').length > 0) {
        lists.limit = 20;
    }
    if(jQuery('#sent-emails').length > 0) {
        emails.limit = 20;
    }
    jQuery('.add-repeat').click(function(){
        if(jQuery('.post-plans>div>.list-group-item').length >= jQuery('.resent').attr('data-act')) {
            jQuery('.resent .add-repeat').addClass('active');
            return;
        }        
        if(jQuery('.post-plans>div>p').length > 0) {
            jQuery('.post-plans>div').empty();
        }
        var plan = '<div class="list-group-item"><div class="col-md-2 clean"><select class="days"><option value="1">' + translation.mu193 + '</option><option value="2">' + translation.mu194 + '</option><option value="3">' + translation.mu195 + '</option><option value="4">' + translation.mu196 + '</option><option value="5">' + translation.mu197 + '</option><option value="6">' + translation.mu198 + '</option><option value="7">' + translation.mu199 + '</option></select></div><div class="col-md-3 clean"><select class="plan-time"><option value="00:00">00:00</option><option value="01:00">01:00</option><option value="02:00">02:00</option><option value="03:00">03:00</option><option value="04:00">04:00</option><option value="05:00">05:00</option><option value="06:00">06:00</option><option value="07:00">07:00</option><option value="08:00">08:00</option><option value="09:00">09:00</option><option value="10:00">10:00</option><option value="11:00">11:00</option><option value="12:00">12:00</option><option value="13:00">13:00</option><option value="14:00">14:00</option><option value="15:00">15:00</option><option value="16:00">16:00</option><option value="17:00">17:00</option><option value="18:00">18:00</option><option value="19:00">19:00</option><option value="20:00">20:00</option><option value="21:00">21:00</option><option value="22:00">22:00</option><option value="23:00">23:00</option></select></div><div class="col-md-3 clean"><select class="when"><option value="1">' + translation.mu200 + '</option><option value="2">' + translation.mu201 + '</option><option value="3">' + translation.mu202 + '</option><option value="4">' + translation.mu203 + '</option></select></div><div class="col-md-2 clean"><select class="repeat"><option value="1">1 ' + translation.mu204 + '</option><option value="2">2 ' + translation.mu205 + '</option><option value="3">3 ' + translation.mu205 + '</option><option value="4">4 ' + translation.mu205 + '</option><option value="5">5 ' + translation.mu205 + '</option><option value="6">6 ' + translation.mu205 + '</option><option value="7">7 ' + translation.mu205 + '</option><option value="8">8 ' + translation.mu205 + '</option><option value="9">9 ' + translation.mu205 + '</option><option value="10">10 ' + translation.mu205 + '</option><option value="11">11 ' + translation.mu205 + '</option><option value="12">12 ' + translation.mu205 + '</option><option value="13">13 ' + translation.mu205 + '</option><option value="14">14 ' + translation.mu205 + '</option><option value="15">15 ' + translation.mu205 + '</option><option value="16">16 ' + translation.mu205 + '</option><option value="17">17 ' + translation.mu205 + '</option><option value="18">18 ' + translation.mu205 + '</option><option value="19">19 ' + translation.mu205 + '</option><option value="20">20 ' + translation.mu205 + '</option><option value="21">21 ' + translation.mu205 + '</option><option value="22">22 ' + translation.mu205 + '</option><option value="23">23 ' + translation.mu205 + '</option><option value="24">24 ' + translation.mu205 + '</option><option value="25">25 ' + translation.mu205 + '</option><option value="26">26 ' + translation.mu205 + '</option><option value="27">27 ' + translation.mu205 + '</option><option value="28">28 ' + translation.mu205 + '</option><option value="29">29 ' + translation.mu205 + '</option><option value="30">30 ' + translation.mu205 + '</option></select></div><div class="col-md-2 clean text-right"><a href="#" class="delete-planner-rule">' + translation.mm133 + '</a></div></div>';
        jQuery('.post-plans>div').append(plan);
    });
    jQuery(document).on('click', '.delete-planner-rule', function (e) {
        e.preventDefault();
        if(jQuery('.post-plans>div>.list-group-item').length <= jQuery('section').attr('data-act')) {
            jQuery('.resent .add-repeat').removeClass('active');
        }  
        jQuery(this).closest('.list-group-item').remove();
        if(jQuery('.post-plans>div>.list-group-item').length < 1){
            jQuery('.post-plans>div').html('<p>' + translation.mm190 + '</p>');
        }
    });
    jQuery('.email-marketing>.nav-tabs>li>a').click(function(){
        if(jQuery(this).attr('href') === '#campaigns') {
            jQuery('.email-marketing .btn-primary').show();
            jQuery('.email-marketing .btn-success').hide();
        } else if(jQuery(this).attr('href') === '#lists') {
            jQuery('.email-marketing .btn-success').show();
            jQuery('.email-marketing .btn-primary').hide();
        } else{
            jQuery('.email-marketing .btn-primary').hide();
            jQuery('.email-marketing .btn-success').hide();
        }
    });
    jQuery('.create-campaign').submit(function(e){
        e.preventDefault();
        // Create a new Campaign
        var name = jQuery('#campaign-name').val();
        var desc = jQuery('#campaign-description').val();
        var csr = jQuery('input[name="csrf_test_name"]').val();
        jQuery('#newCampaign').modal('toggle');
        // create an object with form data
        var data = {'campaign': name, 'description': desc, 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                campaigns_results(1);
                if (data.search('msuccess') > 0) {
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                } else {
                    popup_fon('sube', translation.mm3, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });
    jQuery('.create-list').submit(function(e){
        e.preventDefault();
        // Create a New List
        var name = jQuery('#list-name').val();
        var desc = jQuery('#list-description').val();
        var csr = jQuery('input[name="csrf_test_name"]').val();
        jQuery('#newList').modal('toggle');
        // create an object with form data
        var data = {'list': name, 'description': desc, 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                lists_results(1);
                if (data.search('msuccess') > 0) {
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                } else {
                    popup_fon('sube', translation.mm3, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });
    jQuery('.schedule-campaign').submit(function(e){
        e.preventDefault();
        // Schedule a template
        var all_planns = [];
        jQuery('.post-plans .days').each(function (index) {
            var day = jQuery('.post-plans .days').eq(index).val();
            var plan_date = jQuery('.post-plans .plan-time').eq(index).val();
            var when = jQuery('.post-plans .when').eq(index).val();
            var repeat = jQuery('.post-plans .repeat').eq(index).val();
            if((day > 0) && (day < 8) && (plan_date !== '') && (when > 0) && (when < 5) && (repeat > 0) && (repeat < 31)) {
                all_planns.push([day,plan_date,when,repeat]);
            }
        });
        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + '-' + (currentdate.getMonth() + 1) + '-' + currentdate.getDate() + ' ' + currentdate.getHours() + ':' + currentdate.getMinutes() + ':' + currentdate.getSeconds();
        var first_template = jQuery('.template-editor').html();
        first_template = first_template.replace('style>','syle>');
        var first_list = lists.list_id;
        var first_condition = lists.fcon;
        var second_template = lists.selist;
        var campaign_id = jQuery('.campaign-page').attr('data-id');
        var date = jQuery('.datetime').val();
        var template_title = jQuery('.post-title').val();
        all_planns = JSON.stringify(all_planns);
        if(emails.publish > 0) {
            if(lists.list_id === 0) {
                popup_fon('sube', translation.mu285, 1500, 2000);
                return;
            }
        }
        if(!date) {
            date = datetime;
        }
        if(!template_title) {
            popup_fon('sube', translation.mu286, 1500, 2000);
            return;
        }        
        if(!first_template) {
            popup_fon('sube', translation.mu146, 1500, 2000);
            return;
        }
        var csr = jQuery('input[name="csrf_test_name"]').val();
        // create an object with form data
        var data = {'publish': emails.publish, 'template_title': template_title, 'campaign_id': campaign_id, 'first_template': first_template, 'first_list': first_list, 'first_condition': first_condition, 'second_template': second_template, 'date': date, 'datetime': datetime, 'all_planns': all_planns, 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.search('msuccess') > 0) {
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                    setTimeout(function () {
                        schedules();
                        document.getElementsByClassName('schedule-campaign')[0].reset();
                        jQuery('.msuccess').remove();
                    }, 3000);
                    jQuery('.emails .select-list.active').text(translation.mu42);
                    jQuery('.emails .select-list.active').removeClass('active');
                    jQuery('.emails .show-advanced.active').removeClass('active');
                    jQuery('.template-editor').html('<div class="template-builder" style="background-color: #f8f8f8;"><div style="width:80%;min-height:auto;margin:30px auto 70px;"><div class="email-template-header ui-droppable ui-sortable" style="width:100%;min-height:50px;background-color:#ffffff;padding:15px;"></div><div class="email-template-body ui-droppable ui-sortable" style="width:100%;margin:20px 0;min-height:350px;background-color:#ffffff;padding:15px;"></div><div class="email-template-footer ui-droppable ui-sortable" style="width:100%;min-height:70px;background-color:#ffffff;padding:15px;"></div></div></div>');
                    relod();
                    jQuery('.post-title').val('');
                    jQuery('.emails .socials').hide();
                } else {
                    popup_fon('sube', jQuery(data).text(), 1500, 2000);
                }
                show_template_lists();
                shistory(emails.page);
            },
            complete: function () {
                jQuery('img.display-none').fadeOut('slow');
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
        emails.publish = 1;
    });
    jQuery(document).on('click', '.emails .select-list', function () {
        if (!jQuery(this).hasClass('active')) {
            jQuery('.emails .select-list.active').text(translation.mu42);
            jQuery('.emails .select-list.active').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(this).text(translation.mm120);
            lists.list_id = jQuery(this).closest('.netsel').attr('data-id');
            lists.fcon = 0;
            lists.selist = 0;
            var index = jQuery('.emails ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.emails ul li.socials').eq(index).find('.first-condition').val(0);
            jQuery('.emails ul li.socials').eq(index).find('.non-mod-select').hide();
        }
    });
    jQuery(document).on('click', '.emails .select-list.active', function () {
        if (jQuery(this).hasClass('active')) {
            jQuery(this).text(translation.mu42);
            jQuery(this).removeClass('active');
            lists.list_id = 0;
            lists.fcon = 0;
            lists.selist = 0;            
        }
    });
    jQuery(document).on('click', '.emails .show-advanced', function () {
        // Display advanced options to send a template
        if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active');
            var index = jQuery('.emails ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.emails ul li.socials').eq(index).fadeOut('slow');
        } else {
            jQuery(this).addClass('active');
            var index = jQuery('.emails ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.emails ul li.socials').eq(index).fadeIn('slow');
        }
    });
    jQuery(document).on('click', '.emails .besan', function (e) {
        // save smtp options
        var id = jQuery(this).attr('id');
        var field = '';
        var val = 0;
        if(id === 'smtp-enable') {
            field = 'meta_val1';
            if (jQuery('#smtp-enable').is(':checked')) {
                val = 1;
            }
        } else if(id === 'smtp-ssl') {
            field = 'meta_val6';
            if (jQuery('#smtp-ssl').is(':checked')) {
                val = 1;
            }
        } else if(id === 'smtp-tls') {
            field = 'meta_val7';
            if (jQuery('#smtp-tls').is(':checked')) {
                val = 1;
            }
        }
        var csr = jQuery('input[name="csrf_test_name"]').val();
        // create an object with form data
        var data = {'smtp_option': 'smtp_options', 'field': field, 'value': val, 'campaign_id': jQuery('.campaign-page').attr('data-id'), 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                console.log(data);
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });
    jQuery(document).on('keyup', '.emails .pappio', function (e) {
        // save smtp options
        var id = jQuery(this).attr('id');
        var field = '';
        var val = jQuery(this).val();
        if(id === 'smtp-host') {
            field = 'meta_val2';
        } else if(id === 'smtp-port') {
            field = 'meta_val3';
        } else if(id === 'smtp-username') {
            field = 'meta_val4';
        } else if(id === 'smtp-password') {
            field = 'meta_val5';
        } else if(id === 'smtp-protocol') {
            field = 'meta_val8';
        } else if(id === 'smtp-sender-name') {
            field = 'meta_val9';
        } else if(id === 'smtp-sender-email') {
            field = 'meta_val10';
        } else if(id === 'smtp-priority') {
            field = 'meta_val11';
        }
        var csr = jQuery('input[name="csrf_test_name"]').val();
        // create an object with form data
        var data = {'smtp_option': 'smtp_options', 'field': field, 'value': val, 'campaign_id': jQuery('.campaign-page').attr('data-id'), 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                console.log(data);
            },
            error: function (data, jqXHR, textStatus) {
                if ( data.statusText != 'OK' ) {
                    console.log(data);
                    popup_fon('sube', translation.mm3, 1500, 2000);
                }
            },
        });
    });
    jQuery(document).on('click', '.draft-save', function (e) {
        // save the template as a draft
        e.preventDefault();
        emails.publish = 0;
        jQuery('.schedule-campaign').submit();
    });
    jQuery(document).on('click', '.new-campaign-email', function (e) {
        // New Template
        e.preventDefault();
        jQuery('.template-editor').html('<div class="template-builder" style="background-color: #f8f8f8;"><div style="width:80%;min-height:auto;margin:30px auto 70px;"><div class="email-template-header ui-droppable ui-sortable" style="width:100%;min-height:50px;background-color:#ffffff;padding:15px;"></div><div class="email-template-body ui-droppable ui-sortable" style="width:100%;margin:20px 0;min-height:350px;background-color:#ffffff;padding:15px;"></div><div class="email-template-footer ui-droppable ui-sortable" style="width:100%;min-height:70px;background-color:#ffffff;padding:15px;"></div></div></div>');
        relod();
        emails.edit = 0;
    });    
    jQuery('.create-template').submit(function(e){
        e.preventDefault();
        var name = btoa(encodeURIComponent(jQuery('.msg-title').val()));
        var desc = btoa(encodeURIComponent(jQuery('.msg-body').val()));
        var campaign_id = jQuery('.campaign_id').val();
        var template_id = jQuery('.template_id').val();
        var csr = jQuery('input[name="csrf_test_name"]').val();
        // load gif loading icon
        jQuery('img.display-none').fadeIn('slow');
        // create an object with form data
        var data = {'template_title': name, 'template_body': desc, 'campaign_id': campaign_id, 'template_id': template_id, 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.search('msuccess') > 0) {
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                    jQuery('.msg-title').val('');
                    jQuery('.msg-body').val('');
                    setTimeout(function(){history.go(-1);},5000);           
                } else {
                    popup_fon('sube', jQuery(data).text(), 1500, 2000);
                }
            },
            complete: function () {
                jQuery('img.display-none').fadeOut('slow');
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });
    jQuery(document).on('click', '#campaigns .pagination li a,#lists .pagination li a,#show-emails .pagination li a,#sent-emails .pagination li a,#unactive_emails .pagination li a,#history .pagination li a', function (e) {
        e.preventDefault();
        if(jQuery(this).closest('.panel-body').attr('id') === 'campaigns')
        {
            emails.page = jQuery(this).attr('data-page');
            campaigns_results(jQuery(this).attr('data-page'));
        } else if(jQuery(this).closest('.tab-pane').attr('id') === 'show-emails') {
            lists.page = jQuery(this).attr('data-page');
            emails_results(jQuery(this).attr('data-page'));
        } else if(jQuery(this).closest('.fade').attr('id') === 'history') {
            emails.page = jQuery(this).attr('data-page');
            shistory(jQuery(this).attr('data-page'));
        } else if(jQuery(this).closest('.tab-pane').attr('id') === 'sent-emails') {
            emails.page = jQuery(this).attr('data-page');
            sehistory(jQuery(this).attr('data-page'));            
        } else if(jQuery(this).closest('.tab-pane').attr('id') === 'unactive_emails') {
            lists.page = jQuery(this).attr('data-page');
            unactive_emails_results(jQuery(this).attr('data-page'));            
        } else {
            lists.page = jQuery(this).attr('data-page');
            lists_results(jQuery(this).attr('data-page'));              
        }
    });
    jQuery('.first-condition').change(function(){
        if(jQuery(this).val() > 0) {
            jQuery(this).closest('li').find('.non-mod-select').show();
            var sed = ' ';
            if(lists.templates) {
                var temps = lists.templates;
                for(var f = 0; f < temps.length; f++) {
                    sed += '<option value="' + temps[f][0] + '">' + temps[f][1] + '</option>'
                }
            }
            jQuery(this).closest('li').find('.second-template').html(sed);
        } else {
            jQuery(this).closest('li').find('.non-mod-select').hide();
        }
        if(jQuery(this).closest('li').attr('data-id') === lists.list_id) {
            lists.fcon = jQuery(this).val();
            lists.selist = jQuery(this).closest('li').find('.second-template').val();
            console.log(lists.selist);
        }
    });
    jQuery('#dropdownMenu1').click(function () {
        var sed = ' ';
        if(lists.templates) {
            var temps = lists.templates;
            for(var f = 0; f < temps.length; f++) {
                sed += '<li><a href="#" data-id="' + temps[f][0] + '">' + temps[f][1] + '</a></li>'
            }
        }
        jQuery(document).find('.multi-level').html(sed);
    });
    jQuery('.select-range').click(function(){
        // Display statistics per time
        jQuery('.emails .select-range').removeClass('active');
        jQuery(this).addClass('active');
    });
    jQuery('.get-campaign-statistics').click(function(){
        // Display Campaign Statistics
        jQuery('#rations').empty();
        gets_stats_for(stats.template_id,stats.time);
    });
    jQuery(document).on('click', '.sort-stats-by-template>li>a', function(e){
        e.preventDefault();
        // Display stats per template
        jQuery('#rations').empty();
        stats.template_id = jQuery(this).attr('data-id');
        gets_stats_for(stats.template_id,stats.time);
    });
    jQuery(document).on('click', '.emails .select-range', function(e){
        e.preventDefault();
        // Display stats per date
        jQuery('#rations').empty();
        stats.time = jQuery(this).attr('data-value');
        gets_stats_for(stats.template_id,stats.time);
    });    
    jQuery('.second-template').change(function() {
        if(jQuery(this).closest('li').attr('data-id') === lists.list_id) {
            lists.selist = jQuery(this).val();
        }
    });    
    jQuery('.delete-campaign,.del-list').click(function () {
        // Try to delete a Campaign
        jQuery('.confirm').fadeIn('slow');
    });
    jQuery(document).on('click', '.confirm .no', function (e) {
        e.preventDefault();
        jQuery('.confirm').fadeOut('slow');
    });
    jQuery(document).on('click', '.delete-cam', function (e) {
        // Deletes a campaign
        e.preventDefault();
        if(jQuery('.delete-campaign').length > 0) {
            var uri = jQuery('.delete-campaign').attr('data-id');
            var te = 0;
        } else {
            var uri = jQuery(this).attr('data-id');
            var te = 1;
        }
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/dcampaign/' + uri,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if (data == 1) {
                    popup_fon('subi', translation.mm147, 1500, 2000);
                    if(te === 0) {
                        setTimeout(function(){document.location.href = url+'user/emails';},2000);
                    } else {
                        campaigns_results(1);
                    }
                } else {
                    popup_fon('sube', translation.mm148, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm148, 1500, 2000);
            },
        });
    });
    jQuery(document).on('click','.delete-email',function(e) {
        e.preventDefault();
        // Delete an email address from list
        var $this = jQuery(this);
        var list = $this.attr('data-list');
        var meta = $this.attr('data-meta');
        // create an object with form data
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/dmeta/'+meta+'/?list='+list,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var table = $this.closest('table');
                if(data == 1){
                    $this.closest('tr').remove();
                } else{
                    popup_fon('sube', translation.mm149, 1500, 2000);
                }
                if(table.find('tr').length < 1) {
                    table.find('.list-emails').html('<tr><td>'+translation.mm150+'</td></tr>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
                popup_fon('sube', translation.mm151, 1500, 2000);
            },
        });
    });
    jQuery(document).on('click', '.delete-list', function (e) {
        // Deletes a list
        e.preventDefault();
        if(jQuery('.del-list').length > 0) {
            var uri = jQuery('.del-list').attr('data-id');
            var te = 0;
        } else {
            var uri = jQuery(this).attr('data-id');
            var te = 1;
        }
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/dlist/' + uri,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if (data == 1) {
                    popup_fon('subi', translation.mm152, 1500, 2000);
                    if(te === 0) {
                        setTimeout(function(){document.location.href = url+'user/emails';},2000);
                    } else {
                        lists_results(1);
                    }
                } else {
                    popup_fon('sube', translation.mm153, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });    
    jQuery(document).on('click', '.emails .deleteTemplate', function () {
        // this function deletes templates from database
        var templateId = jQuery(this).attr('data-id');
        var $this = jQuery(this);
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/dtemplate/' + templateId,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data === 1){
                    $this.closest('li').remove();
                    popup_fon('subi', translation.mm193, 1500, 2000);
                    if(jQuery('.deleteTemplate').length < 1) {   
                        jQuery('.show-templates-lists-here>ul').html('<p class="list-group-item">' + translation.mm154 + '</p>');
                    }
                } else {
                    popup_fon('sube', translation.mm194, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                popup_fon('sube', translation.mm194, 1500, 2000);
                console.log('Request failed: ' + textStatus);
            },
        });
    });
    jQuery(document).on('click', '.emails .select-temp', function () {
        // this function get template body
        var templateId = jQuery(this).attr('data-id');
        var $this = jQuery(this);
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/stemplate/' + templateId,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data) {
                    var conte = data[1];
                    conte = conte.replace('syle>','style>');
                    jQuery('.post-title').val(data[0]);
                    jQuery('.template-editor').html(conte);
                    jQuery('#campaign-tab-send-mail').addClass('active');
                    jQuery('#campaign-tab-templates').removeClass('active');
                    jQuery('.campaign-menu>li').eq(1).removeClass('active');
                    jQuery('.campaign-menu>li').eq(0).addClass('active');
                    var attrs = jQuery(document).find('.email-template-header').attr('style');
                    if(attrs) {
                        var res = parse_styles(attrs, 'padding:', 3, '');
                        if(res) {
                            var pad = res[1];
                            pad = pad.replace('px','');
                            jQuery('.header-padding').val(pad);
                        }
                    }
                    var attrs = jQuery(document).find('.email-template-body').attr('style');
                    if(attrs) {
                        var res = parse_styles(attrs, 'padding:', 3, '');
                        if(res) {
                            var pad = res[1];
                            pad = pad.replace('px','');
                            jQuery('.body-padding').val(pad);
                        }
                    }
                    var attrs = jQuery(document).find('.email-template-footer').attr('style');
                    if(attrs) {
                        var res = parse_styles(attrs, 'padding:', 3, '');
                        if(res) {
                            var pad = res[1];
                            pad = pad.replace('px','');
                            jQuery('.footer-padding').val(pad);
                        }
                    }
                    relod();
                    emails.edit = templateId;
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
            },
        });
    });    
    jQuery(document).on('click', '.select-csv', function (e) {
        // Select a CSV File
        e.preventDefault();
        jQuery('.load-csv').click();
    });
    jQuery('.load-csv').on('change',function(){
        if(jQuery('.load-csv').val()) {
            jQuery('.alert-msg').html('<p class="msuccess block">'+translation.mm155+'</p>');
        }
    });
    jQuery(document).on('click', '.schedule-submit', function (e) {
        // Submit Schedule Form
        e.preventDefault();
        jQuery('.schedule-campaign').submit();
    });
    jQuery(document).on('click', '#popup_lists_edit .delete-item-tem-lists', function (e) {
        // Delete item from lists
        jQuery(this).closest('.panel-default').remove();
    });    
    jQuery(document).on('click', '.get-csv-sent', function (e) {
        // Export sent email in a CSV file
        e.preventDefault();
        var sched_id = jQuery('.sent-info').attr('data-id');
        var type = jQuery('.sent-info').attr('data-type');
		var url=jQuery('#base_url').val();
        window.open(url + 'user/schedules/' + type + '/' + sched_id + '/1/1');
    });    
    jQuery(document).on('click', '.delete-schedules', function (e) {
        // Delete a Schedules
        e.preventDefault();
        var scheduledId = jQuery(this).attr('data-id');
        var $this = jQuery(this);
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/dsched/' + scheduledId,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                shistory(emails.page);
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });
    var type = '';
    var jos = 1;
    function relod() {
        jQuery(document).find('.template-tools .tab-content #general li').draggable({
            helper: 'clone',
            start: function (e, ui) {
                jQuery(ui.helper).css({'position':'absolute','z-index':'9999'});
                type = jQuery(this).data('type');
                    jQuery(document).find('td').droppable({
                        over: function (event, ui) {
                            jQuery(this).addClass('active');
                            jos = 2;
                        },
                        out: function( event, ui ) {
                            jQuery(this).removeClass('active');
                            jos = 1;
                        },
                        drop: function( event, ui ) {
                            jQuery(this).removeClass('active');
                            var data = '';
                            switch(type) {
                                case 'paragraph':
                                    data = composer.paragraph+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'header':
                                    data = composer.header+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'list':
                                    data = composer.list+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'button':
                                    data = composer.button+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'photo':
                                    data = composer.photo+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'space':
                                    data = composer.space+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'line':
                                    data = composer.line+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                                case 'html':
                                    data = composer.html+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                                    break;
                            }
                            if(data) {
                                jQuery(this).append('<div class="tem-item">' + data + '</div>');
                            }
                            type = '';
                        }
                    });
            }
        });
        jQuery(document).find('.email-template-header,.email-template-body,.email-template-footer').droppable({
            over: function (event, ui) {
                jQuery(this).addClass('active');
            },
            out: function( event, ui ) {
                jQuery(this).removeClass('active');
            },
            drop: function( event, ui ) {
                jQuery(this).removeClass('active');
                var data = '';
                switch(type) {
                    case 'paragraph':
                        data = composer.paragraph;
                        break;
                    case 'header':
                        data = composer.header;
                        break;
                    case 'table':
                        data = composer.table;
                        break;
                    case 'list':
                        data = composer.list;
                        break;
                    case 'button':
                        data = composer.button;
                        break;
                    case 'photo':
                        data = composer.photo;
                        break;
                    case 'space':
                        data = composer.space;
                        break;
                    case 'line':
                        data = composer.line;
                        break;
                    case 'html':
                        data = composer.html;
                        break;
                }
                if(data) {
                    if(jos === 1) {
                        jQuery(this).append('<div class="tem-item">' + data + '</div>');
                        type = '';
                    } else {
                        jos = 1;
                    }
                }
            }
        });
        jQuery(document).find('.email-template-header,.email-template-body,.email-template-footer').sortable();
        var content = jQuery(document).find('.only-css-here').html();
        if(content) {
            content = jQuery(document).find('.only-css-here').html();
            var coni = content.replace('<syle>','');
            coni = coni.replace('</syle>','');
            jQuery('.for-css-template textarea').val(coni);
        }
    }
    jQuery(document).on('change', '.temp-bg-color', function() {
        // Change template background color
        var newColor = jQuery(this).val();
        if(newColor) {
            jQuery('.emails .template-builder').css({'background-color':newColor});
            jQuery('.emails .template-builder').css({'padding':'15px'});
        }
    });
    jQuery(document).on('change', '.temp-header-bg-color', function() {
        // Change template's header background color
        var newColor = jQuery(this).val();
        if(newColor) {
            jQuery('.emails .email-template-header').css({'background-color':newColor});
        }
    });
    jQuery(document).on('change', '.temp-body-bg-color', function() {
        // Change template's body background color
        var newColor = jQuery(this).val();
        if(newColor) {
            jQuery('.emails .email-template-body').css({'background-color':newColor});
        }
    });
    jQuery(document).on('change', '.temp-footer-bg-color', function() {
        // Change template's footer background color
        var newColor = jQuery(this).val();
        if(newColor) {
            jQuery('.emails .email-template-footer').css({'background-color':newColor});
        }
    });
    jQuery(document).on('click', '#temp_disable_header', function() {
        if(jQuery('#temp_disable_header').is(':checked')) {
            jQuery('.email-template-header').hide();
        } else {
            jQuery('.email-template-header').show();
        }
    });
    jQuery(document).on('click', '#temp_disable_footer', function() {
        if(jQuery('#temp_disable_footer').is(':checked')) {
            jQuery('.email-template-footer').hide();
        } else {
            jQuery('.email-template-footer').show();
        }
    });
    // Show edit button on hover
    jQuery(document).on('mouseenter','.emails td>.tem-item', function() {
        var width = jQuery(this).width()/2;
        var height = jQuery(this).height()/2;
        jQuery(this).find('.edit-this-temp-item').css({'margin-left':(width-15)+'px','margin-top':'-'+(height+15)+'px','display':'block'});
    });
    // Hide edit button on hover
    jQuery(document).on('mouseleave','.emails td>.tem-item', function() {
        jQuery(document).find('.edit-this-temp-item').hide();
    });    
    jQuery(document).on('click', '.media-gallery-images .show-image-preview', function () {
        jQuery('.media-gallery-images ul li.show-preview').fadeOut('slow');
        var index = jQuery('.media-gallery-images ul li').index(jQuery(this).closest('li'));
        index++;
        if(index !== medias.media_img) {
            var img = jQuery(this).closest('li').attr('data-image');
            jQuery('.media-gallery-images ul li').eq(index).html('<img src="' + img + '">');
            jQuery('.media-gallery-images ul li').eq(index).fadeIn('slow');
            medias.media_img = index;
        } else {
            medias.media_img = '';
        }
    });
    jQuery('.imgup').click(function () {
        jQuery('#file').click();
        jQuery('#type').val(jQuery(this).attr('data-type'));
    });
    jQuery('#file').on('change', prepareUpload);
    function prepareUpload(event) {
        jQuery('#upim').submit();
    }
    jQuery('#upim').submit(function (e) {
        var type = jQuery('#type').val();
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/upimg',
            type: 'POST',
            data: new FormData(jQuery('#upim')[0]),
            processData: false,
            contentType: false,
            beforeSend: function () {
                jQuery('.loading-image').show();
            },
            success: function (data) {
                if((data > -1) && (data < 6)) {
                    jQuery('#image_upload').modal('toggle');
                }
                if (data == 0) {
                    popup_fon('sube', translation.mm118 + ' ' + jQuery('section').attr('data-up') + 'MB.', 1500, 2000);
                } else if (data == 1) {
                    popup_fon('sube', translation.mm119, 1500, 2000);
                } else if (data == 3) {
                    popup_fon('sube', translation.mm195, 1500, 2000);
                } else if (data == 4) {
                    popup_fon('sube', translation.mm196, 1500, 2000);
                } else if (data == 5) {
                    popup_fon('sube', translation.mm199, 1500, 2000);
                } else {
                    jQuery('.the-img').val(data);
                    get_media(1, 'image');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ERRORS: ' + textStatus);
            },
            complete: function () {
                jQuery('.loading-image').hide();
            }
        });
        e.preventDefault();
    });
    jQuery(document).on('click', '.media-gallery-images .delete-gallery-media', function () {
        var id = jQuery(this).closest('li').attr('data-id');
        var index = jQuery('.media-gallery-images ul li').index(jQuery(this).closest('li'));
        jQuery('#image_upload').modal('toggle');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/delete-media/' + id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data) {
                    jQuery('.media-gallery-images ul li').eq(index).remove();
                    jQuery('.media-gallery-images ul li').eq(index).remove();
                    popup_fon('subi', data, 1500, 2000);
                    get_media(1, 'image');
                } else {
                    popup_fon('sube', translation.mm3, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
            complete: function () {
                setTimeout(function(){jQuery('#image_upload').modal('toggle');},2000);
            }
        });
    });
    jQuery(document).on('click', '.media-gallery .add-gallery-image, .add-img', function () {
        if(jQuery('#general').hasClass('active')) {
            if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                if(jQuery(medias.mid).parent('td').length > 0) {
                    jQuery(medias.mid).html('<img src="' + jQuery('.the-img').val() + '" style="max-width: 100%;">'+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>');
                } else {
                    jQuery(medias.mid).html('<img src="' + jQuery('.the-img').val() + '" style="max-width: 100%;">');
                }
            } else {
                if(jQuery(medias.mid).parent('td').length > 0) {
                    jQuery(medias.mid).html('<img src="' + jQuery(this).closest('li').attr('data-image') + '" style="max-width: 100%;">'+'<button class="edit-this-temp-item" style="display: none"><i class="fa fa-pencil" aria-hidden="true"></i></button>');
                } else {
                    jQuery(medias.mid).html('<img src="' + jQuery(this).closest('li').attr('data-image') + '" style="max-width: 100%;">');
                }
            }
        } else if(jQuery('#temp_bac').hasClass('active')) {
            if(jQuery('#show-image-for-content-template').is(':checked')) {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.template-builder').css({'background-image':"url('"+jQuery('.the-img').val()+"')", 'background-size': 'cover'});
                    jQuery('.template-builder').attr('data-src',jQuery('.the-img').val());              
                } else {
                    jQuery('.template-builder').css({'background-image':"url('"+jQuery(this).closest('li').attr('data-image')+"')", 'background-size': 'cover'});
                    jQuery('.template-builder').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            } else {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.template-builder').attr('data-src',jQuery('.the-img').val());
                } else {
                    jQuery('.template-builder').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            }
            jQuery('.emails .template-builder').css({'padding':'15px'});
        } else if(jQuery('#temp_header').hasClass('active')) {
            if(jQuery('#show-image-for-header-template').is(':checked')) {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.email-template-header').css({'background-image':"url('"+jQuery('.the-img').val()+"')", 'background-size': 'cover'});
                    jQuery('.email-template-header').attr('data-src',jQuery('.the-img').val());
                } else {                
                    jQuery('.email-template-header').css({'background-image':"url('"+jQuery(this).closest('li').attr('data-image')+"')", 'background-size': 'cover'});
                    jQuery('.email-template-header').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            } else {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.email-template-header').attr('data-src',jQuery('.the-img').val());
                } else {
                    jQuery('.email-template-header').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            }            
        } else if(jQuery('#temp_body').hasClass('active')) {
            if(jQuery('#show-image-for-body-template').is(':checked')) {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.email-template-body').css({'background-image':"url('"+jQuery('.the-img').val()+"')", 'background-size': 'cover'});
                    jQuery('.email-template-body').attr('data-src',jQuery('.the-img').val());                    
                } else {
                    jQuery('.email-template-body').css({'background-image':"url('"+jQuery(this).closest('li').attr('data-image')+"')", 'background-size': 'cover'});
                    jQuery('.email-template-body').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            } else {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.email-template-body').attr('data-src',jQuery('.the-img').val());
                } else {
                    jQuery('.email-template-body').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            }            
        } else if(jQuery('#temp_footer').hasClass('active')) {
            if(jQuery('#show-image-for-footer-template').is(':checked')) {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.email-template-footer').css({'background-image':"url('"+jQuery('.the-img').val()+"')", 'background-size': 'cover'});
                    jQuery('.email-template-footer').attr('data-src',jQuery('.the-img').val());                    
                } else {
                    jQuery('.email-template-footer').css({'background-image':"url('"+jQuery(this).closest('li').attr('data-image')+"')", 'background-size': 'cover'});
                    jQuery('.email-template-footer').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            } else {
                if(jQuery(this).closest('span').hasClass('input-group-btn')) {
                    jQuery('.email-template-footer').attr('data-src',jQuery('.the-img').val());
                } else {
                    jQuery('.email-template-footer').attr('data-src',jQuery(this).closest('li').attr('data-image'));
                }
            }            
        }
        jQuery('#image_upload').modal('toggle');
    });
    jQuery(document).on('click', '.media-images-next', function(){
        var page = medias.ipage;
        page++;
        medias.ipage = page;
        get_media(page, 'image');
    });
    jQuery(document).on('click', '.media-images-back', function(){
        var page = medias.ipage;
        page--;
        medias.ipage = page;
        get_media(page, 'image');
    });
    jQuery(document).on('click', '#show-image-for-content-template', function() {
        if(jQuery('#show-image-for-content-template').is(':checked')) {
            jQuery('.template-builder').css({'background-image':"url('" + jQuery('.template-builder').attr('data-src') + "')", 'background-size': 'cover'});
        } else {
            jQuery('.template-builder').css({'background-image':"url('')", 'background-size': 'cover'});
        }
        jQuery('.emails .template-builder').css({'padding':'15px'});
    });
    jQuery(document).on('click', '#show-image-for-header-template', function() {
        if(jQuery('#show-image-for-header-template').is(':checked')) {
            jQuery('.email-template-header').css({'background-image':"url('" + jQuery('.email-template-header').attr('data-src') + "')", 'background-size': 'cover'});
        } else {
            jQuery('.email-template-header').css({'background-image':"url('')", 'background-size': 'cover'});
        }
    });
    jQuery(document).on('click', '#show-image-for-body-template', function() {
        if(jQuery('#show-image-for-body-template').is(':checked')) {
            jQuery('.email-template-body').css({'background-image':"url('" + jQuery('.email-template-body').attr('data-src') + "')", 'background-size': 'cover'});
        } else {
            jQuery('.email-template-body').css({'background-image':"url('')", 'background-size': 'cover'});
        }
    });
    jQuery(document).on('click', '#show-image-for-footer-template', function() {
        if(jQuery('#show-image-for-footer-template').is(':checked')) {
            jQuery('.email-template-footer').css({'background-image':"url('" + jQuery('.email-template-footer').attr('data-src') + "')", 'background-size': 'cover'});
        } else {
            jQuery('.email-template-footer').css({'background-image':"url('')", 'background-size': 'cover'});
        }
    });
    var imsi = 1;
    var ped = Math.round(new Date().getTime()/1000);
    jQuery(document).on('click','.emails .edit-this-temp-item',function(e) {
        var $this = jQuery(this);
        var top = $this.offset().top-58;
        var left = $this.offset().left;
        medias.mid = $this.closest('.tem-item');
        if($this.closest('.tem-item').find('.insert-image-in-template').length > 0) {
            jQuery('#image_upload').modal('show');
        } else if($this.closest('.tem-item').find('img').length > 0) {
            get_tools_for(top,left,1);
        }
        imsi = 2;
    });
    jQuery(document).on('click','.emails .tem-item',function(e) {
        e.preventDefault();
        var $this = jQuery(this);
        if(Math.round(new Date().getTime()/1000) === ped){return;}else{ped = Math.round(new Date().getTime()/1000);}
        setTimeout(function () {
            if(jQuery('.show-template-composer-tools').length < 1 && !jQuery('#image_upload').hasClass('in')) {
               imsi = 1; 
            }
            if(imsi === 1) {
                if((e.offsetX > -1) && (e.offsetX < 23) && (e.offsetY > -1) && (e.offsetY < 21)) {
                    var top = jQuery($this).offset().top-58;
                    var left = jQuery($this).offset().left-100;
                    medias.mid = $this.closest('.tem-item');
                    if(($this.find('.insert-image-in-template').length > 0) && ($this.find('table').length < 1)) {
                        jQuery('#image_upload').modal('show');
                    } else if(($this.find('.insert-html-in-template').length > 0) && ($this.find('table').length < 1)) {
                        jQuery('#popup_html_edit').modal('show');
                    } else if(($this.find('.html').length > 0) && ($this.find('table').length < 1)) {
                        get_tools_for(top,left+100,6);                        
                    } else if(($this.find('img').length > 0) && ($this.find('table').length < 1)) {
                        get_tools_for(top,left,1);
                    } else if(($this.find('h1').length > 0 || $this.find('h2').length > 0 || $this.find('h3').length > 0 || $this.find('h4').length > 0 || $this.find('h5').length > 0) && ($this.find('table').length < 1)) {
                        get_tools_for(top,left,2);
                    } else if(($this.find('p').length > 0) && ($this.find('table').length < 1)) {
                        get_tools_for(top,left,3);
                    } else if($this.find('table').length > 0) {
                        var attrs = jQuery(medias.mid).find('table').attr('style');
                        if(attrs) {
                            var res = parse_styles(attrs, 'background-color:', 3, '');
                            if(res) {
                                jQuery('.tab-background-color').val(rgb2hex(res[1]));
                            } else {
                                jQuery('.tab-background-color').val('#FFFFFF');
                            }
                        } else {
                            jQuery('.tab-background-color').val('#FFFFFF');
                        }
                        var rows = jQuery(medias.mid).find('table').attr('data-rows');
                        var columns = jQuery(medias.mid).find('table').attr('data-columns');
                        var border = jQuery(medias.mid).find('table').attr('data-border');
                        var border_color = jQuery(medias.mid).find('table').attr('data-border-color');
                        var first = jQuery(medias.mid).find('table').attr('data-first-column');
                        var second = jQuery(medias.mid).find('table').attr('data-second-column');
                        var third = jQuery(medias.mid).find('table').attr('data-third-column');
                        var fourth = jQuery(medias.mid).find('table').attr('data-fourth-column');
                        var cellpadding = jQuery(medias.mid).find('table').attr('cellpadding');
                        jQuery('.first-column').val(first);
                        jQuery('.second-column').val(second);
                        jQuery('.third-column').val(third);
                        jQuery('.fourth-column').val(fourth);
                        jQuery('.tab-rows').val(rows);
                        jQuery('.tab-columns').val(columns);
                        jQuery('.tab-border').val(border);
                        jQuery('.tab-cellpadding').val(cellpadding);
                        if(border_color) {
                            jQuery('.tab-border-color').val(border_color);
                        } else {
                            jQuery('.tab-border-color').val('#FFFFFF');
                        }
                        jQuery('#popup_table').modal('show');
                    } else if(($this.find('hr').length > 0) && ($this.find('table').length < 1)) {
                        jQuery('#popup_line').modal('show');
                        var attrs = jQuery(medias.mid).find('hr').attr('style');
                        if(attrs) {
                            var res = parse_styles(attrs, 'border-top:', 3, '');
                            var b = res[1].split('px');
                            jQuery('.line-height').val(b[0]);
                            var c = res[1].split('#');
                            jQuery('.lin-background-color').val('#'+c[1]);
                        }
                    } else if(($this.find('.tab-space').length > 0) && ($this.find('table').length < 1)) {
                        jQuery('#popup_space').modal('show');
                        var attrs = jQuery(medias.mid).find('.tab-space').attr('style');
                        if(attrs) {
                            var res = parse_styles(attrs, 'height:', 3, '');
                            var lo = res[1].split('px');
                            jQuery('.space-height').val(lo[0]);
                        }
                    } else if(($this.find('.tab-button').length > 0) && ($this.find('table').length < 1)) {
                        get_tools_for(top,left,4);
                    } else if((($this.find('ol').length > 0) || ($this.find('ul').length > 0)) && ($this.find('table').length < 1)) {
                        get_tools_for(top,left,5);
                    }
                }
            } else {
                imsi = 1;
            }
        }, 300);
    });
    jQuery(document).on('change', '.space-height', function() {
        var space_height = jQuery('.space-height').val();
        if(!isNaN(space_height)) {
            jQuery(medias.mid).find('.tab-space').css('height',space_height+'px');
        }
    });
    jQuery(document).on('change', '.footer-height', function() {
        // Change footer height
        var space_height = jQuery('.footer-height').val();
        if(!isNaN(space_height)) {
            jQuery('.email-template-footer').css('height',space_height+'px');
        }
    });
    jQuery(document).on('change', '.header-height', function() {
        // Change header height
        var space_height = jQuery('.header-height').val();
        if(!isNaN(space_height)) {
            jQuery('.email-template-header').css('height',space_height+'px');
        }
    });
    jQuery(document).on('change', '.header-padding', function() {
        // Change header padding
        var space_height = jQuery('.header-padding').val();
        if(!isNaN(space_height)) {
            jQuery('.email-template-header').css('padding',space_height+'px');
        }
    });
    jQuery(document).on('change', '.body-padding', function() {
        // Change body padding
        var space_height = jQuery('.body-padding').val();
        if(!isNaN(space_height)) {
            jQuery('.email-template-body').css('padding',space_height+'px');
        }
    });
    jQuery(document).on('change', '.footer-padding', function() {
        // Change footer padding
        var space_height = jQuery('.footer-padding').val();
        if(!isNaN(space_height)) {
            jQuery('.email-template-footer').css('padding',space_height+'px');
        }
    });    
    jQuery(document).on('change', '.fix-template-width', function() {
        // Change template width
        var space_width = jQuery('.fix-template-width').val();
        if(!isNaN(space_width)) {
            jQuery('.template-builder>div').css('width',space_width+'px');
        }
    });
    jQuery(document).on('keyup', '.for-css-template textarea', function() {
        // Edit Styles from here
        var content = jQuery(this).val();
        if(content) {
            jQuery('.only-css-here').html('<style>' + content + '</style>');
        } else {
            jQuery('.only-css-here').empty();
        }
    });    
    jQuery(document).on('change', '.body-height', function() {
        // Change body height
        var space_height = jQuery('.body-height').val();
        console.log(space_height);
        if(!isNaN(space_height)) {
            jQuery('.email-template-body').css('height',space_height+'px');
        }
    });    
    jQuery(document).on('change', '.linmon', function() {
        var line_height = jQuery('.line-height').val();
        var lin_background_color = jQuery('.lin-background-color').val();
        if(!isNaN(line_height)) {
            jQuery(medias.mid).find('hr').css('border-top',line_height+'px solid '+lin_background_color);
        }
    });
    jQuery(document).on('change', '.tabut', function() {
        jQuery(medias.mid).find('.tab-button').text(jQuery('.tab-button-text').val());
        jQuery(medias.mid).find('.tab-button').css('color',jQuery('.tab-border-text-color').val());
        jQuery(medias.mid).find('.tab-button').css('background-color',jQuery('.tab-border-background-color').val());
        var border = jQuery('.tab-border-button').val();
        var background = jQuery('.tab-border-button-color').val();
        if(!isNaN(border)) {
            jQuery(medias.mid).find('.tab-button').css('border',border+'px solid '+background);
        }
    });    
    jQuery(document).on('change', '.tabmon', function() {
        var rows = jQuery('.tab-rows').val();
        var columns = jQuery('#popup_table .tab-columns').val();
        console.log(columns);
        var first_column = jQuery('.first-column').val();
        var second_column = jQuery('.second-column').val();
        var third_column = jQuery('.third-column').val();
        var fourth_column = jQuery('.fourth-column').val();
        var tab_border = jQuery('.tab-border').val();
        var tab_border_color = jQuery('.tab-border-color').val();
        var tab_background_color = jQuery('.tab-background-color').val();
        var tab_cellpadding = jQuery('.tab-cellpadding').val();
        var cellpadding = '';
        if(tab_cellpadding > 0) {
            if(tab_cellpadding > 15) {
                tab_cellpadding = 15;
            }
            cellpadding = 'padding: ' + tab_cellpadding + 'px;';
        }
        var border = '';
        if(tab_border > 0) {
            border = ' style="border: ' + tab_border + 'px solid ' + tab_border_color + cellpadding + ';"';
        }
        if(border && cellpadding) {
            border = border.replace(';"',';' + cellpadding + '"');
        } else if(cellpadding) {
            border = ' style="' + cellpadding + '"';
        }
        var tab_init = '<table data-rows="' + rows + '" data-columns="' + columns + '" data-border="' + tab_border + '" data-border-color="' + tab_border_color + '" data-first-column="' + first_column + '" data-second-column="' + second_column + '" data-third-column="' + third_column + '" data-fourth-column="' + fourth_column + '">';
        if(!isNaN(rows)) {
            for(var c = 0; c < rows; c++) {
                var colls = '';
                if(!isNaN(columns)) {
                    for(var d = 0; d < columns; d++) {
                        var size = '';
                        if(d === 0 && first_column > 0) {
                            size = ' width="' + first_column + '%"';
                        }
                        if(d === 1 && second_column > 0) {
                            size = ' width="' + second_column + '%"';
                        }
                        if(d === 2 && third_column > 0) {
                            size = ' width="' + third_column + '%"';
                        }
                        if(d === 3 && fourth_column > 0) {
                            size = ' width="' + fourth_column + '%"';
                        }
                        if(d > 3) {
                            break;
                        }
                        colls += '<td' + border + size + '></td>';
                    }
                }
                tab_init += '<tr>' + colls + '</tr>';
            }
        }
        tab_init += '</table>';
        jQuery(medias.mid).html(tab_init);
        if(tab_background_color) {
            jQuery(medias.mid).find('table').css({'background-color':tab_background_color});
        }
    });
    // Delete the template item
    jQuery(document).on('click','.delete-the-template-item',function(){
        jQuery(medias.mid).remove();
    });
    // Delete the template table
    jQuery(document).on('click','#delete-table-from-template, #delete-line-from-template, #delete-space-from-template, #delete-button-from-template',function(){
        setTimeout(function(){
            if(jQuery('#popup_line').hasClass('in')) {
                jQuery(medias.mid).remove();
                jQuery('#popup_line').modal('hide');
            } else if(jQuery('#popup_space').hasClass('in')) {
                jQuery(medias.mid).remove();
                jQuery('#popup_space').modal('hide');
            } else if(jQuery('#popup_button_edit').hasClass('in')) {
                jQuery(medias.mid).remove();
                jQuery('#popup_button_edit').modal('hide');
            } else {
                jQuery(medias.mid).remove();
                jQuery(document).find('#delete-table-from-template').removeAttr('checked');
                jQuery('#popup_table').modal('hide');
            }
        },500);
    });
    // Close the tolbox
    jQuery(document).click(function() {
        jQuery(document).find('.show-template-composer-tools').animate({opacity:'0.3'},300,function() {
            jQuery(document).find('.show-template-composer-tools').remove();
        });
    });
    // Add a link for image
    jQuery(document).on('click','body .enter-a-link-template-item',function(){
        if(jQuery('#popup_paragraph_edit').hasClass('in') || jQuery('#popup_lists_edit').hasClass('in')) {
            jQuery('.change-tem-link-color').show();
            medias.m = jQuery(this);
        } else {
            jQuery('.change-tem-link-color').hide();
        }
        jQuery('#dialog-form').show();
        jQuery('#dialog-form').dialog();
    });
    // Insert Link
    jQuery(document).on('click','.add-tem-link',function(){
        var newLink = jQuery('#tem-url-field').val();
        if (newLink) {
            if(jQuery('#popup_paragraph_edit').hasClass('in')) {
                var imi = jQuery('.edit-paragraph-textarea').val();
                imi = stripHTML(imi);
                var im = '<a href="' + newLink + '" style="color:' + jQuery('.change-tem-link-color').val() + '">' + imi + '</a>';
                jQuery('.edit-paragraph-textarea').val(im);
            } else if(jQuery('#popup_lists_edit').hasClass('in')) {
                var imi = jQuery(medias.m).closest('.panel').find('textarea').val();
                imi = stripHTML(imi);
                console.log(jQuery(medias.m).closest('.panel').find('.change-tem-text-color').val());
                var im = '<a href="' + newLink + '" style="color:' + jQuery('.change-tem-link-color').val() + '">' + imi + '</a>';
                jQuery(medias.m).closest('.panel').find('textarea').val(im);                
            } else {
                if(jQuery(medias.mid).find('img').length > 0) {
                    var imi = jQuery(medias.mid).find('img').context.innerHTML;
                    imi = imi.split('<img');
                    imi = imi[1].split('>');
                    imi = '<img' + imi[0] + '>';
                    var im = '<a href="' + newLink + '">' + imi + '</a>';
                    jQuery(medias.mid).html(im);
                } else {
                    jQuery(medias.mid).find('a').attr('href',newLink);
                }
            }
        }
        jQuery('#tem-url-field').val('');
        jQuery('#dialog-form').hide();
        jQuery('#dialog-form').dialog('close');
    });    
    // Remove an image link
    jQuery(document).on('click','.remove-a-link-template-item',function(){
        if(jQuery('#popup_lists_edit').hasClass('in')) {
            var imi = jQuery(medias.m).closest('.panel').find('textarea').val();
            imi = stripHTML(imi);
            jQuery(medias.m).closest('.panel').find('textarea').val(imi);
        } else if(jQuery('#popup_paragraph_edit').hasClass('in')) {
            var imi = jQuery(medias.m).closest('.modal').find('textarea').val();
            imi = stripHTML(imi);
            jQuery(medias.m).closest('.modal').find('textarea').val(imi);            
        } else {
            var imi = jQuery(medias.mid).find('img').context.innerHTML;
            imi = imi.split('<img');
            imi = imi[1].split('>');
            var im = '<img' + imi[0] + '>';
            jQuery(medias.mid).html(im);            
        }
    });
    // Align item's childrens to right
    jQuery(document).on('click','.align-right-template-item',function(){
        jQuery(medias.mid).css('text-align','right');
    });
    // Align item's childrens to center
    jQuery(document).on('click','.align-center-template-item',function(){
        jQuery(medias.mid).css('text-align','center');
    });
    // Align item's childrens to left
    jQuery(document).on('click','.align-left-template-item',function(){
        jQuery(medias.mid).css('text-align','left');
    });
    // Resize image
    jQuery(document).on('click','.resize-image-template-item',function(){
        jQuery(medias.mid).find('img').css('width',jQuery(this).attr('data-value'));
    });
    // Add Bold Style
    jQuery(document).on('click','.add-bold-style-template-item',function(){
        jQuery(medias.mid).css('font-weight','600');
    });
    // Add Italic Style
    jQuery(document).on('click','.add-italic-style-template-item',function(){
        jQuery(medias.mid).css('font-style','italic');
    });    
    // Change header
    jQuery(document).on('click','.change-header',function(){
        var type = jQuery(this).attr('data-type');
        jQuery(medias.mid).html('<' + type + ' style="margin: 0;">' + jQuery(medias.mid).text() + '<' + type + '/>');
    });
    // Edit header text
    jQuery(document).on('click','.edit-header-text',function(){
        jQuery('.edit-header-textarea').val(jQuery(medias.mid).text());
        if(jQuery(medias.mid).attr('style')) {
            jQuery('.edit-header-textarea').attr('style',jQuery(medias.mid).attr('style'));
        } else {
            jQuery('.edit-header-textarea').removeAttr('style');
        }
    });
    // Save edited header text
    jQuery(document).on('click','#popup_header_edit .btn-primary',function(){
        jQuery(medias.mid).children().html(jQuery('.edit-header-textarea').val());
        jQuery(medias.mid).attr('style',jQuery('.edit-header-textarea').attr('style'));
    });
    // Save edited lists
    jQuery(document).on('click','#popup_lists_edit .btn-primary',function(){
        var mi = jQuery('#popup_lists_edit').find('.panel-default').length;
        if(mi) {
            var min = '';
            for(var d = 0; d < mi; d++) {
                var teg = jQuery('#popup_lists_edit').find('textarea')[d].value;
                var te = jQuery('#popup_lists_edit').find('textarea')[d].getAttribute('style');
                min += '<li style="' + te + '">' + teg + '</li>';
            }
            jQuery(medias.mid).children().html(min);
        } else {
            jQuery(medias.mid).remove();
        }
    });
    // Save html code
    jQuery(document).on('click','#popup_html_edit .btn-primary',function(){
        var html = jQuery('#popup_html_edit').find('.edit-header-textarea').val();
        if(html) {
            jQuery(medias.mid).find('.html').html(html);
        }
    });    
    // Edit paragraph text
    jQuery(document).on('click','.edit-paragraph-text',function(){
        jQuery('.edit-paragraph-textarea').removeAttr('style');
        jQuery('.change-tem-text-color').val('#FFFFFF');
        jQuery('.edit-paragraph-textarea').val(jQuery(medias.mid).children().html());
        jQuery('.edit-paragraph-textarea').attr('style',jQuery(medias.mid).attr('style'));
    });
    // Edit button text
    jQuery(document).on('click','.edit-button-text',function(){
        jQuery('.tab-button-text').val(jQuery(medias.mid).find('.tab-button').text());
        var attrs = jQuery(medias.mid).find('.tab-button').attr('style');
        if(attrs) {
            var res = parse_styles(attrs, 'border:', 3, '');
            if(res) {
                var b = res[1].split('px');
                jQuery('.tab-border-button').val(b[0]);
                if(res[1].search('#') > -1) {
                    var si = res[1].split('#');
                    si = '#'+si[1];
                } else {
                    var si = res[1].split('rgb');
                    si = rgb2hex('rgb'+si[1]);               
                }
                
                jQuery('.tab-border-button-color').val(si);
            }
            res = parse_styles(attrs, 'color:', 3, '');
            if(res) {
                jQuery('.tab-border-text-color').val(rgb2hex(res[1]));
            }
            res = parse_styles(attrs, 'background-color:', 3, '');
            if(res) {
                jQuery('.tab-border-background-color').val(rgb2hex(res[1]));
            }
        }
    });
    // Edit button text
    jQuery(document).on('click','.edit-tem-lists',function(){
        var sun = '';
        if(jQuery(medias.mid).find('ul').length > 0) {
            for(var s = 0; s < jQuery(medias.mid).find('ul').find('li').length; s++) {
                sun += temison(jQuery(medias.mid).find('ul').find('li')[s].innerHTML,jQuery(medias.mid).find('ul').find('li')[s].getAttribute('style'));
            }
        } else if(jQuery(medias.mid).find('ol').length > 0) {
            for(var s = 0; s < jQuery(medias.mid).find('ol').find('li').length; s++) {
                sun += temison(jQuery(medias.mid).find('ol').find('li')[s].innerHTML,jQuery(medias.mid).find('ol').find('li')[s].getAttribute('style'));
            }
        }
        jQuery('#popup_lists_edit .media-gallery').html(sun);
    });
    // Edit html form
    jQuery(document).on('click','.edit-tem-html',function(){
        jQuery('#popup_html_edit').find('.edit-header-textarea').val(jQuery(medias.mid).find('.html').html());
    });    
    // Save edited header text
    jQuery(document).on('click','#popup_paragraph_edit .btn-primary',function(){
        var attrs = jQuery('.edit-paragraph-textarea').attr('style');
        jQuery(medias.mid).attr('style',attrs);
        jQuery(medias.mid).find('p').html(jQuery('.edit-paragraph-textarea').val());
    });
    // Change the paragraph color text
    jQuery(document).on('change', '.change-tem-text-color', function() {
        if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
            var color = jQuery(this).val();
            jQuery(this).closest('.panel').find('textarea').css('color',color);
        } else {
            var color = jQuery(this).val();
            jQuery('.edit-paragraph-textarea').css('color',color);            
        }
    });
    // Change the header color text
    jQuery(document).on('change', '.change-tem-header-color', function() {
        var color = jQuery(this).val();
        jQuery('.edit-header-textarea').css('color',color);
    });    
    // Align the text to left
    jQuery(document).on('click', '.align-tem-text-to-left', function() {
        jQuery(this).closest('.modal').find('textarea').css('text-align','left');
    });
    // Align the text to center
    jQuery(document).on('click', '.align-tem-text-to-center', function() {
        jQuery(this).closest('.modal').find('textarea').css('text-align','center');
    });
    // Align the text to right
    jQuery(document).on('click', '.align-tem-text-to-right', function() {
        jQuery(this).closest('.modal').find('textarea').css('text-align','right');
    });
    // Align the text to justify
    jQuery(document).on('click', '.align-tem-text-to-justify', function() {
        jQuery(this).closest('.modal').find('textarea').css('text-align','justify');
    });
    // Add bold to text
    jQuery(document).on('click', '.bold-tem-text', function() {
        if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
            var attrs = jQuery('.edit-header-textarea').attr('style');
        } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
            var attrs = jQuery(this).closest('.panel').find('textarea').attr('style');
        } else {
            var attrs = jQuery('.edit-paragraph-textarea').attr('style');
        }
        if(attrs) {
            var res = parse_styles(attrs, 'font-weight:', 3, '');
            if(res) {
                if(res[1] === '400') {
                    if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                        jQuery('.edit-header-textarea').css('font-weight','600');
                    } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                        jQuery(this).closest('.panel').find('textarea').css('font-weight','600');
                    } else {
                        jQuery('.edit-paragraph-textarea').css('font-weight','600');
                    }
                } else {
                    if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                        jQuery('.edit-header-textarea').css('font-weight','400');
                    } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                        jQuery(this).closest('.panel').find('textarea').css('font-weight','400');
                    } else {
                        jQuery('.edit-paragraph-textarea').css('font-weight','400');
                    }
                }
            } else {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                    jQuery('.edit-header-textarea').css('font-weight','600');
                } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css('font-weight','600');
                } else {
                    jQuery('.edit-paragraph-textarea').css('font-weight','600');
                }
            }
        } else {
            if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                jQuery('.edit-header-textarea').css('font-weight','600');
            } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                jQuery(this).closest('.panel').find('textarea').css('font-weight','600');
            } else {
                jQuery('.edit-paragraph-textarea').css('font-weight','600');
            }
        }
    });
    // Add italic to text
    jQuery(document).on('click', '.italic-tem-text', function() {
        if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
            var attrs = jQuery('.edit-header-textarea').attr('style');
        } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
            var attrs = jQuery(this).closest('.panel').find('textarea').attr('style');
        } else {
            var attrs = jQuery('.edit-paragraph-textarea').attr('style');
        }
        if(attrs) {
            var res = parse_styles(attrs, 'font-style:', 3, '');
            if(res) {
                if(res[1] === 'normal') {
                    if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                        jQuery('.edit-header-textarea').css('font-style','italic');
                    } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                        jQuery(this).closest('.panel').find('textarea').css('font-style','italic');
                    } else {
                        jQuery('.edit-paragraph-textarea').css('font-style','italic');
                    }
                } else {
                    if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                        jQuery('.edit-header-textarea').css('font-style','normal');
                    } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                        jQuery(this).closest('.panel').find('textarea').css('font-style','normal');
                    } else {
                        jQuery('.edit-paragraph-textarea').css('font-style','normal');
                    }
                }
            } else {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                    jQuery('.edit-header-textarea').css('font-style','italic');
                } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css('font-style','italic');
                } else {
                    jQuery('.edit-paragraph-textarea').css('font-style','italic');
                }
            }
        } else {
            if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                jQuery('.edit-header-textarea').css('font-style','italic');
            } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                jQuery(this).closest('.panel').find('textarea').css('font-style','italic');
            } else {
                jQuery('.edit-paragraph-textarea').css('font-style','italic');
            }
        }
    });
    // Add underline to text
    jQuery(document).on('click', '.underline-tem-text', function() {
        if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
            var attrs = jQuery('.edit-header-textarea').attr('style');
        } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
            var attrs = jQuery(this).closest('.panel').find('textarea').attr('style');
        } else {
            var attrs = jQuery('.edit-paragraph-textarea').attr('style');
        }
        if(attrs) {
            var res = parse_styles(attrs, 'text-decoration:', 3, '');
            if(res) {
                if(res[1] === 'none') {
                    if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                        jQuery('.edit-header-textarea').css('text-decoration', 'underline');
                    } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                        jQuery(this).closest('.panel').find('textarea').css('text-decoration', 'underline');
                    } else {
                        jQuery('.edit-paragraph-textarea').css('text-decoration', 'underline');
                    }
                } else {
                    if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                        jQuery('.edit-header-textarea').css('text-decoration', 'none');
                    } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                        jQuery(this).closest('.panel').find('textarea').css('text-decoration', 'none');
                    } else {
                        jQuery('.edit-paragraph-textarea').css('text-decoration', 'none');
                    }
                }
            } else {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                    jQuery('.edit-header-textarea').css('text-decoration', 'underline');
                } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css('text-decoration', 'underline');
                } else {
                    jQuery('.edit-paragraph-textarea').css('text-decoration', 'underline');
                }
            }
        } else {
            if(jQuery(this).closest('.modal').attr('id') === 'popup_header_edit') {
                jQuery('.edit-header-textarea').css('text-decoration', 'underline');
            } else if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                jQuery(this).closest('.panel').find('textarea').css('text-decoration', 'underline');
            } else {
                jQuery('.edit-paragraph-textarea').css('text-decoration', 'underline');
            }
        }
    });
     // Add underline to paragraph text
    jQuery(document).on('click', '.add-underline-style-template-item', function() {
        var attrs = jQuery(medias.mid).attr('style');
        if(attrs) {
            var res = parse_styles(attrs, 'text-decoration:', 3, '');
            if(res) {
                if(res[1] === 'none') {
                    jQuery(medias.mid).css('text-decoration', 'underline');
                } else {
                    jQuery(medias.mid).css('text-decoration', 'none');
                }
            } else {
                jQuery(medias.mid).css('text-decoration', 'underline');
            }
        } else {
            jQuery(medias.mid).css('text-decoration', 'underline');
        }
    });   
    // Add indent to text
    jQuery(document).on('click', '.indent-tem-text', function() {
        jQuery('.edit-paragraph-textarea').css('text-indent', '50px');
    });
    // Add outdent to text
    jQuery(document).on('click', '.outdent-tem-text', function() {
        jQuery('.edit-paragraph-textarea').css('text-indent', '0');
    });
    // Add indent to paragraph text
    jQuery(document).on('click', '.add-indent-style-template-item', function() {
        jQuery(medias.mid).css('text-indent', '50px');
    });
    // Add outdent to paragraph text
    jQuery(document).on('click', '.add-outdent-style-template-item', function() {
        jQuery(medias.mid).css('text-indent', '0');
    });
    // Change ol to ul
    jQuery(document).on('click', '.ul-template-item', function() {
        if(jQuery(medias.mid).find('ol').length > 0) {
            var set = jQuery(medias.mid).html();
            set = set.replace('ol>','ul>');
            jQuery(medias.mid).html(set);
        }
    });
    // Change ul to ol
    jQuery(document).on('click', '.ol-template-item', function() {
        if(jQuery(medias.mid).find('ul').length > 0) {
            var set = jQuery(medias.mid).html();
            set = set.replace('ul>','ol>');
            jQuery(medias.mid).html(set);
        }
    });
    // Add new ul or ol child
    jQuery(document).on('click', '.new-li-template-item', function() {
        if(jQuery(medias.mid).find('ul').length > 0) {
            jQuery(medias.mid).find('ul').append('<li style="font-size:14px;color:#333333;">Nullam pretium risus sapien.</li>');
        } else if(jQuery(medias.mid).find('ol').length > 0) {
            jQuery(medias.mid).find('ol').append('<li style="font-size:14px;color:#333333;">Nullam pretium risus sapien.</li>');
        }
    });    
    // Increase font size
    jQuery(document).on('click', '.increase-item-tem-text-size', function() {
        if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
            var attrs = jQuery(this).closest('.panel').find('textarea').attr('style');
        } else {
            var attrs = jQuery('.edit-paragraph-textarea').attr('style');
        }
        if(attrs) {
            var res = parse_styles(attrs, 'font-size:', 1, 'px');
            if(res) {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css(res[0], res[1]);
                } else {
                   jQuery('.edit-paragraph-textarea').css(res[0], res[1]);
                }
            } else {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css('font-size', '15px');
                } else {                
                    jQuery('.edit-paragraph-textarea').css('font-size', '17px');
                }
            }
        } else {
            if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                jQuery(this).closest('.panel').find('textarea').css('font-size', '15px');
            } else {                
                jQuery('.edit-paragraph-textarea').css('font-size', '17px');
            }
        }
    });
    // Decrease font size
    jQuery(document).on('click', '.decrease-item-tem-text-size', function() {
        if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
            var attrs = jQuery(this).closest('.panel').find('textarea').attr('style');
        } else {
            var attrs = jQuery('.edit-paragraph-textarea').attr('style');
        }
        if(attrs) {
            var res = parse_styles(attrs, 'font-size:', 2, 'px');
            if(res) {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css(res[0], res[1]);
                } else {
                    jQuery('.edit-paragraph-textarea').css(res[0], res[1]);
                }
            } else {
                if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                    jQuery(this).closest('.panel').find('textarea').css('font-size', '13px');
                } else {                
                    jQuery('.edit-paragraph-textarea').css('font-size', '15px');
                }
            }
        } else {
            if(jQuery(this).closest('.modal').attr('id') === 'popup_lists_edit') {
                jQuery(this).closest('.panel').find('textarea').css('font-size', '13px');
            } else {                
                jQuery('.edit-paragraph-textarea').css('font-size', '15px');
            }
        }
    });
    // Get tabs
    jQuery(document).on('click', '.campaign-menu>li>a', function(e) {
        e.preventDefault();
        jQuery(document).find('.emails .campaign-menu>li').removeClass('active');
        jQuery(document).find('.emails .campaign-tabs>div').removeClass('active');
        var href = jQuery(this).attr('href');
        jQuery(href).addClass('active');
        jQuery(this).closest('li').addClass('active');
    });
    function get_tools_for(top,left,num) {
        var tabs = '';
        var clas = '';
        if(num === 1) {
            clas = ' first-tools-area';
            tabs += '<div class="col-md-2"><button class="align-left-template-item"><i class="fa fa-align-left"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="align-center-template-item"><i class="fa fa-align-center"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="align-right-template-item"><i class="fa fa-align-right"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="enter-a-link-template-item"><i class="fa fa-link"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="remove-a-link-template-item"><i class="fa fa-chain-broken"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="resize-image-template-item" data-value="25%">25%</button></div>';
            tabs += '<div class="col-md-2"><button class="resize-image-template-item" data-value="50%">50%</button></div>';    
            tabs += '<div class="col-md-2"><button class="resize-image-template-item" data-value="100%">100%</button></div>'; 
            tabs += '<div class="col-md-2"><button class="delete-the-template-item"><i class="fa fa-trash-o"></i></button></div>';        
        } else if(num === 2) {
            clas = ' second-tools-area';
            tabs += '<div class="col-md-2"><button class="edit-header-text" data-toggle="modal" data-target="#popup_header_edit"><i class="fa fa-pencil" aria-hidden="true"></i></button></div>'; 
            tabs += '<div class="col-md-2"><button class="align-left-template-item"><i class="fa fa-align-left"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="align-center-template-item"><i class="fa fa-align-center"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="align-right-template-item"><i class="fa fa-align-right"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="change-header" data-type="h1"><strong>H1</strong></button></div>';
            tabs += '<div class="col-md-2"><button class="change-header" data-type="h2"><strong>H2</strong></button></div>';
            tabs += '<div class="col-md-2"><button class="change-header" data-type="h3"><strong>H3</strong></button></div>';
            tabs += '<div class="col-md-2"><button class="change-header" data-type="h4"><strong>H4</strong></button></div>';    
            tabs += '<div class="col-md-2"><button class="change-header" data-type="h5"><strong>H5</strong></button></div>';
            tabs += '<div class="col-md-2"><button class="delete-the-template-item"><i class="fa fa-trash-o"></i></button></div>';        
        } else if(num === 3) {
            clas = ' second-tools-area';
            tabs += '<div class="col-md-2"><button class="edit-paragraph-text" data-toggle="modal" data-target="#popup_paragraph_edit"><i class="fa fa-pencil" aria-hidden="true"></i></button></div>'; 
            tabs += '<div class="col-md-2"><button class="align-left-template-item"><i class="fa fa-align-left"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="align-center-template-item"><i class="fa fa-align-center"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="align-right-template-item"><i class="fa fa-align-right"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="add-bold-style-template-item"><i class="fa fa-bold"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="add-italic-style-template-item"><i class="fa fa-italic"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="add-underline-style-template-item"><i class="fa fa-underline"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="add-indent-style-template-item"><i class="fa fa-indent"></i></div>';    
            tabs += '<div class="col-md-2"><button class="add-outdent-style-template-item"><i class="fa fa-outdent"></i></button></div>';
            tabs += '<div class="col-md-2"><button class="delete-the-template-item"><i class="fa fa-trash-o"></i></button></div>';        
        } else if(num === 4) {
            clas = ' first-tools-area';
            tabs += '<div class="col-md-3"><button class="edit-button-text" data-toggle="modal" data-target="#popup_button_edit"><i class="fa fa-pencil"></i></button></div>'; 
            tabs += '<div class="col-md-3"><button class="align-left-template-item"><i class="fa fa-align-left"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="align-center-template-item"><i class="fa fa-align-center"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="align-right-template-item"><i class="fa fa-align-right"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="enter-a-link-template-item"><i class="fa fa-link"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="delete-the-template-item"><i class="fa fa-trash-o"></i></button></div>';        
        } else if(num === 5) {
            clas = ' second-tools-area';
            tabs += '<div class="col-md-3"><button class="edit-tem-lists" data-toggle="modal" data-target="#popup_lists_edit"><i class="fa fa-pencil"></i></button></div>'; 
            tabs += '<div class="col-md-3"><button class="new-li-template-item"><i class="fa fa-plus-square-o"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="add-indent-style-template-item"><i class="fa fa-indent"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="add-outdent-style-template-item"><i class="fa fa-outdent"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="ul-template-item"><i class="fa fa-list"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="ol-template-item"><i class="fa fa-list-ol"></i></button></div>';
            tabs += '<div class="col-md-3"><button class="delete-the-template-item"><i class="fa fa-trash-o"></i></button></div>';        
        } else if(num === 6) {
            clas = ' third-tools-area';
            tabs += '<div class="col-md-6"><button class="edit-tem-html" data-toggle="modal" data-target="#popup_html_edit"><i class="fa fa-pencil"></i></button></div>';
            tabs += '<div class="col-md-6"><button class="delete-the-template-item"><i class="fa fa-trash-o"></i></button></div>';        
        }
        setTimeout(function() {
            jQuery('<div class="show-template-composer-tools' + clas + '" data-type="' + num + '"><div class="row">' + tabs + '</div></div>').insertAfter('section');
            jQuery(document).find('.show-template-composer-tools').css({top:top+'px',left:left+'px','z-index':7});
        },200);
    }
    function emails_pagination(id,total) {
        if((id === '#campaigns') || (id === '#sent-emails')) {
            var pg = emails.page;
            var lim = emails.limit;
        } else if(id === '#history') {
            var pg = emails.page;
            var lim = emails.limit;
        } else {
            var pg = lists.page;
            var lim = lists.limit;
        }
        // the code bellow displays pagination
        jQuery(id+' .pagination').empty();
        if (parseInt(pg) > 1) {
            var bac = parseInt(pg) - 1;
            var pages = '<li><a href="#" data-page="' + bac + '">'+translation.mm128+'</a></li>';
        }
        else {
            var pages = '<li class="pagehide"><a href="#">'+translation.mm128+'</a></li>';
        }
        var tot = parseInt(total) / parseInt(lim);
        tot = Math.ceil(tot) + 1;
        var from = (parseInt(pg) > 2) ? parseInt(pg) - 2 : 1;
        for (var p = from; p < parseInt(tot); p++) {
            if (p === parseInt(pg)) {
                pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
            }
            else if ((p < parseInt(pg) + 3) && (p > parseInt(pg) - 3)) {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            }
            else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(pg) == 1) || (parseInt(pg) == 2))) {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            }
            else {
                break;
            }
        }
        if (p === 1) {
            pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
        }
        var next = parseInt(pg);
        next++;
        if (next < Math.round(tot)) {
            jQuery(id+' .pagination').html(pages + '<li><a href="#" data-page="' + next + '">'+translation.mm129+'</a></li>');
        }
        else {
            jQuery(id+' .pagination').html(pages + '<li class="pagehide"><a href="#">'+translation.mm129+'</a></li>');
        }
    }
    function stripHTML(str){
        // Remove HTML tags
        var strippedText = jQuery('<div/>').html(str).text();
        return strippedText;
    }    
    function campaigns_results(page) {
        // display emails by page
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/show-campaigns/' + page + '/email',
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.total) {
                    var tot;
                    emails.page = page;
                    emails_pagination('#campaigns',data.total);
                    for(var m = 0; m < data.campaigns.length; m++) {
                        var campaign_id = data.campaigns[m].campaign_id;
                        var name = data.campaigns[m].name;
                        var description = data.campaigns[m].description;
                        var gettime = calculate_time(data.campaigns[m].created, data.date);
                        if(typeof tot === 'undefined') {
                            tot = '<li><h4>' + name + ' <div class="btn-group pull-right"><a href="'+url+'user/emails/campaign/'+campaign_id+'" class="btn btn-default">Manage</a><a href="#" data-id="' + campaign_id + '" class="btn btn-default delete-cam"><i class="fa fa-trash-o"></i></a></div></h4></li>';
                        } else {
                            tot += '<li><h4>' + name + ' <div class="btn-group pull-right"><a href="'+url+'user/emails/campaign/'+campaign_id+'" class="btn btn-default">Manage</a><a href="#" data-id="' + campaign_id + '" class="btn btn-default delete-cam"><i class="fa fa-trash-o"></i></a></div></h4></li>';
                        }
                    }
                    jQuery('#campaign_gallery>ul').html(tot);
                } else {
                    jQuery('#campaign_gallery>ul').html('<p class="list-group-item">'+translation.mm179+'</p>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                jQuery('#campaign_gallery>ul').html('<p class="list-group-item">'+translation.mm179+'</p>');
            }
        });
    }
    function show_template_lists() {
        // display schedules by campaign_id
        var campaign_id = jQuery('.campaign-page').attr('data-id');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/get-templates/' + campaign_id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data) {
                    var tot = ' ';
                    var sd = [];
                    for(var m = 0; m < data.length; m++) {
                        tot += '<li><h4>' + data[m].title + ' <div class="btn-group pull-right"><button type="button" data-type="main" class="btn btn-default select-temp" data-id="' + data[m].template_id + '">Select</button><button type="button" class="btn btn-default show-accounts deleteTemplate" data-id="' + data[m].template_id + '"><i class="fa fa-trash-o"></i></button></div></h4></li>';
                        sd.push([data[m].template_id,data[m].title]);
                    }
                    lists.templates = sd;
                    jQuery('.show-templates-lists-here>ul').html(tot);
                } else {
                    jQuery('.show-templates-lists-here>ul').html('<p class="list-group-item">' + translation.mm154 + '</p>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('.show-templates-lists-here>ul').html('<p class="list-group-item">' + translation.mm154 + '</p>');
            }
        });
    }    
    function schedules() {
        // display schedules by campaign_id
        var campaign_id = jQuery('.campaign-page').attr('data-id');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/schedules/' + campaign_id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.length) {
                    var tot = '';
                    for(var m = 0; m < data.length; m++) {
                        var gettime = calculate_time(data[m].send_at, data[m].tim);
                        if(typeof tot === 'undefined') {
                            tot = '<li><div class="col-md-10 col-sm-8 col-xs-6 clean"><h3>'+translation.mm156+data[m].title+translation.mm157+data[m].name+'</h3><span>'+gettime+'</span></div><div class="col-md-2 col-sm-4 col-xs-6 clean text-right"><button type="button" class="btn btn-danger delete-schedules" data-id="'+data[m].scheduled_id+'"><i class="fa fa-times" aria-hidden="true"></i> '+translation.mm133+'</button></div></li>';
                        } else {
                            tot += '<li><div class="col-md-10 col-sm-8 col-xs-6 clean"><h3>'+translation.mm156+data[m].title+translation.mm157+data[m].name+'</h3><span>'+gettime+'</span></div><div class="col-md-2 col-sm-4 col-xs-6 clean text-right"><button type="button" class="btn btn-danger delete-schedules" data-id="'+data[m].scheduled_id+'"><i class="fa fa-times" aria-hidden="true"></i> '+translation.mm133+'</button></div></li>';
                        }                
                    }
                    jQuery('.feeds-rss').html(tot);
                } else {
                    jQuery('.feeds-rss').html('');
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
            }
        });
    }
    function shistory(page) {
        // display sent templates
        var campaign_id = jQuery('.campaign-page').attr('data-id');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/shistory/' + campaign_id + '?page='+page,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data) {
                    emails.page = page;
                    emails_pagination('#history',data.total);
                    if(data.scheds.length) {
                        var tot = '';
                        for(var m = 0; m < data.scheds.length; m++) {
                            var gettime = calculate_time(data.scheds[m].send_at, data.scheds[m].tim);
                            if(data.scheds[m].a < 1) {
                                var bi = '<p><a href="#" class="delete-schedules" data-id="' + data.scheds[m].scheduled_id + '"><span class="badge badge-info badge-danger">' + translation.mm133 + '</span></a></p>';
                            } else {
                                var bi = '<p><a href="' + url + 'user/emails/sent/' + data.scheds[m].scheduled_id + '"><span class="badge badge-info">'+data.scheds[m].sent+' '+translation.mm160+'</span></a><a href="' + url + 'user/emails/opened/' + data.scheds[m].scheduled_id + '"""><span class="badge badge-info badge-opened">'+data.scheds[m].readi+' '+translation.mm159+'</span></a><a href="' + url + 'user/emails/unread/' + data.scheds[m].scheduled_id + '"><span class="badge badge-info badge-non">'+data.scheds[m].unread+' '+translation.mm161+'</span></a><a href="' + url + 'user/emails/unsubscribed/' + data.scheds[m].scheduled_id + '"><span class="badge badge-info badge-danger">'+data.scheds[m].unsub+' '+translation.mm162+'</span></a></p>';
                            }
                            var si = '<li><h4>'+translation.mm156+data.scheds[m].title+translation.mm158+data.scheds[m].name+' <span>'+gettime+'</span></h4>' + bi + '<hr></li>';
                            if(typeof tot === 'undefined') {
                                tot = si;
                            } else {
                                tot += si;
                            }                
                        }
                        jQuery('.histories').html(tot);
                    } else {
                        jQuery('.histories').html('<li><p>'+translation.mm163+'</p></li>');
                    }
                } else {
                    jQuery('.histories').html('<li><p>'+translation.mm163+'</p></li>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                jQuery('.histories').html('<li><p>'+translation.mm163+'</p></li>');
            }
        });
    }
    function sehistory(page) {
        // display sent templates
        var sched_id = jQuery('.sent-info').attr('data-id');
        var type = jQuery('.sent-info').attr('data-type');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/schedules/' + type + '/' + sched_id + '/' + page,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.total) {
                    var tot;
                    emails.page = page;
                    emails_pagination('#sent-emails',data.total);
                    for(var m = 0; m < data.emails.length; m++) {
                        var list_id = data.emails[m].list_id;
                        var email = data.emails[m].body;
                        var meta_id = data.emails[m].meta_id;
                        if(typeof tot === 'undefined') {
                            tot = '<tr><td>'+email+'</td></tr>';
                        } else {
                            tot += '<tr><td>'+email+'</td></tr>';
                        }
                    }
                    jQuery('#sent-emails .list-emails').html(tot);
                } else {
                    jQuery('#sent-emails .list-emails').html('<tr><td>'+translation.mm164+'</td></tr>');
                    jQuery('.get-csv-sent').remove();
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('#sent-emails .list-emails').html('<tr><td>'+translation.mm164+'</td></tr>');
                jQuery('.get-csv-sent').remove();
            }
        });
    }
    function lists_results(page) {
        // display lists by page
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/show-lists/' + page + '/email',
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.total) {
                    var tot;
                    lists.page = page;
                    emails_pagination('#lists',data.total);
                    for(var m = 0; m < data.lists.length; m++) {
                        var list_id = data.lists[m].list_id;
                        var name = data.lists[m].name;
                        var description = data.lists[m].description;
                        var gettime = calculate_time(data.lists[m].created, data.date);
                        if(typeof tot === 'undefined') {
                            tot = '<li><h4>' + name + ' <div class="btn-group pull-right"><a href="'+url+'user/emails/lists/'+list_id+'" class="btn btn-default">Manage</a><button type="button" class="btn btn-default delete-list" data-id="' + list_id + '"><i class="fa fa-trash-o"></i></button></div></h4></li>';
                        } else {
                            tot += '<li><h4>' + name + ' <div class="btn-group pull-right"><a href="'+url+'user/emails/lists/'+list_id+'" class="btn btn-default">Manage</a><button type="button" class="btn btn-default delete-list" data-id="' + list_id + '"><i class="fa fa-trash-o"></i></button></div></h4></li>';
                        }
                    }
                    jQuery('#lists_gallery>ul').html(tot);
                } else {
                    jQuery('#lists_gallery>ul').html('<p class="list-group-item">'+translation.mm180+'</p>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                jQuery('#lists_gallery>ul').html('<p class="list-group-item">'+translation.mm180+'</p>');
            }
        });
    }
    function emails_results(page) {
        // display emails by list
        var list  = jQuery('.list-details').attr('data-id');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/show-lists-meta/'+page+'/'+list,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.total) {
                    var tot;
                    lists.page = page;
                    emails_pagination('#show-emails',data.total);
                    for(var m = 0; m < data.emails.length; m++) {
                        var list_id = data.emails[m].list_id;
                        var email = data.emails[m].body;
                        var meta_id = data.emails[m].meta_id;
                        if(typeof tot === 'undefined') {
                            tot = '<tr><td>'+email+'</td><td style="text-align: right;"><button class="btn-view-fund btn btn-default btn-xs delete-email" type="button" data-list="'+list_id+'" data-meta="'+meta_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
                        } else {
                            tot += '<tr><td>'+email+'</td><td style="text-align: right;"><button class="btn-view-fund btn btn-default btn-xs delete-email" type="button" data-list="'+list_id+'" data-meta="'+meta_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
                        }
                    }
                    jQuery('#show-emails .list-emails').html(tot);
                } else {
                    jQuery('#show-emails .list-emails').html('<tr><td>'+translation.mm164+'</td></tr>');
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log(data);
                jQuery('#show-emails .list-emails').html('<tr><td>'+translation.mm164+'</td></tr>');
            }
        });
    }
    function unactive_emails_results(page) {
        // display emails by list
        var list  = jQuery('.list-details').attr('data-id');
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/show-lists-meta/'+page+'/'+list+'/1',
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data.total) {
                    var tot;
                    emails.page = page;
                    emails_pagination('#unactive_emails',data.total);
                    for(var m = 0; m < data.emails.length; m++) {
                        var list_id = data.emails[m].list_id;
                        var email = data.emails[m].body;
                        var meta_id = data.emails[m].meta_id;
                        if(typeof tot === 'undefined') {
                            tot = '<tr><td>'+email+'</td><td style="text-align: right;"><button class="btn-view-fund btn btn-default btn-xs delete-email" type="button" data-list="'+list_id+'" data-meta="'+meta_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
                        } else {
                            tot += '<tr><td>'+email+'</td><td style="text-align: right;"><button class="btn-view-fund btn btn-default btn-xs delete-email" type="button" data-list="'+list_id+'" data-meta="'+meta_id+'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
                        }
                    }
                    jQuery('#unactive_emails .list-emails').html(tot);
                } else {
                    jQuery('#unactive_emails .list-emails').html('<tr><td>'+translation.mm164+'</td></tr>');
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log(data);
                jQuery('#unactive_emails .list-emails').html('<tr><td>'+translation.mm164+'</td></tr>');
            }
        });
    }
    function parse_styles(attrs, key, m, r) {
        // This function parses the styles
        if(typeof attrs.split(key) !== 'undefined') {
            var dt = attrs.split(key);
            if(dt[1]) {
                var uj = dt[1].split(';');
                if(uj[0]) {
                    if(typeof r !== 'undefined') {
                        if(m === 1) {
                            var res = uj[0].replace(r,'');
                            var num = res.trim();
                            num++;
                            key = key.replace(':','');
                            return [key,num+r];
                        } else if(m === 2) {
                            var res = uj[0].replace(r,'');
                            var num = res.trim();
                            num--;
                            key = key.replace(':','');
                            return [key,num+r];                            
                        } else if(m === 3) {
                            key = key.replace(':','');
                            return [key,uj[0].trim()];                            
                        }
                    } else {

                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function temison(text,attrs) {
        var st = attrs;
        var cl = '';
        if(attrs) {
            var res = parse_styles(attrs, 'color:', 3, '');
            if(res) {
                if(res[1].search('#') > -1) {
                    var si = res[1].split('#');
                    cl = '#'+si[1];
                } else {
                    var si = res[1].split('rgb');
                    cl = rgb2hex('rgb'+si[1]);               
                }
            }
        }
        // this function contains the lists editor
        return '<div class="panel panel-default"><div class="panel-heading"><table><tbody><tr><td class="ui-droppable"><input type="color" class="pull-right type-color change-tem-text-color" value="' + cl + '"></td><td class="ui-droppable"><button class="bold-tem-text"><i class="fa fa-bold"></i></button></td><td class="ui-droppable"><button class="italic-tem-text"><i class="fa fa-italic"></i></button></td><td class="ui-droppable"><button class="underline-tem-text"><i class="fa fa-underline"></i></button></td><td class="ui-droppable"><button class="enter-a-link-template-item"><i class="fa fa-link"></i></button></td><td class="ui-droppable"><button class="remove-a-link-template-item"><i class="fa fa-chain-broken"></i></button></td><td class="ui-droppable"><button class="increase-item-tem-text-size"><i class="fa fa-plus"></i></button></td><td class="ui-droppable"><button class="decrease-item-tem-text-size"><i class="fa fa-minus"></i></button></td><td class="ui-droppable"><button class="delete-item-tem-lists"><i class="fa fa-trash-o"></i></button></td></tr></tbody></table></div><div class="panel-body clean"><textarea style="' + st + '">' + text + '</textarea></div></div>';
    }
    function media_pagination(total, type) {
        var limit = 10;
        var page = medias.ipage;
        if(total > (page * limit)) {
            jQuery('.media-images-next').removeClass('disabled');
        } else {
            jQuery('.media-images-next').addClass('disabled');
        }
        if(page > 1) {
            jQuery('.media-images-back').removeClass('disabled');
        } else {
            jQuery('.media-images-back').addClass('disabled');
        }
    }
    var hexDigits = new Array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'); 
    //Function to convert rgb color to hex format
    function rgb2hex(rgb) {
     rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
     return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }
    function gets_stats_for(template_id,time) {
        var csr = jQuery('input[name="csrf_test_name"]').val();
        var campaign_id = jQuery('.campaign-page').attr('data-id');
        // create an object with form data
        var data = {'campaign_statistics': campaign_id, 'template_id': template_id, 'time': time, 'csrf_test_name': csr};
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/emails/query',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if(data) {
                    Morris.Line({
                        element: 'rations',
                        data: eval(data),
                        xkey: 'period',
                        xLabelFormat: function (date) {
                            return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                        },
                        xLabels: 'day',
                        ykeys: ['Sent', 'Opened', 'Unsubscribed'],
                        labels: ['Sent', 'Opened', 'Unsubscribed'],
                        pointSize: 5,
                        hideHover: 'auto',
                        lineColors: ['#2f9ecb', '#60d0b9', '#F05A75'],
                        lineWidth: 2,
                    });
                } else {
                    jQuery('#rations').html(translation.mu295);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('#rations').html(translation.mu295);
            },
        });
    }
    function hex(x) {
      return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
    }
    function get_media(page, type) {
		var url=jQuery('#base_url').val();
        jQuery.ajax({
            url: url + 'user/get-media/' + type + '/' + page,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if(data) {
                    jQuery('#image_upload .media-gallery-images').show();
                    var allmedia = '';
                    media_pagination(data.total, 'image');
                    for (var u = 0; u < data.medias.length; u++) {
                        var body = data.medias[u].body;
                        body = body.replace(url + 'assets/share/', '');
                        allmedia += '<li data-id="' + data.medias[u].media_id + '" data-image="' + data.medias[u].body + '"><span class="pull-left show-image-preview">' + body + '</span><div class="btn-group btn-group-info pull-right"><button class="btn btn-default add-gallery-image" type="button"><i class="fa fa-plus"></i></button><button class="btn btn-default delete-gallery-media" type="button"><i class="fa fa-trash-o"></i></button></div></li><li class="show-preview"></li>';
                    }
                    jQuery('#image_upload .media-gallery-images').html('<ul>' + allmedia + '</ul>'); 
                    jQuery('#image_upload .total-gallery-photos').html(data.total + ' photos');
                    if(data.total < 11) {
                        jQuery('#image_upload .media-gallery-pagination').hide();
                    } else {
                        jQuery('#image_upload .media-gallery-pagination').show();
                    }
                } else {
                    jQuery('#image_upload .media-gallery-pagination').hide();
                    jQuery('#image_upload .media-gallery-images').hide();
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('#image_upload .media-gallery-pagination').hide();
                jQuery('#image_upload .media-gallery-images').hide();
            },
        });
    }
    if(jQuery('#campaign_gallery').length > 0){
        campaigns_results(emails.page);
        lists_results(lists.page);
    } else if(jQuery('.datetime').length > 0){
        jQuery('.datetime').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            pickerPosition: 'top-left',
        });
        shistory(emails.page);
        show_template_lists();
        relod();
    } else if(jQuery('.list-details').length > 0){
        emails_results(lists.page);
        unactive_emails_results(emails.page);
    } else if(jQuery('.sent-info').length > 0){
        sehistory(emails.page);
    }
    get_media(medias.ipage, 'image');
});