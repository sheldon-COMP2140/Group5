document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("myForm").addEventListener("submit", async function (event) {
        event.preventDefault(); // Prevent the default form submission
    
        const formData = new FormData(this); // Collect form data
        try {
            const response = await fetch(src="./generate_quote.php", { 
                method: "POST",
                body: formData,
            });
    
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
    
            const result = await response.json(); // Parse JSON response
            // alert(result);
            var price= result['Price'];

            document.getElementById("update").innerText = `The price calculated is: ${JSON.stringify(price)}`;
            



        } catch (error) {
            console.error("Error:", error);
            document.getElementById("update").innerText = `Error: ${error.message}`;
            // document.getElementById("update").innerText = `Error: Network response was not ok`;
        }
    });
});
