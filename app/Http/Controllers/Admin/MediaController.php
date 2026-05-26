<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Models\Media;
use App\Services\AdminActivityLogger;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::query()
            ->latest('id')
            ->paginate(24);

        return view('admin.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaRequest $request)
    {
        $file = $request->file('file');

        $disk = 'public';
        $path = $file->store('media', $disk);

        $meta = [];
        $width = null;
        $height = null;
        if (str_starts_with((string) $file->getMimeType(), 'image/')) {
            $img = @getimagesize($file->getRealPath());
            if (is_array($img)) {
                $width = $img[0] ?? null;
                $height = $img[1] ?? null;
                $meta['image'] = ['width' => $width, 'height' => $height];
            }
        }

        $media = Media::create([
            'user_id' => $request->user()->id,
            'disk' => $disk,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize() ?: 0,
            'width' => $width,
            'height' => $height,
            'metadata' => $meta ?: null,
        ]);

        AdminActivityLogger::log(
            $request->user(),
            'media',
            'create',
            'Uploaded media: '.$media->original_name,
            Media::class,
            $media->id,
            ['mime_type' => $media->mime_type, 'size' => $media->size],
            $request
        );

        return redirect()->route('admin.media.index')->with('success', 'File uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        return view('admin.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        $name = $media->original_name;
        $id = $media->id;
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();

        AdminActivityLogger::log(
            request()->user(),
            'media',
            'delete',
            'Deleted media: '.$name,
            Media::class,
            $id,
            null,
            request()
        );

        return redirect()->route('admin.media.index')->with('success', 'File deleted.');
    }
}
