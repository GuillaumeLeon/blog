<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Devloops\LaravelTypesense\Interfaces\TypesenseSearch;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
//    use Searchable;

    protected $guarded = [
        'id'
    ];
//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        if (config('scout.driver') == 'typesensesearch') {
//            $array['id'] = (string)$array['id']; $array['created_at'] = (integer)\Carbon\Carbon::parse($array['created_at'])->timestamp;
//        }
//
//        return $array;
//    }
//
//    public function getCollectionSchema(): array {
//        return [
//            'name' => 'posts',
//            'fields' => [
//                [
//                    'name' => 'id',
//                    'type' => 'int64',
//                ],
//                [
//                    'name' => 'title',
//                    'type' => 'string',
//                ],
//                [
//                    'name' => 'content',
//                    'type' => 'string',
//                ],
//                [
//                    'name' => 'author',
//                    'type' => 'string',
//                ],
//                [
//                    'name' => 'image',
//                    'type' => 'string',
//                ],
//                [
//                    'name' => 'categories',
//                    'type' => 'string',
//                ],
//                [
//                    'name' => 'created_at',
//                    'type' => 'int32',
//                ],
//                [
//                    'name' => 'updated_at',
//                    'type' => 'int32',
//                ],
//            ],
//            'default_sorting_field' => 'id',
//        ];
//    }
//
//    public function typesenseQueryBy(): array {
//        return [
//            'name',
//        ];
//    }
}
