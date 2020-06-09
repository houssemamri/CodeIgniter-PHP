<?php
$result = array();
$dir = 'tokens';
function is_dir_empty($dir) {
      return (count(scandir($dir)) == 2);
    }
if((isset($_POST['_action']) && $_POST['_action'] == 'cleardir') && (isset($_POST['_method']) && $_POST['_method'] == 'JXR')){
    

    if (!is_readable($dir)) return NULL;

    if ($handle = opendir('tokens')) {
         
        while (false !== ($file = readdir($handle))) {
            
           if(is_file($dir.'/'.$file)){
               unlink($dir.'/'.$file);
             }
        }
        closedir($handle);
        
    }
}
$result['empty'] = (bool) (is_dir_empty('tokens')) ? TRUE : FALSE;

echo json_encode($result);

?>