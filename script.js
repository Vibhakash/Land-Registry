document.getElementById('loginForm').addEventListener('submit', function(event) {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email === "" || password === "") {
        alert("Please fill in all fields.");
        event.preventDefault();
    }
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (name === "" || email === "" || password === "") {
        alert("Please fill in all fields.");
        event.preventDefault();
    }
});

function markAvailable() {
    alert("hii")
    $.ajax({
        url: 'avail.php',
        type: 'POST',
        data: { action: 'mark_available' },
        success: function(response) {
            alert('Land availability status has been updated.');
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Error occurred: ' + error);
        }
    });
}

function markUnavailable() {
    $.ajax({
        url: 'avail.php',
        type: 'POST',
        data: { action: 'mark_unavailable' },
        success: function(response) {
            alert('Land availability status has been updated.');
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Error occurred: ' + error);
        }
    });
}