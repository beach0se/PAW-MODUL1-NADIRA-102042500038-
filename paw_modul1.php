<?php

$products = [
    ["nama" => "Monitor LG 24 inch",       "kategori" => "Monitor",   "harga" => 15800000, "stok" => 4,  "gambar" => "Monitor LG 24 inch.jpg"],
    ["nama" => "Laptop MacBook Air",   "kategori" => "Laptop",    "harga" => 11500000, "stok" => 3,  "gambar" => "Laptop MacBook Air.jpg"],
    ["nama" => "Keyboard MCHOSE X75",   "kategori" => "Aksesoris", "harga" => 1650000,  "stok" => 10, "gambar" => "Mechanical Keyboard.jpg"],
    ["nama" => "Wireless Mouse Logitech",        "kategori" => "Aksesoris", "harga" => 750000,  "stok" => 0,  "gambar" => "Wireless Mouse Logitech.jpg"],
    ["nama" => "Ipad Gen 11",   "kategori" => "ipad",     "harga" => 7000000, "stok" => 5,  "gambar" => "Ipad Gen 11.jpg"],
    ["nama" => "powerbank ACMIC MAGBANK",      "kategori" => "Aksesoris",   "harga" => 350000,  "stok" => 15, "gambar" => "powerbank JETE A15.jpg"],
];


const BATAS_DISKON  = 1000000; 
const PERSEN_DISKON = 10;     
const FOLDER_GAMBAR = "images/";

function formatRupiah($angka)
{   
    return "Rp" . number_format($angka, 0, ",", ".");
}


