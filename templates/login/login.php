<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - Maxit-SA</title>
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
<body class="bg-white min-h-screen flex items-center justify-center">
 
<div class="flex w-full max-w-3xl h-[500px] rounded-2xl overflow-hidden shadow-2xl bg-black">
<!-- Section gauche - Image -->
<div class="w-1/2 bg-[#191919] flex items-center justify-center">
<img src="" alt="Illustration équipe" class="max-w-[90%] max-h-[90%]">
</div>

<!-- Section droite - Formulaire de connexion -->
<div class="relative w-1/2 bg-black flex flex-col items-center justify-center">
<button class="absolute top-4 left-4 text-maxit text-xl hover:bg-[#232323] rounded-full p-2 transition" onclick="window.history.back()">
<i class="fa-solid fa-arrow-left"></i>
</button>

<div class="flex flex-col items-center justify-center h-full px-6">
<div class="text-center mb-8">
<div class="text-2xl font-bold text-maxit mb-2">
Maxit-<span class="text-gray-300 font-normal">SA</span>
</div>
<p class="text-gray-400 text-sm">Connectez-vous</p>
</div>
<form method="post" action="/login" class="w-full space-y-6">
  <div class="relative">
    <!-- <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i> -->
    <input
      type="text"
      name="login"
      placeholder="login"
      class="w-full bg-transparent border border-gray-500 rounded-md text-white pl-10 pr-4 py-3 focus:outline-none focus:border-maxit placeholder:text-white placeholder:opacity-70 text-sm"
    />
  <?php 
if (isset($errors['login'])): 
    foreach ($errors['login'] as $error): ?>
        <p class="mt-1 text-red-500 text-xs"><?php echo htmlspecialchars($error->value); ?></p>
    <?php endforeach; 
endif; 
?>
    <input
      type="password"
      name="password"
      placeholder="mot de passe"
      class="w-full bg-transparent border border-gray-500 rounded-md text-white pl-10 pr-4 py-3 focus:outline-none focus:border-maxit placeholder:text-white placeholder:opacity-70 text-sm"
    >
   <?php 
if (isset($errors['password'])): 
    foreach ($errors['password'] as $error): ?>
        <p class="mt-1 text-red-500 text-xs"><?php echo htmlspecialchars($error->value); ?></p>
    <?php endforeach; 
endif; 
?>
  </div>
  <button
    type="submit"
    class="w-full border-2 border-maxit text-maxit px-6 py-3 rounded-full font-semibold hover:bg-maxit hover:text-black transition flex items-center justify-center gap-2">
    <i class="fas fa-sign-in-alt"></i>
    SE CONNECTER
  </button>
</form>
<div class="text-center">
<a href="/register" class="text-gray-400 hover:text-maxit transition text-xs">
Pas de compte ? <span class="underline">Créer un compte</span>
</a>
</div>
</form>
</div>

<!-- Logo en bas à droite -->
<div class="absolute bottom-4 right-4 flex flex-col items-end">
<div class="flex items-center text-maxit text-xs">
<i class="fas fa-shield-alt mr-1"></i>
<span>Sécurisé</span>
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
.w-2\/3, .w-1\/3 {
width: 100%;
}
.h-\[500px\] {
height: auto;
min-height: 100vh;
}
.max-w-3xl {
max-width: 100%;
margin: 0;
}
.rounded-2xl {
border-radius: 0;
}
body {
background: #191919;
}
}
</style>
</body>
</html>