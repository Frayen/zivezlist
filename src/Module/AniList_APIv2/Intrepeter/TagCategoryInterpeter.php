<?php


namespace App\Module\AniList_APIv2\Intrepeter;


class TagCategoryInterpeter
{
    public function getTags(array $tags) {
        $newTags = [];
        foreach ($tags as $tag) {
//            $tagArray = $newTags[$tag['category']];
            $newTags[$tag['category']][] = $tag['name'];
        }
        return $newTags;
    }
}