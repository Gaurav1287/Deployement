<script>
    document.addEventListener("DOMContentLoaded", function() {
        const carContainer = document.getElementById('car-services');
        const bikeContainer = document.getElementById('bike-services');
        const carCards = Array.from(carContainer.children); // Convert NodeList to Array
        const bikeCards = Array.from(bikeContainer.children);

        let carIndex = 0;
        let bikeIndex = 0;

        function swapCards() {
            if (carIndex < carCards.length && bikeIndex < bikeCards.length) {
                const carCard = carCards[carIndex]; // Get the current car card
                const bikeCard = bikeCards[bikeIndex]; // Get the current bike card
                
                carContainer.appendChild(bikeCard); // Move the bike card to the end of car container
                bikeContainer.appendChild(carCard); // Move the car card to the end of bike container

                // Update indices for the next swap
                carIndex = (carIndex + 1) % carCards.length; // Move to the next car card, loop if at the end
                bikeIndex = (bikeIndex + 1) % bikeCards.length; // Move to the next bike card, loop if at the end
            }
        }

        // Swap cards every 2 seconds
        setInterval(swapCards, 2000); // Adjust the interval as needed
    });
</script>
