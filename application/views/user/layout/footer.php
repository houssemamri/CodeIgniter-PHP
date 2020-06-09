<script language="javascript">
    // Encode special characters
    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    
    // Translation characters
    var translation = {"mm103":htmlEntities("<?= $this->lang->line("mm103"); ?>"),"mm104":htmlEntities("<?= $this->lang->line("mm104"); ?>"),"mm105":htmlEntities("<?= $this->lang->line("mm105"); ?>"),"mm106":htmlEntities("<?= $this->lang->line("mm106"); ?>"),"mm107":htmlEntities("<?= $this->lang->line("mm107"); ?>"),"mm108":htmlEntities("<?= $this->lang->line("mm108"); ?>"),"mm109":htmlEntities("<?= $this->lang->line("mm109"); ?>"),"mm110":htmlEntities("<?= $this->lang->line("mm110"); ?>"),"mm3":htmlEntities("<?= $this->lang->line("mm3"); ?>"),"mm111":htmlEntities("<?= $this->lang->line("mm111"); ?>"),"mm112":htmlEntities("<?= $this->lang->line("mm112"); ?>"),"mm113":htmlEntities("<?= $this->lang->line("mm113"); ?>"),"mm114":htmlEntities("<?= $this->lang->line("mm114"); ?>"),"mm115":htmlEntities("<?= $this->lang->line("mm115"); ?>"),"mm116":htmlEntities("<?= $this->lang->line("mm116"); ?>"),"mm117":htmlEntities("<?= $this->lang->line("mm117"); ?>"),"mm118":htmlEntities("<?= $this->lang->line("mm118"); ?>"),"mm119":htmlEntities("<?= $this->lang->line("mm119"); ?>"),"mm120":htmlEntities("<?= $this->lang->line("mm120"); ?>"),"mm121":htmlEntities("<?= $this->lang->line("mm121"); ?>"),"mm122":htmlEntities("<?= $this->lang->line("mm122"); ?>"),"mm123":htmlEntities("<?= $this->lang->line("mm123"); ?>"),"mm124":htmlEntities("<?= $this->lang->line("mm124"); ?>"),"mm125":htmlEntities("<?= $this->lang->line("mm125"); ?>"),"mm126":htmlEntities("<?= $this->lang->line("mm126"); ?>"),"mm127":htmlEntities("<?= $this->lang->line("mm127"); ?>"),"mm128":htmlEntities("<?= $this->lang->line("mm128"); ?>"),"mm129":htmlEntities("<?= $this->lang->line("mm129"); ?>"),"mm130":htmlEntities("<?= $this->lang->line("mm130"); ?>"),"mm131":htmlEntities("<?= $this->lang->line("mm131"); ?>"),"mm132":htmlEntities("<?= $this->lang->line("mm132"); ?>"),"mm133":htmlEntities("<?= $this->lang->line("mm133"); ?>"),"mm134":htmlEntities("<?= $this->lang->line("mm134"); ?>"),"mm135":htmlEntities("<?= $this->lang->line("mm135"); ?>"),"mm136":htmlEntities("<?= $this->lang->line("mm136"); ?>"),"mm137":htmlEntities("<?= $this->lang->line("mm137"); ?>"),"mm138":htmlEntities("<?= $this->lang->line("mm138"); ?>"),"mm139":htmlEntities("<?= $this->lang->line("mm139"); ?>"),"mm146":htmlEntities("<?= $this->lang->line("mm146"); ?>"),"mm147":htmlEntities("<?= $this->lang->line("mm147"); ?>"),"mm148":htmlEntities("<?= $this->lang->line("mm148"); ?>"),"mm149":htmlEntities("<?= $this->lang->line("mm149"); ?>"),"mm150":htmlEntities("<?= $this->lang->line("mm150"); ?>"),"mm151":htmlEntities("<?= $this->lang->line("mm151"); ?>"),"mm152":htmlEntities("<?= $this->lang->line("mm152"); ?>"),"mm153":htmlEntities("<?= $this->lang->line("mm153"); ?>"),"mm154":htmlEntities("<?= $this->lang->line("mm154"); ?>"),"mm155":htmlEntities("<?= $this->lang->line("mm155"); ?>"),"mm156":htmlEntities("<?= $this->lang->line("mm156"); ?>"),"mm157":htmlEntities("<?= $this->lang->line("mm157"); ?>"),"mm158":htmlEntities("<?= $this->lang->line("mm158"); ?>"),"mm159":htmlEntities("<?= $this->lang->line("mm159"); ?>"),"mm160":htmlEntities("<?= $this->lang->line("mm160"); ?>"),"mm161":htmlEntities("<?= $this->lang->line("mm161"); ?>"),"mm162":htmlEntities("<?= $this->lang->line("mm162"); ?>"),"mm163":htmlEntities("<?= $this->lang->line("mm163"); ?>"),"mm164":htmlEntities("<?= $this->lang->line("mm164"); ?>"),"mm179":htmlEntities("<?= $this->lang->line("mm179"); ?>"),"mm180":htmlEntities("<?= $this->lang->line("mm180"); ?>"),"mu193":htmlEntities("<?= $this->lang->line("mu193"); ?>"),"mu194":htmlEntities("<?= $this->lang->line("mu194"); ?>"),"mu195":htmlEntities("<?= $this->lang->line("mu195"); ?>"),"mu196":htmlEntities("<?= $this->lang->line("mu196"); ?>"),"mu197":htmlEntities("<?= $this->lang->line("mu197"); ?>"),"mu198":htmlEntities("<?= $this->lang->line("mu198"); ?>"),"mu199":htmlEntities("<?= $this->lang->line("mu199"); ?>"),"mu200":htmlEntities("<?= $this->lang->line("mu200"); ?>"),"mu201":htmlEntities("<?= $this->lang->line("mu201"); ?>"),"mu202":htmlEntities("<?= $this->lang->line("mu202"); ?>"),"mu203":htmlEntities("<?= $this->lang->line("mu203"); ?>"),"mu204":htmlEntities("<?= $this->lang->line("mu204"); ?>"),"mu205":htmlEntities("<?= $this->lang->line("mu205"); ?>"),"mm190":htmlEntities("<?= $this->lang->line("mm190"); ?>"),"mu42":htmlEntities("<?= $this->lang->line("mu42"); ?>"),"mu206":htmlEntities("<?= $this->lang->line("mu206"); ?>"),"mm191":htmlEntities("<?= $this->lang->line("mm191"); ?>"),"mm193":htmlEntities("<?= $this->lang->line("mm193"); ?>"),"mm194":htmlEntities("<?= $this->lang->line("mm194"); ?>"),"mm195":htmlEntities("<?= $this->lang->line("mm195"); ?>"),"mm196":htmlEntities("<?= $this->lang->line("mm196"); ?>"),"mm199":htmlEntities("<?= $this->lang->line("mm199"); ?>"),"mm201":htmlEntities("<?= $this->lang->line("mm201"); ?>"),"mu3":htmlEntities("<?= $this->lang->line("mu3"); ?>")};
