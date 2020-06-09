<section>
    <div class="container-fluid notifications">
        <div class="col-lg-4">
            <div class="col-lg-12">
                <ul class="list-group">
                    <?php
                    if ($notifications) {
                        foreach ($notifications as $notification) {
                            // displays all notifications
                            echo '<li class="list-group-item" data-id="' . $notification->id . '"><i class="fa fa-bell-o"></i> ' . $notification->notification_title . '<span class="pull-right">' . calculate_time($notification->sent_time, time()) . '</span> </li>';
                        }
                    } else {
                        echo '<li class="list-group-item">No notifications found.</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="col-lg-12 msg-body">

            </div>
        </div>
    </div>
</section>
