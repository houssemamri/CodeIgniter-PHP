
$(document).ajaxSend(function(event, jqXHR, options) {
        $.xhrPool.push(jqXHR);
});

$( document ).ajaxComplete(function( event, xhr, settings )  {
        if(settings.url == 'getEntities.php'){
           var checker =  setInterval(function(){
                if($('#laodEl').text() == $('#totEl').text()){
                    $("#overlay").hide();
                    $('#laodEl').text('0');
                    $('#totEl').text('0');
                    clearInterval(checker);
                }
            }, 1000);
        }
});

$('#stopRequest').on('click', function(){
        abortAll();
        $("#overlay").hide();
        $('#laodEl').text('0');
        $('#totEl').text('0');
});

function abortAll() {
        $.xhrPool.abortAll();
}

 $(function() {
        $.xhrPool = [];
        $.xhrPool.abortAll = function() {
            $(this).each(function(i, jqXHR) {
                jqXHR.abort();
                $.xhrPool.splice(i, 1);
            });
        }
});
    


$(function(){
    $('#setting').on('click', function(e){
        e.preventDefault();
        $('#myModal').modal();
        
    });
    
    $('#cleartokens').on('click', function(e){
        var cleared = false;
        e.preventDefault();
        $('#overlay_modal').show();
        $.ajax({
            method: "POST",
            url: "clearTokenDir.php",
            data: { 
                    _action: 'cleardir',
                    _method: 'JXR'
                },
            error : function(){
                    
                    $('#ajaxmsg').html('<span class="alert alert-danger" ><i class="glyphicon glyphicon-warning-sign"></i> Comunication error!</span>');
            },
            success : function(r){
                    
                    var response = JSON.parse(r);
                    if(response.empty === true){
                        cleared = true;
                        $('#ajaxmsg').html('<span class="alert alert-success" ><i class="glyphicon glyphicon-ok"></i> All tokens deleted!</span>');
                    }
                    else{
                        $('#ajaxmsg').html('<span class="alert alert-warning" ><i class="glyphicon glyphicon-warning-sign"></i> Tokens not deleted!</span>');
                    }
            },
            complete : function(){
                $('#overlay_modal').hide();
                $('.alert').delay(3000).fadeOut();
                $("#myModal").on('hidden.bs.modal', function () {
                    if(cleared === true){
                        cleared = false;
                        window.location.reload();
                    }
                });
            }
            
        });
        
    });
    
    

    
    
    
$('#saveaccount').on('click', function(e){
        e.preventDefault();
        $('#overlay_modal').show();
        $.ajax({
            method: "POST",
            url: "changeProfile.php",
            data: { 
                    _action: 'changeaccount',
                    _method: 'JXR',
                    username : $('#username').val(),
                    password : $('#password').val()
                },
            error : function(){
                    
                    $('#ajaxmsg').html('<span class="alert alert-danger" ><i class="glyphicon glyphicon-warning-sign"></i> Comunication error!</span>');
            },
            success : function(r){
                    var response = JSON.parse(r);
                    if(response.type == 'success'){
                        $('#username').val(response.username);
                        $('#user-setting').text(response.username);
                        $('#password').val('');
                        $('#ajaxmsg').html('<span class="alert alert-success" ><i class="glyphicon glyphicon-ok"></i> Change saved!</span>');
                    }
                    else if(response.type == 'exist'){
                        $('#username').val(response.username);
                        $('#password').val('');
                        $('#ajaxmsg').html('<span class="alert alert-danger" ><i class="glyphicon glyphicon-warning-sign"></i> Username <strong>' + response.username + '</strong> already exists</span>');
                    }
                    else{
                        $('#ajaxmsg').html('<span class="alert alert-warning" ><i class="glyphicon glyphicon-warning-sign"></i> Change NOT saved!</span>');
                         
                    }
            },
            complete : function(){
                $('#overlay_modal').hide();
                $('.alert').delay(3000).fadeOut();
                
            }
        });
    });
});

function parseDateString(dateStr) {
        var dateDate = dateStr.split("T")[0];  
        var dateTime = dateStr.split("T")[1].substring(0, 8); 
        var dateResult = new Date(Date.UTC(  
            dateDate.split("-")[0], /* Year */  
            dateDate.split("-")[1], /* Month */  
            dateDate.split("-")[2], /* Day */  
            dateTime.split(":")[0], /* Hour */  
            dateTime.split(":")[1], /* Minute */  
            dateTime.split(":")[2]  /* Second*/  
        ));  
        return dateResult;  
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

