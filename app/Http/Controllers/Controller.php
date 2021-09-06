<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $query;

    protected function getQuery()
    {
        return $this->query;
    }

    protected function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    protected function uploadImage($image, $class, $forder = 'uploads', $crop = false, $width = 144, $height = 144)
    {
        if ($image && file_exists($class->image) && $class->image != '') {
            unlink($class->image);
        }

        return $image
            ? $class->update([
                'image' => $this->storeImage($image, $forder, $crop, $width, $height)
            ])
            : '';
    }

    protected function uploadImageableImage($image, $class, $forder = 'uploads', $crop = false, $width = 144, $height = 144)
    {

        if ($image && $class->image && file_exists($class->image->url) && $class->image->url != '') {
            unlink($class->image->url);
        }

        return $image
            ? $class->image()->updateOrCreate(
                ['url' => $class->image ? $class->image->url : ''],
                ['url' => $this->storeImage($image, $forder, $crop, $width, $height)]
            )
            : '';
    }

    protected function storeImage($image, $forder, $crop, $width, $height)
    {
        $extention = $crop
            ? explode('/', (explode(';', $image)[0]))[1]
            : strtolower($image->getClientOriginalExtension());

        $fileName = Str::random(16) . '.' . $extention;

        $path = $forder . '/' . date("Y") . '/';

        $finalImage = ImageManagerStatic::make($image)
            ->resize($width, $height)
            ->encode($extention);

        Storage::put('public/' . $path . $fileName, $finalImage->__toString());

        return 'storage/' . $path . $fileName;
    }

    protected function dateFilter($dateField = 'created_at')
    {
        $this->query
            ->when(request()->day, function ($query, $day) use ($dateField) {
                $query->whereDate($dateField, '>=', date('Y-m-d', strtotime("-{$day} days")));
            })
            ->when(request()->from, function ($query, $from) use ($dateField) {
                $query->whereDate($dateField, '>=', $from);
            })
            ->when(request()->to, function ($query, $to) use ($dateField) {
                $query->whereDate($dateField, '<=', $to);
            });

        return $this;
    }
}
