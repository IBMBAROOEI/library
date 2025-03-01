<?php



namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    public function UploadImage(Request $request, $fieldname = 'cover_image')
    {
        try {
            $file = $request->file($fieldname);
            $extension = $file->getClientOriginalExtension();
            $newFilename = time() . '_' . uniqid() . '.' . $extension;
            $destination = public_path('cover');

            $file->move($destination, $newFilename);

            return $newFilename; 
        } catch (\Exception $e) {
            return response()->json(['message' => 'upload failed', 'error' => $e->getMessage()], 500);
        }
    }
}
