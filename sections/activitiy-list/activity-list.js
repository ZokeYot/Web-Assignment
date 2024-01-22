function showDetails(activity_id) {
    alert(activity_id)
    window.location.href = "../participant-list/participant-list.php?id=" + activity_id;
}
function joinActivity(user_id, activity_id) {
    alert(`User_ID: ${user_id}\nActivity_ID: ${activity_id}`)
}
