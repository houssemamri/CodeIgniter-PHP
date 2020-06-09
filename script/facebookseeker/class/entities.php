<?php


class Grabber{
     
     private $ACCESS_TOKEN;

     var $graphUrl = 'https://graph.facebook.com/v2.6';
     var $resultEntitiesList = array();
     var $pageFields  = array('id','name','single_line_address','emails','website','fan_count','category','category_list','phone');
     var $groupFields  = array('id', 'name', 'email', 'member_request_count', 'owner', 'parent', 'privacy', 'updated_time', 'description');
     var $placeFields  = array('id','name', 'category', 'category_list', 'location');
     var $eventFields  = array('id', 'name', 'category', 'place', 'owner', 'interested_count', 'noreply_count', 'maybe_count', 'attending_count', 'start_time', 'end_time', 'declined_count', 'description');
     var $locationFields  = array('street', 'city', 'zip', 'country', 'state'); // , 'latitude', 'longitude'
     var $entityType  = 'page';
     var $text;
     var $type;
     var $limit;

    public function __construct($access_token){
        $this->ACCESS_TOKEN = $access_token;
    }

    public function getEntitiesList($text, $type, $limit){

        $this->text = (string) $text;
        $this->type = (string) $type;
        $this->limit = (int) $limit;

        $call = $this->graphUrl.'/search?q='.rawurlencode($this->text).'&fields=id,name&type='.$this->type.'&limit='.$this->limit.'&access_token='.$this->ACCESS_TOKEN; 

        self::getRecursiveEntities($call);
		
      return $this->resultEntitiesList;
      
    }

    private function getRecursiveEntities($url){

        $results = json_decode(self::file_get_contents_curl($url));
        if($results){
            foreach($results->data as $entity){

                $this->resultEntitiesList[] = $entity;
            }

            if(isset($results->next) && $results->next !=''){

                self::getRecursiveEntities($url.'&next='.$results->next);
            }
        }

    }


    public function getEntityDetail($id){

        switch($this->entityType){

            case 'page':
            $fields = $this->pageFields;
            break;

            case 'group':
            $fields = $this->groupFields;
            break;

            case 'place':
            $fields = $this->placeFields;
            break;

            case 'event':
            $fields = $this->eventFields;
            break;

            default:
            $fields = $this->pageFields;
            break;

        }

        $url = $this->graphUrl.'/'.$id.'/?fields='.implode(',', $fields).'&access_token='.$this->ACCESS_TOKEN;  

        $result = self::file_get_contents_curl($url);
        $newEntity = array();

        if($result){
             switch($this->entityType){

                case 'page':
                $newEntity = self::formatPageEntity($result);
                break;

                case 'group':
                $newEntity = self::formatGroupEntity($result);
                break;

                case 'place':
                $newEntity = self::formatPlaceEntity($result);
                break;

                case 'event':
                $newEntity = self::formatEventEntity($result);
                break;

                default:
                $newEntity = self::formatPageEntity($result);
                break;

            }

        }
       
        return $newEntity;

    }

    private function formatPageEntity($entity){
        $entity = json_decode($entity);

        $newEntity = array();

        foreach($this->pageFields as $k){

            if(isset($entity->$k)){
                if(is_array($entity->$k)){
                    if($k == 'category_list'){
                        $catlist = array();
                        foreach($entity->$k as $subcat){
                            $catlist[] = $subcat->name;
                        }
                        $newEntity[$k] = implode(",",$catlist);
                    }
                    else{
                        $e = $entity->$k;
                        $newEntity[$k] = $e[0];
                    }
                }
                else{
                    $newEntity[$k] = $entity->$k;
                }
            }
            else{
                $newEntity[$k] = '';
            }
        }
        $newEntity['link'] = '<a href="https://www.facebook.com/' . $entity->id . '" target="_blank" title="Page ID: ' . $entity->id . '" >' . $entity->name .'</a>';

        return $newEntity;
    }


