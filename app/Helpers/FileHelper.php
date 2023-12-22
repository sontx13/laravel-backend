<?php

namespace App\Helpers;

class FileHelper
{
    public static function Save(
        $file, $prefix, $filename)
    {
        $url = '';
        try {
            $path = $prefix.'/'.$filename;
            $url = $file->storeAs(
                public_path() , $path
            );
        }
        catch (\Exception $e) {
            $url = '';
        }
        return $url;
    }
}