</script>
<?php if ($this->router->fetch_method() == 'posts' || $this->router->fetch_method() == 'emails'): ?>
<script language="javascript">
    translation.mu327 = htmlEntities("<?= $this->lang->line('mu327'); ?>");
    translation.mu328 = htmlEntities("<?= $this->lang->line('mu328'); ?>");
    translation.mu329 = htmlEntities("<?= $this->lang->line('mu329'); ?>");
    translation.mu330 = htmlEntities("<?= $this->lang->line('mu330'); ?>");
    translation.mu331 = htmlEntities("<?= $this->lang->line('mu331'); ?>");
    translation.mu332 = htmlEntities("<?= $this->lang->line('mu332'); ?>");
    translation.mu333 = htmlEntities("<?= $this->lang->line('mu333'); ?>");
    translation.mu334 = htmlEntities("<?= $this->lang->line('mu334'); ?>");
    translation.mu335 = htmlEntities("<?= $this->lang->line('mu335'); ?>");
    translation.mu336 = htmlEntities("<?= $this->lang->line('mu336'); ?>");
    translation.mu337 = htmlEntities("<?= $this->lang->line('mu337'); ?>");
    translation.mu338 = htmlEntities("<?= $this->lang->line('mu338'); ?>");
    translation.mu339 = htmlEntities("<?= $this->lang->line('mu339'); ?>");
    translation.mu340 = htmlEntities("<?= $this->lang->line('mu340'); ?>");
    translation.mu341 = htmlEntities("<?= $this->lang->line('mu341'); ?>");
    translation.mu342 = htmlEntities("<?= $this->lang->line('mu342'); ?>");
    translation.mu343 = htmlEntities("<?= $this->lang->line('mu343'); ?>");
    translation.mu344 = htmlEntities("<?= $this->lang->line('mu344'); ?>");
    translation.mu345 = htmlEntities("<?= $this->lang->line('mu345'); ?>");
