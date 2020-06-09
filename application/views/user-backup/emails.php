<section>
    <div class="container-fluid emails">
        <?= $res; ?>
    </div>
</section>
<div id="image_upload" class="modal fade temp-text-edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu250'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" placeholder="<?= $this->lang->line('mu251'); ?>" class="form-control the-img">
                    <span class="input-group-btn">
                        <button class="btn imgup" data-type="image" type="button"><i class="fa fa-picture-o"></i></button>
                        <button class="btn add-img" type="button"><i class="fa fa-plus"></i></button>
                    </span>
                </div>
                <div class="media-gallery media-gallery-images" data-type="image">
                    <ul>
                    </ul>
                </div>
                <div class="col-lg-12 clean media-gallery media-gallery-pagination" data-type="image" style="display: none;">
                    <div class="btn-group btn-group-info pull-left">
                        <button class="btn btn-default disabled media-images-back" type="button"><i class="fa fa-angle-left"></i></button>
                        <button class="btn btn-default disabled media-images-next" type="button"><i class="fa fa-angle-right"></i></button>
                    </div>
                    <span class="pull-right total-gallery-photos"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_lists_edit" class="modal fade temp-text-edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu252'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 clean media-gallery media-gallery-images" data-type="image">
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->lang->line('mu181'); ?></button>
            </div>
        </div>
    </div>
</div>        
<div id="popup_table" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu254'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="media-gallery media-gallery-images" data-type="image">
                    <ul>
                        <li><span class="pull-left"><?= $this->lang->line('mu255'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="tab-rows tabmon" min="1" max="5"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu256'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="tab-columns tabmon" min="1" max="5"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu257'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="first-column tabmon" min="0" max="100"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu258'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="second-column tabmon" min="0" max="100"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu259'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="third-column tabmon" min="0" max="100"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu260'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="fourth-column tabmon" min="0" max="100"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu261'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="tab-cellpadding tabmon" min="1" max="15"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu262'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="tab-border tabmon" min="1" max="15"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu263'); ?></span><div class="btn-group btn-group-info pull-right"><input type="color" class="pull-right type-color tab-border-color tabmon" value=""></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu225'); ?></span><div class="btn-group btn-group-info pull-right"><input type="color" class="pull-right type-color tab-background-color tabmon" value="#FFFFFF"></div></li>
                        <li><span class="pull-left dtabi"><?= $this->lang->line('mu264'); ?></span><div class="enablus pull-right"><input id="delete-table-from-template" name="delete-table-from-template" class="setopt" type="checkbox"><label for="delete-table-from-template"></label></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_line" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu279'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 clean media-gallery media-gallery-images" data-type="image">
                    <ul>
                        <li><span class="pull-left"><?= $this->lang->line('mu265'); ?>(px)</span><div class="btn-group btn-group-info pull-right"><input type="number" class="line-height linmon" min="1" max="5"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu266'); ?></span><div class="btn-group btn-group-info pull-right"><input type="color" class="pull-right type-color lin-background-color linmon" value="#FFFFFF"></div></li>
                        <li><span class="pull-left dtabi"><?= $this->lang->line('mu267'); ?></span><div class="enablus pull-right"><input id="delete-line-from-template" name="delete-line-from-template" class="setopt" type="checkbox"><label for="delete-line-from-template"></label></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_space" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu268'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 clean media-gallery media-gallery-images" data-type="image">
                    <ul>
                        <li><span class="pull-left"><?= $this->lang->line('mu269'); ?>(px)</span><div class="btn-group btn-group-info pull-right"><input type="number" class="space-height" min="1" max="1000"></div></li>
                        <li><span class="pull-left dtabi"><?= $this->lang->line('mu270'); ?></span><div class="enablus pull-right"><input id="delete-space-from-template" name="delete-space-from-template" class="setopt" type="checkbox"><label for="delete-space-from-template"></label></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_header_edit" class="modal fade temp-text-edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu271'); ?></h4>
            </div>
            <div class="modal-body">
                <textarea class="edit-header-textarea"></textarea>
            </div>
            <div class="modal-footer">
                <div class="col-md-6 clean">
                    <table>
                        <tr>
                            <td>
                                <input type="color" class="pull-right type-color change-tem-header-color" value="#FFFFFF">
                            </td>
                            <td>
                                <button type="button" class="align-tem-text-to-left"><i class="fa fa-align-left"></i></button>
                            </td> 
                            <td>
                                <button type="button" class="align-tem-text-to-center"><i class="fa fa-align-center"></i></button>
                            </td>
                            <td>
                                <button type="button" class="align-tem-text-to-right"><i class="fa fa-align-right"></i></button>
                            </td> 
                            <td>
                                <button type="button" class="align-tem-text-to-justify"><i class="fa fa-align-justify"></i></button>
                            </td>
                            <td>
                                <button type="button" class="bold-tem-text"><i class="fa fa-bold"></i></button>
                            </td>
                            <td>
                                <button type="button" class="italic-tem-text"><i class="fa fa-italic"></i></button>
                            </td>
                            <td>
                                <button type="button" class="underline-tem-text"><i class="fa fa-underline"></i></button>
                            </td>                                  
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 clean">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->lang->line('mu181'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_html_edit" class="modal fade temp-text-edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu272'); ?></h4>
            </div>
            <div class="modal-body">
                <textarea class="edit-header-textarea"></textarea>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->lang->line('mu181'); ?></button>
            </div>
        </div>
    </div>
