<?php

namespace App\Traits;

trait GeneralTrait
{

    public function responseMessage($code,$Status,$Message = null ,$data = null)
    {
        return response()->json([
            'code' => $code,
            'status' => $Status,
            'message' => $Message,
            'data' => $data
        ]);
    }

	public function getPath($type,$name)
	{
		if ($type == 'image_r') {
			$path = 'images/reciters/'.$name;
		}

		if ($type == 'image_u') {
			$path = 'images/users/'.$name;
		}

		if ($type == 'audios') {
			$path = 'audios/'.$name;
		}

		if ($type == 'videos') {
			$path = 'videos/'.$name;
		}

		$url = url('/public/uploads/'.$path);

		return $url;
	}

}
