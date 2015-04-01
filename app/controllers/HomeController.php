<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showWelcome()
    {
        return View::make('hello');
    }


    public function index()
    {
        try {
            $categoryHeadings = Category::where('parent_id', '=', 1)->get();
            //return $profile;
        }
        catch(Exception $e) {
            return $e->getMessage();
        }

        //return $categoryHeadings;
        return View::make("home.index")->with('categoryHeadings', $categoryHeadings);
    }

    public function lists($categories)
    {
        try {
            //$categoryPath = array();
            $categoryItems = array();

            $categoryItem = Category::where('id', '=', $categories)->firstOrFail();
            array_push($categoryItems, $this->getPath($categoryItem));

            $categoryChild = Category::where('parent_id', '=', $categories)->get();
            $catChildCount = $categoryChild->count();
            if($catChildCount == 0) {
                return "this is base level category 1";
            }
            else {
                foreach($categoryChild as $cChild) {
                    //array_push($categoryItems, $cChild);
                    $categoryChildChild = Category::where('parent_id', '=', $cChild->id)->get();
                    $catChildChildCount = $categoryChildChild->count();

                    if ($catChildChildCount == 0) {
                        array_push($categoryItems, $this->getPath($cChild));
                    } else {
                        foreach ($categoryChildChild as $cChildChild) {
                            array_push($categoryItems, $this->getPath($cChildChild));
                        }
                    }
                }
            }

        }
        catch(Exception $e) {
            return $e->getMessage();
        }

        //return $categoryItems;
        //return $categoryPath;
        //return $categoryItems;
        //return $categoryParent;
        return View::make("home.lists")->with('allItems', array('categoryItems' => $categoryItems));
    }


    public function getPath($category) {
        $categoryPath = array();
        array_push($categoryPath, $category);

        $categoryItem = Category::where('id', '=', $category->parent_id)->firstOrFail();
        while($categoryItem->id != 1) {
            array_push($categoryPath, $categoryItem);
            $categoryItem = Category::where('id', '=', $categoryItem->parent_id)->firstOrFail();
        }
        $categoryPath = array_reverse($categoryPath);
        return $categoryPath;
    }




}
