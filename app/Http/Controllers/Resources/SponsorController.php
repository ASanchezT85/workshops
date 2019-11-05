<?php

namespace App\Http\Controllers\Resources;

use App\Helpers\Helper;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Sponsor\StoreSponsor;
use App\Http\Requests\Sponsor\UpdateSponsor;
use Symfony\Component\HttpFoundation\Response;

class SponsorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:sponsors.index')->only('index');
        $this->middleware('can:sponsors.create')->only('create');
        $this->middleware('can:sponsors.store')->only('store');
        $this->middleware('can:sponsors.show')->only('show');
        $this->middleware('can:sponsors.edit')->only('edit');
        $this->middleware('can:sponsors.update')->only('update');
        $this->middleware('can:sponsors.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $count = Sponsor::count();
        $offset = (isset($request->offset)) ? $request->offset : 0;
        $limit = (isset($request->limit)) ? $request->limit : $count;

        $sponsors = Sponsor::latest()->offset($offset)->limit($limit)->get();

        return $this->responseList($count, $sponsors, $data);
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
     * @param  \App\Http\Requests\Sponsor\StoreSponsor  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsor $request)
    {
        $sponsor = Sponsor::create($request->all());

        if ($request->file('file')) {
            $path = Helper::uploadFile('file', 'public/sponsors');
            $sponsor->fill(['file' => $path])->save();
        }

        $message = __('Sponsor created successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message'   => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        $data = array();

        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['sponsor'] = array();
        $data['sponsor']['id'] = $sponsor->id;
        $data['sponsor']['name'] = $sponsor->name;
        $data['sponsor']['description'] = $sponsor->description;
        $data['sponsor']['state'] = $sponsor->state;
        $data['sponsor']['file'] = (is_null($sponsor->file)) ? null : $sponsor->pathAttachment();
        $data['sponsor']['url'] = route('sponsors.show', $parameters = [$sponsor->slug], $absolute = true);

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Requests\Sponsor\UpdateSponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsor $request, Sponsor $sponsor)
    {
        $sponsor->update($request->all());

        if ($request->file('file')) {

            Storage::disk('public')->delete('sponsors/' . $sponsor->file);

            $path = Helper::uploadFile('file', 'public/sponsors');

            $category->fill(['file' => $path])->save();
        }

        $message = __('Sponsor updated successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message' => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        Storage::disk('public')->delete('categories/' . $sponsor->file);

        $sponsor->delete();

        $success = __('Sponsor removed successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_OK,
            'message' => $success
        ], Response::HTTP_OK);
    }

    protected function responseList($count, $sponsors, $data)
    {
        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['sponsors'] = array();

        $i = 0;
        foreach ($sponsors as $sponsor) {
            $data['sponsors'][$i]['id'] = $sponsor->id;
            $data['sponsors'][$i]['name'] = $sponsor->name;
            $data['sponsors'][$i]['description'] = $sponsor->description;
            $data['sponsors'][$i]['state'] = $sponsor->state;
            $data['sponsors'][$i]['file'] = (is_null($sponsor->file)) ? null : $sponsor->pathAttachment();
            $data['sponsors'][$i]['url'] = route('sponsors.show', $parameters = [$sponsor->slug], $absolute = true);

            $i++;
        }

        $data['sponsor_count'] = $count;

        return $data;
    }
}
