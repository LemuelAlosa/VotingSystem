// Function to show the alert only once
function showOneTimeAlert() {
    if (!localStorage.getItem('alertShown')) {
        // Show the confirmation dialog
        $.confirm({
            title: 'Welcome Superadmin',
            content: 'I hope you are having a fantastic day! <br>Thank you for your hard work and dedication.',
            autoClose: 'cancelAction|3000',
            buttons: {
                cancelAction: {
                    text: 'Continue',
                    action: function () {
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });

        // Set the flag in localStorage to indicate that the alert has been shown
        localStorage.setItem('alertShown', true);
    }
}

// Call the function when the page loads
window.onload = showOneTimeAlert;

// FUnction para sa Logout
function logout() {
    localStorage.removeItem('alertShown');
    localStorage.clear();
    window.location.href = './back_end/superadmin_logout.php';
}

$(document).ready(function () {
    configureToggle("#elecdetails", ".main nav .electiondetailsnav", "#electiondetailsnavigation");

    function configureToggle(selector, contentSelector, buttonSelector) {
        var rotationAngle = localStorage.getItem(selector + 'Rotation') || 0;
        rotationAngle = parseInt(rotationAngle, 10);
        var isVisible = localStorage.getItem(selector + 'Visible') === 'true' || false;

        $(selector).css("transform", "rotate(" + rotationAngle + "deg)");
        if (isVisible) {
            $(contentSelector).show();
        }

        $(buttonSelector).click(function () {
            $(contentSelector).slideToggle(function () {
                isVisible = $(this).is(":visible");
                localStorage.setItem(selector + 'Visible', isVisible);
            });

            rotationAngle += 270;
            if (rotationAngle >= 360) {
                rotationAngle = 0;
            }

            $(selector).css("transform", "rotate(" + rotationAngle + "deg)");
            localStorage.setItem(selector + 'Rotation', rotationAngle);
        });
    }
});

$(document).ready(function () {
    configureToggle("#admin", ".main nav .adminnav", ".main nav .superadminnav", ".main nav #line", "#adminnav");

    function configureToggle(selector, contentSelector1, contentSelector2, contentSelector3, buttonSelector) {
        var rotationAngle = localStorage.getItem(selector + 'Rotation') || 0;
        rotationAngle = parseInt(rotationAngle, 10);
        var isVisible1 = localStorage.getItem(selector + 'Visible1') === 'true' || false;
        var isVisible2 = localStorage.getItem(selector + 'Visible2') === 'true' || false;
        var isVisible3 = localStorage.getItem(selector + 'Visible3') === 'true' || false;


        $(selector).css("transform", "rotate(" + rotationAngle + "deg)");

        if (isVisible1) {
            $(contentSelector1).show();
        }

        if (isVisible2) {
            $(contentSelector2).show();
        }

        if (isVisible3) {
            $(contentSelector3).show();
        }

        $(buttonSelector).click(function () {
            $(contentSelector1).slideToggle(function () {
                isVisible1 = $(this).is(":visible");
                localStorage.setItem(selector + 'Visible1', isVisible1);
            });

            $(contentSelector2).slideToggle(function () {
                isVisible2 = $(this).is(":visible");
                localStorage.setItem(selector + 'Visible2', isVisible2);
            });

            $(contentSelector3).slideToggle(function () {
                isVisible3 = $(this).is(":visible");
                localStorage.setItem(selector + 'Visible3', isVisible3);
            });

            rotationAngle += 270;
            if (rotationAngle >= 360) {
                rotationAngle = 0;
            }

            $(selector).css("transform", "rotate(" + rotationAngle + "deg)");
            localStorage.setItem(selector + 'Rotation', rotationAngle);
        });
    }
});



$(document).ready(function () {
    // Check if there is a saved state in local storage
    const savedState = localStorage.getItem("navState");

    // Restore the state if it exists
    if (savedState === "nav1") {
        $(".edit_candidate").css("display", "none");
    } else if (savedState === "nav2") {
        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main nav .nav2 .nav2-right img").css("transform", "rotate(270deg)");
        $(".main nav .nav2 .nav2-right img").css("height", "30px");
        $(".main nav .nav2 .nav2-right img").css("width", "20px");
        $(".main nav .nav2 .nav2-left").css("margin-right", "103px");
        $(".main nav .nav2 .nav2-left").css("margin-top", "3px");
        $(".main nav .nav2 .nav2-right").css("margin-right", "0px");

        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "block");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "none");
        document.getElementById("voter_id").value = null;
        document.getElementById("student_id").value = null;
    } else if (savedState == "nav3") {
        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main section .section2").css("display", "none");
        $(".main section .section3").css("display", "none");
        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "block");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "none");
    } else if (savedState == "nav4") {
        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main section .section2").css("display", "none");
        $(".main section .section3").css("display", "none");
        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "block");
        $(".main section .section8").css("display", "none");

        $(".edit_student").css("display", "none");

        // Initial load to show all candidates
        filterCandidates();
    } else if (savedState == "nav5") {
        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main section .section2").css("display", "none");
        $(".main section .section3").css("display", "none");
        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "block");
    }

    $("#nav1").click(function () {
        window.location.href = './index.php';
        // Save the state to local storage
        localStorage.setItem("navState", "nav1");

        $(".main nav .nav2").css("margin-top", "15px");
        $(".main nav .nav2 .nav2-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav2 .nav2-right img").css("height", "23px");
        $(".main nav .nav2 .nav2-right img").css("width", "13px");
        $(".main nav .nav2 .nav2-left img").css("margin-right", "10px");
        $(".main nav .nav2 .nav2-left").css("margin-right", "108px");
        $(".main nav .nav2 .nav2-left").css("margin-top", "5px");
        $(".main nav .nav2 .nav2-right").css("margin-right", "5px");

        $(".main nav .nav1").css("margin-top", "20px");
        $(".main nav .nav1 .nav1-left img").css("margin-right", "10px");
        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(270deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "30px");
        $(".main nav .nav1 .nav1-right img").css("width", "20px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "3px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "0px");

        $(".main section .section4").css("display", "block");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "none");
        document.getElementById("voter_id").value = null;
        document.getElementById("student_id").value = null;

        $(".edit_candidate").css("display", "none");
    });

    $("#nav2").click(function () {

        // Save the state to local storage
        localStorage.setItem("navState", "nav2");

        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main nav .nav2 .nav2-right img").css("transform", "rotate(270deg)");
        $(".main nav .nav2 .nav2-right img").css("height", "30px");
        $(".main nav .nav2 .nav2-right img").css("width", "20px");
        $(".main nav .nav2 .nav2-left").css("margin-right", "103px");
        $(".main nav .nav2 .nav2-left").css("margin-top", "3px");
        $(".main nav .nav2 .nav2-right").css("margin-right", "0px");

        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "block");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "none");
        document.getElementById("voter_id").value = null;
        document.getElementById("student_id").value = null;
        location.reload();
    });

    $("#nav3").click(function () {

        // Save the state to local storage
        localStorage.setItem("navState", "nav3");

        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main section .section2").css("display", "none");
        $(".main section .section3").css("display", "none");
        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "block");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "none");

    });

    $("#nav4").click(function () {

        // Save the state to local storage
        localStorage.setItem("navState", "nav4");

        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main section .section2").css("display", "none");
        $(".main section .section3").css("display", "none");
        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "block");
        $(".main section .section8").css("display", "none");

        $(".edit_student").css("display", "none");

        // Initial load to show all candidates
        filterCandidates();
    });

    $("#nav5").click(function () {

        // Save the state to local storage
        localStorage.setItem("navState", "nav5");

        $(".main nav .nav1 .nav1-right img").css("transform", "rotate(360deg)");
        $(".main nav .nav1 .nav1-right img").css("height", "23px");
        $(".main nav .nav1 .nav1-right img").css("width", "13px");
        $(".main nav .nav1 .nav1-left").css("margin-right", "98px");
        $(".main nav .nav1 .nav1-left").css("margin-top", "5px");
        $(".main nav .nav1 .nav1-right").css("margin-right", "5px");

        $(".main section .section2").css("display", "none");
        $(".main section .section3").css("display", "none");
        $(".main section .section4").css("display", "none");
        $(".main section .section5").css("display", "none");
        $(".main section .section6").css("display", "none");
        $(".main section .section7").css("display", "none");
        $(".main section .section8").css("display", "block");
    });
});




