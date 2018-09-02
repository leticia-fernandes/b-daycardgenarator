<?php

$nome           = $_POST['nome'];
$genero         = $_POST['genero'];
$relacionamento = $_POST['relacionamento'];

try{
    validarParams($nome, $genero, $relacionamento);
    $mensagem = selecionarMensagem($relacionamento);
    $estilo = selecionarEstilo($genero);
    $titulo = selecionarTitulo();

    $card = construirCartao($titulo, $nome, $estilo, $mensagem);
    $cartao = '<div id="cartao">'.$card.'
                </div>
                <script>
                    html2canvas(document.querySelector("#cartao"), {width: 545, height: 480})
                    .then(canvas => {$("#cartao").html(canvas);});
                </script>';

    $return['success'] = true;
    $return['result']  = $cartao;
}catch(Exception $e){
    $return['success'] = false;
    $return['msg']     = $e->getMessage();
}

echo json_encode($return);






function validarParams($nomeA, $generoA, $relacionamentoA){
    if(empty($nomeA)){
        throw new Exception('Você precisa informar um nome.');
    }elseif(strlen($nomeA) > 15){
        throw new Exception('O nome deve conter até 15 caracteres.');
    }

    if(empty($generoA))
        throw new Exception('Você precisa informar o gênero.');

    if(empty($relacionamentoA))
        throw new Exception('Você precisa informar um relacionamento.');
}

function selecionarMensagem($relacionamento){
    switch($relacionamento){
        case 'amizade':
            return mensagem(1,5);
            break;

        case 'amor':
            return mensagem(6,10);
            break;

        default:
            return mensagem(11,15);
            break;
    }
}

function mensagem($min, $max){
    $num = rand($min,$max);

    $mensagem = array(
        1 => "Que o seu dia seja tão lindo quanto o seu sorriso e lhe ofereça tanta felicidade quanto a sua amizade envia para a minha vida. Que esta nova etapa chegue recheada de muita saúde e novas oportunidades para concretizar os seus sonhos mais desejados.",
        2 => "Que a alegria acompanhe você por todos os momentos e que Deus continue guiando todos os seus passos e iluminando cada vez mais os seus pensamentos. ",
        3 => "Nada como chegar nesta data e ver tudo que passamos, o quanto somos queridos neste mundo que vivemos. É muito bom saber, que os anos vão, a idade chega, e você sempre continua o mesmo, sempre com o mesmo sorriso, sempre com a mesma alegria de viver. ",
        4 => "Amizade não é algo que está escrito em um papel, pois o papel pode ser rasgado. Também não é algo que pode ser escrito em uma pedra, pois mesmo uma pedra pode quebrar. Mas está escrito no coração de uma pessoa, e ela fica lá para sempre. Desejo um feliz aniversário e muitas bênçãos em sua vida!",
        5 => "É bom saber que nesse mundo, existe uma pessoa especial como você, para tomar a amizade. Que muitos e muitos anos cheguem a preencher sua alma de bom ânimo e fé.",
        6 => "Hoje quero falar tudo que sinto por você. Sim, porque hoje não é um dia igual a todos os outros. Parabéns, meu amor! Desejo que seu aniversário seja tão maravilhoso e inesquecível como você é para mim. ",
        7 => "Parabéns, meu amor! É com muita felicidade que celebro seu aniversário mais uma vez. Só desejo que esse ritual se mantenha sempre. Sim, porque você é a pessoa que mais amo na vida, é minha alma gêmea, minha razão de viver. ",
        8 => "Desejo que a alegria e a paz estejam sempre do seu lado, mas que se manifestem ainda mais no dia de hoje. Tenha um feliz aniversário, meu bem. Te amo!",
        9 => "Você torna meus dias mais coloridos e transforma quaisquer sensações menos positivos em comemorações inesquecíveis. Eu gosto de você de verdade por tudo que representamos um para o outro. Tenha um dia maravilhoso, meu bem!",
        10 => "Que este dia tão lindo e especial possa se tornar inesquecível, como os lindos momentos que já vivemos, e tantos outros que ainda vamos viver!",
        11 => "Hoje é o seu aniversário e por isso é um dia de festa. Espero que celebre com muita alegria e encha o coração de gratidão e esperança para viver mais um ano de vida. ",
        12 => "Eu desejo toda a felicidade do mundo, muito amor, sucesso e saúde para todos os dias. Você merece tudo de bom que acontecer, pois é uma pessoa especial. ",
        13 => "Que seja um dia inesquecível e o início de um novo ano na sua vida cheio de felicidade e muitas realizações.",
        14 => "Desejo que este dia seja muito feliz, repleto de surpresas encantadoras e passado ao lado de quem você mais ama. Tenha um aniversário muito especial; rodeie-se de sensações positivas. E divirta-se! ",
        15 => "Hoje você completa mais um ano de vida e é hora de comemorar com muita alegria. Que seu dia seja repleto de luz e paz. Que as pessoas queridas estejam com você e que o amor invada seu coração!",
    );
    
    return $mensagem[$num];
}

function selecionarEstilo($genero){
    $min = 1;
    $max = 3;

    if($genero == "homem"){
        $min = 4;
        $max = 6;
    }

    $num = rand($min,$max);

    $estilos = array(
        1 => "woman1",
        2 => "woman2",
        3 => "woman3",
        4 => "man1",
        5 => "man2",
        6 => "man3"
    );
    
    return $estilos[$num];
}

function selecionarTitulo(){
   
    $num = rand(1,2);

    $titulos = array(
        1 => "Feliz Aniversário",
        2 => "Parabéns"
    );
    
    return $titulos[$num];
}


function construirCartao($titulo, $aniversariante, $estilo, $mensagem){
    $cartao = '<div class="card full-screen '.$estilo.'">
                <div class="middle-fullscreen">
                    <h1 class="text-center">'.$titulo.', <span>'.$aniversariante.'</span> !</h1>
                    <p class="text-center">'.$mensagem.'</p>
                </div>
              </div>';
    return $cartao;
}

?>