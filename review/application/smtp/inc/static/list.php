<?php
function temp($val){
    $CI =& get_instance();
    return '<div class="col-lg-12 list-details" data-id="'.$val.'">
            <div class="col-lg-12">
                <div class="widget-box">
                    <div class="widget-header">
                        <div class="widget-toolbar">
                            <ul class="nav nav-tabs">
                                <li class="active"> <a data-toggle="tab" href="#show-emails" aria-expanded="true">'.$CI->lang->line('mu120').'</a> </li>
                                <li class=""> <a data-toggle="tab" href="#unactive_emails" aria-expanded="false">'.$CI->lang->line('mu176').'</a> </li>
                                <li class=""> <a data-toggle="tab" href="#settings" aria-expanded="false">'.$CI->lang->line('mu7').'</a> </li>
                                <a href="'.site_url('user/emails/upload').'?list='.$val.'" class="btn btn-primary pull-right">'.$CI->lang->line('mu177').'</a>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="tab-content">
                                <div id="show-emails" class="tab-pane active">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <tbody class="list-emails">                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col col-lg-12">
                                          <ul class="pagination"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="unactive_emails" class="tab-pane">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <tbody class="list-emails"></tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col col-lg-12">
                                          <ul class="pagination"></ul>
                                        </div>
                                    </div>                                    
                                </div>
                                <div id="settings" class="tab-pane">
                                    <div class="setrow">
                                        <div class="col-lg-12 col-sm-12 col-xs-12 clean">
                                            <button type="button" class="btn btn-danger pull-left del-list" data-id="'.$val.'">'.$CI->lang->line('mu178').'</button>
                                            <p class="pull-left confirm">'.$CI->lang->line('mu68').' <a href="#" class="delete-list yes">'.$CI->lang->line('mu69').'</a><a href="#" class="no">'.$CI->lang->line('mu70').'</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}