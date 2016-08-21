<?php

namespace Jfreites\Luna\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Jfreites\Luna\Models\FileEntry;
use Jfreites\Luna\Models\Page;
use Illuminate\Http\Request;

class FileManagerController extends AdminController
{

    public function index()
    {
        $this->data['entries'] = FileEntry::all();

        return view('luna::admin.filemanager.index', $this->data);
    }

    public function create()
    {
        $pages = Page::all();
        return view('luna::admin.filemanager.create', compact('pages'));
    }

    public function store(Request $request)
    {
        //$section = $request->input('section');
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        Storage::disk('luna')->put(
                $file->getFilename().'.'.$ext,
                file_get_contents($file->getRealPath())
            );

        $entry = new FileEntry();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$ext;
        //$entry->path = storage_path($section).'/'. $file->getFilename().'.'.$ext;
        $entry->save();

        return redirect('admin/file-manager');
    }

    public function destroy($resource)
    {
        //
    }

    public function get($filename)
    {
        $entry = FileEntry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('luna')->get($entry->filename);

        return (new Response($file, 200))->header('Content-Type', $entry->mime);
    }
}