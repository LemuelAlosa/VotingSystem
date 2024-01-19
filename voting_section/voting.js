$(document).ready(function () {
    var isPageReloaded = localStorage.getItem("isPageReloaded") === "true" || false;

    // If not reloaded, reload the page and set the flag
    if (!isPageReloaded) {
        location.reload();
        localStorage.setItem("isPageReloaded", true);
    }
});

$(document).ready(function () {
  var isRotated = false;

  $(".section2top").click(function () {
    $(".section2-2").slideToggle();

    isRotated = !isRotated;

    if (isRotated) {
      $(".main .section2 .section2top img").css({
        "transform": "rotate(0deg)",
      });
    } else {
      $(".main .section2 .section2top img").css({
        "transform": "rotate(270deg)",
      });
    }
  });
});

function configureToggle(selector, contentSelector, imgSelector) {
  var isRotated = localStorage.getItem(selector) === "true" || false;

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

$(document).ready(function () {
  var selection1 = localStorage.getItem("selection1");
  var selection2 = localStorage.getItem("selection2");
  var selection3 = localStorage.getItem("selection3");
  var selection4 = localStorage.getItem("selection4");
  var selection5 = localStorage.getItem("selection5");
  var selection6 = localStorage.getItem("selection6");
  var selection7 = localStorage.getItem("selection7");
  var selection8 = localStorage.getItem("selection8");
  var selection9 = localStorage.getItem("selection9");
  var selection10 = localStorage.getItem("selection10");
  var selection11 = localStorage.getItem("selection11");
  var selection12 = localStorage.getItem("selection12");
  var selection13 = localStorage.getItem("selection13");
  var selection14 = localStorage.getItem("selection14");
  var selection15 = localStorage.getItem("selection15");

  if (selection1) {
    document.querySelector('input[name="choices1"][value="' + selection1 + '"]').checked = true;
  }
  if (selection2) {
      document.querySelector('input[name="choices2"][value="' + selection2 + '"]').checked = true;
  }
  if (selection3) {
      document.querySelector('input[name="choices3"][value="' + selection3 + '"]').checked = true;
  }
  if (selection4) {
      document.querySelector('input[name="choices4"][value="' + selection4 + '"]').checked = true;
  }
  if (selection5) {
      document.querySelector('input[name="choices5"][value="' + selection5 + '"]').checked = true;
  }
  if (selection6) {
      document.querySelector('input[name="choices6"][value="' + selection6 + '"]').checked = true;
  }
  if (selection7) {
      document.querySelector('input[name="choices7"][value="' + selection7 + '"]').checked = true;
  }
  if (selection8) {
      document.querySelector('input[name="choices8"][value="' + selection8 + '"]').checked = true;
  }
  if (selection9) {
      document.querySelector('input[name="choices9"][value="' + selection9 + '"]').checked = true;
  }
  if (selection10) {
      document.querySelector('input[name="choices10"][value="' + selection10 + '"]').checked = true;
  }
  if (selection11) {
      document.querySelector('input[name="choices11"][value="' + selection11 + '"]').checked = true;
  }
  if (selection12) {
      document.querySelector('input[name="choices12"][value="' + selection12 + '"]').checked = true;
  }
  if (selection13) {
      document.querySelector('input[name="choices13"][value="' + selection13 + '"]').checked = true;
  }
  if (selection14) {
      document.querySelector('input[name="choices14"][value="' + selection14 + '"]').checked = true;
  }
  if (selection15) {
      document.querySelector('input[name="choices15"][value="' + selection15 + '"]').checked = true;
  }

  document.getElementById("VotingForm").addEventListener("change", function () {
    var selected1 = document.querySelector('input[name="choices1"]:checked');
    if (selected1) {
      localStorage.setItem("selection1", selected1.value);
    }
    var selected2 = document.querySelector('input[name="choices2"]:checked');
    if (selected2) {
        localStorage.setItem("selection2", selected2.value);
    }
    var selected3 = document.querySelector('input[name="choices3"]:checked');
    if (selected3) {
        localStorage.setItem("selection3", selected3.value);
    }
    var selected4 = document.querySelector('input[name="choices4"]:checked');
    if (selected4) {
        localStorage.setItem("selection4", selected4.value);
    }
    var selected5 = document.querySelector('input[name="choices5"]:checked');
    if (selected5) {
        localStorage.setItem("selection5", selected5.value);
    }
    var selected6 = document.querySelector('input[name="choices6"]:checked');
    if (selected6) {
        localStorage.setItem("selection6", selected6.value);
    }
    var selected7 = document.querySelector('input[name="choices7"]:checked');
    if (selected7) {
        localStorage.setItem("selection7", selected7.value);
    }
    var selected8 = document.querySelector('input[name="choices8"]:checked');
    if (selected8) {
        localStorage.setItem("selection8", selected8.value);
    }
    var selected9 = document.querySelector('input[name="choices9"]:checked');
    if (selected9) {
        localStorage.setItem("selection9", selected9.value);
    }
    var selected10 = document.querySelector('input[name="choices10"]:checked');
    if (selected10) {
        localStorage.setItem("selection10", selected10.value);
    }
    var selected11 = document.querySelector('input[name="choices11"]:checked');
    if (selected11) {
        localStorage.setItem("selection11", selected11.value);
    }
    var selected12 = document.querySelector('input[name="choices12"]:checked');
    if (selected12) {
        localStorage.setItem("selection12", selected12.value);
    }
    var selected13 = document.querySelector('input[name="choices13"]:checked');
    if (selected13) {
        localStorage.setItem("selection13", selected13.value);
    }
    var selected14 = document.querySelector('input[name="choices14"]:checked');
    if (selected14) {
        localStorage.setItem("selection14", selected14.value);
    }
    var selected15 = document.querySelector('input[name="choices15"]:checked');
    if (selected15) {
        localStorage.setItem("selection15", selected15.value);
    }  
  });
});

function clearSelection1() {
  document.querySelectorAll('input[name="choices1"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection1");
}

function clearSelection2() {
  document.querySelectorAll('input[name="choices2"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection2");
}

function clearSelection3() {
  document.querySelectorAll('input[name="choices3"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection3");
}

function clearSelection4() {
  document.querySelectorAll('input[name="choices4"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection4");
}

function clearSelection5() {
  document.querySelectorAll('input[name="choices5"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection5");
}

function clearSelection6() {
  document.querySelectorAll('input[name="choices6"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection6");
}

function clearSelection7() {
  document.querySelectorAll('input[name="choices7"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection7");
}

function clearSelection8() {
  document.querySelectorAll('input[name="choices8"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection8");
}

function clearSelection9() {
  document.querySelectorAll('input[name="choices9"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection9");
}

function clearSelection10() {
  document.querySelectorAll('input[name="choices10"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection10");
}

function clearSelection11() {
  document.querySelectorAll('input[name="choices11"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection11");
}

function clearSelection12() {
  document.querySelectorAll('input[name="choices12"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection12");
}

function clearSelection13() {
  document.querySelectorAll('input[name="choices13"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection13");
}

function clearSelection14() {
  document.querySelectorAll('input[name="choices14"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection14");
}

function clearSelection15() {
  document.querySelectorAll('input[name="choices15"]').forEach(function (radio) {
      radio.checked = false;
  });
  localStorage.removeItem("selection15");
}


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

