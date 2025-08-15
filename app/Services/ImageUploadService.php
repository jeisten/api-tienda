<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function uploadImage(UploadedFile $file, string $directory): string
    {
        // Crear el directorio si no existe
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Generar nombre único para el archivo
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Guardar el archivo
        $path = $file->storeAs($directory, $fileName, 'public');
        
        return $path;
    }

    public function deleteImage(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        
        return false;
    }

    public function getImageUrl(string $path): string
    {
        return asset('storage/' . $path);
    }
}
