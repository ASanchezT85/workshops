<?php

namespace App\Http\Controllers\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Workshop;
use App\Models\Category\Category;
use App\Models\Variables\Language;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Workshop\StoreWorkshop;
use App\Http\Requests\Workshop\UpdateWorkshop;
use Symfony\Component\HttpFoundation\Response;

class WorkshopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('can:workshops.create')->only('create');
        $this->middleware('can:workshops.store')->only('store');
        $this->middleware('can:workshops.edit')->only('edit');
        $this->middleware('can:workshops.update')->only('update');
        $this->middleware('can:workshops.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang_id = $this->lang()->id;
        $data = array();

        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $count = Workshop::count();
        $offset = (isset($request->offset)) ? $request->offset : 0;
        $limit = (isset($request->limit)) ? $request->limit : $count;
        $category = (isset($request->category_id)) ? $request->category_id : null;
        $type = (isset($request->user('api')->type)) ? $request->user('api')->type : null;

        $data['auth'] = array();
        $data['auth']['?'] = (is_null($type)) ? null : true;
        $data['auth']['type'] = (is_null($type)) ? null : $request->user('api')->roles[0]->name;

        $curses = Course::where('lang_id', $lang_id)->select('id')->get();

        $workshops = Workshop::whereIn('course_id', $curses)->where('state', 'ACTIVE')
            ->orderBy('start_date', 'ASC')
            ->latest()
            ->offset($offset)
            ->limit($limit)
            ->get();

        $data['barnner'] = array();
        $name = null;
        $description = null;
        $file = null;
        $route = null;

        if ( ! is_null($category) ) {

            $barnner = Category::findOrfail($category);
            $data['barnner'][0]['category'] = $barnner->name;
            $data['barnner'][0]['description'] = $barnner->category_langs()->where('lang_id', $lang_id)->first()->description;
            $data['barnner'][0]['file'] = (is_null($barnner->file)) ? null : $barnner->pathAttachment();
            $data['barnner'][0]['url'] = route('categories.show', $parameters = [$barnner->slug], $absolute = true);

            $curses = Course::where('lang_id', $lang_id)->where('category_id', $category)->select('id')->get();

            $workshops = Workshop::whereIn('course_id', $curses)->where('state', 'ACTIVE')
                ->orderBy('start_date', 'ASC')
                ->latest()
                ->offset($offset)
                ->limit($limit)
                ->get();
            
        }

        if ( $type == 1 OR $type == 2 ) {
            
            $data['barnner'] = array();

            $workshops = Workshop::latest()->offset($offset)->limit($limit)->get();
        }

        return $this->responseList($count, $workshops, $data, $offset, $limit);

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
     * @param  \App\Http\Requests\Workshop\StoreWorkshop;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkshop $request)
    {
        Workshop::create($request->all());

        $message = __('Workshop created successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message'   => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        $data = array();

        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['workshop']['id'] = $workshop->id;
        $data['workshop']['language'] = $workshop->course->lang->name;
        $data['workshop']['category'] = $workshop->course->category->name;
        $data['workshop']['name'] = $workshop->course->name;
        $data['workshop']['description'] = $workshop->course->description;
        $data['workshop']['file'] = (is_null($workshop->course->file)) ? null : $workshop->course->pathAttachment();
        $data['workshop']['headed_to'] = $workshop->course->headed_to;
        $data['workshop']['deception'] = $workshop->course->deception;
        $data['workshop']['start_date'] = $this->formatDate($workshop->start_date, $workshop->course->lang_id);
        $data['workshop']['address'] = $workshop->address;
        $data['workshop']['sale'] = $workshop->sale;
        $data['workshop']['presale'] = $workshop->presale;
        $data['workshop']['currency'] = $workshop->course->lang->symbol_currency;
        $data['workshop']['duration'] = $workshop->duration;
        $data['workshop']['team'] = $workshop->team;
        $data['workshop']['certification'] = $workshop->certification;
        $data['workshop']['quotas'] = $workshop->quotas;
        $data['workshop']['inscribed'] = $workshop->users->count();
        $data['workshop']['space_available'] = ($workshop->quotas - $workshop->users->count());
        $data['workshop']['state'] = $workshop->state;
        $data['workshop']['created_at'] = $workshop->created_at->format('d-M-Y');
        $data['workshop']['updated_at'] = $workshop->updated_at->format('d-M-Y');
        $data['workshop']['url'] = route('workshops.show', $parameters = [$workshop->slug], $absolute = true);

        $averages = $workshop->course->reviews;
        $rewies = array();
        foreach ($averages as $average) {
            $rewies[] = $average->rating;
        }

        $data['workshop']['average'] = (int) collect($rewies)->avg();

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Requests\Workshop\UpdateWorkshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkshop $request, Workshop $workshop)
    {
        $workshop->update($request->all());

        $message = __('Workshop updated successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message' => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        
        $success = __('Workshop removed successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_OK,
            'message' => $success
        ], Response::HTTP_OK);
    }

    protected function lang()
    {   
        $locale = str_replace('_', '-', app()->getLocale());

        $lang = Language::where('acronym', $locale)->first();

        return $lang;
    }

    protected function responseList($count, $workshops, $data, $offset, $limit)
    {
        $data['workshops'] = array();

        $category_ids = array();
        $sale = array();
        $pre_sale = array();

        $i = 0;
        foreach ($workshops as $workshop) {

            $data['workshops'][$i]['id'] = $workshop->id;
            $data['workshops'][$i]['language'] = $workshop->course->lang->name;
            $data['workshops'][$i]['category'] = $workshop->course->category->name;
            $data['workshops'][$i]['name'] = $workshop->course->name;
            $data['workshops'][$i]['description'] = $workshop->course->description;
            $data['workshops'][$i]['file'] = (is_null($workshop->course->file)) ? null : $workshop->course->pathAttachment();
            $data['workshops'][$i]['headed_to'] = $workshop->course->headed_to;
            $data['workshops'][$i]['deception'] = $workshop->course->deception;
            $data['workshops'][$i]['start_date'] = $this->formatDate($workshop->start_date, $workshop->course->lang_id);
            $data['workshops'][$i]['address'] = $workshop->address;
            $data['workshops'][$i]['sale'] = $workshop->sale;
            $data['workshops'][$i]['presale'] = $workshop->presale;
            $data['workshops'][$i]['currency'] = $workshop->course->lang->symbol_currency;
            $data['workshops'][$i]['duration'] = $workshop->duration;
            $data['workshops'][$i]['team'] = $workshop->team;
            $data['workshops'][$i]['certification'] = $workshop->certification;
            $data['workshops'][$i]['quotas'] = $workshop->quotas;
            $data['workshops'][$i]['inscribed'] = $workshop->users->count();
            $data['workshops'][$i]['space_available'] = ($workshop->quotas - $workshop->users->count());
            $data['workshops'][$i]['state'] = $workshop->state;
            $data['workshops'][$i]['created_at'] = $workshop->created_at->format('d-M-Y');
            $data['workshops'][$i]['updated_at'] = $workshop->updated_at->format('d-M-Y');
            $data['workshops'][$i]['url'] = route('workshops.show', $parameters = [$workshop->slug], $absolute = true);

            $category_id = $workshop->course->category_id;
            if ( ! in_array($category_id, $category_ids) ) {
                $category_ids[] = $category_id;
            }

            $price = $workshop->sale;
            if ( ! in_array($price, $sale) ) {
                $sale[] = $price;
            }

            $pre_price = $workshop->presale;
            if ( ! in_array($pre_price, $pre_sale) ) {
                $pre_sale[] = $pre_price;
            }

            $averages = $workshop->course->reviews;
            $rewies = array();
            foreach ($averages as $average) {
                $rewies[] = $average->rating;
            }

            $data['workshops'][$i]['average'] = (int) collect($rewies)->avg();
            $i++;
        }

        $data['filtersList'] = array();

        $data['filtersList'][0]['id'] = 1;
        $data['filtersList'][0]['category_name'] = __('Categories');
        $data['filtersList'][0]['category_filter'] = __('categories');
        $data['filtersList'][0]['open'] = false;
        $data['filtersList'][0]['data'] = array();

        $categories = Category::whereIn('id', $category_ids)->get();

        $i = 0;
        foreach ($categories as $category) {

            $name = $category->name;
            $route = route('workshops.index', $parameters = ['category_id' => $category->id], $absolute = true);

            $data['filtersList'][0]['data'][$i]['id'] = $category->id;
            $data['filtersList'][0]['data'][$i]['filter'] = $name;
            $data['filtersList'][0]['data'][$i]['filter_name'] = $category->slug;
            $data['filtersList'][0]['data'][$i]['filter_url'] = $route;
            $data['filtersList'][0]['data'][$i]['checked'] = false;
            
            $i++;
        }

        $data['total'] = array();
        $data['total'][0]['total_results'] = (int) $workshops->count();
        $data['total'][0]['total_workshop'] = (int) $count;
        $data['total'][0]['offset'] = (int) $offset;
        $data['total'][0]['limit'] = (int) $limit;
        $data['total'][0]['max_pre_sale'] = (float) ($count > 0) ? number_format(max($pre_sale), 2) : 0;
        $data['total'][0]['max_sale'] = (float) ($count > 0) ? number_format(max($sale), 2) : 0;

        return $data;
    }

    protected function formatDate($start_date, $lang_id)
    {
        $date = Carbon::parse($start_date);
        $months = array();

        $months[1] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $months[2] = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $months[3] = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        return $date->format('d') . ' de ' . $months[$lang_id - 1][($date->format('n')) - 1] . ' del ' . $date->format('Y');
    }
}
