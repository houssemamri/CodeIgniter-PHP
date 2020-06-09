
    <!-- Main container -->
    <main class="main-content" id="main">
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
      <section class="section pt-30" id="section-htab">
        <div class="container">

          <div class="text-center">
            <ul class="nav nav-outline nav-round">
              <li class="nav-item w-140 ">
                <a class="nav-link nav-user <?php echo $active[0];?>"  href="?status=true&type=Hotel&lang=fr&article=1"><?php echo $sec1;?></a>
              </li>
              <li class="nav-item w-140">
                  <a class="nav-link nav-user <?php echo $active[1];?>" href="?status=true&type=Restaurant&lang=fr&article=1"><?php echo $sec2;?></a>
              </li>
              <li class="nav-item w-140">
                <a class="nav-link nav-user <?php echo $active[2];?>" href="?status=true&type=Loisirs&lang=fr&article=1"><?php echo $sec3;?></a>
              </li>
              <li class="nav-item w-140">
                <a class="nav-link nav-user <?php echo $active[3];?>" href="?status=true&type=Culture&lang=fr&article=1"><?php echo $sec4;?></a>
              </li>
              <li class="nav-item w-140">
                <a class="nav-link nav-user <?php echo $active[4];?>" href="?status=true&type=Product&lang=fr&article=1"><?php echo $sec5;?></a>
              </li>
              <li class="nav-item w-140">
                <a class="nav-link nav-user <?php echo $active[5];?>" href="?status=true&type=Services&lang=fr&article=1"><?php echo $sec6;?></a>
              </li>
            </ul>
          </div>


        </div>
      </section>


    </main>
    <!-- END Main container -->
