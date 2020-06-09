<script language="javascript">
    // Encode special characters
    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    
    // Translation characters
    var translation = {"mm103":htmlEntities("<?= $this->lang->line("mm103"); ?>"),"mm111":htmlEntities("<?= $this->lang->line("mm111"); ?>"),"mm112":htmlEntities("<?= $this->lang->line("mm112"); ?>"),"mm113":htmlEntities("<?= $this->lang->line("mm113"); ?>"),"mm116":htmlEntities("<?= $this->lang->line("mm116"); ?>"),"mm104":htmlEntities("<?= $this->lang->line("mm104"); ?>"),"mm105":htmlEntities("<?= $this->lang->line("mm105"); ?>"),"mm106":htmlEntities("<?= $this->lang->line("mm106"); ?>"),"mm107":htmlEntities("<?= $this->lang->line("mm107"); ?>"),"mm3":htmlEntities("<?= $this->lang->line("mm3"); ?>"),"mm142":htmlEntities("<?= $this->lang->line("mm142"); ?>"),"mm143":htmlEntities("<?= $this->lang->line("mm143"); ?>"),"mm144":htmlEntities("<?= $this->lang->line("mm144"); ?>"),"mm145":htmlEntities("<?= $this->lang->line("mm145"); ?>"),"mm187":htmlEntities("<?= $this->lang->line("mm187"); ?>"),"mm188":htmlEntities("<?= $this->lang->line("mm188"); ?>"),"ma18":htmlEntities("<?= $this->lang->line("ma18"); ?>"),"ma91":htmlEntities("<?= $this->lang->line("ma91"); ?>"),"ma141":htmlEntities("<?= $this->lang->line("ma141"); ?>"),"ma142":htmlEntities("<?= $this->lang->line("ma142"); ?>"),"mm3":htmlEntities("<?= $this->lang->line("mm3"); ?>"),"mm128":htmlEntities("<?= $this->lang->line("mm128"); ?>"),"mm129":htmlEntities("<?= $this->lang->line("mm129"); ?>"),"mm129":htmlEntities("<?= $this->lang->line("mm129"); ?>"),"mm200":htmlEntities("<?= $this->lang->line("mm200"); ?>"),"mm201":htmlEntities("<?= $this->lang->line("mm201"); ?>"),"mm130":htmlEntities("<?= $this->lang->line("mm130"); ?>"),"mm154":htmlEntities("<?= $this->lang->line("mm154"); ?>"),"mm135":htmlEntities("<?= $this->lang->line("mm135"); ?>")};
