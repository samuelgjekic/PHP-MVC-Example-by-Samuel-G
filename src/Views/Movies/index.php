<div class="container mt-5">
    <h1 class="mb-4">Movie List</h1>
    <a href="/movies/add" class="btn btn-success mb-4">Add New Movie</a>
    
    <div class="row">
        <?php foreach ($movies as $movie): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie->getTitle(), ENT_QUOTES, 'UTF-8') ?></h5>
                        <p class="card-text"><?= htmlspecialchars($movie->getDesc(), ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="card-text"><small class="text-muted">Release Date: <?= htmlspecialchars($movie->getReleaseDate(), ENT_QUOTES, 'UTF-8') ?></small></p>
                        <p class="card-text"><small class="text-muted">Genre: <?= htmlspecialchars($movie->getGenre(), ENT_QUOTES, 'UTF-8') ?></small></p>
                        <a href="/movies/show/<?= htmlspecialchars($movie->getId(), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
