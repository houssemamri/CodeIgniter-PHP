jQuery(document).ready(function () {
    'use strict';
    //var url = jQuery('.navbar-brand').attr('href');
    var url=jQuery('#base_url').val();
    var rss = {
        'networks': {},
        'page': 1,
        'limit': 10,
    };
    jQuery('.parse').click(function () {
        // Extracts content from an RSS Feed
        var rss_url = jQuery('.rss-url').val();
        var encode = btoa(rss_url);
        encode = encode.replace('/', '-');
        var cleanURL = encode.replace(/=/g, '');
        jQuery.ajax({
            url: url + 'user/new-rss/' + cleanURL,
            dataType: "json",
            type: "GET",
            success: function (data) {
                // Display RSS's content
                if (data) {
                    var content = '';
                    for (var e = 0; e < data.title.length; e++) {
                        var url = '';
                        if (data.url[e]) {
                            url = '<a href="' + data.url[e] + '" target="_blank">' + data.url[e] + '</a>';
                        }
                        content += '<li><div><h3>' + data.title[e] + '</h3><p>' + data.description[e] + '</p><p>' + url + '</p></div></li>';
                    }
                    jQuery('.feed-rss').html(content);
                    jQuery('.save-rss').css('display', 'inline-block');
                } else {
                    jQuery('.feed-rss').html('<p>' + translation.mm132 + '</p>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('.feed-rss').html('<p>' + translation.mm132 + '</p>');
            }
        });
    });
    jQuery('.save-rss').click(function () {
        // Saves RSS feed 
        var rss_url = jQuery('.rss-url').val();
        var encode = btoa(rss_url);
        encode = encode.replace('/', '-');
        var cleanURL = encode.replace(/=/g, '');
        jQuery.ajax({
            url: url + 'user/new-rss/' + cleanURL + '/1',
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if (data.msg) {
                    popup_fon('subi', data.msg, 1500, 2000);
                    setTimeout(function () {
                        document.location.href = url + 'user/rss-feeds/' + data.last_id;
                    }, 5000);
                } else {
                    popup_fon('sube', data, 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm3, 1500, 2000);
            }
        });
    });
    jQuery('.setopt').click(function () {
        var $this = jQuery(this).attr('id');
        if ($this == 'only-new-rss') {
            new_rss_posts(jQuery('.rss-page').attr('data-rss'));
        } else {
            // Enable or disable the publishing of RSS's posts
            enable_or_disable_option(jQuery(this).attr('id'), jQuery('.rss-page').attr('data-rss'));
            results(1);
        }
    });
    jQuery(document).on('click', '.social .select-net', function () {
        // Selects accounts and networks were will be published the RSS's posts
        if (jQuery(this).attr('data-type') == 'main') {
            jQuery(this).addClass('active');
            jQuery(this).text(translation.mm120);
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery(".social ul li.socials").eq(index).find("li:first-child").find(".select-net").click();
        } else {
            var index = jQuery('.social ul li.socials').index(jQuery(this).closest('.socials'));
            var account = jQuery(this).attr('data-account');
            var network = jQuery(this).closest('.socials').attr('data-network');
            if (rss.networks[network] && !jQuery(this).hasClass('active')) {
                var d = JSON.parse(rss.networks[network]);
                if (d.length >= jQuery('section').attr('data-cont')) {
                    alert(translation.mm121 + ' ' + jQuery('section').attr('data-cont') + ' ' + translation.mm122);
                    return;
                }
            }
            jQuery(this).addClass('active');
            jQuery(this).text(translation.mm120);
            jQuery('.social ul li.netsel').eq(index).find('.select-net').addClass('active');
            jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mm120);
            if (typeof rss.networks[network] != 'undefined') {
                var extract = JSON.parse(rss.networks[network]);
                if (!isNaN(extract)) {
                    var bun = '[\"' + extract + '\",\"' + account + '\"]';
                    rss.networks[network] = bun;
                } else {
                    if (extract.indexOf(account) < 0) {
                        extract[extract.length] = account;
                        rss.networks[network] = JSON.stringify(extract);
                    }
                }
            } else {
                rss.networks[network] = JSON.stringify([account]);
            }
        }
        save_networks(jQuery('.rss-page').attr('data-rss'), JSON.stringify(rss.networks));
    });
    jQuery(document).on('click', '.social .select-net.active', function ()
    {
        // Remove an account where the RSS 's posts won't be published
        if (jQuery(this).closest('li').hasClass('.netsel')) {
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('li.netsel'));
            var network = jQuery(this).closest('.netsel').attr('data-network');
        } else {
            var index = jQuery('.social ul li.socials').index(jQuery(this).closest('li.socials'));
            var network = jQuery(this).closest('.socials').attr('data-network');
        }
        if (index > -1) {
            var account = jQuery(this).attr('data-account');
            var network = jQuery(this).closest('.socials').attr('data-network');
            var extract = JSON.parse(rss.networks[network]);
            if (!isNaN(extract)) {
                delete rss.networks[network];
                jQuery('.social ul li.netsel').eq(index).find('.select-net').removeClass('active');
                jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mm123);
            } else {
                if (extract.length === 1) {
                    jQuery('.social ul li.netsel').eq(index).find('.select-net').removeClass('active');
                    jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mm123);
                    delete rss.networks[network];
                } else if (extract.length > 1) {
                    var sec = [];
                    var d = 0;
                    for (var i = 0; i < extract.length; i++) {
                        if ((account != extract[i]) && (sec.indexOf(extract[i]) < 0)) {
                            sec[d] = extract[i];
                            d++;
                        }
                    }
                    if (d === 0) {
                        delete rss.networks[network];
                        jQuery('.social ul li.netsel').eq(index).find('.select-net').removeClass('active');
                        jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mm123);
                    } else {
                        rss.networks[network] = JSON.stringify(sec);
                    }
                }
                save_networks(jQuery('.rss-page').attr('data-rss'), JSON.stringify(rss.networks));
            }
            jQuery(this).removeClass('active');
            jQuery(this).text(translation.mm123);
        }
        save_networks(jQuery('.rss-page').attr('data-rss'), JSON.stringify(rss.networks));
    });
    jQuery(document).on('keyup', '.social .search-accounts', function () {
        // Searches connected accounts
        var key = jQuery(this).val();
        var network = jQuery(this).closest('.socials').attr('data-network');
        jQuery(this).closest('li').find('.show-selected').show();
        var index = jQuery('.social ul li.socials').index(jQuery(this).closest('li.socials'));
        social_results(network, key, index);
    });
    jQuery(document).on('click', '.socials .show-selected', function () {
        var index = jQuery('.social ul li.socials').index(jQuery(this).closest('li.socials'));
        var soci = jQuery(this).closest('li.socials');
        var network = jQuery(this).closest('li.socials').attr('data-network');
        jQuery(this).closest('li.socials').find('.search-accounts').val('');
        jQuery(this).hide();
        if (rss.networks[network]) {
            var selected = JSON.parse(rss.networks[network]);
            var encode = btoa(selected);
            encode = encode.replace('/', '-');
            var cleanURL = encode.replace(/=/g, '');
            jQuery.ajax({
                url: url + 'user/get-selected/' + cleanURL,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length) {
                        var coun = '';
                        for (var l = 0; l < data.length; l++) {
                            coun += data[l];
                        }
                        soci.find('ul').html(coun);
                    } else {
                        soci.find('ul').html('<li>' + translation.mm124 + '</li>');
                    }
                },
                error: function (data, jqXHR, textStatus) {
                    console.log('Request failed: ' + textStatus);
                }
            });
        } else {
            soci.find('ul').html('<li>' + translation.mm124 + '</li>');
        }
    });
    jQuery(document).on('click', '.social .show-accounts', function () {
        // Show Accounts
        if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active');
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.social ul li.socials').eq(index).fadeOut('slow');
        } else {
            jQuery(this).addClass('active');
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.social ul li.socials').eq(index).fadeIn('slow');
        }
    });
    jQuery('#refferal').keyup(function () {
        // Save Refferal Code
        var val = jQuery(this).val();
        if(val === '') {
            val = 0;
        }
        val = btoa(encodeURIComponent(val));
        val = val.replace('/', '-');
        val = val.replace(/=/g, '');
        var rss = jQuery('.rss-page').attr('data-rss');
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/rss-settings/refferal/' + rss + '/' + val,
            type: 'GET',
            dataType: 'json',
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('#pboften').keyup(function () {
        // Save period of time to publish a post
        var val = jQuery(this).val();
        // First verify if the val is integer
        if(isNaN(val) && val !== '') {
            popup_fon('sube', translation.mm3, 1500, 2000);
            return;
        }
        if(val === '') {
            val = 0;
        }
        var rss = jQuery('.rss-page').attr('data-rss');
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/rss-settings/period/' + rss + '/' + val,
            type: 'GET',
            dataType: 'json',
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('#pinclude').keyup(function () {
        // Save words which must contain the published posts 
        var val = jQuery(this).val();
        if(val === '') {
            val = 0;
        }
        val = btoa(encodeURIComponent(val));
        val = val.replace('/', '-');
        val = val.replace(/=/g, '');
        var rss = jQuery('.rss-page').attr('data-rss');
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/rss-settings/include/' + rss + '/' + val,
            type: 'GET',
            dataType: 'json',
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('#pexclude').keyup(function () {
        // Save words which must not contain the published posts 
        var val = jQuery(this).val();
        if(val === '') {
            val = 0;
        }
        val = btoa(encodeURIComponent(val));
        val = val.replace('/', '-');
        val = val.replace(/=/g, '');
        var rss = jQuery('.rss-page').attr('data-rss');
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/rss-settings/exclude/' + rss + '/' + val,
            type: 'GET',
            dataType: 'json',
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed:' + textStatus);
            }
        });
    });
    jQuery('.delete-rss').click(function () {
        // Try to delete a RSS Feed
        jQuery('.confirm').fadeIn('slow');
    });
    jQuery(document).on('click', '.confirm .no', function (e) {
        e.preventDefault();
        jQuery('.confirm').fadeOut('slow');
    });
    jQuery(document).on('click', '.delete-feeds', function (e) {
        // Deletes rss feeds
        e.preventDefault();
        jQuery.ajax({
            url: url + 'user/delete-feeds/' + jQuery('.rss-page').attr('data-rss'),
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if (data.data) {
                    var dat = data.data;
                    if (dat.search('success') > 0) {
                        popup_fon('subi', jQuery(dat).text(), 1500, 2000);
                    } else {
                        popup_fon('sube', jQuery(dat).text(), 1500, 2000);
                    }
                }
                if (data.success == 1) {
                    // redirect to home after 5 seconds
                    setTimeout(redirect_to_feeds, 5000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm3, 1500, 2000);
            },
        });
    });
    jQuery(document).on('click', '.pagination li a', function (e) {
        // Displays pagination for RSS Posts
        e.preventDefault();
        rss.page = jQuery(this).attr('data-page');
        if (jQuery('.rss-page').attr('data-rss')) {
            results(rss.page);
        } else {
            results2(rss.page);
        }
    });
    jQuery(document).on('click', '.histon', function (e) {
        // Displays publish statistics
        e.preventDefault();
        var $this = jQuery(this);
        if($this.hasClass('active')) {
            $this.removeClass('active');
            $this.closest('li').find('.loadsend').fadeOut('slow');
            return;
        }
        var val = $this.attr('data-id');
        $this.closest('li').find('.loadprev').fadeIn('slow');
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/get-rss-stats/' + val,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if(data) {
                    $this.closest('li').find('.loadsend').fadeIn('slow');
                    var si = ' ';
                    for(var b = 0; b < data.length; b++) {
                        var status = (data[b][2] === 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>';
                        si += '<li><div class="col-lg-11 clean">' + data[b][0] + ' ' + data[b][1] + '</div><div class="col-lg-1 clean text-right">' + status + '</div></li>';
                    }
                    $this.closest('li').find('.loadsend').html(si);
                    $this.addClass('active');
                }
            }, error: function (data, jqXHR, textStatus) {
                console.log(data);
            }, complete: function () {
                $this.closest('li').find('.loadprev').fadeOut('slow');
            }
        });
    });    
    jQuery('.feed-rss .date-show').click(function () {
        jQuery(this).hide();
        jQuery(this).closest('li').find('.datetime').fadeIn('slow');
        jQuery(this).closest('li').find('.rss-schedule').fadeIn('slow');
    });
    jQuery('.feed-rss .datetime').datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });
    jQuery('.feed-rss .rss-schedule').click(function () {
        // Schedules a post to be published from a Feed RSS
        var $this = jQuery(this);
        var post_url = $this.closest('li').find('a').attr('href');
        post_url = btoa(encodeURIComponent(post_url));
        post_url = post_url.replace('/', '-');
        post_url = post_url.replace(/=/g, '');
        var currentdate = new Date();
        var datetime = Date.parse(currentdate) / 1000;
        var date = jQuery(this).closest('li').find('.datetime').val();
        date = Date.parse(date) / 1000;
        var rss_id = jQuery('.rss-page').attr('data-rss');
        $this.closest('li').find('.datetime').fadeOut('slow');
        $this.closest('li').find('.rss-schedule').fadeOut('slow');
        jQuery.ajax({
            url: url + 'user/set-schedule-rss/' + post_url + '/' + date + '/' + datetime + '/' + rss_id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                if (data == 1) {
                    $this.closest('li').find('.alert-success').fadeIn('slow');
                    results(1);
                } else {
                    $this.closest("li").find('.alert-danger').fadeIn('slow');
                }
            },
            error: function (data, jqXHR, textStatus) {
                $this.closest('li').find('.alert-danger').fadeIn('slow');
            }
        });
    });
    jQuery(document).on('click', '.delete-scheduled-post', function (e) {
        e.preventDefault();
        var post_url = jQuery(this).attr('href');
        post_url = btoa(encodeURIComponent(post_url));
        post_url = post_url.replace('/', '-');
        post_url = post_url.replace(/=/g, '');
        jQuery.ajax({
            url: url + 'user/delete-post-rss/' + post_url,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                results(1);
            }
        });
    });
    function social_results(network, key, index) {
        if (!key)
            return;
        key = btoa(encodeURIComponent(key));
        key = key.replace('/', '-');
        key = key.replace(/=/g, '');
        jQuery.ajax({
            url: url + 'user/search-accounts/' + network + '/' + key,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.accounts[0].user_name) {
                    var allaccounts = '';
                    for (var u = 0; u < data.total; u++) {
                        if (data.accounts[u]) {
                            var date = data.accounts[u].expires;
                            var expires = '<strong>never</strong>'
                            if (date.trim()) {
                                date = date.substr(0, 19);
                                expires = '<strong>' + date + '</strong>';
                            }
                            var network = jQuery('.social li.socials').eq(index).attr('data-network');
                            if (typeof rss.networks[network] != 'undefined') {

                                var extract = JSON.parse(rss.networks[network]);

                            } else {
                                
                                var extract = [];

                            }
                            var sec = [];
                            if (rss.networks[network]) {
                                var d = 0;
                                for (var i = 0; i < extract.length; i++) {
                                    sec[d] = extract[i];
                                    d++;
                                }
                            }
                            if (sec.indexOf(data.accounts[u].network_id) > -1) {
                                var button = '<button type="button" class="btn btn-default select-net active" data-account="' + data.accounts[u].network_id + '">' + translation.mm120 + '</button>';
                            } else if (rss.networks[network] == data.accounts[u].network_id) {
                                var button = '<button type="button" class="btn btn-default select-net active" data-account="' + data.accounts[u].network_id + '">' + translation.mm120 + '</button>';
                            } else {
                                var button = '<button type="button" class="btn btn-default select-net" data-account="' + data.accounts[u].network_id + '">' + translation.mm123 + '</button>';
                            }
                            allaccounts += '<li>' + data.accounts[u].user_name + ' <span class="expires">' + translation.mm126 + ' <strong>' + expires + '</strong></span><div class="btn-group pull-right">' + button + '</div></li>';
                        }
                    }
                    jQuery('.social ul li.socials').eq(index).find('ul').html(allaccounts);
                } else {
                    jQuery('.social ul li.socials').eq(index).find('ul').html('<li>' + translation.mm127 + '</li>');
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('.social ul li.socials').eq(index).find('ul').html('<li>' + translation.mm127 + '</li>');
            }
        });
    }
    function enable_or_disable_option(name, rss_id) {
        // Enables or disables options from the RSS page
        jQuery.ajax({
            url: url + 'user/rss-option/' + rss_id + '/' + name,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data !== 1) {
                    popup_fon('sube', jQuery(data).text(), 1500, 2000);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed:' + textStatus);
            }
        });
    }
    function save_networks(rss_id, networks) {
        // Save networks where will be published the RSS's posts
        networks = btoa(encodeURIComponent(networks));
        networks = networks.replace('/', '-');
        networks = networks.replace(/=/g, '');
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/rss-networks/' + rss_id + '/' + networks,
            type: 'GET',
            dataType: 'json',
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed:' + textStatus);
            }
        });
    }
    if (jQuery('input[name="networks"]').length > 0) {
        // Check if the user has selected social networks for this RSS Feeds and add them to the rss object 
        if (jQuery('input[name="networks"]').val()) {
            rss.networks = JSON.parse(jQuery('input[name="networks"]').val());
        }
    }
    function redirect_to_feeds() {
        // After RSS Feed deletion, the user will be redirected to RSS Feeds page
        document.location.href = url + 'user/rss-feeds';
    }
    function show_pagination(total) {
        // The code bellow displays pagination
        jQuery('.pagination').empty();
        if (parseInt(rss.page) > 1) {
            var bac = parseInt(rss.page) - 1;
            var pages = '<li><a href="#" data-page="' + bac + '">' + translation.mm128 + '</a></li>';
        } else {
            var pages = '<li class="pagehide"><a href="#">' + translation.mm128 + '</a></li>';
        }
        var tot = parseInt(total) / parseInt(rss.limit);
        tot = Math.ceil(tot) + 1;
        var from = (parseInt(rss.page) > 2) ? parseInt(rss.page) - 2 : 1;
        for (var p = from; p < parseInt(tot); p++) {
            if (p === parseInt(rss.page)) {
                pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
            } else if ((p < parseInt(rss.page) + 3) && (p > parseInt(rss.page) - 3)) {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            } else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(rss.page) == 1) || (parseInt(rss.page) == 2))) {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            } else {
                break;
            }
        }
        if (p === 1) {
            pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
        }
        var next = parseInt(rss.page);
        next++;
        if (next < Math.round(tot)) {
            jQuery('.pagination').html(pages + '<li><a href="#" data-page="' + next + '">' + translation.mm129 + '</a></li>');
        } else {
            jQuery('.pagination').html(pages + '<li class="pagehide"><a href="#">' + translation.mm129 + '</a></li>');
        }
    }
    function results(page) {
        // Displays all published RSS's posts
        jQuery.ajax({
            url: url + 'user/show-feed-posts/' + page + '/' + jQuery('.rss-page').attr('data-rss'),
            dataType: 'json',
            type: 'GET',
            beforeSend: function () {
                if (jQuery(document).width() > 700)
                    jQuery('.pageload').show();
            },
            success: function (data) {
                if (data) {
                    var current = data.date;
                    show_pagination(data.total);
                    var allposts = '';
                    for (var u = 0; u < data.total; u++) {
                        if (data.posts[u]) {
                            var tin = '';
                            if(data.posts[u].networks) {
                                tin = '<a href="#" class="histon" data-id="' + data.posts[u].post_id + '"><i class="fa fa-bar-chart"></i> ' + translation.mu3 + '</a> <img src="' + url + 'assets/img/pageload.gif" class="loadprev">';
                                tin += '<ul class="loadsend"></ul>';
                            }
                            var date = data.posts[u].published;
                            if (!data.posts[u].scheduled) {
                                var gettime = '<span><i class="fa fa-clock-o"></i> ' + calculate_time(date, current) + '</span>' + tin;
                            } else {
                                var calc = calculate_time(data.posts[u].scheduled, current);
                                calc = calc.replace(' ago', '');
                                var gettime = '<span><i class="fa fa-calendar-check-o" aria-hidden="true"></i> ' + calc + ' <a href="' + data.posts[u].url + '" class="delete-scheduled-post"><i class="fa fa-times" aria-hidden="true"></i> ' + translation.mm133 + '</a></span> ';
                            }
                            var titus = data.posts[u].title;
                            titus = titus.replace(/\\/g, '');
                            allposts += '<li><h3>' + titus + '</h3>' + gettime + '</li>';
                        }
                    }
                    jQuery('.last-published').html(allposts);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('.last-published').html('<p>' + translation.mm134 + '</p>');
            },
            complete: function () {
                jQuery('.pageload').fadeOut('slow');
            }
        });
    }
    function results2(page) {
        // Display all user's RSS Feeds
        jQuery.ajax({
            url: url + 'user/show-feeds/' + page,
            dataType: 'json',
            type: 'GET',
            beforeSend: function () {
                if (jQuery(document).width() > 700)
                    jQuery('.pageload').show();
            },
            success: function (data) {
                if (data) {
                    show_pagination(data.total);
                    var allfeeds = '';
                    for (var u = 0; u < data.feeds.length; u++) {
                        var rss_url = data.feeds[u].rss_url;
                        if (rss_url.search('tool=') > 0) {
                            rss_url = '#';
                        }
                        allfeeds += '<li><div class="col-md-10 col-sm-8 col-xs-6 clean"><h3><a href="' + rss_url + '" target="_blank">' + data.feeds[u].rss_name + '</a></h3><span><i class="fa fa-share-square-o" aria-hidden="true"></i> ' + data.feeds[u].num + ' ' + translation.mm137 + '</span></div><div class="col-md-2 col-sm-4 col-xs-6 clean text-right"><a href="' + url + 'user/rss-feeds/' + data.feeds[u].rss_id + '" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i> ' + translation.mm136 + '</a></div></li>';
                    }
                    jQuery('.feeds-rss').html(allfeeds);
                }
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                jQuery('.feeds-rss').html('<p>' + translation.mm135 + '</p>');
            },
            complete: function () {
                jQuery('.pageload').fadeOut('slow');
            },
        });
    }
    function new_rss_posts(rss) {
        jQuery.ajax({
            url: url + 'user/save-current-posts/' + rss,
            dataType: 'json',
            type: 'GET',
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
            }
        });
    }
    if (jQuery('.rss-page').attr('data-rss')) {
        results(1);
    } else if (jQuery('.rss').length > 0) {
        results2(1);
    }
});