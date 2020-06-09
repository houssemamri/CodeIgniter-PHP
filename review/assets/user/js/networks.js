jQuery(document).ready(function ()
{
    'use strict';
    //var url = jQuery('.navbar-brand').attr('href');
	var url=jQuery('#base_url').val();
    var accounts = {
        'page': 1,
        'limit': 10,
        'rsearch': jQuery('.search_accounts').val(),
    };
    jQuery('.openpopup').click(function (e)
    {
        // this function allows to open the get url token in a popup
        e.preventDefault();
        jQuery(this).closest('ul').find('.upim').show();
        window.open(jQuery(this).attr('href'), translation.mm138, 'width=800,height=500');
    });
    jQuery('.search_accounts').keyup(function ()
    {
        // this function searches accounts
        var key = jQuery('.search_accounts').val();
        if (!key)
        {
            return false;
        }
        var network = jQuery('.search_accounts').attr('data-network');
        // change search icon
        jQuery('.search-m').addClass('search-active');
        social_results(network, key);
    });
    jQuery(document).on('click', '.search-active', function (e)
    {
        e.preventDefault();
        var key = '';
        jQuery('.search_accounts').val('');
        jQuery('.search-m').removeClass('search-active');
        var network = jQuery('.search_accounts').attr('data-network');
        social_results(network, key);
    });
    jQuery(document).on('click', '.save-token', function ()
    {
        // this function will save the enter token
        var $this = jQuery(this);
        var network = $this.closest('li').attr('data-network');
        var token = $this.closest('li').find('.token').val();
        var encode = btoa(token);
        encode = encode.replace('/', '-');
        var cleanURL = encode.replace(/=/g, '');
        jQuery.ajax({
            url: url + 'user/save-token/' + network + '/' + cleanURL,
            dataType: 'json',
            type: 'GET',
            success: function (data)
            {
                if (data === 1)
                {
                    document.location.href = document.location.href;
                }
                else
                {
                    $this.closest('li').find('.token').val('');
                    $this.closest('li').find('.token').attr('placeholder', data);
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                $this.closest('li').find('.token').val('');
                $this.closest('li').find('.token').attr('placeholder', translation.mm3);
            }
        });
    });
    jQuery(document).on('click', '.pagination li a', function (e)
    {
        e.preventDefault();
        accounts.page = jQuery(this).attr('data-page');
        results(jQuery('.search_accounts').attr('data-network'), jQuery(this).attr('data-page'), jQuery('.search_accounts').val());
    });
    function show_pagination(total)
    {
        // the code bellow displays pagination
        jQuery('.pagination').empty();
        if (parseInt(accounts.page) > 1)
        {
            var bac = parseInt(accounts.page) - 1;
            var pages = '<li><a href="#" data-page="' + bac + '">'+translation.mm128+'</a></li>';
        }
        else
        {
            var pages = '<li class="pagehide"><a href="#">'+translation.mm128+'</a></li>';
        }
        var tot = parseInt(total) / parseInt(accounts.limit);
        tot = Math.ceil(tot) + 1;
        var from = (parseInt(accounts.page) > 2) ? parseInt(accounts.page) - 2 : 1;
        for (var p = from; p < parseInt(tot); p++)
        {
            if (p === parseInt(accounts.page))
            {
                pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
            }
            else if ((p < parseInt(accounts.page) + 3) && (p > parseInt(accounts.page) - 3))
            {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            }
            else if ((p < 6) && (Math.round(tot) > 5) && ((parseInt(accounts.page) == 1) || (parseInt(accounts.page) == 2)))
            {
                pages += '<li><a href="#" data-page="' + p + '">' + p + '</a></li>';
            }
            else
            {
                break;
            }
        }
        if (p === 1)
        {
            pages += '<li class="active"><a data-page="' + p + '">' + p + '</a></li>';
        }
        var next = parseInt(accounts.page);
        next++;
        if (next < Math.round(tot))
        {
            jQuery(".pagination").html(pages + '<li><a href="#" data-page="' + next + '">'+translation.mm129+'</a></li>');
        }
        else
        {
            jQuery(".pagination").html(pages + '<li class="pagehide"><a href="#">'+translation.mm129+'</a></li>');
        }
    }
    function social_results(network, key)
    {
        // get accounts from db
        key = btoa(encodeURIComponent(key));
        key = key.replace('/', '-');
        key = key.replace(/=/g, '');
        jQuery.ajax({
            url: url + 'user/search-accounts/' + network + '/' + key,
            type: 'GET',
            dataType: 'json',
            success: function (data)
            {
                if (data.accounts[0].user_name)
                {
                    accounts.page = 1;
                    show_pagination(data.total);
                    var allaccounts = '';
                    for (var u = 0; u < data.total; u++)
                    {
                        if (data.accounts[u])
                        {
                            var date = data.accounts[u].expires;
                            var expires = '<strong>'+translation.mm125+'</strong>'
                            if (date.trim())
                            {
                                date = date.substr(0, 19);
                                expires = '<strong>' + date + '</strong>';
                            }
                            allaccounts += '<li><div class="col-md-10 clean"><h3>' + data.accounts[u].user_name + '</h3><span class="expires">'+translation.mm126+' ' + expires + '</span></div><div class="col-md-2 text-right clean"><a href="' + url + 'user/disconnect/' + data.accounts[u].network_id + '" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> '+translation.mm133+'</a></div></li>';
                        }
                    }
                    jQuery('.social-accounts').html(allaccounts);
                }
                else
                {
                    jQuery('.social-accounts').html('<p>'+translation.mm127+'</p>');
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed: ' + textStatus);
                jQuery('.social-accounts').html('<p>'+translation.mm127+'</p>');
            }
        });
    }
    function results(network, page, searchm)
    {
        // display accounts by page
        var burl = url + 'user/show-accounts/' + network + '/' + page;
        if (searchm)
        {
            burl = url + 'user/show-accounts/' + network + '/' + page + '/' + searchm;
        }
        jQuery.ajax({
            url: burl,
            dataType: 'json',
            type: 'GET',
            beforeSend: function ()
            {
                if (jQuery(document).width() > 700)
                    jQuery('.pageload').show();
            },
            success: function (data)
            {
                if (data.accounts[0].user_name)
                {
                    show_pagination(data.total);
                    var allaccounts = '';
                    for (var u = 0; u < data.total; u++)
                    {
                        if (data.accounts[u])
                        {
                            var date = data.accounts[u].expires;
                            var expires = '<strong>'+translation.mm125+'</strong>'
                            if (date.trim())
                            {
                                date = date.substr(0, 19);
                                expires = '<strong>' + date + '</strong>';
                            }
                            allaccounts += '<li><div class="col-md-10 clean"><h3>' + data.accounts[u].user_name + '</h3><span class="expires">'+translation.mm126+' ' + expires + '</span></div><div class="col-md-2 text-right clean"><a href="' + url + 'user/disconnect/' + data.accounts[u].network_id + '" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> '+translation.mm133+'</a></div></li>';
                        }
                    }
                    jQuery('.social-accounts').html(allaccounts);
                }
                else
                {
                    jQuery('.social-accounts').html('<p>'+translation.mm127+'</p>');
                }
            },
            error: function (data, jqXHR, textStatus)
            {
                console.log('Request failed: ' + textStatus);
                jQuery('.social-accounts').html('<p>'+translation.mm127+'</p>');
            },
            complete: function ()
            {
                jQuery('.pageload').fadeOut('slow');
            },
        });
    }
    if (jQuery('.search_accounts').length > 0)
    {
        results(jQuery('.search_accounts').attr('data-network'), 1)
    }
});