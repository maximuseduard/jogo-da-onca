<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="description" content="Trabalho sobre o jogo da onça">
  <meta name="author" content="André, Eduardo, Ronan">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta http-equiv="refresh" content="30"> --> <!-- Refresh document every 30 seconds -->
  <title>JOGO DA ONÇA</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
  <div id="tab">
    <span id="x11" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x12" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x13" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x14" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x15" class="cachorro"><img src="images/cachorro.png"></span>
    <br/>

    <span id="x21" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x22" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x23" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x24" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x25" class="cachorro"><img src="images/cachorro.png"></span>
    <br/>

    <span id="x31" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x32" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x33" class="onca"><img src="images/onca.png"></span>
    <span id="x34" class="cachorro"><img src="images/cachorro.png"></span>
    <span id="x35" class="cachorro"><img src="images/cachorro.png"></span>
    <br/>

    <span id="x41" class="livre"></span>
    <span id="x42" class="livre"></span>
    <span id="x43" class="livre"></span>
    <span id="x44" class="livre"></span>
    <span id="x45" class="livre"></span>
    <br/>

    <span id="x51" class="livre"></span>
    <span id="x52" class="livre"></span>
    <span id="x53" class="livre"></span>
    <span id="x54" class="livre"></span>
    <span id="x55" class="livre"></span>
  </div>
  <br/>

  <span id="x61" class="livre"></span>
  <span id="x62" class="livre"></span>
  <span id="x63" class="livre"></span>
  <br/>

  <span id="x71" class="livre"></span>
  <span id="x72" class="livre"></span>
  <span id="x73" class="livre"></span>

  <script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>

  <script type="text/javascript">
  var turno = "onca";
  var cachorros = 0;
  var casa_atual = "x33";
  var movimentos_cachorro = {
    x11: ['x12','x21','x22'],
    x12: ['x11','x22','x13'],
    x13: ['x12','x14','x22','x23','x24'],
    x14: ['x13','x15','x23'],
    x15: ['x14','x24','x25'],
    x21: ['x11','x22','x31'],
    x22: ['x11','x12','x13','x21','x23','x31','x32','x33'],
    x23: ['x22','x24','x13','x33'],
    x24: ['x13','x14','x15','x23','x25','x33','x34','x35'],
    x25: ['x15','x24','x35'],
    x31: ['x21','x22','x32','x41','x42'],
    x32: ['x31','x33','x22','x42'],
    x33: ['x22','x23','x24','x32','x34','x42','x43','x44'],
    x34: ['x24','x33','x35','x44'],
    x35: ['x24','x25','x34','x44','x45'],
    x41: ['x31','x42','x51'],
    x42: ['x31','x32','x33','x41','x43','x51','x52','x53'],
    x43: ['x33','x42','x44','x53'],
    x44: ['x33','x34','x35','x43','x45','x53','x54 x55'],
    x45: ['x35','x44','x55'],
    x51: ['x41','x42','x52'],
    x52: ['x51','x42','x53'],
    x53: ['x42','x43','x44','x52','x54','x61','x62','x63'],
    x54: ['x44','x53','x55'],
    x55: ['x44','x45','x54'],
    x61: ['x53','x62','x71'],
    x62: ['x53','x61','x63','x72'],
    x63: ['x53','x62','x73'],
    x71: ['x61','x72'],
    x72: ['x62','x71','x73'],
    x73: ['x63','x72']
  }
  var movimentos_onca = {
    x11: ['x12','x21','x22',    'x13','x31','x33'],
    x12: ['x11','x22','x13',    'x32','x14'],
    x13: ['x12','x14','x22','x23','x24',    'x11','x31','x33','x35','x15'],
    x14: ['x13','x15','x23',     'x12','x34'],
    x15: ['x14','x24','x25',    'x13','x33','x35'],
    x21: ['x11','x22','x31',     'x23','x41'],
    x22: ['x11','x12','x13','x21','x23','x31','x32','x33',     'x24','x44','x42'],
    x23: ['x22','x24','x13','x33',    'x21','x43','x25'],
    x24: ['x13','x14','x15','x23','x25','x33','x34','x35',    'x22','x42','x44'],
    x25: ['x15','x24','x35',    'x33','x45'],
    x31: ['x21','x22','x32','x41','x42',    'x11','x13','x33','x53 x51'],
    x32: ['x31','x33','x22','x42',    'x12','x34','x52'],
    x33: ['x22','x23','x24','x32','x34','x42','x43','x44',    'x11','x13','x15','x31','x35','x51','x53','x55'],
    x34: ['x24','x33','x35','x44',    'x32','x14','x54'],
    x35: ['x24','x25','x34','x44','x45',    'x13','x15','x33','x53','x55'],
    x41: ['x31','x42','x51',    'x43'],
    x42: ['x31','x32','x33','x41','x43','x51','x52','x53',    'x22','x24','x44','x63'],
    x43: ['x33','x42','x44','x53',    'x41','x45','x62'],
    x44: ['x33','x34','x35','x43','x45','x53','x54 x55',    'x22','x24','x42','x61'],
    x45: ['x35','x44','x55',    'x25','x43'],
    x51: ['x41','x42','x52',    'x31','x33','x53'],
    x52: ['x51','x42','x53',    'x32','x54'],
    x53: ['x42','x43','x44','x52','x54','x61','x62','x63',    'x51','x31','x33','x35','x55','x71','x72','x73'],
    x54: ['x44','x53','x55',    'x34','x53'],
    x55: ['x44','x45','x54',    'x33','x35','x53'],
    x61: ['x53','x62','x71',    'x44','x63'],
    x62: ['x53','x61','x63','x72',    'x43'],
    x63: ['x53','x62','x73',    'x42','x61'],
    x71: ['x61','x72',    'x53','x73'],
    x72: ['x62','x71','x73',    'x53'],
    x73: ['x63','x72',    'x53','x71']
  }

  function vencedor(animal) {
    if(animal == "onca") alert("A ONÇA ganhou!");
    else alert("OS CACHORROS ganharam!");
  }
  </script>
</body>
</html>
