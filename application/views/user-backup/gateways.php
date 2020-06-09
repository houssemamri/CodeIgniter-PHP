<div class="container gateways">
    <div class="row">
        <div class="gateway-body col-lg-6 col-lg-offset-3">
            <div class="headingWrap">
                <h3 class="headingTop text-center"><?= $this->lang->line('mu87'); ?></h3>
            </div>
            <div class="paymentWrap">
                <?php
                if(get_option('paypal-address') && get_option('identity-token')):
                    ?>
                        <a href="<?= site_url(['user/pay/paypal', $plan]) ?>"><img src="<?= base_url(); ?>assets/img/paypal.png" alt="PayPal"></a>
                    <?php
                endif;
                if(file_exists(FCPATH.'vendor/stm/init.php') && get_option('stripe-secret')):
                    ?>
                        <a href="<?= site_url(['user/pay/stripe', $plan]) ?>"><img src="<?= base_url(); ?>assets/img/stripe.png" alt="Stripe"></a>
                    <?php
                endif;
                if(get_option('merchant-id')):
                    ?>
                        <a href="<?= site_url(['user/pay/voguepay', $plan]) ?>"><img src="<?= base_url(); ?>assets/img/voguepay.png" alt="Voguepay"></a>
                    <?php
                endif;
                if(get_option('2co-account-number')):
                    ?>
                        <a href="<?= site_url(['user/pay/2checkout', $plan]) ?>"><img src="<?= base_url(); ?>assets/img/2co.png" alt="2Checkout"></a>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>