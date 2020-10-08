let noUiSlider = require('nouislider');
const $ = require('jquery');
let { setGet, deleteGet } = require('./urlGetMethod');

/*
 * D E F A U L T
 *
 */

/*
 * R A N G S L I D E R
 */

const date = new Date();
let startValues = [1950, date.getFullYear()];
let afterInitValues;
const $year = $('#search_anime_year');
const $yearLesser = $('#search_anime_year_lesser');
const $yearGreater = $('#search_anime_year_greater');

// set get default value if both get variable are filled in
if ($yearGreater.val()  !== '' || $yearLesser.val() !== '') {
    afterInitValues = [$yearGreater.val(), $yearLesser.val()];
    deleteGet(['year']);
    editYearIndicator($yearGreater.val() + ' - ' + $yearLesser.val());
} else if ($year.val() !== '') {
    startValues = [1950];
    afterInitValues = [$year.val()];
    deleteGet(['yearGreater', 'yearLesser']);
    editYearIndicator($year.val());
} else {
    deleteGet(['year', 'yearGreater', 'yearLesser']);
}

const slider = document.getElementById('slider-input');

// init slider
noUiSlider.create(slider, initSliderVal(startValues));
slider.noUiSlider.on('slide', function (values) {
    noUisliderOnSlide(values);
});
slider.noUiSlider.on('change', function (values) {
    noUisliderOnChange(values)
});

if (afterInitValues !== '') {
    slider.noUiSlider.set(afterInitValues);
}


$('.rangeslider .switch').click(function () {
    // set starting value based on amount of range buttons
    let startValue = typeof slider.noUiSlider.get() === 'object' ? [1950] : startValues;

    // reset year inputs / get methods
    slider.noUiSlider.destroy();
    deleteGet(['year', 'yearGreater', 'yearLesser']);
    resetYearAll();

    // make new slider
    noUiSlider.create(slider,initSliderVal(startValue))
        .on('slide', noUisliderOnSlide)
        .on('change', noUisliderOnChange);
});

$('.rangeslider .reset').click(function (event) {
    // reset slider
    slider.noUiSlider.reset();
    // reset year input fields
    resetYearAll();
    // delete every get element
    deleteGet(['year', 'yearGreater', 'yearLesser']);

});

/*
 * D R O P D O W N
 */
// Show reset on dropdown
$('.dropdown >').hover(function (event) {
    const target = $(event.target);

    if (target.parents('.dropdown').children('.input').val() !== ''
    ) {
        target.parents('.dropdown').children('.reset').css('display', 'block');
    }

    }, function () {
        $('.dropdown > .reset').css('display', 'none');

}).click(function (event) {
    const target = $(event.target);
    const parentsDropdown = target.parents('.dropdown');

    if (target.is('.option, .option span')) {
        const targetInputName = target.parents('.options').attr('data-input-name');
        const targetInputVal = target.is('.option') ? target.attr('data-input-option') : target.parent('.option').attr('data-input-option');
        let newArr = [];

        newArr = [[targetInputName, targetInputVal]];

        setGet(newArr);
        parentsDropdown.children('.input').val(targetInputVal);
        resetDropdown();
        return;
    }

    if (target.is('.reset, .reset span')) {
        parentsDropdown.children('.input').val('');
        console.log(target.parents('.dropdown').find('.options').attr('data-intput-name'),'asfdsdff');
        deleteGet([target.find('.options').attr('data-intput-name')]);
        resetDropdown();
        return;
    }

    if (parentsDropdown.children('.list').css('display') === 'none') {
        resetDropdown();
        parentsDropdown.children('.switch').addClass('rotate');
        parentsDropdown.children('.list').slideDown('fast');
        return
    }

    resetDropdown();
});


/*
 * F U N C T I O N S
 */
function resetDropdown() {
    const dropdown = $('.dropdown');

    dropdown.find('.reset').css('display', 'none');
    dropdown.find('.list').slideUp('fast');
    dropdown.children('.switch').removeClass('rotate');
}

