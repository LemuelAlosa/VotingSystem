$(document).ready(function () {
    var isPageReloaded = localStorage.getItem("isPageReloaded") === "true" || false;

    // If not reloaded, reload the page and set the flag
    if (!isPageReloaded) {
        location.reload();
        localStorage.setItem("isPageReloaded", true);
    }
});

function configureToggle(selector, contentSelector, imgSelector) {
  var isRotated = localStorage.getItem(selector) === "false" || true;

  if (isRotated) {
    $(imgSelector).css({
      "transform": "rotate(270deg)",
    });
    $(contentSelector).show();
  }

  $(selector).click(function () {
    $(contentSelector).slideToggle();
    isRotated = !isRotated;
    
    if (isRotated) {
      $(imgSelector).css({
        "transform": "rotate(270deg)",
      });
    } else {
      $(imgSelector).css({
        "transform": "rotate(0deg)",
      });
    }

    localStorage.setItem(selector, isRotated);
  });
}

$(document).ready(function () {
  configureToggle(".section3top", ".section3-3", ".main .section3 .section3top img");
  configureToggle(".section4top", ".section4-4", ".main .section4 .section4top img");
  configureToggle(".section5top", ".section5-5", ".main .section5 .section5top img");
  configureToggle(".section6top", ".section6-6", ".main .section6 .section6top img");
  configureToggle(".section7top", ".section7-7", ".main .section7 .section7top img");
  configureToggle(".section8top", ".section8-8", ".main .section8 .section8top img");
  configureToggle(".section9top", ".section9-9", ".main .section9 .section9top img");
  configureToggle(".section10top", ".section10-10", ".main .section10 .section10top img");
  configureToggle(".section11top", ".section11-11", ".main .section11 .section11top img");
  configureToggle(".section12top", ".section12-12", ".main .section12 .section12top img");
  configureToggle(".section13top", ".section13-13", ".main .section13 .section13top img");
  configureToggle(".section14top", ".section14-14", ".main .section14 .section14top img");
  configureToggle(".section15top", ".section15-15", ".main .section15 .section15top img");
  configureToggle(".section16top", ".section16-16", ".main .section16 .section16top img");
});

$("#candidate-mission").click(function(){
  $(".candidateprofile-background").fadeIn();
  $(".candidateprofile-blackbackground").fadeIn();
});

$(".candidateprofile-background .candidateprofile-footer h4").click(function(){
  $(".candidateprofile-background").fadeOut();
  $(".candidateprofile-blackbackground").fadeOut();
});

$(".candidateprofile-blackbackground").click(function(){
  $(".candidateprofile-background").fadeOut();
  $(".candidateprofile-blackbackground").fadeOut();
});

// Tukuyin ang mga link (anchor tags) patungo sa mga kandidato
const candidateLinks = document.querySelectorAll('a#candidate-mission');

// I-save ang kasalukuyang scroll position sa session storage kapag ang link ay pindutin
candidateLinks.forEach(link => {
  link.addEventListener('click', () => {
    sessionStorage.setItem('scrollPosition', window.scrollY);
  });
});

// I-restore ang scroll position mula sa session storage pagkatapos ng page load
window.addEventListener('load', () => {
  const scrollPosition = sessionStorage.getItem('scrollPosition');
  if (scrollPosition) {
    window.scrollTo(0, parseInt(scrollPosition));
    sessionStorage.removeItem('scrollPosition'); // Alisin ito pagkatapos gamitin
  }
});

function backNow(){
  window.location.href = './index.php';
}

var SUBMITNOW = false;
// (ACTIVATE/DEACTIVATE STUDENT)
$("#FinalVotingForm").submit(function (event) {
  event.preventDefault();
  SUBMITNOW = true;
});

if (SUBMITNOW) {
  SubmitVotesNow();
}

function SubmitVotesNow(){
  $.confirm({
    title: 'Successfully Voted',
    content: 'You May Log-in Again and See The Live Results',
    autoClose: 'cancelAction|3000',
    buttons: {
      cancelAction: {
        text: 'Continue',
        action: function () {
          document.getElementById("FinalVotingForm").submit();
          document.getElementById("FinalVotingForm").reset();
          localStorage.clear();
        },
        btnClass: 'btn-yes',
      },
    },
    titleClass: 'my-title-class',
  });
}