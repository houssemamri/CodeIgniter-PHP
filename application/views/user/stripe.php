<div class="container gateways">
    <style>
        #payment-form{
            margin-top: 100px;
        }
        #payment-form button {
            border: none;
            border-radius: 4px;
            outline: none;
            text-decoration: none;
            color: #fff;
            background: #32325d;
            white-space: nowrap;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            padding: 0 14px;
            box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
            border-radius: 4px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-decoration: none;
            -webkit-transition: all 150ms ease;
            transition: all 150ms ease;
            float: left;
            margin-top: 31px;
        }
    </style>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?= form_open(base_url().'user/charge-stripe/'.$plan, ['id' => 'payment-form']) ?>

                <div class="form-group">
                    <label class="col-xs-3 control-label"><?= $this->lang->line('mu95'); ?></label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" name="fullName" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label"><?= $this->lang->line('mu96'); ?></label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" maxlength="16" name="number" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label"><?= $this->lang->line('mu97'); ?></label>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" placeholder="<?= $this->lang->line('mu100'); ?>" maxlength="2" name="month" />
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" placeholder="<?= $this->lang->line('mu101'); ?>" maxlength="4" name="year" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label"><?= $this->lang->line('mu98'); ?></label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" maxlength="4" name="cvc" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button type="submit" class="btn btn-primary"><?= $this->lang->line('mu99'); ?></button>
                    </div>
                </div>
            
            <?= form_close() ?>
        </div>
    </div>
</div>