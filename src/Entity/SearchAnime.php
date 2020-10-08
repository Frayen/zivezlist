<?php


namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SearchAnime
{
    protected $search;
    protected $season;
    protected $year;
    protected $yearGreater;
    protected $yearLesser;
    protected $sort;
    protected $format;
    protected $status;
    protected $country;
    protected $source;
    protected $genres;
    protected $tag_in;
    protected $hide_list;
    protected $adult;
    protected $genre_in;
    protected $genre_out;

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param mixed $search
     */
    public function setSearch($search): void
    {
        $this->search = $search;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season): void
    {
        $this->season = $season;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getYearGreater()
    {
        return $this->yearGreater;
    }

    /**
     * @param mixed $yearGreater
     */
    public function setYearGreater($yearGreater): void
    {
        $this->yearGreater = $yearGreater;
    }

    /**
     * @return mixed
     */
    public function getYearLesser()
    {
        return $this->yearLesser;
    }

    /**
     * @param mixed $yearLesser
     */
    public function setYearLesser($yearLesser): void
    {
        $this->yearLesser = $yearLesser;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format): void
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source): void
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return mixed
     */
    public function getTagin()
    {
        return $this->tag_in;
    }

    /**
     * @param mixed $tag_in
     */
    public function setTagin($tag_in): void
    {
        $this->tag_in = $tag_in;
    }

    /**
     * @return mixed
     */
    public function getHideList()
    {
        return $this->hide_list;
    }

    /**
     * @param mixed $hide_list
     */
    public function setHideList($hide_list): void
    {
        $this->hide_list = $hide_list;
    }

    /**
     * @return mixed
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param mixed $adult
     */
    public function setAdult($adult): void
    {
        $this->adult = $adult;
    }

    /**
     * @return mixed
     */
    public function getGenreIn()
    {
        return $this->genre_in;
    }

    /**
     * @param mixed $genre_in
     */
    public function setGenreIn($genre_in): void
    {
        $this->genre_in = $genre_in;
    }

    /**
     * @return mixed
     */
    public function getGenreOut()
    {
        return $this->genre_out;
    }

    /**
     * @param mixed $genre_out
     */
    public function setGenreOut($genre_out): void
    {
        $this->genre_out = $genre_out;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('format', new Assert\Choice([
            'choices' => ['POPULARITY'],
            'message' => 'Choose a valid genre.',
        ]));

    }
}