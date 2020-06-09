<?php
session_start();
if (!isset($_SESSION['global_status'])) {
    header('Location: ' . 'auth/index');
}
include('connection.php');
include('common_function.php');
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <title>Thunder Review - Answer Review</title>

        <!-- Styles -->
        <link href="css/core.min.css" rel="stylesheet">
        <link href="css/thesaas.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="CircularContentCarousel/css/jquery.jscrollpane.css" media="all" />
		<link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='https://fonts.googleapis.com/css?family=Coustard:900' rel='stylesheet' type='text/css' />
		<link href='https://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css' />
		 <link rel="stylesheet" type="text/css" href="CircularContentCarousel/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="CircularContentCarousel/css/style.css" />
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="icon" href="img/favicon.png">
        <!-- END Main container -->

        <style>
            body{

            }
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
            table{
              margin:0 auto;
            }
            .test{
              font-size:28px;
            }
            iframe{
                border-width: 6px !important; 
                border-style: double !important;
                border-color: #c5c5c5 !important;	
            }
		    .new_border_style {
                border-width: 6px !important; 
                border-style: double !important;
                border-color: #3cb0fd !important;	
            }
            span.fw-800.pl-2.text-primary {
                font-size: 29px !important;
            }
            a.nav-link.nav-user{
                padding: 5px 20px;
            }
            #test2_ifr {
                width: 98% !important;
            }

            @media (max-width: 480px){
                #test2_ifr {
                    width: 97% !important;
                }
            }
			.header a:hover {
			    color: #b5b9bf;
			}
        </style>

    </head>
    <body>

        <?php
        include('navbar.php');
        if(strcmp($lang,'en')==0)
        {
          $respondMain = "To Answer";
          $respondHeader1 = "Read your Reviews";
          $respondHeader2 = "Select your Answers components";
          $respondHeader3 = "Personalise your Answers";
          $respondHeader4 = "Publish The Answers to your Reviews";
          $question = "A Question?";
          $avatarText = strtoupper("May the Force to Answer be with you !");
        }
        else if(strcmp($lang,'spa')==0)
        {
          $respondMain = "Para Responder";
          $respondHeader1 = "Lea las Calificaciones";
          $respondHeader2 = "Seleccione los elementos de sus respuestas";
          $respondHeader3 = "Personalice sus Respuestas";
          $respondHeader4 = "Publique sus Respuestas";
          $question = "Algunas Preguntas ?";
          $avatarText = strtoupper("Que la force de répondre soit avec vous !");

        }
        else
        {
          $respondMain = "Pour Répondre";
          $respondHeader1 = "Lisez vos Avis";
          $respondHeader2 = "Séléctionnez les éléments de vos Réponses";
          $respondHeader3 = "Personalisez vos Réponses";
          $respondHeader4 = "Publiez vos Réponses";
          $question = "Une Question ?";
          $avatarText = strtoupper("Que la force de répondre soit avec vous !");

        }
        /*if (!isset($_GET['status']) && !isset($_GET['activity'])) {
            include('mainArticle.php');
        } else if(isset($_GET['activity']))  {
            include('mainActivity.php');
        } else {
            include('mainGenerate.php');
        }*/

        if (isset($_GET['status']) && isset($_GET['type']) && isset($_GET['lang']) && isset($_GET['article'])) {
            include('mainArticle.php');
            include('mainActivity.php');

            echo "<style>
                .ca-container {
                    position: relative;
                    margin: 25px auto 20px auto;
                    width: 50%;
                    height: 200px;
                    
                }
                .mce-statusbar{
                display: none !important;
                }
                .text-blog{
                    width: 50%;
                }
                @media (max-width: 576px) {

                    .ca-container {
                        height: 370px;
                        width: 100%;
                        left: 0;
                    }
                    .text-blog{
                        width: 100%;
                    }
                }
            </style>
            <div class='row'>
            <div class='col-lg-12'>";
    //       echo "<div class='offset-md-1 col-sm-12 col-md-6'>";
            include ('blog_slider.php');
                echo "</div>";
                echo "</div>";
            include('mainGenerate.php');
        }
        else{
          header('Location: ' . './');
        }

        include('footer.php');
        ?>

        <!-- Scripts -->
        <script src="assets/js/page.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="js/core.min.js"></script>
        <script src="js/thesaas.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.tinymce.min.js"></script>
        <script src="js/tinymce.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="CircularContentCarousel/js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="CircularContentCarousel/js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="CircularContentCarousel/js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>
        <script>
            tinymce.init({
                selector: 'textarea',
                height: 300,
                width: 700,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace code fullscreen',
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
                //$('iframe').responsiveIframe({xdomain: '*'});
            });
        </script>
        <script>
            function comts_toggle(comt_id){
                
                jQuery('#comment-div_'+comt_id).toggle();
            }
            function comts_toggle_reply(comt_id){
                
                jQuery('#reply_comment_'+comt_id).toggle();
            }
            function comts_toggle_reply_divs(comt_id){
                
                jQuery('#div_reply_show_'+comt_id).toggle();
            }
            function reply_post_comment(id) {
            
                var url = "fb_/review_post.php";
                var text = jQuery("#rev_id_"+ id).val();
                jQuery.ajax({
                    type: "POST",
                    url: url,
                    data: {'id': id, 'text': text}, // serializes the form's elements.
                    success: function (data)
                    {
                        location.reload();
                        /* if (data == "done") {
                            $("#" + tab + "div_" + id).hide();
                            $('#' + tab + 'replay_comment_' + id).html(text);

                            $("#" + tab + "div_rely_owner_" + id).show();

                        } */

                    }
                });

                // e.preventDefault(); // avoid to execute the actual submit of the form.
            }
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

            function activePartButton(option)
            {
                if (option == 15) {
                    if (document.getElementById('user').classList.contains("btn-warning")) {
                        document.getElementById('special').value = "1";
                        $('#user').removeClass('btn-warning').addClass('btn-danger');
                    } else {
                        document.getElementById('special').value = "0";
                        $('#user').removeClass('btn-danger').addClass('btn-warning');

                    }
                } else if (option == 1) {
                    if (document.getElementById('part1').classList.contains("btn-primary")) {
                        document.getElementById('res1').value = "1";
                        $('#part1').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res1').value = "0";
                        $('#part1').removeClass('btn-success').addClass('btn-primary');

                    }

                } else if (option == 2) {
                    if (document.getElementById('part2').classList.contains("btn-primary")) {
                        document.getElementById('res2').value = "2";
                        $('#part2').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res2').value = "0";
                        $('#part2').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 3) {
                    if (document.getElementById('part3').classList.contains("btn-primary")) {
                        document.getElementById('res3').value = "3";
                        $('#part3').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res3').value = "0";
                        $('#part3').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 4) {
                    if (document.getElementById('part4').classList.contains("btn-primary")) {
                        document.getElementById('res4').value = "4";
                        $('#part4').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res4').value = "0";
                        $('#part4').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 5) {
                    if (document.getElementById('part5').classList.contains("btn-primary")) {
                        document.getElementById('res5').value = "5";
                        $('#part5').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res5').value = "0";
                        $('#part5').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 6) {
                    if (document.getElementById('part6').classList.contains("btn-primary")) {
                        document.getElementById('res6').value = "6";
                        $('#part6').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res6').value = "0";
                        $('#part6').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 7) {
                    if (document.getElementById('part7').classList.contains("btn-primary")) {
                        document.getElementById('res7').value = "7";
                        $('#part7').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res7').value = "0";
                        $('#part7').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 8) {
                    if (document.getElementById('part8').classList.contains("btn-primary")) {
                        document.getElementById('res8').value = "8";
                        $('#part8').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res8').value = "0";
                        $('#part8').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 9) {
                    if (document.getElementById('part9').classList.contains("btn-primary")) {
                        document.getElementById('res9').value = "9";
                        $('#part9').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res9').value = "0";
                        $('#part9').removeClass('btn-success').addClass('btn-primary');
                    }
                } else if (option == 10) {
                    if (document.getElementById('part10').classList.contains("btn-primary")) {
                        document.getElementById('res10').value = "10";
                        $('#part10').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res10').value = "0";
                        $('#part10').removeClass('btn-success').addClass('btn-primary');
                    }
                } else {
                    if (document.getElementById('part11').classList.contains("btn-primary")) {
                        document.getElementById('res11').value = "11";
                        $('#part11').removeClass('btn-primary').addClass('btn-success');
                    } else {
                        document.getElementById('res11').value = "0";
                        $('#part11').removeClass('btn-success').addClass('btn-primary');
                    }

                }
            }
            function CopyToClipboard(containerid) {
                if (document.selection) {
                    var range = document.body.createTextRange();
                    range.moveToElementText(document.getElementById(containerid));
                    range.select().createTextRange();
                    document.execCommand("Copy");

                } else if (window.getSelection) {
                    var range = document.createRange();
                    range.selectNode(document.getElementById(containerid));
                    window.getSelection().addRange(range);
                    document.execCommand("Copy");
                }
            }
            function registerSex(opt)
            {
                document.getElementById('sex').value = opt;
                if (opt == 1)
                {
                    $('#Man').removeClass('btn-outline');
                    $('#Woman').addClass('btn-outline');
                    $('#Unisex').addClass('btn-outline');
                } else if (opt == 2)
                {
                    $('#Man').addClass('btn-outline');
                    $('#Woman').removeClass('btn-outline');
                    $('#Unisex').addClass('btn-outline');
                } else if (opt == 3)
                {
                    $('#Man').addClass('btn-outline');
                    $('#Woman').addClass('btn-outline');
                    $('#Unisex').removeClass('btn-outline');

                }
            }
            function saveArticle(t, l, a)
            {
                var txt = tinyMCE.get('test2').getContent();
                jQuery.ajax({
                    type: "POST",
                    url: "saveArticle.php",
                    data: {type: t, lang: l, article: a, text: txt},
                    success: function (response) {
                        $('#success').html("<div class='alert alert-success' id='contact-success'>Successfully saved/updated!<a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>");
                    }
                });
            }            
            function showHotel(opt)
            {
                if (opt == 1)
                {

                    document.getElementById('tripAdvisor11').style.display = 'block';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'none';
					document.getElementById('facebookPage11').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'block';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'none';
					document.getElementById('facebookPage11').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'block';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'none';
					document.getElementById('facebookPage11').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'block';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'none';
					document.getElementById('facebookPage11').style.display = 'none';
                } else if(opt == 5)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'block';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'none';
					document.getElementById('facebookPage11').style.display = 'none';
                } else if(opt == 6)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'block';
                    document.getElementById('petit11').style.display = 'none';
					document.getElementById('facebookPage11').style.display = 'none';
                } 
				else if(opt == 7)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'block';
					document.getElementById('facebookPage11').style.display = 'none';
                }
				else if(opt == 10)
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'none';
                    document.getElementById('facebookPage11').style.display = 'table';
                }else
                {
                    document.getElementById('tripAdvisor11').style.display = 'none';
                    document.getElementById('book11').style.display = 'none';
                    document.getElementById('google11').style.display = 'none';
                    document.getElementById('browser11').style.display = 'none';
                    // document.getElementById('expedia1').style.display = 'none';
                    // document.getElementById('jaune11').style.display = 'none';
                    document.getElementById('petit11').style.display = 'block';
					document.getElementById('facebookPage11').style.display = 'none';

                }
            }
            function showRestaurant(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor21').style.display = 'block';
                    document.getElementById('laFour1').style.display = 'none';
                    document.getElementById('google21').style.display = 'none';
                    document.getElementById('browser21').style.display = 'none';
                    // document.getElementById('jaune21').style.display = 'none';
                    document.getElementById('petit21').style.display = 'none';
					document.getElementById('facebookPage21').style.display = 'none';

                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor21').style.display = 'none';
                    document.getElementById('laFour1').style.display = 'block';
                    document.getElementById('google21').style.display = 'none';
                    document.getElementById('browser21').style.display = 'none';
                    // document.getElementById('jaune21').style.display = 'none';
                    document.getElementById('petit21').style.display = 'none';
					document.getElementById('facebookPage21').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor21').style.display = 'none';
                    document.getElementById('laFour1').style.display = 'none';
                    document.getElementById('google21').style.display = 'block';
                    document.getElementById('browser21').style.display = 'none';
                    // document.getElementById('jaune21').style.display = 'none';
                    document.getElementById('petit21').style.display = 'none';
					document.getElementById('facebookPage21').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor21').style.display = 'none';
                    document.getElementById('laFour1').style.display = 'none';
                    document.getElementById('google21').style.display = 'none';
                    document.getElementById('browser21').style.display = 'block';
                    // document.getElementById('jaune21').style.display = 'none';
                    document.getElementById('petit21').style.display = 'none';
					document.getElementById('facebookPage21').style.display = 'none';
                } else if (opt == 5)
                {
                    document.getElementById('tripAdvisor21').style.display = 'none';
                    document.getElementById('laFour1').style.display = 'none';
                    document.getElementById('google21').style.display = 'none';
                    document.getElementById('browser21').style.display = 'none';
                    // document.getElementById('jaune21').style.display = 'block';
                    document.getElementById('petit21').style.display = 'none';
					document.getElementById('facebookPage21').style.display = 'none';
                } else if(opt == 10)
                {
                    document.getElementById('tripAdvisor21').style.display = 'none';
                    document.getElementById('laFour1').style.display = 'none';
                    document.getElementById('google21').style.display = 'none';
                    document.getElementById('browser21').style.display = 'none';
                    // document.getElementById('jaune21').style.display = 'none';
                    document.getElementById('petit21').style.display = 'none';
                     document.getElementById('facebookPage21').style.display = 'table';
                } else
                {
                    document.getElementById('tripAdvisor21').style.display = 'none';
                    document.getElementById('laFour1').style.display = 'none';
                    document.getElementById('google21').style.display = 'none';
                    document.getElementById('browser21').style.display = 'none';
                    // document.getElementById('jaune21').style.display = 'none';
                    document.getElementById('petit21').style.display = 'block';
					document.getElementById('facebookPage21').style.display = 'none';
                }
            }
            function showLeisure(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor31').style.display = 'block';
                    document.getElementById('google31').style.display = 'none';
                    document.getElementById('browser31').style.display = 'none';
                    // document.getElementById('jaune31').style.display = 'none';
                    document.getElementById('petit31').style.display = 'none';
					 document.getElementById('facebookPage31').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor31').style.display = 'none';
                    document.getElementById('google31').style.display = 'block';
                    document.getElementById('browser31').style.display = 'none';
                    // document.getElementById('jaune31').style.display = 'none';
                    document.getElementById('petit31').style.display = 'none';
					 document.getElementById('facebookPage31').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor31').style.display = 'none';
                    document.getElementById('google31').style.display = 'none';
                    document.getElementById('google31').style.display = 'block';
                    // document.getElementById('jaune31').style.display = 'none';
                    document.getElementById('petit31').style.display = 'none';
					 document.getElementById('facebookPage31').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor31').style.display = 'none';
                    document.getElementById('google31').style.display = 'none';
                    document.getElementById('browser31').style.display = 'block';
                    // document.getElementById('jaune31').style.display = 'block';
                    document.getElementById('petit31').style.display = 'none'
					 document.getElementById('facebookPage31').style.display = 'none';;
                } else if(opt == 10)
                {
                    document.getElementById('tripAdvisor31').style.display = 'none';
                    document.getElementById('google31').style.display = 'none';
                    document.getElementById('browser31').style.display = 'none';
                    // document.getElementById('jaune31').style.display = 'none';
                    document.getElementById('petit31').style.display = 'none';
                     document.getElementById('facebookPage31').style.display = 'table';
			
                } else
                {
                    document.getElementById('tripAdvisor31').style.display = 'none';
                    document.getElementById('google31').style.display = 'none';
                    document.getElementById('google31').style.display = 'none';
                    // document.getElementById('jaune31').style.display = 'none';
                    document.getElementById('petit31').style.display = 'block';
					 document.getElementById('facebookPage31').style.display = 'none';
                }
            }            
            function showCulture(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('tripAdvisor41').style.display = 'block';
                    document.getElementById('google41').style.display = 'none';
                    document.getElementById('browser41').style.display = 'none';
                    // document.getElementById('jaune41').style.display = 'none';
                    document.getElementById('petit41').style.display = 'none';
					 document.getElementById('facebookPage41').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor41').style.display = 'none';
                    document.getElementById('google41').style.display = 'block';
                    document.getElementById('browser41').style.display = 'none';
                    // document.getElementById('jaune41').style.display = 'none';
                    document.getElementById('petit41').style.display = 'none';
					 document.getElementById('facebookPage41').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor41').style.display = 'none';
                    document.getElementById('google41').style.display = 'none';
                    document.getElementById('browser41').style.display = 'block';
                    // document.getElementById('jaune41').style.display = 'none';
                    document.getElementById('petit41').style.display = 'none';
					 document.getElementById('facebookPage41').style.display = 'none';
                }  else if(opt == 10)
                {
                    document.getElementById('tripAdvisor41').style.display = 'none';
                    document.getElementById('google41').style.display = 'none';
                    document.getElementById('browser41').style.display = 'none';
                    // document.getElementById('jaune41').style.display = 'none';
                    document.getElementById('petit41').style.display = 'none';
                     document.getElementById('facebookPage41').style.display = 'table';
                }else
                {
                    document.getElementById('tripAdvisor41').style.display = 'none';
                    document.getElementById('google41').style.display = 'none';
                    document.getElementById('browser41').style.display = 'none';
                    // document.getElementById('jaune41').style.display = 'none';
                    document.getElementById('petit41').style.display = 'block';
					 document.getElementById('facebookPage41').style.display = 'none';
                }
            }
            function showOther(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('google51').style.display = "block";
                    document.getElementById('browser51').style.display = "none";
					 document.getElementById('facebookPage51').style.display = 'none';
                }else if(opt == 10)
                {
                     document.getElementById('google51').style.display = "none";
                    document.getElementById('browser51').style.display = "none";
                    document.getElementById('facebookPage51').style.display = 'table';
                }  else
                {
                    document.getElementById('google51').style.display = "none";
                    document.getElementById('browser51').style.display = "block";
					 document.getElementById('facebookPage51').style.display = 'none';

                }

            }
        </script>

    </body>
</html>
