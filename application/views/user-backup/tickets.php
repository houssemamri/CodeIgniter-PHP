<section>
    <div class="container-fluid tickets">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel-heading">
                        <h2><i class="fa fa-question-circle-o"></i> <?= $this->lang->line('mu8'); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group search">
                            <input type="text" placeholder="<?= $this->lang->line('mi1'); ?>" class="form-control search_post">
                            <span class="input-group-btn search-m">
                                <button class="btn" type="button">
                                    <i class="fa fa-binoculars"></i>
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row questions">
                    <div class="col-lg-12">
                        <div class="mm-single-result">
                            <h3><?= $this->lang->line('mi22'); ?></h3>
                            <p><?= $this->lang->line('mi23'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel-heading">
                        <h2>
                            <i class="fa fa-life-ring"></i> <?php if(!$res) { echo $this->lang->line('mu212'); } else { echo $this->lang->line('mi7').' #'.$id; } ?>
                            <a href="<?= base_url('user/new-ticket'); ?>" class="pull-right"><?= $this->lang->line('mi2'); ?></a>
                        </h2>
                    </div>
                </div>
                <?php
                if(!$res) {
                ?>
                <div class="row">
                    <div class="col-lg-12 mess-stat">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-bordred table-striped tickets-table">
                                <tbody class="display-tickets-here">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination">
                        </ul>
                        <img src="<?= base_url(); ?>assets/img/pageload.gif" class="pull-right pageload"> </div>
                </div>
                <?php 
                } else {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mm-single-result single">
                                <h3><?= $res[0]->subject; ?></h3>
                                <p><?= $res[0]->body; ?></p>
                                <?php if($res[0]->attachment) { ?>
                                    <h6><?= $this->lang->line('mi8') ?> <a href="<?= $res[0]->attachment ?>" target="_blank"><?= $res[0]->attachment; ?></a></h6>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if($metas) { ?>
                        <?php
                            foreach ($metas as $meta) {
                                echo '<div class="row">
                                        <div class="col-lg-12">
                                            <div class="mm-single-result repl">';
                                                echo '<h3>' . user_name_by($meta->user_id) . ' <span>' . $this->lang->line('mi10') . ' ' . calculate_time($meta->created, time()) . '</span>' . '</h3>';
                                                echo '<p>' . $meta->body . '</p>';
                                                if($meta->attachment) {
                                                    echo '<h6>'.$this->lang->line('mi8').' <a href="' . $meta->attachment . '" target="_blank">' . $meta->attachment . '</a></h6>';
                                                }
                                            echo '</div>
                                        </div>
                                    </div>';
                            }
                        ?>
                    <?php } ?>
                    <?php if($res[0]->status < 3) { ?>
                        <?= form_open_multipart('user/get-ticket/'.$id) ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control new-post" rows="5" placeholder="<?= $this->lang->line('mi4') ?>" name="reply-body" required="true"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="file" class="form-control" accept=".gif,.jpg,.jpeg,.png,.mp4,.avi,webm">
                                    </div>
                                    <div class="form-group">
                                        <a href="<?= base_url('user/get-ticket/'.$id.'?action=close'); ?>" class="btn btn-danger pull-left"> <?= $this->lang->line('mi12') ?></a>
                                        <button type="submit" class="btn btn-success pull-right btn-edit"> <?= $this->lang->line('mi9') ?></button>
                                    </div>
                                </div>
                            </div>
                        <?= form_close() ?>
                    <?php
                    } else {
                        echo '<div class="row"><div class="col-lg-12 mess-stat"><ul><li>' . $this->lang->line('mi11') . '</li></ul></div></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php 
    if(isset($upres)) {
        echo '<script language="javascript">window.onload = function() {' . $upres . '}</script>';
    }
    ?>
</section>