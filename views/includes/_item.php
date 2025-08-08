<?php
$user_id = $_SESSION['user_id'] ?? null;
$listing_id = $item['ID'];

// Vérifie si le bien est déjà dans les favoris
$stmt = $pdo->prepare("SELECT 1 FROM favoris WHERE user_id = :user_id AND listing_id = :listing_id");
$stmt->execute([
    ':user_id' => $user_id,
    ':listing_id' => $listing_id
]);
$isFavorite = $stmt->fetch() ? true : false;

// Change le libellé et le message de confirmation
$button_text = $isFavorite ? "Retirer des favoris" : "Ajouter aux favoris";
$confirmation = $isFavorite ? "Retirer des favoris ?" : "Ajouter aux favoris ?";
?>

<div class="item"> 
    <img src="<?= htmlspecialchars($item['image_url'] ?? '') ?>" alt="Image de l'annonce">
    <h3><?= htmlspecialchars($item['title']) ?></h3>
    <p><strong>Type de bien :</strong> <?= htmlspecialchars($item['property_type_name']) ?></p>
    <p><strong>Prix :</strong> <?= number_format($item['price'], 0, ',', ' ') ?> €</p>
    <p><strong>Ville :</strong> <?= htmlspecialchars($item['city']) ?></p>
    <p><strong>Description :</strong> <?= htmlspecialchars($item['description']) ?></p>
    <p><strong>Type de transaction :</strong> <?= htmlspecialchars($item['transaction_type_name']) ?></p>
    <div class="button">
   <?php  if (isset($_SESSION['user_id'])): ?>
    <form action="views/favorite.php"  class="delete-form" method="POST" onsubmit="return confirm('<?= $confirmation ?>');">
    <input type="hidden" name="id" value="<?= htmlspecialchars($item['ID']) ?>">
    <button type="submit" class="button-item"><?= $button_text ?></button>
    </form>
    <?php endif; ?>
     <?php  if (isset($_SESSION['user_id'], $_SESSION['role']) &&
        ($item['user_id'] === $_SESSION['user_id'] || $_SESSION['role'] === 'admin')
        ): ?>
    <a href="views/update.php?id=<?= urlencode($item['ID']) ?>" class="button-item">Modifier</a>
    <form action="views/delete.php"  class="delete-form" method="POST" onsubmit="return confirm('Supprimer cette annonce ?');">
    <input type="hidden" name="id" value="<?= htmlspecialchars($item['ID']) ?>">
    <button type="submit" class="button-item-red">Supprimer</button>
    </form>
    <?php endif; ?>
    </div>
</div>
