<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 14:46
 */

namespace App\Api\Transformers;

/**
 * Class Transformer
 * @package App\Api\Transformers
 */
abstract class Transformer
{
    /**
     * @param $items
     * @return array
     */
    public function collection($items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @param $item
     * @return mixed
     */
    abstract public function transform($item);
}
