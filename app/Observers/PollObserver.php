<?php

namespace App\Observers;

use App\User;
use App\Models\Poll\Poll;
use App\Models\Poll\Review;

class PollObserver
{
    /**
     * Handle the Poll "saving" event.
     *
     * @param  \App\Models\Poll\Poll  $poll
     * @return void
     */
    public function saving(Poll $poll)
    {
        $user = User::findOrfail($poll->user_id);

        $review = Review::where('user_id', $user->id)->where('course_id', $poll->workshop->course_id)->first();

        $pre = ($review) ? $review->rating : 0;

        $rating = ($pre + $poll->punctuation);

        $user->reviews()->updateOrCreate(
            ['course_id' => $poll->workshop->course_id],
            ['rating' => (int) $rating]
        );
            
    }
}
