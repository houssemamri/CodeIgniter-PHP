<?php
session_start();
if(!isset($_SESSION['global_status'])){
  header('Location: ' . 'login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Update</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">

    <!--  Open Graph Tags -->
    <meta property="og:title" content="TheSaaS">
    <meta property="og:description" content="A responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4.">
    <meta property="og:image" content="http://thetheme.io/thesaas/assets/img/og-img.jpg">
    <meta property="og:url" content="http://thetheme.io/thesaas/">
    <meta name="twitter:card" content="summary_large_image">

    <style>
      .nav-user:hover,.nav-user:active,.nav-user:visited
      {
        background-color:#cd0a62 !important;
      }
        table{
          margin:0 auto;
        }
        .test{
          font-size:28px;
          text-align: left;
          margin-left:20px;
        }
    </style>
  </head>

  <body>


    <?php include('navbar.php');
    if(strcmp($lang,'en')==0)
    {
      $updateMain = "To Modify the Software’s Text";
      $updateHeader1 = "Select the Category";
      $updateHeader2 = "Select the Text withing the Category";
      $updateHeader3 = "Modify the Text";
      $updateHeader4 = "Save the text";
      $question = "A Question?";

    }
    else if(strcmp($lang,'spa')==0)
    {
      $updateMain = "Para modificar textos en el programa";
      $updateHeader1 = "Seleccione la categoría";
      $updateHeader2 = "Seleccione el texto dentro de la categoría";
      $updateHeader3 = "Modifique el texto";
      $updateHeader4 = "Guarde el texto";
      $question = "Algunas Preguntas ?";


    }
    else
    {
      $updateMain = "Pour Modifier les Textes du Logiciel";
      $updateHeader1 = "Selectionnez la Categorie";
      $updateHeader2 = "Selectionnez le Texte au sein de la  Categorie";
      $updateHeader3 = "Modifiez le Texte";
      $updateHeader4 = "Sauvegardez le texte";
      $question = "Une Question ?";

    }
    if(!isset($_GET['status']))
    {
      include('optionUpdate.php');
    }
    else
    {
      include('mainUpdate.php');
    }

    include('footer.php');?>




    <!-- Scripts -->
    <script src="assets/js/page.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>
    <script>
    function activePartButton(option)
    {
      if(option==1){
        document.getElementById('Part').value="1";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part1').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');

      }
      else if(option==2){
        document.getElementById('Part').value="2";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part2').removeClass('btn-primary').addClass('btn-success');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==3){
        document.getElementById('Part').value="3";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part3').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==4){
        document.getElementById('Part').value="4";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part4').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==5){
        document.getElementById('Part').value="5";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part5').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==6){
        document.getElementById('Part').value="6";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part6').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==7) {
        document.getElementById('Part').value="7";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part7').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==8) {
        document.getElementById('Part').value="8";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part8').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==9) {
        document.getElementById('Part').value="9";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part9').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==10)
      {
        document.getElementById('Part').value="10";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part10').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part11').removeClass('btn-success').addClass('btn-primary');
      }
      else if(option==11)
      {
        document.getElementById('Part').value="10";
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part11').removeClass('btn-primary').addClass('btn-success');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
      }
      else
      {
          document.getElementById('Part').value="15";
          $('#user').removeClass('btn-warning').addClass('btn-danger');
          $('#part10').removeClass('btn-success').addClass('btn-primary');
          $('#part2').removeClass('btn-success').addClass('btn-primary');
          $('#part3').removeClass('btn-success').addClass('btn-primary');
          $('#part4').removeClass('btn-success').addClass('btn-primary');
          $('#part1').removeClass('btn-success').addClass('btn-primary');
          $('#part6').removeClass('btn-success').addClass('btn-primary');
          $('#part5').removeClass('btn-success').addClass('btn-primary');
          $('#part8').removeClass('btn-success').addClass('btn-primary');
          $('#part9').removeClass('btn-success').addClass('btn-primary');
          $('#part7').removeClass('btn-success').addClass('btn-primary');
          $('#part11').removeClass('btn-success').addClass('btn-primary');

      }
      populateSelect(option);
    }
    function populateSelect(opt)
    {
        var t='<?php echo $_GET['type'];?>';
        var l='<?php echo $_GET['lang'];?>';
        var a='<?php echo $_GET['article'];?>';
        var u='<?php echo $_SESSION['user_id'];?>';
        var s=document.getElementById('sex').value;
        jQuery.ajax({
         type: "POST",
         url: "Edit.php",
         data: {part:opt,type:t,lang:l,article:a,user:u,sex:s},
         success: function(data){
            var result =  $.parseJSON(data);
            var select = $("#Text"), options = '';
            select.empty();
            options +="<option>Select</option>";
            for(var i=0;i<result.length; i++){
                options += "<option value='"+result[i].id+"'>"+ result[i].text +"</option>";
            }
            select.append(options);
          }
    	});
    }

    function display()
    {
      var opt=document.getElementById('Text');
      //alert(opt.options[opt.selectedIndex].text);
      $('#updateText').html(opt.options[opt.selectedIndex].text);
    }
    function registerSex(opt)
    {
        $('#user').removeClass('btn-danger').addClass('btn-warning');
        $('#part10').removeClass('btn-success').addClass('btn-primary');
        $('#part2').removeClass('btn-success').addClass('btn-primary');
        $('#part3').removeClass('btn-success').addClass('btn-primary');
        $('#part4').removeClass('btn-success').addClass('btn-primary');
        $('#part1').removeClass('btn-success').addClass('btn-primary');
        $('#part6').removeClass('btn-success').addClass('btn-primary');
        $('#part5').removeClass('btn-success').addClass('btn-primary');
        $('#part8').removeClass('btn-success').addClass('btn-primary');
        $('#part9').removeClass('btn-success').addClass('btn-primary');
        $('#part7').removeClass('btn-success').addClass('btn-primary');
      document.getElementById('sex').value=opt;
      if(opt==1)
      {
        $('#Man').removeClass('btn-outline');
        $('#Woman').addClass('btn-outline');
        $('#Unisex').addClass('btn-outline');
      }
      else if(opt==2)
      {
        $('#Man').addClass('btn-outline');
        $('#Woman').removeClass('btn-outline');
        $('#Unisex').addClass('btn-outline');
      }
      else if(opt==3)
      {
        $('#Man').addClass('btn-outline');
        $('#Woman').addClass('btn-outline');
        $('#Unisex').removeClass('btn-outline');

      }
    }
    </script>

  </body>
</html>
