<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Book;
use App\Models\Housing;
use App\Services\CommentService;
use Illuminate\Database\Eloquent\Model;

class CommentController extends BaseController
{
    protected array $map = [
        'bookings' => Book::class,
        'housings' => Housing::class,
    ];

    public function __construct(private CommentService $commentService){}

    protected function resolveModel(string $type, int $id): ?Model
    {
        $modelClass = $this->map[$type] ?? null;
        return $modelClass::findOrFail($id);
    }

    public function index(string $type, int $id)
    {
        $model = $this->resolveModel($type, $id);
        $comments = $this->commentService->getComments($model, auth()->id());
        return $this->sendResponse(CommentResource::collection($comments));
    }

    public function store(string $type, int $id, StoreRequest $request)
    {
        $model = $this->resolveModel($type, $id);
        $comment = $this->commentService->createComment($model, auth()->id(), $request->validated());
        return $this->sendResponse(new CommentResource($comment));
    }
}
