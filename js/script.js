// script.js - Basic JavaScript functionality

// Function to display the current date and time in UTC
function displayCurrentDateTime() {
    const now = new Date();
    const utcDate = now.toUTCString();
    console.log(`Current Date and Time (UTC): ${utcDate}`);
}

displayCurrentDateTime();