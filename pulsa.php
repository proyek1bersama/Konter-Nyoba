<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beli Pulsa - Konter Kita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .nominal-card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .nominal-card:hover {
            transform: scale(1.05);
        }

        .nominal-card.active {
            border: 2px solid #0d6efd;
            background-color: #e3f2fd;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <h2 class="text-center mb-4">Beli Pulsa</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nomor = htmlspecialchars($_POST["nomor"]);
            $nominal = htmlspecialchars($_POST["nominal"]);
            if (empty($nomor) || empty($nominal)) {
                echo "<div class='alert alert-warning'>Harap isi nomor HP dan pilih nominal pulsa.</div>";
            } else {
                echo "<div class='alert alert-success'>Pesanan pulsa Rp $nominal untuk nomor $nomor berhasil diproses!</div>";
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="nomor" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="nomor" name="nomor" placeholder="08xxxxxxxxxx">
            </div>

            <h5 class="mt-4 mb-3">Pilih Nominal Pulsa:</h5>
            <input type="hidden" id="nominal" name="nominal" />

            <div class="row g-3">
                <?php
                $nominals = ["5000", "10000", "20000", "50000", "100000"];
                foreach ($nominals as $value) {
                    echo "
                    <div class='col-6 col-md-3'>
                        <div class='card nominal-card text-center p-3' onclick=\"selectNominal(this, '$value')\">Rp " . number_format($value, 0, ',', '.') . "</div>
                    </div>";
                }
                ?>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary">Beli Sekarang</button>
            </div>
        </form>
    </div>

    <script>
        let selectedCard = null;

        function selectNominal(card, nominal) {
            if (selectedCard) {
                selectedCard.classList.remove("active");
            }
            selectedCard = card;
            selectedCard.classList.add("active");

            document.getElementById("nominal").value = nominal;
        }
    </script>
</body>

</html>
