
function jsonShop(json){
    console.log(json);

    const container = document.getElementById('results');
    container.innerHTML = '';

  

    for(let i=0; i<json.length; i++){
        console.log(json[i]);
        const cont = document.createElement('div');
        container.appendChild(cont);
        
    const save=document.createElement('button');  
    
    save.textContent="Clicca per salvare!";
    cont.appendChild(save);
    save.addEventListener('click', save);

    save.dataset.name=json[i].name;
    save.dataset.info=json[i].description;
    save.dataset.image=json[i].image_link;
    save.dataset.prezzo=json[i].price;

        const name = document.createElement('strong');
        name.innerHTML = json[i].name;
        cont.appendChild(name);
        
        const info = document.createElement('div');
        info.classList.add("info");
        info.textContent = json[i].description;
        cont.appendChild(info);
        
        const image = document.createElement('img');
        image.src=json[i].image_link;
        cont.appendChild(image);


        const prezzo= document.createElement('p');
        prezzo.textContent=json[i].price;
        cont.appendChild(prezzo);  
      
    

    }
}


function searchResponse(response){
    console.log(response);
    return response.json();
}

function search(event){
    // Leggo il tipo e il contenuto da cercare e mando tutto alla pagina PHP
    const form_data = new FormData(document.querySelector("#search form"));
    // Mando le specifiche della richiesta alla pagina PHP, che prepara la richiesta e la inoltra
    fetch("search_shop.php?brand="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(jsonShop);
    // Evito che la pagina venga ricaricata
    event.preventDefault();
}


document.querySelector("#search form").addEventListener("submit", search);







function save(event){
    // Preparo i dati da mandare al server e invio la richiesta con POST
    console.log("Salvataggio")
    // get parent card
    const card = event.currentTarget;
    const formData = new FormData();

    formData.append('name', card.dataset.name);
    formData.append('info', card.dataset.info);
    formData.append('image', card.dataset.image);
    formData.append('prezzo', card.dataset.prezzo);
    fetch("save.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
    event.stopPropagation();
  }
  
  function dispatchResponse(response) {
  
    console.log(response);
    return response.json().then(databaseResponse); 
  }
  
  function dispatchError(error) { 
    console.log("Errore");
  }
  
  function databaseResponse(json) {
    if (!json.ok) {
        dispatchError();
        return null;
    }
  }
