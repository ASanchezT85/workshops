<?php

namespace App\Http\Controllers\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Category\StoreCategory;
use App\Http\Requests\Category\UpdateCategory;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create');
        $this->middleware('can:categories.store')->only('store');
        $this->middleware('can:categories.show')->only('show');
        $this->middleware('can:categories.edit')->only('edit');
        $this->middleware('can:categories.update')->only('update');
        $this->middleware('can:categories.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $category_count = Category::count();
        $offset = (isset($request->offset)) ? $request->offset : 0;
        $limit = (isset($request->limit)) ? $request->limit : $category_count;

        $categories = Category::latest()->offset($offset)->limit($limit)->get();

        return $this->responseList($category_count, $categories, $data);
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
     * @param  App\Http\Requests\Category\StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = Category::create($request->all());

        if ($request->file('file')) {
            $path = Helper::uploadFile('file', 'public/categories');
            $category->fill(['file' => $path])->save();
        }

        $data = array();
        foreach ($request->item_langs as $value) {
            $category->category_langs()->create([
                'lang_id'       => $value['lang_id'],
                'description'   => $value['description'],
            ]);
        }

        $message = __('Category created successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message'   => $message
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $data = array();

        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['category'] = array();
        $data['category']['id'] = $category->id;
        $data['category']['name'] = $category->name;
        $data['category']['descriptions'] = array();

        $i = 0;
        foreach ($category->category_langs as $lang) {
            $data['category']['descriptions'][$i]['lang_id'] = $lang->id;
            $data['category']['descriptions'][$i]['language'] = $lang->language->name;
            $data['category']['descriptions'][$i]['description'] = $lang->description;

            $i++;
        }
        $data['category']['file'] = (is_null($category->file)) ? null : $category->pathAttachment();
        $data['category']['url'] = route('categories.show', $parameters = [$category->slug], $absolute = true);
        $data['category']['state'] = $category->state;

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Category\UpdateCategory  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category)
    {
        $category->update($request->only('name', 'state'));

        if ($request->file('file')) {

            Storage::disk('public')->delete('categories/' . $category->file);

            $path = Helper::uploadFile('file', 'public/categories');

            $category->fill(['file' => $path])->save();
        }

        if ($request->item_langs) {
            foreach ($request->item_langs as $value) {
                $category->category_langs()->updateOrCreate(
                    [
                        'lang_id' => $value['lang_id']
                    ],
                    [
                        'description'   => $value['description']
                    ]
                );
            }
        }

        $message = __('Category updated successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message'   => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::disk('public')->delete('categories/' . $category->file);

        $category->delete();

        $success = __('Category removed successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_OK,
            'message'   => $success
        ], Response::HTTP_OK);
    }

    protected function responseList($count, $categories, $data)
    {
        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['categories'] = array();

        $i = 0;
        foreach ($categories as $category) {
            $data['categories'][$i]['id'] = $category->id;
            $data['categories'][$i]['name'] = $category->name;
            $data['categories'][$i]['file'] = (is_null($category->file)) ? null : $category->pathAttachment();

            $data['categories'][$i]['descriptions'] = array();
            $x = 0;
            foreach ($category->category_langs as $lang) {
                $data['categories'][$i]['descriptions'][$x]['lang_id'] = $lang->lang_id;
                $data['categories'][$i]['descriptions'][$x]['language'] = $lang->language->name;
                $data['categories'][$i]['descriptions'][$x]['description'] = $lang->description;
                $x++;
            }

            $data['categories'][$i]['url'] = route('categories.show', $parameters = [$category->slug], $absolute = true);
            $data['categories'][$i]['state'] = $category->state;
            $i++;
        }

        $data['category_count'] = $count;

        return $data;
    }
}
