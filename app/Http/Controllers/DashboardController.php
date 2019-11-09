<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Workshop;
use App\Models\Category\Category;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function dashborard()
    {
        $data = array();

        //1200 800
        $users = User::get();
        $data[0]['id'] = (int) 1;
        $data[0]['name'] = (string) __('Users');
        $data[0]['icon'] = (string) asset('images/dashboard/users.png', $secure = null);
        $data[0]['count'] = (int) $users->count();
        $data[0]['last_update'] = $users->last()->updated_at->format('d-M-Y');

        $categories = Category::get();
        $data[1]['id'] = (int) 2;
        $data[1]['name'] = (string) __('Categories');
        $data[1]['icon'] = (string) asset('images/dashboard/categories.png', $secure = null);
        $data[1]['count'] = (int) $categories->count();
        $data[1]['last_update'] = $categories->last()->updated_at->format('d-M-Y');

        $sponsors = Sponsor::get();
        $data[2]['id'] = (int) 3;
        $data[2]['name'] = (string) __('Sponsor');
        $data[2]['icon'] = (string) asset('images/dashboard/sponsor.png', $secure = null);
        $data[2]['count'] = (int) $sponsors->count();
        $data[2]['last_update'] = $sponsors->last()->updated_at->format('d-M-Y');

        $courses = Course::get();
        $data[3]['id'] = (int) 4;
        $data[3]['name'] = (string) __('Courses');
        $data[3]['icon'] = (string) asset('images/dashboard/courses.png', $secure = null);
        $data[3]['count'] = (int) $courses->count();
        $data[3]['last_update'] = $courses->last()->updated_at->format('d-M-Y');
        
        $workshops = Workshop::get();
        $data[4]['id'] = (int) 5;
        $data[4]['name'] = (string) __('Workshop');
        $data[4]['icon'] = (string) asset('images/dashboard/workshop.png', $secure = null);
        $data[4]['count'] = (int) $workshops->count();
        $data[4]['last_update'] = $workshops->last()->updated_at->format('d-M-Y');

        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $data,
            'message'   => 'OK'
        ], Response::HTTP_OK);

    }
}
