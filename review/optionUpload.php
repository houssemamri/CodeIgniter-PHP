    <!-- Header -->
    <header class="header text-white" style="background-image: url(img/background.jpeg)" data-overlay="8">
        <div class="container text-center">

          <div class="row">
            <div class="col-lg-12 mx-auto">

              <h1 class="text-white">
                <table>
                  <tr>
                    <td style="font-size:28px;"><?php echo $uploadMain;?></td>
                    <td style="font-size:28px;">
                    <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $uploadHeader1;?>,<?php echo $uploadHeader2;?>" data-type-speed="80"></span>
                  </td>
                  </tr>
                </table>

              </h1>

              <hr class="w-60px my-7">

                <a class="btn btn-lg btn-round btn-white" href="#main"><?php echo $question;?></a>

            </div>
          </div>

        </div>
    </header><!-- /.header -->
    <!-- END Header -->




    <!-- Main container -->
    <main class="main-content" id="main">

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





    </main>
    <!-- END Main container -->
