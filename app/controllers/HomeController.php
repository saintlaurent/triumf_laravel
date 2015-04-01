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
            $items = array();
            $numOfItems = 0;
            $arrDisplayFields = array();


            $categoryItem = Category::where('id', '=', $categories)->firstOrFail();
            array_push($categoryItems, $this->getPath($categoryItem));

            $categoryChild = Category::where('parent_id', '=', $categories)->get();
            $catChildCount = $categoryChild->count();
            if($catChildCount == 0) {
                /* leaf nodes */
                $items = Item::where('category_id', '=', $categories)->get();
                $numOfItems = $items->count();

                /* gather display fields */
                $tableFields = Category::where('id', '=', $items[0]->category_id)->get();
                $displayFields = $tableFields[0]->displayed_fields;
                $f = substr(chop($displayFields),7);
                $arrDisplayFields = explode("\n- ",$f);
//                return $arrDisplayFields;
//
//                $var = 'po_number';
//                return $items[0]->$arrDisplayFields[2];
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
<<<<<<< HEAD
        return View::make("home.lists")->with('allItems', array('categoryItems' => $categoryItems));
=======
//        return View::make("home.lists")->with('allItems', array('categoryPath' => $categoryPath, 'categoryItems' => $categoryItems));
        return View::make("home.lists")->with('allItems', array('categoryPath' => $categoryPath, 'categoryItems' => $categoryItems,
            'items' => $items, 'numOfItems' => $numOfItems, 'arrDisplayFields'=> $arrDisplayFields));
//        $catChildCount = 5;
//        return View::make("home.lists")->with('allItems', array('categoryPath' => $categoryPath, 'categoryItems' => $categoryItems, 'c' => $catChildCount));
>>>>>>> 9f5057b4fe107c9cfad90ceae9f0eca31cec47b1
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
