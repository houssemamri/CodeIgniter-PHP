<div class=" ">

<form id="searchPlaceForm" class="form-horizontal" action="" method="post">
<fieldset>
    <legend>Search Places</legend>
 <!-- Search input-->
    <div class="col-md-6  ">
        <div class=" ">
            <input id="searchplace" name="q" type="search" placeholder="Type your search terms like 'Loch Ness Lake'" class="form-control input-md">
        </div>
    </div>

<!-- Select Basic -->
    <div class="col-md-1">
      <div class=" ">
        <select id="placelimit" name="limit" class="form-control">
          <option value="5">5</option>
          <option value="15">15</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="150">150</option>
          <option value="250">250</option>
          <option value="500">500</option>
        </select>
        
      </div>
    </div>



<!-- Button -->
<div class="col-md-1">
  <div class=" ">
    <button id="btnsearchplace" name="btnsearchplace" class="btn btn-default">Search Places</button>
  </div>
</div>

</fieldset>
<input type="hidden" value="place" name="type" />
</form>

</fieldset>


</div>
<div id="searchPlaceResults"></div>
<?php


?>
<script type="text/javascript">
$(document).ready(function(){
    
    var PlaceBeginTableResult = '<table class="display" cellspacing="0" width="100%" id="tablePlaceResult" class="table"><thead><tr><th>Name</th><th>Category</th><th>Subcategory</th><th>Location</th></tr></thead><tbody>';
    $('#searchPlaceResults').append(PlaceBeginTableResult);
    var PlaceEndTableResult = '</tbody><tfoot><tr><th>Name</th><th>Category</th><th>Subcategory</th><th>Location</th></tr></tfoot></table>';
    $('#tablePlaceResult').append(PlaceEndTableResult);

    var Placetable = $('#tablePlaceResult').DataTable(
                                            {
                                              select: true,
                                              responsive: true,
                                              "autoWidth": true,
                                              "deferRender": true,
                                            
                                             dom: 'Blfrtip',
                                             buttons: [
                                                'copyHtml5',
                                                'excelHtml5',
                                                'csvHtml5',
                                                {
                                                    extend: 'pdfHtml5',
                                                    orientation: 'portrait',
                                                    pageSize: 'A4'
                                                },
                                                'colvis'
                                            ]
                                            
                                        });
 
    Placetable.buttons().container()
        .appendTo( '#tablePlaceResult_wrapper .col-sm-6:eq(0)' );
 
    $('#tablePlaceResult tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    });

 
    Placetable.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );


var PlaceSearchQuery  = null;
$("#searchPlaceForm").submit(function(e) {
                if($("#searchplace").val() == ''){
                    return;
                }
                e.preventDefault();
                var islogged = $.session.get('bp_logged');
                if(typeof islogged === "undefined"){
                    window.location.url =  '<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY']; ?>/logout/' ;
                }
                Placetable.clear().draw();
                $("#overlay").show();
                var rowNode = Placetable.row;
                searchQuery = $.ajax({
                    type: "POST",
                    url: "getEntities.php",
                    data: $("#searchPlaceForm").serialize(),
                    dataType: 'text',
                    beforeSend : function(){
                        if(PlaceSearchQuery != null) {
                            PlaceSearchQuery.abort();
                        }
                    },
                    success: function(response){
                        if(response.length === 0 || !isJson(response)){
                            if(typeof DEBUG !== 'undefined' && DEBUG === true){
                                console.log('Main group loop');
                                console.log(response);
                            }
                        }
                        else{
                            var counter = 0;
                            var data = JSON.parse(response);
                            var numEl = data.length;
                            $('#totEl').text(numEl);
                            $.each(data, function(i, e){
                             $.ajax({
                                    type: "POST",
                                    url: "getEntityDetail.php",
                                    data: {'e':e.id, 't': 'place'},
                                    dataType: 'text',
                                    beforeSend: function(){
                                        $("#overlay_wait").show();
                                    },
                                    success: function(res){
                                        if(res.length === 0 || !isJson(res)){
                                              if(typeof DEBUG !== 'undefined' && DEBUG === true){
                                                console.log('Sub entity page loop');
                                                    console.log(res);
                                               }
                                         }
                                         else{
                                             var entity = JSON.parse(res);
                                             console.log(entity);
                                             rowNode.add( [entity.link, entity.category, entity.category_list, entity.location] ).draw().node();
                                            $('#laodEl').text(++counter);
                                        }
                                    }
                                });

                            });
                        }
                    }
                });

                $('#searchPlaceResults').show();

            });
});
</script>
