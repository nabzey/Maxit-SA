<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Toutes les transactions - Maxit-SA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        .sidebar {
            min-height: 100vh;
        }
        .scrollable-list {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-black min-h-screen">
    <?php include __DIR__ . '/header.php'; ?>
    <!-- Sidebar Navigation -->
    <div id="sidebar" class="fixed left-0 top-0 h-full w-72 md:w-80 bg-[#191919] transform -translate-x-full transition-transform duration-300 ease-in-out z-40 border-r border-gray-800">
        <div class="p-4 md:p-6">
            <!-- Header Sidebar -->
            <div class="flex items-center justify-between mb-6 md:mb-8">
                <div class="flex items-center gap-3">
                    <div class="bg-maxit w-8 h-8 md:w-10 md:h-10 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-university text-white text-sm md:text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-white text-lg md:text-xl font-bold">Maxit-SA</h2>
                        <p class="text-gray-400 text-xs md:text-sm">Banque Mobile</p>
                    </div>
                </div>
                <button onclick="toggleSidebar()" class="text-white hover:text-maxit transition-colors md:hidden">
                    <i class="fa-solid fa-times text-lg"></i>
                </button>
            </div>
            <!-- Menu Principal -->
            <nav class="space-y-1 md:space-y-2">
                <h3 class="text-gray-400 text-xs md:text-sm font-medium uppercase mb-3 md:mb-4">Menu Principal</h3>
                <a href="/accueil" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-home text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Accueil</span>
                </a>
                <a href="/transaction" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-maxit bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-exchange-alt text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Transaction</span>
                </a>
                <a href="/paiement" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-credit-card text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Paiement</span>
                </a>
                <a href="/ajouter" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-plus text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Depot</span>
                </a>
                <a href="/recharge" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-mobile-alt text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Retrait</span>
                </a>
                <a href="/historique" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-history text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Historique</span>
                </a>
            </nav>
            <!-- Services -->
            <nav class="space-y-1 md:space-y-2 mt-6 md:mt-8">
                <h3 class="text-gray-400 text-xs md:text-sm font-medium uppercase mb-3 md:mb-4">Services</h3>
                <a href="/factures" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-file-invoice text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Paiement Factures</span>
                </a>
                <a href="/carte" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-credit-card text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Transfert</span>
                </a>
                <a href="/epargne" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-piggy-bank text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Solde</span>
                </a>
            </nav>
        </div>
    </div>
    <!-- Contenu principal -->
    <div class="flex-1 p-8">
        <a href="/acceuil" class="inline-flex items-center mb-6 px-5 py-2.5 bg-gradient-to-r from-maxit to-yellow-400 text-black font-bold rounded-full shadow hover:from-yellow-400 hover:to-maxit transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-maxit">
            <i class="fa fa-arrow-left mr-2"></i> Retour à l'accueil
        </a>
        <h2 class="text-white text-2xl font-bold mb-6 flex items-center gap-2">
            <i class="fa-solid fa-list text-maxit"></i> Toutes mes transactions
        </h2>
        <div class="scrollable-list bg-[#232323] rounded-xl shadow p-6">
            <?php if (!empty($transactions)) : ?>
                <ul class="divide-y divide-gray-700">
                    <?php foreach ($transactions as $transaction) : ?>
                        <li class="py-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-maxit w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-exchange-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="text-white font-semibold">
                                        <?= htmlspecialchars($transaction['type'] ?? $transaction['typeTransaction'] ?? '') ?>
                                    </p>
                                    <p class="text-gray-400 text-xs">
                                        <?= htmlspecialchars($transaction['date']) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-white font-bold">
                                    <?= number_format($transaction['montant'], 0, ',', ' ') . ' F CFA' ?>
                                </p>
                                <?php if (!empty($transaction['cible'])) : ?>
                                    <p class="text-gray-400 text-xs">
                                        <?= htmlspecialchars($transaction['cible']) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p class="text-gray-400">Aucune transaction trouvée.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
