<?php 
function base_url2()
{
	if(strpos($_SERVER['HTTP_HOST'],'www')===false)
    {
        return $url = 'https://review-thunder.com/';
    }
    else
    {
       return $url = 'https://www.review-thunder.com/';
    } 
}
?>