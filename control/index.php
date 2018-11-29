<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 21/11/2018
 * Time: 10:25
 */

include_once ('../model/Ingresso.php');
include_once ('../pdo/IngressoPDO.php');
include_once ('../pdo/FilmePDO.php');
include_once ('../model/Filme.php');
include_once ('../pdo/SalaPDO.php');
include_once ('../model/Sala.php');
include_once ('../model/Sessao.php');
include_once ('../pdo/SessaoPDO.php');

$filmePDO = new FilmePDO();
$salaPDO = new SalaPDO();
$sessaoPDO = new SessaoPDO();
$ingressoPDO = new IngressoPDO();
$assentos[5][10] = Array();


$sair = 1;

while($sair){
    echo "\n\n--------------Menu--------------";
    echo "\n1. Manter Filmes: ";
    echo "\n2. Manter Salas: ";
    echo "\n3. Manter Sessões: ";
    echo "\n4. Manter Ingressos: ";
    echo "\nOpção (ZERO para sair): ";
    $sair = readline();

    switch ($sair) {
        case 1:
            $exit = 1;
            while ($exit) {
                echo "\n\n--------- Submenu Filmes ---------";
                echo "\n1. Adicionar Filmes: ";
                echo "\n2. Atualizar Filmes ";
                echo "\n3. Listar Filmes ";
                echo "\n4. Remover Filmes ";
                echo "\nOpção (ZERO para sair): ";
                $exit = readline();
                switch ($exit) {
                    case 1:
                        adicionaFilme();
                        break;
                    case 2:
                        alteraFilme();
                        break;
                    case 3:
                        listaFilme();
                        break;
                    case 4:
                        excluiFilme();
                        break;
                }
            }
        case 2:
            $exit2 = 1;
            while ($exit2) {
                echo "\n\n--------- Submenu Salas ---------";
                echo "\n1. Adicionar Salas: ";
                echo "\n2. Atualizar Salas ";
                echo "\n3. Listar Salas ";
                echo "\n4. Remover Salas ";
                echo "\nOpção (ZERO para sair): ";
                $exit2 = readline();
                switch ($exit2) {
                    case 1:
                        adicionaSala();
                        break;
                    case 2:
                        alteraSala();
                        break;
                    case 3:
                        listaSala();
                        break;
                    case 4:
                        excluiSala();
                        break;
                }
            }

        case 3:
            $exit3 = 1;
            while ($exit3) {
                echo "\n\n--------- Submenu Sessões ---------";
                echo "\n1. Adicionar Sessões: ";
                echo "\n2. Atualizar Sessões ";
                echo "\n3. Listar Sessões ";
                echo "\n4. Remover Sessões ";
                echo "\nOpção (ZERO para sair): ";

                $exit3 = readline();
                switch ($exit3) {
                    case 1:
                        adicionaSessao();
                        break;
                    case 2:
                        alteraSessao();
                        break;
                    case 3:
                        listaSessao();
                        break;
                    case 4:
                        encerraSessao();
                        break;
                }
            }
        case 4:
            $exit4 = 1;
            while ($exit4) {
                echo "\n\n--------- Submenu Ingressos ---------";
                echo "\n1. Comprar ingressos: ";
                echo "\n2. Listar assentos";
                echo "\nOpção (ZERO para sair): ";

                $exit4 = readline();
                switch ($exit4) {
                    case 1:
                        vendeIngresso();
                        break;
                    case 2:
                        listaIngresso();
                        break;
                }
            }
    }
}

function listaIngresso(){

    global $assentos;
    global $sessaoPDO;
    global $ingressoPDO;

    echo "\nSelecione qual sessão você deseja verificar: ";
    $sessoes = $sessaoPDO->findAll();
    if ($sessoes != null) {
        echo "\nLista de sessões disponiveis: \n";
        print_r($sessoes);
        echo "\nDigite o ID da sessão que deseja assistir: \n";
        $codigo = readline();

        $sessao = $sessaoPDO->findById($codigo);


        $qtd_assento = $sessao->getSala()->getCapacidade();
        $arrayFila = ['A: ', 'B: ', 'C: ', 'D: ', 'E: '];

        for ($i = 0; $i < $qtd_assento / 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $assentos[$i][$j] = $j . " ";
//                echo $j+1 . " ";
            }
        }
        $ingressos = $ingressoPDO->findById($sessao->getId());


        foreach ($ingressos as $ingresso) {
            if ($ingresso->getFileira() === 'A') {
                $assentos[0][$ingresso->getAssento()] = '- ';
            } else if ($ingresso->getFileira() === 'B') {
                $assentos[1][$ingresso->getAssento()] = '- ';
            } else if ($ingresso->getFileira() === 'C') {
                $assentos[2][$ingresso->getAssento()] = '- ';
            } else if ($ingresso->getFileira() == 'D') {
                $assentos[3][$ingresso->getAssento()] = '- ';
            } else if ($ingresso->getFileira() == 'E') {
                $assentos[4][$ingresso->getAssento()] = '- ';
            }
        }


        echo "\nAssentos disponiveis: ";

        $arrayFila = ['A: ', 'B: ', 'C: ', 'D: ', 'E: '];

        echo "\n";
        for ($i = 0; $i < 50 / 10; $i++) {
            echo "\n" . $arrayFila[$i];
            for ($j = 0; $j < 10; $j++) {
                echo $assentos[$i][$j];
            }
        }
    }
}




