/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require('../css/modules/themify/_themify.scss');

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';
import ReactDOM from "react-dom";
import React from "react";
import DropdownFilter from './components/_DropdownFilter';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/app.js');

const searchBoxes = [
    {id: 1, name: 'Title', value: 'TITLE_ROMAJI'},
    {id: 2, name: 'Popularity', value: 'POPULARITY'},
    {id: 3, name: 'Score', value: 'SCORE'},
    {id: 4, name: 'Trending', value: 'TRENDING'},
    {id: 5, name: 'Favourites', value: 'FAVOURITES'},
    {id: 6, name: 'Date added', value: 'ID_DESC'},
    {id: 7, name: 'Release date', value: 'START_DATE_DESC'},
];

function Filter() {

    return(
        <div className="container">
            <DropdownFilter title="sort" options={searchBoxes} customOn={function hi(){console.log("asfd")}} />
        </div>
    );
}

export default Filter;
if (document.getElementById("filter")) {
    ReactDOM.render(<Filter/>, document.getElementById("filter"));
}
