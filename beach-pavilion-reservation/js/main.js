$(function () {
    $(".nav-load").load("./nav2.html");
    // $(".nav-load").load("./nav.html");
    // $(".footer-load").load("./footer.html");
    $(".footer-load").load("./slim-footer.html");
    $(".banner1-load").load("./banner.html .banner-1");
    $(".banner2-load").load("./banner.html .banner-2");
    $(".banner3-load").load("./banner.html .banner-3");
    $(".banner-ag-sp").load("./banner.html .ag-sc");
    $(".rss-feed-variety").load("./variety-rss.php");
    $(".rss-feed-tribune").load("./tribune-rss.php");
    $(".fieldGuides").load("./dfw-field-guides.php");
});

$('#agreement').change(function () {
    if($(this).prop('checked')) {
        $('#reserveFacility').removeAttr('disabled', true);
        $('#reserveFacility').toggleClass('text-white bg-dfw-blue-main border-dfw-blue-main hover:bg-white hover:border-dfw-blue-main hover:border-2 hover:text-dfw-blue-main');
        $('#reserveFacility').removeClass('text-gray-500 bg-gray-100 border-gray-100');
    } else {
        $('#reserveFacility').attr('disabled', true);
        $('#reserveFacility').removeClass('text-white bg-dfw-blue-main border-dfw-blue-main hover:bg-white hover:border-dfw-blue-main hover:border-2 hover:text-dfw-blue-main');
        $('#reserveFacility').toggleClass('text-gray-500 bg-gray-100 border-gray-100');
    }
});

$('#reserveFacility').attr('disabled', true);
$('#reserveFacility').addClass('px-4 py-2 border-2 rounded-md font-medium text-gray-500 bg-gray-100 border-gray-100 duration-200');

var scrollToTopBtn = document.querySelector(".scrollToTopBtn");
var rootElement = document.documentElement;

function handleScroll() {
    // Do something on scroll
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if (rootElement.scrollTop / scrollTotal > 0.8) {
        // Show button
        scrollToTopBtn.classList.add("showBtn");
    } else {
        // Hide button
        scrollToTopBtn.classList.remove("showBtn");
    }
}

function scrollToTop() {
    // Scroll to top logic
    rootElement.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}
scrollToTopBtn.addEventListener("click", scrollToTop);
document.addEventListener("scroll", handleScroll);

function searchDocLibrary() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    var search = document.getElementsByClassName("target");
    var btnsel = document.getElementsByClassName("selected");
    var btnall = document.querySelector('.btn-all');


    for (var i = 0; i < search.length; i++) {
        if (search[i].innerText.toUpperCase().includes(filter)) {
            search[i].style.display = "block";
        } else {
            search[i].style.display = "none";
        }
    }

    btnsel[0].className = btnsel[0].className.replace(" selected", "");
    btnall.className += " selected";



}

function filterSelection(c) {

    var x = document.getElementsByClassName("target");
    const searchBox = document.getElementById("searchInput");

    if (c == "all") c = "";

    for (var i = 0; i < x.length; i++) {

        x[i].style.display = "none";
        searchBox.value = '';

        if (x[i].className.indexOf(c) > -1) {
            x[i].style.display = "block";

            searchBox.value = '';
        }
    }
}

//  Add active class to the current button (highlight it)
var btnContainer = document.getElementById("filterBtnGroup");
var btns = btnContainer.getElementsByClassName("btn");

for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("selected");
        current[0].className = current[0].className.replace(" selected", "");
        this.className += " selected";
    });
}