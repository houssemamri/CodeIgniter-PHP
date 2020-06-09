<section>
    <div class="container-fluid new-rss">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-rss"></i> <?= $this->lang->line('mu71'); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 show-alert">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul>
                        <li>
                            <div class="col-md-12 clean">
                                <div class="input-group search">
                                    <input type="text" placeholder="<?= $this->lang->line('mu72'); ?>" class="form-control rss-url">
                                    <span class="input-group-btn search-m">
                                        <a href="javascript:;" class="btn save-rss"><i class="fa fa-floppy-o"></i></a>
                                        <a href="javascript:;" class="btn parse"><i class="fa fa-rss-square"></i></a>
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="feed-rss">
                        <p><?= $this->lang->line('mu60'); ?></p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
