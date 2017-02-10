<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 16:58
 */

namespace App\Api\Controllers;

use App\Api\Transformers\LessonTransformer;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends BaseController
{
    protected $lessonTransformer;

    protected $lessonRepository;

    /**
     * LessonController constructor.
     * @param LessonTransformer $lessonTransformer
     * @param LessonRepository $lessonRepository
     */
    public function __construct(LessonTransformer $lessonTransformer, LessonRepository $lessonRepository)
    {
        $this->lessonTransformer = $lessonTransformer;
        $this->lessonRepository = $lessonRepository;
    }

    public function index()
    {
        $lessons = $this->lessonRepository->getAll();
//        return $this->collection($lessons, $this->lessonTransformer);
        return $this->responseData([
            'data' => $this->lessonTransformer->collection($lessons->toArray())
        ]);
    }

    public function show($id)
    {
        $lesson = $this->lessonRepository->getOne($id);
        if (!$lesson) {
//            return $this->response->errorNotFound('Lesson not found');
            return $this->setCode(404)->responseData();
        }
//        return $this->item($lesson, $this->lessonTransformer);
        return $this->responseData([
//            'user' => $this->user(),
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }

    public function store(Request $request)
    {
//        $meta = $request->get('meta');
//        $foo = $meta['foo'];
//        return $this->setCode(201)->responseData([
//            'status' => 'success',
//            'data' => $foo
//        ]);
        if (!$request->get('title') or !$request->get('body')) {
            $options = [
                'foo' => 'bar',
                'test' => 'one'
            ];
            return $this->setCode(422)->responseData([], $options);
        }
        Lesson::create($request->all());
        return $this->responseData([
            'data' => [
                'status' => 'success',
                'message' => 'lesson created'
            ]
        ]);
    }
}