</script>
<?php endif; ?>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<!--script src="<?= base_url(); ?>assets/js/bootstrap.js"></script-->
<script src="<?= base_url(); ?>assets/user/js/main.js?ver=<?= MD_VER ?>"></script>
<?php if ($this->router->fetch_method() == 'notifications'): ?>
<script src="<?= base_url(); ?>assets/user/js/notifications.js?ver=<?= MD_VER ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'posts' || $this->router->fetch_method() == 'history'): ?>
<script src="<?= base_url(); ?>assets/js/raphael-min.js"></script> 
<script src="<?= base_url(); ?>assets/js/morris-0.4.1.min.js"></script> 
<script src="<?= base_url(); ?>assets/user/js/posts.js?ver=<?= MD_VER ?>"></script>
<script src="<?= base_url(); ?>assets/user/js/croppie.js"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'emails'): ?>
<script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>assets/user/js/emails.js?ver=<?= MD_VER ?>"></script>
<script src="<?= base_url(); ?>assets/js/raphael-min.js"></script> 
<script src="<?= base_url(); ?>assets/js/morris-0.4.1.min.js"></script>
<script language="javascript">
    translation.mu285 = htmlEntities("<?= $this->lang->line('mu285'); ?>");
    translation.mu286 = htmlEntities("<?= $this->lang->line('mu286'); ?>");
    translation.mu295 = htmlEntities("<?= $this->lang->line('mu295'); ?>");
</script>
<?php endif; ?>   
<?php if ($this->router->fetch_method() == 'networks' || $this->router->fetch_method() == 'network'): ?>
<script src="<?= base_url(); ?>assets/user/js/networks.js?ver=<?= MD_VER ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'settings'): ?>
<script src="<?= base_url(); ?>assets/user/js/settings.js?ver=<?= MD_VER ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'team'): ?>
<script src="<?= base_url(); ?>assets/user/js/teams.js?ver=<?= MD_VER ?>"></script>
<script language="javascript">
    translation.mu321 = htmlEntities("<?= $this->lang->line('mu321'); ?>");
    translation.mu322 = htmlEntities("<?= $this->lang->line('mu322'); ?>");
    translation.mu50 = htmlEntities("<?= $this->lang->line('mu50'); ?>");
    translation.mu323 = htmlEntities("<?= $this->lang->line('mu323'); ?>");
    translation.mu326 = htmlEntities("<?= $this->lang->line('mu326'); ?>");
</script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'insights_page'): ?>
<script src="<?= base_url(); ?>assets/user/js/insights.js?ver=<?= MD_VER ?>"></script>
<script src="<?= base_url(); ?>assets/js/raphael-min.js"></script> 
<script src="<?= base_url(); ?>assets/js/morris-0.4.1.min.js"></script>
<script language="javascript">
    translation.mu347 = htmlEntities("<?= $this->lang->line('mu347'); ?>");
    translation.mu348 = htmlEntities("<?= $this->lang->line('mu348'); ?>");
    translation.mu349 = htmlEntities("<?= $this->lang->line('mu349'); ?>");
    translation.mu350 = htmlEntities("<?= $this->lang->line('mu350'); ?>");
    translation.mu351 = htmlEntities("<?= $this->lang->line('mu351'); ?>");
    translation.mu352 = htmlEntities("<?= $this->lang->line('mu352'); ?>");
    translation.mu353 = htmlEntities("<?= $this->lang->line('mu353'); ?>");
    translation.mu354 = htmlEntities("<?= $this->lang->line('mu354'); ?>");
    translation.mu355 = htmlEntities("<?= $this->lang->line('mu355'); ?>");
    translation.mu356 = htmlEntities("<?= $this->lang->line('mu356'); ?>");
