<?php
class Classo{
    public function bean($a) {
        return $this->check($a);
    }
    private function check($a) {
        if($a[0]->updated) {
            if($a[0]->updated < time()) {
                get_instance()->ecl('Instance')->mod('rss', 'update_rss_meta', [$a[0]->rss_id,'updated', $this->lime($a)]);
                return FALSE;
            } else {
                return true;
            }
        } else {
            get_instance()->ecl('Instance')->mod('rss', 'update_rss_meta', [$a[0]->rss_id,'updated', $this->lime($a)]);
            return false;
        }
    }
    private function lime($a) {
        if(is_numeric($a[0]->period)) {
            return time() + ($a[0]->period * 60);
        } else {
            return time();
        }
    }
}