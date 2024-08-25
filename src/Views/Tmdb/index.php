<div class="container mt-5">
    <h1 class="mb-4">Användarfilmer</h1>
    <p>Denna lista är kopplad till TMDB api och hämtar dom senaste "trenderna".</p>
    <div class="row">
        <?php foreach ($movies as $movie): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie->getTitle(), ENT_QUOTES, 'UTF-8') ?></h5>
                        <p class="card-text"><?= htmlspecialchars($movie->getDesc(), ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="card-text"><small class="text-muted">Release Date: <?= htmlspecialchars($movie->getReleaseDate(), ENT_QUOTES, 'UTF-8') ?></small></p>
                        <form method="POST" action="/store">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($movie->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="title" value="<?= htmlspecialchars($movie->getTitle(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="description" value="<?= htmlspecialchars($movie->getDesc(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="release_date" value="<?= htmlspecialchars($movie->getReleaseDate(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="genre" value="<?= htmlspecialchars($movie->getGenre(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-primary">Lägg till i användarlista</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
