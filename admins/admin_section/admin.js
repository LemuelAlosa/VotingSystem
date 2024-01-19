function addposition(){
    $(".addposition_candidate-background").fadeIn();
    $(".addposition_candidate-blackbackground").fadeIn();

    $(".addposition_candidate-background .addposition_candidate-footer h4").click(function () {
        $(".addposition_candidate-background").fadeOut();
        $(".addposition_candidate-blackbackground").fadeOut();
        document.getElementById("myForm0").reset();
    });

    $(".addposition_candidate-blackbackground").click(function () {
        $(".addposition_candidate-background").fadeOut();
        $(".addposition_candidate-blackbackground").fadeOut();
        document.getElementById("myForm0").reset();
    });
}

function addpartylist(){
    $(".addpartylist_candidate-background").fadeIn();
    $(".addpartylist_candidate-blackbackground").fadeIn();

    $(".addpartylist_candidate-background .addpartylist_candidate-footer h4").click(function () {
        $(".addpartylist_candidate-background").fadeOut();
        $(".addpartylist_candidate-blackbackground").fadeOut();
        document.getElementById("myForm0").reset();
    });

    $(".addpartylist_candidate-blackbackground").click(function () {
        $(".addpartylist_candidate-background").fadeOut();
        $(".addpartylist_candidate-blackbackground").fadeOut();
        document.getElementById("myForm0").reset();
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
                    btnClass: 'btn-cancel',
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

// Ito nmn is para sa logout
function Logout() {
    window.location.href = './back_end/admin_logout.php';
}

function addcandidate() {
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
                                btnClass: 'btn-cancel',
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
                        document.getElementById("myForm").reset();
                    });

                    $(".addcandidates-blackbackground").click(function () {
                        $(".addcandidates-background").fadeOut();
                        $(".addcandidates-blackbackground").fadeOut();
                        document.getElementById("myForm").reset();
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm')));
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
                    btnClass: 'btn-cancel',
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
                btnClass: 'btn-cancel',
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
                    btnClass: 'btn-cancel',
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
                btnClass: 'btn-cancel',
            },
        },
        titleClass: 'my-title-class',
    });
}

var ADD_POSITION = false;
var ADD_PARTYLIST = false;

$("#myForm0").submit(function (event) {
    event.preventDefault();
    ADD_POSITION = true;
});
$("#myForm1").submit(function (event) {
    event.preventDefault();
    ADD_PARTYLIST = true;
});

if (ADD_POSITION) {
    addnowposition();
} else if (ADD_PARTYLIST) {
    addnowpartylist();
}

function addnowposition() {
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
                                btnClass: 'btn-cancel',
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
                                    document.getElementById("myForm0").submit();
                                },
                                btnClass: 'btn-cancel',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm0')));
}

function addnowpartylist() {
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
                                btnClass: 'btn-cancel',
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
                                    document.getElementById("myForm1").submit();
                                },
                                btnClass: 'btn-cancel',
                            },
                        },
                        titleClass: 'my-title-class',
                    });
                }
            }
        }
    };
    xhr.send(new FormData(document.getElementById('myForm1')));
}