</script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'tools' || $this->router->fetch_method() == 'bots'): ?>
<script src="<?= base_url(); ?>assets/user/js/tools.js?ver=<?= MD_VER ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'RSS_feeds'): ?>
<script src="<?= base_url(); ?>assets/user/js/rss.js?ver=<?= MD_VER ?>"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'tools' || $this->router->fetch_method() == 'bots' || $this->router->fetch_method() == 'posts' || $this->router->fetch_method() == 'emails' || $this->router->fetch_method() == 'history' || $this->router->fetch_method() == 'RSS_feeds'): ?>
<script src="<?= base_url(); ?>assets/user/js/bootstrap-datetimepicker.js"></script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'my_tickets' || $this->router->fetch_method() == 'new_ticket' || $this->router->fetch_method() == 'ticket'): ?>
<script src="<?= base_url(); ?>assets/user/js/tickets.js?ver=<?= MD_VER ?>"></script>
<script language="javascript">
    translation.mi34 = htmlEntities("<?= $this->lang->line('mi34'); ?>");
    translation.mi31 = htmlEntities("<?= $this->lang->line('mi31'); ?>");
    translation.mi32 = htmlEntities("<?= $this->lang->line('mi32'); ?>");
    translation.mm200 = htmlEntities("<?= $this->lang->line('mm200'); ?>");
