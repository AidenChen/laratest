<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/9
 * Time: 17:40
 */

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $lesson;

    /**
     * LessonRepository constructor.
     * @param $lesson
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function getAll()
    {
        return $this->lesson->all();
    }

    public function getOne($id)
    {
        return Lesson::find($id);
    }
}
