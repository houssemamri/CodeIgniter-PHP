<?php
session_start();
// INDEX SEARCH
if(isset($_SESSION['bp_logged']) && $_SESSION['bp_logged'] === TRUE){
    
    include_once('./header.php');
?>

    <div class="container">

        <div class="row" >
        <div class="board cols-md-12">
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li class="active">
                     <a href="#page" data-toggle="tab" title="Pages">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-duplicate"></i>
                      </span>
                  </a></li>
                    <li>
                        <a href="#group" data-toggle="tab" title="Groups">
                            <span class="round-tabs two">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                        </a>
                    </li>
                    <li><a href="#event" data-toggle="tab" title="Events">
                     <span class="round-tabs three">
                          <i class="glyphicon glyphicon-star"></i>
                     </span> </a>
                     </li>
                     <li><a href="#place" data-toggle="tab" title="Places">
                     <span class="round-tabs four">
                          <i class="glyphicon glyphicon-map-marker"></i>
                     </span> </a>
                     </li>
                     </ul></div>
        </div>
        <div class=" " >

            <div class="cols-md-12" >
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="page">
                        <?php include_once('page.php'); ?>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="group">
                        <?php include_once('group.php'); ?>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="event">
                        <?php include_once('event.php'); ?>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="place">
                        <?php include_once('place.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
else{

    header('Location: ../');
    exit();

}


?>

<script type="text/javascript" >
$(function($){
    $('a[title]').tooltip();

    $('#nav-tabs-wrapper a').click(function (e) {
      e.preventDefault()
      $(this).tab('show');
    })

});

</script>
<?php
include_once('./footer.php');
?>
