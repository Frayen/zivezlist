<?php

namespace App\Module\AniList_APIv2\Repository;

use App\Module\AniList_APIv2\Builder\QueryBuilder;



class SearchAnimeRepository
{
    public function searchAnimeFormQuery() {
        $query = 'query test(
        $genre_out: [String] $genre_in: [String] $t 
              bannerImage
              description
              coverImage {  
                large medium        
              } 
              studios ( isMain: true  ) {
                nodes {
                  id 
                  name 
                } 
              } 
            }
          } 
        }';

        $text = (new QueryBuilder('query'))
            ->setArgument([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                ['$type', 'MediaType'],
                ['$page', 'Int'],
//                ['$search', 'String'],
//                ['$season', 'MediaSeason'],
                ['$yearGreater', 'FuzzyDateInt'],
                ['$yearLesser', 'FuzzyDateInt'],
//                ['$sort', '[MediaSort]'],
//                ['$format', 'MediaFormat'],
//                ['$status', 'MediaStatus'],
//                ['$country', 'CountryCode'],
//                ['$source', '[MediaSource]'],
//                ['$tag_in', '[String]'],
//                ['$genre_in', '[String]'],
//                ['$genre_out', '[String]'],
            ])
            ->selectField('GenreCollection')
            ->selectField( (new QueryBuilder('MediaTagCollection'))
                ->selectField('category')
                ->selectField('name')
            )
            ->selectField((new QueryBuilder('Page'))
                ->setArgument([['page', '$page'], ['perPage', '50'],])
                ->selectField( (new QueryBuilder('media'))
                    ->setArgument([
                        ['type', '$type'],
//                        ['search', '$search'],
//                        ['season', '$season'],
                        ['startDate_greater', '$yearGreater'],
                        ['startDate_lesser', '$yearLesser'],
//                        ['sort', '$sort'],
//                        ['format', '$format'],
//                        ['status', '$status'],
//                        ['countryOfOrigin', '$country'],
//                        ['source_in', '$source'],
//                        ['tag_in', '$tag_in'],
//                        ['', '$hide_list'],
//                        ['', '$adult'],
//                        ['genre_in', '$genre_in'],
//                        ['genre_not_in', '$genre_out'],
                    ])
                    ->selectField( (new QueryBuilder('title'))
                        ->selectField('romaji')
                    )
                    ->selectField('bannerImage')
                    ->selectField('description')
                    ->selectField( (new QueryBuilder('coverImage'))
                        ->selectField('large')
                        ->selectField('medium')
                    )
                    ->selectField( (new QueryBuilder('studios'))
                        ->setArgument([['isMain', 'true']])
                        ->selectField( (new QueryBuilder('nodes'))
                            ->selectField('id')
                            ->selectField('name')
                        )
                    )
                )
            )
            ->formatQuery();
        return $text;
//        return $query;
    }
}
