var filter = document.getElementById('filter');
var options = document.getElementById('filterOptions');

filter.addEventListener('click', () => {
    options.classList.toggle('flex');
    options.classList.toggle('hidden');
    options.classList.toggle('items-start');
    options.classList.toggle('justify-start');
})