<div class="item"> 
    <img src="<?= htmlspecialchars($item['image_url'] ?? '') ?>" alt="Image de l'annonce">
    <h3><?= htmlspecialchars($item['title']) ?></h3>
    <p><strong>Type de bien :</strong> <?= htmlspecialchars($item['property_type_name']) ?></p>
    <p><strong>Prix :</strong> <?= number_format($item['price'], 0, ',', ' ') ?> €</p>
    <p><strong>Ville :</strong> <?= htmlspecialchars($item['city']) ?></p>
    <p><strong>Description :</strong> <?= htmlspecialchars($item['description']) ?></p>
    <p><strong>Type de transaction :</strong> <?= htmlspecialchars($item['transaction_type_name']) ?></p>
    <a href="#" class="button-item">Contact</a>
    <a href="views/update.php?id=<?= urlencode($item['ID']) ?>" class="button-item">Update</a>
    <a href="#" class="button-item">Delete</a>
</div>