$(document).ready(function () {
    $(".main nav .electiondetailsnav .newelectionevent").click(function () {
        $(".NewElection-blackbackground").fadeIn();
        $(".NewElection-background").fadeIn();

        $(".NewElection-background .NewElection-footer h4").click(function () {
            $(".NewElection-blackbackground").fadeOut();
            $(".NewElection-background").fadeOut();
            document.getElementById("myForm1").reset();
        });

        $(".NewElection-blackbackground").click(function () {
            $(".NewElection-blackbackground").fadeOut();
            $(".NewElection-background").fadeOut();
            document.getElementById("myForm1").reset();
        });
    });
});

// para i download ung excel template
function downloadFile(URL, filename) {
    let link = document.createElement("a");

    link.setAttribute("download", filename);
    link.href = URL;

    document.body.appendChild(link);
    link.click();
    link.remove();
}

// para magupload ng excel file:
function uploadExcelFile() {
    const fileInput = document.createElement("input");
    fileInput.type = "file";
    fileInput.accept = ".xls, .xlsx";
    fileInput.addEventListener("change", uploadFile);
    fileInput.click();
}

function uploadFile(event) {
    const file = event.target.files[0];

    if (!file || (file.type !== "application/vnd.ms-excel" && file.type !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")) {
        $.confirm({
            title: 'Wrong File Format',
            content: 'Please select an Excel file (XLS or XLSX) to upload.',
            autoClose: 'cancelAction|3000',
            buttons: {
                cancelAction: {
                    text: 'Continue',
                    action: function () {
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
        return;
    }

    const formData = new FormData();
    formData.append("import_file", file);

    $.confirm({
        title: 'Add New Students?',
        content: 'Are you sure you want to add this new students?',
        autoClose: 'cancelAction|8000',
        buttons: {
            deleteUser: {
                text: 'Yes',
                action: function () {

                    // Send the file to the PHP script using XMLHttpRequest
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "./back_end/analyze_excel.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById("result").innerHTML = xhr.responseText;
                            location.reload();
                        }
                    };
                    xhr.send(formData);
                },
                btnClass: 'btn-yes',
            },
            cancelAction: {
                text: 'Cancel',
                action: function () {
                },
                btnClass: 'btn-cancel',
            },
        },
        titleClass: 'my-title-class',
    });
}

function searchStudent() {
    const selectedStudent = document.getElementById("student_id").value;
    const studentTableBody = document.getElementById("studentTableBody");

    //PAG INALIS MO ITO MAKIKITA MO UNG BUGS KAPAG NASA PAGE 2 ka ng Voters_list 
    // is magiging dalawa pagination kaya ko dinagdag ito
    $(".pagination").css('display', 'none');

    // AJAX request to fetch filtered candidates from the server
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                studentTableBody.innerHTML = xhr.responseText;
            } else {
                studentTableBody.innerHTML = "<tr><td colspan='8' style='padding: 10%'>Error fetching data.</td></tr>";
            }
        }
    };

    // Replace 'filter_candidates.php' with the actual PHP script that handles the filtering
    xhr.open("GET", "./back_end/voters_list.php?student_id=" + encodeURIComponent(selectedStudent), true);
    xhr.send();
}

function searchStudentVoted() {
    const selectedStudent = document.getElementById("voter_id").value;
    const studentVotedTableBody = document.getElementById("studentVotedTableBody");

    //PAG INALIS MO ITO MAKIKITA MO UNG BUGS KAPAG NASA PAGE 2 ka ng Voters_list 
    // is magiging dalawa pagination1 kaya ko dinagdag ito
    $(".pagination1").css('display', 'none');

    // AJAX request to fetch filtered candidates from the server
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                studentVotedTableBody.innerHTML = xhr.responseText;
            } else {
                studentVotedTableBody.innerHTML = "<tr><td colspan='8' style='padding: 10%'>Error fetching data.</td></tr>";
            }
        }
    };

    // Replace 'filter_candidates.php' with the actual PHP script that handles the filtering
    xhr.open("GET", "./back_end/voted_list.php?student_id=" + encodeURIComponent(selectedStudent), true);
    xhr.send();
}

