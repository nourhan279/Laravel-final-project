async function checkWhatsAppNumber() {
    const number = document.getElementById("whatsapp").value;
    const cleanedNumber = number.replace(/^\+/, "");
    console.log("Cleaned Number:", cleanedNumber);

    const cachedResult = localStorage.getItem(cleanedNumber);

    if (cachedResult) {
        const parsedResult = JSON.parse(cachedResult);
        console.log("Using cached result:", parsedResult);

        if (parsedResult.status === "valid") {
            alert(" This is a valid WhatsApp number! (from cache)");
        } else {
            alert("Invalid WhatsApp number. (from cache)");
        }
        return parsedResult;
    } else {
        const url =
            "https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItWithToken";
        const options = {
            method: "POST",
            headers: {
                "x-rapidapi-key":
                    "72b05b35a8msha4db4f59d8a7cd2p1fcadfjsn600ea600b86f",
                "x-rapidapi-host": "whatsapp-number-validator3.p.rapidapi.com",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                phone_number: cleanedNumber,
            }),
        };

        try {
            const response = await fetch(url, options);
            const result = await response.json();
            console.log(result);

            localStorage.setItem(cleanedNumber, JSON.stringify(result));

            if (result.status === "valid") {
                alert("This is a valid WhatsApp number!");
            } else {
                alert("Invalid WhatsApp number.");
            }

            return result;
        } catch (error) {
            console.error("Error:", error);
            alert("There was an error while validating the number.");
        }
    }
}
