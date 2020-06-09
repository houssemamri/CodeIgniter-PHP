<?php
function show_lists(){
    $CI =& get_instance();
    $lists = $CI->ecl('Clist')->user_lists();
    $th = '';
    if($lists) {
        $th .= '<ul>';
        foreach($lists as $list) {
            $th .= '<li class="netsel" data-id="' . $list->list_id . '">
                        <i class="fa fa-address-book-o"></i> ' . $list->name . '
                        <div class="btn-group pull-right">
                            <button type="button" data-type="main" class="btn btn-default select-list">
                                '.$CI->lang->line('mm123').'
                            </button>
                            <button type="button" class="btn btn-default show-advanced">
                                <i class="fa fa-cog"></i>
                            </button>
                        </div>
                    </li>
                    <li class="socials" data-id="' . $list->list_id . '">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control first-condition">
                                    <option value="0">'.$CI->lang->line('mu172').'</option>
                                    <option value="1">'.$CI->lang->line('mu173').'</option>
                                    <option value="2">'.$CI->lang->line('mu174').'</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 non-mod-select">
                            <div class="form-group">
                                <select class="form-control second-template">
                                </select>                           
                            </div>
                        </div>
                    </li>';
        }
    } else {
        $th = '<ul style="padding: 10px;"><li class="notconnected">'.$CI->lang->line('mu287').'</li>';
    }
    return $th;
}

