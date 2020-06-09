
    <!-- Right Panel -->

    <script src="<?php echo base_url();?>assets/admin/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/plugins.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/main.js"></script>


    <script src="<?php echo base_url();?>assets/admin/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/dashboard.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/widgets.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.tinymce.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            width: 700,
            menubar: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']
        });
    </script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

</body>
</html>
