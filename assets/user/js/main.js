/*
 * Main javascript file
*/

/*
 * Create the main object
 */
var Main = new Object();

/*
 * Calculate time between two dates
 */
function calculate_time(from, to) {
    'use strict';
    
    // Set calculation time
    var calculate = to - from;
    
    // Set after variable
    var after = ' ';
    
    // Set before variable 
    var before = ' ' + translation.mm104;
    
    // Define calc variable
    var calc;
    
    // Verify if time is older than now
    if ( calculate < 0 ) {
        
        // Set absolute value of a calculated time
        calculate = Math.abs(calculate);
        
        // Set icon
        after = '<i class="fa fa-calendar-check-o" aria-hidden="true"></i> ';
        
        // Empty before
        before = '';
        
    }
    
    // Calculate time
    if ( calculate < 60 ) {
        
        return after + translation.mm105;
        
    } else if ( calculate < 3600 ) {
        
        calc = calculate / 60;
        calc = Math.round(calc);
        return after + calc + ' ' + translation.mm106 + before;
        
    } else if ( calculate < 86400 ) {
        
        calc = calculate / 3600;
        calc = Math.round(calc);
        return after + calc + ' ' + translation.mm107 + before;
        
    } else if ( calculate >= 86400 ) {
        
        calc = calculate / 86400;
        calc = Math.round(calc);
        return after + calc + ' '+ translation.mm103 + before;
        
    }
    
}

/*
 * Display alert
 */
