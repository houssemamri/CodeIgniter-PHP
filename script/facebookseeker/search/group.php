<div class=" ">

<form id="searchGroupForm" class="form-horizontal" action="" method="post">
<fieldset>
    <legend>Search Groups</legend>
 <!-- Search input-->
    <div class="col-md-6  ">
        <div class=" ">
            <input id="searchgroup" name="q" type="search" placeholder="Type your search terms like 'Illusionist'" class="form-control input-md">
        </div>
    </div>

<!-- Select Basic -->
    <div class="col-md-1">
      <div class=" ">
        <select id="grouplimit" name="limit" class="form-control">
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
    <button id="btnsearchgroup" name="btnsearchgroup" class="btn btn-default">Search groups</button>
  </div>
</div>

</fieldset>
<input type="hidden" value="group" name="type" />
</form>

</fieldset>


</div>
<div id="searchGroupResults"></div>
<?php


?>
<script type="text/javascript">
$(document).ready(function(){
    
    var GroupBeginTableResult = '<table class="display" cellspacing="0" width="100%" id="tableGroupResult" class="table"><thead><tr><th>Name</th><th>Email</th><th>Owner</th><th>Parent</th><th>Privacy</th><th>Updated</th><th>Description</th><th>Group ID</th></tr></thead><tbody>';
    $('#searchGroupResults').append(GroupBeginTableResult);
    var GroupEndTableResult = '</tbody><tfoot><tr><th>Name</th><th>Email</th><th>Owner</th><th>Parent</th><th>Privacy</th><th>Updated</th><th>Description</th><th>Group ID</th></tr></tfoot></table>';
    $('#tableGroupResult').append(GroupEndTableResult);
    var Grouptable = $('#tableGroupResult').DataTable(
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
                                                    "targets": [ 6 ],
                                                    "visible": false
                                                  
                                                },
                                                {
                                                    "targets": [ 7 ],
                                                    "visible": false
                                                },
                                                
                                             
                                            ]
                                        });
 
    Grouptable.buttons().container()
        .appendTo( '#tableGroupResult_wrapper .col-sm-6:eq(0)' );
 
    $('#tableGroupResult tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    });

 
    Grouptable.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );


var GroupSearchQuery  = null;
$("#searchGroupForm").submit(function(e) {
                if($("#searchgroup").val() == ''){
                    return;
                }
                e.preventDefault();
                var islogged = $.session.get('bp_logged');
                if(typeof islogged === "undefined"){
                    window.location.url =  '<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY']; ?>/logout/' ;
                }
 
                Grouptable.clear().draw();
                $("#overlay").show();
                var rowNode = Grouptable.row;
                searchQuery = $.ajax({
                    type: "POST",
                    url: "getEntities.php",
                    data: $("#searchGroupForm").serialize(),
                    dataType: 'text',
                    beforeSend : function(){
                        if(GroupSearchQuery != null) {
                            GroupSearchQuery.abort();
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
                                    data: {'e':e.id, 't': 'group'},
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
                                             var updated_time = entity.updated_time;
                                             
                                             rowNode.add( [entity.link, entity.email, entity.owner, entity.parent, entity.privacy, updated_time, entity.description, entity.id] ).draw().node();
                                            $('#laodEl').text(++counter);
                                        }
                                    }
                                });

                            });
                        }
                    }
                });

                $('#searchGroupResults').show();

            });
});
</script>
