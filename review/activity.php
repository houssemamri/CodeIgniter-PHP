<?php
    ob_start();
    include('index.php');
    ob_end_clean();
    $CI =& get_instance();
    $CI->load->library('session'); //if it's not autoloaded in your CI setup
 
?>
<?php
//session_start();
if (!isset($_SESSION['global_status'])) {
    header('Location: ' . 'login.php');
}
include('connection.php');
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <title>Thunder Review - Activity</title>

        <!-- Styles -->
        <link href="css/core.min.css" rel="stylesheet">
        <link href="css/thesaas.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="icon" href="img/favicon.png">

        <!-- END Main container -->

        <style>
            .nav-user:hover,.nav-user:active,.nav-user:visited
            {
                background-color:#cd0a62 !important;
            }
            .modal-dialog
            {
                margin-left:20%;
                margin-top:8%;
            }
            .btnclose
            {
                margin:0 85%;
            }
        </style>
    </head>

    <body>

        <?php
        include('navbar.php');
        if (!isset($_GET['status'])) {
            include('activityHome.php');
        } else {
            include('mainActivity.php');
        }


        include('footer.php');
        ?>




        <!-- Scripts -->
        <script src="js/core.min.js"></script>
        <script src="js/thesaas.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.tinymce.min.js"></script>
        <script src="js/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                height: 300,
                width: 700,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css']
            });
        </script>
        <script>
            $(function () {
                $('iframe').responsiveIframe({xdomain: '*'});
            });
        </script>
        <script>
            function display(value)
            {
                var part = [];
                var str;
                var t = '<?php echo $_GET['type']; ?>';
                var l = '<?php echo $_GET['lang']; ?>';
                var s = document.getElementById('sex').value;
                var sp = document.getElementById('special').value;
                for (var i = 1; i <= 10; ++i) {
                    str = "res" + i;
                    // alert(document.getElementById(str).value);
                    part.push(document.getElementById(str).value);
                }
                jQuery.ajax({
                    type: "POST",
                    url: "generate.php",
                    data: {article: value, partArray: part, type: t, lang: l, sex: s, special: sp},
                    success: function (response) {
                        $("#article").html(response);
                    }
                });
            }
            function showHotel(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor1').style.display = 'table';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'table';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'table';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'table';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                } else if(opt == 5)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'table';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                } else if(opt == 6)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'table';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                } else if(opt == 7)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'table';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';

                } else if(opt == 8)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'table';
                    document.getElementById('petit1').style.display = 'none';
                } else
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('zoover').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('pilot1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'table';

                }
            }
            function showRestaurant(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor2').style.display = 'table';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('pilot2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';

                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'table';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('pilot2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'table';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('pilot2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'table';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('pilot2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
                } else if (opt == 5)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'table';
                    document.getElementById('pilot2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
                } else if (opt == 6)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('pilot2').style.display = 'table';
                    document.getElementById('petit2').style.display = 'none';
                }
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('pilot2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'table';
                }
            }
            function showLeisure(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor3').style.display = 'table';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('pilot3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'table';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('pilot3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'table';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('pilot3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'table';
                    document.getElementById('pilot3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
                } else if (opt == 5)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('pilot3').style.display = 'table';
                    document.getElementById('petit3').style.display = 'none';
                } else
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('pilot3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'table';
                }
            }

            function showCulture(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor4').style.display = 'table';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('pilot4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'table';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('pilot4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'table';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('pilot4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'table';
                    document.getElementById('pilot4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
                } else if (opt == 5)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('pilot4').style.display = 'table';
                    document.getElementById('petit4').style.display = 'none';
                } else
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('pilot4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'table';
                }
            }
            function showOther(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('google5').style.display = "block";
                    document.getElementById('browser5').style.display = "none";
                } else
                {
                    document.getElementById('google5').style.display = "none";
                    document.getElementById('browser5').style.display = "block";

                }

            }
<?php
if (isset($_GET['lang'])) {
    ?>
                $(window).scrollTop($('#language').offset().top);
    <?php
} else if (isset($_GET['article'])) {
    ?>
                $(window).scrollTop($('#answer').offset().top);
    <?php
}
?>
        </script>

    </body>
</html>
