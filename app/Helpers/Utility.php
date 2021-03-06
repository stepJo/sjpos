<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File; 

class Utility {
    //FORMAT
    public static function dateFormat($data)
    {
        return date('d F Y H:i:s', strtotime($data));
    }

    public static function emptyFormat($data) 
    {   
        if($data == '' || $data == null) {
            return '-';
        }
        else {
            return $data;
        }
    } 

    public static function rupiahFormat($value) 
    {
        return "Rp ". number_format($value, 0, ',', '.');
    }

    public static function statusFormat($status)
    {
    	return $status == 1 ? 
    		"<span class='badge badge-success'>Aktif</span>" :
    		"<span class='badge badge-danger'>Tidak Aktif</span>";
    }
    
    //IMAGE
    public static function deleteImage($folder, $image)
    {
        if(File::exists(asset('public/uploads/images/'.$folder.'/'.$image)))
        {
            File::delete(asset('public/uploads/images/'.$folder.'/'.$image));
        }
    }

    public static function moveImage($request, $folder) 
    {
        $image = $request->file('image');

        $fullImage = time().'.'.$image->getClientOriginalExtension();

        $path = public_path('/uploads/images/'.$folder);

        $image->move($path, $fullImage);

        return $fullImage;
    }

	public static function renderImage($folder, $image) 
    {
		$path = '';

        if($image != NULL)
        {
            $path = asset('public/uploads/images/'.$folder.'/'.$image);
        }
        else 
        {
            $path = asset('public/uploads/images/no_image.jpg');
        }

        return "<img src=".$path." class='thumbnail'>";
    }   
}