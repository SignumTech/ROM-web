<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "cat_name" => "required | string",
            "cat_type" => "required | string",
            "parent_id" => "required | integer"
        ]);

        $category = new Category;
        $category->cat_name = $request->cat_name;
        $category->cat_type = $request->cat_type;
        if($request->cat_type == "PARENT")
        {
            $category->parent_id = null;
        }
        else
        {
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "cat_name" => "required | string",
            "cat_type" => "required | string",
            "parent_id" => "required | integer"
        ]);

        $category = Category::find($id);
        $category->cat_name = $request->cat_name;
        $category->cat_type = $request->cat_type;
        if($request->cat_type == "PARENT")
        {
            $category->parent_id = null;
        }
        else
        {
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
