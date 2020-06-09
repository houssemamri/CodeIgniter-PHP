

<?php
session_start();
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

        <title>Thunder Review - Answer Review</title>

        <!-- Styles -->
        <link href="css/core.min.css" rel="stylesheet">
        <link href="css/thesaas.css" rel="stylesheet">
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
            table{
              margin:0 auto;
            }
            .test{
              font-size:28px;
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
		  $mu_business="My Business";
		  $Manage_locations="Manage locations";  
		  $Location="Location";
$All_locations="All locations";		  
$loc_name="Name";		  
$loc_Status="Status";		  
$Published="Published";		  
$home_loc="Home";		  
$loc_Review="Review";		  
$loc_info="Info";		  
$loc_photo="Foto"; 
$loc_all="All"; 
$loc_REPLIED="REPLIED";		  
$hav_replied="HAVEN'T REPLIED";		  
$Owner="Owner";		  
$v_edit="View and Edit";		  
$loc_REPLY="REPLY";		  
		  
		  

        }
        else if(strcmp($lang,'spa')==0)
        {
          $respondMain = "Para Responder";
          $respondHeader1 = "Lea las Calificaciones";
          $respondHeader2 = "Seleccione los elementos de sus respuestas";
          $respondHeader3 = "Personalice sus Respuestas";
          $respondHeader4 = "Publique sus Respuestas";
          $question = "Algunas Preguntas ?";
		  $mu_business="Mi negocio";
          $Manage_locations="Administrar ubicaciones";
		   $Location="Ubicación"; 
		   $All_locations="Todas las localizaciones"; 
		   $loc_name="Nombre"; 
		   $loc_Status="Estado"; 
		   $Published="Publicado";
           $home_loc="Casa";		   
           $loc_Review="Revisión";		   
           $loc_info="Información";		   
		  $loc_photo="Foto"; 
		  $loc_all="TODAS"; 
		  $loc_REPLIED="RESPONDIDO";
		  $hav_replied="NO HAN RESPONDIDO";	
		  $Owner="Propietario";
		  $v_edit="Ver y editar";
$loc_REPLY="RESPUESTA";		  
        }
        else
        {
          $respondMain = "Pour Répondre";
          $respondHeader1 = "Lisez vos Avis";
          $respondHeader2 = "Séléctionnez les éléments de vos Réponses";
          $respondHeader3 = "Personalisez vos Réponses";
          $respondHeader4 = "Publiez vos Réponses";
          $question = "Une Question ?";
		  $mu_business="Mon entreprise";
		   $Manage_locations="Gérer les emplacements"; 
 $Location="Emplacement";
 $All_locations="Tous les lieux"; 		   
 $loc_name="Prénom"; 		   
 $loc_Status="Statut"; 		   
 $Published="Publié";
$home_loc="Accueil"; 
$loc_Review="La revue"; 
$loc_info="Info"; 
$loc_photo="Photo"; 
$loc_all="TOUT"; 
$hav_replied="N'ONT PAS REPONDU";
$Owner="Propriétaire";
$v_edit="Voir et éditer";
$loc_REPLY="RÉPONDRE";		

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
                    document.getElementById('tripAdvisor1').style.display = 'table';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
					document.getElementById('facebookPage1').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'table';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
					document.getElementById('facebookPage1').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'table';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
					document.getElementById('facebookPage1').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'table';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
					document.getElementById('facebookPage1').style.display = 'none';
                } else if(opt == 5)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'table';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
					document.getElementById('facebookPage1').style.display = 'none';
                } else if(opt == 6)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'table';
                    document.getElementById('petit1').style.display = 'none';
					document.getElementById('facebookPage1').style.display = 'none';
                } else if(opt == 10)
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'none';
                    document.getElementById('facebookPage1').style.display = 'table';
                } else
                {
                    document.getElementById('tripAdvisor1').style.display = 'none';
                    document.getElementById('book1').style.display = 'none';
                    document.getElementById('google1').style.display = 'none';
                    document.getElementById('browser1').style.display = 'none';
                    document.getElementById('expedia').style.display = 'none';
                    document.getElementById('jaune1').style.display = 'none';
                    document.getElementById('petit1').style.display = 'table';
					document.getElementById('facebookPage1').style.display = 'none';

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
                    document.getElementById('petit2').style.display = 'none';
					document.getElementById('facebookPage2').style.display = 'none';

                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'table';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
					document.getElementById('facebookPage2').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'table';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
					document.getElementById('facebookPage2').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'table';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
					document.getElementById('facebookPage2').style.display = 'none';
                } else if (opt == 5)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'table';
                    document.getElementById('petit2').style.display = 'none';
					document.getElementById('facebookPage2').style.display = 'none';
                }else if(opt == 10)
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'none';
                    document.getElementById('facebookPage2').style.display = 'table';
                }  else
                {
                    document.getElementById('tripAdvisor2').style.display = 'none';
                    document.getElementById('laFour').style.display = 'none';
                    document.getElementById('google2').style.display = 'none';
                    document.getElementById('browser2').style.display = 'none';
                    document.getElementById('jaune2').style.display = 'none';
                    document.getElementById('petit2').style.display = 'table';
					document.getElementById('facebookPage2').style.display = 'none';
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
                    document.getElementById('petit3').style.display = 'none';
					 document.getElementById('facebookPage3').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'table';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
					 document.getElementById('facebookPage3').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'table';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
					 document.getElementById('facebookPage3').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'table';
                    document.getElementById('petit3').style.display = 'none';
					 document.getElementById('facebookPage3').style.display = 'none';
                }else if(opt == 10)
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'none';
                    document.getElementById('facebookPage3').style.display = 'table';
			
                }  else
                {
                    document.getElementById('tripAdvisor3').style.display = 'none';
                    document.getElementById('google3').style.display = 'none';
                    document.getElementById('browser3').style.display = 'none';
                    document.getElementById('jaune3').style.display = 'none';
                    document.getElementById('petit3').style.display = 'table';
					 document.getElementById('facebookPage3').style.display = 'none';
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
                    document.getElementById('petit4').style.display = 'none';
					 document.getElementById('facebookPage4').style.display = 'none';
                } else if (opt == 2)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'table';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
					document.getElementById('facebookPage4').style.display = 'none';
                } else if (opt == 3)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'table';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
					document.getElementById('facebookPage4').style.display = 'none';
                } else if (opt == 4)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'table';
                    document.getElementById('petit4').style.display = 'none';
					document.getElementById('facebookPage4').style.display = 'none';
                } else if(opt == 10)
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'none';
                    document.getElementById('facebookPage4').style.display = 'table';
                } else
                {
                    document.getElementById('tripAdvisor4').style.display = 'none';
                    document.getElementById('google4').style.display = 'none';
                    document.getElementById('browser4').style.display = 'none';
                    document.getElementById('jaune4').style.display = 'none';
                    document.getElementById('petit4').style.display = 'table';
					document.getElementById('facebookPage4').style.display = 'none';
                }
            }
            function showOther(opt)
            {
                if (opt == 1)
                {
                    document.getElementById('google5').style.display = "table";
                    document.getElementById('browser5').style.display = "none";
					document.getElementById('facebookPage5').style.display = 'none';
                } else if(opt == 10)
                {
                     document.getElementById('google5').style.display = "none";
                    document.getElementById('browser5').style.display = "none";
                    document.getElementById('facebookPage4').style.display = 'table';
                } else
                {
                    document.getElementById('google5').style.display = "none";
                    document.getElementById('browser5').style.display = "table";
					document.getElementById('facebookPage5').style.display = 'none';

                }

            }
		
        </script>

    </body>
</html>
