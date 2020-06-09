    <!-- Header -->
    <?php
      if(strcmp($_SESSION['language1'],'en')==0){
        $header = 'Latest Blog Posts';
        $headerSubText = 'Read & Discover how to Manage your Online Reviews & Promote yourself!';
      }
      else if(strcmp($_SESSION['language1'],'spa')==0){
        $header = 'Ultimas Publicaciones';
        $headerSubText = 'Cómo aumentar las calificaciones de sus clientes y su fidelidad';
      }
      else
      {
        $header = 'Dernières Publications';
        $headerSubText = 'Lisez & Découvrez comment Accroitre vos Avis Clients & leur Fidélité';
      }
     ?>
    <header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
      <div class="container">

        <div class="row">
          <div class="col-md-8 mx-auto">

            <h1 class="fw-800"><?php echo $header;?></h1>
            <p class="lead-2 opacity-90 mt-6"><?php echo $headerSubText;?></p>

          </div>
        </div>

      </div>
    </header><!-- /.header -->

    <!-- Main Content -->
    <main class="main-content">

      <section class="section bg-gray">
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
            ?>
            <div class="col-md-6 col-lg-4">
              <div class="card border hover-shadow-6 mb-6">
                <a href="<?php echo base_url();?>Post/read/<?php echo str_replace(' ','-',$row->Title);?>"><img class="card-img-top" src="<?php echo base_url() . $row->Mainimage;?>" alt="Card image cap"></a>
                <div class="card-body">
                  <h5 class="card-title fw-800"><a href="<?php echo base_url();?>Post/read/<?php echo str_replace(' ','-',$row->Title);?>"><?php echo $title;?></a></h5>
                  <p class="fw-600"><?php echo substr(strip_tags($content),0,120);?>...</p>
                  <a class="fw-800 fs-12" href="<?php echo base_url();?>Post/read/<?php echo str_replace(' ','-',$row->Title);?>">Read more <i class="ti-angle-right fs-7 pl-2"></i></a>
                </div>
              </div>
            </div>
          <?php
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
            <a class="btn btn-white <?php if(!isset($_GET['page'])) { echo "disabled"; } ?>" href="<?php echo $prev;?>"><i class="ti-arrow-left fs-9 mr-2"></i> Newer</a>
            <a class="btn btn-white <?php if($next_page == null) { echo "disabled"; } ?>" href="<?php echo $next;?>">Older <i class="ti-arrow-right fs-9 ml-2"></i></a>
          </nav>
          <?php
          }
           ?>

        </div>
      </section>

    </main>
