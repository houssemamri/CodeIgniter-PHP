    <?php
      foreach($result as $row){
        if(strcmp($_SESSION['language1'],'en')==0){
          $output = array(
            "Title" => $row->Title,
            "Content" => $row->Content_English
          );
          $by = "By";
        }
        else if(strcmp($_SESSION['language1'],'spa')==0){
          $output = array(
            "Title" => $row->Title_Spa,
            "Content" => $row->Content_Spa
          );
          $by = "De";
        }
        else
        {
          $output = array(
            "Title" => $row->Title_Fr,
            "Content" => $row->Content_Fr,
          );
          $by = "De";
        }
        

        if($output['Title'] == '' && $output['Content'] == '')
        {
          header('Location: ' . base_url());
        }
      }
     ?>
    <!-- Header -->
    <header class="header text-white h-fullscreen pb-80" style="background-image: url(<?php echo base_url();?><?php echo $row->Mainimage;?>);" data-overlay="9">
      <div class="container text-center">

        <div class="row h-100">
          <div class="col-lg-8 mx-auto align-self-center">

            <h1 class="display-4 mt-7 mb-8"><?php echo $output['Title'];?></h1>
            <p><span class="opacity-70 mr-1"><?php echo $by;?></span> <a class="text-white" href="#">Edouard Richemond</a></p>
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
             <!-- removed as ask by edward on document 14.10.2019-->
              <!--<div id="disqus_thread"></div>-->
            </div>
          </div>
          
        </div>
        
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://review-thunder-com.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
      </div>
