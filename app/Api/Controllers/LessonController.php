<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 16:58
 */

namespace App\Api\Controllers;

use App\Api\Transformers\LessonTransformer;
use App\Exceptions\ApplicationException;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends BaseController
{
    protected $lessonTransformer;

    protected $lessonRepository;

    public function __construct(LessonTransformer $lessonTransformer, LessonRepository $lessonRepository)
    {
        $this->lessonTransformer = $lessonTransformer;
        $this->lessonRepository = $lessonRepository;
    }

    public function index()
    {
        $lessons = $this->lessonRepository->getAll();
        return $this->responseData($this->lessonTransformer->collection($lessons->toArray()));
    }

    public function show($id)
    {
        $lesson = $this->lessonRepository->getOne($id);
        if (!$lesson) {
            throw new ApplicationException(40800);
        }
        return $this->responseData($this->lessonTransformer->transform($lesson));
    }

    public function store(Request $request)
    {
        if (!$request->get('title') or !$request->get('body')) {
            $options = [
                'time' => 3,
                'min' => 5
            ];
            return $this->setCode(40000)->responseError(1, $options);
        }
        Lesson::create($request->all());
        return $this->responseData([
            'status' => 'success',
            'message' => 'lesson created',
            'user' => Auth::user()
        ]);
    }
}