</script>
<?php endif; ?>
<?php if ($this->router->fetch_method() == 'dashboard'): ?>
<script src="<?= base_url(); ?>assets/js/raphael-min.js"></script> 
<script src="<?= base_url(); ?>assets/js/morris-0.4.1.min.js"></script> 
<script language="javascript">
    jQuery(document).ready(function () {
        jQuery('.order-by ul li a').click(function (e) {
            e.preventDefault();
            var num = jQuery(this).attr('data-time');
            jQuery('.order-by ul li a').removeClass('active');
            jQuery(this).addClass('active');
            show_user_statistics(num);
        });
        function statistics(dati) {
            var sid = [];
            var colors = [];
            var nets = <?= get_all_plan_networks(); ?>;
            if ( nets ) {
                nets = JSON.parse(nets);
                if ( nets['facebook'] ) {
                    sid.push('Facebook');
                    colors.push('#3b5998');
                }
                if ( nets['facebook_pages'] ) {
                    sid.push('FacebookPages');
                    colors.push('#3b5998');
                }
                if ( nets['facebook_groups'] ) {
                    sid.push('FacebookGroups');
                    colors.push('#3b5998');
                }
                if ( nets['twitter'] ) {
                    sid.push('Twitter');
                    colors.push('#55acee');
                }
                if ( nets['vk'] ) {
                    sid.push('Vk');
                    colors.push('#6383a8');
                }
                if ( nets['tumblr'] ) {
                    sid.push('Tumblr');
                    colors.push('#529ecc');
                }
                if ( nets['pinterest'] ) {
                    sid.push('Pinterest');
                    colors.push('#be000f');
                }
                if ( nets['blogger'] ) {
                    sid.push('Blogger');
                    colors.push('#fb8f3d');
                }
                if ( nets['wordpress'] ) {
                    sid.push('Wordpress');
                    colors.push('#0090bb');
                }
                if ( nets['medium'] ) {
                    sid.push('Medium');
                    colors.push('#02b875');
                }
                if ( nets['linkedin'] ) {
                    sid.push('Linkedin');
                    colors.push('#eddb11');
                }
                if ( nets['linkedin_companies'] ) {
                    sid.push('LinkedinCompanies');
                    colors.push('#eddb11');
                }
                if ( nets['flickr'] ) {
                    sid.push('Flickr');
                    colors.push('#ff007f');
                }
                if ( nets['instagram'] ) {
                    sid.push('Instagram');
                    colors.push('#517fa6');
                }
                if ( nets['reddit'] ) {
                    sid.push('Reddit');
                    colors.push('#e1584b');
                }
                if ( nets['youtube'] ) {
                    sid.push('Youtube');
                    colors.push('#ca3737');
                }
                if ( nets['google_plus'] ) {
                    sid.push('GooglePlus');
                    colors.push('#dd4b39');
                }
                if ( nets['dailymotion'] ) {
                    sid.push('Dailymotion');
                    colors.push('#0066dc');
                }
                if ( nets['imgur'] ) {
                    sid.push('Imgur');
                    colors.push('#1bb76e');
                }
                if ( nets['The500px'] ) {
                    sid.push('The500px');
                    colors.push('#00adee');
                }
            } else {
                sid.push('Facebook');
                colors.push('#3b5998');
                sid.push('FacebookPages');
                colors.push('#3b5998');
                sid.push('FacebookGroups');
                colors.push('#3b5998');
                sid.push('Twitter');
                colors.push('#55acee');
                sid.push('Vk');
                colors.push('#6383a8');
                sid.push('Tumblr');
                colors.push('#529ecc');
                sid.push('Pinterest');
                colors.push('#be000f');
                sid.push('Blogger');
                colors.push('#fb8f3d');
                sid.push('Wordpress');
                colors.push('#0090bb');
                sid.push('Medium');
                colors.push('#02b875');
                sid.push('Linkedin');
                colors.push('#eddb11');
                sid.push('LinkedinCompanies');
                colors.push('#eddb11');
                sid.push('Flickr');
                colors.push('#ff007f');
                sid.push('Instagram');
                colors.push('#517fa6');
                sid.push('Reddit');
                colors.push('#e1584b');
                sid.push('Youtube');
                colors.push('#ca3737');
                sid.push('GooglePlus');
                colors.push('#dd4b39');
                sid.push('Dailymotion');
                colors.push('#0066dc');
                sid.push('Imgur');
                colors.push('#1bb76e');
                sid.push('500px');
                colors.push('#00adee');
            }
            // display statistics in Dashboard
            Morris.Line({
                element: 'statistics',
                data: dati,
                xkey: 'period',
                xLabelFormat: function (date) {
                    return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                },
                xLabels: 'day',
                ykeys: sid,
                labels: sid,
                pointSize: 5,
                hideHover: 'auto',
                lineColors: colors,
                lineWidth: 2,
            });
        }
        function show_user_statistics(num) {
            // display user statistics
            var url = jQuery('.navbar-brand').attr('href');
            console.log(url + 'user/statistics/' + num);
            jQuery.ajax({
                url: url + 'user/statistics/' + num,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var dati = eval(data);
                    jQuery('#statistics').empty();
                    statistics(dati);
                },
                error: function (jqXHR, textStatus) {
                    console.log('Request failed:' + textStatus);
                }
            });
        }
        if(jQuery('.dashboard').length > 0) {
            // show statistics from the last week
            if(jQuery(document).width() > 1500) {
                show_user_statistics(7);
            }
            else {
                setTimeout(function(){show_user_statistics(7);},1000);
            }
        }
    });
</script>
<?php endif; ?>
<?php if ( ($this->router->fetch_method() != 'expiration_tokens') && (get_user_option('tokens-expiration')) ): ?>
    <div class="notification-popup">
        <div class="netis">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clean text-center"><i class="fa fa-bell"></i></div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clean">
                <h4><?= $this->lang->line('mu298'); ?></h4>
                <p><a href="<?= site_url('user/expiration-tokens') ?>"><?= $this->lang->line('mu299'); ?></a></p>
            </div>
        </div>
    </div>
<?php endif; ?>
