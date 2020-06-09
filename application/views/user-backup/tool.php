<section>
    <div class="container-fluid new-rss">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-wrench"></i> <?php if (property_exists($info, 'full_name')): echo $info->full_name; endif; ?></h2>
                </div>
            </div>
                    <?php if(property_exists($page,'content')): echo $page->content; endif; ?>

        </div>
    </div>
</section>
