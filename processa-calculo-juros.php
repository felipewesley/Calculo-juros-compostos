<?php

  include('form-calculo-juros.html');

  echo "<div style='padding: 3vh; padding-top: 0px; '>";

  //VALIDACAO DE ENVIO CORRETO DO FORMULARIO
  if (isset($_POST['enviar'])) {

    //VALIDACAO SE VALORES INFORMADOS SAO NUMERICOS
    if ((is_numeric($_POST['taxa-juros'])) && (is_numeric($_POST['valor-financiamento']))) {

      //VALIDACAO CASO CAMPOS ESTEJAM VAZIOS
      if (($_POST['taxa-juros'] != '') && ($_POST['valor-financiamento'] != '')) {

        //PRE VISUALIZACAO DE DADOS ENVIADOS
        echo "<pre>";
        echo 'Valores enviados: <br><br>';
        print_r($_POST);
        echo "</pre>";

        //RESGATE DE DADOS ENVIADOS ATRAVES DO FORMULARIO
        $valor = $_POST['valor-financiamento'];
        $taxa = $_POST['taxa-juros'];
        $periodo = $_POST['periodo'];

        //CALCULO DE JUROS COMPOSTOS
        //
        // ValorTotalFinal = ValorInicial * ((1 + TaxaDeJurosAoMes)^PeriodoDeFinanciamento)
        // TotalDeJuros = ValorTotalFinal - ValorInicial
        //
        $base = ($taxa/100) + 1;
        $montanteTotal = $valor * (pow($base, $periodo));
        $juros = $montanteTotal - $valor;

        //FORMATACAO DE ALGUNS VALORES DO TIPO FLOAT 
        //FORMATAR COM 2 DIGITOS DEPOIS DA VIRGULA
        $valor = number_format($valor,2,',','');
        $montanteTotal = number_format($montanteTotal,2,',','');
        $juros = number_format($juros,2,',','');

        //IMPRESSAO DOS RESULTADOS
        echo "Valor inicial do financiamento: R$ $valor <br>";
        echo "Taxa de juros: $taxa %a.m. <br>";
        echo "Quantidade de parcelas: $periodo parcelas. <br><hr>";
        echo "<b>Valor final do financiamento</b>: R$ $montanteTotal <br>";
        echo "<b>Valor de JUROS</b>: R$ $juros <br>";

      } else{ //CAMPOS DO FORM VAZIOS
        echo 'Por favor, forneça os dados para base de cálculo. '; 
      }
    } else{ //DADOS INFORMADOS NAO SAO NUMEROS
      echo 'Por favor, forneça valores numéricos! '; 
    }

  } else{ //FORMULARIO NAO FOI SUBMETIDO CORRETAMENTE
    echo 'Por favor, forneça os dados para base de cálculo. '; 
  }

  echo '</div>'; 

