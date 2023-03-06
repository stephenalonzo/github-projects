var btn = document.getElementById('menu-toggle');
var nav = document.getElementById('navLinks');
var icon = document.getElementById('openClose');
var bod = document.getElementById('fg-body');
var mod = document.getElementsByClassName('dfw-modal');

btn.addEventListener('click', () => {
    icon.classList.toggle('block');
    icon.classList.toggle('fa-times');
    nav.classList.toggle('block');
    nav.classList.toggle('hidden');
})

var filter = document.getElementById('filter');
var options = document.getElementById('filterOptions');

filter.addEventListener('click', () => {
    options.classList.toggle('flex');
    options.classList.toggle('hidden');
    options.classList.toggle('items-start');
    options.classList.toggle('justify-start');
})