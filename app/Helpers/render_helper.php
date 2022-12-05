<?php
 
if ( ! function_exists('render'))
{
    function render(string $name, array $data = [], array $options = [])
    {
       $getRole = getUserRole(); 

     //  echo $data['current_url']->getSegment(1);die;
       
       $layoutPath = ((isset($data['userdata']['role']) && $data['userdata']['role'] == 3) || ($data['current_url']->getSegment(1) == 'admin'))?'admin/layout/layout':'frontend/layout/frontend';

        return view(
            $layoutPath,
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}





?>