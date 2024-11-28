document.addEventListener("DOMContentLoaded", () => {
    const submitFeedback = document.getElementById("submitFeedback");
    const feedbackInput = document.getElementById("feedback");
    const dateDisplay = document.getElementById("dateDisplay");

    submitFeedback.addEventListener("click", () => {
        const feedback = feedbackInput.value.trim();
        if (feedback) {
            const currentDate = new Date();
            dateDisplay.textContent = `Feedback submitted on: ${currentDate.toLocaleString()}`;
            feedbackInput.value = ""; // Clear the textarea
            alert("Thank you for your feedback!");
        } else {
            alert("Please enter your feedback before submitting.");
        }
    });
});