function vendeIngresso()
{

    global $assentos;
    global $sessaoPDO;
    global $ingressoPDO;

    echo "\nSelecione qual sessão deseja assistir: ";
    $sessoes = $sessaoPDO->findAll();
    if ($sessoes != null) {
        echo "\nLista de sessões disponiveis: \n";
        print_r($sessoes);
        echo "\nDigite o ID da sessão que deseja assistir: \n";
        $codigo = readline();

        $sessao = $sessaoPDO->findById($codigo);


        $qtd_assento = $sessao->getSala()->getCapacidade();
        $arrayFila = ['A: ', 'B: ', 'C: ', 'D: ', 'E: '];

        for ($i = 0; $i < $qtd_assento / 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $assentos[$i][$j] = $j." ";
//                echo $j+1 . " ";
            }
        }
        $ingressos = $ingressoPDO->findById($sessao->getId());


        foreach ($ingressos as $ingresso){
            if($ingresso->getFileira()==='A'){
                $assentos[0][$ingresso->getAssento()] = '- ';
            }else if($ingresso->getFileira()==='B'){
                $assentos[1][$ingresso->getAssento()] = '- ';
            }else if($ingresso->getFileira()==='C'){
                $assentos[2][$ingresso->getAssento()] = '- ';
            }else if($ingresso->getFileira()=='D'){
                $assentos[3][$ingresso->getAssento()] = '- ';
            }else if($ingresso->getFileira()=='E'){
                $assentos[4][$ingresso->getAssento()] = '- ';
            }
        }

        $arrayFila = ['A: ', 'B: ', 'C: ', 'D: ', 'E: '];

        echo "\n";
        for ($i = 0; $i < 50 / 10; $i++) {
            echo "\n" . $arrayFila[$i];
            for ($j = 0; $j <10; $j++) {
                echo $assentos[$i][$j];
            }
        }

        $ingressoNew = new Ingresso();

        echo "\n\nSelecione seu ingresso: (Já vendido: - )";
        echo "\nDigite sua fileira: ";
        $ingressoNew->setFileira(readline());
        echo "\nDigite seu assento: ";
        $ingressoNew->setAssento(readline());
        echo "\nQual o tipo de ingresso? Inteira(1) Meia-entrada(2)";
        $ingressoNew->setTipo(readline());
        $ingressoNew->setSessao($sessao);

        if($ingressoPDO->insert($ingressoNew)){
            echo "\nIngresso vendido";
        }else{
            echo "\nNão foi possível vender o Ingresso.";
        }



    }
}


// ---------------------------------------- SESSAO ------------------------------------------


function encerraSessao(){
    global $sessaoPDO;
    echo "\nSelecione a sessão que deseja encerrar: ";
    $sessoes = $sessaoPDO->findAll();
    if($sessoes != null){
        echo "\nLista de sessões cadastrados:\n";
        print_r($sessoes);
        echo "\nCódigo da sala (ID) (0 para sair): \n";
        $codigo = readline();
        while($codigo != 0){
            echo "\nVocê tem certeza que deseja encerrar esta sessão (s/n)? ";
            $opcao = readline();
            if($opcao === 's'){
                $sessao = new Sessao();
                $sessao->setId($codigo);


                if($sessaoPDO->delete($sessao)){
                    echo "\nSessão exluída.";
                }else{
                    echo "\nErro ao tentar excluir.";
                }
            }
            echo "\nVocê deseja excluir outra sessão (0 para sair)?";
            $codigo = readline();
        }
    }
}