function popup_fon(cl,msg,ft,lt) {
    
    // Set popup
    var te = '<div class="modal-backdrop fade in"></div>';
    
    // Insert popup
    jQuery(te).insertAfter('section');
    
    // Add message
    jQuery('<div class="md-message ' + cl + '"><i class="fa fa-bell-o" aria-hidden="true"></i> ' + msg + '</div>').insertAfter('section');
    
    // Display alert
    setTimeout(function(){
        
        jQuery(document).find('.md-message').animate({marginTop:'-100',opacity:'0'},500);
        
    }, ft);
    
    // Hide alert
    setTimeout(function(){
        
        jQuery(document).find('.md-message').remove();
        jQuery(document).find('.modal-backdrop').remove();
        
    }, lt);
    
}
jQuery(document).ready(function() {
    
    /*
     * Display menu
     */
    jQuery( '.short-menu' ).click(function () {
        
        // Show or hide menu
        jQuery('nav').toggle('slow');
      
    });
    
    // Display datetimepicker
    if ( jQuery('.time-schedule').length > 0 ) {
        
        // Set format
        jQuery('.time-schedule').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            pickerPosition: 'bottom-left'
        });
        
    }
    
    // Enable or disable an option
    jQuery('.container-fluid .setopt').click(function () {
        
        enable_or_disable_option(jQuery(this).attr('id'));
        
    });
    
    /*
     * Disable or enable option by name
     */
    function enable_or_disable_option(name) {
        
        // submit data via ajax
        jQuery.ajax({
            url: jQuery('#base_url').val() + 'user/option/' + name,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                if ( data !== 1 ) {
                    
                    // Show message
                    jQuery('.alert-msg').show();
                    
                    // Add text message
                    jQuery('.alert-msg').html(data);
                    
                    // Hide message
                    jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                        
                        // Remove error message
                        jQuery('.merror').remove();
                        jQuery('.alert-msg').hide();
                        
                    });
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
            }
            
        });
        
    }
    
    // Set current date
    Main.ctime = new Date();

    // Set current months
    Main.month = Main.ctime.getMonth() + 1;

    // Set current day
    Main.day = Main.ctime.getDate();

    // Set current year
    Main.year = Main.ctime.getFullYear();

    // Set current year
    Main.cyear = Main.year;

    // Set date/hour format
    Main.format = 0;

    // Set selected_date
    Main.selected_date = '';
    
    // Set selected time
    Main.selected_time = '08:00';
    
    /*
     * Detect schedule click
     */
    jQuery(document).on('click', '.buttons > a', function(e) {
        e.preventDefault();
        
        // Verify which scheduling option to display
        if ( jQuery( '.calendar-widget' ).length > 0 ) {
        
            // Display the calendar
            jQuery( '.calendar-widget' ).slideToggle({
                direction: 'up'
            }, 300);

            // Get date format
            Main.format = jQuery('.calendar-widget').attr('data-format');

            setTimeout(function() {

                 // Move page to bottom
                jQuery( 'html, body' ).animate({ scrollTop: jQuery(document).height() }, 300);

            },500);

            // Display calendar
            show_calendar( Main.month, Main.day, Main.year, Main.format );

            // Scroll hours to 08:00
            var container = jQuery('#time-format'), scrollTo = jQuery( '.default-selected' );
            container.animate({scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()});
        
        } else {
            
            jQuery( this ).hide();
            jQuery( '.buttons>.datetime' ).fadeIn('slow');
            
            // Enable datepicker
            jQuery( '.datetime' ).datetimepicker({

                format: 'yyyy-mm-dd hh:ii',
                pickerPosition: 'top-left'

            });
            
        }
        
    });
    
    /*
     * Select a date
     */  
    jQuery(document).on('click', '.calendar-widget table td a', function (e) {
        e.preventDefault();
        
        // Remove class add-date
        jQuery('.calendar-widget table td a').removeClass('add-date');
        
        // Add class add-date
        jQuery(this).addClass('add-date');
        
        // Set new selected date
        Main.selected_date = jQuery(this).attr('data-date');
        
        // Set current date
        var current_date = Main.selected_date;
        
        // Split date
        var split_date = current_date.split( '-' );
        
        // Set correct format
        var format_date = split_date[0] + '-' + ( 10 > split_date[1] ? '0' + split_date[1]: split_date[1] ) + '-' + ( 10 > split_date[2] ? '0' + split_date[2] : split_date[2]  );
        
        // Set date and time
        jQuery( '.datetime' ).val( format_date + ' ' + Main.selected_time );

    });
    
    /*
     * Select time
     */  
    jQuery(document).on('click', '#time-format .list-group-item', function (e) {
        e.preventDefault();
        
        // Remove class selected-time
        jQuery('#time-format .list-group-item').removeClass('selected-time');
        
        // Add class selected-time
        jQuery(this).addClass('selected-time');
        
        // Set hour
        var hour = jQuery(this).attr( 'data-hours' );
        
        // Set minutes
        var minutes = jQuery(this).attr( 'data-minutes' );
        
        // Adjust format
        var format_time = ( 10 > hour ? '0' + hour: hour ) + ':' + ( 10 > minutes ? '0' + minutes : minutes  );
        
        // Set selected time
        Main.selected_time = format_time;
        
        // Verify if date was selected
        if ( Main.selected_date ) {
            
            // Set current date
            var current_date = Main.selected_date;

            // Split date
            var split_date = current_date.split( '-' );

            // Set correct format
            var format_date = split_date[0] + '-' + ( 10 > split_date[1] ? '0' + split_date[1]: split_date[1] ) + '-' + ( 10 > split_date[2] ? '0' + split_date[2] : split_date[2]  );

            // Set date and time
            jQuery( '.datetime' ).val( format_date + ' ' + Main.selected_time );
            
        }
        
    });
    
    /*
     * Go back button
     */    
    jQuery('.go-back').click(function (e) {
        e.preventDefault();

        Main.month--;

        if ( Main.month < 1 ) {
            
            Main.year--;
            Main.month = 12;
            
        }
        
        // Display calendar
        show_calendar( Main.month, Main.day, Main.year, Main.format);
        
    });
    
    /*
     * Go next button
     */
    jQuery('.go-next').click(function (e) {
        e.preventDefault();

        Main.month++;

        if ( Main.month > 12 ) {
            
            Main.year++;
            
            Main.month = 1;
            
        }
        
        // Display calendar
        show_calendar( Main.month, Main.day, Main.year, Main.format);
        
    });
    
    /*
     * Filter hours
     */
    jQuery( '#filter-hours' ).on( 'keyup', function() {
        
        var value = jQuery(this).val().toLowerCase();
        
        jQuery( '#time-format li' ).filter(function() {
            
            jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1);
            
        });
        
    });
    
    /*
     * Display calendar months
     */
    function show_year( month, year ) {
        
        // Set months
        var months = [ '' , translation.mu327, translation.mu328, translation.mu329, translation.mu330, translation.mu331, translation.mu332, translation.mu333, translation.mu334, translation.mu335, translation.mu336, translation.mu337, translation.mu338];
        
        // Add months
        jQuery( '.year-month' ).text( months[month] + ' ' + year );
        
    }
    
    /*
     * Display calendar
     */
    function show_calendar( month, day, year, format ) {
        
        // Display months
        show_year( month, year );
        
        // Set current date
        var current = new Date();
        
        var d = new Date(year, month, 0);
        
        var e = new Date(d.getFullYear(), d.getMonth(), 1);
        
        var fday = e.getDay();
        
        var show = 1;

        if ( format < 1 ) {

            jQuery( '.midrub-caledar' ).addClass( 'usa' );
            
            var n = '<tr><td style="width: 14.28%;">' + translation.mu339 + '</td><td style="width: 14.28%;">' + translation.mu340 + '</td><td style="width: 14.28%;">' + translation.mu341 + '</td><td style="width: 14.28%;">' + translation.mu342 + '</td><td style="width: 14.28%;">' + translation.mu343 + '</td><td style="width: 14.28%;">' + translation.mu344 + '</td><td style="width: 14.28%;">' + translation.mu345 + '</td></tr><tr>';

            var hours = '<li class="list-group-item" data-hours="0" data-minutes="0">00:00 AM</li><li class="list-group-item" data-hours="0" data-minutes="15">00:15 AM</li><li class="list-group-item" data-hours="0" data-minutes="30">00:30 AM</li><li class="list-group-item" data-hours="0" data-minutes="45">00:45 AM</li><li class="list-group-item" data-hours="1" data-minutes="0">01:00 AM</li><li class="list-group-item" data-hours="1" data-minutes="15">01:15 AM</li><li class="list-group-item" data-hours="1" data-minutes="30">01:30 AM</li><li class="list-group-item" data-hours="1" data-minutes="45">01:45 AM</li><li class="list-group-item" data-hours="2" data-minutes="0">02:00 AM</li><li class="list-group-item" data-hours="2" data-minutes="15">02:15 AM</li><li class="list-group-item" data-hours="2" data-minutes="30">02:30 AM</li><li class="list-group-item" data-hours="2" data-minutes="45">02:45 AM</li><li class="list-group-item" data-hours="3" data-minutes="0">03:00 AM</li><li class="list-group-item" data-hours="3" data-minutes="15">03:15 AM</li><li class="list-group-item" data-hours="3" data-minutes="30">03:30 AM</li><li class="list-group-item" data-hours="3" data-minutes="45">03:45 AM</li><li class="list-group-item" data-hours="4" data-minutes="0">04:00 AM</li><li class="list-group-item" data-hours="4" data-minutes="15">04:15 AM</li><li class="list-group-item" data-hours="4" data-minutes="30">04:30 AM</li><li class="list-group-item" data-hours="4" data-minutes="45">04:45 AM</li><li class="list-group-item" data-hours="5" data-minutes="0">05:00 AM</li><li class="list-group-item" data-hours="5" data-minutes="15">05:15 AM</li><li class="list-group-item" data-hours="5" data-minutes="30">05:30 AM</li><li class="list-group-item" data-hours="5" data-minutes="45">05:45 AM</li><li class="list-group-item" data-hours="6" data-minutes="0">06:00 AM</li><li class="list-group-item" data-hours="6" data-minutes="15">06:15 AM</li><li class="list-group-item" data-hours="6" data-minutes="30">06:30 AM</li><li class="list-group-item" data-hours="6" data-minutes="45">06:45 AM</li><li class="list-group-item" data-hours="7" data-minutes="0">07:00 AM</li><li class="list-group-item" data-hours="7" data-minutes="15">07:15 AM</li><li class="list-group-item" data-hours="7" data-minutes="30">07:30 AM</li><li class="list-group-item" data-hours="7" data-minutes="45">07:45 AM</li><li class="list-group-item default-selected selected-time" data-hours="8" data-minutes="0">08:00 AM</li><li class="list-group-item" data-hours="8" data-minutes="15">08:15 AM</li><li class="list-group-item" data-hours="8" data-minutes="30">08:30 AM</li><li class="list-group-item" data-hours="8" data-minutes="45">08:45 AM</li><li class="list-group-item" data-hours="9" data-minutes="0">09:00 AM</li><li class="list-group-item" data-hours="9" data-minutes="15">09:15 AM</li><li class="list-group-item" data-hours="9" data-minutes="30">09:30 AM</li><li class="list-group-item" data-hours="9" data-minutes="45">09:45 AM</li><li class="list-group-item" data-hours="10" data-minutes="0">10:00 AM</li><li class="list-group-item" data-hours="10" data-minutes="15">10:15 AM</li><li class="list-group-item" data-hours="10" data-minutes="30">10:30 AM</li><li class="list-group-item" data-hours="10" data-minutes="45">10:45 AM</li><li class="list-group-item" data-hours="11" data-minutes="0">11:00 AM</li><li class="list-group-item" data-hours="11" data-minutes="15">11:15 AM</li><li class="list-group-item" data-hours="11" data-minutes="30">11:30 AM</li><li class="list-group-item" data-hours="11" data-minutes="45">11:45 AM</li><li class="list-group-item" data-hours="12" data-minutes="0">12:00 PM</li><li class="list-group-item" data-hours="12" data-minutes="15">12:15 PM</li><li class="list-group-item" data-hours="12" data-minutes="30">12:30 PM</li><li class="list-group-item" data-hours="12" data-minutes="45">12:45 PM</li><li class="list-group-item" data-hours="13" data-minutes="0">01:00 PM</li><li class="list-group-item" data-hours="13" data-minutes="15">01:15 PM</li><li class="list-group-item" data-hours="13" data-minutes="30">01:30 PM</li><li class="list-group-item" data-hours="13" data-minutes="45">01:45 PM</li><li class="list-group-item" data-hours="14" data-minutes="0">02:00 PM</li><li class="list-group-item" data-hours="14" data-minutes="15">02:15 PM</li><li class="list-group-item" data-hours="14" data-minutes="30">02:30 PM</li><li class="list-group-item" data-hours="14" data-minutes="45">02:45 PM</li><li class="list-group-item" data-hours="15" data-minutes="0">03:00 PM</li><li class="list-group-item" data-hours="15" data-minutes="15">03:15 PM</li><li class="list-group-item" data-hours="15" data-minutes="30">03:30 PM</li><li class="list-group-item" data-hours="15" data-minutes="45">03:45 PM</li><li class="list-group-item" data-hours="16" data-minutes="0">04:00 PM</li><li class="list-group-item" data-hours="16" data-minutes="15">04:15 PM</li><li class="list-group-item" data-hours="16" data-minutes="30">04:30 PM</li><li class="list-group-item" data-hours="16" data-minutes="45">04:45 PM</li><li class="list-group-item" data-hours="17" data-minutes="0">05:00 PM</li><li class="list-group-item" data-hours="17" data-minutes="15">05:15 PM</li><li class="list-group-item" data-hours="17" data-minutes="30">05:30 PM</li><li class="list-group-item" data-hours="17" data-minutes="45">05:45 PM</li><li class="list-group-item" data-hours="18" data-minutes="0">06:00 PM</li><li class="list-group-item" data-hours="18" data-minutes="15">06:15 PM</li><li class="list-group-item" data-hours="18" data-minutes="30">06:30 PM</li><li class="list-group-item" data-hours="18" data-minutes="45">06:45 PM</li><li class="list-group-item" data-hours="19" data-minutes="0">07:00 PM</li><li class="list-group-item" data-hours="19" data-minutes="15">07:15 PM</li><li class="list-group-item" data-hours="19" data-minutes="30">07:30 PM</li><li class="list-group-item" data-hours="19" data-minutes="45">07:45 PM</li><li class="list-group-item" data-hours="20" data-minutes="0">08:00 PM</li><li class="list-group-item" data-hours="20" data-minutes="15">08:15 PM</li><li class="list-group-item" data-hours="20" data-minutes="30">08:30 PM</li><li class="list-group-item" data-hours="20" data-minutes="45">08:45 PM</li><li class="list-group-item" data-hours="21" data-minutes="0">09:00 PM</li><li class="list-group-item" data-hours="21" data-minutes="15">09:15 PM</li><li class="list-group-item" data-hours="21" data-minutes="30">09:30 PM</li><li class="list-group-item" data-hours="21" data-minutes="45">09:45 PM</li><li class="list-group-item" data-hours="22" data-minutes="0">10:00 PM</li><li class="list-group-item" data-hours="22" data-minutes="15">10:15 PM</li><li class="list-group-item" data-hours="22" data-minutes="30">10:30 PM</li><li class="list-group-item" data-hours="22" data-minutes="45">10:45 PM</li><li class="list-group-item" data-hours="23" data-minutes="0">11:00 PM</li><li class="list-group-item" data-hours="23" data-minutes="15">11:15 PM</li><li class="list-group-item" data-hours="23" data-minutes="30">11:30 PM</li><li class="list-group-item" data-hours="23" data-minutes="45">11:45 PM</li><li class="list-group-item" data-hours="0" data-minutes="0">12:00 AM</li>';

            jQuery( '#time-format' ).html( hours );

        } else {

            jQuery( '.midrub-caledar' ).addClass( 'iso' );
            
            var n = '<tr><td style="width: 14.28%;">' + translation.mu340 + '</td><td style="width: 14.28%;">' + translation.mu341 + '</td><td style="width: 14.28%;">' + translation.mu342 + '</td><td style="width: 14.28%;">' + translation.mu343 + '</td><td style="width: 14.28%;">' + translation.mu344 + '</td><td style="width: 14.28%;">' + translation.mu345 + '</td><td style="width: 14.28%;">' + translation.mu339 + '</td></tr><tr>';

            var hours = '<li class="list-group-item" data-hours="0" data-minutes="0">00:00</li><li class="list-group-item" data-hours="0" data-minutes="15">00:15</li><li class="list-group-item" data-hours="0" data-minutes="30">00:30</li><li class="list-group-item" data-hours="0" data-minutes="45">00:45</li><li class="list-group-item" data-hours="1" data-minutes="0">01:00</li><li class="list-group-item" data-hours="1" data-minutes="15">01:15</li><li class="list-group-item" data-hours="1" data-minutes="30">01:30</li><li class="list-group-item" data-hours="1" data-minutes="45">01:45</li><li class="list-group-item" data-hours="2" data-minutes="0">02:00</li><li class="list-group-item" data-hours="2" data-minutes="15">02:15</li><li class="list-group-item" data-hours="2" data-minutes="30">02:30</li><li class="list-group-item" data-hours="2" data-minutes="45">02:45</li><li class="list-group-item" data-hours="3" data-minutes="0">03:00</li><li class="list-group-item" data-hours="3" data-minutes="15">03:15</li><li class="list-group-item" data-hours="3" data-minutes="30">03:30</li><li class="list-group-item" data-hours="3" data-minutes="45">03:45</li><li class="list-group-item" data-hours="4" data-minutes="0">04:00</li><li class="list-group-item" data-hours="4" data-minutes="15">04:15</li><li class="list-group-item" data-hours="4" data-minutes="30">04:30</li><li class="list-group-item" data-hours="4" data-minutes="45">04:45</li><li class="list-group-item" data-hours="5" data-minutes="0">05:00</li><li class="list-group-item" data-hours="5" data-minutes="15">05:15</li><li class="list-group-item" data-hours="5" data-minutes="30">05:30</li><li class="list-group-item" data-hours="5" data-minutes="45">05:45</li><li class="list-group-item" data-hours="6" data-minutes="0">06:00</li><li class="list-group-item" data-hours="6" data-minutes="15">06:15</li><li class="list-group-item" data-hours="6" data-minutes="30">06:30</li><li class="list-group-item" data-hours="6" data-minutes="45">06:45</li><li class="list-group-item" data-hours="7" data-minutes="0">07:00</li><li class="list-group-item" data-hours="7" data-minutes="15">07:15</li><li class="list-group-item" data-hours="7" data-minutes="30">07:30</li><li class="list-group-item" data-hours="7" data-minutes="45">07:45</li><li class="list-group-item default-selected selected-time" data-hours="8" data-minutes="0">08:00</li><li class="list-group-item" data-hours="8" data-minutes="15">08:15</li><li class="list-group-item" data-hours="8" data-minutes="30">08:30</li><li class="list-group-item" data-hours="8" data-minutes="45">08:45</li><li class="list-group-item" data-hours="9" data-minutes="0">09:00</li><li class="list-group-item" data-hours="9" data-minutes="15">09:15</li><li class="list-group-item" data-hours="9" data-minutes="30">09:30</li><li class="list-group-item" data-hours="9" data-minutes="45">09:45</li><li class="list-group-item" data-hours="10" data-minutes="0">10:00</li><li class="list-group-item" data-hours="10" data-minutes="15">10:15</li><li class="list-group-item" data-hours="10" data-minutes="30">10:30</li><li class="list-group-item" data-hours="10" data-minutes="45">10:45</li><li class="list-group-item" data-hours="11" data-minutes="0">11:00</li><li class="list-group-item" data-hours="11" data-minutes="15">11:15</li><li class="list-group-item" data-hours="11" data-minutes="30">11:30</li><li class="list-group-item" data-hours="11" data-minutes="45">11:45</li><li class="list-group-item" data-hours="12" data-minutes="0">12:00</li><li class="list-group-item" data-hours="12" data-minutes="15">12:15</li><li class="list-group-item" data-hours="12" data-minutes="30">12:30</li><li class="list-group-item" data-hours="12" data-minutes="45">12:45</li><li class="list-group-item" data-hours="13" data-minutes="0">13:00</li><li class="list-group-item" data-hours="13" data-minutes="15">13:15</li><li class="list-group-item" data-hours="13" data-minutes="30">13:30</li><li class="list-group-item" data-hours="13" data-minutes="45">13:45</li><li class="list-group-item" data-hours="14" data-minutes="0">14:00</li><li class="list-group-item" data-hours="14" data-minutes="15">14:15</li><li class="list-group-item" data-hours="14" data-minutes="30">14:30</li><li class="list-group-item" data-hours="14" data-minutes="45">14:45</li><li class="list-group-item" data-hours="15" data-minutes="0">15:00</li><li class="list-group-item" data-hours="15" data-minutes="15">15:15</li><li class="list-group-item" data-hours="15" data-minutes="30">15:30</li><li class="list-group-item" data-hours="15" data-minutes="45">15:45</li><li class="list-group-item" data-hours="16" data-minutes="0">16:00</li><li class="list-group-item" data-hours="16" data-minutes="15">16:15</li><li class="list-group-item" data-hours="16" data-minutes="30">16:30</li><li class="list-group-item" data-hours="16" data-minutes="45">16:45</li><li class="list-group-item" data-hours="17" data-minutes="0">17:00</li><li class="list-group-item" data-hours="17" data-minutes="15">17:15</li><li class="list-group-item" data-hours="17" data-minutes="30">17:30</li><li class="list-group-item" data-hours="17" data-minutes="45">17:45</li><li class="list-group-item" data-hours="18" data-minutes="0">18:00</li><li class="list-group-item" data-hours="18" data-minutes="15">18:15</li><li class="list-group-item" data-hours="18" data-minutes="30">18:30</li><li class="list-group-item" data-hours="18" data-minutes="45">18:45</li><li class="list-group-item" data-hours="19" data-minutes="0">19:00</li><li class="list-group-item" data-hours="19" data-minutes="15">19:15</li><li class="list-group-item" data-hours="19" data-minutes="30">19:30</li><li class="list-group-item" data-hours="19" data-minutes="45">19:45</li><li class="list-group-item" data-hours="20" data-minutes="0">20:00</li><li class="list-group-item" data-hours="20" data-minutes="15">20:15</li><li class="list-group-item" data-hours="20" data-minutes="30">20:30</li><li class="list-group-item" data-hours="20" data-minutes="45">20:45</li><li class="list-group-item" data-hours="21" data-minutes="0">21:00</li><li class="list-group-item" data-hours="21" data-minutes="15">21:15</li><li class="list-group-item" data-hours="21" data-minutes="30">21:30</li><li class="list-group-item" data-hours="21" data-minutes="45">21:45</li><li class="list-group-item" data-hours="22" data-minutes="0">22:00</li><li class="list-group-item" data-hours="22" data-minutes="15">22:15</li><li class="list-group-item" data-hours="22" data-minutes="30">22:30</li><li class="list-group-item" data-hours="22" data-minutes="45">22:45</li><li class="list-group-item" data-hours="23" data-minutes="0">23:00</li><li class="list-group-item" data-hours="23" data-minutes="15">23:15</li><li class="list-group-item" data-hours="23" data-minutes="30">23:30</li><li class="list-group-item" data-hours="23" data-minutes="45">23:45</li><li class="list-group-item" data-hours="0" data-minutes="0">24:00</li>';

            jQuery( '#time-format' ).html( hours );

        }

        for ( var s = format; s < d.getDate() + fday; s++ ) {

            if ( format ) {

                var tu = s - 1;

            } else {

                var tu = s;

            }

            if ( tu % 7 == 0 ) {

                n += '</tr><tr>';

            }
            if ( fday <= s ) {

                var add_date = '';

                if ( year + '-' + month + '-' + show === Main.selected_date ) {

                    add_date = ' add-date';

                }
                
                if ( ( show === day ) && ( month === current.getMonth() + 1 ) && ( year === current.getFullYear() ) ) {
                    
                    
                    n += '<td><a href="#" class="current-day' + add_date + '" data-date="' + year + '-' + month + '-' + show + '">' + show + '</a></td>';

                } else {

                    if ( ( ( show < day ) && ( month === current.getMonth() + 1 ) && ( year == current.getFullYear() ) ) || ( ( ( month < current.getMonth() + 1 ) && ( year <= current.getFullYear() ) ) || ( year < current.getFullYear() ) ) ) {

                        n += '<td><a href="" class="past-days">' + show + '</a></td>';

                    } else {

                        n += '<td><a href="" data-date="' + year + '-' + month + '-' + show + '" class="' + add_date + '">' + show + '</a></td>';

                    }

                }

                show++;

            } else {

                n += '<td></td>';

            }

        }
        
        n += '</tr>';
        
        jQuery( '.calendar-dates' ).html( n );
    }

});