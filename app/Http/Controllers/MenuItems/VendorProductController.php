<?php

namespace App\Http\Controllers\MenuItems;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{

    /**
     * Get uploaded user photo
     *
     * @param Request $request
     * @return string
     */
    private function getUploadedFileName(Request $request): string
    {
        $file = '';

        try {
            $folder = storage_path('app/public/users');
            $fileName = md5(str_shuffle($request->name));
            $extension = $request->file('photo')->getClientOriginalExtension();

            if (! file_exists($folder) && ! mkdir($folder) && ! is_dir($folder)) {
                throw new RuntimeException('Failed to create storage folder.');
            }

            // Resize the chosen image then, upload
            $photo = Image::make($request->file('photo'))
                ->fit(300, 300)
                ->save("{$folder}/{$fileName}.{$extension}");

            $file = $photo->filename . '.' . $extension;
        }

        catch (\Exception $exception) {
            if ($file !== '') {
                // Delete uploaded photo from disk.
                Storage::disk('public')->delete("users/{$file}");
            }
        }

        return $file;
    }
}
