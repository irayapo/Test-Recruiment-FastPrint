<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Programming Junior</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #1f1f1f;
            color: #f4f4f4;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-container {
            background-color: #2c3e50;
            padding: 40px 50px;
            border-radius: 15px;
            text-align: center;
            width: 90%;
            max-width: 650px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .welcome-container:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }

        .welcome-container h2 {
            font-size: 40px;
            color: #ecf0f1;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .welcome-container p {
            font-size: 18px;
            color: #ecf0f1;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .product-link {
            padding: 16px 40px;
            background-color: #e67e22;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .product-link:hover {
            background-color: #d35400;
            transform: scale(1.05);
        }

        .product-link:focus {
            outline: none;
        }

        @media screen and (max-width: 768px) {
            .welcome-container {
                padding: 30px 20px;
            }

            .welcome-container h2 {
                font-size: 32px;
            }

            .product-link {
                font-size: 18px;
                padding: 12px 30px;
            }
        }
    </style>
</head>

<body>

    <section>
        <div class="welcome-container">
            <h2>Selamat Datang di FastPrint!</h2>
            <p>Temukan produk berkualitas terbaik kami yang siap membantu kebutuhan
                percetakan Anda.</p>
            <a href="/Shop" class="product-link">Lihat Daftar Produk</a>
        </div>
    </section>

</body>

</html>
