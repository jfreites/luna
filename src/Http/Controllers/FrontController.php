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

        $data = $this->prepareContent($page);

        return view('templates.page', $data);
    }

    private function prepareContent($page)
    {
        return [
            'title' => $page->title,
            'content' => $page->body,
            'css' => $page->css,
            'js' => $page->js,
            'menu' => Page::getNoParents()
        ];
    }
}