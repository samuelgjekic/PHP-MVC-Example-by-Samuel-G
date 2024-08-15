<div class="container mt-5">
    <h1 class="mb-4">Add a New Movie</h1>
    
    <form action="/movies/store" method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="release_date">Release Date</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>

        <div class="form-group">
            <label for="genre_id">Genre</label>
            <select class="form-control" id="genre_id" name="genre_id" required>
                <option value="">Select Genre</option>
                <option value="1">Skräck</option>
                <option value="2">Action</option>
                <option value="3">Komedi</option>
                <option value="4">Äventyr</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>
</div>
