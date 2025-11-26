<?php
// ATENÇÃO: Edite esta linha com a senha que você deseja usar!
$senhaParaHash = "admin!"; // <--- Mude esta string

// O código PHP gera o hash usando o algoritmo BCRYPT seguro
$hashedPassword = password_hash($senhaParaHash, PASSWORD_DEFAULT);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Gerador de Hash de Senha Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen p-4">

    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl max-w-lg w-full text-white border border-gray-700">
        <h1 class="text-3xl font-bold mb-4 text-yellow-400">Hash de Senha Gerado</h1>
        <p class="mb-6 text-gray-300">
            Copie o valor abaixo e armazene-o no seu banco de dados. Nunca armazene a senha original.
        </p>

        <div class="mb-4 p-4 bg-gray-700 rounded-lg break-all">
            <h3 class="text-sm font-semibold uppercase text-gray-400 mb-2">Sua Senha (em texto puro):</h3>
            <p class="text-lg font-mono text-white"><?php echo htmlspecialchars($senhaParaHash); ?></p>
        </div>

        <div class="mb-8 p-4 bg-blue-900 rounded-lg break-all border-l-4 border-blue-400">
            <h3 class="text-sm font-semibold uppercase text-blue-400 mb-2">O HASH SEGURO (Valor a Salvar):</h3>
            <code id="hash-output" class="text-xl font-mono text-white select-all cursor-pointer">
                <?php echo htmlspecialchars($hashedPassword); ?>
            </code>
        </div>
        
        <button onclick="copyHash()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
            <i class="fas fa-copy mr-2"></i> Copiar Hash
        </button>

        <p class="mt-6 text-xs text-red-400">
            <i class="fas fa-exclamation-triangle mr-1"></i> **IMPORTANTE**: Depois de gerar e copiar o hash, **DELETE ESTE ARQUIVO** do seu servidor imediatamente por segurança!
        </p>
    </div>

    <script>
        function copyHash() {
            const hashElement = document.getElementById('hash-output');
            const hashText = hashElement.textContent || hashElement.innerText;
            
            // Usando a API Clipboard (navegadores modernos)
            if (navigator.clipboard) {
                navigator.clipboard.writeText(hashText).then(() => {
                    alert('Hash copiado com sucesso! Pode deletar este arquivo.');
                }).catch(err => {
                    console.error('Erro ao copiar: ', err);
                });
            } else {
                // Fallback para navegadores mais antigos (menos comum hoje)
                const textArea = document.createElement('textarea');
                textArea.value = hashText;
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    alert('Hash copiado com sucesso! Pode deletar este arquivo.');
                } catch (err) {
                    alert('Falha ao copiar. Copie manualmente o texto acima.');
                }
                document.body.removeChild(textArea);
            }
        }
    </script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</body>
</html>