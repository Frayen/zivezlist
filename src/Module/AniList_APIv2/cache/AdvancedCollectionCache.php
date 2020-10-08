<?php


namespace App\Module\AniList_APIv2\cache;


use App\Module\AniList_APIv2\Builder\QueryBuilder;
use App\Module\AniList_APIv2\Handeler\AniListHandeler;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class AdvancedCollectionCache
{
    public function getData(AniListHandeler $handler){
        $cache = new FilesystemAdapter();
        return $advanced_collection = $cache->get('advanced_collection', function (ItemInterface $item) use ($handler){
            $item->expiresAfter(60 * 60 * 24 * 7);

            $query = (new QueryBuilder('query'))
                ->selectField('GenreCollection')
                ->selectField( (new QueryBuilder('MediaTagCollection'))
                    ->selectField('category')
                    ->selectField('name')
                )
                ->formatQuery();
            return $data = $handler->getData([], $query);
        });
    }
}