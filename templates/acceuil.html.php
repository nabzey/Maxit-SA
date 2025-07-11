<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Maxit-SA</title>
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
  <?php if (isset($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
  <div class="flex w-full max-w-3xl h-[500px] rounded-2xl overflow-hidden shadow-2xl bg-black">
    <div class="w-1/2 bg-[#191919] flex items-center justify-center">
      <img src="images/upload/acceuil.png" alt="Illustration équipe" class="max-w-[90%] max-h-[90%]">
    </div>
    <div class="relative w-1/2 bg-black flex flex-col items-center justify-center">
   <div class="flex flex-col items-center justify-center h-full">
  <button
    class="text-lg mb-6 flex items-center gap-2 px-6 py-3 bg-maxit hover:bg-[#e0990c] text-white rounded-full shadow transition"
    type="button"
    onclick="window.location.href='/login'"
  >
    <span class="font-medium">Bienvenue sur</span>
    <i class="fa-solid fa-arrow-right text-lg"></i>
  </button>

  <div class="text-3xl font-bold text-maxit">
    Maxit-<span class="text-gray-300 font-normal">SA</span>
  </div>
</div>

      <div class="absolute bottom-6 right-4 flex flex-col items-end">
        <img src="images/upload/acceuil1.png" alt="Avatars" class="w-32 drop-shadow-lg">
      </div>
    </div>
  </div>
</body>
</html>