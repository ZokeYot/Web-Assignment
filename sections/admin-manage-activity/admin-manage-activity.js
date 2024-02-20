function processRequest(id, bool) {
    if (bool === 1) {
        window.location.href = '../admin-manage-activity/admin-manage-activity.php?id=' + id + '&reject=true';
    }
    else {
        window.location.href = '../admin-manage-activity/admin-manage-activity.php?id=' + id + '&reject=false';
    }

}

function viewDetail(id) {
    window.location.href = '../admin-manage-activity/admin-manage-activity.php?id=' + id
}

function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0
    );
}

function blurBackground() {
    const events = document.querySelectorAll('.activity-container');

    if (isInViewport(document.querySelector('.event-detail'))) {
        events.forEach(event => {
            event.classList.add('blur');
        })

    }
}

function removeBlur() {
    const detail = document.querySelector('.event-detail');
    const events = document.querySelectorAll('.activity-container');
    if (isInViewport(detail)) {
        document.addEventListener('click', (event) => {

            const target = event.target;
            if (target != detail) {
                detail.classList.add('gone')
                events.forEach(event => {
                    event.classList.remove('blur');
                })
            }
        })
    }
}

function stopPropagation() {
    const viewButtons = document.querySelectorAll('.view-more');
    const rejectButtons = document.querySelectorAll('.reject');

    viewButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
        })
    })

    rejectButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
        })
    })
}