function alteraSessao(){

    global $sessaoPDO;
    global $filmePDO;
    global $salaPDO;

    echo "\n--------- Alterar uma sessão já existente no banco ---------";
    echo "\nEscolha uma das sessões para editar (Digitar o ID): ";

    $sessoes = $sessaoPDO->findAll();
    print_r($sessoes);
    $pesquisa = readline();
    $sessao = $sessaoPDO->findById($pesquisa);
    echo "\n\n A sessão ". $sessao->getId() ." -- Filme: ". $sessao->getFilme()->getTitulo()." foi selecionada\n";
    print_r($sessao);

    if($sessao != null){
        echo "\nDigite  a data da sessão do filme? (0 para não alterar)";
        $data = readline();
        if($data!=0){
            $sessao->setDataSessao($data);
        }

        echo "\nDigite o horário da sessão (0 para não alterar)";
        $horario = readline();
        if($horario!=0){
            $sessao->setHoraSessao($horario);
        }

        echo "\nDigite o valor do ingresso (0 para não alterar)";
        $valor = readline();
        if($valor!=0){
            $sessao->setValorInteira($valor);
            $sessao->setValorMeia($valor/2);
        }

        echo "\n Deseja alterar o filme? (s/n)";
        $resposta = readline();
        if($resposta == 's'){
            echo "\n Digite qual filme você deseja , digite o ID (0 para não alterar)";
            print_r($filmePDO->findAll());
            $newFilme = readline();
            if($newFilme!=0){
                $sessao->setFilme($filmePDO->findById($newFilme));
            }
        }

        echo "\nDeseja alterar a sala? (s/n) ";
        $resposta2 = readline();
        if($resposta2 == 's'){
            echo "\n Digite qual sala você deseja , digite o ID (0 para não alterar)";
            print_r($salaPDO->findAll());
            $newSala = readline();
            if($newSala!=0){
                $sessao->setSala($salaPDO->findById($newSala));
            }
        }

        if($sessaoPDO->update($sessao)){
            echo "\nFilme alterado.";
        }else{
            echo "\nNão foi possível alterar o Filme.";
        }




    }
}

function listaSessao(){
    global $sessaoPDO;
    $sessao = $sessaoPDO->findAll();
    echo "\nSessoes cadastrados no sistema:\n";
    print_r($sessao);
}



function adicionaSessao(){
    global $salaPDO;
    global $filmePDO;
    global $sessaoPDO;
    $sessao = new Sessao();

    echo "\nSelecione o filme que deseja adicionar na lista abaixo";

    $filmes = $filmePDO->findAll();
    if($filmes != null){
        echo "\nFilmes cadastrados";
        print_r($filmes);
        $filme = null;
        while($filme == null){
            $id =readline();
            $filme = $filmePDO->findById($id);
            if($filme != null){
                echo "\nFilme ". $filme->getTitulo(). " -- ID: ". $filme->getIdFilme()."  selecionado\n";
                $sessao->setFilme($filme);
            }else{
                echo "\nNão foi possivel selecionar este filme.";
            }
        }

        $exit = -1;
        while ($exit !=0){
            echo "\nSelecione a sala que deseja adicionar: ";
            $salas = $salaPDO->findAll();
            if($salas != null && $exit !=0){
                echo "\nLista de salas cadastradas\n";
                print_r($salas);
                $sala = null;
                while ($sala == null){
                    $id = readline();
                    $sala = $salaPDO->findById($id);
                    if($sala != null){
                        echo "\nSala: " . $sala->getNumSala() ." -- ID: ". $sala->getIdSala() . " selecionada";
                        $sessao->setSala($sala);
                        $exit = 0;
                    }else {
                        echo "\nNão foi possivel selecionar essa sala";
                    }


                }
            }
        }


        echo "\nDigite a data da sessão: ";
        $sessao->setDataSessao(readline());

        echo "\nDigite o horário da sessão: ";
        $sessao->setHoraSessao(readline());

        echo "\nDigite o valor do ingresso: ";
        $sessao->setValorInteira(readline());
        $sessao->setValorMeia(($sessao->getValorInteira()/2));

        if($sessaoPDO->insert($sessao)){
            echo "\nSessao inserida com sucesso";
        }else {
            echo "\nFalha ao inserir";
        }
    }
}


// ---------------------------    -----------   SALA -----------------------------------------------


function adicionaSala(){
    $sala = new Sala();
    global $salaPDO;

    echo "\n--------- Inserir uma nova Sala ---------";

    echo "\nDigite o numero da sala: (max 50)";
    $sala->setNumSala(readline());

    echo "\nDigite a capacidade máxima da sala:  ";
    if($sala<=50){
        $sala->setCapacidade(readline());
    }

    if($salaPDO->insert($sala)){
        echo "\nSala adicionada";
    }else {
        echo "\nNão foi possível adicionar a sala";
    }
}

