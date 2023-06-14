<?php

namespace App\Traits;

trait UrlTrait
{
    public function getPath($type, $name)
    {
        if ($type == 'image_r') {
            $path = 'images/reciters/' . $name;
        }

        if ($type == 'image_u') {
            $path = 'images/users/' . $name;
        }

        if ($type == 'audios') {
            $path = 'audios/' . $name;
        }

        if ($type == 'videos') {
            $path = 'videos/' . $name;
        }

        if (file_exists(public_path('/uploads/' . $path))) {
            return url('/public/uploads/' . $path);
        }

        return null;
    }
}
