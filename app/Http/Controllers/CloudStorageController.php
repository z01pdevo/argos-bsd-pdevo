<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CloudStorageController extends Controller
{
    public static function generateSignedURL($filepath,$seconds){

        return Storage::disk('gcs'/* following your filesystem configuration */)
            ->getAdapter()
            ->getBucket()
            ->object($filepath)
            ->signedUrl(new \DateTime('+ ' . $seconds . ' seconds'));
    }
}
