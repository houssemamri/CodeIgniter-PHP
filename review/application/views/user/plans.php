<section>
    <div class="container-fluid plans">
        <?php
        if($upgrade):
        ?>
        <div class="row">
            <div class="col-lg-12">
                <?= html_entity_decode($upgrade); ?> 
            </div>
        </div>
        <?php
        endif;
        ?>
        <div class="row">
            <?php
            if ($plans) {
                $col = 12 / count($plans);
                foreach ($plans as $plan) {
                    ?>
                    <div class="col-xs-12 col-md-<?= $col ?>">
                        <div class="panel panel-success <?= str_replace(" ", "-", strtolower($plan->plan_name)) ?>">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= $plan->plan_name ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="the-price">
                                    <h1><?= $plan->currency_sign ?> <?= $plan->plan_price ?></h1>
                                </div>
                                <table class="table">
                                    <?php
                                    if ($plan->features) {
                                        $features = explode("\n", $plan->features);
                                        foreach ($features as $feature) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $feature ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="panel-footer">
                                <?php
                                $cplan = 1;
                                $plan_end = time() + 86400;
                                if ($user_plan) {
                                    foreach ($user_plan as $up) {
                                        if (@$up->meta_name == "plan") {
                                            $cplan = $up->meta_value;
                                        }
                                        if (@$up->meta_name == "plan_end") {
                                            $plan_end = strtotime($up->meta_value);
                                        }
                                    }
                                }
                                if (($cplan != $plan->plan_id) || ($plan_end < time())):
                                    ?>
                                    <a href="<?= site_url(['user/upgrade', $plan->plan_id]) ?>" class="btn btn-success <?= str_replace(" ", "-", strtolower($plan->plan_name)) ?>" role="button"><?= $this->lang->line('mu94'); ?></a>
                                <?php elseif ($expires_soon): ?>
                                    <a href="<?= site_url(['user/upgrade', $plan->plan_id]) ?>" class="btn btn-default" role="button"><?= $this->lang->line('mu93'); ?></a>                        
                                <?php else: ?>
                                    <a href="#" class="btn btn-default" role="button"><?= $this->lang->line('mu92'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
