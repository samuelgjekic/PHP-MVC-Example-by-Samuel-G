<div class="container mt-5">
    <h1 class="mb-4">Användarfilmer</h1>
    <p>Denna lista är skapad av användare och är endast kopplad mot en databas, alltså inte en API. Användare kan dock hämta data
        från API:n för att lägga till den valda filmen i listan.
    </p>
    <a href="/add" class="btn btn-success mb-4">Lägg till ny Film</a>
    <a href="/api/list" class="btn btn-success mb-4">Trendande filmer från API</a>

    
    <div class="row">
        <?php foreach ($movies as $movie): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie->getTitle(), ENT_QUOTES, 'UTF-8') ?></h5>
                        <p class="card-text"><?= htmlspecialchars($movie->getDesc(), ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="card-text"><small class="text-muted">Release Date: <?= htmlspecialchars($movie->getReleaseDate(), ENT_QUOTES, 'UTF-8') ?></small></p>
                        <p class="card-text"><small class="text-muted">Genre: <?= htmlspecialchars($movie->getGenre(), ENT_QUOTES, 'UTF-8') ?></small></p>
                        <a href="/delete/<?= htmlspecialchars($movie->getId(), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

