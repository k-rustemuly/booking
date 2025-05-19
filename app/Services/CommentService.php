<?php
declare(strict_types=1);

namespace App\Services;

class CommentService
{
    public function getComments($model, $userId)
    {
        return $model->comments()->where('user_id', $userId)->latest()->paginate();
    }

    public function createComment($model, $userId, array $data)
    {
        return $model->comments()->create([
            'user_id' => $userId,
            ...$data,
        ]);
    }
}
