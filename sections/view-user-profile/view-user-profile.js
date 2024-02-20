function showDetail(user_id, activity_id) {
    window.location.href = "./view-user-profile.php?user_id=" + user_id + "&id=" + activity_id;
}


function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0
    );
}

function blurBackground() {
    const events = document.querySelectorAll('.event-container');

    if (isInViewport(document.querySelector('.event-detail'))) {
        events.forEach(event => {
            event.classList.add('blur');
        })

    }
}

function removeBlur() {
    const detail = document.querySelector('.event-detail');
    const participant = document.querySelector('.participant-list');
    const events = document.querySelectorAll('.event-container');
    const container = document.querySelector('.container');
    if (isInViewport(detail)) {
        document.addEventListener('click', (event) => {

            const target = event.target;
            if (target != detail) {
                detail.classList.add('gone')
                participant.classList.add('gone')
                container.classList.add('gone')
                events.forEach(event => {
                    event.classList.remove('blur');
                })
            }
        })
    }
}

function manageActivity(isAdmin) {
    if (isAdmin === "yes") {
        window.location.href = '../admin-manage-activity/admin-manage-activity.php'
    } else {
        window.location.href = '../manage-activity/manage-activity.php'
    }
}