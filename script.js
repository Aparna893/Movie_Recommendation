document.addEventListener("DOMContentLoaded", function () {
    const movieList = document.getElementById("movie-list");

    // Fetch movies from the backend
    fetch("php/get_movies.php")
        .then(response => response.json())
        .then(movies => {
            movieList.innerHTML = "";
            movies.forEach(movie => {
                const card = document.createElement("div");
                card.className = "movie-card";

                card.innerHTML = `
                    <img src="images/${movie.poster}" alt="${movie.title}">
                    <h3>${movie.title}</h3>
                    <p><strong>Genre:</strong> ${movie.genre}</p>
                    <p><strong>Year:</strong> ${movie.release_year}</p>
                    <p>${movie.description}</p>

                    <button class="favorite-btn" data-id="${movie.id}">❤️ Favorite</button>

                    <form class="review-form" data-id="${movie.id}">
                        <select name="rating">
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                        <input type="text" name="comment" placeholder="Your review..." />
                        <button type="submit">Submit</button>
                    </form>
                `;

                movieList.appendChild(card);
            });

            // Favorite button logic
            document.querySelectorAll(".favorite-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const movieId = this.getAttribute("data-id");

                    fetch("php/add_favorite.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `movie_id=${movieId}`,
                    })
                        .then(response => response.text())
                        .then(msg => alert(msg));
                });
            });

            // Review form logic
            document.querySelectorAll(".review-form").forEach(form => {
                form.addEventListener("submit", function (e) {
                    e.preventDefault();

                    const movieId = this.getAttribute("data-id");
                    const rating = this.querySelector("select[name='rating']").value;
                    const comment = this.querySelector("input[name='comment']").value;

                    const formData = new URLSearchParams();
                    formData.append("movie_id", movieId);
                    formData.append("rating", rating);
                    formData.append("comment", comment); // ✅ this must match the DB column

                    fetch("php/submit_review.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: formData.toString(),
                    })
                        .then(response => response.text())
                        .then(msg => alert(msg));
                });
            });
        });
});
