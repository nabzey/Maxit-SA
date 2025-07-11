<?php
// nav.php - Composant de navigation réutilisable

// Configuration des boutons de navigation
$navigationButtons = [
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

function renderNavigation($buttons = null, $currentPage = '') {
    global $navigationButtons;
    if ($buttons === null) {
        $buttons = $navigationButtons;
    }
    ?>
    <div class="w-full max-w-md mx-auto bg-black rounded-2xl overflow-hidden shadow-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <button class="text-white hover:text-maxit transition-colors">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <span class="text-white text-sm">Menu</span>
            </div>
            <div class="flex items-center gap-3">
                <button class="text-white hover:text-maxit transition-colors">
                    <i class="fa-solid fa-search text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Balance Section -->
        <div class="p-4">
            <div class="bg-[#191919] rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1 cursor-pointer" onclick="toggleSolde()">
                            <i id="eyeIcon" class="fa-solid fa-eye text-gray-400 text-sm"></i>
                            <span class="text-gray-400 text-xs">Voir l'historique</span>
                        </div>
                        <div id="montant" class="text-white text-lg font-medium" data-hidden="false">
                            75,000 <span class="text-sm font-normal">FCFA</span>
                        </div>
                    </div>
                    <button class="bg-maxit hover:bg-[#e0990c] text-white p-2 rounded-full transition-colors">
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons Grid -->
        <div class="px-4">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <?php foreach ($buttons as $button): ?>
                    <a href="<?= htmlspecialchars($button['url']) ?>" 
                       class="group bg-[#191919] hover:bg-[#252525] rounded-lg p-6 transition-all duration-300 transform hover:scale-105">
                        <div class="flex flex-col items-center text-center">
                            <div class="bg-maxit w-12 h-12 rounded-lg flex items-center justify-center mb-3 group-hover:bg-[#e0990c] transition-colors">
                                <i class="<?= $button['icon'] ?> text-white text-lg"></i>
                            </div>
                            <h3 class="text-white font-medium text-sm"><?= htmlspecialchars($button['title']) ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Historique Section -->
        <div class="px-4 mb-6">
            <div class="bg-[#191919] rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-medium text-sm">Historique</h3>
                    <button class="text-maxit hover:text-[#e0990c] transition-colors">
                        <span class="text-sm">Afficher tout</span>
                        <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
                    </button>
                </div>
                <div class="bg-gray-700 rounded-lg h-16 flex items-center justify-center">
                    <span class="text-gray-400 text-xs">Aucune transaction récente</span>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="bg-[#191919] border-t border-gray-800">
            <div class="flex justify-around items-center py-3">
                <button class="flex flex-col items-center gap-1 text-maxit">
                    <i class="fa-solid fa-home text-lg"></i>
                    <span class="text-xs">Accueil</span>
                </button>
                <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-exchange-alt text-lg"></i>
                    <span class="text-xs">Transfert</span>
                </button>
                <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-credit-card text-lg"></i>
                    <span class="text-xs">Paiement</span>
                </button>
                <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-ellipsis-h text-lg"></i>
                    <span class="text-xs">Autres</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Script JS pour masquer/afficher le montant -->
    <script>
        function toggleSolde() {
            const montantEl = document.getElementById('montant');
            const eyeIcon = document.getElementById('eyeIcon');

            if (montantEl.dataset.hidden === "true") {
                montantEl.innerHTML = '75,000 <span class="text-sm font-normal">FCFA</span>';
                montantEl.dataset.hidden = "false";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                montantEl.textContent = 'Solde ';
                montantEl.dataset.hidden = "true";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
    <?php
}
?>
