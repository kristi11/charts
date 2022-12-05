<?php

use App\Models\Announcement;
use App\Models\Chart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/charts', function () {
    return view('charts');
});

Route::get('/', function () {
    return view('charts');
});

Route::get('/stats', function () {
    return view('stats');
});

Route::get('/announcement', function () {

    $announcement = Announcement::first();

    @abort_if(!$announcement->isActive, 404);

    return view('announcement',[
        'announcement' => $announcement,
    ]);
});

Route::get('/announcement/edit', function () {

    $announcement = Announcement::first();

    return view('edit-announcement',[
        'announcement' => $announcement,
    ]);
});

Route::patch('/announcement/update', function (Request $request) {
    $fields = $request->validate([
        'isActive' => 'required',
        'bannerText' => 'required',
        'bannerColor' => 'required',
        'titleText' => 'required',
        'titleColor' => 'required',
        'content' => 'required',
        'buttonText' => 'required',
        'buttonColor' => 'required',
        'buttonLink' => 'required|url',
        'imageUpload' => 'file|image|max:20000',
        'imageUploadFilepond' => 'string|nullable',
    ]);

    if ($request->imageUpload) {
        $requestImage = $request->file('imageUpload');

        $image = Image::make($requestImage);

        $image->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $path = config('filesystems.disks.public.root').'/'.$requestImage->hashName();
        $image->save($path);

        $fields = array_merge($fields, ['imageUpload' => $requestImage->hashName()]);
//        $path = $request->file('imageUpload')->store('images','public');
//        $fields = array_merge($fields, ['imageUpload' => $path]);
    }

    if ($request->imageUploadFilepond) {
        $newFileName = Str::after($request->imageUploadFilepond, 'tmp/');
        Storage::disk('public')->move($request->imageUploadFilepond, "images/$newFileName");
        $fields = array_merge($fields, ['imageUploadFilepond' => "images/$newFileName"]);
    }

    $announcement = Announcement::first();

    $announcement->update($fields);

    return back()->with('success_message', 'Announcement updated');
});

Route::post('/upload', function (Request $request) {
    if ($request->imageUploadFilepond) {
        //Filepond will save to temporary location first
        $path = $request->file('imageUploadFilepond')->store('tmp', 'public');
//        $announcement = Announcement::first();
//        $announcement->update(['imageUploadFilepond' => $path]);
    }
    return $path;
});
