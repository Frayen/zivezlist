/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';
import ReactDOM from "react-dom";
import React from "react";
import Filter from './components/_filter';
import $ from 'jquery';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/app.js');
const dropdown = document.getElementById('dropdown');
if (dropdown) {
    ReactDOM.render(<Filter/>, dropdown);
}
