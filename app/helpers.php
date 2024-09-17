<?php

if(!function_exists('firebase_config'))
{
    function firebase_config(): array
    {
        return json_decode(file_get_contents(storage_path('app/private/firebase/config.json')), true);
    }
}