function listaSala(){

    global $salaPDO;

    $salas= $salaPDO->findAll();

    if($salas){
        print_r($salas);
    }

}


function alteraSala(){

    global $salaPDO;

    echo "\n--------- Alterar uma sala existente no banco ---------";
    echo "\nQual sala você deseja alterar";
    print_r($salaPDO->findAll());

    echo "\nLocalize a sala na lista e digite o código da sala para poder alterá-lo";
    echo "\nDigite o ID da sala: ";
    $id = readline();

    $sala = $salaPDO->findById($id);

    if($sala != null) {
        echo "\nDigite o numero da sala (0 para não alterar): ";
        $numero = readline();
        if ($numero != null) {
            $sala->setNumSala($numero);

            echo "\nDigite a capacidade máxima da sala (0 para não alterar): ";
            $capacidade = readline();
            if( $capacidade != 0){
                $sala->setCapacidade($capacidade);
            }

            if($salaPDO->update($sala)){
                echo "\nSala alterado.";
            }else{
                echo "\nNão foi possível alterar a sala.";
            }
        }
    }
}


function excluiSala(){
    global $salaPDO;
    echo "\nSelecione a sala na lista abaixo digitando seu código";
    $salas = $salaPDO->findAll();
    if($salas != null){
        echo "\nLista de salas cadastrados:\n";
        print_r($salas);
        echo "\nCódigo da sala (0 para sair): ";
        $codigo = readline();
        while($codigo != 0){
            echo "\nVocê tem certeza que deseja excluir esta sala (s/n)? ";
            $opcao = readline();
            if($opcao === 's'){
                $sala = new Sala();
                $sala->setIdSala($codigo);
                $sala->setDeletado(TRUE);


                if($salaPDO->delete($sala)){
                    echo "\nSala exluído.";
                }else{
                    echo "\nErro ao tentar excluir.";
                }
            }
            echo "\nVocê deseja excluir outra sala (0 para sair)?";
            $codigo = readline();
        }
    }
}




// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~  FILME~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function excluiFilme(){
    global $filmePDO;
    echo "\nSelecione o filme na lista abaixo digitando seu código";
    $filmes = $filmePDO->findAll();
    if($filmes != null){
        echo "\nLista de filmes cadastrados:\n";
        print_r($filmes);
        echo "\nCódigo do filme (0 para sair): ";
        $codigo = readline();
        while($codigo != 0){
            echo "\nVocê tem certeza que deseja excluir este filme (s/n)? ";
            $opcao = readline();
            if($opcao === 's'){
                $filme = new Filme();
                $filme->setIdFilme($codigo);
                $filme->setDeletado(TRUE);


                if($filmePDO->delete($filme)){
                    echo "\nFilme exluído.";
                }else{
                    echo "\nErro ao tentar excluir.";
                }
            }
            echo "\nVocê deseja excluir outro filme (0 para sair)?";
            $codigo = readline();
        }
    }
}


function listaFilme(){

    global $filmePDO;

    $filmes= $filmePDO->findAll();

    if($filmes){
        print_r($filmes);
    }

}

function alteraFilme(){

    global $filmePDO;

    echo "\n--------- Alterar um filme existente no banco ---------";
    echo "\nDigite o nome do filme: ";
    $pesquisa = readline();
    print_r($filmePDO->findByNome($pesquisa));

    echo "\nLocalize o filme na lista e digite o código do filme para poder alterá-lo";
    echo "\nDigite o código do filme: ";
    $id = readline();

    $filme = $filmePDO->findById($id);

    if($filme != null) {
        echo "\nDigite o nome do filme (0 para não alterar): ";
        $titulo = readline();
        if ($titulo != null) {
            $filme->setTitulo($titulo);

            echo "\nDigite a duração do filme (0 para não alterar): ";
            $duracao = readline();
            if( $duracao != 0){
                $filme->setDuracao($duracao);
            }

            if($filmePDO->update($filme)){
                echo "\nFilme alterado.";
            }else{
                echo "\nNão foi possível alterar o Filme.";
            }
        }
    }
}

function adicionaFilme(){
    $filme = new Filme();
    global $filmePDO;

    echo "\n--------- Inserir um novo filme ---------";

    echo "\nDigite o nome do filme: ";
    $filme->setTitulo(readline());

    echo "\nDigite a duração do filme: ";
    $filme->setDuracao(readline());

    if($filmePDO->insert($filme)){
        echo "\nFilme adicionado";
    }else {
        echo "\nNão foi possível adicionar o filme";
    }
}
