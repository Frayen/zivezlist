import React, {Component} from "react";
import { DropdownComponent } from './_dropdown';

const sort = [
    {id: 1, name: 'Title', value: 'TITLE_ROMAJI'},
    {id: 2, name: 'Popularity', value: 'POPULARITY'},
    {id: 3, name: 'Score', value: 'SCORE'},
    {id: 4, name: 'Trending', value: 'TRENDING'},
    {id: 5, name: 'Favourites', value: 'FAVOURITES'},
    {id: 6, name: 'Date added', value: 'ID_DESC'},
    {id: 7, name: 'Release date', value: 'START_DATE_DESC'},
];

class Filter extends Component{
    render() {
        return (
            <div className="container">
                <DropdownComponent title="sort" options={sort} onChange={function hi() {
                    console.log("asfd")
                }}/>
                <DropdownComponent title="sort" options={sort}/>
            </div>
        );
    }
}
export default Filter;
