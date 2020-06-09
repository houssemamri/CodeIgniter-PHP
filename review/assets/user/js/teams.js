jQuery(document).ready(function () {
    'use strict';
    
    /*
     * Create the Teams object
     */
    var Teams = new Object();
    
    /*
     * Set the Teams page
     */
    Teams.page = 1;
    
    /*
     * Set the Teams list limit
     */
    Teams.limit = 10;    
    
    /*
     * Get the website's url
     */
    //var url = jQuery('.navbar-brand').attr('href');
var url=jQuery('#base_url').val();
    /*
     * Create a new team's member
     */
    jQuery('.new-member').submit(function (e) {
        e.preventDefault();
        
        // Get the csrf field
        var name = jQuery('input[name="csrf_test_name"]').val();

        // Create an object with form data
        var data = {username: jQuery('.new-member .username').val(), password: jQuery('.new-member .password').val(), csrf_test_name: name};

        // submit data via ajax
        jQuery.ajax({
            url: url + 'user/team-settings/new-member',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                
                if (data.search('msuccess') > 0) {
                    
                    // Display success message
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                    
                    // Refresh the member list
                    show_members(1);
                    
                    // Empty new user form
                    jQuery( '.new-member .username' ).val( 'm_' );
                    jQuery( '.new-member .password' ).val( '' );
                    
                } else {
                    
                    // Display error message
                    popup_fon('sube', jQuery(data).text(), 1500, 2000);
                    
                }
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log(data);
                
            }
        });
        
    });
    
    /*
     * Update member data
     */
    jQuery('.update-settings').submit(function (e) {
        e.preventDefault();
        
        // Get the csrf field
        var name = jQuery('input[name="csrf_test_name"]').val();
        
        // Get Password
        var password = jQuery('.update-settings .password').val();
        
        // Get Repeat Password
        var rpassword = jQuery('.update-settings .rpassword').val();
        
        // check if the password match
        if (jQuery('.update-settings .password').val() !== jQuery('.update-settings .rpassword').val()) {
            
            // Display error message
            popup_fon('sube', translation.mm139, 1500, 2000);
            return;
        }

        // Create an object with form data
        var data = {member_id: Teams.member_id, password: jQuery('.update-settings .password').val(), csrf_test_name: name};

        // submit data via ajax
        jQuery.ajax({
            url: url + 'user/team-settings/update',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.search('msuccess') > 0) {
                    
                    // Display success message
                    popup_fon('subi', jQuery(data).text(), 1500, 2000);
                    
                    jQuery('.update-settings .password').val('');

                    jQuery('.update-settings .rpassword').val('');
                    
                } else {
                    
                    // Display error message
                    popup_fon('sube', jQuery(data).text(), 1500, 2000);
                    
                }
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log(data);
                
            }
        });
        
    });
    
    /*
     * Navigate through the pages
     */
    jQuery(document).on('click', '.pagination li a', function (e) {
        e.preventDefault();
        
        Teams.page = jQuery(this).attr('data-page');
        show_members(Teams.page);
        
    });
    
    /*
     * Get member details
     */
    jQuery(document).on('click', '#members .member-details', function (e) {
        e.preventDefault();
        
        var member_id = jQuery(this).closest( '.btn-group' ).attr( 'data-id' );
        
        // Set the member ID
        Teams.member_id = member_id;
        
        // submit data via ajax
        jQuery.ajax({
            url: url + 'user/team-settings/member/' + member_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data ) {
                    
                    // Display user details area
                    jQuery( '.teams > .col-lg-8' ).fadeIn( 'slow' );
                    
                    // Display member username
                    jQuery( '#details .member_username' ).text( data[0][0].member_username );
                    jQuery( '#settings .member_username' ).val( data[0][0].member_username );
                    
                    // Display joined date
                    jQuery( '.date_joined' ).html( calculate_time( data.date, data[0][0].date_joined ) );
                    
                    // Get the last access date
                    var last_access = data[0][0].last_access;
                    
                    // Verify if last_access exists
                    if ( last_access !== '' && last_access !== '0' ) {

                        jQuery( '.last_access' ).html( calculate_time( data.date,data[0][0].last_access ) );
                        
                    } else {
                        
                        jQuery( '.last_access' ).html( translation.mu326 );
                        
                    }
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log(data);
                
            }
        });
        
    });
    
    /*
     * Delete a member
     */
    jQuery(document).on('click', '#members .delete-member', function (e) {
        e.preventDefault();
        
        var member_id = jQuery(this).closest( '.btn-group' ).attr('data-id');
        
        // submit data via ajax
        jQuery.ajax({
            url: url + 'user/team-settings/delete/' + member_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data ) {
                    
                    // Hide user details area
                    jQuery( '.teams > .col-lg-8' ).fadeOut( 'fast' );
                    
                    // Display success message
                    popup_fon('subi', translation.mu321, 1500, 2000);
                    
                    // Refresh the member list
                    show_members(1);
                    
                } else {
                    
                    // Display error message
                    popup_fon('sube', translation.mu322, 1500, 2000);
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log(data);
                
            }
        });
        
    });
    
    /*
     * Display pagination
     */
    function show_pagination(total) {
        // the code bellow displays pagination
        jQuery('.pagination').empty();
        if (parseInt(Teams.page) > 1) {
            var bac = parseInt(Teams.page) - 1;
            var pages = '<li><a href="#" data-page="' + bac + '">' + translation.mm128 + '</a></li>';
        } else {
            var pages = '<li class="pagehide"><a href="#">' + translation.mm128 + '</a></li>';
        }
        var tot = parseInt(total) / parseInt(Teams.limit);
        tot = Math.ceil(tot) + 1;
        var from = (parseInt(Teams.page) > 2) ? parseInt(Teams.page) - 2 : 1;
        for (var p = from; p < parseInt(tot); p++) {
            if (p === parseInt(Teams.page))
            {
                pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
            } else if ((p < parseInt(Teams.page) + 3) && (p > parseInt(Teams.page) - 3)) {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            } else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(Teams.page) == 1) || (parseInt(Teams.page) == 2))) {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            } else {
                break;
            }
        }
        if (p === 1) {
            pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
        }
        var next = parseInt(Teams.page);
        next++;
        if (next < Math.round(tot)) {
            jQuery('.pagination').html(pages + '<li><a href="#" data-page="' + next + '">' + translation.mm129 + '</a></li>');
        } else {
            jQuery('.pagination').html(pages + '<li class="pagehide"><a href="#">' + translation.mm129 + '</a></li>');
        }
    }
    
    /*
     * Display member list
     */
    function show_members( page ) {
        
        jQuery.ajax({
            url: url + 'user/show-members/' + page,
            dataType: 'json',
            type: 'GET',
            beforeSend: function () {
                
                if (jQuery(document).width() > 700) {
                    
                    jQuery('.pageload').show();
                    
                }
                
            },
            success: function (data) {
                
                if (data) {
                    show_pagination(data.total);
                    var allmembers = '';
                    for (var u = 0; u < data.members.length; u++) {
                        
                        // Calculate the time
                        var gettime = calculate_time(data.members[u].last_access, data.date);
                        if ( typeof gettime === 'undefined' || gettime === 0 ) {
                            
                            gettime = translation.mu326;
                            
                        }
                        allmembers += '<li><h4>' + data.members[u].member_username + ' <span><i class="fa fa-sign-in" aria-hidden="true"></i> ' + gettime + '</span> <div class="btn-group pull-right" data-id="' + data.members[u].member_id + '"><a href="#" class="btn btn-default member-details">' + translation.mu50 + '</a><a href="#" data-id="43" class="btn btn-default delete-member"><i class="fa fa-trash-o"></i></a></div></h4></li>';
                        
                    }
                    
                    jQuery('#members > ul').html(allmembers);

                } else {
                    
                    jQuery('.pagination').empty();
                    jQuery('#members > ul').html( '<p>' + translation.mu323 + '</p>' );
                    
                }
            },
            error: function (data, jqXHR, textStatus) {
                
                console.log('Request failed:' + textStatus);
                
                jQuery('.pagination').empty();
                jQuery('#members > ul').html( '<p>' + translation.mu323 + '</p>' );
                
            },
            complete: function () {
                
                jQuery('.pageload').fadeOut('slow');
                
            }
        });
        
    }
    
    show_members(Teams.page);
});