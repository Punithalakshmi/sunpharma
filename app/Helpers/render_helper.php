<?php
 
if ( ! function_exists('render'))
{
    function render(string $name, array $data = [], array $options = [],$layout_path='')
    {
        
        return view(
            $layout_path,
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}





?>