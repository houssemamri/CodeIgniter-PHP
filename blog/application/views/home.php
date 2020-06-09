    <!-- Header -->
    <?php
      if(strcmp($_SESSION['language1'],'en')==0){
        $header = 'All The Technics';
        $headerSubText1 = 'to Answer ';
        $headerSubText2 = 'Increase and promote, your reviews';
        $readmore = "Read More";
        $newer = "Newer";
        $older = "Older";
        $avatarText = strtoupper("Knowledge is always the best of Friends!");
      }
      else if(strcmp($_SESSION['language1'],'spa')==0){
        $header = 'Ultimas Publicaciones';
        $headerSubText1 = 'Cómo aumentar ';
        $headerSubText2 = 'sus calificaciones, clientes y su fidelidad';
        $readmore = "Leer";
        $newer = "Recientes";
        $older = "Antiguos";
        $avatarText = strtoupper(" ¡El conocimiento es siempre el mejor de los amigos!");

      }
      else
      {
        $header = 'Dernières Publications';
        $headerSubText1 = 'Lisez & Découvrez ';
        $headerSubText2 = 'comment Accroitre vos, Avis Clients  leur Fidélité';
        $readmore= "En savoir plus";
        $newer = "Récents";
        $older = "Anciens";
        $avatarText = strtoupper("Le Savoir est toujours le meilleur des Amis!");

      } 
     ?>
    <header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
      <div class="container">

        <div class="row">
             <div class="col-md-8 mx-auto">

                    <h1 class="fw-800"><?php echo $header;?></h1>
			<h1 style="text-align: -webkit-center; "><table>
                  <tr>
                  <td><?php echo $headerSubText1;?></td>
                    <td>
                    <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $headerSubText2;?>" data-type-speed="80"></span>
                  </td>
                  </tr>
                </table></h1>



            
         <!-- <p class="lead-2 opacity-90 mt-6"><?php echo $headerSubText;?></p>-->

          </div>
        </div>

      </div>
    </header><!-- /.header -->

    <!-- Main Content -->
    <main class="main-content">

      <section class="section bg-gray">
          <style>
              .avatar-article{
                  position: relative;
                  left: 50px;
                  top: 137px;
              }
              .bubble-article > span{
                  position: absolute;
                  top: -180px;
                  left: 150px;
                  width: 100px;
                  font-size: 0.75rem;
                  max-height: 160px;
                  font-weight: 600;
                  line-height: 1.5;
              }
              .bubble-article > img{
                  position: absolute;
                  top: -240px;
                  left: 85px;
                  max-width: 210px;
                  max-height: 200px;
                  width: 210px;
                  height: 200px;
              }

              .avatar-article-img{
                  position: absolute;
                  top: -80px;
              }
          </style>
          <?php
            if(isset($avatars))
          ?>
          <div class="avatar-article col-md-1">
              <div class="bubble-article">
                  <img src="../avatar/img/bubble/<?=$avatars->bubble?>.png">
                  <span><?=$avatarText?></span>
              </div>
              <img class="avatar-article-img" src="../avatar/img/avatar/<?=$avatars->avatar?>.png">
          </div>
        <div class="container">

          <div class="row gap-y">

          <?php
            if($result == null){
              echo "<h3 class=\"fw-800 \" style=\"display:block;margin:0 auto;\">No Post(s) found.</div></h3>";
            }
            else{
              foreach($result as $row){
                if(strcmp($_SESSION['language1'],'en')==0){
                  $title = $row->Title;
                  $content = $row->Content_English;
                }
                else if(strcmp($_SESSION['language1'],'spa')==0){
                  $title = $row->Title_Spa;
                  $content = $row->Content_Spa;
                }
                else
                {
                  $title = $row->Title_Fr;
                  $content = $row->Content_Fr;
                }
                if($title != '' && $content != '')
                {
            ?>
            <div class="col-md-6 col-lg-4">
              <div class="card border hover-shadow-6 mb-6">
                <a href="<?php echo base_url();?>Post/read/<?php echo str_replace(' ','-',$row->Title);?>"><img class="card-img-top selectTemplate" src="<?php echo base_url() . $row->Mainimage;?>" alt="Card image cap"></a>
                <div class="card-body">
                  <h5 class="card-title fw-800"><a href="<?php echo base_url();?>Post/read/<?php echo str_replace(' ','-',$row->Title);?>"><?php echo $title;?></a></h5>
                  <p class="fw-600"><?php echo substr(strip_tags($content),0,120);?>...</p>
                  <a class="fw-800 fs-12" href="<?php echo base_url();?>Post/read/<?php echo str_replace(' ','-',$row->Title);?>"><?php echo $readmore;?> <i class="ti-angle-right fs-7 pl-2"></i></a>
                </div>
              </div>
            </div>
          <?php
            }
          }

          ?>


          </div>

          <?php
            if(isset($_GET['page'])){
              $next = "?page=" . ($_GET['page'] + 1);
              if($_GET['page'] == 1){
                $prev = './';
              }
              else{
                $prev = "?page=" . ($_GET['page'] - 1);
              }
            }
            else{
              $next = "?page=" . "1";
              $prev = "#";
            }
            if($next_page == null){
              $next = "#";
            }
          ?>
          <nav class="flexbox mt-6">
            <a class="btn btn-white <?php if(!isset($_GET['page'])) { echo "disabled"; } ?>" href="<?php echo $prev;?>"><i class="ti-arrow-left fs-9 mr-2"></i> <?php echo $newer;?></a>
            <a class="btn btn-white <?php if($next_page == null) { echo "disabled"; } ?>" href="<?php echo $next;?>"><?php echo $older;?> <i class="ti-arrow-right fs-9 ml-2"></i></a>
          </nav>
          <?php
          }
           ?>

        </div>
      </section>

    </main>
