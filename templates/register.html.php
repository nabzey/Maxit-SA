<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Créer un compte - Maxit-SA</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
.input-focus:focus {
transform: translateY(-1px);
box-shadow: 0 4px 15px rgba(252, 173, 14, 0.2);
}
.upload-hover:hover {
transform: scale(1.02);
}
.btn-glow:hover {
box-shadow: 0 0 20px rgba(252, 173, 14, 0.3);
}
</style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
<div class="flex w-full max-w-5xl h-[600px] rounded-2xl overflow-hidden shadow-2xl bg-black">
<!-- Section gauche - Image -->
<div class="w-2/5 bg-[#191919] flex items-center justify-center relative">
<img src="images/upload/acceuil.png" alt="Illustration équipe" class="max-w-[85%] max-h-[85%] object-contain">
<div class="absolute bottom-4 left-4 text-white/80 text-sm">
<i class="fas fa-shield-alt text-maxit mr-1"></i>
Sécurisé & Confidentiel
</div>
</div>

<!-- Section droite - Formulaire -->
<div class="w-3/5 bg-black flex flex-col relative">
<!-- Header avec bouton retour -->
<div class="flex items-center justify-between p-6 border-b border-gray-800">
<button class="text-maxit text-xl hover:bg-gray-800/50 rounded-full p-2 transition-all duration-300" onclick="window.location.href='/login'">
<i class="fa-solid fa-arrow-left"></i>
</button>
<div class="text-center">
<h2 class="text-xl font-bold text-white">Créer votre compte</h2>
<p class="text-gray-400 text-sm mt-1">Rejoignez Maxit-SA</p>
</div>
<div class="w-10"></div> <!-- Spacer pour centrer le titre -->
</div>

<!-- Formulaire scrollable -->
<div class="flex-1 overflow-y-auto px-6 py-4">
<form class="space-y-4" action="/register" method="post" enctype="multipart/form-data">
<!-- Nom et Prénom -->
<div class="grid grid-cols-2 gap-3">
<div class="relative">
<i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
<input type="text" name="nom" placeholder="Nom" required 
class="w-full bg-gray-900/50 border border-gray-700 rounded-lg text-white pl-9 pr-3 py-3 text-sm focus:outline-none focus:border-maxit focus:ring-1 focus:ring-maxit/20 placeholder:text-gray-400 transition-all duration-300 input-focus"/>
</div>
<div class="relative">
<i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
<input type="text" name="prenom" placeholder="Prénom" required 
class="w-full bg-gray-900/50 border border-gray-700 rounded-lg text-white pl-9 pr-3 py-3 text-sm focus:outline-none focus:border-maxit focus:ring-1 focus:ring-maxit/20 placeholder:text-gray-400 transition-all duration-300 input-focus"/>
</div>
</div>

<!-- Téléphone et Numéro pièce -->
<div class="grid grid-cols-2 gap-3">
<div class="relative">
<i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
<input type="text" name="telephone" placeholder="Téléphone" required 
class="w-full bg-gray-900/50 border border-gray-700 rounded-lg text-white pl-9 pr-3 py-3 text-sm focus:outline-none focus:border-maxit focus:ring-1 focus:ring-maxit/20 placeholder:text-gray-400 transition-all duration-300 input-focus"/>
</div>
<div class="relative">
<i class="fas fa-id-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
<input type="text" name="numero_piece_identite" placeholder="N° Pièce d'identité" required 
class="w-full bg-gray-900/50 border border-gray-700 rounded-lg text-white pl-9 pr-3 py-3 text-sm focus:outline-none focus:border-maxit focus:ring-1 focus:ring-maxit/20 placeholder:text-gray-400 transition-all duration-300 input-focus"/>
</div>
</div>

<!-- Adresse -->
<div class="relative">
<i class="fas fa-map-marker-alt absolute left-3 top-4 text-gray-400 text-sm"></i>
<textarea name="adresse" placeholder="Adresse complète" rows="2" required
class="w-full bg-gray-900/50 border border-gray-700 rounded-lg text-white pl-9 pr-3 py-3 text-sm focus:outline-none focus:border-maxit focus:ring-1 focus:ring-maxit/20 placeholder:text-gray-400 transition-all duration-300 resize-none input-focus"></textarea>
</div>

<!-- Upload des documents -->
<div class="space-y-3">
<h3 class="text-white font-medium text-sm flex items-center">
<i class="fas fa-upload text-maxit mr-2"></i>
Pièces d'identité
</h3>
<div class="grid grid-cols-2 gap-3">
<div class="text-center">
<label class="block border-2 border-dashed border-gray-600 rounded-lg h-20 flex flex-col items-center justify-center cursor-pointer hover:border-maxit transition-all duration-300 upload-hover bg-gray-900/30 hover:bg-gray-800/50">
<i class="fas fa-id-card text-maxit text-lg mb-1"></i>
<span class="text-gray-300 text-xs font-medium">Photo Recto</span>
<input type="file" name="photo_recto" accept="image/*" class="hidden" required>
</label>
</div>
<div class="text-center">
<label class="block border-2 border-dashed border-gray-600 rounded-lg h-20 flex flex-col items-center justify-center cursor-pointer hover:border-maxit transition-all duration-300 upload-hover bg-gray-900/30 hover:bg-gray-800/50">
<i class="fas fa-id-card text-maxit text-lg mb-1"></i>
<span class="text-gray-300 text-xs font-medium">Photo Verso</span>
<input type="file" name="photo_verso" accept="image/*" class="hidden" required>
</label>
</div>
</div>
</div>

<!-- Bouton de validation -->
<div class="pt-2">
<button type="submit" 
class="w-full bg-maxit hover:bg-[#e0990c] text-black font-bold py-3 px-6 rounded-lg transition-all duration-300 btn-glow transform hover:scale-[1.02] flex items-center justify-center gap-2">
<i class="fas fa-check-circle"></i>
CRÉER MON COMPTE
</button>
</div>
</form>
</div>

<!-- Logo en bas à droite -->
<div class="absolute bottom-4 right-4">
<div class="text-lg font-bold text-maxit">
Maxit-<span class="text-gray-300 font-normal">SA</span>
</div>
</div>
</div>
</div>

<!-- Version mobile responsive -->
<style>
@media (max-width: 768px) {
.flex {
flex-direction: column;
}
.w-2\/5, .w-3\/5 {
width: 100%;
}
.h-\[600px\] {
height: auto;
min-height: 100vh;
}
.grid-cols-2 {
grid-template-columns: 1fr;
}
.max-w-5xl {
max-width: 100%;
margin: 0;
}
.rounded-2xl {
border-radius: 0;
}
}
</style>

<script>
// Prévisualisation des images uploadées
document.querySelectorAll('input[type="file"]').forEach(input => {
input.addEventListener('change', function(e) {
const file = e.target.files[0];
if (file) {
const label = e.target.parentElement;
const icon = label.querySelector('i');
const text = label.querySelector('span');

// Changer l'icône et le texte
icon.className = 'fas fa-check-circle text-green-400 text-lg mb-1';
text.textContent = 'Sélectionné';
text.className = 'text-green-400 text-xs font-medium';
label.classList.add('border-green-400', 'bg-green-400/10');
label.classList.remove('border-gray-600', 'hover:border-maxit');
}
});
});
</script>
</body>
</html>