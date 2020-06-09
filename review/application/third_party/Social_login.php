<?php
class Social_login{
    public function key_rep($key) {
        if($key) {
            return strtolower(str_replace([' '],['_'],$key));
        } else {
            return false;
        }
        
    }
    public function content($a,$b,$c,$d,$e,$f,$h=NULL) {
        if($b == 'Password') {
            $p = '<input required="" id="password" name="password" class="form-control" type="password" placeholder="********">';
        } else {
            $p = '<input required="" id="' . $this->key_rep($b) . '" name="' . $this->key_rep($b) . '" type="text" class="form-control" placeholder="' . $b . '">';
        }
        $t = '<div class="control-group">
                <label class="control-label" for="user">' . $a . ':</label>
                <div class="controls">
                    <input required="" id="' . $this->key_rep($a) . '" name="' . $this->key_rep($a) . '" type="text" class="form-control" placeholder="' . $a . '">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="' . $this->key_rep($b) . '">' . $b . ':</label>
                <div class="controls">
                    ' . $p . '
                </div>
            </div>';
        if($a == 'Access Token') {
            $t = '<div class="control-group">
                    <label class="control-label" for="user">' . $a . ':</label>
                    <div class="controls">
                        <input required="" id="' . $this->key_rep($a) . '" name="' . $this->key_rep($a) . '" type="text" class="form-control" placeholder="' . $a . '">
                    </div>
                </div>';
        }
        $url = 'user/connect/'.$e;
        if($h) {
            $url = $h;
        }
        return '<html>
            <head>
                <title>New ' . ucwords(str_replace('_', ' ', $e)) . ' Account</title>
            </head>
            <body>
                <style>
                    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600);
                    div.center {
                        width: 80%;
                        margin: 15px auto;
                        font-family: "Source Sans Pro", sans-serif;
                    }
                    div.left,div.right {
                        width: 43%;
                        background: #F8FAFB;
                        border: 1px solid #ede8e8;
                        border-radius: 5px;
                        padding: 15px 30px;
                        min-height: 400px;
                    }
                    div.right>h2 {
                        font-size: 18px;
                        margin: 0;
                    }
                    div.right>ol {
                        margin: 10px 0;
                        padding: 0;
                    }
                    div.right>ol>li {
                        margin-left: 15px;
                        line-height: 35px;
                        margin-bottom: 10px;
                    }
                    div.left {
                        float: left;
                    }
                    div.right {
                        float: right;
                    }
                    form {
                        width: 100%;
                    }
                    @media(max-width:1400px) {
                        div.left,div.right {
                            width: 40%;
                        }
                    }
                    @media(max-width:800px) {
                        div.center {
                            width: 90%;
                            margin: 15px auto;
                        }
                        div.left,div.right {
                            width: auto;
                            margin-bottom: 15px;
                            float: inherit;
                        }
                    }
                    button {
                        color: #fff;
                        background-color: ' . $d->color . ';
                        border-color: ' . $d->color . ';
                        display: inline-block;
                        font-weight: 400;
                        text-align: center;
                        vertical-align: middle;
                        cursor: pointer;
                        background-image: none;
                        border: 1px solid transparent;
                        white-space: nowrap;
                        font-size: 14px;
                        line-height: 35px;
                        margin-right: 10px;
                        padding-left: 16px;
                        padding-right: 16px;
                        border-radius: 4px;    
                    }
                    input[type="text"],input[type="password"] {
                        display: block;
                        width: 100%;
                        height: 34px;
                        padding: 6px 12px;
                        font-size: 14px;
                        line-height: 1.428571429;
                        color: #555;
                        background-color: #fff;
                        background-image: none;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                        margin-bottom:20px;    
                        background: #fafafa;
                        border: solid 1px #dbdbdb;
                        min-height: 40px;
                    }
                    input[type="text"]:focus,input[type="password"]:focus,button:focus{
                        outline: 0;
                    }
                </style>
                <div class="center">
                    <div class="left">
                        '.form_open($url).'
                            ' . $t . '
                            <div class="control-group">
                                <label class="control-label" for="signin"></label>
                                <div class="controls">
                                    <button id="signin" name="signin" class="btn btn-success">' . $c . '</button>
                                </div>
                            </div>
                        '.form_close().'
                    </div>
                    <div class="right">
                        ' . $f . '
                    </div>
                </div>
            </body>
        </html>';
    }
}