<?php
 
if ( ! function_exists('render'))
{
    function render(string $name, array $data = [], array $options = [])
    {
        
        return view(
            'frontend/layout/frontend',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}





?>