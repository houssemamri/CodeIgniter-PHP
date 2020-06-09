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
<style>
    .avatar-png{
        margin-left: 1rem;
        margin-bottom: 1rem;

    }
    .avatar-png > .active{
        border: 1px solid blue;
    }
    .avatar-personnageSelection{
        font-size:1.3rem;
        margin-top: 2rem;
    }
    .bubble-png{
        margin-left: 1rem;
        margin-bottom: 1rem;
    }
    .bubble-png > img{
        width: 200px;
        height: 150px;
    }
    .bubble-png > .active{
        border: 1px solid blue;
    }
</style>
<div class="row">
    <h6 class="center-text" style="font-weight:bold;font-size:32px;"><?php echo $manageAvatar;?></h6>
    <div class="col-lg-12">
        <span class="avatar-personnageSelection">
            <?php echo $personnageSelection;?> :
        </span>
    </div><br><br>
    <div class="col-lg-12">
        <?php for($i = 1;$i<11;$i++){?>
            <a class="avatar-png" data-id="<?=$i?>" href="#"><img class="<?php if($row['avatar'] == $i){ echo 'active';}?>" src="avatar/img/avatar/<?=$i?>.png" ></a>
        <?php } ?>
    </div>
</div><br><br>
<div class="row">
    <div class="col-lg-12">
        <span class="avatar-personnageSelection">
            <?php echo $bubbleSelection;?> :
        </span>
    </div><br><br>
    <div class="col-lg-12">
        <?php for($i = 1;$i<3;$i++){?>
            <a class="bubble-png" data-id="<?=$i?>" href="#"><img class="<?php if($row['bubble'] == $i){ echo 'active';}?>" src="avatar/img/bubble/<?=$i?>.png" ></a>
        <?php } ?>
    </div>
</div>
<form  method="post" id="avatarForm">
    <input type="hidden" value="<?=$row['avatar']?>" name="avatar_post" id="avatar_post">
</form>
<form method="post" id="bubbleForm">
    <input type="hidden" value="<?=$row['bubble']?>" name="bubble_post" id="bubble_post">
</form>
<script>
    $jquery("a.avatar-png").click(function (e) {
        e.preventDefault();
        $jquery('a.avatar-png').not(this).each(function(){
            $jquery(this).children().removeClass('active');
        });
        $jquery(this).children().addClass('active');

        $jquery('#avatar_post').val($jquery(this).data("id"));
        load_avatar();

    });
    $jquery("a.bubble-png").click(function (e) {
        e.preventDefault();
        $jquery('a.bubble-png').not(this).each(function(){
            $jquery(this).children().removeClass('active');
        });
        $jquery(this).children().addClass('active');
        $jquery('#bubble_post').val($jquery(this).data("id"));
        load_bubble();
    });
    function load_avatar(){
        $jquery.ajax({
            type: 'post',
            url: 'avatar/update_avatar.php',
            data: $('#avatarForm').serialize(),
            success: function (response) {
                window.location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(thrownError);
                console.log(xhr);
            }
        });
    }
    function load_bubble(){
        $jquery.ajax({
            type: 'post',
            url: 'avatar/update_bubble.php',
            data: $('#bubbleForm').serialize(),
            success: function (response) {
                window.location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(thrownError);
                console.log(xhr);
            }
        });
    }
</script>