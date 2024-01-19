$(document).ready(function () {
    var isPageReloaded = localStorage.getItem("isPageReloaded") === "true" || false;

    // If not reloaded, reload the page and set the flag
    if (!isPageReloaded) {
        location.reload();
        localStorage.setItem("isPageReloaded", true);
    }
});

//Para sa pag next ng slider
const contents = document.querySelectorAll('.slides > div');
const arrows = document.querySelectorAll('.arrow-container div');
const dots = document.querySelectorAll('.indicator-dot');
let currentPage = 0;

function showPage(pageIndex) {
    contents.forEach((content, index) => {
        if (index === pageIndex) {
            content.style.display = 'block';
        } else {
            content.style.display = 'none';
        }
    });

    dots.forEach((dot, index) => {
        if (index === pageIndex) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

function goToNextSlide() {
    currentPage = (currentPage + 1) % contents.length;
    showPage(currentPage);
}

arrows.forEach((arrow) => {
    arrow.addEventListener('click', () => {
        if (arrow.classList.contains('arrow-left')) {
            currentPage = (currentPage - 1 + contents.length) % contents.length;
        } else {
            currentPage = (currentPage + 1) % contents.length;
        }
        showPage(currentPage);
    });
});

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentPage = index;
        showPage(currentPage);
    });
});

// Initial page display
showPage(currentPage);

// Automatically go to the next slide every 4 seconds
setInterval(goToNextSlide, 4000);


//LOGOUT:
function LogoutNow(){
    window.location.href = './back_end/logoutNow.php';
}