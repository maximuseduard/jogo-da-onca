<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="description" content="Trabalho sobre o jogo da onça">
  <meta name="author" content="André, Eduardo, Ronan">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JOGO DA ONÇA</title>
  <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
  <audio id="audio-ambiente" autoplay loop>
    <source src="sounds/ambient-rain.mp3" type="audio/mpeg" />
    <!-- <source src="sounds/ambient-forest.mp3" type="audio/mpeg" /> -->
    <!-- <source src="sounds/ambient-jungle.mp3" type="audio/mpeg" /> -->
  </audio>

  <span class="jogo">J<span class="cor-onca">O</span>G<span class="cor-onca">O</span> D<span class="cor-onca">A</span> O<span class="cor-onca">N</span>Ç<span class="cor-onca">A</span></span>

  <span class="titulo">MODO DE JOGO</span>

  <button type="button" class="versus" name="button" onclick="location.href='versus.php';">1 vs 1</button>
  <button type="button" class="computer" name="button" onclick="location.href='computer.php';">1 vs CPU</button>
  <script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>
  <script type="text/javascript">
  $("#audio-ambiente")[0].volume = 0.5;
  </script>
</body>
</html>
