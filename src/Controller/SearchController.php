<?php


namespace App\Controller;

use App\Entity\SearchAnime;
use App\Form\SearchAnimeType;
use App\Module\AniList_APIv2\Handeler\AniListHandeler;
use App\Module\AniList_APIv2\Intrepeter\TagCategoryInterpeter;
use App\Module\AniList_APIv2\Repository\SearchAnimeRepository;
use App\Module\AniList_APIv2\cache\AdvancedCollectionCache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class SearchController extends AbstractController
{

    private $tagCategoryInterpeter;

    public function __construct(TagCategoryInterpeter $tagCategoryInterpeter)
    {
        $this->tagCategoryInterpeter = $tagCategoryInterpeter;
    }

    /**
     * @Route("", name="SearchAnime")
     * @param     Request                 $request
     * @param     AniListHandeler         $handeler
     * @param     SearchAnimeRepository   $searchAnimeRepository
     * @param     AdvancedCollectionCache $advancedCollectionCache
     * @return    Response
     */
    public function yoloTest(
        Request $request,
        AniListHandeler $handeler,
        SearchAnimeRepository $searchAnimeRepository,
        AdvancedCollectionCache $advancedCollectionCache
    ) {
        $search = new SearchAnime();
        $query = $searchAnimeRepository->searchAnimeFormQuery();
        $standardVar = [
            'type' => isset($_GET['type']) && !empty($_GET['type']) ? strtoupper($_GET['type']) : 'ANIME',
            'page' => isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1,
        ];
        
        $rawVars = [];

        //TODO: check values,

        if (isset($_GET['yearLesser']) && !empty($_GET['yearLesser']) &&
            isset($_GET['yearGreater']) && !empty($_GET['yearGreater'])) {
            if ($_GET['yearGreater'] >= 1950 && $_GET['yearLesser'] <= date("Y")) {
                $rawVars['yearLesser'] = $_GET['yearLesser'];
                $rawVars['yearGreater'] = $_GET['yearGreater'];

                if ($_GET['yearLesser'] > $_GET['yearGreater']) {
                    $rawVars['yearLesser'] = $_GET['yearGreater'];
                    $rawVars['yearGreater'] = $_GET['yearLesser'];
                }
                $search->setYearLesser($rawVars['yearLesser']);
                $search->setYearGreater($rawVars['yearGreater']);
            }
        } elseif (isset($_GET['year']) && !empty($_GET['year'])) {
            if (is_numeric($_GET['year']) && $_GET['year'] >= 1950 && $_GET['year'] <= date("Y")) {
                $search->setYear($_GET['year']);

                $rawVars['year'] = $_GET['year'];
            }
        }

        $data = $advancedCollectionCache->getData($handeler);
        $tags = $this->tagCategoryInterpeter->getTags($data['data']['MediaTagCollection']);
        $form = $this->createForm(
            SearchAnimeType::class,
            $search,
            [
                'genres' => $data['data']['GenreCollection'],
                'tags' => $tags,
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rawVars = (array) $form->getData();

            // remove * from key
            foreach ($rawVars as $oldKey => $value) {
                $newkey = str_replace('*', '', $oldKey);
                $rawVars[$newkey] = $value;
                unset($rawVars[$oldKey]);
            }
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            return $this->render(
                'yoloTest/yolo.html.twig',
                [
                    'genres'=> $data['data']['GenreCollection'],
                    'get' => $_GET,
                    'form' => $form->createView()
                ]
            );
        }

        $vars = [];
        foreach ($rawVars as $key => $value) {
            if (!empty($rawVars[$key])) {
                $vars[$key] = $value;
                continue;
            }

            // change value to FuzzyDateInt
            if ($key == 'yearLesser') {
                $vars[$key] = $value * 10000;
            } elseif ($key == 'yearGreater') {
                $vars['yearGreater'] = $value * 10000;
            } elseif ($key == 'year') {
                $vars['yearLesser'] = ($value + 1) * 10000;
                $vars['yearGreater'] = $value * 10000;
            }
        }

        $rawVars = array_merge($vars, $standardVar);
        $queryResult = $handeler->getData($rawVars, $query);
        $animes = $queryResult['data']['Page']['media'];

        return $this->render(
            'yoloTest/yolo.html.twig',
            [
            'seasons' => [
                'label'=> 'Season',
                    'data'=> 'season',
                    'options'=> [
                        ['label'=> 'All', 'data'=> 'RESET'],
                        ['label'=> 'Winter', 'data'=> 'WINTER'],
                        ['label'=> 'Spring', 'data'=> 'SPRING'],
                        ['label'=> 'Summer', 'data'=> 'SUMMER'],
                        ['label'=> 'Fall', 'data'=> 'FALL'],
                    ]
            ],
            'genres'=> $data['data']['GenreCollection'],
            'get' => $_GET,
            'form' => $form->createView(),
            'data' => isset($animes) ? $animes : '',
            ]
        );
    }
}
