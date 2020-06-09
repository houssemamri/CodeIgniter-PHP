<?php
function temp($val,$type) {
    $CI =& get_instance();
    return '<div class="col-lg-12 sent-info" data-id="'.$val.'" data-type="'.$type.'">
            <div class="col-lg-12">
                <div class="widget-box">
                    <div class="widget-header">
                        <div class="widget-toolbar">
                            <ul class="nav nav-tabs">
                                <li class="active"> <a data-toggle="tab" href="#sent-emails" aria-expanded="true">'.$CI->lang->line('mu120').'</a> </li>
                                <a href="#" class="btn btn-success get-csv-sent pull-right">'.$CI->lang->line('mu188').'</a>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="tab-content">
                                <div id="sent-emails" class="tab-pane active">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}