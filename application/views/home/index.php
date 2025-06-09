<div class="container mt-4">
    <div class="row">
        <?php foreach ($berita as $item): ?>
        <div class="col-md-6">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary test-white">
                <strong><?= $item->judul; ?></strong>
        </div>
            <div class="card-body">
                <span class="bagde bg-info"><?= $item->kategori; ?> </span>
                <p class="mt-2"><em><?= $item->headline; ?></em></p>
                <p><?= word_limiter(strip_tags($item->isi_berita), 20); ?>...</p>
                <a href="<?= base_url('index.php/home_berita/detail/' . $item->idberita); ?>" class="btn btn-primary btn-block">Read More</a></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