function rangeslider() {
    slider.noUiSlider.on('slide',  function() {
        let sliderValues = slider.noUiSlider.get();
        let response;

        // set response based on array lenght
        if (Array.isArray(slider.noUiSlider.get())){
            response = Math.round(sliderValues[0]) + ' - ' + Math.round(sliderValues[1]);

            // switch positions if values are different
            if (sliderValues[0] > sliderValues[1]) {
                response = Math.round(sliderValues[1]) + ' - ' + Math.round(sliderValues[0]);
            }
        } else {
            response = Math.round(sliderValues);
        }

        $('#year span').text(response);

        if ($('.indicator').css('display') === 'none') {
            $('.rangeslider .reset').css('display', 'inline-block');
            $('.indicator').css('display', 'block');
        }
    });

    slider.noUiSlider.on('change', function (value) {
        const url = new URL(window.location.href);
        const search_param = new URLSearchParams(url.search);

        let obj;

        // differenciate the result of change
        if (!Array.isArray(slider.noUiSlider.get())) {
            let sliderValues = Math.round(slider.noUiSlider.get());

            // delete search params
            search_param.delete('yearLesser');
            search_param.delete('yearGreater');

            obj = { 'year': (sliderValues < 1950)?  sliderValues : 1950 };

            $('#search_anime_year').val(sliderValues);

        }  else {
            let sliderValues = [
                Math.round(slider.noUiSlider.get()[0]),
                Math.round(slider.noUiSlider.get()[1]),
            ];

            // delete search params
            search_param.delete('year');

            obj = {
                'yearGreater': (sliderValues[0] > sliderValues[1]) ? sliderValues[1]: sliderValues[0],
                'yearLesser': (sliderValues[0] > sliderValues[1]) ? sliderValues[0]: sliderValues[1]
            };

            // set input values
            $yearGreater.val(obj.yearGreater);
            $('#search_anime_year_lesser').val(obj.yearLesser);
        }

        $.each(obj, function (index, val){
            search_param.set(index, val);
        });

        url.search = search_param.toString();
        history.pushState(null, null, url.search);
    });
}

function resetYearAll() {
    $('#year span').text('');
    $('.indicator').css('display', 'none');
    $year.val('');
    $yearGreater.val('');
    $yearLesser.val('');
}

function editYearIndicator(value) {
    $('#year span').text(value);
    $('.indicator').css('display', 'block');
    $('.rangeslider .reset').css('display', 'inline-block');
}
function noUisliderOnSlide(values) {
    let response;

    // set response based on array lenght
    if (Object.keys(values).length !== 1){
        response = values[0] + ' - ' + Math.round(values[1]);

        // switch positions if values are different
        if (values[0] > values[1]) {
            response = Math.round(values[1]) + ' - ' + Math.round(values[0]);
        }
    } else {
        response = Math.round(values);
    }

    $('#year span').text(response);

    showYear();
}

function noUisliderOnChange(values) {
    let obj;

    // differenciate the result of change
    if (Object.keys(values).length === 1){

        // delete search params
        deleteGet('yearLesser');
        deleteGet('yearGreater');

        obj = { 'year': (values < 1950)? values : 1950 };

        $('#search_anime_year').val(values);

    }  else {

        // delete search params
        deleteGet('year');

        obj = {
            'yearGreater': (values[0] > values[1]) ? values[1]: values[0],
            'yearLesser': (values[0] > values[1]) ? values[0]: values[1]
        };

        // set input values
        $yearGreater.val(obj.yearGreater);
        $yearLesser.val(obj.yearLesser);
    }

    $.each(obj, function (index, val){
        setGet(index);
    });

    url.search = search_param.toString();
    history.pushState(null, null, url.search);
}

function initSliderVal(values) {
    return {
        margin: null,
        behaviour: "unconstrained-tap",
        step: 1,
        start: values,
        range: {
            'min': 1950,
            'max': date.getFullYear(),
        },
        connect: (values.length === 1) ? 'lower' : [false, true, false],
        format: {
            to: function (value) {
                return value.toFixed(0);
            },
            from: function (value) {
                return value;
            }
        }
    }
}

function showYear() {
    if ($('.indicator').css('display') === 'none') {
        $('.rangeslider .reset').css('display', 'inline-block');
        $('.indicator').css('display', 'block');
    }
}