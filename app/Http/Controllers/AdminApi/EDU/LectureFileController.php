<?php

namespace App\Http\Controllers\AdminApi\EDU;

use App\Actions\FileManager\FileManagerFileStoreAction;
use App\Http\Controllers\AdminApi\FileManager\AbstractFileManagerController;
use App\Models\EDU\Lecture\LectureFiles;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class LectureFileController extends AbstractFileManagerController
{
    public function show($lecture_id): JsonResponse
    {
        $files = LectureFiles::where('lecture_id', $lecture_id)->get();

        foreach ($files as $file) {
            $file->url = Storage::disk($this->storage_disk)->temporaryUrl(
                $file->file_path, Carbon::now()->addMinutes(5)
            );
        }

        return response()->json(compact('files'));
    }
}