function show_stats($campaign_id){
    $CI =& get_instance();
    $stats = $CI->ecl('Sched')->get_stats($campaign_id);
    $sent = 0;
    $opened = 0;
    $unopened = 0;
    $unsub = 0;
    if($stats) {
        $sent = $stats[0]->sent;
        $opened = $stats[0]->readi;
        $unopened = $stats[0]->unread;
        $unsub = $stats[0]->unsub;
    }
    $th = ' <div class="col-lg-12">
              <div class="stat-list">
                <div class="stat-split">'.$sent.'</div>
                <div class="stat-text">'.$CI->lang->line('mu161').'</div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="stat-list">
                <div class="stat-split update-success">'.$opened.'</div>
                <div class="stat-text">'.$CI->lang->line('mu162').'</div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="stat-list">
                <div class="stat-split update-info">'.$unopened.'</div>
                <div class="stat-text">'.$CI->lang->line('mu163').'</div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="stat-list">
                <div class="stat-split update-danger">'.$unsub.'</div>
                <div class="stat-text">'.$CI->lang->line('mu164').'</div>
              </div>
            </div>';
    return $th;
}
function temp($val){
    $CI =& get_instance();
    if(!$CI->ecl('Campaign')->if_user_is_owner_campaign($val)) {
        return false;
    }
    $smtp_options = $CI->ecl('Campaign')->get_campaign_meta($val, 'smtp_options');
    $meta_val1 = '';
    if(@$smtp_options[0]->meta_val1) {
        $meta_val1 = ' checked="checked"';
    }
    $meta_val2 = '';
    if(@$smtp_options[0]->meta_val2) {
        $meta_val2 = $smtp_options[0]->meta_val2;
    }
    $meta_val3 = '';
    if(@$smtp_options[0]->meta_val3) {
        $meta_val3 = $smtp_options[0]->meta_val3;
    }
    $meta_val4 = '';
    if(@$smtp_options[0]->meta_val4) {
        $meta_val4 = $smtp_options[0]->meta_val4;
    }
    $meta_val5 = '';
    if(@$smtp_options[0]->meta_val5) {
        $meta_val5 = $smtp_options[0]->meta_val5;
    }
    $meta_val6 = '';
    if(@$smtp_options[0]->meta_val6) {
        $meta_val6 = ' checked="checked"';
    }
    $meta_val7 = '';
    if(@$smtp_options[0]->meta_val7) {
        $meta_val7 = ' checked="checked"';
    }
    $meta_val8 = '';
    if(@$smtp_options[0]->meta_val8) {
        $meta_val8 = $smtp_options[0]->meta_val8;
    }
    $meta_val9 = '';
    if( @$smtp_options[0]->meta_val9 ) {
        $meta_val9 = $smtp_options[0]->meta_val9;
    }    
    $meta_val10 = '';
    if( @$smtp_options[0]->meta_val10 ) {
        $meta_val10 = $smtp_options[0]->meta_val10;
    }
    $meta_val11 = '';
    if( @$smtp_options[0]->meta_val11 ) {
        $meta_val11 = $smtp_options[0]->meta_val11;
    }
    $smtp = '';
    if(get_option('user_smtp')) {
        if(($meta_val1 == '') || ($meta_val2 == '') || ($meta_val3 == '') || ($meta_val4 == '') || ($meta_val5 == '')) {
            $smtp = '<div class="row"><div class="show-upgrade-purpose">' . $CI->lang->line('mu280') . '</div></div>';
        }
    }
    $planner = '';
    if(get_option('tool_emails-planner') && get_user_option('display_planner_form_campaign')){
        $act = (get_option('emails_planner_limit'))?get_option('emails_planner_limit'):'1';
        $planner = '<div class="col-lg-12 widget planner" data-act="' . $act . '">
            <div class="row">
                <div class="panel-heading">
                    <i class="fa fa-calendar" aria-hidden="true"></i> ' . $CI->lang->line('mu190') . '
                    <div class="btn-group pull-right"><button type="button" data-type="main" class="btn btn-default add-repeat">' . $CI->lang->line('mu189') . '</button></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 post-plans">
                    <div class="list-group">
                        <p>' . $CI->lang->line('mu192') . '</p>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>';
    }
    
    $calendar = '';
    if ( !get_option('enable-old-scheduling') ) {
        $calendar = '<div class="calendar-widget" data-format="1">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="midrub-caledar">
                            <thead>
                                <tr>
                                    <th class="text-center"><a href="#" class="go-back"><span class="fa fa-arrow-left"></span></a></th>
                                    <th colspan="5" class="text-center year-month"></th>
                                    <th class="text-center"><a href="#" class="go-next"><span class="fa fa-arrow-right"></span></a></th>
                                </tr>
                            </thead>
                            <tbody class="calendar-dates">
                            </tbody> 
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <input class="form-control" id="filter-hours" type="text" placeholder="Search..">
                        <ul class="list-group" id="time-format">
                        </ul>
                    </div>
                </div>
            </div>';
    }
    
    $schedule = '<a href = "#"><i class = "fa fa-clock-o" aria-hidden = "true"></i> ' . $CI->lang->line('mu346') . '</a><input type="text" class="datetime" />';

    return ''
    . '<div class="col-lg-4 campaign-page" data-id="'.$val.'">
            <div class="col-lg-12 clean">
                <ul class="campaign-menu">
                    <li class="active"><a href="#campaign-tab-send-mail" class="new-campaign-email"><i class="fa fa-arrow-circle-right"></i> '.$CI->lang->line('mu288').'</a></li>
                    <li><a href="#campaign-tab-templates"><i class="fa fa-arrow-circle-right"></i> '.$CI->lang->line('mu165').'</a></li>
                    <li><a href="#campaign-tab-history"><i class="fa fa-arrow-circle-right"></i> '.$CI->lang->line('mu3').'</a></li>
                    <li><a href="#campaign-tab-statistics" class="get-campaign-statistics"><i class="fa fa-arrow-circle-right"></i> '.$CI->lang->line('mu166').'</a></li>
                    <li><a href="#campaign-tab-my-smtp"><i class="fa fa-arrow-circle-right"></i> '.$CI->lang->line('mu289').'</a></li>
                    <li><a href="#campaign-tab-settings"><i class="fa fa-arrow-circle-right"></i> '.$CI->lang->line('mu7').'</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="campaign-tabs">
                <div id="campaign-tab-send-mail" class="active">
                    ' . $smtp . '
                    '.form_open('user/emails/campaign/'.$val, ['class' => 'schedule-campaign']).'
                        <div class="col-lg-12 template-tools clean">
                            <div class="panel">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                       <li class="active"><a href="#general" data-toggle="tab"><i class="fa fa-window-restore"></i></a></li>
                                       <li><a href="#advanced" data-toggle="tab"><i class="fa fa-puzzle-piece"></i></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="general">
                                            <ul>
                                                <li data-type="paragraph"><i class="fa fa-paragraph"></i> '.$CI->lang->line('mu284').'</li>
                                                <li data-type="header"><i class="fa fa-header"></i> '.$CI->lang->line('mu290').'</li>
                                                <li data-type="photo"><i class="fa fa-picture-o"></i> '.$CI->lang->line('mu291').'</li>
                                                <li data-type="table"><i class="fa fa-table"></i> '.$CI->lang->line('mu216').'</li>
                                                <li data-type="list"><i class="fa fa-list-ol"></i> '.$CI->lang->line('mu217').'</li>
                                                <li data-type="button"><i class="fa fa-hand-o-up"></i> '.$CI->lang->line('mu218').'</li>
                                                <li data-type="space"><i class="fa fa-arrows-h"></i> '.$CI->lang->line('mu219').'</li>
                                                <li data-type="line"><i class="fa fa-window-minimize"></i> '.$CI->lang->line('mu220').'</li>
                                                <li data-type="html"><i class="fa fa-code"></i> '.$CI->lang->line('mu221').'</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="advanced">
                                            <ul class="nav nav-pills nav-stacked col-md-2">
                                              <li class="active"><a href="#temp_bac" data-toggle="pill">'.$CI->lang->line('mu222').'</a></li>
                                              <li><a href="#temp_header" data-toggle="pill">'.$CI->lang->line('mu290').'</a></li>
                                              <li><a href="#temp_body" data-toggle="pill">'.$CI->lang->line('mu223').'</a></li>
                                              <li><a href="#temp_footer" data-toggle="pill">'.$CI->lang->line('mu224').'</a></li>
                                            </ul>
                                            <div class="tab-content col-md-10">
                                                <div class="tab-pane active" id="temp_bac">
                                                    <ul>
                                                        <li><h4>'.$CI->lang->line('mu225').' <input type="color" class="pull-right type-color temp-bg-color" value="#FFFFFF"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu226').' <button type="button" class="pull-right" data-toggle="modal" data-target="#image_upload"><i class="fa fa-picture-o" aria-hidden="true"></i></button></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu227').' <div class="enablus pull-right"><input id="show-image-for-content-template" name="show-image-for-content-template" class="setopt" type="checkbox"><label for="show-image-for-content-template"></label></div></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu228').'(px) <input type="number" class="tab-columns pull-right fix-template-width" min="1" max="1500"></h4></li>
                                                        <li class="for-css-template"><textarea rows="7" placeholder="'.$CI->lang->line('mu232').'"></textarea></li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane" id="temp_header">
                                                    <ul>
                                                        <li><h4>'.$CI->lang->line('mu225').' <input type="color" class="optionvalue pull-right type-color temp-header-bg-color" value="#FFFFFF"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu226').' <button type="button" class="pull-right" data-toggle="modal" data-target="#image_upload"><i class="fa fa-picture-o" aria-hidden="true"></i></button></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu227').' <div class="enablus pull-right"><input id="show-image-for-header-template" name="show-image-for-header-template" class="setopt" type="checkbox"><label for="show-image-for-header-template"></label></div></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu229').' <div class="enablus pull-right"><input id="temp_disable_header" name="temp_disable_header" class="setopt" type="checkbox"><label for="temp_disable_header"></label></div></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu230').'(px) <input type="number" class="tab-columns header-height pull-right" min="1" max="1500"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu281').'(px) <input type="number" class="tab-columns header-padding pull-right" value="15" min="1" max="1500"></h4></li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane" id="temp_body">
                                                    <ul>
                                                        <li><h4>'.$CI->lang->line('mu225').' <input type="color" class="optionvalue pull-right type-color temp-body-bg-color" value="#FFFFFF"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu226').' <button type="button" class="pull-right" data-toggle="modal" data-target="#image_upload"><i class="fa fa-picture-o" aria-hidden="true"></i></button></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu227').' <div class="enablus pull-right"><input id="show-image-for-body-template" name="show-image-for-body-template" class="setopt" type="checkbox"><label for="show-image-for-body-template"></label></div></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu230').'(px) <input type="number" class="tab-columns pull-right body-height" min="1" max="1500"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu281').'(px) <input type="number" class="tab-columns body-padding pull-right" value="15" min="1" max="1500"></h4></li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane" id="temp_footer">
                                                    <ul>
                                                        <li><h4>'.$CI->lang->line('mu225').' <input type="color" class="optionvalue pull-right type-color temp-footer-bg-color" value="#FFFFFF"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu226').' <button type="button" class="pull-right" data-toggle="modal" data-target="#image_upload"><i class="fa fa-picture-o" aria-hidden="true"></i></button></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu227').' <div class="enablus pull-right"><input id="show-image-for-footer-template" name="show-image-for-footer-template" class="setopt" type="checkbox"><label for="show-image-for-footer-template"></label></div></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu231').' <div class="enablus pull-right"><input id="temp_disable_footer" name="temp_disable_footer" class="setopt" type="checkbox"><label for="temp_disable_footer"></label></div></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu230').'(px) <input type="number" class="tab-columns pull-right footer-height" min="1" max="1500"></h4></li>
                                                        <li><h4>'.$CI->lang->line('mu281').'(px) <input type="number" class="tab-columns footer-padding pull-right" value="15" min="1" max="1500"></h4></li>    
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 template-editor clean">
                            <div class="template-builder" style="background-color: #f8f8f8;padding: 15px;">
                                <div style="width:80%;min-height:auto;margin:30px auto 70px;">
                                    <div class="email-template-header" style="width:100%;min-height:50px;background-color:#ffffff;padding:15px;"></div>
                                    <div class="email-template-body" style="width:100%;margin:20px 0;height:350px;background-color:#ffffff;padding:15px;"></div>
                                    <div class="email-template-footer" style="width:100%;min-height:70px;background-color:#ffffff;padding:15px;"></div>
                                    <div class="only-css-here"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 emails-buttons-action">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="stat-list">
                                        <div class="stat-split update-success">' . $CI->lang->line('mu182') . '</div>
                                        <div class="stat-text">' . site_url('unsubscribe/' . $val . '/email-id/scheduled-id') . '</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 emails-buttons-action">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control post-title" placeholder="'.$CI->lang->line('mu233').'" required="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 elists">
                                ' . show_lists() . '
                            </ul>              
                        </div>
                        ' . $planner . '
                        ' . $calendar . '
                        <div class="col-lg-12 emails-buttons-action">
                            <div class="row">
                                <div class="col-lg-12 buttons">
                                    ' . $schedule . '
                                    <button type="submit" class="btn btn-success pull-right"> '.$CI->lang->line('mu234').'</button>
                                    <button type="submit" class="btn btn-default pull-right draft-save">'.$CI->lang->line('mu235').'</button>
                                    <img src="' . site_url('assets/img/load-prev.gif') . '" class="pull-right loadsend">
                                </div>
                            </div>
                        </div>
                    ' . form_close() . '
                </div>
                <div id="campaign-tab-templates">
                    <div class="col-lg-12 template-tools clean">
                        <div class="panel">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#templates" data-toggle="tab"><i class="fa fa-files-o"></i></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="templates">
                                        <div class="tab-pane show-templates-lists-here active" id="temp_bac">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="campaign-tab-history">
                    <div class="col-lg-12 template-tools clean">
                        <div class="panel">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#history" data-toggle="tab"><i class="fa fa-history"></i></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="history">
                                        <div class="tab-pane active" id="temp_bac">
                                            <ul class="histories">
                                            </ul>
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
                </div>
                <div id="campaign-tab-statistics">
                    <div class="col-lg-12 template-tools clean">
                        <div class="panel">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#statistics" data-toggle="tab"><i class="fa fa-bar-chart"></i></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="statistics">
                                        <div class="row">
                                            <div class="col-lg-12 stat-head">
                                                <div class="dropdown pull-left">
                                                    <button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">' . $CI->lang->line('mu236') . ' <span class="caret"></span></button>
                                                    <ul class="dropdown-menu multi-level sort-stats-by-template" role="menu" aria-labelledby="dropdownMenu1">
                                                    </ul>
                                                </div>
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-default active select-range" data-value="30">' . $CI->lang->line('mu237') . '</button>
                                                    <button type="button" class="btn btn-default select-range" data-value="all">' . $CI->lang->line('mu238') . '</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="rations" class="graph"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="campaign-tab-my-smtp">
                    <div class="col-lg-12 template-tools clean">
                        <div class="panel">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#smtp" data-toggle="tab"><i class="fa fa-envelope-o"></i></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="smtp">
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9">' . $CI->lang->line('mu239') . '</div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="smtp-enable" name="smtp-enable" class="besan" type="checkbox"' . $meta_val1 . '>
                                                    <label for="smtp-enable"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu300') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-protocol" value="' . $meta_val8 . '" placeholder="' . $CI->lang->line('mu301') . '">
                                                </div>
                                            </div>                                        
                                        </div>                                     
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu240') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-host" value="' . $meta_val2 . '" placeholder="' . $CI->lang->line('mu241') . '">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu242') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-port" value="' . $meta_val3 . '" placeholder="' . $CI->lang->line('mu243') . '">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu244') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-username" value="' . $meta_val4 . '" placeholder="' . $CI->lang->line('mu245') . '">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu246') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-password" value="' . $meta_val5 . '" placeholder="' . $CI->lang->line('mu247') . '">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu248') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="smtp-ssl" name="smtp-ssl" class="besan" type="checkbox"' . $meta_val6 . '>
                                                    <label for="smtp-ssl"></label>
                                                </div>
                                            </div>                                      
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu249') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="smtp-tls" name="smtp-tsl" class="besan" type="checkbox"' . $meta_val7 . '>
                                                    <label for="smtp-tls"></label>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="campaign-tab-settings">
                    <div class="col-lg-12 template-tools clean">
                        <div class="panel">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#settings" data-toggle="tab"><i class="fa fa-cog"></i></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="settings">
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu309') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-priority" value="' . $meta_val11 . '" placeholder="' . $CI->lang->line('mu310') . '">
                                                </div>
                                            </div>                                        
                                        </div>   
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu302') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-sender-name" value="' . $meta_val9 . '" placeholder="' . $CI->lang->line('mu304') . '">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title">' . $CI->lang->line('mu303') . '</div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="pappio" id="smtp-sender-email" value="' . $meta_val10 . '" placeholder="' . $CI->lang->line('mu305') . '">
                                                </div>
                                            </div>                                        
                                        </div> 
                                        <div class="setrow">
                                            <div class="col-lg-12 col-sm-12 col-xs-12 clean">
                                                <button type="button" class="btn btn-danger pull-left delete-campaign" data-id="' . $val . '">' . $CI->lang->line('mu168') . '</button>
                                                <p class="pull-left confirm">' . $CI->lang->line('mu68') . ' <a href="#" class="delete-cam yes">' . $CI->lang->line('mu69') . '</a><a href="#" class="no">' . $CI->lang->line('mu70') . '</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="dialog-form" title="' . $CI->lang->line('mu273') . '">
            <input type="text" id="tem-url-field" placeholder="http://" class="text ui-widget-content ui-corner-all">
            <button class="btn btn-default add-tem-link" type="button">' . $CI->lang->line('mu274') . '</button>
            <input type="color" class="pull-right type-color change-tem-link-color" value="#333333">
        </div>'.form_open_multipart('user/emails', ['class' => 'upim', 'id' => 'upim', 'method' => 'post']).'<input type="hidden" name="type" id="type"><input type="file" name="file" id="file" accept=".gif,.jpg,.jpeg,.png">'.form_close();
}