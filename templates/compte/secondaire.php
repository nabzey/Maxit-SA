<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Compte Secondaire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1a1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            background: #2a2a2a;
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .form-title {
            color: #ff6b35;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-input {
            width: 100%;
            padding: 18px 20px;
            background: transparent;
            border: 2px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: #666;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .form-input:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
            transform: translateY(-2px);
        }

        .submit-btn {
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

        .submit-btn:hover {
            background: #ff6b35;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .form-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Compte Secondaire</h2>
        
        <form method="post" action="/pageacceuil">
            <div class="form-group">
                <input 
                    type="tel" 
                    name="telephone" 
                    class="form-input" 
                    placeholder="Numéro de téléphone" 
                    required
                >
            </div>

            <div class="form-group">
                <input 
                    type="number" 
                    name="solde" 
                    class="form-input" 
                    placeholder="Solde initial" 
                    min="0" 
                    step="0.01"
                    required
                >
            </div>

            <button type="submit" class="submit-btn">
                Créer le compte
            </button>
        </form>
    </div>

    <script>
        // Formatage automatique du numéro de téléphone
        document.querySelector('input[name="telephone"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = value.match(/.{1,2}/g).join(' ');
                if (value.length > 11) value = value.substring(0, 11);
            }
            e.target.value = value;
        });

        // Animation lors de la soumission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.textContent = 'Création en cours...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>