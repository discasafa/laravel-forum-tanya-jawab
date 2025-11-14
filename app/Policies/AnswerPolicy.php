<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;

class AnswerPolicy
{
    public function update(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }

    public function delete(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }
}
