<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="description" content="Trabalho sobre o jogo da onça">
  <meta name="author" content="André, Eduardo, Ronan">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JOGO DA ONÇA</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
  <audio id="audio-ambiente" autoplay loop>
    <source src="sounds/ambient-rain.mp3" type="audio/mpeg" />
    <!-- <source src="sounds/ambient-forest.mp3" type="audio/mpeg" /> -->
    <!-- <source src="sounds/ambient-jungle.mp3" type="audio/mpeg" /> -->
  </audio>
  <audio id="audio-onca">
    <source src="sounds/onca.mp3" type="audio/mpeg" />
    <!-- <source src="sounds/onca-bebe.mp3" type="audio/mpeg" /> -->
  </audio>
  <audio id="audio-cachorro">
    <source src="sounds/cachorro.mp3" type="audio/mpeg" />
  </audio>

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
    <br/>

    <span id="x61" class="livre"></span>
    <span id="x62" class="livre"></span>
    <span id="x63" class="livre"></span>
    <br/>

    <span id="x71" class="livre"></span>
    <span id="x72" class="livre"></span>
    <span id="x73" class="livre"></span>
  </div>

  <div id="placar">
    CACHORROS<br/>
  </div>

  <div id="turno">
    Turno: ONÇA
  </div>

  <button type="button" name="button" class="disabled" disabled onclick="finalizaJogada()">Pular</button>

  <script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>

  <script type="text/javascript">
  $("#audio-ambiente")[0].volume = 0.2;

  var i=0;
  var turno = "onca";
  var cachorros = 0;
  var casa_atual = "x33";
  var movimentos = {
    x11: ['x12','x21','x22'],
    x12: ['x11','x22','x13'],
    x13: ['x12','x14','x22','x23','x24'],
    x14: ['x13','x15','x24'],
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
    x44: ['x33','x34','x35','x43','x45','x53','x54','x55'],
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
  // '{casa_destino}:{casa_cachorro}'
  var movimentos_onca = {
    x11: ['x13:x12','x31:x21','x33:x22'],
    x12: ['x32:x22','x14:x13'],
    x13: ['x11:x12','x31:x22','x33:x23','x35:x24','x15:x14'],
    x14: ['x12:x13','x34:x24'],
    x15: ['x13:x14','x33:x24','x35:x25'],
    x21: ['x23:x22','x41:x31'],
    x22: ['x24:x23','x44:x33','x42:x32'],
    x23: ['x21:x22','x43:x33','x25:x24'],
    x24: ['x22:x23','x42:x33','x44:x34'],
    x25: ['x23:x24','x45:x35'],
    x31: ['x11:x21','x13:x22','x33:x32','x53:x42','x51:x41'],
    x32: ['x12:x22','x34:x33','x52:x42'],
    x33: ['x11:x22','x13:x23','x15:x24','x31:x32','x35:x34','x51:x42','x53:x43','x55:x44'],
    x34: ['x32:x33','x14:x24','x54:x44'],
    x35: ['x13:x24','x15:x25','x33:x34','x53:x44','x55:x45'],
    x41: ['x43:x42'],
    x42: ['x22:x32','x24x:33','x44:x43','x63:x53'],
    x43: ['x23:x33','x41:x42','x45:x44','x62:x53'],
    x44: ['x22:x33','x24:x34','x42:x43','x61:x53'],
    x45: ['x25:x35','x43:x44'],
    x51: ['x31:x41','x33:x42','x53:x52'],
    x52: ['x32:x42','x54:x53'],
    x53: ['x51:x52','x31:x42','x33:x43','x35:x44','x55:x54','x71:x61','x72:x62','x73:x63'],
    x54: ['x34:x44','x52:x53'],
    x55: ['x33:x44','x35:x45','x53:x54'],
    x61: ['x44:x53','x63:x62'],
    x62: ['x43:x53'],
    x63: ['x42:x53','x61:x62'],
    x71: ['x53:x61','x73:x72'],
    x72: ['x53:x62'],
    x73: ['x53:x63','x71:x72']
  }

  $("span").click(function() {
    $("button").addClass("disabled");
    $("button").attr("disabled", true);
    if( !$(this).hasClass("jogavel") && !$(this).hasClass("ataque") ) {
      casa_atual = $(this).attr('id');

      console.clear();
      console.log('$("#audio-ambiente")[0].pause();');
      console.log("----------------------------------------------------------");
      console.log("-------------------- INICIO DA JOGADA --------------------");
      console.log("----------------------------------------------------------");
      console.log("------- Placar -------");
      console.log(cachorros);
      console.log("----- Casa Atual -----");
      console.log(casa_atual);
      console.log("------- Turno -------");
      console.log(turno);
      console.log("---------------------");
      if( $(this).hasClass("livre") ) {
        return;
      } else if($(this).hasClass("onca") && turno == "onca") {
        marcarCasas();
        marcarCasasOnca();
        $(this).addClass("selecionado");
      } else if($(this).hasClass("cachorro") && turno == "cachorro") {
        marcarCasas();
        $(this).addClass("selecionado");
      } else {
        $("span").removeClass("selecionado");
        $("span").removeClass("jogavel");
      }
    } else if( $(this).hasClass("jogavel") && !$(this).hasClass("ataque") ) {
      // configurações padrão da casa clicada ( ocupar a casa / colocar a imagem / remover imagem e classes da ultima )

      // ocupando a casa atual e colocando imagem nela
      $(this).removeClass("livre");
      $(this).html( $("#"+casa_atual).html() );

      // removendo classes e imagens da ultima jogada
      $("#"+casa_atual).html("");
      $("#"+casa_atual).addClass("livre");
      $("#"+casa_atual).removeClass(turno);
      $("span").removeClass("jogavel");
      $("span").removeClass("selecionado");

      if(turno == "cachorro") {

        casa_atual = $(this).attr('id');
        $(this).addClass("cachorro");
        $("#turno").html("Turno: ONÇA");
        turno = "onca";
        testeVencedor();
        console.log("----------------------------------------------------------");
        console.log("---------------------- FIM DA JOGADA ---------------------");
        console.log("----------------------------------------------------------");
        return;

      } else if(turno == "onca") {
        // caso tenha comido uma peça ( adiciona no contador / limpa classe e imagem do cachorro / checa vencedor )
        if( $(this).hasClass("comida") ) {
          $("#audio-onca")[0].load();
          $("#audio-onca")[0].play();
          cachorros++;
          $("#placar").append('<img src="images/cachorro.png">')
          $("#"+$(this).attr("data-comida") ).html("");
          $("#"+$(this).attr("data-comida") ).addClass("livre");
          $("#"+$(this).attr("data-comida") ).removeClass("cachorro");
          $("span").removeClass("comida");
          if(cachorros == 5) vencedor("onca");
          casa_atual = $(this).attr('id');
          marcarCasasOnca();
          $("#"+casa_atual).addClass("ataque");
        }

        casa_atual = $(this).attr('id');
        $(this).addClass("onca");
        $(this).addClass("selecionado");

        // Se existir opções o usuário tem q cancelar a jogada manualmente, ou comer mais cachorros. Se não passa o turno automaticamente
        console.log("----- Existe opções? -----");
        console.log( $("span").hasClass("jogavel") );
        console.log("--------------------------");

        if( !$("span").hasClass("jogavel") ) {
          turno = "cachorro";
          $("#turno").html("Turno: CACHORRO");
          $("span").removeClass("ataque");
          $("span").removeClass("comida");
          $(this).removeClass("selecionado");
          console.log("----------------------------------------------------------");
          console.log("---------------------- FIM DA JOGADA ---------------------");
          console.log("----------------------------------------------------------");
          return;

        } else {
          // habilitar botão para finalizar turno da onça manualmente
          $("button").removeClass("disabled");
          $("button").prop("disabled", false);
        }
      }
    } else if( $("span").hasClass("ataque") ) {
      $("#audio-onca")[0].load();
      $("#audio-onca")[0].play();
      casa_atual = $("span.ataque").attr('id');
      $("span.ataque").addClass("selecionado");
      // Se existir opções o usuário tem q cancelar a jogada manualmente, ou comer mais cachorros. Se não passa o turno automaticamente
      marcarCasasOnca();
      console.log("----- Existe opções? -----");
      console.log( $("span").hasClass("jogavel") );
      console.log("--------------------------");
      if( !$("span").hasClass("jogavel") ) {
        turno = "cachorro";
        $("#turno").html("Turno: CACHORRO");
        $("span").removeClass("ataque");
        $("span").removeClass("comida");
        $(this).removeClass("selecionado");
        console.log("----------------------------------------------------------");
        console.log("---------------------- FIM DA JOGADA ---------------------");
        console.log("----------------------------------------------------------");
        return;

      } else {
        // habilitar botão para finalizar turno da onça manualmente
        $("button").removeClass("disabled");
        $("button").prop("disabled", false);
      }
    }
  });

  function marcarCasas() {
    // limpa as casas da ultima jogada
    $("span").removeClass("selecionado");
    $("span").removeClass("jogavel");

    // busca dados do objeto de movimentos
    var casas_possiveis = movimentos[casa_atual];
    console.log("--- Casas Possiveis ---");
    console.log(casas_possiveis.length+" casas");
    console.log(casas_possiveis);
    console.log("-----------------------");

    // adiciona classe nos lugares disponiveis
    for(i=0; i < casas_possiveis.length; i++) {
      if( $("#"+casas_possiveis[i]).hasClass("livre") ) {
        $("#"+casas_possiveis[i]).addClass("jogavel");
      }
    }
  }
  function marcarCasasOnca() {
    // busca dados do objeto de movimentos da onça
    var casas_possiveis = movimentos_onca[casa_atual];
    console.log("----- Casas Onça -----");
    console.log(casas_possiveis.length+" casas");
    console.log(casas_possiveis);
    console.log("----------------------");

    // adiciona classe nos lugares disponiveis, adicionando tambem o atributo que define qual cachorrro foi comido caso a posição seja usada
    for(i=0; i < casas_possiveis.length; i++) {
      if( $("#"+casas_possiveis[i].split(":")[0]).hasClass("livre") && $("#"+casas_possiveis[i].split(":")[1]).hasClass("cachorro") ) {
        $("#"+casas_possiveis[i].split(":")[0]).addClass("jogavel");
        $("#"+casas_possiveis[i].split(":")[0]).addClass("comida"); // indica que é uma casa de 'ataque'
        $("#"+casas_possiveis[i].split(":")[0]).attr("data-comida", casas_possiveis[i].split(":")[1]); // posição do cachorro a ser comido
      }
    }
  }
  function finalizaJogada() {
    $("button").addClass("disabled");
    $("button").attr("disabled", true);

    $("span").removeClass("ataque");
    $("span").removeClass("selecionado");
    $("span").removeClass("jogavel");
    $("span").removeClass("comida");

    turno = "cachorro";
    $("#turno").html("Turno: CACHORRO");
    console.log("----------------------------------------------------------");
    console.log("---------------------- FIM DA JOGADA ---------------------");
    console.log("----------------------------------------------------------");
  }
  function vencedor(animal) {
    $("span").removeClass("onca");
    $("span").removeClass("cachorro");
    $("span").removeClass("livre");
    $("span").removeClass("jogavel");
    $("span").removeClass("selecionado");
    $("span").removeClass("comida");
    $("span").removeClass("ataque");

    if(animal == "onca") setTimeout(function(){
      alert("A ONÇA ganhou!\nReinicie a página para jogar novamente");
    }, 0);
    else setTimeout(function(){
      $("#audio-cachorro")[0].play();
      alert("OS CACHORROS ganharam!\nReinicie a página para jogar novamente");
    }, 0);
  }
  function testeVencedor() {
    // busca dados do objeto de movimentos
    var casas_possiveis = movimentos[ $("span.onca").attr("id") ];
    var cachorroVence = 1;
    // adiciona classe nos lugares disponiveis
    for(i=0; i < casas_possiveis.length && cachorroVence == 1; i++) {
      if( $("#"+casas_possiveis[i]).hasClass("livre") ) {
        cachorroVence = 0;
      }
    }
    if( cachorroVence==1 ) vencedor("cachorro");
  }
  </script>
</body>
</html>
