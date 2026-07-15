<?php
require_once __DIR__ . '/includes/init.php';

$pageTitle = 'Office Equipment Store';
$featuredProducts = [];
$categories = [];
$databaseReady = true;

try {
    $featuredStmt = db()->query(
        'SELECT p.*, c.name AS category_name, i.quantity AS stock
         FROM products p
         JOIN categories c ON c.id = p.category_id
         JOIN inventory i ON i.product_id = p.id
         WHERE p.status = "active"
         ORDER BY p.created_at DESC
         LIMIT 6'
    );
    $featuredProducts = $featuredStmt->fetchAll();

    $categoryStmt = db()->query(
        'SELECT c.*, COUNT(p.id) AS product_count
         FROM categories c
         LEFT JOIN products p ON p.category_id = c.id AND p.status = "active"
         WHERE c.status = "active"
         GROUP BY c.id
         ORDER BY c.name'
    );
    $categories = $categoryStmt->fetchAll();
} catch (Throwable $exception) {
    $databaseReady = false;
}

include __DIR__ . '/templates/header.php';
?>
<section class="hero">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <p class="text-uppercase fw-semibold text-accent mb-2"><?= e(APP_TAGLINE) ?></p>
                <h1 class="display-4 fw-bold mb-4"><?= e(APP_NAME) ?></h1>
                <p class="lead mb-4">Reliable office chairs, desks, tables, cabinets, shelves, and accessories for schools, offices, and growing teams.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-primary btn-lg" href="<?= url('store.php') ?>">Shop Products</a>
                    <a class="btn btn-light btn-lg" href="<?= url('about.php') ?>">Meet the Team</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <?php display_flash(); ?>
        <?php if (!$databaseReady): ?>
            <div class="alert alert-warning">Database is not ready yet. Import <strong>database/ecommerce_db.sql</strong> and update <strong>config/config.php</strong>.</div>
        <?php endif; ?>
        <div class="row align-items-center mb-4">
            <div class="col-lg-7">
                <h2 class="h3 fw-bold">Featured Office Equipment</h2>
                <p class="text-muted mb-0">Sample products are included so the buyer website and admin reports can be demonstrated immediately after database import.</p>
            </div>
            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                <a class="btn btn-outline-primary" href="<?= url('store.php') ?>">Browse Store</a>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-sm-6 col-lg-4">
                    <?php include __DIR__ . '/templates/product_card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-band py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5">
                <h2 class="h3 fw-bold">Categories for a complete workspace</h2>
                <p class="text-muted">PrimeDesk organizes products by practical office needs, making it simple for customers to search and for administrators to manage stock.</p>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    <?php foreach ($categories as $category): ?>
                        <div class="col-sm-6">
                            <a class="card text-decoration-none text-dark h-100" href="<?= url('store.php?category=' . (int) $category['id']) ?>">
                                <div class="card-body">
                                    <div class="fw-bold"><?= e($category['name']) ?></div>
                                    <div class="small text-muted"><?= (int) $category['product_count'] ?> products</div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h2 class="h3 fw-bold">Company Introduction</h2>
                <p><?= e(APP_NAME) ?> is a student-developed e-commerce system focused on office equipment. It demonstrates buyer registration, email verification, customer login, product browsing, shopping cart, checkout, simulated payment, order tracking, admin product control, inventory monitoring, and audit reporting.</p>
            </div>
            <div class="col-lg-5">
                <div class="card dashboard-stat">
                    <div class="card-body">
                        <h3 class="h5">Built for final defense</h3>
                        <p class="text-muted mb-0">The code is modular, commented, and organized to help each member explain the system flow, database relationships, and security controls.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/templates/footer.php'; ?>

