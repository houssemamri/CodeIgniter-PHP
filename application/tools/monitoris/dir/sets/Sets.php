<?php
class Sets {
    protected $CI;
    /**
     * Load networks and user model.
     */
    public function __construct() {
        $this->CI =& get_instance();
        if ( file_exists( APPPATH . 'language/' . $this->CI->config->item('language') . '/default_tool_lang.php' ) ) {
            $this->CI->lang->load( 'default_tool', $this->CI->config->item('language') );
        }
    }
    public function show() {
        return "
            <link rel=\"stylesheet\" type=\"text/css\" href=\"" . base_url() . "assets/user/css/bootstrap-datetimepicker.css\"/>
            <style>
            .single-activity{
                margin-bottom:30px;
            }
            @media screen and (max-width: 767px){
                .col-lg-6, .col-md-6, .col-sm-12, .col-xs-12, .col-md-12{
                    position: inherit !important;
                }            
            }
            .new-rss>div>.row{
            display:none;
            }
            .new-rss>.col-lg-12
            {
            background-color: transparent;
                box-shadow: none;
            }
            .new-rss .col-lg-offset-3>.col-lg-12
            {
            background-color: " . bg_color . ";
            }
            .new-rss .panel-heading{
            background-color: " . bar_color . ";
            color: " . bar_text . ";
            }
            .new-rss p{
                margin: 7px 0 15px 0;
            }
            .new-rss img{
            max-width:100%;
            }
            .fa-angle-right{
            margin:0 7px;
            color: #999;
            }
            .new-rss .panel-footer,.modal-content{
                background: #fafafa;
                border: 1px solid #eeeeee;
                margin: 15px;
                padding: 10px 0px !important;
            }
            .mop{
                float: right !important;
                margin: 0 !important;
                padding: 0 !important;
                margin-top: -50px !important;
                height: 10px !important;
            }
            .mop>li{
                margin: 0 !important;
                padding: 0 !important;
                list-style: none !important;
                text-align: right !important;
                height: 10px !important;
                border: 0 !important;
            }
            .mop>li>ul{
                margin-top: -30px !important;
                margin-left: -140px !important;
                border-radius:0 !important;
            }
            .mop>li>ul>li{
                min-height: 30px !important;
            }
            .mop>li>ul>li>a{
                line-height: 30px !important;
                padding: 5px !important;
            }
            .mop>li>ul>li>a:hover{
                background-color: transparent !important;
                text-decoration:underline !important;
            }
            .nav-tabs>li{
                width: initial !important;
                display: inline-block !important;
                min-height: 30px !important;
            }
            .new-rss .mop>li>ul>li>a:hover,.new-rss .nav-tabs>li>a:hover{
                background-color: transparent !important;
                text-decoration:underline !important;
            }
            .new-rss .nav-tabs>li{
                min-height: 30px !important;
                border:0 !important;
            }
            .new-rss .nav-tabs>li>a{
                line-height: 30px !important;
                padding: 5px 15px !important;
                border:0 !important;
                color:#7f7f7f;
                font-weight:600;
            }
            .new-rss .nav-tabs>li>a:hover{
                background-color: transparent !important;
                text-decoration:none !important;
                color: #7f7f7f;
            }
            .new-rss .nav-tabs>li.active>a,.new-rss .nav-tabs>li.active>a:focus,.new-rss .nav-tabs>li.active>a:hover
            {
                background-color: transparent !important;
                text-decoration:none !important;
                border-bottom: 2px solid #7f7f7f !important;
            }
            .nav-tabs>li{
                width: initial !important;
                display: inline-block !important;
                min-height: 30px !important;
            }
            .comfo .tab-content{
            padding:15px;
            }
            .comfo .tab-content textarea,.modal-content textarea{
                width: 100%;
                height: 100px;
                border: 0;
                resize: none;
                border-bottom: 2px solid #1dc3d3;
            }
            .comfo .tab-content textarea:focus,.comfo .tab-content textarea:active,.modal-content textarea:focus,.modal-content textarea:active{
                outline:none;
            }
            .comments>div>div>ul{
                margin-bottom:20px;
            }
            .comments>div>div>ul>li,.likes>ul>li{
                border: 1px solid #ddd !important;
                border-radius: 0 !important;
                margin-bottom:15px;
                min-height: 10px !important;
            }
            .comments>div>div>ul>li .com-info{
                margin-bottom: 5px;
            }
            .likes>div>div>ul>li .like-info{
                margin-bottom: 0;
            }
            .comments>div>div>ul>li .comment-reply{
                margin-top:10px;
            }
            .comments>div>div>ul>li .comment-reply>a{
                color: #1dc3d3;
                margin-right:15px;
            }
            .comments>div>div>ul>li .comment-reply>a.dc{
                color: #f05a75;
                margin-right:15px;
            }
            .comfo .tab-content .btn,.modal-content .btn{
                text-decoration: none;
                color: #fff;
                background-color: #26a69a;
                text-align: center;
                letter-spacing: .5px;
                transition: .2s ease-out;
                cursor: pointer;
                border:0;
            }
            .comfo .tab-content .btn:hover,.modal-content .btn:hover{
                position: relative;
                cursor: pointer;
                display: inline-block;
                overflow: hidden;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-tap-highlight-color: transparent;
                vertical-align: middle;
                z-index: 1;
                will-change: opacity, transform;
                transition: .3s ease-out;
                background-color: #2bbbad;
            }
            .replies{
                margin-left: 5% !important;
                width: 95% !important;
            }
            .panel-heading>h2>a {
                color: #323638 !important;
            }
            .pagehide>a{
                background: #eeeeee !important;
            }
            .schedule-deletion{
                height: 32px;
                padding: 0 5px !important;
            }
            .schedule-deletion:focus,.schedule-deletion:active{
                outline:none !important;
                box-shadow: none !important;
                border-color: #dbdbdb !important;
            }
            .bs-delete-post form,.bs-repost-post form{
                padding: 0 18px !important;
                height: 55px;
            }
            .sched-del{
                display: inline-block;
                font-size: 14px;
                text-align: left;
                background-color: #fff;
                height: 40px;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.2);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                margin-bottom: 10px;
                width: 100% !important;
            }
            .will-del.hide{
                display:none;
            }
            .sched-del>.del-text{
                line-height: 40px;
                padding: 0 45px;
            }            
            .sched-del > .del-split{
                background: #337ab7;
                width: 33px;
                float: left;
                color: #fff!important;
                height: 100%;
                text-align: center;
                line-height: 40px;
                font-size: 17px;
            }
            .sched-del > .del-split.del-danger{
                background: #d9534f!important;
            }
            .btn-del-sched{
                margin-top: -2px !important;
            }
            .table-sm .fa-calendar-check-o{
                margin-right: 5px !important;            
            }
            .table-sm .btn-group
            {
                position:absolute !important;
                margin-top: 2px !important;
                margin-left: 10px !important;
            }
            .table-sm .btn-group.open li,.table-sm .btn-group.open li>a
            {
                min-height: 30px !important;
                width: 100% !important;
                margin-top: 0px !important;
            }
            .table-sm{
                color: #999;
            }
            .table-sm.table>tbody>tr>td:hover,.table-sm.table>tbody>tr>td:hover button{
                color: #333;
            }
            .table-sm .glyphicon{
                top: 2px;
                left: 0px;
            }
            .modal .btn-circle{
                margin-top: 12px;
                height: 34px;
            }
            .modal .time-schedule{
                height: 34px;
            }
            </style>
            <script type=\"text/javascript\">
            window.onload = function(){
                var com = {},sched = {};
                function cl(m){
                    var mess = btoa(encodeURIComponent(m));
                    mess = mess.replace('/', '-');
                    mess = mess.replace(/=/g, '');
                    return mess;
                }
                var home = document.getElementsByClassName('navbar-brand')[0];
                function caload(e){
                    e.preventDefault();
                    var url = home+'user/tool/monitoris?action=comment';
                    var msg = e.target.getElementsByClassName('msg')[0].value;
                    var post = this.getAttribute('data-post');
                    var account = this.getAttribute('data-account');
                    var act = this.getAttribute('data-act');
                    var csr = document.querySelector(\"[name='csrf_test_name']\").value;
                    var params = 'csrf_test_name='+csr+'&msg='+msg+'&post='+post+'&account='+account+'&act='+act;
                    var http = new XMLHttpRequest();
                    http.open('POST', url, true);
                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                document.getElementById('act-'+act).innerHTML = data;
                                loadEx();
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send(params);
                }
                function mark_seen(e) {
                    e.preventDefault();
                    var act = this.getAttribute('data-id');
                    var url = home+'user/tool/monitoris?action=seen&id='+act;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            if(http.responseText == 1) {
                                document.getElementById('activity-'+act).remove();
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function deload(e){
                    e.preventDefault();
                    var comment = this.getAttribute('data-comment');
                    var account = this.getAttribute('data-account');
                    var act = this.getAttribute('data-act');
                    var url = home+'user/tool/monitoris?action=del-com&comment='+comment+'&account='+account+'&act='+act;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                document.getElementById('act-'+act).innerHTML = data;
                                loadEx();
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function dshed(e){
                    e.preventDefault();
                    var idu = this.getAttribute('data-id');
                    var his = this;
                    var url = home+'user/delete-post/'+idu;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                if(data == 1) {
                                    document.querySelector('.pt-'+idu).remove();
                                } else {
                                    popup_fon('sube', translation.mm3, 1500, 2000);
                                }                            
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }
                function stime(e){
                    e.preventDefault();
                    var idu = this.getAttribute('data-id');
                    var tim = this.getAttribute('data-time');
                    var text = this.textContent;
                    var his = this;
                    var url = home+'user/tool/monitoris?action=schedmu&id='+idu+'&time='+tim;
                    var http = new XMLHttpRequest();
                    http.open('GET', url, true);
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                document.querySelector('.pt-'+idu+' .deleted-after').innerText = text;
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send();
                }                
                function dpi(e)
                {
                    e.preventDefault();
                    var act = this.getAttribute('data-id');
                    sched.id = act;
                }
                function rpi(e)
                {
                    e.preventDefault();
                    var act = this.getAttribute('data-id');
                    sched.id = act;
                }                
                function loadThis(e)
                {
                    e.preventDefault();
                    var comment = this.getAttribute('data-comment');
                    var account = this.getAttribute('data-account');
                    var act = this.getAttribute('data-act');
                    com.comment = comment;
                    com.account = account;
                    com.act = act;
                }
                function relo(e){
                    e.preventDefault();
                    var url = home+'user/tool/monitoris?action=add-reply';
                    var msg = e.target.getElementsByClassName('msg')[0].value;
                    var post = com.comment;
                    var account = com.account;
                    var act = com.act;
                    var csr = document.querySelector(\"[name='csrf_test_name']\").value;
                    var params = 'csrf_test_name='+csr+'&msg='+msg+'&post='+post+'&account='+account+'&act='+act;
                    var http = new XMLHttpRequest();
                    http.open('POST', url, true);
                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            document.querySelector('.modal.fade.in').click();
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                document.getElementById('act-'+act).innerHTML = data;
                                loadEx();                                
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send(params);
                }
                function deli(e){
                    e.preventDefault();
                    var cd = new Date();
                    var datetime = cd.getFullYear() + '-' + (cd.getMonth() + 1) + '-' + cd.getDate() + ' ' + cd.getHours() + ':' + cd.getMinutes() + ':' + cd.getSeconds();
                    var url = home+'user/tool/monitoris?action=add-del';
                    var act = sched.id;
                    var msg = document.getElementsByClassName('schedule-deletion')[0].value;
                    var csr = document.querySelector(\"[name='csrf_test_name']\").value;
                    var params = 'csrf_test_name='+csr+'&act='+act+'&msg='+cl(msg)+'&cd='+cl(datetime);
                    var http = new XMLHttpRequest();
                    http.open('POST', url, true);
                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            document.querySelector('.modal.fade.in').click();
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                if(!isNaN(data.res)) {
                                    document.querySelector('#activity-'+act+' .will-del').classList.remove('hide');
                                    var tv = calculate_time(data.res, data.tm);
                                    tv = tv.replace('<i class=\"fa fa-calendar-check-o\" aria-hidden=\"true\"></i>','');
                                    document.querySelector('#activity-'+act+' .del-text').innerText = '" . $this->CI->lang->line('mt67') . " '+tv+'.';
                                } else {
                                    popup_fon('sube', translation.mm3, 1500, 2000);
                                }
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send(params);
                }
                function fali(e){
                    e.preventDefault();
                    var cd = new Date();
                    var datetime = cd.getFullYear() + '-' + (cd.getMonth() + 1) + '-' + cd.getDate() + ' ' + cd.getHours() + ':' + cd.getMinutes() + ':' + cd.getSeconds();
                    var url = home+'user/tool/monitoris?action=spm';
                    var act = sched.id;
                    var msg = document.getElementsByClassName('schedule-rep')[0].value;
                    var csr = document.querySelector(\"[name='csrf_test_name']\").value;
                    var params = 'csrf_test_name='+csr+'&act='+act+'&msg='+cl(msg)+'&cd='+cl(datetime);
                    var http = new XMLHttpRequest();
                    http.open('POST', url, true);
                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            document.querySelector('.modal.fade.in').click();
                            var data = http.responseText;
                            if(data) {
                                data = JSON.parse(data);
                                document.querySelector('#activity-'+act+' #reposts').innerHTML = data;
                                loadEx();
                            } else {
                                popup_fon('sube', translation.mm3, 1500, 2000);
                            }
                        }
                    }
                    http.send(params);
                }
                function loadEx(){
                    var form = document.getElementsByClassName('add-comment');
                    if(form.length > 0) {
                        if(form[0].addEventListener){
                            for(var f = 0; f < form.length; f++) {
                                form[f].addEventListener('submit', caload, false);
                            }
                        } else if(form[0].attachEvent) {
                            for(var f = 0; f < form.length; f++) {
                                form[f].attachEvent('onsubmit', caload);
                            }
                        }
                    }
                    var repo = document.getElementsByClassName('add-reply');
                    if(repo.length > 0) {
                        if(repo[0].addEventListener) {
                            for(var f = 0; f < repo.length; f++) {
                                repo[f].addEventListener('submit', relo, false);
                            }
                        }else if(repo[0].attachEvent){
                            for(var f = 0; f < repo.length; f++) {
                                repo[f].attachEvent('onsubmit', relo);
                            }
                        }
                    }        
                    var del = document.getElementsByClassName('delete-reply');
                    if(del.length) {
                        if(del[0].addEventListener) {
                            for(var f = 0; f < del.length; f++) {
                                del[f].addEventListener('click', deload, false);
                            }
                        } else if(del[0].attachEvent) {
                            for(var f = 0; f < del.length; f++) {
                                del[f].attachEvent('onclick', deload);
                            }
                        }
                    }
                    var reply = document.getElementsByClassName('reply-this');
                    if(reply.length) {
                        if(reply[0].addEventListener){
                            for(var f = 0; f < reply.length; f++) {
                                reply[f].addEventListener('click', loadThis, false);
                            }
                        }else if(reply[0].attachEvent){
                            for(var f = 0; f < reply.length; f++) {
                                reply[f].attachEvent('onclick', loadThis);
                            }
                        }
                    }
                    var seen = document.getElementsByClassName('seen-it');
                    if(seen.length) {
                        if(seen[0].addEventListener) {
                            for(var f = 0; f < seen.length; f++) {
                                seen[f].addEventListener('click', mark_seen, false);
                            }
                        } else if(seen[0].attachEvent) {
                            for(var f = 0; f < seen.length; f++) {
                                seen[f].attachEvent('onclick', mark_seen);
                            }
                        }
                    }
                    var rp = document.getElementsByClassName('repost-post');
                    if(rp.length) {
                        if(rp[0].addEventListener) {
                            for(var f = 0; f < rp.length; f++) {
                                rp[f].addEventListener('click', rpi, false);
                            }
                        } else if(rp[0].attachEvent) {
                            for(var f = 0; f < rp.length; f++) {
                                rp[f].attachEvent('onclick', rpi);
                            }
                        }
                    }                    
                    var dp = document.getElementsByClassName('delete-post');
                    if(dp.length) {
                        if(dp[0].addEventListener) {
                            for(var f = 0; f < dp.length; f++)
                            {
                                dp[f].addEventListener('click', dpi, false);
                            }
                        } else if(dp[0].attachEvent) {
                            for(var f = 0; f < dp.length; f++) {
                                dp[f].attachEvent('onclick', dpi);
                            }
                        }
                    }
                    var ds = document.getElementsByClassName('bschd');
                    if(ds.length) {
                        if(ds[0].addEventListener){
                            for(var f = 0; f < ds.length; f++) {
                                ds[f].addEventListener('click', dshed, false);
                            }
                        }else if(ds[0].attachEvent){
                            for(var f = 0; f < ds.length; f++) {
                                ds[f].attachEvent('onclick', dshed);
                            }
                        }
                    }
                    var sct = document.getElementsByClassName('sche-time');
                    if(sct.length) {
                        if(sct[0].addEventListener){
                            for(var f = 0; f < sct.length; f++)
                            {
                                sct[f].addEventListener('click', stime, false);
                            }
                        }else if(sct[0].attachEvent){
                            for(var f = 0; f < sct.length; f++)
                            {
                                sct[f].attachEvent('onclick', stime);
                            }
                        }
                    }                    
                    var set_date = document.getElementsByClassName('set-date')[0];
                    if(set_date) {
                        if(set_date.addEventListener) {
                            set_date.addEventListener('submit', deli, false);
                        } else if(set_date.attachEvent) {
                            set_date.attachEvent('onsubmit', deli);
                        }
                    }
                    var shed_date = document.getElementsByClassName('shed-date')[0];
                    if(shed_date) {
                        if(shed_date.addEventListener) {
                            shed_date.addEventListener('submit', fali, false);
                        } else if(shed_date.attachEvent) {
                            shed_date.attachEvent('onsubmit', fali);
                        }
                    }
                }
                loadEx();
            }
            </script>";

    }

}
