<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Navigation - Maxit-SA</title>
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
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu {
            animation: fadeIn 0.2s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        button:focus, a:focus {
            outline: 2px solid #FCAD0E;
            outline-offset: 2px;
        }
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @media (max-width: 768px) {
            .dropdown-menu {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: white;
                border-radius: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                overflow-y: auto;
                padding: 1rem;
            }
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }
        
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: modalFadeIn 0.3s ease-out;
        }
        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .modal-content {
            background: #2a2a2a;
            padding: 40px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            transform: scale(0.7);
            animation: modalSlideIn 0.3s ease-out forwards;
        }
        
        @keyframes modalSlideIn {
            to {
                transform: scale(1);
            }
        }
        
        .modal-title {
            color: #ff6b35;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .modal-input {
            width: 100%;
            padding: 18px 20px;
            background: transparent;
            border: 2px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }
        
        .modal-input::placeholder {
            color: #666;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }
        
        .modal-input:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
            transform: translateY(-2px);
        }
        
        .modal-submit {
            width: 100%;
            padding: 18px;
            background: transparent;
            border: 2px solid #ff6b35;
            border-radius: 50px;
            color: #ff6b35;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }
        
        .modal-submit:hover {
            background: #ff6b35;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }
        
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            color: #999;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .modal-close:hover {
            color: #ff6b35;
        }
    </style>
</head>
<body class="bg-black min-h-screen">
    <!-- Header Navigation -->
    <div class="w-full bg-black border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between p-4 md:p-6">
                <!-- Menu gauche -->
                <div class="flex items-center gap-2 md:gap-4">
                    <button class="text-white hover:text-maxit transition-colors" onclick="toggleSidebar()">
                        <i class="fa-solid fa-bars text-lg md:text-xl"></i>
                    </button>
                    <span class="text-white text-sm md:text-lg font-medium hidden sm:block">Menu</span>
                </div>
                
                <!-- Logo/Nom du client avec dropdown -->
                <div class="relative dropdown">
                    <button class="flex items-center gap-2 md:gap-3 text-white text-lg md:text-2xl font-bold focus:outline-none hover:text-maxit transition-colors">
                        <span class="hidden sm:block">Maxit-SA</span>
                        <span class="sm:hidden">Maxit</span>
                        <i class="fa-solid fa-chevron-down text-sm md:text-lg"></i>
                    </button>

                    <div class="dropdown-menu absolute right-0 mt-2 w-72 md:w-80 bg-white rounded-lg shadow-xl z-20 hidden border">

    <!-- Bouton fermer pour mobile -->
    <div class="md:hidden flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-semibold">Mon Compte</h3>
        <button onclick="closeDropdown()" class="text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-times text-xl"></i>
        </button>
    </div>

    <div class="px-4 md:px-6 py-3 md:py-4 text-sm md:text-base text-gray-700 border-b border-gray-200">
        <div class="flex items-center gap-2 md:gap-3 mb-2">
            <i class="fa-solid fa-user text-maxit text-base md:text-lg"></i>
            <span class="font-semibold">Compte Principal</span>
        </div>
    </div>

    <!-- ✅ Section ajoutée pour afficher les comptes existants -->
    <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
        <form method="POST" action="/activer-compte">
            <label for="compte_id" class="text-gray-600 text-sm mb-2 block">Choisissez un compte :</label>
            <select name="compte_id" id="compte_id" class="w-full p-2 border rounded">
                <?php if (!empty($comptes)): ?>
                    <?php foreach ($comptes as $compte): ?>
                        <option value="<?= $compte['id'] ?>" <?= ($compte['estprincipale'] ? 'selected' : '') ?>>
                            <?= strtoupper($compte['typecompte']) ?> - <?= $compte['numerotelephone'] ?> (<?= number_format($compte['solde'], 0, ',', ' ') ?> FCFA)
                            <?= ($compte['estprincipale'] ? ' ★' : '') ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Aucun compte disponible</option>
                <?php endif; ?>
            </select>
            <button type="submit" class="mt-3 w-full bg-maxit text-white py-2 rounded hover:bg-opacity-90 transition">
                🎯 Définir comme compte principal
            </button>
        </form>
    </div>

    <button onclick="openModal()" class="w-full flex items-center gap-2 md:gap-3 px-4 md:px-6 py-3 md:py-4 text-sm md:text-base text-gray-700 hover:bg-gray-50 transition-colors">
        <i class="fa-solid fa-plus text-maxit"></i>
        Créer un compte secondaire
    </button>

    <a href="/logout" class="flex items-center gap-2 md:gap-3 px-4 md:px-6 py-3 md:py-4 text-sm md:text-base text-red-600 hover:bg-red-50 transition-colors border-t border-gray-200">
        <i class="fa-solid fa-sign-out-alt text-red-600"></i>
        Déconnexion
    </a>
</div>

                </div>
                
                <!-- Actions droite -->
                <div class="flex items-center gap-2 md:gap-4">
                    <button class="text-white hover:text-maxit transition-colors relative" onclick="toggleNotifications()">
                        <i class="fa-solid fa-bell text-lg md:text-xl"></i>
                        <span class="absolute -top-1 -right-1 md:-top-2 md:-right-2 bg-red-500 text-white text-xs rounded-full w-4 h-4 md:w-5 md:h-5 flex items-center justify-center">3</span>
                    </button>
                    <button class="text-white hover:text-maxit transition-colors hidden sm:block">
                        <i class="fa-solid fa-search text-lg md:text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

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
                
                <a href="/accueil" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-maxit bg-[#252525] rounded-lg transition-colors">
                    <i class="fa-solid fa-home text-base md:text-lg"></i>
                    <span class="text-sm md:text-base">Accueil</span>
                </a>
                
                <a href="/transaction" class="flex items-center gap-3 px-3 md:px-4 py-2 md:py-3 text-white hover:text-maxit hover:bg-[#252525] rounded-lg transition-colors">
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

    <!-- Navigation bas (Mobile) -->
    <div class="fixed bottom-0 left-0 right-0 bg-[#191919] border-t border-gray-800 md:hidden z-40">
        <div class="flex justify-around items-center py-2">
            <a href="/accueil" class="flex flex-col items-center gap-1 text-maxit py-2">
                <i class="fa-solid fa-home text-lg"></i>
                <span class="text-xs">Accueil</span>
            </a>
            <a href="/transfert" class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors py-2">
                <i class="fa-solid fa-exchange-alt text-lg"></i>
                <span class="text-xs">Transfert</span>
            </a>
            <a href="/paiement" class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors py-2">
                <i class="fa-solid fa-credit-card text-lg"></i>
                <span class="text-xs">Paiement</span>
            </a>
            <a href="/historique" class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors py-2">
                <i class="fa-solid fa-history text-lg"></i>
                <span class="text-xs">Historique</span>
            </a>
            <a href="/autres" class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition-colors py-2">
                <i class="fa-solid fa-ellipsis-h text-lg"></i>
                <span class="text-xs">Autres</span>
            </a>
        </div>
    </div>

    <!-- Panel de notifications -->
    <div id="notifications" class="fixed top-16 right-4 w-80 bg-white rounded-lg shadow-xl z-50 hidden max-h-96 overflow-y-auto">
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                <button onclick="toggleNotifications()" class="text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-4 space-y-3">
            <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-lg">
                <div class="bg-blue-500 w-8 h-8 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-info text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-800">Nouveau transfert reçu</p>
                    <p class="text-xs text-gray-600">Il y a 2 minutes</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-3 bg-green-50 rounded-lg">
                <div class="bg-green-500 w-8 h-8 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-check text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-800">Paiement confirmé</p>
                    <p class="text-xs text-gray-600">Il y a 1 heure</p>
                </div>
            </div>
            <div class="flex items-start gap-3 p-3 bg-yellow-50 rounded-lg">
                <div class="bg-yellow-500 w-8 h-8 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-exclamation text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-800">Solde faible</p>
                    <p class="text-xs text-gray-600">Il y a 3 heures</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour compte secondaire -->
    <div id="modalCompteSecondaire" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">
                <i class="fa-solid fa-times"></i>
            </button>
            
            <h2 class="modal-title">Compte Secondaire</h2>
            
            <form method="post" action="/pageacceuil" id="compteSecondaireForm">
                <input 
                    type="tel" 
                    name="telephone" 
                    class="modal-input" 
                    placeholder="Numéro de téléphone" 
                    required
                    id="telephoneInput"
                >

                <input 
                    type="number" 
                    name="solde" 
                    class="modal-input" 
                    placeholder="Solde initial" 
                    min="0" 
                    step="0.01"
                    required
                >

                <button type="submit" class="modal-submit" id="submitBtn">
                    Créer le compte
                </button>
            </form>
        </div>
    </div>

    <!-- Affichage du solde dans le body principal -->
    <div class="max-w-3xl mx-auto mt-10 mb-8 p-6 bg-[#232323] rounded-xl shadow flex items-center gap-6">
        <div class="bg-maxit w-14 h-14 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-wallet text-white text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-400 text-sm mb-1">Votre solde actuel</p>
            <p class="text-white text-3xl font-bold">
                <?php echo isset($solde) ? number_format($solde, 0, ',', ' ') . ' F CFA' : '---'; ?>
            </p>
        </div>
    </div>
    
    <!-- Liste des transactions récentes avec pagination -->
    <div class="max-w-3xl mx-auto mb-8 p-6 bg-[#232323] rounded-xl shadow">
        <h2 class="text-white text-xl font-bold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-list text-maxit"></i> Transactions récentes
        </h2>
        <?php
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 4;
        $totalTransactions = !empty($transactions) ? count($transactions) : 0;
        $totalPages = $totalTransactions > 0 ? ceil($totalTransactions / $perPage) : 1;
        $start = ($page - 1) * $perPage;
        $transactionsToShow = $totalTransactions > 0 ? array_slice($transactions, $start, $perPage) : [];
        ?>
        <?php if (!empty($transactionsToShow)) : ?>
            <ul class="divide-y divide-gray-700">
                <?php foreach ($transactionsToShow as $transaction) : ?>
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-maxit w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-exchange-alt text-white"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold">
                                    <?php echo htmlspecialchars($transaction['type']); ?>
                                </p>
                                <p class="text-gray-400 text-xs">
                                    <?php echo htmlspecialchars($transaction['date']); ?>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-white font-bold">
                                <?php echo number_format($transaction['montant'], 0, ',', ' ') . ' F CFA'; ?>
                            </p>
                            <?php if (!empty($transaction['cible'])) : ?>
                                <p class="text-gray-400 text-xs">
                                    <?php echo htmlspecialchars($transaction['cible']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Pagination -->
            <div class="flex justify-center mt-4 gap-2">
                <?php if ($page > 1) : ?>
                    <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-maxit">&lt;</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?= $i ?>" class="px-3 py-1 rounded <?= $i == $page ? 'bg-maxit text-white' : 'bg-gray-700 text-white hover:bg-maxit' ?>"> <?= $i ?> </a>
                <?php endfor; ?>
                <?php if ($page < $totalPages) : ?>
                    <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-maxit">&gt;</a>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400">Aucune transaction récente.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function toggleNotifications() {
            const notifications = document.getElementById('notifications');
            notifications.classList.toggle('hidden');
        }

        function closeDropdown() {
            const dropdown = document.querySelector('.dropdown-menu');
            dropdown.classList.add('hidden');
        }

        // Fonctions pour le modal
        function openModal() {
            const modal = document.getElementById('modalCompteSecondaire');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
            closeDropdown(); // Fermer le dropdown quand on ouvre le modal
        }

        function closeModal() {
            const modal = document.getElementById('modalCompteSecondaire');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
            
            // Reset form
            document.getElementById('compteSecondaireForm').reset();
            document.getElementById('submitBtn').textContent = 'Créer le compte';
            document.getElementById('submitBtn').disabled = false;
        }

        // Fermer le modal en cliquant sur l'arrière-plan
        document.getElementById('modalCompteSecondaire').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Formatage automatique du numéro de téléphone
        document.getElementById('telephoneInput').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = value.match(/.{1,2}/g).join(' ');
                if (value.length > 11) value = value.substring(0, 12);
            }
            e.target.value = value;
        });

        // Animation lors de la soumission
        document.getElementById('compteSecondaireForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.textContent = 'Création en cours...';
            submitBtn.disabled = true;
        });

        // Fermer les éléments en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            const notifications = document.getElementById('notifications');
            
            if (!dropdown.contains(event.target)) {
                document.querySelector('.dropdown-menu').classList.add('hidden');
            }
            
            if (!notifications.contains(event.target) && !event.target.closest('[onclick="toggleNotifications()"]')) {
                notifications.classList.add('hidden');
            }
        });

        // Gestion du responsive
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('sidebar').classList.add('-translate-x-full');
            }
        });

        // Fermer le modal avec la touche Échap
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>