<?php
 
if ( ! function_exists('render'))
{
    function render(string $name, array $data = [], array $options = [])
    {
       $getRole = getSessionData(); 
       print_r($getRole);
        return view(
            'admin/layout/layout',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}





?>