</div>
<div id="popup_paragraph_edit" class="modal fade temp-text-edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu253'); ?></h4>
            </div>
            <div class="modal-body">
                <textarea class="edit-paragraph-textarea"></textarea>
            </div>
            <div class="modal-footer">
                <div class="col-md-6 clean">
                    <table>
                        <tr>
                            <td>
                                <input type="color" class="pull-right type-color change-tem-text-color" value="#FFFFFF">
                            </td>
                            <td>
                                <button type="button" class="align-tem-text-to-left"><i class="fa fa-align-left"></i></button>
                            </td> 
                            <td>
                                <button type="button" class="align-tem-text-to-center"><i class="fa fa-align-center"></i></button>
                            </td>
                            <td>
                                <button type="button" class="align-tem-text-to-right"><i class="fa fa-align-right"></i></button>
                            </td> 
                            <td>
                                <button type="button" class="align-tem-text-to-justify"><i class="fa fa-align-justify"></i></button>
                            </td>
                            <td>
                                <button type="button" class="bold-tem-text"><i class="fa fa-bold"></i></button>
                            </td>
                            <td>
                                <button type="button" class="italic-tem-text"><i class="fa fa-italic"></i></button>
                            </td>
                            <td>
                                <button type="button" class="underline-tem-text"><i class="fa fa-underline"></i></button>
                            </td>                                 
                            <td>
                                <button type="button" class="indent-tem-text"><i class="fa fa-indent"></i></button>
                            </td>
                            <td>
                                <button type="button" class="outdent-tem-text"><i class="fa fa-outdent"></i></button>
                            </td>
                            <td>
                                <button type="button" class="enter-a-link-template-item"><i class="fa fa-link"></i></button>
                            </td>
                            <td>
                                <button type="button" class="remove-a-link-template-item"><i class="fa fa-chain-broken"></i></button>
                            </td>
                            <td>
                                <button type="button" class="increase-item-tem-text-size"><i class="fa fa-plus"></i></button>
                            </td>
                            <td>
                                <button type="button" class="decrease-item-tem-text-size"><i class="fa fa-minus"></i></button>
                            </td>                                    
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 clean">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $this->lang->line('mu181'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_button_edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu275'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="media-gallery media-gallery-images" data-type="image">
                    <ul>
                        <li><span class="pull-left"><?= $this->lang->line('mu276'); ?></span><div class="btn-group btn-group-info pull-right"><input type="text" class="tab-button-text tabut" min="1" max="5"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu262'); ?></span><div class="btn-group btn-group-info pull-right"><input type="number" class="tab-border-button tabut" min="1" max="15"></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu263'); ?></span><div class="btn-group btn-group-info pull-right"><input type="color" class="pull-right type-color tab-border-button-color tabut" value=""></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu277'); ?></span><div class="btn-group btn-group-info pull-right"><input type="color" class="pull-right type-color tab-border-text-color tabut" value=""></div></li>
                        <li><span class="pull-left"><?= $this->lang->line('mu225'); ?></span><div class="btn-group btn-group-info pull-right"><input type="color" class="pull-right type-color tab-border-background-color tabut" value="#FFFFFF"></div></li>
                        <li><span class="pull-left dtabi"><?= $this->lang->line('mu278'); ?></span><div class="enablus pull-right"><input id="delete-button-from-template" name="delete-button-from-template" class="setopt" type="checkbox"><label for="delete-button-from-template"></label></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="newCampaign" class="modal fade" role="dialog">
    <?= form_open('user/emails', ['class' => 'create-campaign']); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu149'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="campaign-name" placeholder="<?= $this->lang->line('mu150'); ?>" name="campaign" required="required">
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="campaign-description" rows="5" placeholder="<?= $this->lang->line('mu151'); ?>" name="description"></textarea>
                </div>
                <div class="show-msg">
                </div>                    
            </div>
            <div class="modal-footer">
                <button type="submit" data-type="main" class="btn btn-primary pull-right"><?= $this->lang->line('mu152'); ?></button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<div id="newList" class="modal fade" role="dialog">
    <?= form_open('user/emails', ['class' => 'create-list']); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu153'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="list-name" placeholder="<?= $this->lang->line('mu154'); ?>" name="list" required="required">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" id="list-description" placeholder="<?= $this->lang->line('mu155'); ?>" name="description"></textarea>
                </div>
                <div class="show-msg">
                </div>  
            </div>
            <div class="modal-footer">
                <button type="submit" data-type="main" class="btn btn-success pull-right"><?= $this->lang->line('mu156'); ?></button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>