<?php


namespace App\Module\AniList_APIv2\Builder;

class QueryBuilder
{

    private  $query;
    private  $selected_fields = '';
    private  $filter;

    public function __construct($query) {
        $this->query = $query;
    }

    function selectField($select_field) {
        if (is_object($select_field)) {
            $this->selected_fields = $this->selected_fields . ' ' . $select_field->formatQuery();
            return $this;
        }
        $this->selected_fields = $this->selected_fields . ' ' . $select_field;
        return $this;
    }

    function setArgument($arguments = []) {
        foreach($arguments as $argument) {
            $this->filter = $argument[0] . ': ' . $argument[1] . ' ' . $this->filter;
        }
        return $this;
    }

     function formatQuery() {
        $filter = '';
        if (!empty($this->filter)){
            $filter = ' ( ' . $this->filter . ' )';
        }

        return $this->query . $filter . ' { ' . $this->selected_fields . ' }';
    }
}