    private function formatGroupEntity($entity){
        $entity = json_decode($entity);

        $newEntity = array();

        foreach($this->groupFields as $k){
    
        
            if(isset($entity->$k)){
                
                if(is_object($entity->$k)){
                    if($k == 'owner' || $k == 'parent'){
                        $e = $entity->$k;
                        $newEntity[$k] = '<a href="https://www.facebook.com/' . $e->id . '" target="_blank" title="Page ID: ' . $e->id . '" >' . $e->name .'</a>';
                    }
                }
                else{
                    $newEntity[$k] = $entity->$k;
                }
            }
            else{
                $newEntity[$k] = '';
            }
        }
        $newEntity['link'] = '<a href="https://www.facebook.com/' . $entity->id . '" target="_blank" title="Group ID: ' . $entity->id . '" >' . $entity->name .'</a>';

        return $newEntity;
    }
    
    
    
    private function formatEventEntity($entity){

        $entity = json_decode($entity);
        $newEntity = array();

        foreach($this->eventFields as $k){

            if(isset($entity->$k)){
                
                if(is_object($entity->$k)){
                    if($k == 'owner'){
                        $e = $entity->$k;
                        $newEntity[$k] = '<a href="https://www.facebook.com/' . $e->id . '" target="_blank" title="Page ID: ' . $e->id . '" >' . $e->name .'</a>';
                    }
                    else if($k == 'place'){
                        $e = $entity->$k;
                        $newEntity[$k] = self::formatPlaceEntityForEvent($e);
                    }
                }
                else{
                    $newEntity[$k] = $entity->$k;
                }
            }
            else{
                $newEntity[$k] = '';
            }
        }
        $newEntity['link'] = '<a href="https://www.facebook.com/' . $entity->id . '" target="_blank" title="Event ID: ' . $entity->id . '" >' . $entity->name .'</a>';

        return $newEntity;
    }
    

    private function formatPlaceEntity($entity){
        $entity = json_decode($entity);

        $newEntity = array();

        foreach($this->placeFields as $k){
            if(isset($entity->$k)){
                if(is_array($entity->$k)){
                    if($k == 'category_list'){
                        $catlist = array();
                        foreach($entity->$k as $subcat){
                            $catlist[] = $subcat->name;
                        }
                        $newEntity[$k] = implode(",",$catlist);
                    }
                    else{
                        $e = $entity->$k;
                        $newEntity[$k] = $e[0];
                    }
                }
                else if($k == 'location'){
                        $newEntity[$k] = self::formatLocationEntity($entity->$k);
                }
                else{
                    $newEntity[$k] = $entity->$k;
                }
            }
            else{
                $newEntity[$k] = '';
            }
        }
        $newEntity['link'] = '<a href="https://www.facebook.com/' . $entity->id . '" target="_blank" title="Place ID: ' . $entity->id . '" >' . $entity->name .'</a>';

        return $newEntity;
    }

    private function formatLocationEntity($obj){
        

        $location = '';

        foreach($this->locationFields as $k){
     
        
            if(isset($obj->$k)){
                $location .= $obj->$k.' ';
                 
            }
            else{
                $location .=  '';
            }
        }
        return $location;
    }

    private function formatPlaceEntityForEvent($place){
         
        if(isset($place->id)){
            $namelink = '<a href="https://www.facebook.com/' . $place->id . '" target="_blank" title="Place ID: ' . $place->id . '" >' . $place->name .'</a>';
            
            $location_detail = '';
            
            $placelocation = $place->location;
            foreach($this->locationFields as $k){
         
            
                if(isset($placelocation->$k)){
                    $location_detail .= $placelocation->$k.' ';
                     
                }
                else{
                    $location_detail .=  '';
                }
            }
            $location = $namelink.' '.$location_detail;
            return $location;
        }
        else{
            return $place->name;
        }
    }

    public function setType($type){
        $this->entityType = $type;
    }




    private function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
		//var_dump($url);
        return $data;
    }


}
