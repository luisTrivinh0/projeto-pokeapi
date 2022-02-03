<?php

// Pokemon ID ----------------------------------------------------------
function pokemonId($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
    $pokemonId = $results[$index]->id;
    return $pokemonId;
}

// Pokemon Sprite ----------------------------------------------------------
function pokemonSprite($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
         $pokemonSprite = $results[$index]->sprites->front_default;
    return $pokemonSprite;


    
}
function pokemonSpriteShiny($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
         $pokemonSpriteShiny = $results[$index]->sprites->front_shiny;
    return $pokemonSpriteShiny;


    
}

// Pokemon Type ----------------------------------------------------------
function pokemonType($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
    set_error_handler('error');

    $pokemonType = $results[$index]->types[0];

    if(sizeof($results[$index]->types) >= 2){
    $pokemonType1 = $results[$index]->types[0]->type->name;
    $pokemonType2 = $results[$index]->types[1]->type->name;
    return $pokemonType1.' & '.$pokemonType2;
    }
    else{
        $pokemonType1 = $results[$index]->types[0]->type->name;
        return $pokemonType1;
    }
}

// Pokemon Abilities ----------------------------------------------------------
function pokemonAbilities($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
    set_error_handler('error2');

    $pokemonAbility = $results[$index]->abilities[0];

    if(sizeof($results[$index]->abilities) >= 2){
    $pokemonAbility1 = $results[$index]->abilities[0]->ability->name;
    $pokemonAbility2 = $results[$index]->abilities[1]->ability->name;
    return $pokemonAbility1. ' & '.$pokemonAbility2;
    }
    else{
        $pokemonAbility1 = $results[$index]->abilities[0]->ability->name;
        return $pokemonAbility1;
    }
}

// Pokemon Description ----------------------------------------------------------
function pokemonDescription($pokemonName, $index){

    global $results;
    createInfoUrl($pokemonName, $index);
    set_error_handler('error2');


    if($pokemonDescription = $results[$index]->flavor_text_entries[1]->language->name === 'en'){
        $pokemonDescription = $results[$index]->flavor_text_entries[1]->flavor_text;
        return $pokemonDescription;

    } // In case the description is in japanese, i fix it and put the english one
    else{
        $pokemonDescription = $results[$index]->flavor_text_entries[2]->flavor_text;
        return $pokemonDescription;
    } 
}

// Pokemon Height/Weight----------------------------------------------------------
function pokemonHeight($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
    set_error_handler('error2');


    $pokemonHeight = $results[$index]->height;
    return $pokemonHeight;
}

function pokemonWeight($pokemonName, $index)
{
    global $results;

    createPokemonUrl($pokemonName, $index);
    set_error_handler('error2');


    $pokemonWeight = $results[$index]->weight;

    return $pokemonWeight/10;

}
?>
