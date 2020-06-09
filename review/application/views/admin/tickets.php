<section>
    <div class="container-fluid tickets">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel-heading">
                                <h2>
                                    <i class="fa fa-question-circle-o"></i> <?= $this->lang->line('mu8'); ?>
                                    <?php if (!isset($result)) { ?>
                                        <a href="<?= base_url('admin/new-question'); ?>" class="pull-right"><?= $this->lang->line('mi18'); ?></a>
                                    <?php } ?>
                                </h2>
                            </div>
                        </div>
                        <?php if (!isset($result)) { ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group search">
                                        <input type="text" placeholder="<?= $this->lang->line('mi1'); ?>" class="form-control search_post">
                                        <span class="input-group-btn search-m">
                                            <button class="btn" type="button">
                                                <i class="fa fa-binoculars"></i>
                                                <i class="fa fa-times display-none"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row questions">
                                <div class="col-lg-12">
                                    <div class="mm-single-result">
                                        <h3><?= $this->lang->line('mi24'); ?></h3>
                                        <p><?= $this->lang->line('mi25'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?= form_open_multipart('admin/new-question') ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="<?= $this->lang->line('mi20'); ?>" name="question" class="form-control" required="true">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control new-post" rows="5" placeholder="<?= $this->lang->line('mi21'); ?>" name="response" required="true"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success pull-right btn-edit"> <?= $this->lang->line('mi19'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close() ?>
                        <?php } ?>                
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel-heading">
                                <h2>
                                    <i class="fa fa-life-ring"></i> <?php
                                    if (!$res) {
                                        echo $this->lang->line('mi17');
                                    } else {
                                        echo $this->lang->line('mi7') . ' #' . $id;
                                    }
                                    ?>
                                </h2>
                            </div>
                        </div>
                        <?php
                        if (!$res) {
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
                                        <?php if ($res[0]->attachment) { ?>
                                            <h6><?= $this->lang->line('mi8') ?> <a href="<?= $res[0]->attachment ?>" target="_blank"><?= $res[0]->attachment; ?></a></h6>
                                        <?php } ?>
                                        <p class="author-asked"><?= user_name_by($res[0]->user_id) . ' <span>' . $this->lang->line('mi35') . ' ' . calculate_time($res[0]->created, time()) . '</span>'; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if ($metas) { ?>
                                <?php
                                foreach ($metas as $meta) {
                                    echo '<div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mm-single-result repl">';
                                    echo '<h3>' . user_name_by($meta->user_id) . ' <span>' . $this->lang->line('mi10') . ' ' . calculate_time($meta->created, time()) . '</span>' . '</h3>';
                                    echo '<p>' . $meta->body . '</p>';
                                    if ($meta->attachment) {
                                        echo '<h6>' . $this->lang->line('mi8') . ' <a href="' . $meta->attachment . '" target="_blank">' . $meta->attachment . '</a></h6>';
                                    }
                                    echo '</div>
                                                </div>
                                            </div>';
                                }
                                ?>
                            <?php } ?>
                            <?php if ($res[0]->status < 3) { ?>
                                <?= form_open_multipart('admin/get-ticket/' . $id) ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea class="form-control new-post" rows="5" placeholder="<?= $this->lang->line('mi4') ?>" name="reply-body" required="true"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control" accept=".gif,.jpg,.jpeg,.png,.mp4,.avi,webm">
                                        </div>
                                        <div class="form-group">
                                            <a href="<?= base_url('admin/get-ticket/' . $id . '?action=close'); ?>" class="btn btn-danger pull-left"> <?= $this->lang->line('mi12') ?></a>
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
        </div>
    </div>
    <?php
    if (isset($upres)) {
        echo '<script language="javascript">window.onload = function() {' . $upres . '}</script>';
    } else if (isset($result)) {
        if ($result != 1) {
            echo '<script language="javascript">window.onload = function() {' . $result . '}</script>';
        }
    }
    ?>
</section>