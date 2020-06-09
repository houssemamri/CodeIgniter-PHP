

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<section>
    <div class="container-fluid networks">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-share-square-o" aria-hidden="true"></i> <?= $this->lang->line('mu91'); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul>
                        <?php
                        if ($data) {
                            foreach ($data as $social) {
                                echo $social;
                            }
							
                        } else {
                            echo '<p>' . $this->lang->line('mu187') . '</p>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
