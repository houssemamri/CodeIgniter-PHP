<?php
function temp(){
    $CI =& get_instance();
    return '<div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                   <li class="active"><a href="#templates" data-toggle="tab"><i class="fa fa-bullhorn" aria-hidden="true"></i></a></li>
                   <a href="#" data-toggle="modal" data-target="#newCampaign" class="pull-right">' . $CI->lang->line('mu147') . '</a>
                </ul>
            </div>
            <div class="panel-body" id="campaigns">
                <div class="tab-content">
                    <div class="tab-pane active" id="campaign_gallery">
                        <ul>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-12">
                        <ul class="pagination"></ul>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                   <li class="active"><a href="#templates" data-toggle="tab" class="bolis"><i class="fa fa-at"></i></a></li>
                   <a href="#" data-toggle="modal" data-target="#newList" class="pull-right">' . $CI->lang->line('mu148') . '</a>
                </ul>
            </div>
            <div class="panel-body" id="lists">
                <div class="tab-content">
                    <div class="tab-pane active" id="lists_gallery">
                        <ul>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-12">
                        <ul class="pagination"></ul>
                    </div>
                </div>                
            </div>
        </div> 
    </div>';
}