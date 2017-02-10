<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 17:12
 */

namespace App\Api\Transformers;

use App\Models\Lesson;
use League\Fractal\TransformerAbstract;

//class LessonTransformer extends TransformerAbstract
class LessonTransformer extends Transformer
{
//    public function transform(Lesson $lesson)
    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' => (boolean)$lesson['free']
        ];
    }
}
