<style>
    .avatar-article{
        position: relative;
    }
    .bubble-article > span{
        position: absolute;
        top: -187px;
        left: 154px;
        width: 99px;
        font-size: 0.7rem;
        max-height: 160px;
        font-weight: 900;
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
$sql = 'select avatar,bubble from UserTable where UID = "'.$_SESSION['user_id'].'"';
$result = $conn->query($sql);
$row = $result->fetch_array();
if(is_null($row['avatar'])){
    $row['avatar'] = 1;
}
if(is_null($row['bubble'])){
    $row['bubble'] = 1;
}
?>
<div class="avatar-article col-md-1">
    <div class="bubble-article">
        <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
        <span><?=$avatarText?></span>
    </div>
    <img class="avatar-article-img" src="avatar/img/avatar/<?=$row['avatar']?>.png">
</div>



<section class="section" id="section-vtab">
        <div class="container">
            <?php
              $lang=$_GET['lang'];
              if(strcmp($lang,"fr")==0)
              {
                $fr="active";
                $en="";
                $spa="";
              }
              else if(strcmp($lang,"en")==0)
              {
                $fr="";
                $en="active";
                $spa="";
              }
              else if(strcmp($lang,"spa")==0)
              {
                $fr="";
                $en="";
                $spa="active";
              }
              else
              {
                $fr="";
                $en="";
                $spa="";
              }
             ?>

              <div class="text-center">
                <ul class="nav nav-outline nav-round">
                  <li class="nav-item w-140 hidden-sm-down">
                    <a class="nav-link nav-user <?php echo $fr;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=fr&article=1">
                      <?php echo $lang1;?>
                    </a>
                  </li>
                  <li class="nav-item w-140">
                    <a class="nav-link nav-user <?php echo $en;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=en&article=1">
                      <?php echo $lang2;?>
                    </a>
                  </li>
                  <li class="nav-item w-140 hidden-sm-down">
                    <a class="nav-link nav-user <?php echo $spa;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=spa&article=1">
                      <?php echo $lang3;?>
                    </a>
                  </li>
                </ul>
              </div>
              <br /><br /><br />
          <div class="row">
            <div class="col-12 col-md-12 align-self-center text-center">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                  $art=$_GET['article'];
                                  if($art==1)
                                  {
                                    $art1="btn-danger";
                                    $art2="btn-primary";
                                    $art3="btn-primary";
                                  }
                                  else if($art==2)
                                  {
                                    $art1="btn-primary";
                                    $art2="btn-danger";
                                    $art3="btn-primary";
                                  }
                                  else if($art==3)
                                  {
                                    $art1="btn-primary";
                                    $art2="btn-primary";
                                    $art3="btn-danger";
                                  }
                                  else
                                  {
                                    $art1="btn-primary";
                                    $art2="btn-primary";
                                    $art3="btn-primary";
                                  }
                                    if(isset($_GET['lang']))
                                    {
                                    ?>
                                  <a class="btn btn-round <?php echo $art1;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=<?php echo $_GET['lang'];?>&article=1"><?php echo $ans1;?></a>
                                  <a class="btn btn-round <?php echo $art2;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=<?php echo $_GET['lang'];?>&article=2"><?php echo $ans2;?></a>
                                  <a class="btn btn-round <?php echo $art3;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=<?php echo $_GET['lang'];?>&article=3"><?php echo $ans3;?></a>
                                  <?php } ?>
                            </ul>
                         </div>
                    </div>
                    <br /><br />
                    <?php if(isset($_GET['article']))
                    {?>
                    <div class="row">
                          <div class="col-12 col-lg-12">
                              <ul class="list-unstyled">
                                  <a class="btn btn-round btn-info" id="Man" onclick="registerSex(1);"><?php echo $sex1;?></a>
                                  <a class="btn btn-round btn-outline btn-info" id="Woman" onclick="registerSex(2);"><?php echo $sex2;?></a>
                                  <a class="btn btn-round btn-outline btn-info" id="Unisex" onclick="registerSex(3);"><?php echo $sex3;?></a>
                              </ul>
                          </div>
                      </div>
                      <br /><br />
                      <div class="row">
                           <div class="col-12 col-lg-12">
                          <?php
                           if($_GET['article']==1)
                           {?>
                            <h2><?php echo $ans1;?></h2><br />
                            <ul class="list-unstyled">
                                <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $positive[0];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $positive[1];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part3"  onclick="activePartButton(3);"><?php echo $positive[2];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(4);"><?php echo $positive[3];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(5);"><?php echo $neg1;?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(6);"><?php echo $neg2;?></li>
                                <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $positive[4];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(7);"><?php echo $neg3;?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $neg4;?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $positive[5];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part10" onclick="activePartButton(10);"><?php echo $positive[6];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part11" onclick="activePartButton(11);"><?php echo $positive[7];?></li>
                            </ul>
                            <?php
                            }
                            else if($_GET['article']==2)
                            {?>
                             <h2><?php echo $ans2;?></h2><br />
                             <ul class="list-unstyled">
                                   <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $negative[0];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $negative[1];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part3" onclick="activePartButton(3);"><?php echo $negative[2];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(5);"><?php echo $neg5;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(6);"><?php echo $neg6;?></li>
                                   <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $negative[5];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(7);"><?php echo $neg7;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(8);"><?php echo $neg8;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $negative[8];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $negative[9];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part10" onclick="activePartButton(10);"><?php echo $negative[10];?></li>
                             </ul>
                            <?php
                            }
                            else
                            {?>
                             <h2><?php echo $ans3;?></h2><br />
                             <ul class="list-unstyled">
                                   <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $simple[0];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $simple[1];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part3" onclick="activePartButton(3);"><?php echo $simple[2];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(5);"><?php echo $neg9;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(6);"><?php echo $neg10;?></li>
                                   <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $simple[3];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(7);"><?php echo $neg11;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(8);"><?php echo $neg12;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $simple[4];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $simple[5];?></li>
                             </ul>

                            <?php
                            } ?>
                    </div>
                         <?php
                         }
                         ?>
                  </div>
                  <?php
                  if(isset($_GET['article']))
                  {?>
                    <br /><br />
                    <div class="row">
                        <div class="col-12 col-lg-12">
                             <form class="form" method="POST" action="updateArticle.php">
                               <input type="text" name="language" value="<?php echo $_GET['lang'];?>" id="language" required hidden/>
                               <input type="text" name="Article" value="<?php echo $_GET['article'];?>" id="Article" required hidden/>
                               <input type="text" name="Type" value="<?php echo $_GET['type'];?>" id="Type" required hidden/>
                               <input type="text" name="gender" value="1" id="sex" hidden required />
                               <input type="text" name="Part" value="" id="Part" required hidden/>
                               <div class="form-group">
                                 <select class="form-control" name="Text" id="Text" onChange="display();">
                                 </select>
                               </div>
                               <div class="form-group">
                                   <textarea id="updateText" name="updateText" class="form-control" rows="5"></textarea>
                               </div>
                               <br/><br />
                               <button type="submit" class="btn btn-primary"><?php echo $updateBtn;?></button>
                             </form>
                        </div>
                    </div>

                <?php  }
                   ?>
                </div>
            </div>
      </section>

   <input type="text" value="0" id="special" hidden/>




</main>
<!-- END Main container -->
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