function hitungHargaDiskon($harga)
{
    return (int) round($harga - ($harga * PERSEN_DISKON / 100));
}
$totalProduk = count($products);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store - Simple Tech Store</title>
    <style>
        :root {
            --bg: #fff8fb;
            --surface: #ffffff;
            --ink: #3b3552;
            --muted: #8a819c;
            --line: #f6dce8;
            --pink: #ffc9de;
            --pink-soft: #ffeaf3;
            --blue: #b5dcfd;
            --blue-hover: #9bcdf9;
            --blue-ink: #1f4a75;
            --yellow: #fff0a6;
            --yellow-soft: #fff8d1;
            --ok-bg: #d6ecff;
            --ok-text: #1f4a75;
            --off-bg: #ffd6e5;
            --off-text: #9b2c5a;
            --sale-bg: #fff0a6;
            --sale-text: #6e5400;
            --radius: 16px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.5;
        }

        .container { width: min(1100px, 100% - 2rem); margin-inline: auto; }

   
        .navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        .brand { font-weight: 700; font-size: 1.15rem; color: var(--ink); text-decoration: none; }
        .nav-links { display: flex; gap: 1.5rem; list-style: none; }
        .nav-links a { color: var(--muted); text-decoration: none; font-size: .9rem; }
        .nav-links a:hover { color: var(--ink); }

    
        .hero { padding: 2rem 0; }
        .hero-box {
            background: var(--pink);
            color: var(--ink);
            border-radius: 24px;
            padding: 4rem 3rem;
        }
        .hero-box small { color: #8a4a68; font-size: .8rem; }
        .hero-box h1 { font-size: clamp(2rem, 5vw, 3rem); margin: .5rem 0; letter-spacing: -.02em; }
        .hero-box p { color: #5b4a68; max-width: 46ch; margin-bottom: 1.5rem; }

        .btn-hero {
            display: inline-block;
            background: var(--yellow);
            color: var(--ink);
            padding: .7rem 1.4rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: .9rem;
            text-decoration: none;
        }

  
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 1rem;
            margin: 2.5rem 0 1.25rem;
        }
        .section-head h2 { font-size: 1.6rem; }
        .section-head small { color: var(--muted); font-size: .85rem; }
        .total {
            background: var(--yellow-soft);
            border: 1px solid var(--yellow);
            padding: .4rem .9rem;
            border-radius: 999px;
            font-size: .85rem;
        }

     
        .catalog {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.25rem;
            padding-bottom: 3rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }
        .card-img {
            aspect-ratio: 4 / 3;
            border-radius: 12px;
            overflow: hidden;
            background: var(--pink-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: .8rem;
        }
        .card-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .card-top { display: flex; justify-content: space-between; align-items: center; gap: .5rem; }
        .kategori { color: var(--muted); font-size: .8rem; }
        .card h3 { font-size: 1.1rem; }

        .badge {
            font-size: .72rem;
            font-weight: 600;
            padding: .15rem .55rem;
            border-radius: 999px;
        }
        .badge-diskon { background: var(--sale-bg); color: var(--sale-text); }
        .badge-ok     { background: var(--ok-bg);   color: var(--ok-text); }
        .badge-off    { background: var(--off-bg);  color: var(--off-text); }

        .harga { min-height: 3.2rem; padding-bottom: .75rem; border-bottom: 1px solid var(--line); }
        .harga-normal { display: block; color: var(--muted); font-size: .8rem; text-decoration: line-through; }
        .harga-akhir  { font-size: 1.2rem; }

        .stok-row { display: flex; justify-content: space-between; align-items: center; font-size: .9rem; }

        .btn-beli {
            margin-top: auto;
            width: 100%;
            padding: .7rem;
            border: 0;
            border-radius: 10px;
            background: var(--blue);
            color: var(--blue-ink);
            font-weight: 600;
            font-size: .85rem;
            cursor: pointer;
        }
        .btn-beli:hover { background: var(--blue-hover); }
        .btn-beli:disabled { background: var(--pink-soft); color: var(--muted); cursor: not-allowed; }
        .btn-beli:focus-visible, .btn-hero:focus-visible, a:focus-visible { outline: 3px solid #38bdf8; outline-offset: 2px; }

      
        .footer { background: var(--pink-soft); border-top: 1px solid var(--line); padding: 2rem 0; color: var(--muted); font-size: .9rem; }
        .footer strong { color: var(--ink); }

       
        @media (max-width: 600px) {
            .hero-box { padding: 2.5rem 1.5rem; }
            .section-head { flex-direction: column; align-items: flex-start; }
            .nav-links { gap: 1rem; }
        }
    </style>
</head>
<body>


    <header class="navbar">
        <div class="container">
            <a href="#home" class="brand">Nadira Store</a>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#produk">Products</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </div>
    </header>

    <main class="container">


        <section class="hero" id="home">
            <div class="hero-box">
                <small>Nadira Store</small>
                <h1>Simple Tech Store.</h1>
                <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
                <a href="#produk" class="btn-hero">Lihat Produk</a>
            </div>
        </section>

    
        <section id="produk">
            <div class="section-head">
                <div>
                    <small>Produk kami</small>
                    <h2>Katalog Produk</h2>
                </div>
                <span class="total">Total Produk: <strong><?= $totalProduk ?></strong></span>
            </div>


            <div class="catalog">
                <?php foreach ($products as $p): ?>
                    <?php
                        // Percabangan: diskon 10% untuk harga >= Rp1.000.000
                        $dapatDiskon = $p["harga"] >= BATAS_DISKON;
                        $hargaAkhir  = $dapatDiskon ? hitungHargaDiskon($p["harga"]) : $p["harga"];

                        // Cek apakah file gambar benar-benar ada di folder
                        $gambar     = $p["gambar"] ?? "";
                        $adaGambar  = $gambar !== "" && is_file(__DIR__ . "/" . FOLDER_GAMBAR . $gambar);
                    ?>
                    <article class="card">
                        <div class="card-img">
                            <?php if ($adaGambar): ?>
                                <img src="<?= FOLDER_GAMBAR . rawurlencode($gambar) ?>"
                                     alt="<?= htmlspecialchars($p["nama"]) ?>" loading="lazy">
                            <?php else: ?>
                                <span>Gambar belum tersedia</span>
                            <?php endif; ?>
                        </div>

                        <div class="card-top">
                            <span class="kategori"><?= htmlspecialchars($p["kategori"]) ?></span>
                            <?php if ($dapatDiskon): ?>
                                <span class="badge badge-diskon">Diskon <?= PERSEN_DISKON ?>%</span>
                            <?php endif; ?>
                        </div>

                        <h3><?= htmlspecialchars($p["nama"]) ?></h3>

                        <div class="harga">
                            <?php if ($dapatDiskon): ?>
                                <span class="harga-normal"><?= formatRupiah($p["harga"]) ?></span>
                            <?php endif; ?>
                            <strong class="harga-akhir"><?= formatRupiah($hargaAkhir) ?></strong>
                        </div>

                        <div class="stok-row">
                            <span>Stok: <?= $p["stok"] ?></span>
                            <?php if ($p["stok"] > 0): ?>
                                <span class="badge badge-ok">Tersedia</span>
                            <?php else: ?>
                                <span class="badge badge-off">Stok Habis</span>
                            <?php endif; ?>
                        </div>

                        <?php if ($p["stok"] > 0): ?>
                            <button type="button" class="btn-beli">Beli Sekarang</button>
                        <?php else: ?>
                            <button type="button" class="btn-beli" disabled>Stok Habis</button>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer class="footer" id="about">
        <div class="container">
            <p><strong>Nadira Store</strong> menjual berbagai perangkat dan aksesoris teknologi dengan harga terjangkau.</p>
            <p>&copy; <?= date("Y") ?> Nadira Store. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

</body>
</html> 