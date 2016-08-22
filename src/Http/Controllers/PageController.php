<?php

namespace Jfreites\Luna\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Jfreites\Luna\Models\Page;

class PageController extends AdminController
{
    public function index()
    {
        return view('luna::admin.pages.index');
    }

    public function create()
    {
        return view('luna::admin.pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200'
        ]);

        $request['slug'] = $this->slugifyTitle($request->title);
        $request['visible_in_menu'] = isset($request->visible_in_menu) ? 1 : 0;

        Page::create($request->all());

        return redirect('admin/page');
    }

    public function edit(Page $page)
    {
        if (!$page) {
            return redirect('admin/page');
        }

        return view('luna::admin.pages.edit', compact('page'));
    }

    public function show($id)
    {
        // show the resource
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        $page->title = $request->title;
        $page->template = $request->template;
        $page->body = $request->body;
        $page->css = $request->css;
        $page->js = $request->js;
        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->meta_description = isset($request->visible_in_menu) ? 1 : 0;

        if (!$page->save()) {
            return back();
        }

        return redirect('admin/page');
    }

    public function destroy($id)
    {
        $children = Page::whereParentId($id)->get();

        if (count($children) > 0) {
            return redirect('admin/page')->with('message', 'Atención, esta pagina tiene sub-paginas. Intente eliminarlas primero.');
        }

        Page::destroy($id);

        return redirect('admin/page');
    }

    public function orderAjax()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            Page::saveOrder($_POST['sortable']);
        }
        
        // Fetch all pages
        $pages = Page::getNested();

        return view('luna::admin.pages.order_ajax', compact('pages'));
    }

    private function slugifyTitle($text)
    {

        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
