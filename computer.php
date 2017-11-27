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
  <div id="computer" style="display:none">
  <!-- <div id="computer"> -->

  </div>

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

  <script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>

  <script type="text/javascript">
  //$("#audio-ambiente")[0].volume = 0.2;
  $("#audio-ambiente")[0].volume = 0;

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
    x41: ['x21:x31','x43:x42'],
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


  /*##########################################################################
  #                                  JOGADOR
  ##########################################################################*/
  $("#tab span").click(function() {
    if( !$(this).hasClass("jogavel") && turno == "cachorro") {
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
      } else if( $(this).hasClass("cachorro") ) {
        marcarCasas();
        $(this).addClass("selecionado");
      } else {
        $("#tab span").removeClass("selecionado");
        $("#tab span").removeClass("jogavel");
      }
    } else if( $(this).hasClass("jogavel") && turno == "cachorro") {
      // configurações padrão da casa clicada ( ocupar a casa / colocar a imagem / remover imagem e classes da ultima )

      // ocupando a casa atual e colocando imagem nela
      $(this).removeClass("livre");
      $(this).addClass("cachorro");
      $(this).html('<img src="images/cachorro.png">');

      // removendo classes e imagens da ultima jogada
      $("#tab #"+casa_atual).html("");
      $("#tab #"+casa_atual).addClass("livre");
      $("#tab #"+casa_atual).removeClass("cachorro");
      $("#tab span").removeClass("jogavel");
      $("#tab span").removeClass("selecionado");

      $("#turno").html("Turno: ONÇA");
      turno = "onca";
      testeVencedor();
      turnoOnca();
      console.log("-----------------------------------------------------------");
      console.log("------------------ FIM DA JOGADA CACHORRO -----------------");
      console.log("-----------------------------------------------------------");
      return;
    }
  });
  function marcarCasas() {
    // limpa as casas da ultima jogada
    $("#tab span").removeClass("selecionado");
    $("#tab span").removeClass("jogavel");

    // busca dados do objeto de movimentos
    var casas_possiveis = movimentos[casa_atual];
    console.log("--- Casas Possiveis ---");
    console.log(casas_possiveis.length+" casas");
    console.log(casas_possiveis);
    console.log("-----------------------");

    // adiciona classe nos lugares disponiveis
    for(i=0; i < casas_possiveis.length; i++) {
      if( $("#tab #"+casas_possiveis[i]).hasClass("livre") ) {
        $("#tab #"+casas_possiveis[i]).addClass("jogavel");
      }
    }
  }

  /*##########################################################################
  #                            TRATAMENTO DE VITÓRIA
  ##########################################################################*/
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
      alert("OS CACHORROS ganharam!\nReinicie a página para jogar novamente");
      $("#audio-cachorro")[0].play();
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

  /*##########################################################################
  #                          INTELIGENCIA ARTIFICIAL
  ##########################################################################*/
  /*
  Função recursiva tem que:
  - Receber estado atual da jogada e risco;
  - testar a melhor jogada(testar 2 passos após a raiz);
  - retornar a melhor jogada e risco;
  Lógica de risco:
  - O menor risco é o melhor;
  - O risco é cumulativo nos passos;
  - Não será avaliado o risco q a jogada do cahorro causa
  */
  var comidos_global = 0;
  var risco_global = 0;
  var jogada_global = "";

  var comidos_loop = 0;
  var risco_loop = 10000000;
  var jogada_loop = "";

  var profundidade_jogo = 1; // numero de jogadas a frente

  /* essa função é recursiva e inicia no movimento da onça.
  No fim da função exite um loop para todas as jogadas do cachorro.
  Se no fim do loop a jogada atual está com risco menor q o global ela atualiza a melhor jogada
  */
  function turnoOnca() {
    console.clear();
    console.log('$("#audio-ambiente")[0].pause();');
    console.log("----------------------------------------------------------");
    console.log("---------------- INICIO DA JOGADA DA ONÇA ----------------");
    console.log("----------------------------------------------------------");

    jogada_global = "";
    risco_global = 10000000;
    comidos_global = 0;

    comidos_loop = 0;
    risco_loop = 10000000;

    var jogada = "";
    var tabuleiro_jogada = "";
    var tabuleiro = $("#tab").html();

    $("#computer").html( tabuleiro );

    // verificando jogadas possiveis independente do estado do tabuleiro e colocando no array casas
    var casas = movimentos[ $("#computer .onca").attr("id") ].toString();
    movimentos_onca[ $("#computer .onca").attr("id") ].forEach(function(item) {
      casas = casas+","+item;
    });
    casas = casas.split(",");

    // loop em jogadas validas
    for(i=0; i < casas.length; i++) {
      if( $("#computer #"+casas[i].split(":")[0]).hasClass("livre") ) {
        if( casas[i].indexOf(":") != -1 ) { // jogada comendo
          if( $("#computer #"+casas[i].split(":")[1]).hasClass("cachorro") ) {
            var casa_onca = casas[i].split(":")[0];
            var casa_cachorro = casas[i].split(":")[1];
            jogada = casas[i];
            console.log("~~~~~~~~~~~~~~~~~~~~");
            console.log("~  jogada comendo | raiz ");
            console.log(" casa onca vai jogar- "+casa_onca+" | casa dog vai ser comido- "+casa_cachorro);
            console.log("~~~~~~~~~~~~~~~~~~~~");

            // função recursiva q faz todas opções de comidos, retorna o valor de risco do ultimo passo
            risco_loop = 10000000;
            comidos_loop = 0;
            profundidade_onca(casa_onca, casa_cachorro, 0);

            tabuleiro_jogada = $("#computer").html();
            $("#computer .cachorro").each(function( index ) {
              var posicao_atual_cachorro = $(this).attr('id');
              var jogada_cachorro = movimentos[ posicao_atual_cachorro ];
              console.log(" - - - - - cachorro-"+posicao_atual_cachorro+" | "+(index+1)+"/"+(14-cachorros)+" - - - - - ");

              jogada_cachorro.forEach(function(item) {
                if( $("#computer #"+item).hasClass("livre") ){
                  mudarCasa(item, "cachorro", posicao_atual_cachorro);
                  console.log("cachorro => "+posicao_atual_cachorro+" => "+item);

                  risco = calculaRisco(0, comidos_loop);
                  profundidade_recursiva(risco, comidos_loop, jogada, 1);

                  $("#computer").html( tabuleiro_jogada );
                }
              });
            });
          }
        } else { // jogada sem comer
          var casa_onca = casas[i];
          jogada = casa_onca;
          console.log("~~~~~~~~~~~~~~~~~~~~");
          console.log("~ jogada sem comer | raiz");
          console.log("~ casa onca vai jogar- "+casa_onca);
          console.log("~~~~~~~~~~~~~~~~~~~~");

          mudarCasa(casa_onca, "onca", 0);

          tabuleiro_jogada = $("#computer").html();
          $("#computer .cachorro").each(function( index ) {
            var posicao_atual_cachorro = $(this).attr('id');
            var jogada_cachorro = movimentos[ posicao_atual_cachorro ];
            console.log(" - - - - - cachorro-"+posicao_atual_cachorro+" | "+(index+1)+"/"+(14-cachorros)+" - - - - - ");

            jogada_cachorro.forEach(function(item) {
              if( $("#computer #"+item).hasClass("livre") ){
                mudarCasa(item, "cachorro", posicao_atual_cachorro);
                console.log("cachorro: "+posicao_atual_cachorro+" => "+item);

                risco = calculaRisco(0, 0);

                profundidade_recursiva(risco, 0, jogada, 1);

                $("#computer").html( tabuleiro_jogada );
              }
            });

          });
        }
        $("#computer").html( tabuleiro );
      }
    } // for end

    // realiza a jogada
    if( jogada.indexOf(":") != -1 ) {
      $("#audio-onca")[0].play();
      casa_onca = jogada.split(":")[0];
      casa_cachorro = jogada.split(":")[1];
      // tira onça da casa
      $("#tab .onca").html("");
      $("#tab .onca").addClass("livre");
      $("#tab .onca").removeClass("onca");
      // move onça para local da jogada
      $("#tab #"+casa_onca).html('<img src="images/onca.png">');
      $("#tab #"+casa_onca).addClass("onca");
      $("#tab #"+casa_onca).removeClass("livre");
      // come cachorro
      $("#tab #"+casa_cachorro).html("");
      $("#tab #"+casa_cachorro).addClass("livre");
      $("#tab #"+casa_cachorro).removeClass("cachorro");
    } else {
      // tira onça da casa
      $("#tab .onca").html("");
      $("#tab .onca").addClass("livre");
      $("#tab .onca").removeClass("onca");
      // move onça para local da jogada
      $("#tab #"+jogada).html('<img src="images/onca.png">');
      $("#tab #"+jogada).addClass("onca");
      $("#tab #"+jogada).removeClass("livre");
    }
    turno = "cachorro";
  }
  function profundidade_recursiva(risco, comidos, jogada, profundidade) {
    var risco_jogada = 10000000;
    var tabuleiro_jogada = "";
    var tabuleiro = $("#tab").html();

    // verificando jogadas possiveis independente do estado do tabuleiro e colocando no array casas
    var casas = movimentos[ $("#computer .onca").attr("id") ].toString();
    movimentos_onca[ $("#computer .onca").attr("id") ].forEach(function(item) {
      casas = casas+","+item;
    });
    casas = casas.split(",");

    // loop em jogadas validas
    for(i=0; i < casas.length; i++) {
      if( $("#computer #"+casas[i].split(":")[0]).hasClass("livre") ) {
        if( casas[i].indexOf(":") != -1 ) { // jogada comendo
          if( $("#computer #"+casas[i].split(":")[1]).hasClass("cachorro") ) {
            var casa_onca = casas[i].split(":")[0];
            var casa_cachorro = casas[i].split(":")[1];

            console.log("~~~~~~~~~~~~~~~~~~~~");
            console.log("~ LOOP - jogada comendo | recursiva-"+profundidade);
            console.log(" casa onca vai jogar- "+casa_onca+" | casa dog vai ser comido- "+casa_cachorro);
            console.log("~~~~~~~~~~~~~~~~~~~~");

            // função recursiva q faz todas opções de comidos, retorna o valor de risco do ultimo passo
            risco_loop = 10000000;
            comidos_loop = 0;
            profundidade_onca(casa_onca, casa_cachorro, comidos);

            tabuleiro_jogada = $("#computer").html();
            $("#computer .cachorro").each(function( index ) {
              var posicao_atual_cachorro = $(this).attr('id');
              var jogada_cachorro = movimentos[ posicao_atual_cachorro ];
              console.log(" - - - - - cachorro-"+posicao_atual_cachorro+" | "+(index+1)+"/"+(14-cachorros)+" - - - - - ");

              jogada_cachorro.forEach(function(item) {
                if( $("#computer #"+item).hasClass("livre") ){
                  mudarCasa(item, "cachorro", posicao_atual_cachorro);
                  console.log("cachorro => "+posicao_atual_cachorro+" => "+item);

                  risco_jogada = calculaRisco(risco, comidos_loop);
                  if( profundidade_jogo == profundidade ) {
                    if( risco_global > risco_jogada && comidos_global <= comidos ) {
                      jogada_global = jogada;
                      risco_global = risco_jogada;
                      comidos_global = comidos;
                    } else if (risco_global == risco_jogada && getRandomInt(0,1) ) {
                      jogada_global = jogada;
                      comidos_global = comidos;
                    }
                  } else {
                    profundidade_recursiva(risco_jogada,comidos_loop,jogada,profundidade+1);
                  }

                  $("#computer").html( tabuleiro_jogada );
                }
              });

            });
          }
        } else { // jogada sem comer
          var casa_onca = casas[i];
          console.log("~~~~~~~~~~~~~~~~~~~~");
          console.log("~ LOOP - jogada sem comer | recursiva-"+profundidade);
          console.log("~ casa onca vai jogar- "+casa_onca);
          console.log("~~~~~~~~~~~~~~~~~~~~");

          mudarCasa(casa_onca, "onca", 0);

          tabuleiro_jogada = $("#computer").html();
          $("#computer .cachorro").each(function( index ) {
            var posicao_atual_cachorro = $(this).attr('id');
            var jogada_cachorro = movimentos[ posicao_atual_cachorro ];
            console.log(" - - - - - cachorro-"+posicao_atual_cachorro+" | "+(index+1)+"/"+(14-cachorros)+" - - - - - ");

            jogada_cachorro.forEach(function(item) {
              if( $("#computer #"+item).hasClass("livre") ){
                mudarCasa(item, "cachorro", posicao_atual_cachorro);
                console.log("cachorro: "+posicao_atual_cachorro+" => "+item);

                // se chegou no numero de jogadas a frente desejado
                if( profundidade_jogo == profundidade ) {
                  risco_jogada = calculaRisco(risco, comidos);

                  if( risco_global > risco_jogada && comidos_global <= comidos ) {
                    jogada_global = jogada;
                    risco_global = risco_jogada;
                    comidos_global = comidos;
                  } else if (risco_global == risco_jogada && getRandomInt(0,1) ) {
                    jogada_global = jogada;
                    comidos_global = comidos;
                  }
                } else {
                  profundidade_recursiva(risco_jogada,comidos,jogada,profundidade+1);
                }

                $("#computer").html( tabuleiro_jogada );
              }
            });

          });
        }
        $("#computer").html( tabuleiro );
      }
    } // for end
  }
  function profundidade_onca(casa_onca, casa_cachorro, comidos) {
    console.log("profundidade_onca");
    // come o cachorro
    mudarCasa(casa_cachorro, "come_cachorro", 0);
    // move onça
    mudarCasa(casa_onca, "onca", 0);

    var fim = 1;
    var tabuleiro = $("#computer").html();

    var casas = movimentos_onca[ $("#computer #"+casa_onca).attr("id") ];
    for(i=0; i < casas.length; i++) {
      if( $("#computer #"+casas[i].split(":")[0]).hasClass("livre") && $("#computer #"+casas[i].split(":")[1]).hasClass("cachorro") ) {
        var onca = casas[i].split(":")[0];
        var cachorro = casas[i].split(":")[1];
        console.log("~~~~~~~~~~~~~~~~~~~~");
        console.log("~ LOOP ONÇA");
        console.log(" casa onca vai jogar- "+onca+" | casa dog vai ser comido- "+cachorro);
        console.log("~~~~~~~~~~~~~~~~~~~~");

        // função recursiva q faz todas opções de comidos e atualiza melhor caso na variavel global
        profundidade_onca(onca, cachorro, comidos+1);
        fim = 0;
        $("#computer").html( tabuleiro );
      }
    }
    if(fim == 1){
      // só conta o risco do final da "comilança" pq é la q a jogada termina
      risco = calculaRisco(0, comidos+1);

      if( risco < risco_loop && comidos_loop <= comidos ) {
        risco_loop = risco;
        comidos_loop = comidos;
      } else if (risco_loop == risco && comidos_global <= comidos && getRandomInt(0,1)==1 ) {
        comidos_loop = comidos;
      }
    }
  }

  /*##########################################################################
  #                              OUTRAS FUNÇÕES
  ##########################################################################*/
  function calculaRisco(risco, comidos) {
    if((comidos+comidos_global) >= 5) return risco=0;
    var redor_onca = movimentos[ $("#computer .onca").attr("id") ];
    var casa_livre = 0;
    redor_onca.forEach(function(item) {
      if( $("#computer #"+item).hasClass("livre") ){
        casa_livre++;
      }
    });
    if(casa_livre <= 2) return risco=10000000;
    risco = risco + 10 - casa_livre + 1000 * (5-comidos_global-comidos);
    return risco;
  }
  function mudarCasa(id, animal, id_antigo) {
    if(animal == "onca") {
      // tira onça da casa
      $("#computer .onca").html("");
      $("#computer .onca").addClass("livre");
      $("#computer .onca").removeClass("onca");
      // move onça para local da jogada
      $("#computer #"+id).html('<img src="images/onca.png">');
      $("#computer #"+id).addClass("onca");
      $("#computer #"+id).removeClass("livre");
    } else if (animal == "cachorro") {
      // tira cachorro da casa
      $("#computer #"+id_antigo).html("");
      $("#computer #"+id_antigo).addClass("livre");
      $("#computer #"+id_antigo).removeClass("cachorro");
      // move cachorro para local da jogada
      $("#computer #"+id).html('<img src="images/cachorro.png">');
      $("#computer #"+id).addClass("cachorro");
      $("#computer #"+id).removeClass("livre");
    } else if(animal=="come_cachorro") {
      // come cachorro
      $("#computer #"+id).html("");
      $("#computer #"+id).addClass("livre");
      $("#computer #"+id).removeClass("cachorro");
    }
  }
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }
  $(function() {
    setTimeout( function(){ turnoOnca(); }, 2000 );
    console.log("START");
  });
  </script>
</body>
</html>
