    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)" >
      <div class="container text-center">

        <div class="row">
          <div class="col-12 col-lg-8 offset-lg-2">

            <h1><?php echo $welcome . " " . $_SESSION['user_name'];?>.</h1>

          </div>
        </div>

      </div>
    </header>
    <!-- END Header -->




    <!-- Main container -->
    <main class="main-content">
      <br /><br />
      <h4 class="text-center">
        <?php echo $msgUsr;?>
      </h4>
      <br />
      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Horizontal Tab
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section" id="section-htab">
        <div class="container">

          <div class="text-center">
            <ul class="nav nav-outline nav-round">
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user"  href="?status=true&type=Hotel"><?php echo $sec1;?></a>
              </li>
              <li class="nav-item w-140">
                  <a class="nav-link nav-user" href="?status=true&type=Restaurant"><?php echo $sec2;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user" href="?status=true&type=Loisirs"><?php echo $sec3;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user" href="?status=true&type=Culture"><?php echo $sec4;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user" href="?status=true&type=Product"><?php echo $sec5;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user" href="?status=true&type=Services"><?php echo $sec6;?></a>
              </li>
            </ul>
          </div>


        </div>
      </section>

      <div class="text-center">
        <img src="img/activity/<?php echo $activity;?>" class="img-responsive" />
      </div>





    </main>
    <!-- END Main container -->
