<?php
 
if ( ! function_exists('render'))
{
    function render(string $name, array $data = [], array $options = [])
    {
       $getRole = getUserRole(); 
       
       $layoutPath = (isset($data['userdata']['role']) && $data['userdata']['role'] == 3)?'admin/layout/layout':'frontend/layout/frontend';

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