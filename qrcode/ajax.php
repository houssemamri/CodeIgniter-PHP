<?php
session_start();
require_once '../connection.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM fb_setting WHERE user_id=" . $user_id;
$result = $conn->query($sql);
if($result) {
    $row = $result->fetch_array();
    if(!is_null($row['fb_page_id'])){
       echo "<button class=\"btn btn-block btn-social btn-facebook\" id=\"facebook\">
                <span class=\"fa fa-facebook\"></span>

                    Share on Facebook
                </button>
                <script>
                    \$jquery('#facebook').click(function(){
                        var img = $('#img_png').attr('href');
                        window.open('/fb/post.php?url='+encodeURIComponent(img),'Share on Facebook', 'width=270, height=600');
                        $('#social_share').css('display','none');
                    });
                </script>
                ";
    }else{
        include_once '../fb/login_fb.php';




        echo "<a id=\"facebooklink\" class=\"btn btn-block btn-social btn-facebook\" target=\"_blank\" href=\"".$facebook_link."\">
            <span class=\"fa fa-facebook\"></span>
             Sign in with Facebook
                </a>
                    <script>
                    \$('#facebooklink').click(function(){
                            $('#social_share').css('display','none');
                    });
                </script>
                ";
    }
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM ig_setting WHERE user_id=" . $user_id;
$result = $conn->query($sql);
if($result) {
    $row = $result->fetch_array();
    if(!is_null($row['fb_page_id'])){
        echo "<button class=\"btn btn-block btn-social btn-instagram\" id=\"instagram\">
                <span class=\"fa fa-facebook\"></span>

                    Share on Facebook
                </button>
                <script>
                    \$jquery('#instagram').click(function(){
                        var img = $('#img_png').attr('href');
                        window.open('/ig/post.php?url='+encodeURIComponent(img),'Share on Instagram', 'width=270, height=600');
                        $('#social_share').css('display','none');
                    });
                </script>
                ";
    }else{
        include_once '../ig/login_ig.php';




        echo "<a id=\"instagramlink\" class=\"btn btn-block btn-social btn-instagram\" target=\"_blank\" href=\"".$facebook_link."\">
            <span class=\"fa fa-instagram\"></span>
             Sign in with Instagram
                </a>
                    <script>
                    \$('#instagramlink').click(function(){
                            $('#social_share').css('display','none');
                    });
                </script>
                ";
    }
}