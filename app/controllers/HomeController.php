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
            $categoryPath = array();
            $categoryItems = array();

            $categoryItem = Category::where('id', '=', $categories)->firstOrFail();
            array_push($categoryPath, $categoryItem);
            //$categoryPath = array_add($categoryPath, 0, $categoryItem);
            //$categoryItems = array_add($categoryItems, $categoryItem->id, $categoryItem);

            $categoryParent = Category::where('id', '=', $categoryItem->parent_id)->firstOrFail();
            //$pathCount = 1;
            while($categoryParent->id != 1) {
                array_push($categoryPath, $categoryParent);
                //$categoryPath = array_add($categoryPath, $pathCount, $categoryParent);
                //$pathCount+= 1;
                $categoryParent = Category::where('id', '=', $categoryParent->parent_id)->firstOrFail();
            }

            $categoryChild = Category::where('parent_id', '=', $categories)->get();
            $catChildCount = $categoryChild->count();
            if($catChildCount == 0) {
                return "this is base level category 1";
            }
            else {
                foreach($categoryChild as $cChild){
                    array_push($categoryItems, $cChild);
                }
            }

        }
        catch(Exception $e) {
            return $e->getMessage();
        }
        $categoryPath = array_reverse($categoryPath);

        //return $categoryItems;
        //return $categoryPath;
        //return $categoryItems;
        //return $categoryParent;
        return View::make("home.lists")->with('allItems', array('categoryPath' => $categoryPath, 'categoryItems' => $categoryItems));
    }


}
