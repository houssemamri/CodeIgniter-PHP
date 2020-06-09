
/*!
 * QRCDR setup
 */
// Print QRCODE
var win = null;
var $jquery = jQuery.noConflict();

function printIt(printThis) {
	var title = document.title;
	var img = $jquery(printThis).find('img').attr('src');
	var content = '<html><head><title>'+title+'</title></head><body><img src="'+img+'"/><body></html>';
	win = window.open();
	self.focus();
	win.document.open();
	win.document.write(content);
	win.document.close();

	win.onload = function (){
		win.print();
		win.close();
	}
}

function initialize() {

	if ( $jquery( "#map-canvas" ).length ) {
		// Google MAP
		var start = new google.maps.LatLng(40.7127837, -74.00594130000002);
		var marker;
		var map;
		var input = (document.getElementById('pac-input'));
		var getdata = (document.getElementById('latlong'));
		var latbox = document.getElementById('latbox');
		var lngbox = document.getElementById('lngbox');

		var searchBox;

	    var mapOptions = {
	        zoom: 10,
	        center: start
	    };

	    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	    searchBox = new google.maps.places.SearchBox((input));
	    marker = new google.maps.Marker({
	        map:map,
	        draggable:true,
	        animation: google.maps.Animation.DROP,
	        position: start
	    });

	    google.maps.event.addListener(marker, 'dragend', function(event) {
	        var latlang = marker.getPosition().lat()+","+marker.getPosition().lng();
	        updateposition(latlang);
	    });

	    map.controls[google.maps.ControlPosition.TOP_LEFT].push(getdata);

	    if ((latbox.value.length > 0 ) && (lngbox.value.length > 0)) {
	        setfirst(Number(latbox.value), Number(lngbox.value));
	    }

	    google.maps.event.addListener(searchBox, 'places_changed', function() {
	        var places = searchBox.getPlaces();

	        if (places.length == 0) {
	          return;
	        }

	        for (var i = 0, place; place = places[i]; i++) {
	            marker.setPosition(place.geometry.location);
	            map.setCenter(place.geometry.location);
	            updateposition();
	        }
	    });
	}

	function updateposition(){
	    latbox.value = marker.getPosition().lat();
	    lngbox.value = marker.getPosition().lng();
	}


	function setfirst(latvar, lngvar){
	    map.setCenter({lat: latvar, lng: lngvar});
	    marker.setPosition({lat: latvar, lng: lngvar});
	}
}

$jquery('#submitcreate').on('click', function() {

	$jquery('.colorpickerback').colorpicker('enable');

    $jquery('.preloader').fadeIn(100,function(){

		var sendata = $jquery("#create :input")
	    .filter(function(index, element) {
	        return $jquery(element).val() != "";
	    })
	    .serialize();
		console.log(sendata);
        $jquery.ajax({
            type: "POST",
            url: "qrcode/process.php",
            cache: false,
            data: sendata,
			 dataType: 'json',
        })
        .fail(function(error) {
            console.log(error)

            $jquery("#alert_placeholder").html('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><span class="error-response">'+error.statusText+'</span></div>');
        })
        .done(function(msg) {

			if ($jquery('#trans-bg').prop('checked')) {
				$jquery('.colorpickerback').colorpicker('disable')
			}
			console.log(msg)
            var result = JSON.parse(JSON.stringify(msg));

            if (result.hasOwnProperty('errore')) {

                $jquery("#alert_placeholder").html('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><span class="error-response">'+result.errore+'</span></div>');
                $jquery('.resultholder img').attr('src', result.placeholder);

            } else {
                d = new Date();
				$jquery("#alert_placeholder").html('');

                var linksholder = '<a class="btn btn-default" id="img_png" href="qrcode/get.php?path='+result.png+'"><i class="fa fa-download"></i> PNG</a>';
                linksholder = linksholder + '<a class="btn btn-default" href="qrcode/get.php?path='+result.svg+'"><i class="fa fa-download"></i> SVG</a>';
                linksholder = linksholder + '<a class="btn btn-default" href="qrcode/get.php?path='+result.eps+'"><i class="fa fa-download"></i> EPS</a>';
                linksholder = linksholder + '<button class="btn btn-default print"><i class="fa fa-print"></i></button>';

                $jquery('.linksholder').html(linksholder);
            $jquery('.resultholder img').attr('src',result.placeholder+'?'+d.getTime());
                $jquery('.print').click(function(){
                	printIt('.resultholder');
                });
                $jquery('.hide_share').css('display','block');

            }


            $jquery('.preloader').fadeOut('slow');

        });
    });

});


$jquery(document).ready(function(){
        $('button.nav-link1').click(function(){

            $('button.nav-link1').removeClass('active');
            $(this).addClass('active');
            var tagid = $(this).data('href');
            $('.tab-pane1').removeClass('active').addClass('hide');
            $('#'+tagid).addClass('active').removeClass('hide');
			$("#getsec").val('#'+tagid);

        });
        $('.tab-pane1 textarea').ckeditor();
	$jquery('.hide_share').click(function(){

        $jquery.ajax({
            type: 'get',
            url: 'qrcode/ajax.php',
        	success: function (response) {
                console.log(response);

                $jquery('#social_share').html(response);
                $jquery('#social_share').css('display','block');
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(thrownError);
                console.log(xhr);
            }
        });
        //$jquery('.hide_share_click').css('display','block');
	});

	// SET CURRENCY
    $jquery("#setcurrency").change(function(){
        var value = $jquery(this).val();
        $jquery("#getcurrency").html(value);
    });

   	// PAYPAL BUTTON TYPE
    $jquery("#pp_type").change(function(){
        var value = $jquery(this).val();


        if(value === '_donations') {
        	console.log(value)
        	$jquery(".nodonation").addClass('hidden');
        	$jquery(".yesdonation").removeClass('col-sm-3');
        } else {
        	$jquery(".nodonation").removeClass('hidden');
        	$jquery(".yesdonation").addClass('col-sm-3');
        }
    });

    // COLOR PICKER

    $jquery('.colorpickerback').colorpicker();
    $jquery('.colorpickerfront').colorpicker();
    var backcol = $jquery('.colorpickerback').val();
    var frontcol = $jquery('.colorpickerfront').val();
    $jquery('.getcol').css('background',backcol);
    $jquery('.getcol').css('color',frontcol);

    $jquery('#file').change(function(){
        $jquery('#sottometti').submit();
    });

   // $jquery(".alert").alert();

    $jquery('.colorpickerback').colorpicker().on('changeColor', function(ev){
        var color = ev.color.toString('hex');
        $jquery('.getcol').css('background',color);
    });
    $jquery('.colorpickerfront').colorpicker().on('changeColor', function(ev){
        var color = ev.color.toString('hex');
        $jquery('.getcol').css('color',color);
    });

    $jquery('.tooltipper').tooltip();
});

$jquery(document).on('change', '#trans-bg', function(){
	if ($jquery(this).prop('checked')) {
		$jquery('.colorpickerback').colorpicker('setValue', '#ffffff');
		$jquery('.colorpickerback').colorpicker('disable')
	} else {
		$jquery('.colorpickerback').colorpicker('enable');
	}
})

// $jquery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//     var dest = $jquery(e.target).attr('href');
//     $jquery("#getsec").val(dest);
//
//     if (dest == "#location") {
//         initialize();
//     }
// });

