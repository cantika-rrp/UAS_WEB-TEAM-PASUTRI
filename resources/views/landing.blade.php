<?php

$products = [
    [
        "name" => "Snoopy by Mariana",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/9c/86/62/9c8662930b4ec2df4c8b5cb7e5b2d7a5.jpg"
    ],
    [
        "name" => "Cute dog by Silvie",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/f0/17/2b/f0172bdf5b6b6f24f29c4c62d8b8cfcb.jpg"
    ],
    [
        "name" => "Kiddo by Khansa",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/6b/84/6f/6b846f99f3fd4bca2ecad4acf680cfb5.jpg"
    ],
    [
        "name" => "Random retro by Ven",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/4b/98/f4/4b98f49544f7d17db6f95d20f24d4e89.jpg"
    ],
    [
        "name" => "Duckie by Cesya",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/3c/57/e2/3c57e281db4aaf91a9cdd8f04fbfdb67.jpg"
    ],
    [
        "name" => "Aesthetic cat by Cela",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/73/e3/c7/73e3c7d7d2f81d4f4cce4f4d06ef46b2.jpg"
    ],
    [
        "name" => "Ocean blue by Fairuz",
        "price" => 39000,
        "image" => "https://i.pinimg.com/736x/f6/34/9b/f6349b98b4cbf7ffb391d4b2666ebadc.jpg"
    ]
];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDC LAB</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: #dcdcdc;
            font-family: Poppins, sans-serif;
        }

        .line-bg {
            background-image:
                repeating-linear-gradient(
                    0deg,
                    transparent 0px,
                    transparent 36px,
                    rgba(255,0,0,0.25) 38px,
                    transparent 40px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent 0px,
                    transparent 60px,
                    rgba(0,0,255,0.08) 61px
                );
        }

        .title-font {
            letter-spacing: 10px;
        }
    </style>
</head>

<body>

    <div class="max-w-[2000px] mx-auto bg-[#f6f6f6] min-h-screen">

        <!-- NAVBAR -->
       <nav class="w-full bg-white px-4 py-3 flex items-center justify-between shadow-sm">

    <!-- LOGO -->
    <div class="flex items-center gap-4">

        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-pink-500 via-yellow-400 to-blue-500">
        </div>

        <h1 class="text-4xl font-black text-[#5c0000] tracking-wide">
            EDC LAB
        </h1>

    </div>

    <!-- SEARCH -->
    <div class="flex-1 flex justify-centre px-80">

        <div class="relative w-full max-w-[400px]">

            <input
                type="text"
                placeholder="Cari desain..."
                class="w-full border-2 border-black rounded-full py-3 pl-14 pr-6 text-lg outline-none"
            >

                <i class="fa-solid fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>

        </div>

    </div>

    <!-- ICON -->
    <div class="flex items-center gap-5 text-4xl">

        <a href="#">
            <i class="fa-solid fa-bag-shopping hover:text-pink-600 transition"></i>
        </a>

        <a href="#">
            <i class="fa-solid fa-star hover:text-pink-600 transition"></i>
        </a>

        <a href="#">
            <i class="fa-solid fa-circle-user hover:text-pink-600 transition"></i>
        </a>

    </div>

</nav>

        <!-- HERO -->
        <section class="line-bg py-28 text-center">

            <h2 class="text-5xl title-font font-poppins font-bold mb-5">
                TUNJUKKAN KREATIFITASMU
            </h2>

            <button class="bg-[#bf365c] hover:bg-[#a92d50] text-white px-20 py-3 rounded-full text-2xl font-bold">
                Mulai mendesain
            </button>

        </section>

        <!-- KATALOG -->
        <section class="px-10 py-12">

            <div class="flex justify-between items-center mb-10">

                <h2 class="text-3xl font-semibold">
                    Katalog Desain
                </h2>

                <i class="fa-solid fa-angles-right text-4xl"></i>

            </div>

            <div class="flex gap-10 overflow-x-auto pb-4">

                <?php foreach($products as $product): ?>

                    <div class="min-w-[150px] text-center">

                        <div class="bg-white rounded-[30px] shadow-md p-2 mb-4">

                            <img
                                src="<?= $product['image']; ?>"
                                alt="<?= $product['name']; ?>"
                                class="w-full h-[260px] object-cover rounded-[25px]"
                            >

                        </div>

                        <h3 class="text-xl font-medium">
                            <?= $product['name']; ?>
                        </h3>

                        <p class="text-xl mt-1">
                            Rp 39.000
                        </p>

                    </div>

                <?php endforeach; ?>

            </div>

        </section>

    </div>

</body>
</html>