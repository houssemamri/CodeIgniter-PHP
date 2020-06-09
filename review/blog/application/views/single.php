    <?php
      foreach($result as $row){
        if(strcmp($_SESSION['language1'],'en')==0){
          $output = array(
            "Title" => $row->Title,
            "Content" => $row->Content_English
          );
        }
        else if(strcmp($_SESSION['language1'],'spa')==0){
          $output = array(
            "Title" => $row->Title_Spa,
            "Content" => $row->Content_Spa
          );
        }
        else
        {
          $output = array(
            "Title" => $row->Title_Fr,
            "Content" => $row->Content_Fr
          );
        }
      }
     ?>
    <!-- Header -->
    <header class="header text-white h-fullscreen pb-80" style="background-image: url(<?php echo base_url();?>assets/img/thumb/5.jpg);" data-overlay="9">
      <div class="container text-center">

        <div class="row h-100">
          <div class="col-lg-8 mx-auto align-self-center">

            <h1 class="display-4 mt-7 mb-8"><?php echo $output['Title'];?></h1>
            <p><span class="opacity-70 mr-1">By</span> <a class="text-white" href="#">Edouard Richemond</a></p>
            <p><img class="avatar avatar-sm" src="<?php echo base_url();?>assets/img/avatar/2.jpg" alt="..."></p>

          </div>

          <div class="col-12 align-self-end text-center">
            <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
          </div>

        </div>

      </div>
    </header><!-- /.header -->


    <!-- Main Content -->
    <main class="main-content">


      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Blog content
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <div class="section" id="section-content">
        <div class="container">

          <div class="row">
            <div class="col-lg-8 mx-auto">

              <?php echo $output['Content'];?>

            </div>
          </div>




        </div>
      </div>
