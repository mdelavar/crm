<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageHandler
{
    public function storeFile($file)
    {
        $name = time() . '_' . Str::random(3) . '_' . $this->fileName($file) . '_file.' . $file->getClientOriginalExtension();
        $path = verta()->format('Y-n-j');
        Storage::disk('uploads')->putFileAs($path,$file,$name);
        return ($path . '/' . $name);
    }

    private function fileName($image)
    {
        $input_file = str_replace(' ', '_', $image->getClientOriginalName());
        $file_name = pathinfo($input_file, PATHINFO_FILENAME);
        return $file_name;
    }
}
