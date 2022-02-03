<?php
  // Cria a URL Geral
  $generalUrl = 'https://pokeapi.co/api/v2/pokemon/?';
  $generalUrl .= http_build_query([
    'offset' => 0,
    'limit' => 151,
  ]);
  // Criando URL 
  function createUrl($url, $index){
    global $results;
    // Cache
    $cacheKey = md5($url);
    $cachePath = './cache/'.$cacheKey;
    $cacheUsed = false;
    // Cache disponível
    if(file_exists($cachePath)){
        $results[$index] = file_get_contents($cachePath);
        $cacheUsed = true;
    }else{
      // Cache indisponível
      // Chama a API
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      $results[$index] = curl_exec($curl);
      curl_close($curl);  
      // Salva no cache
      file_put_contents($cachePath, $results[$index]);
    }
    // Decode JSON
    $results[$index] = json_decode($results[$index]);
  };
  // Cria os link dos pokemons
  function createPokemonUrl($pokemonName, $index){
    global $results;
    // Cria o link do pokemon
    $pokemonUrl = 'https://pokeapi.co/api/v2/pokemon/';
    $pokemonUrl .= $pokemonName;
    createUrl($pokemonUrl, $index);
  }
  // Chamado para outras informaçoes (como a descriçao do pokemon)
  function createInfoUrl($pokemonName, $index){
    global $results;
    $pokeInfoUrl = "https://pokeapi.co/api/v2/pokemon-species/";
    $pokeInfoUrl .= $pokemonName;
    createUrl($pokeInfoUrl, $index);
  }   

  createUrl($generalUrl, 0);
  if($searchedPokemon = !empty($_GET['pokemon'])){
      $searchedPokemon = empty($_GET['pokemon']) ? '' : strtolower($_GET['pokemon']);  
  }
  // Erro se $searchedPokemon não existir
  function error(){
    echo 'Pokémon Desconhecido - ';
  }
  function error2(){
      echo ' ';
  }
  $pokemon = $results[0]->results;
?>