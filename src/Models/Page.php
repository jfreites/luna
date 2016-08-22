<?php

namespace Jfreites\Luna\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['template', 'name', 'title', 'slug', 'body', 'css', 'js', 'meta_title', 'meta_keywords', 'meta_description', 'visible_in_menu'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getTemplateName()
    {
        return trim(preg_replace('/(id|at|\[\])$/i', '', ucfirst(str_replace('_', ' ', $this->template))));
    }

    public function getPageLink()
    {
        return url($this->slug);
    }

    /**
     * Get all active pages nested
     *
     * @return array
     */
    public static function getNested()
    {
        DB::setFetchMode(\PDO::FETCH_ASSOC);

        $pages = \DB::table('pages')
                    //->where('private', 0) Only Public pages?
                    ->orderBy('parent_id')
                    ->get();

        DB::setFetchMode(\PDO::FETCH_CLASS);

        $result = [];

        foreach ($pages as $page) {
            if (! $page['parent_id']) {
                // This page has no parent
                $result[$page['id']] = $page;

            } else {
                // This is a child page
                $result[$page['parent_id']]['children'][] = $page;
            }
        }

        return $result;
    }

    /**
     * Save the current order for the items
     *
     * @param $pages
     */
    public static function saveOrder($pages)
    {
        if (count($pages)) {
            foreach ($pages as $order => $page) {

                if (isset($page['id']) && !empty($page['id'])) {
                    $data = [
                        'parent_id' => (int) $page['parent_id'],
                        'order' => $order
                    ];

                    \DB::table('pages')
                        ->where('id', $page['id'])
                        ->update($data);
                }
            }
        }
    }

    /**
     * List a given parent and his childs, in an associative array
     *
     * @param null $id
     * @param bool $single
     */
    public static function getWithParent ($id = NULL, $single = FALSE)
    {
        // List a given parent and his childs, in an associative array
    }

    /**
     * Fetch pages without parents
     *
     * @param $menu boolean
     */
    public static function getNoParents($menu = true)
    {
        $query = \DB::table('pages')
            ->select('title', 'slug')
            ->where('parent_id', 0)
            ->orderBy('order', 'asc');

        if ($menu) {
            return $query->where('visible_in_menu', 1)->get();
        }

        return $query->get();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
}