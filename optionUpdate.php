    <style>
    	.nav-outline .nav-item+.nav-item .nav-link {
		    border-left: 0 !important;
		}
		.section {
		    padding-top: 60px !important;
		    padding-bottom: 50px !important;
		    background-color: #fff;
		}
    </style>
    
    
    <!-- Header -->
    <header class="header text-white" style="background-image: url(img/background.jpeg)" data-overlay="8">
        <div class="container text-center">

          <div class="row">
            <div class="col-lg-12 mx-auto">

              <h1 class="text-white">
                <table>
                  <tr>
                    <td style="font-size:28px;"><?php echo $updateMain;?></td>
                    <td style="font-size:28px;">
                    <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $updateHeader1;?>,<?php echo $updateHeader2;?>,<?php echo $updateHeader3;?>,<?php echo $updateHeader4;?>" data-type-speed="80"></span>
                  </td>
                  </tr>
                </table>

              </h1>

              <hr class="w-60px my-7">

                <a class="btn btn-lg btn-round btn-white"  href="#main"><?php echo $question;?></a>

            </div>
          </div>

        </div>
    </header><!-- /.header -->
    <!-- END Header -->
    <?php
      $active = array('','','','','','');
      if($_GET['type'] == 'Hotel'){
        $active[0] = 'active';
      }
      else if($_GET['type'] == 'Restaurant'){
        $active[1] = 'active';
      }
      else if($_GET['type'] == 'Loisirs'){
        $active[2] = 'active';
      }
      else if($_GET['type'] == 'Culture'){
        $active[3] = 'active';
      }
      else if($_GET['type'] == 'Product'){
        $active[4] = 'active';
      }
      else{
        $active[5] = 'active';
      }
    ?>



    <!-- Main container -->
    <main class="main-content" id="main">

      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Horizontal Tab
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section" id="section-htab">
        <div class="container">
	<h4 class="text-center" style="font-size: 20px">
        <?php echo $updateanswertext;?> 
      </h4> <br>
          <div class="text-center">
            <ul class="nav nav-outline nav-round">
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user <?php echo $active[0];?>"  href="?status=true&type=Hotel&lang=fr&article=1"><?php echo $sec1;?></a>
              </li>
              <li class="nav-item w-140">
                  <a class="nav-link nav-user <?php echo $active[1];?>" href="?status=true&type=Restaurant&lang=fr&article=1"><?php echo $sec2;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user <?php echo $active[2];?>" href="?status=true&type=Loisirs&lang=fr&article=1"><?php echo $sec3;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user <?php echo $active[3];?>" href="?status=true&type=Culture&lang=fr&article=1"><?php echo $sec4;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user <?php echo $active[4];?>" href="?status=true&type=Product&lang=fr&article=1"><?php echo $sec5;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user <?php echo $active[5];?>" href="?status=true&type=Services&lang=fr&article=1"><?php echo $sec6;?></a>
              </li>
            </ul>
          </div>


        </div>
      </section>





    </main>
    <!-- END Main container -->