</script>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/main.js?ver=<?= MD_VER ?>"></script>
<?php if ($this->router->fetch_method() == 'dashboard'): ?>
    <script src="<?= base_url(); ?>assets/js/raphael-min.js"></script>
    <script src="<?= base_url(); ?>assets/js/morris-0.4.1.min.js"></script>
    <?php
    $sent_posts = "";
    $colors = "";
    if($sent)
	{
        foreach ($sent as $key => $value) {
            $sent_posts .= '{label: "' . ucwords(str_replace("_"," ",$key)) . '", value: ' . $value . '},';
            switch ($key) {
                case 'blogger':
                    $colors .= "'#f1a56b',";
                    break;
                case 'facebook':
                    $colors .= "'#86B9EA',";
                    break;
                case 'facebook_pages':
                    $colors .= "'#5492d3',";
                    break;
                case 'facebook_groups':
                    $colors .= "'#365899',";
                    break;
                case 'linkedin':
                    $colors .= "'#287bbc',";
                    break;
                case 'instagram':
                    $colors .= "'#517fa6',";
                    break;
                case 'medium':
                    $colors .= "'#4fffbd',";
                    break;
                case 'pinterest':
                    $colors .= "'#ff80a3',";
                    break;
                case 'tumblr':
                    $colors .= "'#AACAE8',";
                    break;
                case 'twitter':
                    $colors .= "'#7BDFE8',";
                    break;
                case 'vk':
                    $colors .= "'#9aabc3',";
                    break;
                case 'wordpress':
                    $colors .= "'#52c6fb',";
                    break;
                case 'flickr':
                    $colors .= "'#ea85b6',";
                    break;
                case 'reddit':
                    $colors .= "'#e1584b',";
                    break;
                case 'youtube':
                    $colors .= "'#ca3737',";
                    break;
                case 'google_plus':
                    $colors .= "'#dd4b39',";
                    break;
                case 'dailymotion':
                    $colors .= "'#0066dc',";
                    break;
                case 'imgur':
                    $colors .= "'#1bb76e',";
                    break;
                default:
                    $colors .= "'#" . rand(100000, 999999) . "',"; // get a random color
                    break;
            }
        }
        $colors = substr($colors, 0, -1);
    }
    ?>
    <script language="javascript">
        jQuery(".order-by ul li a").click(function (e)
        {
            e.preventDefault();
            var num = jQuery(this).attr("data-time");
            jQuery(".order-by ul li a").removeClass("active");
            jQuery(this).addClass("active");
			show_admin_statistics(num);
        });
        function statistics(dati)
        {
            // display statistics in Dashboard
            Morris.Area({
                element: 'statistics',
                data: dati,
                xkey: 'period',
                xLabelFormat: function (date) {
                    return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                },
                xLabels: 'day',
                ykeys: ['newusers'],
                labels: ['New Users'],
                pointSize: 2,
                hideHover: 'auto',
                lineColors: ['#AACAE8'],
                lineWidth: 1,
            });
        }
        Morris.Donut({
            element: 'soci-networks',
            data: [<?= $sent_posts ?>],
            colors: [<?= $colors ?>]
        });
        function show_admin_statistics(num)
        {
            // display admin statistics
            var url = jQuery(".navbar-brand").attr("href");
            jQuery.ajax({
                url: url + "admin/statistics/" + num,
                type: "GET",
                dataType: "json",
                success: function (data)
                {
                    var dati = eval(data);
                    jQuery("#statistics").empty();
                    statistics(dati);
                },
                error: function (jqXHR, textStatus)
                {
                    console.log("Request failed:" + textStatus);
                }
            });
        }
        // show statistics from the last week
        if (jQuery(document).width() > 1500)
        {
            show_admin_statistics(7);
        }
        else
        {
            setTimeout(function () {
                show_admin_statistics(7);
            }, 1000);
        }
    </script>
<?php elseif (($this->router->fetch_method() == 'scheduled_posts')): ?>
    <script src="<?= base_url(); ?>assets/admin/js/scheduled.js?ver=<?= MD_VER ?>"></script>
<?php elseif (($this->router->fetch_method() == 'users') || ($this->router->fetch_method() == 'new_user') || ($this->router->fetch_method() == 'user_activities')): ?>
    <script src="<?= base_url(); ?>assets/admin/js/users.js?ver=<?= MD_VER ?>"></script>
<?php elseif (($this->router->fetch_method() == 'settings') || ($this->router->fetch_method() == 'network') || ($this->router->fetch_method() == 'tools') || ($this->router->fetch_method() == 'manage_bots')): ?>
    <script src="<?= base_url(); ?>assets/admin/js/settings.js?ver=<?= MD_VER ?>"></script>
<?php elseif (($this->router->fetch_method() == 'plans')): ?>
    <script src="<?= base_url(); ?>assets/admin/js/plans.js?ver=<?= MD_VER ?>"></script>
<?php elseif (($this->router->fetch_method() == 'all_tickets') || ($this->router->fetch_method() == 'new_question') || ($this->router->fetch_method() == 'ticket_info')): ?>
    <script src="<?= base_url(); ?>assets/admin/js/tickets.js?ver=<?= MD_VER ?>"></script>
    <script language="javascript">
        translation.mi26 = htmlEntities("<?= $this->lang->line('mi26'); ?>");
        translation.mi27 = htmlEntities("<?= $this->lang->line('mi27'); ?>");
        translation.mi29 = htmlEntities("<?= $this->lang->line('mi29'); ?>");
        translation.mi30 = htmlEntities("<?= $this->lang->line('mi30'); ?>");
        translation.mi31 = htmlEntities("<?= $this->lang->line('mi31'); ?>");
        translation.mi32 = htmlEntities("<?= $this->lang->line('mi32'); ?>");
    </script>
<?php elseif (($this->router->fetch_method() == 'notifications')): ?>
    <script src="<?= base_url(); ?>assets/admin/summernote/dist/summernote.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/notifications.js?ver=<?= MD_VER ?>"></script>
<?php endif; ?>
</body>
</html>