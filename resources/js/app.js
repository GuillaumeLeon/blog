require('./bootstrap');
require('./bootstrap-tokenfield');
require('./jquery')
import anime from 'animejs/lib/anime.es.js';

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

tinymce.init({
    selector: '#content',
    height : "360",
    width: '640',
});

let input = document.getElementById( 'upload' );
let infoArea = document.getElementById( 'upload-label' );
let delete_image = document.getElementById( 'delete-img' );

if(input !== null) {
    input.addEventListener( 'change', showFileName );
}
function showFileName( event ) {
    let input = event.srcElement;
    let fileName = input.files[0].name;
    infoArea.textContent = 'File name: ' + fileName;
}

if (infoArea && delete_image) {
    delete_image.addEventListener('click', clear)
}

function clear() {
    infoArea.textContent = 'Choose file';

    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'delete_img';
    input.value = '1';

    infoArea.parentElement.parentElement.appendChild(input);
}

let avatar = document.querySelector('.avatar')
let text = document.querySelector('.text');

if (avatar && text) {
    avatar.addEventListener('mouseover', In);
    avatar.addEventListener('mouseout', Out);
    avatar.addEventListener('mouseover', opacity_up);
    avatar.addEventListener('mouseout', opacity_down);

    text.addEventListener('mouseover', In);
    text.addEventListener('mouseover', opacity_up);
    text.addEventListener('mouseout', opacity_down);
}
function In() {
    anime({
        targets: '.text',
        translateY: -75,
        opacity: 1,
        begin: function() {
            document.querySelector('.text').style.display = 'block';
        },
    });
}

function Out() {
    anime({
        targets: '.text',
        translateY: 0,
        opacity: 0,
        begin: function() {
            document.querySelector('.text').style.display = 'none';
        },
    });
}

function opacity_up() {
    anime({
        targets: '.avatar',
        opacity: 0.5,
        duration: 0,

    })
}
function opacity_down() {
    anime({
        targets: '.avatar',
        opacity: 1,
        duration: 0,
    })
}

