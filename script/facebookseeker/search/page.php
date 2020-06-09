
<div class=" ">

<form id="searchPageForm" class="form-horizontal" action="" method="post">
<fieldset>
    <legend>Search Pages</legend>
 <!-- Search input-->
    <div class="col-md-6  ">
        <div class=" ">
            <input id="searchpage" name="q" type="search" placeholder="Type your search terms like 'Restaurant'" class="form-control input-md">
        </div>
    </div>

<!-- Select Basic -->
    <div class="col-md-1">
      <div class=" ">
        <select id="limit" name="limit" class="form-control">
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
    <button id="btnsearchpage" name="btnsearchpage" class="btn btn-default">Search pages</button>
  </div>
</div>

</fieldset>
<input type="hidden" value="page" name="type" />
</form>




</div>
<div id="searchPageResults"></div>

<?php


?>
<script type="text/javascript">
$(document).ready(function(){
    var beginTableResult = '<table class="display table" cellspacing="0" width="100%" id="tablePageResult" ><thead><tr><th>Name</th><th>Emails</th><th>Website</th><th>Fan count</th><th>Category</th><th>Subcategories</th><th>Phone</th><th>Address</th><th>Page ID</th></tr></thead><tbody>';
    $('#searchPageResults').append(beginTableResult);
    var endTableResult = '</tbody><tfoot><tr><th>Name</th><th>Emails</th><th>Website</th><th>Fan count</th><th>Category</th><th>Subcategories</th><th>Phone</th><th>Address</th><th>Page ID</th></tr></tfoot></table>';
    $('#tablePageResult').append(endTableResult);

    var Pagetable = $('#tablePageResult').DataTable(
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
                                                { "width": "50px", "targets": [3] }
                                            ]
                                        });

Pagetable.buttons().container()
        .appendTo( '#tablePageResult_wrapper .col-sm-6:eq(0)' );
    $('#tablePageResult tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    Pagetable.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

var searchQuery  = null;
$("#searchPageForm").submit(function(e) {
                if($("#searchpage").val() == ''){
                    return;
                }
                e.preventDefault();
                var islogged = $.session.get('bp_logged');
                if(typeof islogged === "undefined"){
                    window.location.url =  '<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY']; ?>/logout/' ;
                }
                Pagetable.clear().draw();
                $("#overlay").show();
                var rowNode = Pagetable.row;
                searchQuery = $.ajax({
                    type: "POST",
                    url: "getEntities.php",
                    data: $("#searchPageForm").serialize(),
                    dataType: 'text',
                    beforeSend : function()    {
                        if(searchQuery != null) {
                            searchQuery.abort();
                        }
                    },
                    success: function(response){
                        if(response.length === 0 || !isJson(response)){
                            if(typeof DEBUG !== 'undefined' && DEBUG === true){
                                console.log('Main page loop');
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
                                        data: {'e':e.id, 't': 'page'},
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
                                                    rowNode.add( [entity.link, entity.emails, entity.website, entity.fan_count, entity.category, entity.category_list, entity.phone, entity.single_line_address, entity.id] ).draw().node();
                                                    $('#laodEl').text(++counter);
                                            }
                                        }
                                    });

                            });
                        }

                    }
                });

                $('#searchPageResults').show();
            });
    });
</script>
