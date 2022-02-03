const button = document.querySelectorAll(".list-item-pokemon")
const infopannel = document.querySelectorAll(".pokeinfo")
const closeButton = document.querySelectorAll('.close-button')
const infosearched = document.querySelector('.pokeinfo searched')

for(let i = 0; i < button.length; i++)
{
    button[i].addEventListener(
        'click', () =>
        {
            for(let i = 0; i < infopannel.length; i++)
            {
                infopannel[i].style.display = "none"
                
            }
            infopannel[i].style.display = "flex"
        }
    ) 
    closeButton[i].addEventListener(
        'click', () =>
        {
        infopannel[i].style.display = 'none'

    })

}