//Ito JS na ito is para namn sa pagRemove
// Question before magremove
function confirmActionremovestudent() {
    return new Promise(function (resolve) {
        $.confirm({
            title: 'Remove Specific Student',
            content: 'Are you sure you want to remove this student?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Remove Student',
                    action: function () {
                        resolve(true); // User confirmed, resolve with true
                    },
                    btnClass: 'btn-confirm',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        resolve(false); // User cancelled, resolve with false
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    });
}

// Function to handle student removal
function prepareStudentRemoval(event) {
    event.preventDefault(); // Prevent the link from being followed immediately
    const studentId = event.currentTarget.dataset.id;
    confirmActionremovestudent().then(function (confirmed) {
        if (confirmed) {
            removeStudent(studentId);
        }
    });
}
function removeStudent(studentId) {
    $.ajax({
        type: 'GET',
        url: `./back_end/remove_student.php?id=${studentId}`,
        success: function () {
            removeStudentSuccess();
        },
        error: function () {
            // Handle error if needed
        },
    });
}

function removeStudentSuccess() {
    $.confirm({
        title: 'Removed Successfully',
        content: 'The specific Student is successfully removed.',
        autoClose: 'cancelAction|3000',
        buttons: {
            cancelAction: {
                text: 'Continue',
                action: function () {
                    window.location.href = './index.php';
                },
                btnClass: 'btn-yes',
            },
        },
        titleClass: 'my-title-class',
    });
}


// Ito is para sa Edit ng student
function editstudent_close() {
    $(".editstudent-background").fadeOut();
    $(".editstudent-blackbackground").fadeOut();
}

function getMiddleNameInitials(MiddleNameInitial) {
    const words = MiddleNameInitial.trim().split(' ');
    let initials = '';

    for (const word of words) {
        initials += word[0].toUpperCase() + '.';
    }

    return initials.slice(0, -1); // Remove trailing period if it exists
}

const firstnameInput = document.getElementById('firstnamestudent');
const middlenameInput = document.getElementById('middlenamestudent');
const lastnameInput = document.getElementById('lastnamestudent');
const SuffixInput = document.getElementById('Suffixstudent');
const emailaddressInput = document.getElementById('emailaddress');
const fullnameInput = document.getElementById('fullname');

function updateEmailAddress() {
    const firstname = firstnameInput.value.trim();
    const middleInitial = middlenameInput.value.trim()
    const middlenameWords = middlenameInput.value.trim().split(' ');
    let middlename = '';
    const MiddleNameInitial = getMiddleNameInitials(middleInitial).toUpperCase();

    // Get the first letter of each word in middlenameWords
    for (const word of middlenameWords) {
        middlename += word.charAt(0);
    }
    const lastname = lastnameInput.value.trim();
    const Suffix = SuffixInput.value.trim();
    const capitalizedSuffix = Suffix.toUpperCase();

    // Concatenate the values with comma and space
    const fullname = lastname + ',' + firstname + ' ' + capitalizedSuffix + ' ' + MiddleNameInitial + '.';
    //const fullname = lastname + ',' + firstname + ' ' + MiddleNameInitial + '.';
    const emailaddress = firstname.replace(/\s/g, '').replace(/Ñ/g, 'N').replace(/ñ/g, 'n').toLowerCase() +
        '.' + lastname.replace(/\s/g, '').replace(/Ñ/g, 'N').replace(/ñ/g, 'n').toLowerCase() +
        Suffix.replace(/\s/g, '').replace(/Ñ/g, 'N').replace(/ñ/g, 'n').toLowerCase() + '.' +
        middlename.toLowerCase() + '@bulsu.edu.ph';
    //const emailaddress = firstname.replace(/\s/g, '').replace(/Ñ/g, 'N').replace(/ñ/g, 'n').toLowerCase() + '.' + lastname.replace(/\s/g, '').replace(/Ñ/g, 'N').replace(/ñ/g, 'n').toLowerCase() + '.' + middlename.toLowerCase() + '@bulsu.edu.ph';

    // Update the Email Address field
    emailaddressInput.value = emailaddress;
    fullnameInput.value = fullname;

}

//Ito para sa pag activate ng student accounts
$(".changestatusVoters").click(function () {
    $(".activateVoters-background").fadeIn();
    $(".activateVoters-blackbackground").fadeIn();

    $(".activateVoters-background .activateVoters-footer h4").click(function () {
        $(".activateVoters-background").fadeOut();
        $(".activateVoters-blackbackground").fadeOut();
        document.getElementById("myForm2").reset();
    });

    $(".activateVoters-blackbackground").click(function () {
        $(".activateVoters-background").fadeOut();
        $(".activateVoters-blackbackground").fadeOut();
        document.getElementById("myForm2").reset();
    });
});

//Ito para sa send ng mga password sa emails
function SendPassword() {
    $(".SendPasswordToEmails-background").fadeIn();
    $(".SendPasswordToEmails-blackbackground").fadeIn();

    $(".SendPasswordToEmails-background .SendPasswordToEmails-footer h4").click(function () {
        $(".SendPasswordToEmails-background").fadeOut();
        $(".SendPasswordToEmails-blackbackground").fadeOut();
        document.getElementById("myForm3").reset();
    });

    $(".SendPasswordToEmails-blackbackground").click(function () {
        $(".SendPasswordToEmails-background").fadeOut();
        $(".SendPasswordToEmails-blackbackground").fadeOut();
        document.getElementById("myForm3").reset();
    });
}

//Ito para sa pag regenerate ng student passwords
function generatePassword() {
    $(".GeneratePassword-background").fadeIn();
    $(".GeneratePassword-blackbackground").fadeIn();

    $(".GeneratePassword-background .GeneratePassword-footer h4").click(function () {
        $(".GeneratePassword-background").fadeOut();
        $(".GeneratePassword-blackbackground").fadeOut();
        document.getElementById("myForm4").reset();
    });

    $(".GeneratePassword-blackbackground").click(function () {
        $(".GeneratePassword-background").fadeOut();
        $(".GeneratePassword-blackbackground").fadeOut();
        document.getElementById("myForm4").reset();
    });
}

//NEW ADMIN SHOW/HiDE PASSWORD
function adminPasswordshowhide() {
    var passwordInput = document.getElementById('adminpassword');
    var hidepassword = $("#hide");
    var showpassword = $("#show");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        hidepassword.css("display", "none");
        showpassword.css("display", "block");
    } else {
        passwordInput.type = "password";
        showpassword.css("display", "none");
        hidepassword.css("display", "block");
    }
}

//Ito para sa pagcreate ng new 
function newadmin() {
    $(".NewAdmin-background").fadeIn();
    $(".NewAdmin-blackbackground").fadeIn();

    $(".NewAdmin-background .NewAdmin-footer h4").click(function () {
        $(".NewAdmin-background").fadeOut();
        $(".NewAdmin-blackbackground").fadeOut();
        document.getElementById("myForm5").reset();
    });

    $(".NewAdmin-blackbackground").click(function () {
        $(".NewAdmin-background").fadeOut();
        $(".NewAdmin-blackbackground").fadeOut();
        document.getElementById("myForm5").reset();
    });
}

//Ito nmn JS function ng pagswitch ng icon ng admin and pag activate/deactivate
function checkAdminStatus() {
    $.ajax({
        url: './back_end/check_admin_status.php', // Replace with the actual PHP file to check admin status
        type: 'GET',
        success: function (data) {
            if (data === 'activated') {
                $("#adminactivate").css('display', 'block');
                $("#admindeactivate").css('display', 'none');
                $('#adminStatusDisplay').text('Deactivate Admin');
            } else if (data === 'deactivated') {
                // If admin status is 'deactivate', show the deactivate button
                $("#adminactivate").css('display', 'none');
                $("#admindeactivate").css('display', 'block');
                $('#adminStatusDisplay').text('Activate Admin');
            } else if (data === 'none') {
                $("#adminactivate").css('display', 'none');
                $("#admindeactivate").css('display', 'block');
                $('#adminStatusDisplay').text('No Admins Yet');
                $("#activate_deactivateadmins").off("click");
            } else {
                // If there is an error or unknown status, show both buttons by default
                $("#adminactivate").css('display', 'block');
                $("#admindeactivate").css('display', 'block');
            }
        },
        error: function () {
            // If there's an error with the AJAX request, show both buttons by default
            $("#adminactivate").css('display', 'block');
            $("#admindeactivate").css('display', 'block');
        }
    });
}

$("#activate_deactivateadmins").click(function () {
    var showactivate = $("#adminactivate");
    var showdeactivate = $("#admindeactivate");
    var isActivateVisible = showactivate.is(":visible");

    var rotateClass = "rotate-element";

    if (isActivateVisible) {
        showactivate.addClass(rotateClass);

        setTimeout(function () {
            showactivate.css("display", "none");
            showdeactivate.css("display", "block");
            showactivate.removeClass(rotateClass);

            // Perform AJAX to update admin status in the server
            $.ajax({
                url: './back_end/deactivate_admins.php', // Replace with the actual PHP link to activate admins
                type: 'POST',
                success: function (data) {
                    // After successful activation, update the buttons' display based on the response
                    checkAdminStatus();
                    location.reload();
                },
                error: function () {
                    // If there's an error with the AJAX request, update the buttons' display based on the server status
                    checkAdminStatus();
                }
            });
        }, 1000);

    } else {
        showdeactivate.addClass(rotateClass);

        setTimeout(function () {
            showactivate.css("display", "block");
            showdeactivate.css("display", "none");
            showdeactivate.removeClass(rotateClass);

            // Perform AJAX to update admin status in the server
            $.ajax({
                url: './back_end/activate_admins.php', // Replace with the actual PHP link to deactivate admins
                type: 'POST',
                success: function (data) {
                    // After successful deactivation, update the buttons' display based on the response
                    checkAdminStatus();
                    location.reload();
                },
                error: function () {
                    // If there's an error with the AJAX request, update the buttons' display based on the server status
                    checkAdminStatus();
                }
            });
        }, 1000);
    }
});
// Call the checkAdminStatus function once the DOM is ready to initially set the buttons' display based on server status
$(document).ready(function () {
    checkAdminStatus();
});

/////////////////////////////////////////////

//Ito nmn JS function ng pagswitch ng icon ng superadmin and pag activate/deactivate
function checkSuperadminStatus() {
    $.ajax({
        url: './back_end/check_superadmin_status.php', // Replace with the actual PHP file to check admin status
        type: 'GET',
        success: function (data) {
            if (data === 'activated') {
                $("#superadminactivate").css('display', 'block');
                $("#superadmindeactivate").css('display', 'none');
                $('#superadminStatusDisplay').text('Deactivate Superadmin');
            } else if (data === 'deactivated') {
                // If admin status is 'deactivate', show the deactivate button
                $("#superadminactivate").css('display', 'none');
                $("#superadmindeactivate").css('display', 'block');
                $('#superadminStatusDisplay').text('Activate Superadmin');
            } else if (data === 'none') {
                $("#superadminactivate").css('display', 'none');
                $("#superadmindeactivate").css('display', 'block');
                $('#superadminStatusDisplay').text('No Superadmin Yet');
                $("#activate_deactivatesuperadmins").off("click");
            } else {
                // If there is an error or unknown status, show both buttons by default
                $("#superadminactivate").css('display', 'block');
                $("#superadmindeactivate").css('display', 'block');
            }
        },
        error: function () {
            // If there's an error with the AJAX request, show both buttons by default
            $("#superadminactivate").css('display', 'block');
            $("#superadmindeactivate").css('display', 'block');
        }
    });
}

$("#activate_deactivatesuperadmins").click(function () {
    $.confirm({
        title: 'Activate/Deactivate Superadmins?',
        content: 'Are you sure you want to activate/deactivate this student?',
        autoClose: 'cancelAction|8000',
        buttons: {
            deleteUser: {
                text: 'Activate / Deactivate Now',
                action: function () {
                    superadmin_activateANDdeactivate();
                },
                btnClass: 'btn-yes',
            },
            cancelAction: {
                text: 'Cancel',
                action: function () {
                },
                btnClass: 'btn-confirm',
            },
        },
        titleClass: 'my-title-class',
    });

});

function superadmin_activateANDdeactivate() {
    var showactivate1 = $("#superadminactivate");
    var showdeactivate1 = $("#superadmindeactivate");
    var isActivateVisible1 = showactivate1.is(":visible");

    var rotateClass = "rotate-element";

    if (isActivateVisible1) {
        showactivate1.addClass(rotateClass);

        setTimeout(function () {
            showactivate1.css("display", "none");
            showdeactivate1.css("display", "block");
            showactivate1.removeClass(rotateClass);

            // Perform AJAX to update admin status in the server
            $.ajax({
                url: './back_end/deactivate_superadmins.php', // Replace with the actual PHP link to activate admins
                type: 'POST',
                success: function (data) {
                    // After successful activation, update the buttons' display based on the response
                    checkSuperadminStatus();
                    location.reload();
                },
                error: function () {
                    // If there's an error with the AJAX request, update the buttons' display based on the server status
                    checkSuperadminStatus();
                }
            });
        }, 1000);

    } else {
        showdeactivate1.addClass(rotateClass);

        setTimeout(function () {
            showactivate1.css("display", "block");
            showdeactivate1.css("display", "none");
            showdeactivate1.removeClass(rotateClass);

            // Perform AJAX to update admin status in the server
            $.ajax({
                url: './back_end/activate_superadmins.php', // Replace with the actual PHP link to deactivate admins
                type: 'POST',
                success: function (data) {
                    // After successful deactivation, update the buttons' display based on the response
                    checkSuperadminStatus();
                    location.reload();
                },
                error: function () {
                    // If there's an error with the AJAX request, update the buttons' display based on the server status
                    checkSuperadminStatus();
                }
            });
        }, 1000);
    }
}
// Call the checkAdminStatus function once the DOM is ready to initially set the buttons' display based on server status
$(document).ready(function () {
    checkSuperadminStatus();
});

///////////////////////////////////////////////////////////

function checkStudentStatus() {
    $.ajax({
        url: './back_end/check_student_status.php',
        type: 'GET',
        success: function (data) {
            if (data === 'activated') {
                $('#studentStatusDisplay').text('Deactivate All Voters Account');
            } else if (data === 'deactivated') {
                $('#studentStatusDisplay').text('Activate All Voters Account');
            } else {
                $('#studentStatusDisplay').text('No Voters Account');
                $(".changestatusVoters").off("click");
            }
        },
        error: function () {
            $('#studentStatusDisplay').text('May Error');
        }
    });
}

// Call the checkStudentStatus function once the DOM is ready to initially set the buttons' display based on server status
$(document).ready(function () {
    checkStudentStatus();
});

//Ito nmn is para sa Pag Add ng New Admin
$(document).ready(function () {
    // Flag variable to track if the confirmation dialog has been shown
    let confirmationShown = false;

    // Function to handle the form submission after confirmation
    function handleFormSubmission() {
        $(".NewAdmin-background").fadeOut();
        $(".NewAdmin-blackbackground").fadeOut();
        $.confirm({
            title: 'Successfully Added',
            content: 'The New Admin is Successfully Added...',
            autoClose: 'cancelAction|3000',
            buttons: {
                cancelAction: {
                    text: 'Continue',
                    action: function () {
                        // Proceed with the form submission after the user confirms
                        $('#myForm5').submit();
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    }

    // Bind the form submission to the custom function
    $('#myForm5').submit(function (e) {
        // Check if the form is valid before proceeding
        if (!this.checkValidity()) {
            e.preventDefault(); // Prevent form submission if it's not valid
            alert('Please fill in all required fields.');
            return false;
        }

        // If the confirmation dialog hasn't been shown yet, proceed to show it after the delay
        if (!confirmationShown) {
            confirmationShown = true;

            // Add a delay before showing the confirmation dialog (e.g., 1000ms or 1 second)
            const delayInMilliseconds = 100; // 1 second
            setTimeout(function () {
                // If the form is valid, show the confirmation dialog
                handleFormSubmission();
            }, delayInMilliseconds);

            // Prevent immediate form submission
            e.preventDefault();
        }
    });
});

// Function to handle admin removal
function confirmActionremoveadmin() {
    return new Promise(function (resolve) {
        $.confirm({
            title: 'Remove Specific Admin',
            content: 'Are you sure you want to remove this admin?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Remove Admin',
                    action: function () {
                        resolve(true); // User confirmed, resolve with true
                    },
                    btnClass: 'btn-confirm',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        resolve(false); // User cancelled, resolve with false
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    });
}


// Function to handle admin removal
function prepareAdminRemoval(event) {
    event.preventDefault(); // Prevent the link from being followed immediately
    const adminId = event.currentTarget.dataset.id;
    confirmActionremoveadmin().then(function (confirmed) {
        if (confirmed) {
            removeAdmin(adminId);
        }
    });
}
function removeAdmin(adminId) {
    $.ajax({
        type: 'GET',
        url: `./back_end/remove_admin.php?id=${adminId}`,
        success: function () {
            removeAdminSuccess()
        },
        error: function () {
            // Handle error if needed
        },
    });
}

function removeAdminSuccess() {
    $(".ListofAdmins-background").fadeOut();
    $(".ListofAdmins-blackbackground").fadeOut();
    $.confirm({
        title: 'Removed Successfully',
        content: 'The specific Admin is successfully removed.',
        autoClose: 'cancelAction|3000',
        buttons: {
            cancelAction: {
                text: 'Continue',
                action: function () {
                    window.location.href = './index.php';
                },
                btnClass: 'btn-yes',
            },
        },
        titleClass: 'my-title-class',
    });
}

//Ito para sa show ng List of admin
function ListOfAdmin() {
    $(".ListofAdmins-background").fadeIn();
    $(".ListofAdmins-blackbackground").fadeIn();

    $(".ListofAdmins-background .ListofAdmins-footer h4").click(function () {
        $(".ListofAdmins-background").fadeOut();
        $(".ListofAdmins-blackbackground").fadeOut();
    });

    $(".ListofAdmins-blackbackground").click(function () {
        $(".ListofAdmins-background").fadeOut();
        $(".ListofAdmins-blackbackground").fadeOut();
    });
}

///////////////////////////////////////////

function supernewadmin() {
    $(".SuperNewAdmin-background").fadeIn();
    $(".SuperNewAdmin-blackbackground").fadeIn();

    $(".SuperNewAdmin-background .SuperNewAdmin-footer h4").click(function () {
        $(".SuperNewAdmin-background").fadeOut();
        $(".SuperNewAdmin-blackbackground").fadeOut();
        document.getElementById("myForm6").reset();
    });

    $(".SuperNewAdmin-blackbackground").click(function () {
        $(".SuperNewAdmin-background").fadeOut();
        $(".SuperNewAdmin-blackbackground").fadeOut();
        document.getElementById("myForm6").reset();
    });
}


//NEW ADMIN SHOW/HiDE PASSWORD
function superadminpasswordPasswordshowhide() {
    var passwordInput = document.getElementById('superadminpassword');
    var hidepassword = $("#hide");
    var showpassword = $("#show");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        hidepassword.css("display", "none");
        showpassword.css("display", "block");
    } else {
        passwordInput.type = "password";
        showpassword.css("display", "none");
        hidepassword.css("display", "block");
    }
}

//Ito nmn is para sa Pag Add ng New SuperAdmin
$(document).ready(function () {
    // Flag variable to track if the confirmation dialog has been shown
    let confirmationShown2 = false;

    // Function to handle the form submission after confirmation
    function handleFormSubmission() {
        $(".SuperNewAdmin-background").fadeOut();
        $(".SuperNewAdmin-blackbackground").fadeOut();
        $.confirm({
            title: 'Successfully Added',
            content: 'The New Superadmin is Successfully Added...',
            autoClose: 'cancelAction|3000',
            buttons: {
                cancelAction: {
                    text: 'Continue',
                    action: function () {
                        $('#myForm6').submit();
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    }

    // Bind the form submission to the custom function
    $('#myForm6').submit(function (e) {
        // Check if the form is valid before proceeding
        if (!this.checkValidity()) {
            e.preventDefault(); // Prevent form submission if it's not valid
            alert('Please fill in all required fields.');
            return false;
        }

        // If the confirmation dialog hasn't been shown yet, proceed to show it after the delay
        if (!confirmationShown2) {
            confirmationShown2 = true;

            // Add a delay before showing the confirmation dialog (e.g., 1000ms or 1 second)
            const delayInMilliseconds2 = 100; // 1 second
            setTimeout(function () {
                // If the form is valid, show the confirmation dialog
                handleFormSubmission();
            }, delayInMilliseconds2);

            // Prevent immediate form submission
            e.preventDefault();
        }
    });
});


//Ito para sa show ng List of superadmin
function ListOfSuperdmin() {
    $(".ListofSuperadmins-background").fadeIn();
    $(".ListofSuperadmins-blackbackground").fadeIn();

    $(".ListofSuperadmins-background .ListofSuperadmins-footer h4").click(function () {
        $(".ListofSuperadmins-background").fadeOut();
        $(".ListofSuperadmins-blackbackground").fadeOut();
    });

    $(".ListofSuperadmins-blackbackground").click(function () {
        $(".ListofSuperadmins-background").fadeOut();
        $(".ListofSuperadmins-blackbackground").fadeOut();
    });
}

// Function to handle superadmin removal
function confirmActionremovesuperadmin() {
    return new Promise(function (resolve) {
        $.confirm({
            title: 'Remove Specific Superadmin',
            content: 'Are you sure you want to remove this superadmin?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Remove Superadmin',
                    action: function () {
                        resolve(true); // User confirmed, resolve with true
                    },
                    btnClass: 'btn-confirm',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        resolve(false); // User cancelled, resolve with false
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    });
}

function prepareSuperadminRemoval(event) {
    event.preventDefault(); // Prevent the link from being followed immediately
    const superadminId = event.currentTarget.dataset.id;
    confirmActionremovesuperadmin().then(function (confirmed) {
        if (confirmed) {
            removeSuperadmin(superadminId);
        }
    });
}
function removeSuperadmin(superadminId) {
    $.ajax({
        type: 'GET',
        url: `./back_end/remove_superadmin.php?id=${superadminId}`,
        success: function () {
            removeSuperadminSuccess();
        },
        error: function () {
            // Handle error if needed
        },
    });
}

function removeSuperadminSuccess() {
    $(".ListofSuperadmins-background").fadeOut();
    $(".ListofSuperadmins-blackbackground").fadeOut();
    $.confirm({
        title: 'Removed Successfully',
        content: 'The specific Superadmin is successfully removed.',
        autoClose: 'cancelAction|3000',
        buttons: {
            cancelAction: {
                text: 'Continue',
                action: function () {
                    window.location.href = './index.php';
                },
                btnClass: 'btn-yes',
            },
        },
        titleClass: 'my-title-class',
    });
}

//Ito para sa pagDOWNLOAD ng Database
function DownloadDB() {
    $(".DownloadDatabase-background").fadeIn();
    $(".DownloadDatabase-blackbackground").fadeIn();

    $(".DownloadDatabase-background .DownloadDatabase-footer h4").click(function () {
        $(".DownloadDatabase-background").fadeOut();
        $(".DownloadDatabase-blackbackground").fadeOut();
        document.getElementById("myForm7").reset();
    });

    $(".DownloadDatabase-blackbackground").click(function () {
        $(".DownloadDatabase-background").fadeOut();
        $(".DownloadDatabase-blackbackground").fadeOut();
        document.getElementById("myForm7").reset();
    });
}

function NewElection(event) {
    event.preventDefault();
    var electionNameInput = document.getElementById("electionname").value;
    var electionDateInput = document.getElementById("datecreation").value;
    var electionDetailsInput = document.getElementById("electiondetails").value;

    if (electionNameInput.includes("_") || electionNameInput.includes(" ") || electionDetailsInput == "" || electionDateInput == "") {
        $.confirm({
            title: 'Somethings Wrong',
            content: 'Sorry but somethings Wrong in your input <br> Could you please re-write it again',
            autoClose: 'cancelAction|3000',
            buttons: {
                cancelAction: {
                    text: 'Continue',
                    action: function () {
                        document.getElementById("myForm1").reset();
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    } else {
        $.confirm({
            title: 'Create New Election Event?',
            content: 'Are you sure you want to create New Election Event?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Create Now',
                    action: function () {
                        $(".NewElection-background").fadeOut();
                        $(".NewElection-blackbackground").fadeOut();

                        setTimeout(function () {
                            $.confirm({
                                title: 'Successfully Created',
                                content: 'New ELection Event has been created',
                                autoClose: 'cancelAction|3000',
                                buttons: {
                                    cancelAction: {
                                        text: 'Continue',
                                        action: function () {
                                            document.getElementById("myForm1").submit();
                                        },
                                        btnClass: 'btn-yes',
                                    },
                                },
                                titleClass: 'my-title-class',
                            });
                        }, 500);
                    },
                    btnClass: 'btn-yes',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        $(".NewElection-background").fadeOut();
                        $(".NewElection-blackbackground").fadeOut();
                        document.getElementById("myForm1").reset();
                    },
                    btnClass: 'btn-confirm',
                },
            },
            titleClass: 'my-title-class',
        });

    }
}

//Ito para sa pag-alis ng pagkakashow ng ElectionInformation
function ElectionInformationBack() {
    $(".ElectionInformation-background").fadeIn();
    $(".ElectionInformation-blackbackground").fadeIn();

    $(".ElectionInformation-background .ElectionInformation-footer h4").click(function () {
        $(".ElectionInformation-background").fadeOut();
        $(".ElectionInformation-blackbackground").fadeOut();
    });

    $(".ElectionInformation-blackbackground").click(function () {
        $(".ElectionInformation-background").fadeOut();
        $(".ElectionInformation-blackbackground").fadeOut();
    });
}

/////////////////////////////////////////////////////////////////////////////
var ACTIVATEorDEACTIVATE_STUDENT = false;
var GENERATE_RANDOM_PASSWORD = false;
var DOWNLOADandBACKUP_DATABASE = false;
var SENDINGPASSWORD = false;
var EDITSTUDENT_DETAILS = false;
var DELETING_ELECTIONBATCH = false;

// (ACTIVATE/DEACTIVATE STUDENT)
$("#myForm2").submit(function (event) {
    event.preventDefault();
    ACTIVATEorDEACTIVATE_STUDENT = true;
});

// (SENDING PASSWORD STUDENT)
$("#myForm3").submit(function (event) {
    event.preventDefault();
    SENDINGPASSWORD = true;
});

// (GENERATE RANDOM PASSWORD)
$("#myForm4").submit(function (event) {
    event.preventDefault();
    GENERATE_RANDOM_PASSWORD = true;
});

// (DOWNLOAD/BACK-UP DATABASE)
$("#myForm7").submit(function (event) {
    event.preventDefault();
    DOWNLOADandBACKUP_DATABASE = true;
});

// (PAG EDIT NG STUDENT)
$("#myForm0").submit(function (event) {
    event.preventDefault();
    EDITSTUDENT_DETAILS = true;
});

// (PAG DELETE NG ELECTION BATCH)
$("#myForm9").submit(function (event) {
    event.preventDefault();
    DELETING_ELECTIONBATCH = true;
});

if (ACTIVATEorDEACTIVATE_STUDENT) {
    activateordeactivatestudent();
} else if (GENERATE_RANDOM_PASSWORD) {
    generaterandompassword();
} else if (DOWNLOADandBACKUP_DATABASE) {
    DownloadDatabaseBTN();
} else if (DELETING_ELECTIONBATCH) {
    deleting_electionbatch();
} else if (SENDINGPASSWORD) {
    SendingPasswordToStudents();
}

function activateordeactivatestudent() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/superadmin_verification_deactive&activateStudent.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'incorrect') {
                    $.confirm({
                        title: 'Wrong Password',
                        content: 'Sorry but your password is didn\'t recognize?',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm2").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else if (response === 'activated') {
                    $(".activateVoters-background").fadeOut();
                    $(".activateVoters-blackbackground").fadeOut();
                    $.confirm({
                        title: 'Successfully Activated',
                        content: 'All student accounts have been activated',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    window.location.href = './back_end/activate_students.php';
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else if (response === 'deactivated') {
                    $(".activateVoters-background").fadeOut();
                    $(".activateVoters-blackbackground").fadeOut();
                    $.confirm({
                        title: 'Successfully Deactivated',
                        content: 'All student accounts have been deactivated',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    window.location.href = './back_end/deactivate_students.php';
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm2')));
}

function generaterandompassword() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/superadmin_verification.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'incorrect') {
                    $.confirm({
                        title: 'Wrong Password',
                        content: 'Sorry but your password is didn\'t recognize?',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm4").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".GeneratePassword-background").fadeOut();
                    $(".GeneratePassword-blackbackground").fadeOut();
                    $.confirm({
                        title: 'Successfully Generated',
                        content: 'All student accounts have been generated new random password',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm4").submit();
                                    document.getElementById("myForm4").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm4')));
}

function DownloadDatabaseBTN() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/superadmin_verification.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'incorrect') {
                    $.confirm({
                        title: 'Wrong Password',
                        content: 'Sorry but your password is didn\'t recognize?',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm7").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".DownloadDatabase-background").fadeOut();
                    $(".DownloadDatabase-blackbackground").fadeOut();
                    $.confirm({
                        title: 'Successfully Downloadable',
                        content: 'You may now save the database for back-up purposes',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm7").submit();
                                    document.getElementById("myForm7").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm7')));
}

function SendingPasswordToStudents() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/superadmin_verification.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'incorrect') {
                    $.confirm({
                        title: 'Wrong Password',
                        content: 'Sorry but there\'s must be something wrong, check specify time/password.',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm3").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".SendPasswordToEmails-background").fadeOut();
                    $(".SendPasswordToEmails-blackbackground").fadeOut();
                    $.confirm({
                        content: function () {
                            return $.ajax({
                                url: './back_end/sendpassword_student.php?rand=' + Math.random(),
                                // Mag-update ng progress bar habang naghihintay ng response
                                xhr: function () {
                                    var xhr = new window.XMLHttpRequest();
                                    xhr.upload.addEventListener("progress", function (evt) {
                                        if (evt.lengthComputable) {
                                            var percentComplete = evt.loaded / evt.total;
                                            percentComplete = parseInt(percentComplete * 100);
                                            $('.progress-bar').css('width', percentComplete + '%');
                                            $('.progress-bar').attr('aria-valuenow', percentComplete);
                                        }
                                    }, false);
                                    return xhr;
                                },
                                success: function () {
                                    $('.jconfirm').fadeOut();
                                    $.confirm({
                                        title: 'Successfully Sent Password',
                                        content: 'All student email accounts have received their own passwords.',
                                        buttons: {
                                            cancelAction: {
                                                text: 'Continue',
                                                action: function () {
                                                    document.getElementById("myForm3").reset();
                                                },
                                                btnClass: 'btn-yes',
                                            },
                                        },
                                        titleClass: 'my-title-class',
                                    });
                                },
                                error: function () {
                                    // Handle error if needed
                                }
                            });
                        }
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm3')));
}

function setFormAction(action) {
    document.getElementById("myForm0").action = action;
}

function editstudentdetails() {
    setFormAction('./back_end/edit_student.php?id=' + studentID);
    $.confirm({
        title: 'Edit Student Details',
        content: 'Are you sure you want to edit this student details?',
        autoClose: 'cancelAction|8000',
        buttons: {
            deleteUser: {
                text: 'Yes',
                action: function () {
                    document.getElementById("myForm0").submit();
                },
                btnClass: 'btn-yes',
            },
            cancelAction: {
                text: 'Cancel',
                action: function () {
                },
                btnClass: 'btn-confirm',
            },
        },
        titleClass: 'my-title-class',
    });
}

function regeneratepasswordandsend() {
    setFormAction('./back_end/regenerateandresendpassword.php?id=' + studentID);
    $.confirm({
        title: 'Regenerate And Send Password',
        content: 'Are you sure you want to regenerate and send password?',
        autoClose: 'cancelAction|8000',
        buttons: {
            deleteUser: {
                text: 'Yes',
                action: function () {
                    document.getElementById("myForm0").submit();
                },
                btnClass: 'btn-yes',
            },
            cancelAction: {
                text: 'Cancel',
                action: function () {
                },
                btnClass: 'btn-confirm',
            },
        },
        titleClass: 'my-title-class',
    });
}

function DeleteElectionBatch() {
    $.ajax({
        url: './back_end/check_currentbatch.php', // Replace with the actual PHP file to check admin status
        type: 'GET',
        success: function (data) {
            $.confirm({
                title: 'Delete This Election Batch?',
                content: 'Are you sure you want to delete ' + data,
                autoClose: 'cancelAction|8000',
                buttons: {
                    deleteUser: {
                        text: 'Delete Now',
                        action: function () {
                            DeleteBatch();
                        },
                        btnClass: 'btn-confirm',
                    },
                    cancelAction: {
                        text: 'Cancel',
                        action: function () {
                        },
                        btnClass: 'btn-yes',
                    },
                },
                titleClass: 'my-title-class',
            });

        }
    });
};

//Ito para sa pagDOWNLOAD ng Database
function DeleteBatch() {
    $(".DelElectionBatch-background").fadeIn();
    $(".DelElectionBatch-blackbackground").fadeIn();

    $(".DelElectionBatch-background .DelElectionBatch-footer h4").click(function () {
        $(".DelElectionBatch-background").fadeOut();
        $(".DelElectionBatch-blackbackground").fadeOut();
        document.getElementById("myForm9").reset();
    });

    $(".DelElectionBatch-blackbackground").click(function () {
        $(".DelElectionBatch-background").fadeOut();
        $(".DelElectionBatch-blackbackground").fadeOut();
        document.getElementById("myForm9").reset();
    });
}

function deleting_electionbatch() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/superadmin_verification.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'incorrect') {
                    $.confirm({
                        title: 'Wrong Password',
                        content: 'Sorry but your password is didn\'t recognize?',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm9").reset();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".DelElectionBatch-background").fadeOut();
                    $(".DelElectionBatch-blackbackground").fadeOut();
                    $(".ElectionInformation-background").fadeOut();
                    $(".ElectionInformation-blackbackground").fadeOut();

                    $.ajax({
                        url: './back_end/check_currentbatch2.php', // Replace with the actual PHP file to check admin status
                        type: 'GET',
                        success: function (data) {
                            if (data === 'CannotDelete') {
                                $.confirm({
                                    title: 'Fixed Content',
                                    content: 'This LSCBatch2021-2022 is not allowed to delete as per system guidelines.',
                                    autoClose: 'cancelAction|8000',
                                    buttons: {
                                        cancelAction: {
                                            text: 'Continue',
                                            action: function () {
                                                document.getElementById("myForm9").reset();
                                            },
                                            btnClass: 'btn-yes',
                                        },
                                    },
                                    titleClass: 'my-title-class',
                                });
                            } else {
                                $.confirm({
                                    title: 'Successfully Deleted',
                                    content: 'The ' + data + ' is Successfully Deleted...',
                                    autoClose: 'cancelAction|8000',
                                    buttons: {
                                        cancelAction: {
                                            text: 'Continue',
                                            action: function () {
                                                document.getElementById("myForm9").submit();
                                                document.getElementById("myForm9").reset();
                                            },
                                            btnClass: 'btn-yes',
                                        },
                                    },
                                    titleClass: 'my-title-class',
                                });
                            }
                        }
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm9')));
}

function VoteTallyReport() {
    $(".print_votetally-background").fadeIn();
    $(".print_votetally-blackbackground").fadeIn();

    $(".print_votetally-background .print_votetally-footer h4").click(function () {
        $(".print_votetally-background").fadeOut();
        $(".print_votetally-blackbackground").fadeOut();
        document.getElementById("myForm13").reset();
    });

    $(".print_votetally-blackbackground").click(function () {
        $(".print_votetally-background").fadeOut();
        $(".print_votetally-blackbackground").fadeOut();
        document.getElementById("myForm13").reset();
    });
}

function VoteTallyReportNow() {
    event.preventDefault();
    $(".print_votetally-background").fadeOut();
    $(".print_votetally-blackbackground").fadeOut();

    // Initialize XMLHttpRequest
    var xhr = new XMLHttpRequest();

    $.confirm({
        title: 'Successfully Downloadable',
        content: 'You may now download the VoteTally result',
        autoClose: 'cancelAction|3000',
        buttons: {
            cancelAction: {
                text: 'Continue',
                action: function () {
                    xhr.onload = function () {
                        document.getElementById("myForm13").submit();
                    };

                    // Assuming you have the necessary configurations for xhr
                    xhr.open("POST", "./back_end/insert_fullnameofsuperadminsAndadmins.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send();
                },
                btnClass: 'btn-yes',
            },
        },
        titleClass: 'my-title-class',
    });
}


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

function toggleFullscreen() {
    var container = document.getElementById('fullscreenContainer');

    if (document.fullscreenElement || /* Standard syntax */
        document.webkitFullscreenElement || /* Chrome, Safari and Opera syntax */
        document.mozFullScreenElement || /* Firefox syntax */
        document.msFullscreenElement) { /* IE/Edge syntax */

        // Exit fullscreen
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }

        // Remove the fullscreen class
        container.classList.remove('fullscreen');

    } else {
        // Enter fullscreen
        if (container.requestFullscreen) {
            container.requestFullscreen();
        } else if (container.mozRequestFullScreen) {
            container.mozRequestFullScreen();
        } else if (container.webkitRequestFullscreen) {
            container.webkitRequestFullscreen();
        } else if (container.msRequestFullscreen) {
            container.msRequestFullscreen();
        }

        // Add the fullscreen class
        container.classList.add('fullscreen');
    }
}

// Listen for fullscreen changes
document.addEventListener('fullscreenchange', handleFullscreenChange);
document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
document.addEventListener('mozfullscreenchange', handleFullscreenChange);
document.addEventListener('MSFullscreenChange', handleFullscreenChange);

// Function to handle fullscreen change
function handleFullscreenChange() {
    var container = document.getElementById('fullscreenContainer');

    if (!document.fullscreenElement &&
        !document.webkitFullscreenElement &&
        !document.mozFullScreenElement &&
        !document.msFullscreenElement) {

        container.classList.remove('fullscreen');
    }
}

function handleFullscreenChange() {
    var container = document.getElementById('fullscreenContainer');
    var slide = document.querySelector('.slides');

    if (document.fullscreenElement ||
        document.webkitFullscreenElement ||
        document.mozFullScreenElement ||
        document.msFullscreenElement) {

        // Add the fullscreen class
        container.classList.add('fullscreen');

        // Scale and translate the content of .slide-first when entering fullscreen
        slide.style.transform = 'scale(1.5) translate(2%, 4%)';
        slide.style.transformOrigin = 'top left'; // Adjust the origin point

    } else {

        // Remove the fullscreen class
        container.classList.remove('fullscreen');

        // Reset the scale and position when exiting fullscreen
        slide.style.transform = 'scale(1) translate(0, 0)';
        slide.style.transformOrigin = 'top left'; // Reset the origin point
    }
}

//GALING ITO SA ADMIN SIDE PARA MAKAPAG ADD NG CANDIDATE
function addposition() {
    $(".addposition_candidate-background").fadeIn();
    $(".addposition_candidate-blackbackground").fadeIn();

    $(".addposition_candidate-background .addposition_candidate-footer h4").click(function () {
        $(".addposition_candidate-background").fadeOut();
        $(".addposition_candidate-blackbackground").fadeOut();
        document.getElementById("myForm11").reset();
    });

    $(".addposition_candidate-blackbackground").click(function () {
        $(".addposition_candidate-background").fadeOut();
        $(".addposition_candidate-blackbackground").fadeOut();
        document.getElementById("myForm11").reset();
    });
}

function addpartylist() {
    $(".addpartylist_candidate-background").fadeIn();
    $(".addpartylist_candidate-blackbackground").fadeIn();

    $(".addpartylist_candidate-background .addpartylist_candidate-footer h4").click(function () {
        $(".addpartylist_candidate-background").fadeOut();
        $(".addpartylist_candidate-blackbackground").fadeOut();
        document.getElementById("myForm12").reset();
    });

    $(".addpartylist_candidate-blackbackground").click(function () {
        $(".addpartylist_candidate-background").fadeOut();
        $(".addpartylist_candidate-blackbackground").fadeOut();
        document.getElementById("myForm12").reset();
    });
}

function editcandidates_close() {
    window.location.href = './index.php';
}


// Question before magremove
function confirmAction() {
    return new Promise(function (resolve) {
        $.confirm({
            title: 'Remove The Candidate',
            content: 'Are you sure you want to remove this candidate?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Remove Candidate',
                    action: function () {
                        resolve(true); // User confirmed, resolve with true
                    },
                    btnClass: 'btn-confirm',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        resolve(false); // User cancelled, resolve with false
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    });
}
function prepareCandidateRemoval(event) {
    event.preventDefault(); // Prevent the link from being followed immediately
    const candidateId = event.currentTarget.dataset.id;
    confirmAction().then(function (confirmed) {
        if (confirmed) {
            removeCandidate(candidateId);
        }
    });
}
function removeCandidate(candidateId) {
    $.ajax({
        type: 'GET',
        url: `./back_end/remove_candidate.php?id=${candidateId}`,
        success: function () {
            window.location.reload(); // Reload the page after successful removal
        },
        error: function () {
            // Handle error if needed
        },
    });
}

// Filter para sa position ng candidates
function filterCandidates() {
    const selectedPosition = document.getElementById("position").value;
    const selectedPartylist = document.getElementById("partylist").value;
    const candidateTableBody = document.getElementById("candidateTableBody");

    // AJAX request to fetch filtered candidates from the server
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                candidateTableBody.innerHTML = xhr.responseText;
            } else {
                candidateTableBody.innerHTML = "<tr><td colspan='9' style='padding: 10%'>Error fetching data.</td></tr>";
            }
        }
    };

    // Replace 'filter_candidates.php' with the actual PHP script that handles the filtering
    xhr.open("GET", "./back_end/filter_candidates.php?position=" + encodeURIComponent(selectedPosition) + "&partylist=" + encodeURIComponent(selectedPartylist), true);
    xhr.send();
}

// Initial load to show all candidates
filterCandidates();

////////////////////////////////////

function addcandidate() {
    event.preventDefault();

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/checkposition.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'NoPosition') {
                    $.confirm({
                        title: 'No Position Available',
                        content: 'Make sure to add position first',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".addcandidates-background").fadeIn();
                    $(".addcandidates-blackbackground").fadeIn();

                    $(".addcandidates-background .addcandidates-footer h4").click(function () {
                        $(".addcandidates-background").fadeOut();
                        $(".addcandidates-blackbackground").fadeOut();
                        document.getElementById("myForm10").reset();
                    });

                    $(".addcandidates-blackbackground").click(function () {
                        $(".addcandidates-background").fadeOut();
                        $(".addcandidates-blackbackground").fadeOut();
                        document.getElementById("myForm10").reset();
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm10')));
}

function ListOfPositions() {
    $(".ListofPositions-background").fadeIn();
    $(".ListofPositions-blackbackground").fadeIn();

    $(".ListofPositions-background .ListofPositions-footer h4").click(function () {
        $(".ListofPositions-background").fadeOut();
        $(".ListofPositions-blackbackground").fadeOut();
    });

    $(".ListofPositions-blackbackground").click(function () {
        $(".ListofPositions-background").fadeOut();
        $(".ListofPositions-blackbackground").fadeOut();
    });
}
// Function to handle position removal
function confirmActionremovePosition() {
    return new Promise(function (resolve) {
        $.confirm({
            title: 'Remove Specific Position',
            content: 'Are you sure you want to remove this position?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Remove Position',
                    action: function () {
                        resolve(true); // User confirmed, resolve with true
                    },
                    btnClass: 'btn-confirm',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        resolve(false); // User cancelled, resolve with false
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    });
}

function preparePositionRemoval(event) {
    event.preventDefault(); // Prevent the link from being followed immediately
    const positionId = event.currentTarget.dataset.id;
    confirmActionremovePosition().then(function (confirmed) {
        if (confirmed) {
            removePosition(positionId);
        }
    });
}
function removePosition(positionId) {
    $.ajax({
        type: 'GET',
        url: `./back_end/remove_position.php?id=${positionId}`,
        success: function () {
            removePositionSuccess();
        },
        error: function () {
            // Handle error if needed
        },
    });
}

function removePositionSuccess() {
    $(".ListofPositions-background").fadeOut();
    $(".ListofPositions-blackbackground").fadeOut();
    $.confirm({
        title: 'Removed Successfully',
        content: 'The specific Position is successfully removed.',
        autoClose: 'cancelAction|3000',
        buttons: {
            cancelAction: {
                text: 'Continue',
                action: function () {
                    window.location.href = './index.php';
                },
                btnClass: 'btn-yes',
            },
        },
        titleClass: 'my-title-class',
    });
}

function ListOfPartylist() {
    $(".ListofPartyList-background").fadeIn();
    $(".ListofPartyList-blackbackground").fadeIn();

    $(".ListofPartyList-background .ListofPartyList-footer h4").click(function () {
        $(".ListofPartyList-background").fadeOut();
        $(".ListofPartyList-blackbackground").fadeOut();
    });

    $(".ListofPartyList-blackbackground").click(function () {
        $(".ListofPartyList-background").fadeOut();
        $(".ListofPartyList-blackbackground").fadeOut();
    });
}
// Function to handle position removal
function confirmActionremovePartylist() {
    return new Promise(function (resolve) {
        $.confirm({
            title: 'Remove Specific PartyList Team',
            content: 'Are you sure you want to remove this Partylist Team?',
            autoClose: 'cancelAction|8000',
            buttons: {
                deleteUser: {
                    text: 'Remove Partylist',
                    action: function () {
                        resolve(true); // User confirmed, resolve with true
                    },
                    btnClass: 'btn-confirm',
                },
                cancelAction: {
                    text: 'Cancel',
                    action: function () {
                        resolve(false); // User cancelled, resolve with false
                    },
                    btnClass: 'btn-yes',
                },
            },
            titleClass: 'my-title-class',
        });
    });
}

function preparePartylistRemoval(event) {
    event.preventDefault(); // Prevent the link from being followed immediately
    const partylistId = event.currentTarget.dataset.id;
    confirmActionremovePartylist().then(function (confirmed) {
        if (confirmed) {
            removePartylist(partylistId);
        }
    });
}
function removePartylist(partylistId) {
    $.ajax({
        type: 'GET',
        url: `./back_end/remove_partylist.php?id=${partylistId}`,
        success: function () {
            removePartylistSuccess();
        },
        error: function () {
            // Handle error if needed
        },
    });
}

function removePartylistSuccess() {
    $(".ListofPartyList-background").fadeOut();
    $(".ListofPartyList-blackbackground").fadeOut();
    $.confirm({
        title: 'Removed Successfully',
        content: 'The specific Partylist Team is successfully removed.',
        autoClose: 'cancelAction|3000',
        buttons: {
            cancelAction: {
                text: 'Continue',
                action: function () {
                    window.location.href = './index.php';
                },
                btnClass: 'btn-yes',
            },
        },
        titleClass: 'my-title-class',
    });
}

var ADD_POSITION = false;
var ADD_PARTYLIST = false;

$("#myForm11").submit(function (event) {
    event.preventDefault();
    ADD_POSITION = true;
});
$("#myForm12").submit(function (event) {
    event.preventDefault();
    ADD_PARTYLIST = true;
});

if (ADD_POSITION) {
    addnowposition();
} else if (ADD_PARTYLIST) {
    addnowpartylist();
}

function addnowposition() {
    event.preventDefault();

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/checkpositionavailability.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'AlreadyExist') {
                    $.confirm({
                        title: 'Position Already Exist',
                        content: 'Make sure the position isn\'t already exist.',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".addposition_candidate-background").fadeOut();
                    $(".addposition_candidate-blackbackground").fadeOut();
                    $.confirm({
                        title: 'Position Successfully Added',
                        content: 'The position you entered is now added on candidate position list.',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm11").submit();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm11')));
}

function addnowpartylist() {
    event.preventDefault();

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './back_end/checkpartylistavailability.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'AlreadyExist') {
                    $.confirm({
                        title: 'PartyList Already Exist',
                        content: 'Make sure the PartyList Team isn\'t already exist.',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                } else {
                    $(".addposition_candidate-background").fadeOut();
                    $(".addposition_candidate-blackbackground").fadeOut();
                    $.confirm({
                        title: 'PartyList Team Successfully Added',
                        content: 'The PartyList you entered is now added on available partylist.',
                        autoClose: 'cancelAction|3000',
                        buttons: {
                            cancelAction: {
                                text: 'Continue',
                                action: function () {
                                    document.getElementById("myForm12").submit();
                                },
                                btnClass: 'btn-yes',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm12')));
}