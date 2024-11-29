document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("submitFeedback");
    const feedbackInput = document.getElementById("feedback");
    const dateDisplay = document.getElementById("dateDisplay");

    button.addEventListener("click", function () {
        const feedback = feedbackInput.value.trim();
        if (feedback) {
            const currentDate = new Date();
            dateDisplay.textContent = `Feedback submitted on: ${currentDate.toLocaleString()}`;
            feedbackInput.value = ""; // Clear the textarea

            // Prepare data to send to the PHP script
            const formData = new FormData();
            formData.append("feedback", feedback);

            // Send the data via fetch to the PHP script
            fetch("feedback.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    // Check if the response is OK
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    // Check for status and message in the response
                    if (data.status === "200") {
                        alert(data.message); // Success message
                    } else {
                        console.error("Error:", data.message); // Log any error message
                        alert(`Error: ${data.message}`); // Display error message
                    }
                })
                .catch((error) => {
                    // Handle any errors in the fetch process
                    console.error("Fetch error:", error);
                    alert("An error occurred while submitting feedback. Please try again later.");
                });
        } else {
            alert("Please enter your feedback before submitting.");
        }
    });
});
