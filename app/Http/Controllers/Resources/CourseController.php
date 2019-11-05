<?php

namespace App\Http\Controllers\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Course\StoreCourse;
use App\Http\Requests\Course\UpdateCourse;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:courses.index')->only('index');
        $this->middleware('can:courses.create')->only('create');
        $this->middleware('can:courses.store')->only('store');
        $this->middleware('can:courses.show')->only('show');
        $this->middleware('can:courses.edit')->only('edit');
        $this->middleware('can:courses.update')->only('update');
        $this->middleware('can:courses.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $count = Course::count();
        $offset = (isset($request->offset)) ? $request->offset : 0;
        $limit = (isset($request->limit)) ? $request->limit : $count;

        $courses = Course::latest()->offset($offset)->limit($limit)->get();

        return $this->responseList($count, $courses, $data);
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
     * @param  \App\Http\Requests\Course\StoreCourse  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse $request)
    {
        $course = Course::create($request->all());

        if ($request->file('file')) {
            $path = Helper::uploadFile('file', 'public/courses');
            $course->fill(['file' => $path])->save();
        }

        foreach ($request->barnners as $barnner) {
            $barnner['file']->store('public/courses');
            $path = $barnner['file']->hashName();
            $course->barnners()->create(['file' => $path]);
        }

        $message = __('Course created successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message'   => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $data = array();

        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['course'] = array();
        $data['course']['id'] = $course->id;
        $data['course']['language'] = $course->lang->name;
        $data['course']['name'] = $course->name;
        $data['course']['description'] = $course->description;
        $data['course']['headed_to'] = $course->headed_to;
        $data['course']['deception'] = $course->deception;
        $data['course']['state'] = $course->state;
        $data['course']['file'] = (is_null($course->file)) ? null : $course->pathAttachment();
        $data['course']['url'] = route('sponsors.show', $parameters = [$course->slug], $absolute = true);

        $data['course']['barnners'] = array();

        $i = 0;
        foreach ($course->barnners as $barnner) {
            $data['course']['barnners'][] = (is_null($barnner->file)) ? null : $barnner->pathAttachment();
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Course\UpdateCourse  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourse $request, Course $course)
    {
        $course->update($request->all());

        if ($request->file('file')) {

            Storage::disk('public')->delete('courses/' . $course->file);

            $path = Helper::uploadFile('file', 'public/courses');

            $course->fill(['file' => $path])->save();
        }

        if ($request->barnners) {

            foreach ($request->barnners as $barnner) {
                $barnner['file']->store('public/courses');
                $path = $barnner['file']->hashName();
                $course->barnners()->update(['file' => $path]);
            }
        }

        $message = __('Course updated successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_CREATED,
            'message' => $message
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        Storage::disk('public')->delete('courses/' . $course->file);

        foreach ($course->barnners as $barnner) {
            Storage::disk('public')->delete('courses/' . $barnner->file);
        }

        $course->delete();

        $success = __('Sponsor removed successfully.');

        return response()->json([
            'status'    => 1,
            'cod'       => Response::HTTP_OK,
            'message' => $success
        ], Response::HTTP_OK);
    }

    protected function responseList($count, $courses, $data)
    {
        $data['status'] = 1;
        $data['code'] = Response::HTTP_OK;
        $data['msg'] = 'OK';

        $data['courses'] = array();

        $i = 0;
        foreach ($courses as $course) {

            $data['courses'][$i]['id'] = $course->id;
            $data['courses'][$i]['language'] = $course->lang->name;
            $data['courses'][$i]['category'] = $course->category->name;
            $data['courses'][$i]['name'] = $course->name;
            $data['courses'][$i]['description'] = $course->description;
            $data['courses'][$i]['headed_to'] = $course->headed_to;
            $data['courses'][$i]['deception'] = $course->deception;
            $data['courses'][$i]['state'] = $course->state;
            $data['courses'][$i]['file'] = (is_null($course->file)) ? null : $course->pathAttachment();
            $data['courses'][$i]['url'] = route('courses.show', $parameters = [$course->slug], $absolute = true);

            $i++;
        }

        $data['course_count'] = $count;

        return $data;
    }
}
