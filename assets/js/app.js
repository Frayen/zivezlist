/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)


require('../css/modules/themify/_themify.scss');
require('nouislider/distribute/nouislider.css');
require('webpack-jquery-ui/css');
require('webpack-jquery-ui/interactions');
require('webpack-jquery-ui/widgets');
require('webpack-jquery-ui/effects');

require('../css/app.scss');

import React from 'react';
import ReactDOM from "react-dom";
import DropdownFilter from './components/_DropdownFilter';

//
//
// let noUiSlider = require('nouislider');
//
// // Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
// /*
//  * This function does the following
//  * + adds a slider
//  * + changes the values if url has values that the slider expects
//  * + changes the values on load
//  * + reloaces you when you change the slider
//  */
// $( function() {
//
//     $('#search_anime_search').on('input change',function () {
//         if ($('#search_anime_search').val() === ''){
//             setMethodGET({'search': $('#search_anime_search').val()});
//             if ($('.rangeslider > .indicator').css('display') === 'none'){
//                 $('.rangeslider > .indicator').css('display', 'block')
//             }
//             return;
//         }
//         if ($('.rangeslider > .indicator').css('display') !== 'block'){
//             $('.rangeslider > .indicator').css('display', 'none');
//         }
//         deleteMethodGET(['search']);
//     });
//
//     $('#search_anime_adult').on('change', function () {
//         if ($('#search_anime_adult').is(':checked')) {
//             setMethodGET({'isAdult': true});
//         } else {
//             deleteMethodGET(['isAdult'])
//         }
//     });
//
//     /*
//      *  update checkbox
//      */
//     $('#search_anime_hide_list').on('change', function () {
//         if ($('#search_anime_hide_list').is(':checked')) {
//             setMethodGET({'hideList': true});
//         } else {
//             deleteMethodGET(['hideList'])
//         }
//     });
//
//     $(document).click(function (event) {
//         const target = $(event.target);
//         const target_dropDown = target.parents('.dropdown');
//         const target_dropDown_list = $('.dropdown .list');
//         const dropDown_switch = $('.dropdown > .switch');
//
//
//         /*
//          * reset year slider and text if clicked on reset
//          */
//         if (target.is('#year-reset, #year-reset span')){
//             if (slider.noUiSlider.get().length === 2){
//                 slider.noUiSlider.set([1950, nextYear])
//             } else {
//                 slider.noUiSlider.set([1950])
//             }
//             $('#year').text('');
//             deleteMethodGET(['year', 'yearGreater', 'yearLesser'])
//         }
//
//         if (target.is('#search_reset, #search_reset span')) {
//             if (target.parents('#search_reset').is('#search_reset')) {
//                 target.parents('#search_reset').css('display', 'none');
//             } else {
//                 target.css('display', 'none');
//             }
//             $('#search_anime_search').val('');
//             deleteMethodGET(['search']);
//
//         }
//     });
//
//     // set get variable and relocate
//     function setMethodGET(obj) {
//         const url = new URL(window.location.href);
//         const search_param = new URLSearchParams(url.search);
//         $.each(obj, function (index, val){
//             search_param.set(index, val);
//         });
//         url.search = search_param.toString();
//         history.pushState(null, null, url.search);
//     }
//
//     $('label, .filter-button, .filter-reset span, .filter-dropDown-name .filter-input, .filter-dropDown-switch span').disableSelection();
//
//     // delete get variable and relocate
//     function deleteMethodGET(indexGET) {
//         const url = new URL(window.location.href);
//         const search_param = new URLSearchParams(url.search.slice(1));
//         $.each(indexGET, function (index, val){
//             search_param.delete(val);
//         });
//         url.search = search_param.toString();
//         history.pushState(null, null, url);
//     }
//
// } );

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
        {/*<Dropdown1 title="sort" options={searchBoxes} onChange={this.handleChange}/>*/}
        <DropdownFilter title="sort" options={searchBoxes} customOn={function hi(){console.log("asfd")}} />
        </div>
    );
}

export default Filter;
if (document.getElementById("filter")) {
    ReactDOM.render(<Filter/>, document.getElementById("filter"));
}
