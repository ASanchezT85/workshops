<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Course\Course;

class CourseObserver
{
    /**
     * Handle the Course "saving" event.
     *
     * @param  \App\Models\Course\Course  $course
     * @return void
     */
    public function saving(Course $course)
    {
        $slug = Str::slug($course->name, '-');

        $course->slug = strtolower($slug);
    }
}
