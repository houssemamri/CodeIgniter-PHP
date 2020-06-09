var url = jQuery('.navbar-brand').attr('href');
function calculate_time(from, to) {
    'use strict';
    // this function will calculates time between two dates
    var calculate = to - from;
    var after = ' ';
    var before = ' '+translation.mm104;
    var calc;
    if (calculate < 0) {
        calculate = Math.abs(calculate);
        after = '<i class="fa fa-calendar-check-o" aria-hidden="true"></i> ';
        before = '';
    }
    if (calculate < 60) {
        return after + translation.mm105;
    } else if (calculate < 3600) {
        calc = calculate / 60;
        calc = Math.round(calc);
        return after + calc + ' ' + translation.mm106 + before;
    } else if (calculate < 86400) {
        calc = calculate / 3600;
        calc = Math.round(calc);
        return after + calc + ' ' + translation.mm107 + before;
    } else if (calculate >= 86400) {
        calc = calculate / 86400;
        calc = Math.round(calc);
        return after + calc + ' '+ translation.mm103 + before;
    }
}
jQuery('.optionvalue').keyup(function () {
    var id = jQuery(this).attr('id');
    var value = jQuery(this).val();
    if (!value)
        value = 'empty-option';
    value = btoa(value);
    value = value.replace('/', '-');
    value = value.replace(/=/g, '');
    add_value_to_option(id, value);
});
jQuery(document).on('change','.optionvalue',function () {
    var id = jQuery(this).attr('id');
    var value = jQuery(this).val();
    if (!value)
        value = 'empty-option';
    value = btoa(value);
    value = value.replace('/', '-');
    value = value.replace(/=/g, '');
    add_value_to_option(id, value);
});
function add_value_to_option(option, value) {
    // submit data via ajax
    jQuery.ajax({
        url: url + 'admin/option/' + option + '/' + value,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data !== 1) {
                jQuery('.alert-msg').show();
                jQuery('.alert-msg').html(data);
                jQuery('.merror').fadeIn(1000).delay(2000).fadeOut(1000, function () {
                    jQuery('.merror').remove();
                    jQuery('.alert-msg').hide();
                });
            }
        },
        error: function (data, jqXHR, textStatus) {
            console.log('Request failed:' + textStatus);
        }
    });
}
function popup_fon(cl,msg,ft,lt) {
    var te = '<div class="modal-backdrop fade in"></div>';
    jQuery(te).insertAfter('section');
    jQuery('<div class="md-message ' + cl + '"><i class="fa fa-bell-o" aria-hidden="true"></i> ' + msg + '</div>').insertAfter('section');
    setTimeout(function() {
        jQuery(document).find('.md-message').animate({marginTop:'-100',opacity:'0'},500);
    }, ft);
    setTimeout(function() {
        jQuery(document).find('.md-message').remove();
        jQuery(document).find('.modal-backdrop').remove();
    }, lt);
}
jQuery(document).ready(function () {
    jQuery('.short-menu').click(function () {
        jQuery('nav').toggle('slow');
    });
    // Set up nav height only if the height screen is less than 701 px
    if (jQuery(window).height() < 701) {
        var height = jQuery(document).height() + 100;
        jQuery('nav').css('height', height + 'px');
    }
    jQuery(document).on('click', '.settings .spinner .btn:first-of-type', function () {
        var id = jQuery(this).attr('data-id');
        jQuery('#'+id).val(parseInt(jQuery(this).closest('.spinner').find('input').val(), 10) + 1);
        jQuery('#'+id).keyup();
    });
    jQuery(document).on('click', '.settings .spinner .btn:last-of-type', function () {
        var id = jQuery(this).attr('data-id');
        jQuery('#'+id).val(parseInt(jQuery(this).closest('.spinner').find('input').val(), 10) - 1);
        jQuery('#'+id).keyup();
    });
    jQuery(document).on('click', '.users .list-group>li>.question', function () {
        jQuery(this).closest('li').find('.answer').toggle('slow');
        if (jQuery(this).closest('li').find('.fa-chevron-down').length > 0) {
            jQuery(this).closest('li').find('.fa-chevron-down').addClass('fa-chevron-up');
            jQuery(this).closest('li').find('.fa-chevron-up').removeClass('fa-chevron-down');
        }
        else {
            jQuery(this).closest('li').find('.fa-chevron-up').addClass('fa-chevron-down');
            jQuery(this).closest('li').find('.fa-chevron-down').removeClass('fa-chevron-up');
        }
    });
});