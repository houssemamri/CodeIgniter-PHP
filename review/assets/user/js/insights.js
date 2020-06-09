jQuery(document).ready(function () {
    'use strict';
    
    /*
     * Create the Insights object
     */
    var Insights = new Object();
    
    
    // Get home page url
    //Insights.url = jQuery('.navbar-brand').attr('href');
   Insights.url=jQuery('#base_url').val();
    // Set filter type
    Insights.by = 'page_views_total';
    
    // Set graph period
    Insights.graph_period = 'days_28';
    
    // Get formatted date
    Date.prototype.yyyymmdd = function () {
        var mm = this.getMonth() + 1;
        var dd = this.getDate();

        return [this.getFullYear() + '-',
            (mm > 9 ? '' : '0') + mm + '-',
            (dd > 9 ? '' : '0') + dd
        ].join('');
    };
    
    // Set Facebook Graph Url
    Insights.facebook_graph_url = 'https://graph.facebook.com/v2.12/';
    
    /*
     * Detect graph filter click
     */    
    jQuery( '.filter-graph-type > li > a' ).click(function(e) {
        e.preventDefault();
        
        // Empty graph
        jQuery('#general-stats-insights').empty();
        
        Insights.by = jQuery(this).attr('data-type');
        
        filter_graph();
        
    });
    
    /*
     * Display selected accounts
     */
    jQuery(document).on('click', '.social-list .show-accounts', function () {
        
        if ( jQuery(this).hasClass('active') ) {
            
            jQuery(this).removeClass('active');
            var index = jQuery('.social-list ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.social-list ul li.socials').eq(index).fadeOut('slow');
            
        } else {
            
            jQuery(this).addClass('active');
            var index = jQuery('.social-list ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.social-list ul li.socials').eq(index).fadeIn('slow');
            
        }
        
    });
    
    /*
     * Search for accounts
     */
    jQuery(document).on('keyup', '.social-list .search-accounts', function () {
        
        // Set the key
        var key = jQuery(this).val();
        
        // Verify if key is empty
        if ( key === '' ) {
            key = ' ';
        }
        
        // Set network
        var network = jQuery(this).closest('.socials').attr('data-network');
        
        // Show selected account
        jQuery(this).closest('li').find('.show-selected').show();
        
        // Set the index
        var index = jQuery('.social-list ul li.socials').index(jQuery(this).closest('li.socials'));
        
        // Display social networks
        social_results(network, key, index);
        
    });
    
    /*
     * Detect graph period click
     */    
    jQuery( '.btn-group > .graph-select-range' ).click(function(e) {
        e.preventDefault();
        
        // Empty graph
        jQuery( '#general-stats-insights' ).empty();
        
        // Remove active class
        jQuery( '.btn-group > .graph-select-range' ).removeClass( 'active' );
        
        // Set graph period
        Insights.graph_period = jQuery(this).attr( 'data-value' );
        
        // Add active class
        jQuery(this).addClass( 'active' );
        
        filter_graph();
        
    });
    
    /*
     * Display default accounts
     */
    jQuery(document).on('click', '.social-list .show-selected', function () {
        
        
        // Reset search form
        jQuery(this).closest('li').find('.search-accounts').val('');
        jQuery(this).closest('li').find('.show-selected').hide();
        
        // Set network
        var network = jQuery(this).closest('.socials').attr('data-network');
        
        // Set the index
        var index = jQuery('.social-list ul li.socials').index(jQuery(this).closest('li.socials'));
        
        // Display default network accounts
        default_social_accounts(network, index);
        
    });
    
    jQuery( document ).on( 'click', '.show-insights', function () {
        
        // Remove active button
        jQuery( '.main-insights .show-insights' ).removeClass( 'active' );
        
        // Add active button
        jQuery( this ).addClass( 'active' );
        
        // Get type
        var type = jQuery( this ).closest( '.tab-pane' ).attr( 'id' );
        
        // Get the ID
        var id = jQuery( this ).attr( 'data-id' );
        
        // Hide other graphs
        jQuery( '#posts .donut-insights' ).hide();
        
        // Display graph
        jQuery( this ).closest( '.col-lg-12' ).find( '.donut-insights' ).css( 'display', 'flow-root' );
        
        // Define objects variable
        var objects = [];

        // Get date
        var date = new Date();

        // Create object based on network's statistics
        if ( Insights.social_netork === 'facebook_pages' ) {

            // Verify the type
            if ( type === 'posts' ) {

                // Generate graph statistics
                Insights.generate_graph_vars = {
                    'id': id,
                    'total': 4,
                    'current': 0,
                    'colors': [{'post_impressions':'#0BA462', 'post_impressions_organic':'#DD7D5A', 'post_impressions_paid':'#2196f3', 'post_impressions_fan':'#1dc3d3'}],
                    'object': [{'post_impressions':{'label': translation.mu349,value: 0},'post_impressions_organic':{'label': translation.mu351,value: 0},'post_impressions_fan':{'label': translation.mu352,value: 0},'post_impressions_paid':{'label': translation.mu350,value: 0}}],
                    'new_object': [],
                    'new_colors': []
                };

                // Get total impressions
                http_request(Insights.facebook_graph_url + id + '/insights/post_impressions/lifetime?access_token=' + Insights.access_secret, 'group');

                // Get paid impresssions
                http_request(Insights.facebook_graph_url + id + '/insights/post_impressions_paid/lifetime?access_token=' + Insights.access_secret, 'group');

                // Get organic impressions
                http_request(Insights.facebook_graph_url + id + '/insights/post_impressions_organic/lifetime?access_token=' + Insights.access_secret, 'group');

                // Get fan impressions
                http_request(Insights.facebook_graph_url + id + '/insights/post_impressions_fan/lifetime?access_token=' + Insights.access_secret, 'group');

            } else if ( type === 'videos' ) {
                
                // Generate graph statistics
                Insights.generate_graph_vars = {
                    'id': id,
                    'total': 4,
                    'current': 0,
                    'colors': [{'total_video_views':'#386CEA', 'total_video_views_paid':'#FDD435', 'total_video_views_organic':'#52C1BB', 'total_video_impressions_fan':'#B87377'}],
                    'object': [{'total_video_views':{'label': translation.mu353,value: 0},'total_video_views_organic':{'label': translation.mu355,value: 0},'total_video_views_paid':{'label': translation.mu354,value: 0},'total_video_impressions_fan':{'label': translation.mu352,value: 0}}],
                    'new_object': [],
                    'new_colors': []
                };

                // Get total views
                http_request(Insights.facebook_graph_url + id + '/video_insights/total_video_views/lifetime?access_token=' + Insights.access_secret, 'group');

                // Get paid views
                http_request(Insights.facebook_graph_url + id + '/video_insights/total_video_views_paid/lifetime?access_token=' + Insights.access_secret, 'group');

                // Get organic views
                http_request(Insights.facebook_graph_url + id + '/video_insights/total_video_views_organic/lifetime?access_token=' + Insights.access_secret, 'group');

                // Get fan video impressions
                http_request(Insights.facebook_graph_url + id + '/video_insights/total_video_impressions_fan/lifetime?access_token=' + Insights.access_secret, 'group');
                
            }

        }
        
    });
    
    jQuery(document).on('click', '.display-insights', function () {
        
        // Remove active button
        jQuery( '.social-list > ul > li.socials ul > li .btn-default' ).removeClass( 'active' );
        
        // Get social network
        Insights.social_netork = jQuery( this ).closest( '.socials' ).attr( 'data-network' );
        
        // Get account id
        var account_id = jQuery( this ).attr( 'data-account' );
        
        // Add active class
        jQuery( this ).addClass( 'active' );
        
        // Verify if user has the account and get data
        http_request(Insights.url + 'user/insights/' + account_id, 'get_account_data');
        
    });
    
    /*
     * Display page's posts
     */
    function page_posts() {
        
        // Get all posts
        http_request( Insights.facebook_graph_url + Insights.net_id + '/feed?access_token=' + Insights.access_secret, 'posts' );

    }
    
    /*
     * Display page's videos
     */
    function page_videos() {
        
        // Get all videos
        http_request( Insights.facebook_graph_url + Insights.net_id + '/videos?access_token=' + Insights.access_secret, 'videos' );

    }
    
    /*
     * Display general insights data
     */
    function show_insights( data ) {

        Morris.Line({
            element: 'general-stats-insights',
            data: data,
            xkey: 'period',
            xLabelFormat: function (date) {
                return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
            },
            xLabels: 'day',
            ykeys: ['Views'],
            labels: ['Views'],
            pointSize: 5,
            hideHover: 'auto',
            lineColors: ['#2f9ecb'],
            lineWidth: 2,
        });

    }
    
    /*
     * Display single insights
     */
    function show_single_insights(data, id, colors ) {
        
        var e = 0;
        
        for ( var d = 0; d < data.length; d++ ) {
            
            e = e + data[d].value;
            
        }
        
        if ( !e ) {

            // Display statistics
            jQuery( '#insights-' + id ).text( translation.mu348 );
            return;

        }

        Morris.Donut({
            element: 'insights-' + id,
            data: data,
            colors: colors
        });

    }
    
    /*
     * Make HTTP request
     */
    function http_request( url, type ) {
        
        // Send get request
        jQuery.get( url, function (response) {
            
            // Verify if type is main_graph
            if ( type === 'main_graph' ) {
                
                jQuery( '.main-insights' ).show();
                jQuery( '.mess-stat' ).hide();
                
            }
            
            process_responses( response, type );
            
        }).fail( function( e ) {
            
            // Verify if type is main_graph
            if ( type === 'main_graph' ) {
                
                jQuery( '.main-insights' ).hide();
                jQuery( '.mess-stat' ).show();

            } else if ( type === 'posts' ) {
                
                // Display the Posts tab
                jQuery( '.nav-tabs > li' ).eq( 1 ).hide();
                
            } else if ( type === 'videos' ) {
                
                // Display the Videos tab
                jQuery( '.nav-tabs > li' ).eq( 2 ).hide();
                
            }
        
        });

    }
    
    /*
     * Process response
     */    
    function process_responses( response, type ) {
        
        if ( type === 'main_graph' ) {
        
            if ( response.data[0] ) {

                var total = response.data[0].values;

                var objects = [];

                for (var d = 0; d < total.length; d++) {

                    var period = response.data[0].values[d].end_time.toString();

                    objects[d] = {'period': period.substring(0, 10), 'Views': response.data[0].values[d].value};

                }

                show_insights(objects);

            } else {

                // Define objects variable
                var objects = [];

                // Get date
                var date = new Date();

                // Set empty value
                objects[0] = {'period': date.yyyymmdd(), 'Views': '0'};

                // Display statistics
                show_insights(objects);

            }
            
        } else if ( type === 'group' ) {
            
            // Verify if the response is positive
            if ( !response.data.length ) {
                
                // Increase the current number
                Insights.generate_graph_vars.current = Insights.generate_graph_vars.current + 1;
                
                Insights.generate_graph_vars.value = Insights.generate_graph_vars.value + 0;

                // Verify if were got all data to show
                if (Insights.generate_graph_vars.current === Insights.generate_graph_vars.total) {

                    console.log(Insights.generate_graph_vars.value);

                    // Display statistics
                    jQuery( '#insights-' + Insights.generate_graph_vars.id ).text( translation.mu348 );

                }  
                
                return;
                
            }
            
            // Add elements in object
            Insights.generate_graph_vars.object[0][response.data[0].name].value = response.data[0].values[0].value;
            
            // Add element to the new_object
            Insights.generate_graph_vars.new_object[Insights.generate_graph_vars.current] = Insights.generate_graph_vars.object[0][response.data[0].name];
            
            // Add element to the new_colors
            Insights.generate_graph_vars.new_colors[Insights.generate_graph_vars.current] = Insights.generate_graph_vars.colors[0][response.data[0].name];            
            
            // Increase the current number
            Insights.generate_graph_vars.current = Insights.generate_graph_vars.current + 1;
            
            // Verify if were got all data to show
            if ( Insights.generate_graph_vars.current === Insights.generate_graph_vars.total ) {
                
                // Display statistics
                show_single_insights( Insights.generate_graph_vars.new_object, Insights.generate_graph_vars.id, Insights.generate_graph_vars.new_colors);  
                
            }

        } else if ( type === 'posts' ) {
            
            // Verify if the page has posts
            if ( response.data.length ) {
                
                // Display the Posts tab
                jQuery( '.nav-tabs > li' ).eq( 1 ).show();
                
                // Get all posts
                var total = response.data;

                // Define posts variable
                var posts = '';

                // Add all posts to the variable posts
                for ( var d = 0; d < total.length; d++ ) {
                    
                    if ( !total[d].message ) {
                        
                        continue;
                        
                    }
                    
                    posts += '<div class="col-lg-12 stat-head"><div class="col-lg-10 clean">' + total[d].message + '</div><div class="col-lg-2 text-right clean"><button type="button" class="btn btn-default show-insights" data-id="' +total[d].id + '"><i class="fa fa-bars" aria-hidden="true"></i></button></div><div class="donut-insights" id="insights-' +total[d].id + '"></div></div>';

                }
                
                // Display posts
                jQuery( '.posts-section' ).html( posts );
                
            } else {
                
                // Display no found posts message
                jQuery( '.posts-section' ).html( '<p>' + translation.mm116 + '</p>' );                
                
            }
            
        } else if ( type === 'videos' ) {

            // Verify if the page has videos
            if ( response.data.length ) {
                
                // Display the Videos tab
                jQuery( '.nav-tabs > li' ).eq( 2 ).show();
                
                // Get all videos
                var total = response.data;

                // Define videos variable
                var videos = '';

                // Add all videos to the variable videos
                for ( var d = 0; d < total.length; d++ ) {
                    
                    if ( !total[d].description ) {
                        
                        continue;
                        
                    }
                    
                    videos += '<div class="col-lg-12 stat-head"><div class="col-lg-10 clean">' + total[d].description + '</div><div class="col-lg-2 text-right clean"><button type="button" class="btn btn-default show-insights" data-id="' +total[d].id + '"><i class="fa fa-bars" aria-hidden="true"></i></button></div><div class="donut-insights" id="insights-' +total[d].id + '"></div></div>';

                }
                
                // Display videos
                jQuery( '.videos-section' ).html( videos );
                
            } else {
                
                // Display no found videos message
                jQuery( '.videos-section' ).html( '<p>' + translation.mu356 + '</p>' );                
                
            }

        } else if ( type === 'get_account_data' ) {
            
            // Display Insights Detaila section
            jQuery('.insights-details').show();            
            
            if ( response ) {
            
                // Parse JSON
                var data = JSON.parse(response);
                
                // Get token
                Insights.access_token = data.token;
                
                // Get secret
                Insights.access_secret = data.secret;
                
                // Get id
                Insights.net_id = data.net_id;
                
                // Hide other tabs
                jQuery( '.nav-tabs > li' ).eq(0).addClass( 'active' );
                jQuery( '.tab-content > .tab-pane' ).eq(0).addClass( 'active' );
                jQuery( '.nav-tabs > li' ).eq(1).hide();
                jQuery( '.nav-tabs > li' ).eq(1).removeClass( 'active' );
                jQuery( '.tab-content > .tab-pane' ).eq(1).removeClass( 'active' );
                jQuery( '.nav-tabs > li' ).eq(2).hide();
                jQuery( '.nav-tabs > li' ).eq(2).removeClass( 'active' );
                jQuery( '.tab-content > .tab-pane' ).eq(2).removeClass( 'active' );

                // Display Graph Stats
                filter_graph();

                // Display Posts
                page_posts();

                // Display Videos
                page_videos();

            }
            
        }
    
    }
    
    /*
     * Get social networks
     */
    function social_results(network, key, index) {
        
        // Set key
        key = btoa(encodeURIComponent(key));
        
        // Remove non necessary characters 
        key = key.replace('/', '-');
        key = key.replace(/=/g, '');
        
        jQuery.ajax({
            url: Insights.url + 'user/search-accounts/' + network + '/' + key,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data.accounts[0].user_name ) {
                    
                    var allaccounts = '';
                    
                    for ( var u = 0; u < data.total; u++ ) {
                        
                        if ( data.accounts[u] ) {
                            
                            var date = data.accounts[u].expires;
                            
                            var expires = '<strong>' + translation.mm125 + '</strong>'
                            
                            if ( date.trim() ) {
                                
                                date = date.substr(0, 19);
                                expires = '<strong>' + date + '</strong>';
                                
                            }
                            
                            // Set network
                            var network = jQuery( '.social-list li.socials' ).eq(index).attr( 'data-network' );
                            
                            var button = '<button type="button" class="btn btn-default select-net display-insights" data-account="' + data.accounts[u].network_id + '">' + translation.mu347 + '</button>';
                            
                            allaccounts += '<li>' + data.accounts[u].user_name + ' <span class="expires">' + translation.mm126 + ' <strong>' + expires + '</strong></span><div class="btn-group pull-right">' + button + '</div></li>';
                            
                        }
                        
                    }
                    
                    jQuery('.social-list ul li.socials').eq(index).find('ul').html(allaccounts);
                    
                } else {
                    
                    jQuery('.social-list ul li.socials').eq(index).find('ul').html('<li>' + translation.mm127 + '</li>');
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                jQuery('.social-list ul li.socials').eq(index).find('ul').html('<li>' + translation.mm127 + '</li>');
                
            }
            
        });
        
    }
    
    /*
     * Display default social accounts
     */
    function default_social_accounts(network, index) {
        
        jQuery.ajax({
            url: Insights.url + 'user/show-accounts/' + network + '/1',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data.accounts[0].user_name ) {
                    
                    var allaccounts = '';
                    
                    for ( var u = 0; u < data.total; u++ ) {
                        
                        if ( data.accounts[u] ) {
                            
                            var date = data.accounts[u].expires;
                            
                            var expires = '<strong>' + translation.mm125 + '</strong>'
                            
                            if ( date.trim() ) {
                                
                                date = date.substr(0, 19);
                                expires = '<strong>' + date + '</strong>';
                                
                            }
                            
                            // Set network
                            var network = jQuery( '.social-list li.socials' ).eq(index).attr( 'data-network' );
                            
                            var button = '<button type="button" class="btn btn-default select-net display-insights" data-account="' + data.accounts[u].network_id + '">' + translation.mu347 + '</button>';
                            
                            allaccounts += '<li>' + data.accounts[u].user_name + ' <span class="expires">' + translation.mm126 + ' <strong>' + expires + '</strong></span><div class="btn-group pull-right">' + button + '</div></li>';
                            
                        }
                        
                    }
                    
                    jQuery('.social-list ul li.socials').eq(index).find('ul').html(allaccounts);
                    
                } else {
                    
                    jQuery('.social-list ul li.socials').eq(index).find('ul').html('<li>' + translation.mm127 + '</li>');
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                jQuery('.social-list ul li.socials').eq(index).find('ul').html('<li>' + translation.mm127 + '</li>');
                
            }
            
        });
        
    }    
    
    /*
     * Display graph statistics
     */
    function filter_graph() {

        // Verify which social network is
        if ( Insights.social_netork === 'facebook_pages' ) {
            
            http_request(Insights.facebook_graph_url + Insights.net_id + '/insights/' + Insights.by + '/' + Insights.graph_period + '?access_token=' + Insights.access_secret, 'main_graph');
            
        }

    }
    
});