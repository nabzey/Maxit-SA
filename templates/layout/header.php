<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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