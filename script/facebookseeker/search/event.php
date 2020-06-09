<div class=" ">

<form id="searchEventForm" class="form-horizontal" action="" method="post">
<fieldset>
    <legend>Search Events</legend>
 <!-- Search input-->
    <div class="col-md-6  ">
        <div class=" ">
            <input id="searchevent" name="q" type="search" placeholder="Type your search terms like 'Burning Man'" class="form-control input-md">
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
    <button id="btnsearchevent" name="btnsearchevent" class="btn btn-default">Search Events</button>
  </div>
</div>

</fieldset>
<input type="hidden" value="event" name="type" />
</form>

</fieldset>


</div>
<div id="searchEventResults"></div>
<?php


?>
<script type="text/javascript">
$(document).ready(function(){
    
    var EventBeginTableResult = '<table class="display" cellspacing="0" width="100%" id="tableEventResult" class="table"><thead><tr><th>Event</th><th>Place</th><th>Owner</th><th>Attending</th><th>Declined</th><th>Interested</th><th>Maybe</th><th>No replay</th><th>Start</th><th>End</th><th>Category</th><th>Description</th></tr></thead><tbody>';
    $('#searchEventResults').append(EventBeginTableResult);
    var EventEndTableResult = '</tbody><tfoot><tr><th>Event</th><th>Place</th><th>Owner</th><th>Attending</th><th>Declined</th><th>Interested</th><th>Maybe</th><th>No replay</th><th>Start</th><th>End</th><th>Category</th><th>Description</th></tr></tfoot></table>';
    $('#tableEventResult').append(EventEndTableResult);

    var Eventtable = $('#tableEventResult').DataTable(
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
                                                    orientation: 'landscape',
                                                    pageSize: 'A4'
                                                },
                                                'colvis'
                                            ],
                                            
                                            "columnDefs": [
                                                {
                                                    "targets": [ 5 ],
                                                    "visible": false
                                                     
                                                },
                                                {
                                                    "targets": [ 6 ],
                                                    "visible": false
                                                },
                                                {
                                                    "targets": [ 7 ],
                                                    "visible": false
                                                },
                                                {
                                                    "targets": [ 8 ],
                                                    "visible": false
                                                },
                                                {
                                                    "targets": [ 9 ],
                                                    "visible": false
                                                },
                                                {
                                                    "targets": [ 10 ],
                                                    "visible": false
                                                },
                                                {
                                                    "targets": [ 11 ],
                                                    "visible": false
                                                }
                                               
                                            ]
                                        });
 
    Eventtable.buttons().container()
        .appendTo( '#tableEventResult_wrapper .col-sm-6:eq(0)' );
 
    $('#tableEventResult tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    });

 
    Eventtable.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );


var EventSearchQuery  = null;
$("#searchEventForm").submit(function(e) {
                if($("#searchevent").val() == ''){
                    return;
                }
                e.preventDefault();
                var islogged = $.session.get('bp_logged');
                if(typeof islogged === "undefined"){
                    window.location.url =  '<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY']; ?>/logout/' ;
                }
                Eventtable.clear().draw();
                $("#overlay").show();
                var rowNode = Eventtable.row;
                searchQuery = $.ajax({
                    type: "POST",
                    url: "getEntities.php",
                    data: $("#searchEventForm").serialize(),
                    dataType: 'text',
                    beforeSend : function(){
                        if(EventSearchQuery != null) {
                            EventSearchQuery.abort();
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
                                    data: {'e':e.id, 't': 'event'},
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
                                             var start_time = entity.start_time;
                                             var end_time = entity.end_time;
                                             rowNode.add( [entity.link, entity.place, entity.owner, entity.attending_count, entity.declined_count, entity.interested_count, entity.maybe_count, entity.noreply_count, start_time, end_time, entity.category, entity.description ] ).draw().node();
                                            $('#laodEl').text(++counter);
                                        }
                                    }
                                });

                            });
                        }
                    }
                });

                $('#searchEventResults').show();

            });
});
</script>
