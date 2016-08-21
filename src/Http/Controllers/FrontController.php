<?php

namespace Jfreites\Luna\Http\Controllers;

use Jfreites\Luna\Models\Page;

class FrontController extends Controller
{

    public function slug($slug = null)
    {
        if (!$slug) {
            abort('404'); // This never happen, because we have a catch 'em all route...
        }

        $page = Page::whereSlug($slug)->first();

        if (!$page) {
            if (file_exists(resource_path('views/errors/404.blade.php'))) {
                return view('errors.404');
            }
            return view('luna::errors.404');
        }

        if ($page->private && !Auth::check()) {
            abort('403');
        }

        return $page;

        //$data = $this->prepareContent($page);

        //return view(config('luna.templates_folder').'.'.$page->template, $data);
    }

    private function prepareContent($page)
    {
        return [
            'title' => $page->title,
            'content' => $page->content,
            'extras' => json_decode($page->extras, true),
            'menu' => Page::getNoParents()
        ];
    }
}