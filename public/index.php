<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Cart;
use App\Discount;
use App\Validator;

$cart = new Cart();
$discount = new Discount();
$validator = new Validator();

$errors = [];
$result = null;

$productName = $_POST['product_name'] ?? '';
$price = $_POST['price'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$customerName = $_POST['customer_name'] ?? '';
$email = $_POST['email'] ?? '';
$discountPercent = $_POST['discount_percent'] ?? '0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $priceFloat = (float) $price;
    $quantityInt = (int) $quantity;
    $discountInt = (int) $discountPercent;

    if (!$validator->isNotEmpty($productName)) {
        $errors[] = 'Preces nosaukums nedrīkst būt tukšs.';
    }

    if ($priceFloat < 0) {
        $errors[] = 'Cena nedrīkst būt negatīva.';
    }

    if (!$validator->isValidQuantity($quantityInt)) {
        $errors[] = 'Daudzumam ir jābūt lielākam par 0.';
    }

    if (!$validator->isNotEmpty($customerName)) {
        $errors[] = 'Pircēja vārds nedrīkst būt tukšs.';
    }

    if (!$validator->isValidEmail($email)) {
        $errors[] = 'E-pasta adrese nav derīga.';
    }

    if (empty($errors)) {
        $cart->addItem($productName, $priceFloat, $quantityInt);

        $total = $cart->getTotal();
        $finalTotal = $discount->applyDiscount($total, $discountInt);

        $result = [
            'items' => $cart->getItems(),
            'item_count' => $cart->getItemCount(),
            'total' => $total,
            'discount_percent' => $discountInt,
            'final_total' => $finalTotal,
            'customer_name' => $customerName,
            'email' => $email
        ];
    }
}

?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>SimpleShop — QA testēšanai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<main class="page">
    <section class="card">
        <h1>SimpleShop</h1>
        <p class="subtitle">
            Mini projekts programmu testēšanas darbam.
        </p>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <strong>Kļūdas:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($result): ?>
            <div class="alert alert-success">
                <strong>Pasūtījums pieņemts!</strong>
                <p>Gala summa: <strong><?= number_format($result['final_total'], 2) ?> EUR</strong></p>
            </div>
        <?php endif; ?>

        <form method="POST" class="shop-form">
            <div class="form-grid">
                <label>
                    Preces nosaukums
                    <input type="text" name="product_name" value="<?= htmlspecialchars($productName) ?>" placeholder="Piemēram: Klaviatūra">
                </label>

                <label>
                    Cena
                    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars((string)$price) ?>" placeholder="Piemēram: 25.99">
                </label>

                <label>
                    Daudzums
                    <input type="number" name="quantity" value="<?= htmlspecialchars((string)$quantity) ?>" placeholder="Piemēram: 2">
                </label>

                <label>
                    Atlaide %
                    <input type="number" name="discount_percent" value="<?= htmlspecialchars((string)$discountPercent) ?>" placeholder="Piemēram: 20">
                </label>

                <label>
                    Pircēja vārds
                    <input type="text" name="customer_name" value="<?= htmlspecialchars($customerName) ?>" placeholder="Piemēram: Jānis">
                </label>

                <label>
                    E-pasts
                    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="test@example.com">
                </label>
            </div>

            <button type="submit">Pievienot un aprēķināt</button>
        </form>
    </section>

    <?php if ($result): ?>
        <section class="card">
            <h2>Pasūtījuma rezultāts</h2>

            <table>
                <tr>
                    <th>Rādītājs</th>
                    <th>Vērtība</th>
                </tr>
                <tr>
                    <td>Preču skaits</td>
                    <td><?= htmlspecialchars((string)$result['item_count']) ?></td>
                </tr>
                <tr>
                    <td>Kopējā summa</td>
                    <td><?= number_format($result['total'], 2) ?> EUR</td>
                </tr>
                <tr>
                    <td>Atlaide</td>
                    <td><?= htmlspecialchars((string)$result['discount_percent']) ?>%</td>
                </tr>
                <tr>
                    <td>Gala summa</td>
                    <td><?= number_format($result['final_total'], 2) ?> EUR</td>
                </tr>
                <tr>
                    <td>Pircējs</td>
                    <td><?= htmlspecialchars($result['customer_name']) ?></td>
                </tr>
                <tr>
                    <td>E-pasts</td>
                    <td><?= htmlspecialchars($result['email']) ?></td>
                </tr>
            </table>
        </section>
    <?php endif; ?>

    <section class="card info">
        <h2>Skolēna uzdevumi</h2>

        <ol>
            <li>Pārbaudi datus ar <code>var_dump()</code>, <code>dump()</code> un <code>dd()</code>.</li>
            <li>Izveido Unit testus klasēm <code>Cart</code>, <code>Discount</code> un <code>Validator</code>.</li>
            <li>Veic QA testēšanu pārlūkprogrammā.</li>
            <li>Atrodi un apraksti kļūdas.</li>
            <li>Izlabo kļūdas kodā.</li>
            <li>Atkārtoti palaid Unit testus un QA testēšanu.</li>
        </ol>
    </section>
</main>

</body>
</html>
