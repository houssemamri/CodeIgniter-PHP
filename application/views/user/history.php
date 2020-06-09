<section>
    <div class="container-fluid history">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-left">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel-heading">
                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> <?= $this->lang->line('mu2'); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mess-stat">
                        <div class="input-group search">
                            <input type="text" placeholder="<?= $this->lang->line('mu49'); ?>" class="form-control search_post">
                            <span class="input-group-btn search-m">
                                <button class="btn" type="button"><i class="fa fa-binoculars"></i><i class="fa fa-times" aria-hidden="true"></i></button>
                            </span> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mess-stat">
                        <ul>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination">
                        </ul>
                        <img src="<?= base_url(); ?>assets/img/pageload.gif" class="pull-right pageload"> </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right hide">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel-heading details">
                        <h2><i class="fa fa-inbox"></i> <?= $this->lang->line('mu50'); ?><span></span></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="new-message sent-message form-control"></div>
                    </div>
                </div>
                <div class="row clicks-tracking">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="100%"><?= $this->lang->line('mu51'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="100%"><div id="soci-networks"></div></td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>                
                <div class="row hilink">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('mu52'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="100%">
                                        <div><i class="fa fa-link"></i> <a href="" target="_blank"></a></div>
                                    </td>
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row pub-image">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="100%"><?= $this->lang->line('mu53'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="100%"><img src=""></td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row pub-video">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('mu54'); ?></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td></td>
                                </tr>                                 
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table status">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('mu55'); ?></th>
                                </tr>
                            </thead>
                            <tbody>                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </div>
</section>