<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="overlay_modal">
                <div class='uil-ring-css' style='transform:scale(0.6);'><div></div></div>
            </div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style=" " class="modal-title" id="myModalLabel">Settings</h4>
                <div style=" " id="ajaxmsg"></div>
            </div>
            <div class="modal-body">
            <form id="account-form" action="." method="post" role="form" style="display: block;">
                <div class="form-group">
                    <div>
                        <input id="username" name="username" value="<?php echo $_SESSION['user']; ?>" placeholder="New User Name" class="form-control input-md" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <input id="password" name="password" placeholder="New password" class="form-control input-md" type="password">
                    </div>
                </div>
            </form>
        </div>
          <div class="modal-footer">
            <div class="col-sm-12 pull-right">
                    <button type="button" id="cleartokens" class="btn btn-warning">Clear tokens</button>
                    <button type="button" id="saveaccount" class="btn btn-info">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function checkLoginStatus(){

    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        var uid = response.authResponse.userID;
        $.post('./setSessionUID.php', {"UID": uid}, function(r){});
      } else if (response.status === 'not_authorized') {
          FB.login(function(response) {
            if (response.authResponse) {
                window.location.reload();
            }
            else{
                window.location.replace('<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY'];?>/logout/?type=authorize');
            }
        }, {scope: 'public_profile'}); 
      } else {
        FB.login(function(response) {
            if (response.authResponse) {
                window.location.reload();
            }
            else{
                wiwindow.location.replace('<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY'];?>/logout/?type=authorize');
            }
          }, {scope: 'public_profile'});
        }
      }, true);
    }

function isJson(item) {
    item = typeof item !== "string"
        ? JSON.stringify(item)
        : item;

    try {
        item = JSON.parse(item);
    } catch (e) {
        return false;
    }

    if (typeof item === "object" && item !== null) {
        return true;
    }

    return false;
}
</script>
</body>
</html>
