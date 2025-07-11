<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Maxit-SA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maxit: '#FCAD0E',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <?php if (isset($error)): ?>
        <p class="text-red-500 mb-4"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    
    <?php 
    // Inclure le composant de navigation
    include 'nave.html.php';
    
    // Optionnel : personnaliser les boutons pour cette page
    $customButtons = [
        [
            'icon' => 'fa-solid fa-exchange-alt',
            'title' => 'Transfert',
            'url' => '/transfert',
            'active' => false
        ],
        [
            'icon' => 'fa-solid fa-credit-card',
            'title' => 'Paiement',
            'url' => '/paiement',
            'active' => false
        ],
        [
            'icon' => 'fa-solid fa-plus',
            'title' => 'Ajouter',
            'url' => '/ajouter',
            'active' => false
        ]
    ];
    
    // Rendre la navigation
    renderNavigation($customButtons, 'home');
    ?>
</body>
</html>