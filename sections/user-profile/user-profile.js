function showDetail(activity_id) {
    window.location.href = "./user-profile.php?id=" + activity_id;
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
            console.log(target != detail)
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

function logout() {
    const logoutButton = document.querySelector('.logout');
    logoutButton.classList.remove('gone');
    logoutButton.classList.add('reminder')
    document.getElementById('logout-yes').addEventListener('click', () => {
        window.location.href = '../../php/logout.php';
    })

    document.getElementById('logout-no').addEventListener('click', () => {
        logoutButton.classList.remove('reminder');
        logoutButton.classList.add('gone');

    })
}


function manageActivity(isAdmin) {
    if (isAdmin === "yes") {
        window.location.href = '../admin-manage-activity/admin-manage-activity.php'
    } else {
        window.location.href = '../manage-activity/manage-activity.php'
    }
}
