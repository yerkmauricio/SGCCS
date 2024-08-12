<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error 403</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 0 auto;
            max-width: 960px;
            padding: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 24px;
            font-family: "Times New Roman", Times, serif;
            line-height: 1.5;
            margin-bottom: 20px;
            color: gray;
        }

        .error-gif {
            /* Estilo para tu GIF */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            <img src="{{ asset('img/cat.gif') }}" alt="Error GIF" class="error-gif">
        </h1>
        <p>¡LO SIENTO ! No tienes permiso para acceder a esta página.</p>
    </div>
</body>

</html>
