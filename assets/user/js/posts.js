/*
 * Posts javascript file
*/

jQuery(document).ready(function () {
    'use strict';
    
    // Get home page url
    //var url = jQuery('.navbar-brand').attr('href');
    var url=jQuery('#base_url').val();
    
    // Create the posts object
    var posts = {
        'page': 1,
        'ipage': 1,
        'vpage': 1,
        'publish': 1,
        'limit': 10,
        'post_id': 0,
        'rsearch': '',
        'preview': {'domain': '', 'title': '', 'description': '', 'image': ''},
        'urlError': translation.mm108,
        'urlChecking': translation.mm109,
        'categories': {},
        'networks': {},
        'account': {},
    };
    
    /*
     * Publish a post
     */
    jQuery('.send-post').submit(function (e) {
        e.preventDefault();
        var show_iframe = false;
		if($(this).find('#show_iframe').length > 0){
			show_iframe = true;
		}
		
        // Define planner variable
        var all_planns = [];
        
        // Get planner actions
        jQuery('.post-plans .days').each(function (index) {
            
            // Set day
            var day = jQuery('.post-plans .days').eq(index).val();
            
            // Set date
            var plan_date = jQuery('.post-plans .plan-time').eq(index).val();
            
            // Set when
            var when = jQuery('.post-plans .when').eq(index).val();
            
            // Set repeated times
            var repeat = jQuery('.post-plans .repeat').eq(index).val();
            
            // Save actions
            if ( (day > 0) && (day < 8) && (plan_date !== '') && (when > 0) && (when < 5) && (repeat > 0) && (repeat < 13) ) {
                
                all_planns.push([day,plan_date,when,repeat]);
                
            }
            
        });
        
        // Get selected group
        var group = posts.group;
        
        // Check if the user has selected social networks where he want publish the post
        if ( ( jQuery('.select-group').length > 0) && (posts.publish === 1) ) {
            
            if ( !group ) {
                
                // Display error alert
                popup_fon('sube', translation.mm191, 1500, 2000);
                return false;
                
            }
            
        } else {
            
            if ( JSON.stringify(posts.networks) === '{}' && posts.publish === 1 ) {
                if(show_iframe == false){
					popup_fon('sube', translation.mm110, 1500, 2000);
				}
                
                return false;
                
            }
            
        }
        
        // Set current time
        var currentdate = new Date();
        
        
        // Set date time
        var datetime = currentdate.getFullYear() + '-' + (currentdate.getMonth() + 1) + '-' + currentdate.getDate() + ' ' + currentdate.getHours() + ':' + currentdate.getMinutes() + ':' + currentdate.getSeconds();
        
        // Remove selected post
        jQuery('.getPost').removeClass('active');
        
        // Set publish status: 1 will be published
        var name = jQuery('input[name="csrf_test_name"]').val();
        
        // Set category
        var category = JSON.stringify(posts.categories);
        
        // Set post's title
        var post_title = jQuery('.form-control.post-title').val();
        
        // Set all planned actions
        all_planns = JSON.stringify(all_planns);
        
        // set message
        var mess = btoa(encodeURIComponent(jQuery('.new-post').val()));
        
        // Remove non necessary characters
        mess = mess.replace('/', '-');
        mess = mess.replace(/=/g, '');
        
        // Set post's publish date
        var date = jQuery('.datetime').val();
        
        // Verify if user has scheduled the post
        if ( !date ) {
            
            date = datetime;
            
        }
        
        // Set networks
        var networks = JSON.stringify(posts.networks);
        
        // Verify if groups was selected
        if ( !isNaN(group) ) {
            
            networks  = group;
           
        }
        
        // Create an object with form data
        var data = {'post': mess, 'post_title': post_title, 'url': jQuery('.url').val(), 'img': jQuery('.aimg').val(), 'video': jQuery('.avid').val(), 'networks': networks, 'publish': posts.publish, 'date': date, 'current_date': datetime, 'category': category, 'all_planns': all_planns, 'csrf_test_name': name};
        
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/publish/',
            type: 'POST',
            dataType: 'json',
            data: data,
            beforeSend: function () {
                jQuery('button[type="submit"]').fadeOut('fast');
                jQuery('.loadsend').fadeIn('slow');
            },
            success: function (data) {
                
                // Verify if post was published
                if ( data.search('msuccess') > 0 ) {
                    
                    // Display success alert
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                    
                    // Empty form 
                    jQuery('.post-plans>div').html('<p>' + translation.mm190 + '</p>');
                    document.getElementsByClassName('send-post')[0].reset();
                    jQuery('.img').hide();
                    jQuery('.vid').hide();
                    jQuery('.link').hide();
                    jQuery('.datetime').hide();
                    jQuery('.buttons>i').show();
                    
                    if ( jQuery('.select-group').length > 0 ) {
                        
                        jQuery('.social .select-group').removeClass('active');
                        jQuery('.social .select-group').text(translation.mu42);
                        
                    } else {
                        
                        jQuery('.social>button').remove();
                        jQuery('.social .show-preview').empty();
                        jQuery('.social .select-net').removeClass('active');
                        jQuery('.social .select-net').text(translation.mu42);
                        jQuery('.social .show-accounts').removeClass('active');
                        jQuery('.social .socials').hide();
                        jQuery('.social .show-preview').hide();
                        
                    }
                    delete posts.networks;
                    posts.networks = {};
                    results(1);
                    
                } else {
                    
                    popup_fon('sube', jQuery(data).text(), 1500, 2000);
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log(data);
                popup_fon('sube', translation.mm3, 1500, 2000);
                
            },
            complete: function () {
                
                jQuery('button[type="submit"]').fadeIn('slow');
                jQuery('.loadsend').fadeOut('fast');
                
            }
        });
        
        posts.publish = 1;
        
    });
    
    /*
     * Add planner action
     */
    jQuery('.add-repeat').click(function(){
        
        if ( jQuery('.post-plans>div>.list-group-item').length >= jQuery('section').attr('data-act') ) {
            
            jQuery('.resent .add-repeat').addClass('active');
            return;
            
        }
        
        if ( jQuery('.post-plans>div>p').length > 0 ) {
            
            jQuery('.post-plans>div').empty();
            
        }
        
        var plan = '<div class="list-group-item"><div class="col-md-2 clean"><select class="days"><option value="1">' + translation.mu193 + '</option><option value="2">' + translation.mu194 + '</option><option value="3">' + translation.mu195 + '</option><option value="4">' + translation.mu196 + '</option><option value="5">' + translation.mu197 + '</option><option value="6">' + translation.mu198 + '</option><option value="7">' + translation.mu199 + '</option></select></div><div class="col-md-3 clean"><select class="plan-time"><option value="00:00">00:00</option><option value="01:00">01:00</option><option value="02:00">02:00</option><option value="03:00">03:00</option><option value="04:00">04:00</option><option value="05:00">05:00</option><option value="06:00">06:00</option><option value="07:00">07:00</option><option value="08:00">08:00</option><option value="09:00">09:00</option><option value="10:00">10:00</option><option value="11:00">11:00</option><option value="12:00">12:00</option><option value="13:00">13:00</option><option value="14:00">14:00</option><option value="15:00">15:00</option><option value="16:00">16:00</option><option value="17:00">17:00</option><option value="18:00">18:00</option><option value="19:00">19:00</option><option value="20:00">20:00</option><option value="21:00">21:00</option><option value="22:00">22:00</option><option value="23:00">23:00</option></select></div><div class="col-md-3 clean"><select class="when"><option value="1">' + translation.mu200 + '</option><option value="2">' + translation.mu201 + '</option><option value="3">' + translation.mu202 + '</option><option value="4">' + translation.mu203 + '</option></select></div><div class="col-md-2 clean"><select class="repeat"><option value="1">1 ' + translation.mu204 + '</option><option value="2">2 ' + translation.mu205 + '</option><option value="3">3 ' + translation.mu205 + '</option><option value="4">4 ' + translation.mu205 + '</option><option value="5">5 ' + translation.mu205 + '</option><option value="6">6 ' + translation.mu205 + '</option><option value="7">7 ' + translation.mu205 + '</option><option value="8">8 ' + translation.mu205 + '</option><option value="9">9 ' + translation.mu205 + '</option><option value="10">10 ' + translation.mu205 + '</option><option value="11">11 ' + translation.mu205 + '</option><option value="12">12 ' + translation.mu205 + '</option></select></div><div class="col-md-2 clean text-right"><a href="#" class="delete-planner-rule">' + translation.mm133 + '</a></div></div>';
        jQuery('.post-plans>div').append(plan);
        
    });
    
    /*
     * Delete planner action
     */
    jQuery(document).on('click', '.delete-planner-rule', function (e) {
        
        e.preventDefault();
        
        if ( jQuery('.post-plans>div>.list-group-item').length <= jQuery('section').attr('data-act') ) {
            
            jQuery('.resent .add-repeat').removeClass('active');
            
        }
        
        jQuery(this).closest('.list-group-item').remove();
        
        if ( jQuery('.post-plans>div>.list-group-item').length < 1 ) {
            
            jQuery('.post-plans>div').html('<p>' + translation.mm190 + '</p>');
            
        }
        
    });
    
    /*
     * Count characters and generate preview
     */
    jQuery(document).on('keyup', '.new-post', function () {
        
        jQuery('.numchar').text(jQuery(this).val().length);
        
        if ( jQuery('.syntax-preview').length > 0 ) {
            
            jQuery('.syntax-preview').val(jQuery(this).val());
            
        }
        
        add_prev_text();
        
    });
    
    /*
     * Generate title preview
     */
    jQuery(document).on('keyup', '.form-control.post-title', function () {
        
        add_prev_text();
        
    });
    
    /*
     * Save post as draft
     */
    jQuery(document).on('click', '.draft-save', function (e) {

        e.preventDefault();
        posts.publish = 0;
        
        // Submit form
        jQuery('.send-post').submit();
        
    });
    
    /*
     * Show image preview
     */
    jQuery(document).on('click', '.media-gallery-images .show-image-preview', function () {
        
        // Hide preview
        jQuery('.media-gallery-images ul li.show-preview').fadeOut('slow');
        
        var index = jQuery('.media-gallery-images ul li').index(jQuery(this).closest('li'));
        
        index++;
        
        if ( index !== posts.media_img ) {
            
            var img = jQuery(this).closest('li').attr('data-image');
            jQuery('.media-gallery-images ul li').eq(index).html('<img src="' + img + '">');
            jQuery('.media-gallery-images ul li').eq(index).fadeIn('slow');
            posts.media_img = index;
            
        } else {
            
            posts.media_img = '';
            
        }
        
    });
    
    /*
     * Show video preview
     */
    jQuery(document).on('click', '.media-gallery-videos .show-video-preview', function () {
        
        jQuery('.media-gallery-videos ul li.show-preview').fadeOut('slow');
        
        var index = jQuery('.media-gallery-videos ul li').index(jQuery(this).closest('li'));
        
        index++;
        
        if ( index !== posts.media_video ) {
            
            var video = jQuery(this).closest('li').attr('data-video');
            jQuery('.media-gallery-videos ul li').eq(index).html('<video controls="true" style="width:100%;height:370px"><source src="' + video + '" type="video/mp4" /></video>');
            jQuery('.media-gallery-videos ul li').eq(index).fadeIn('slow');
            posts.media_video = index;
            
        } else {
            
            posts.media_video = '';
            
        }
    });
    
    /*
     * Select an image to publish
     */
    jQuery(document).on('click', '.media-gallery .add-gallery-image', function () {
        
        // Set the image
        var img = jQuery(this).closest('li').attr('data-image');
        jQuery('.img').fadeIn('slow');
        jQuery('.img a').text(img);
        jQuery('.img a').attr('href', img);
        jQuery('.aimg').val(img);
        
        // Generate preview
        save_link_and_generate_preview();
        
    });
    
    /*
     * Select a video to publish
     */
    jQuery(document).on('click', '.media-gallery .add-gallery-video', function () {
        
        // Set the video
        var video = jQuery(this).closest('li').attr('data-video');
        jQuery('.vid').fadeIn('slow');
        jQuery('.vid a').text(video);
        jQuery('.vid a').attr('href', video);
        jQuery('.avid').val(video);
        
    });
    
    /*
     * Delete video or image
     */
    jQuery(document).on('click', '.media-gallery-images .delete-gallery-media, .media-gallery-videos .delete-gallery-media', function () {
        
        // Set id
        var id = jQuery(this).closest('li').attr('data-id');
        
        // Set type
        var type = jQuery(this).closest('.media-gallery').attr('data-type');
        
        if ( type === 'image' ) {
            
            var index = jQuery('.media-gallery-images ul li').index( jQuery(this).closest('li') );
            
        } else {
            
            var index = jQuery('.media-gallery-videos ul li').index(jQuery(this).closest('li'));
            
        }
        
        jQuery.ajax({
            url: url + 'user/delete-media/' + id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                if ( data ) {
                    
                    if ( type === 'image' ) {
                        
                        jQuery('.media-gallery-images ul li').eq(index).remove();
                        jQuery('.media-gallery-images ul li').eq(index).remove();
                        
                    } else {
                        
                        jQuery('.media-gallery-videos ul li').eq(index).remove();
                        jQuery('.media-gallery-videos ul li').eq(index).remove();
                        
                    }
                    
                    // Display success alert
                    popup_fon('subi', data, 1500, 2000);
                    
                    // Refresh image gallery
                    get_media(1, 'image');
                    
                    // Refresh video gallery
                    get_media(1, 'video');
                    
                } else {
                    
                    // Display error alert
                    popup_fon('sube', translation.mm3, 1500, 2000);
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                
                // Display error alert
                popup_fon('sube', translation.mm3, 1500, 2000);
                
            }
            
        });
        
    });
    
    /*
     * Show title field
     */
    jQuery(document).on('click', '.show-title', function () {
        
        jQuery('.row.post-title').toggle('slow');
        
    });
   
    /*
     * Show emojies
     */
    jQuery(document).on('click', '.show-emoji', function () {
        
        jQuery('.emojies').toggle('slow');
        
    });
    
    /*
     * Display posts based on clicked pagination's number
     */
    jQuery(document).on('click', '.pagination li a', function (e) {
        e.preventDefault();
        
        posts.page = jQuery(this).attr('data-page');
        
        results(jQuery(this).attr('data-page'));
        
    });
    
    /*
     * Reset posts listing
     */
    jQuery(document).on('click', '.search-active', function (e) {
        e.preventDefault();
        resetall();
    });
    
    /*
     * Search posts
     */
    jQuery('.search_post').keyup(function () {
        
        // Set the searched key
        var key = jQuery('.search_post').val();
        
        // Set key
        posts.rsearch = key;
        
        // Set page
        posts.page = 1;
        
        // Change search icon
        jQuery('.search-m').addClass('search-active');
        
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/search-posts/' + key,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data ) {
                    
                    // Display pagination
                    show_pagination(data.total);
                    
                    var allposts = '';
                    
                    for ( var u = 0; u < data.posts.length; u++ ) {
                        
                        // Set date
                        var date = data.posts[u].sent_time;
                        
                        // Calculate time
                        var gettime = calculate_time(date, data.date);
                        
                        // Set status
                        var status = (data.posts[u].status == 1) ? '<span class="label label-success">' + translation.mm130 + '</span>' : (data.posts[u].status == 2) ? (data.posts[u].status == 2 && date > data.date) ? '<span class="label label-warning">' + translation.mm111 + '</span>' : '<span class="label label-danger">' + translation.mm112 + '</span>' : '<span class="label label-default">' + translation.mm113 + '</span>';
                        
                        // Set post's text 
                        var text = (data.posts[u].body.length > 0) ? data.posts[u].body.substring(0, 50) + '...' : data.posts[u].img.substring(0, 50) + '...';
                        
                        // Add post to list
                        allposts += '<li class="getPost" data-id="' + data.posts[u].post_id + '">' + text + ' ' + status + ' <span class="pull-right">' + gettime + '</span><span class="label label-danger deletePost" title="' + translation.mm115 + '" aria-hidden="true" data-id="' + data.posts[u].post_id + '">' + translation.mm114 + '</span></li>';
                        
                    }
                    
                    jQuery('.mess-stat ul').html(allposts);
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                
                // Empty the pagination
                jQuery('.pagination').empty();
                
                // Display no post found message
                jQuery('.mess-stat ul').html('<li>' + translation.mm116 + '</li>');
                
            }
            
        });
        
    });
    
    /*
     * Verify if the entered url is valid and save it
     */
    jQuery('.add-link').click(function () {
        
        // Set url
        var uri = jQuery('.the-link').val();
        
        // Verify if url is valid
        if ( uri.substring(0, 4) !== 'http' ) {
            
            // Display error alert
            popup_fon('sube', translation.mm117, 1500, 2000);
            return false;
            
        }
        
        // Get URL's content
        get_page_content_by_url(uri);
        
    });
    
    /*
     * Save image
     */
    jQuery( '.add-img' ).click(function () {
        
        // Set image's url
        var uri = jQuery('.the-img').val();
        
        // Verify if url is valid
        if ( uri.substring(0, 4) !== 'http' ) {
            
            // Set error alert
            popup_fon('sube', translation.mm117, 1500, 2000);
            return;
            
        }
        
        jQuery('.img').fadeIn('slow');
        jQuery('.img a').text(jQuery('.the-img').val());
        jQuery('.img a').attr('href', jQuery('.the-img').val());
        jQuery('.aimg').val(jQuery('.the-img').val());
        jQuery('.the-img').val('');
        save_link_and_generate_preview();
        
    });
    
    /*
     * Save video
     */
    jQuery('.add-vid').click(function () {
        
        // Set video's url
        var uri = jQuery('.the-video').val();
        
        // Verify if url is valid
        if ( uri.substring(0, 4) !== 'http' ) {
            
            // Display error alert
            popup_fon('sube', translation.mm117, 1500, 2000);
            return;
            
        }
        
        jQuery('.vid').fadeIn('slow');
        jQuery('.vid a').text(jQuery('.the-video').val());
        jQuery('.vid a').attr('href', jQuery('.the-video').val());
        jQuery('.avid').val(jQuery('.the-video').val());
        jQuery('.the-video').val('');
        
    });
    
    /*
     * Upload media
     */
    jQuery( '.imgup' ).click(function () {
        
        jQuery('#file').click();
        jQuery('#type').val( jQuery(this).attr('data-type') );
        
    });
    
    /*
     * Display select window
     */
    jQuery('#file').on('change', prepareUpload);
    function prepareUpload( event ) {
        jQuery('#upim').submit();
    }
    
    /*
     * Upload
     */
    jQuery('#upim').submit(function (e) {
        
        // Set media's type
        var type = jQuery('#type').val();
        
        // Get allowed size
        var size = jQuery( 'section' ).attr( 'data-up' );
        
        // Verify if uploaded file is bigger than limit
        if ( parseInt(size) * 1000000 < jQuery('#file')[0].files[0].size ) {

            // Display alert error
            popup_fon('sube', translation.mm118 + ' ' + jQuery('section').attr('data-up') + 'MB.', 1500, 2000);
            e.preventDefault();
            return;

        }
        
        // Upload media
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
                
                if ( parseInt(data) === 0 ) {
                    
                    // Display alert error
                    popup_fon('sube', translation.mm118 + ' ' + jQuery('section').attr('data-up') + 'MB.', 1500, 2000);
                    
                } else if ( parseInt(data) === 1 ) {
                    
                    // Display alert error
                    popup_fon('sube', translation.mm119, 1500, 2000);
                    
                } else if ( parseInt(data) === 3 ) {
                    
                    // Display alert error
                    popup_fon('sube', translation.mm195, 1500, 2000);
                    
                } else if ( parseInt(data) === 4 ) {
                    
                    // Display alert error
                    popup_fon('sube', translation.mm196, 1500, 2000);
                    
                } else if ( parseInt(data) === 5 ) {
                    
                    // Display alert error
                    popup_fon('sube', translation.mm199, 1500, 2000);
                    
                } else {
                    
                    // Verify media type
                    if ( type === 'video' ) {
                        
                        // Add video url
                        jQuery('.the-video').val(data);
                        
                        // Refresh video gallery
                        get_media(1, 'video');
                        
                    } else {
                        
                        // Add image url
                        jQuery('.the-img').val(data);
                        
                        // Refresh image gallery
                        get_media(1, 'image');
                        
                    }
                    
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
    
    /*
     * Select emoji
     */
    jQuery('.emojies td a').click(function (e) {
        e.preventDefault();
        
        // Set data
        var data = jQuery(this).attr('href');
        
        // Add emoji
        jQuery('.new-post').val(jQuery('.new-post').val() + data);
        
    });
    
    /*
     * Insert link, image or video in post text
     */
    jQuery( '.insert-link,.insert-img,.insert-vid' ).click(function () {
        
        // Set url
        var geturl = jQuery(this).closest('.col-lg-12').find('input').val();
        
        // Remove non necessary characters
        var $this = jQuery(this);
        var encode = btoa(geturl);
        encode = encode.replace('/', '-');
        var cleanURL = encode.replace(/=/g, '');
        
        jQuery.ajax({
            url: url + 'user/short-url/' + cleanURL,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                jQuery('.new-post').val(jQuery('.new-post').val() + data);
                $this.closest('.col-lg-12').find('input').val('');
                $this.closest('.col-lg-12').hide();
                $this.closest('.col-lg-12').find('a').attr('href', '');
                save_link_and_generate_preview();
                add_prev_text();
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                
                jQuery('.new-post').val(jQuery('.new-post').val() + geturl);
                
            }
            
        });
        
    });
    
    /*
     * Delete link, image or video
     */
    jQuery( '.delete-link,.delete-img,.delete-vid' ).click(function () {
        
        var $this = jQuery(this);
        $this.closest('.col-lg-12').find('input').val('');
        $this.closest('.col-lg-12').hide();
        $this.closest('.col-lg-12').find('a').attr('href', '');
        save_link_and_generate_preview();
        
    });
    
    /*
     * Select a social netwoork to publish
     */
	 
    jQuery(document).on('click', '.social .select-net', function () {
        if ( !jQuery(this).hasClass('active') ) {
            
            if ( jQuery(this).attr('data-type') === 'main' ) {
                
                jQuery(this).addClass('active');
                jQuery(this).text(translation.mm120);
                var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
                jQuery('.social ul li.socials').eq(index).find('li:first-child').find('.select-net').click();
                
            } else {
                
                var $this = jQuery(this);
                var account = $this.attr('data-account');
                var network = $this.closest('.socials').attr('data-network');
                
                if ( posts.networks[network] ) {
                    
                    var d = JSON.parse(posts.networks[network]);
                    
                    if ( d.length >= jQuery('section').attr('data-cont') ) {
                        
                        popup_fon('sube', translation.mm121 + ' ' + jQuery('section').attr('data-cont') + ' ' + translation.mm122, 1500, 2000);
                        return;
                        
                    }
                    
                }
                
                var index = jQuery('.social ul li.socials').index($this.closest('.socials'));
                jQuery('.social ul li.netsel').eq(index).find('.select-net').addClass('active');
                jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mu206);
                jQuery('.social ul li.show-preview').eq(index).fadeIn('slow');
                $this.addClass('active');
                $this.text(translation.mm120);
                
                if ( typeof posts.networks[network] !== 'undefined' ) {
                    
                    var extract = JSON.parse(posts.networks[network]);
                    
                    if ( extract.indexOf(account) < 0 ) {
                        
                        extract[extract.length] = account;
                        posts.networks[network] = JSON.stringify(extract);
                        
                    }
                    
                } else {
                    
                    posts.networks[network] = JSON.stringify([account]);
                    
                }
                
                // Get the image's url if exists
                var getimg = jQuery('.aimg').val();
                
                if ( !getimg ) {
                    
                    getimg = 'empty';
                    
                }
                
                var encode = btoa(getimg);
                
                encode = encode.replace('/', '-');
                
                var cleanIMG = encode.replace(/=/g, '');
                
                // Get the video's url if exists
                var getvid = jQuery('.avid').val();
                
                if ( !getvid ) {
                    getvid = 'empty';
                }
                
                var encode = btoa(getvid);
                
                encode = encode.replace('/', '-');
                
                var cleanVID = encode.replace(/=/g, '');
                
                // Get the url if exists
                var geturl = jQuery('.url').val();
                
                if ( !geturl ) {
                    geturl = 'empty';
                }
                
                var encode = btoa(geturl);
                
                encode = encode.replace('/', '-');
                
                var cleanURL = encode.replace(/=/g, '');
                
                generate_preview(network, cleanURL, cleanIMG, cleanVID, index);
                
                if ( (network === 'youtube') && (jQuery('.avid').val() === '') ) {
                    
                    return;
                    
                }
                
                if ( $this.hasClass('active') && $this.attr('data-categories') ) {
                    
                    // Set network id
                    var net_id = $this.attr('data-net');
                    
                    // Set account to publish
                    posts.account = $this.attr('data-account');
                    
                    jQuery.ajax({
                        url: url + 'user/get-categories/' + network + '/' + net_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            
                            if ( data && $this.hasClass('active') ) {
                                
                                jQuery('#secat').modal('show');
                                
                                var cats = '';
                                
                                for ( var t = 0; t < data.length; t++ ) {
                                    
                                    cats += data[t];
                                    
                                }
                                
                                jQuery('#selnet').html(cats);
                                
                            }
                            
                        },
                        error: function (data, jqXHR, textStatus) {
                            
                            console.log('Request failed: ' + textStatus);
                            
                        }
                        
                    });
                    
                }
                
            }
            
        }
        
    });
    
    /*
     * Unselect account
     */
	 
	 
	 jQuery(document).on('click', '.social .web_post', function () {
		if ( !jQuery(this).hasClass('active') ) {
            
            if ( jQuery(this).attr('data-type') === 'main' ) {
                
                jQuery(this).addClass('active');
				// jQuery('.website_iframe').show();
				 jQuery('.website_iframe_url').show();
                jQuery(this).text(translation.mm120);
				 var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
                jQuery('.social ul li.socials').eq(index).find('li:first-child').find('.select-net').click();
                
            } 
			}
        
    });
	jQuery(document).on('click', '#show_iframe', function () {
		var web_url=jQuery('#web_url_input').val();
		//var web_url = "https://www.bing.com";
		//alert(web_url);
		jQuery('.web_post_iframe').attr('src', web_url);
		
		jQuery('.website_iframe').show();
	});
	 
	  jQuery(document).on('click', '.social .web_post.active', function () {
		   if ( jQuery(this).closest('li').hasClass('netsel') ) {
            
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('li.netsel'));
            
            var network = jQuery(this).closest('.netsel').attr('data-network');
            
            jQuery('.social ul li.netsel').eq(index).find('.web_post').removeClass('active');
            
            jQuery('.social ul li.netsel').eq(index).find('.web_post').text(translation.mu42);
			 jQuery('.website_iframe_url').hide();
			 jQuery('.website_iframe').hide();
		   }
	  });
	 
	 
	  jQuery(document).on('click', '.social .mybusiness_select_net', function () {
		  if ( !jQuery(this).hasClass('active') ) {
            
            if ( jQuery(this).attr('data-type') === 'main' ) {
                
                jQuery(this).addClass('active');
				 jQuery('.mybusiness_iframe').show();
				 
                jQuery(this).text(translation.mm120);
				  jQuery('html,body').animate({
            scrollTop: jQuery("#mybusiness_div").offset().top},
            'slow');
				 var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
                jQuery('.social ul li.socials').eq(index).find('li:first-child').find('.select-net').click();
                
            } 
			}
	  });
	  
	   jQuery(document).on('click', '.social .mybusiness_select_net.active', function () {
		   if ( jQuery(this).closest('li').hasClass('netsel') ) {
            
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('li.netsel'));
            
            var network = jQuery(this).closest('.netsel').attr('data-network');
            
            jQuery('.social ul li.netsel').eq(index).find('.mybusiness_select_net').removeClass('active');
            
            jQuery('.social ul li.netsel').eq(index).find('.mybusiness_select_net').text(translation.mu42);
			 jQuery('.mybusiness_iframe').hide();
		   }
	  });
	 
    jQuery(document).on('click', '.social .select-net.active', function () {
        if ( jQuery(this).closest('li').hasClass('netsel') ) {
            
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('li.netsel'));
            
            var network = jQuery(this).closest('.netsel').attr('data-network');
            
            jQuery('.social ul li.netsel').eq(index).find('.select-net').removeClass('active');
            
            jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mu42);
            
            jQuery('.social ul li.socials').eq(index).find('.select-net').removeClass('active');
            
            jQuery('.social ul li.socials').eq(index).find('.select-net').text(translation.mu42);
            
            delete posts.networks[network];
            
            jQuery('.social ul li.show-preview').eq(index).fadeOut('slow');
            
            return true;
        } else {
            
            var index = jQuery('.social ul li.socials').index(jQuery(this).closest('li.socials'));
            
            var network = jQuery(this).closest('.socials').attr('data-network');
            
        }
        
        var account = jQuery(this).attr('data-account');
        
        if ( index > -1 ) {
            
            jQuery('.social ul li.show-preview').eq(index).fadeOut('slow');
            jQuery(this).removeClass('active');
            jQuery(this).text(translation.mm123);
            
            var extract = JSON.parse(posts.networks[network]);
            
            if ( extract.indexOf(account) > -1 ) {
                
                var len = extract.indexOf(account) - 1;
                
                if ( extract.length > 1 ) {
                    
                    var new_val = extract.splice(len, 1);
                    posts.networks[network] = JSON.stringify(new_val);
                    
                } else {
                    
                    jQuery('.social ul li.netsel').eq(index).find('.select-net').removeClass('active');
                    jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mm123);
                    delete posts.networks[network];
                    
                }
                
            }
            
        }
        
    });
    
    /*
     * Select a group
     */
    jQuery(document).on('click', '.social .select-group', function () {
        
        var $this = jQuery(this);
        
        delete posts.group;
        
        jQuery('.posts .social .select-group').removeClass('active');
        
        jQuery('.posts .social .select-group').text(translation.mm123);
        
        $this.addClass('active');
        
        $this.text(translation.mu206);
        
        posts.group = $this.closest('li').attr('data-id');
        
    });
    
    /*
     * Unselect a group
     */
    jQuery(document).on('click', '.social .select-group.active', function () {
        
        var $this = jQuery(this);
        
        $this.removeClass('active');
        
        $this.text(translation.mm123);
        
        delete posts.group;
        
    });
    
    /*
     * Search for accounts
     */
    jQuery(document).on('keyup', '.social .search-accounts', function () {
        
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
        var index = jQuery('.social ul li.socials').index(jQuery(this).closest('li.socials'));
        
        // Display social networks
        social_results(network, key, index);
        
    });
    
    /*
     * Search accounts in groups
     */
    jQuery(document).on('keyup', '.social .search-accounts-groups', function () {

        var $this = jQuery(this);
        
        var key = $this.val();        
        
        if ( key === '' ) { key = ' '; }
        
        var list_id = $this.attr('data-id');
        
        $this.closest('li').find('.show-selected').show();
        
        search_for_group_account(list_id,key,$this);
        
    }); 
    
    /*
     * Display selected accounts
     */
    jQuery(document).on('click', '.socials .show-selected', function () {
        
        if ( jQuery('.search-accounts-groups').length > 0 ) { 
            
            jQuery(this).closest('li').find('.search-accounts-groups').val('');
            jQuery(this).closest('li').find('.show-selected').hide();
            var list_id = jQuery(this).closest('li').find('.search-accounts-groups').attr('data-id');
            search_for_group_account(list_id,'',jQuery(this).closest('li').find('.search-accounts-groups'));
            return;
            
        }
        
        var index = jQuery('.social ul li.socials').index(jQuery(this).closest('li.socials'));
        
        var soci = jQuery(this).closest('li.socials');
        
        var network = jQuery(this).closest('li.socials').attr('data-network');
        
        jQuery(this).closest('li.socials').find('.search-accounts').val('');
        
        jQuery(this).hide();
        
        if ( posts.networks[network] ) {
            
            var selected = JSON.parse(posts.networks[network]);
            
            var encode = btoa(selected);
            
            encode = encode.replace('/', '-');
            
            var cleanURL = encode.replace(/=/g, '');
            
            jQuery.ajax({
                url: url + 'user/get-selected/' + cleanURL,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    
                    if ( data.length ) {
                        
                        var coun = '';
                        
                        for ( var l = 0; l < data.length; l++ ) {
                            
                            coun += data[l];
                            
                        }
                        
                        soci.find('.sell-accounts').html(coun);
                        
                    } else {
                        
                        soci.find('.sell-accounts').html('<li>' + translation.mm124 + '</li>');
                        
                    }
                    
                },
                error: function (data, jqXHR, textStatus) {
                    
                    console.log('Request failed: ' + textStatus);
                    
                }
                
            });
            
        } else {
            
            jQuery('.sell-accounts').html('<li>' + translation.mm124 + '</li>');
            
        }
        
    });
    
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
            url: url + 'user/search-accounts/' + network + '/' + key,
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
                            var network = jQuery('.social li.socials').eq(index).attr('data-network');
                            
                            if ( posts.networks[network] === data.accounts[u].network_id ) {
                                
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
    
    /*
     * Display selected accounts
     */
    jQuery(document).on('click', '.social .show-accounts', function () {
        
        if ( jQuery(this).hasClass('active') ) {
            
            jQuery(this).removeClass('active');
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.social ul li.socials').eq(index).fadeOut('slow');
            
        } else {
            
            jQuery(this).addClass('active');
            var index = jQuery('.social ul li.netsel').index(jQuery(this).closest('.netsel'));
            jQuery('.social ul li.socials').eq(index).fadeIn('slow');
            
        }
        
    });
    
    /*
     * Select category
     */
    jQuery(document).on('click', '.categories-select', function (){
        
        var category = jQuery('#selnet').val();
        posts.categories[posts.account] = category;
        
    });
    
    /*
     * Get post history
     */
    jQuery(document).on('click', '.history .getPost', function () {
        
        if ( jQuery(this).hasClass('active') ) {
            
            return false;
            
        }
        
        // Set post_id
        var msgId = jQuery(this).attr('data-id');
        
        jQuery('.getPost').removeClass('active');
        
        jQuery(this).addClass('active');
        
        history_show(msgId);
        
    });
    
    /*
     * Display post's history
     */
    if ( jQuery('.history').length > 0 ) {

        if ( window.location.hash ) {
            
            var hash = window.location.hash;
            hash = hash.replace('#', '');
            history_show(hash);
            
        }
        
    }
    
    /*
     * Get post content
     */
    jQuery(document).on('click', '.posts .getPost', function () {
        
        // Set post id
        var msgId = jQuery(this).attr('data-id');
        
        // If post already was selected
        if ( jQuery(this).hasClass('active') ) {
            
            return false;
            
        }
        
        // Remove active class
        jQuery('.getPost').removeClass('active');
        
        // Add active class
        jQuery(this).addClass('active');
        
        jQuery.ajax({
            url: url + 'user/show-post/' + msgId,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                jQuery('.history .col-lg-6').eq(1).addClass('hide');
                
                if ( data ) {
                    
                    jQuery('.new-post').val(data.body);
                    
                }
                
                if ( data.title !== '' ) {
                    
                    jQuery('.row.post-title').show();
                    jQuery('.row.post-title .post-title').val(data.title);
                    
                } else {
                    
                    jQuery('.row.post-title').hide();
                    jQuery('.row.post-title .post-title').val('');
                    
                }
                
                // Set url
                var url = data.url;
                
                // Set image
                var img = data.img;
                
                // Set video
                var video = data.video;
                
                // Verify if url is valid
                if ( url.substring(0, 4) === 'http' ) {
                    
                    jQuery('.the-link').val(url);
                    get_page_content_by_url(url);
                    
                } else {
                    
                    jQuery('.link').hide();
                    jQuery('.url').val('');
                    
                }
                
                // Verify if image is valid
                if ( img.substring(0, 4) === 'http' ) {
                    
                    jQuery('.img a').attr('href', img);
                    jQuery('.img a').text(img);
                    jQuery('.img').fadeIn('slow');
                    jQuery('.aimg').val(img);
                    
                } else {
                    
                    jQuery('.img').hide();
                    jQuery('.aimg').val('');
                    
                }
                
                // Verify if video exists
                if (video.substring(0, 4) === 'http') {
                    
                    jQuery('.vid a').attr('href', video);
                    jQuery('.vid a').text(video);
                    jQuery('.vid').fadeIn('slow');
                    jQuery('.avid').val(video);
                    
                } else {
                    
                    jQuery('.vid').hide();
                    jQuery('.avid').val('');
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                
            }
            
        });
        
    });
    
    /*
     * Delete a post
     */
    jQuery(document).on('click', '.history .deletePost,.posts .deletePost', function () {
        
        // Set post id
        var msgId = jQuery(this).attr('data-id');
        
        jQuery.ajax({
            url: url + 'user/delete-post/' + msgId,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                if ( data === 1 ) {
                    
                    var page = posts.page;
                    
                    if ( (jQuery('.getPost').length < 2) || (jQuery('.deletePost').length < 2) ) {
                        
                        results(1);
                        
                    } else {
                        
                        results(page);
                        
                    }
                    
                    if ( jQuery('.deletePost').length > 0 ) {
                        
                        jQuery('.history .col-lg-6').eq(1).addClass('hide');
                        
                    }
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
            }
            
        });
        
    });
    
    /*
     * Show post's history
     */
    jQuery(document).on('click', '.showmessaggehistory', function (event) {
        event.preventDefault();
        
        document.location.href = jQuery(this).attr('href');
        
        if ( jQuery('.history').length > 0 ) {
            
            window.location.reload();
            
        }
        
    });
    
    /*
     * Display url's info
     */
    jQuery(document).on('click', '.sent-message a', function (e) {
        e.preventDefault();
        
        // Set url
        var o_url = jQuery(this).attr('href');
        
        // Set short url
        var short_url = btoa(encodeURIComponent(o_url));
        
        // Remove non necessary characters
        short_url = short_url.replace('/', '-');
        short_url = short_url.replace(/=/g, '');
        
        jQuery.ajax({
            url: url + 'get-url-stats/' + short_url,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                if ( data !== 2 ) {
                    
                    jQuery('.clicks-tracking').show();
                    var split = data.split(',');
                    data = JSON.parse('[' + window.atob(split[0]) + ']');
                    var colors = JSON.parse('[' + window.atob(split[1]) + ']');
                    
                    Morris.Donut({
                        element: 'soci-networks',
                        data: data,
                        colors: colors
                    });
                    
                } else {
                    
                    window.open(o_url, '_blank');
                    
                }
                
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed: ' + textStatus);
                window.open(o_url, '_blank');
            }
            
        });
        
    });
    
    /*
     * Show next images
     */
    jQuery(document).on('click', '.media-images-next', function() {
        
        var page = posts.ipage;
        page++;
        posts.ipage = page;
        get_media(page, 'image');
        
    });
    
    /*
     * Show previous images
     */
    jQuery(document).on('click', '.media-images-back', function() {
        
        var page = posts.ipage;
        page--;
        posts.ipage = page;
        get_media(page, 'image');
        
    });
    
    /*
     * Show next videos
     */
    jQuery(document).on('click', '.media-videos-next', function() {
        
        var page = posts.vpage;
        page++;
        posts.vpage = page;
        get_media(page, 'video');
        
    });
    
    /*
     * Show previous videos
     */
    jQuery(document).on('click', '.media-videos-back', function() {
        
        var page = posts.vpage;
        page--;
        posts.vpage = page;
        get_media(page, 'video');
        
    });
    
    /*
     * Refresh spinner content
     */
    jQuery(document).on('click', '.spin-refresh', function() {
        
        var $this = jQuery(this);
        var name = jQuery('input[name="csrf_test_name"]').val();
        var syntax = jQuery('.new-post').val();
        
        // Create an object with form data
        var data = {'content': syntax, 'csrf_test_name': name};
        
        // Submit data via ajax
        jQuery.ajax({
            url: url + 'user/tool/spintax?action=generate',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                
                if ( data ) {
                    
                    jQuery('.syntax-preview').val(data);
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed:' + textStatus);
                
            }
            
        });
        
    });
    
    /*
     * Show history
     */
    function history_show(post_id) {
        
        jQuery.ajax({
            url: url + 'user/show-post/' + post_id,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                jQuery('.history .col-lg-6').eq(1).addClass('hide');
                
                if ( data ) {
                    
                    var content = replace_links(data.body);
                    
                    if ( data.title ) {
                        
                        content = '<span class="titblog">' + data.title + '</span><br>' + content;
                        
                    }
                    
                    jQuery('.sent-message').html(content);
                    
                    // Set url
                    var url = data.url;
                    
                    // Set image
                    var img = data.img;
                    
                    // Set video
                    var video = data.video;
                    
                    // If the url exists will be displayed
                    if ( url.substring(0, 4) === 'http' ) {

                        jQuery('.hilink a').attr('href', url);
                        jQuery('.hilink a').text(url);
                        jQuery('.hilink').fadeIn('slow');
                        
                    } else {
                        
                        jQuery('.hilink').fadeOut('fast');
                        
                    }
                    
                    // If the image's url exists will be displayed
                    if ( img.substring(0, 4) === 'http' ) {
 
                        jQuery('.pub-image img').attr('src', img);
                        jQuery('.pub-image').fadeIn('slow');
                        
                    } else {
                        
                        jQuery('.pub-image').fadeOut('fast');
                        
                    }
                    
                    // If the video's url exists will be displayed
                    if ( video.substring(0, 4) === 'http' ) {

                        jQuery('.pub-video td').html('<video controls="true" style="width:100%;height:300px"><source src="' + video + '" type="video/mp4"></video>');
                        jQuery('.pub-video').fadeIn('slow');
                        
                    } else {
                        
                        jQuery('.pub-video').fadeOut('fast');
                        jQuery('.pub-video td').empty();
                        
                    }
                    
                    // Display history of the published post
                    if ( data.sent ) {

                        jQuery('.status tbody').empty();
                        
                        for ( var m = 0; m < data.sent.length; m++ ) {
                            
                            var status = (parseInt(data.sent[m].status) === 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>';
                            jQuery('.status tbody').append('<tr><td>' + socialIcon(data.sent[m].network_name) + ' ' + data.sent[m].user_name + '</td><td align="right">' + status + '</td></tr>');
                            
                        }
                        
                    }
                    
                    if ( data.time > data.current ) {
                        
                        jQuery('.panel-footer').html(calculate_time(data.time, data.current));
                        
                    } else {
                        
                        jQuery('.panel-footer').html('<i class="fa fa-calendar"></i> ' + calculate_time(data.time, data.current));
                        
                    }
                    
                } else {

                }
                
                jQuery('.history .col-lg-6').eq(1).removeClass('hide');
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                
            }
            
        });
        
    }
    
    /*
     * Display selected accounts
     */
    function get_selected_by_id( msgId ) {
        
        if ( msgId ) {
            
            jQuery.ajax({
                url: url + 'user/get-selected/' + msgId,
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    
                    if ( data.length > 0 ) {
                        
                        for ( var g = 0; g < data.length; g++ ) {
                            
                            if ( !posts.networks[data[g].network_name] ) {
                                
                                jQuery('.social ul li[class="socials"][data-network="' +
                                        data[g].network_name + '"]').find('ul').html('');
                                
                            }
                            
                            jQuery('.social ul li[class="netsel"][data-network="' +
                                    data[g].network_name + '"]').find('.select-net').click();
                            
                            // Set network
                            var network = jQuery(this).closest(".socials").attr("data-network");
                            
                            if ( typeof posts.networks[data[g].network_name] !== 'undefined' ) {
                                
                                var extract = JSON.parse(posts.networks[data[g].network_name]);
                                
                                if ( extract.indexOf(data[g].network_id) < 0 ) {
                                    
                                    extract[extract.length] = data[g].network_id;
                                    posts.networks[data[g].network_name] = JSON.stringify(extract);
                                    
                                }
                                
                            } else {
                                
                                posts.networks[data[g].network_name] = JSON.stringify([data[g].network_id]);
                                
                            }
                            
                        }
                        
                    }
                    
                    var pos = Object.keys(posts.networks);
                    
                    var network = '';
                    
                    for ( var f = 0; f < pos.length; f++ ) {
                        
                        network = pos[f];
                        
                        if ( posts.networks[network] ) {
                            
                            var selected = JSON.parse(posts.networks[network]);
                            
                            var encode = btoa(selected);
                            
                            encode = encode.replace('/', '-');
                            
                            var cleanURL = encode.replace(/=/g, '');
                            
                            var u = network;
                            
                            jQuery.ajax({
                                url: url + 'user/get-selected-accounts/' +
                                        cleanURL,
                                type: 'GET',
                                dataType: 'json',
                                success: function (data) {
                                    
                                    var coun = '';
                                    
                                    for ( var l = 0; l < data.length; l++ ) {
                                        
                                        coun += data[l];
                                        
                                    }
                                    
                                    if ( f === 0 ) {
                                        
                                        jQuery('.social ul li[class="socials"][data-network="' + network + '"]').find('ul').append(coun);
                                        
                                    } else {
                                        
                                        jQuery('.social ul li[class="socials"][data-network="' + network + '"]').find('ul').append(coun);
                                        
                                    }
                                    
                                },
                                error: function (data, jqXHR, textStatus) {
                                    
                                    console.log(data);
                                    
                                },
                                async: false
                            });
                            
                        } else {
                            
                            jQuery('.sell-accounts').html('<li>' + translation.mm124 + '</li>');
                            
                        }
                        
                    }
                    
                },
                error: function (data, jqXHR, textStatus) {
                    
                    console.log("Request failed: " +
                            textStatus);
                }
                
            });
            
        }
        
    }
    
    /*
     * Display pagination
     */
    function show_pagination(total) {
        
        jQuery('.pagination').empty();
        
        if ( parseInt(posts.page) > 1 ) {
            
            var bac = parseInt(posts.page) - 1;
            var pages = '<li><a href="#" data-page="' + bac + '">' + translation.mm128 + '</a></li>';
            
        } else {
            
            var pages = '<li class="pagehide"><a href="#">' + translation.mm128 + '</a></li>';
            
        }
        
        var tot = parseInt(total) / parseInt(posts.limit);
        
        tot = Math.ceil(tot) + 1;
        
        var from = (parseInt(posts.page) > 2) ? parseInt(posts.page) - 2 : 1;
        
        for ( var p = from; p < parseInt(tot); p++ ) {
            
            if ( p === parseInt(posts.page) ) {
                
                pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
                
            } else if ( (p < parseInt(posts.page) + 3) && (p > parseInt(posts.page) - 3) ) {
                
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
                
            } else if ( (p < 6) && (Math.round(tot) > 5) && ((parseInt(posts.page) === 1) || (parseInt(posts.page) === 2)) ) {
                
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
                
            } else {
                
                break;
                
            }
            
        }
        
        if ( p === 1 ) {
            
            pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
            
        }
        
        var next = parseInt(posts.page);
        
        next++;
        
        if ( next < Math.round(tot) ) {
            
            jQuery('.pagination').html(pages + '<li><a href="#" data-page="' + next + '">' + translation.mm129 + '</a></li>');
            
        } else {
            
            jQuery('.pagination').html(pages + '<li class="pagehide"><a href="#">' + translation.mm129 + '</a></li>');
            
        }
        
    }
    
    /*
     * Reset search
     */
    function resetall() {
        
        posts.rsearch = '';
        
        posts.page = 1;
        
        jQuery('.search_post').val('');
        
        jQuery('.search-m').removeClass('search-active');
        
        results(1);
        
    }
    
    /*
     * Add post preview text
     */
    function add_prev_text() {
        
        var new_msg = jQuery('.new-post').val();
        
        var du;
        
        if ( jQuery('.form-control.post-title').val() !== '' ) {
            
            du = '<span class="titblog">' + jQuery('.form-control.post-title').val() + '</span><br>';
            
        }
        
        if ( new_msg.length > 140 ) {
            
            var msg = new_msg.substr(0, 139) + '...';
            
        } else {
            
            var msg = new_msg.substr(0, 139);
            
        }
        
        jQuery('.prevtext').each(function () {
            
            if ( jQuery(this).hasClass('blogpost') ) {
                
                if ( du ) {
                    
                    jQuery(this).html(du + msg);
                    
                } else {
                    
                    jQuery(this).html(msg);
                    
                }
                
            } else {
                
                jQuery(this).html(msg);
                
            }

        });
        
    }
    
    /*
     * Display posts by page
     */
    function results(page) {

        jQuery.ajax({
            url: url + 'user/show-posts/' + page + '/' + posts.rsearch,
            dataType: 'json',
            type: 'GET',
            beforeSend: function () {
                
                if (jQuery(document).width() > 700) {
                    jQuery('.pageload').show();
                }
                
            },
            success: function (data) {
                
                if ( data ) {
                    
                    // Display pagination
                    show_pagination(data.total);
                    
                    var allposts = '';
                    
                    for ( var u = 0; u < data.posts.length; u++ ) {
                        
                        // Set date
                        var date = data.posts[u].sent_time;
                        
                        // Set time
                        var gettime = calculate_time(date, data.date);
                        
                        // Set status
                        var status = (data.posts[u].status == 1) ? '<span class="label label-success">' + translation.mm130 + '</span>' : (data.posts[u].status == 2) ? (data.posts[u].status == 2 && date > data.date) ? '<span class="label label-warning">scheduled</span>' : '<span class="label label-danger">' + translation.mm112 + '</span>' : '<span class="label label-default">' + translation.mm113 + '</span>';
                        
                        // Set post content
                        var text = (data.posts[u].body.length > 0) ? data.posts[u].body.substring(0, 50) + '...' : data.posts[u].img.substring(0, 50) + '...';
                        
                        // Add post
                        allposts += '<li class="getPost" data-id="' + data.posts[u].post_id + '">' + text + ' ' + status + ' <span class="pull-right">' + gettime + '</span><span class="label label-danger deletePost" title="' + translation.mm115 + '" aria-hidden="true" data-id="' + data.posts[u].post_id + '">' + translation.mm114 + '</span></li>';
                        
                    }
                    
                    jQuery('.mess-stat ul').html(allposts);
                }
				if(data.total=='')
				{
					 jQuery('.pagination').empty();
                jQuery('.mess-stat ul').html('<li>' + translation.mm116 + '</li>');
				}
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed:' + textStatus);
                jQuery('.pagination').empty();
                jQuery('.mess-stat ul').html('<li>' + translation.mm116 + '</li>');
                
            },
            complete: function () {
                
                jQuery('.pageload').fadeOut('slow');
                
            }
            
        });
        
    }
    
    /*
     * Display social icon
     */
    function socialIcon(network) {

        switch (network) {
            case 'facebook':
                return '<i class="fa fa-facebook"></i>';
                break;
            case 'facebook_pages':
                return '<i class="fa fa-facebook-official"></i>';
                break;
            case 'facebook_groups':
                return '<i class="fa fa-facebook-square"></i>';
                break;
            case 'vk':
                return '<i class="fa fa-vk"></i>';
                break;
            case 'twitter':
                return '<i class="fa fa-twitter"></i>';
                break;
            case 'tumblr':
                return '<i class="fa fa-tumblr"></i>';
                break;
            case 'pinterest':
                return '<i class="fa fa-pinterest"></i>';
                break;
            case 'blogger':
                return '<img src="/assets/img/blogger.png">';
                break;
            case 'dailymotion':
                return '<img src="/assets/img/dailymotion.png">';
                break;
            case 'medium':
                return '<img src="/assets/img/medium.png">';
                break;
            case 'wordpress':
                return '<i class="fa fa-wordpress"></i>';
                break;
            case 'linkedin_companies':
                return '<i class="fa fa-linkedin-square"></i>';
                break;
            case 'linkedin':
                return '<i class="fa fa-linkedin"></i>';
                break;
            case 'flickr':
                return '<i class="fa fa-flickr"></i>';
                break;
            case 'instagram':
                return '<i class="fa fa-instagram"></i>';
                break;
            case 'reddit':
                return '<i class="fa fa-reddit-alien" aria-hidden="true"></i>';
                break;
            case 'youtube':
                return '<i class="fa fa-youtube"></i>';
                break;
            case 'google_plus':
                return '<i class="fa fa-google-plus"></i>';
                break;
            case 'imgur':
                return '<i class="fa fa-info" aria-hidden="true"></i>';
                break;
            default:
                return network;
                break;
        }
        
    }
    
    /*
     * Refresh the preview for all added social networks
     */
    function save_link_and_generate_preview() {
        
        if ( Object.keys(posts.networks).length > 0 ) {
            
            // Remove all preview
            jQuery('.show-preview ul').empty();
            jQuery('.show-preview .tab-content').empty();
            var position = {};
            var num = 0;
            
            jQuery('.social .netsel').each(function () {
                var network = jQuery(this).attr('data-network');
                position[network] = num;
                num++;
            });
            
            for (var i = 0; i < Object.keys(posts.networks).length; i++) {
                
                var index = position[Object.keys(posts.networks)[i]];
                if ( !jQuery('.social ul li.netsel').eq(index).find('.select-net').hasClass('active') ) {
                    
                    continue;
                    
                }
                
                // Get the image's url if exists
                var getimg = jQuery('.aimg').val();
                
                if ( !getimg ) {
                    
                    getimg = 'empty';
                    
                }
                
                // Remove non necessary characters
                var encode = btoa(getimg);
                encode = encode.replace('/', '-');
                var cleanIMG = encode.replace(/=/g, '');
                
                // Get the video's url if exists
                var getvid = jQuery('.avid').val();
                
                if ( !getvid ) {
                    getvid = 'empty';
                }
                
                // Remove non necessary characters
                var encode = btoa(getvid);
                encode = encode.replace('/', '-');
                var cleanVID = encode.replace(/=/g, '');
                
                // Get the url if exists
                var geturl = jQuery('.url').val();
                if ( !geturl ) {
                    geturl = 'empty';
                }
                
                // Remove non necessary characters
                var encode = btoa(geturl);
                encode = encode.replace('/', '-');
                var cleanURL = encode.replace(/=/g, '');
                
                // Generate preview
                generate_preview(Object.keys(posts.networks)[i], cleanURL, cleanIMG, cleanVID, index);
                
            }
            
        }
        
    }
    
    /*
     * Generate preview
     */
    function generate_preview(network, cleanURL, cleanIMG, cleanVID, index) {
        
        jQuery.ajax({
            url: url + 'user/preview/' + network + '/' + cleanURL + '/' + cleanIMG + '/' + cleanVID,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                if ( data.name ) {
                    
                    if ( jQuery('.btn-post').length > 0 ) {
                        
                        jQuery('.btn-post').remove();
                        
                    }
                    
                    var content = data.content;
                    
                    // Check if the content variable contains placeholders
                    if ( content.indexOf('(img)') > -1 ) {
                        
                        content = content.replace('(img)', posts.preview.image);
                        content = content.replace('(title)', posts.preview.title);
                        content = content.replace('(description)', posts.preview.description);
                        content = content.replace('(domain)', extract_domain_from_url(posts.preview.domain));
                        
                    }
                    
                    jQuery('.social ul li.show-preview').eq(index).html(content);
                    
                    add_prev_text();
                    
                } else if (data.info) {
                    
                    popup_fon('sube', jQuery(data.info).text(), 1500, 2000);
                    jQuery('.social ul li.socials').eq(index).find('.select-net').removeClass('active');
                    jQuery('.social ul li.netsel').eq(index).find('.select-net').removeClass('active');
                    jQuery('.social ul li.socials').eq(index).find('.select-net').text(translation.mu42);
                    jQuery('.social ul li.netsel').eq(index).find('.select-net').text(translation.mu42);
                    jQuery('.social ul li.show-preview').eq(index).hide();
                    delete posts.networks[network];
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                popup_fon('sube', translation.mm3, 1500, 2000);
                
            }
            
        });
        
    }
    
    /*
     * Extract domain from url
     */
    function extract_domain_from_url(url) {
        
        url = url.replace('http://', '');
        url = url.replace('https://', '');
        url = url.replace('www.', '');
        return url;
        
    }
    
    /*
     * Search for groups
     */
    function search_for_group_account(list_id,key,$this) {

        jQuery.ajax({
            url: url + 'user/tool/groups-accounts?action=search-in-group&list-id=' + list_id + '&key=' + key,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data ) {
                    
                    $this.closest('li').find('ul').html(data);
                    
                } else {
                    
                    $this.closest('li').find('ul').html('<li>' + translation.mm127 + '</li>');
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                $this.closest('li').find('ul').html('<li>' + translation.mm127 + '</li>');
                
            }
            
        });
        
    }
    
    /*
     * Check if url is valid and extract image, title and description from the url
     */
    function get_page_content_by_url(geturl) {
        
        // Get url
        var encode = btoa(geturl);
        
        // Remove non necessary characters
        encode = encode.replace('/', '-');
        var cleanURL = encode.replace(/=/g, '');
        
        jQuery.ajax({
            url: url + 'user/content-from-url/' + cleanURL,
            dataType: 'json',
            type: 'GET',
            timeout: 30000,
            beforeSend: function () {
                jQuery('.parse-load').fadeIn('slow');
                jQuery('.loading-image').show();
            },
            success: function (data) {
                
                if ( data.error ) {
                    
                    jQuery('.parse-load').text(posts.urlError);
                    setTimeout(function () {
                        jQuery('.parse-load').fadeOut('fast');
                        jQuery('.parse-load').text(posts.urlChecking);
                    }, 3000);
                    
                } else {
                    
                    posts.preview.domain = geturl;
                    posts.preview.title = data.title;
                    posts.preview.description = data.description;
                    posts.preview.image = data.img;
                    jQuery('.link').fadeIn('slow');
                    jQuery('.link a').text(jQuery('.the-link').val());
                    jQuery('.url').val(jQuery('.the-link').val());
                    jQuery('.link a').attr('href', jQuery('.the-link').val());
                    jQuery('.the-link').val('');
                    jQuery('.parse-load').fadeOut('slow');
                    jQuery('.loading-image').hide();
                    save_link_and_generate_preview();
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                jQuery('.parse-load').text(posts.urlError);
                setTimeout(function () {
                    jQuery('.loading-image').hide();
                    jQuery('.parse-load').fadeOut('fast');
                    jQuery('.parse-load').text(posts.urlChecking);
                }, 3000);
                
            },
            
            timeout: 30000
            
        });
        
    }
    
    /*
     * Replace links
     */
    function replace_links(text) {
        
        var exp = /(\b(https?):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        return text.replace(exp, "<a href='$1'>$1</a>");
        
    }
    
    /*
     * Display media pagination
     */
    function media_pagination(total, type) {
        
        var limit = 10;
        
        if ( type === 'image' ) {
            
            var page = posts.ipage;
            
            if ( total > (page * limit) ) {
                
                jQuery('.media-images-next').removeClass('disabled');
                
            } else {
                
                jQuery('.media-images-next').addClass('disabled');
                
            }
            
            if ( page > 1 ) {
                
                jQuery('.media-images-back').removeClass('disabled');
                
            } else {
                
                jQuery('.media-images-back').addClass('disabled');
                
            }
            
        } else {
            
            var page = posts.vpage;
            
            if ( total > (page * limit) ) {
                
                jQuery('.media-videos-next').removeClass('disabled');
                
            } else {
                
                jQuery('.media-videos-next').addClass('disabled');
                
            }
            
            if ( page > 1 ) {
                
                jQuery('.media-videos-back').removeClass('disabled');
                
            } else {
                
                jQuery('.media-videos-back').addClass('disabled');
                
            }   
            
        }
        
    }
    
    /*
     * Display media by pagination
     */
    function get_media(page, type) {
        
        jQuery.ajax({
            url: url + 'user/get-media/' + type + '/' + page,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                if ( type === 'image' ) {
                
                    if ( data ) {
                        
                        jQuery('.media-gallery-images').show();
                        
                        var allmedia = '';
                        
                        media_pagination(data.total, 'image');
                        
                        for ( var u = 0; u < data.medias.length; u++ ) {
                            
                            var body = data.medias[u].body;
                            body = body.replace(url + 'assets/share/', '');
                            allmedia += '<li data-id="' + data.medias[u].media_id + '" data-image="' + data.medias[u].body + '"><i class="fa fa-picture-o pull-left"></i> <span class="pull-left show-image-preview">' + body + '</span><div class="btn-group btn-group-info pull-right"><button class="btn btn-default add-gallery-image" type="button"><i class="fa fa-plus"></i></button><button class="btn btn-default delete-gallery-media" type="button"><i class="fa fa-trash-o"></i></button></div></li><li class="show-preview"></li>';
                            
                        }
                        
                        jQuery('.media-gallery-images').html('<ul>' + allmedia + '</ul>'); 
                        
                        jQuery('.total-gallery-photos').html(data.total + ' photos');
                        
                        if ( data.total < 11 ) {
                            
                            jQuery('.media-gallery-pagination').hide();
                            
                        } else {
                            
                            jQuery('.media-gallery-pagination').show();
                            
                        }
                        
                    } else {
                        
                        jQuery('.media-gallery-pagination').hide();
                        jQuery('.media-gallery-images').hide();
                        
                    }
                    
                } else {
                    
                    if ( data ) {
                        
                        jQuery('.media-gallery-videos').show();
                        
                        var allmedia = '';
                        
                        media_pagination(data.total, 'video');
                        
                        for ( var u = 0; u < data.medias.length; u++ ) {
                            
                            var body = data.medias[u].body;
                            body = body.replace(url + 'assets/share/', '');
                            allmedia += '<li data-id="' + data.medias[u].media_id + '" data-video="' + data.medias[u].body + '"><i class="fa fa-video-camera pull-left"></i> <span class="pull-left show-video-preview">' + body + '</span><div class="btn-group btn-group-info pull-right"><button class="btn btn-default add-gallery-video" type="button"><i class="fa fa-plus"></i></button><button class="btn btn-default delete-gallery-media" type="button"><i class="fa fa-trash-o"></i></button></div></li><li class="show-preview"></li>';
                            
                        }
                        
                        jQuery('.media-gallery-videos').html('<ul>' + allmedia + '</ul>'); 
                        
                        jQuery('.total-gallery-videos').html(data.total + ' videos');
                        
                        if ( data.total < 11 ) {
                            
                            jQuery('.video-gallery-pagination').hide();
                            
                        } else {
                            
                            jQuery('.video-gallery-pagination').show();
                            
                        }
                        
                    } else {
                        
                        jQuery('.video-gallery-pagination').hide();
                        jQuery('.media-gallery-videos').hide();
                        
                    }   
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed: ' + textStatus);
                
                if ( type === 'image' ) {
                    
                    jQuery('.media-gallery-pagination').hide();
                    jQuery('.media-gallery-images').hide();
                    
                } else {
                    
                    jQuery('.video-gallery-pagination').hide();
                    jQuery('.media-gallery-videos').hide();
                    
                }
                
            }
            
        });
        
    }
    
    // Verify if browser is Google Chrome
    if ( (navigator.userAgent.indexOf('Windows NT 10.0') < 0) && (navigator.userAgent.indexOf('Chrome') > 0) && (navigator.userAgent.indexOf('Android') < 0) ) {
        
        // Load the emoji font
        jQuery('body').css('font-family','OpenSansEmoji');
        
    }
    
    // Load last published posts
    results(posts.page);
    
    // Verify if user is in the posts page
    if ( jQuery('.media-gallery').length > 0 ) {
        
        // Display image gallery
        get_media(posts.ipage, 'image');
        
        // Display video gallery
        get_media(posts.vpage, 'video');
        
    }

    jQuery('body').find('.localpost').click(function(){
		 var location_name = jQuery(this).data('name');
		 jQuery("#mybusiness_loc_name").val( location_name );
		jQuery("#localpostModel").show();
	});
	jQuery(function() {
  jQuery('.upload-img').on('change', function(evt) {
    var file = evt.target.files[0];
    var _this = evt.target;
    jQuery(this).parent('.upload-section').hide();
    var reader = new FileReader();
    reader.onload = function(e) {
      var span = '<img class="thumb mrm mts remove_img_preview" src="' + e.target.result + '" title="' + escape(file.name) + '"/><span class="remove_img_preview"></span>';
      $(_this).parent('.upload-section').next().append($(span));
    };
    reader.readAsDataURL(file);
    //evt.target.value = "";
  });

  jQuery('.preview-section').on('click', '.remove_img_preview', function() {
    jQuery(this).parent('.preview-section').prev().show();
    jQuery(this).parent('.preview-section').empty();
  });
});
$(function () {
        $("form#mybusiness_post_form").submit(function (e) {
            e.preventDefault();

var formData = new FormData(this);
            $.ajax({
				url: "gbm/edit/loc_mybusiness_localpost.php",
                type: 'POST',
                data: formData,
				
                success: function (data) {
					//alert(data);
                     //$("#local_post_list").html(data);
                    cancel_btn();
                },
				cache: false,
            contentType: false,
            processData: false
            });

        });
        return false;
    });
	
	
});