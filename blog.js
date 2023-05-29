function jsonBlog(json) {
    console.log(json);

    const container = document.getElementById('results');
    container.innerHTML = '';

    const cont = document.createElement('div');
    container.appendChild(cont);

    const testo = document.createElement('p');
    testo.innerHTML = json.body;
    cont.appendChild(testo); 
        
}

search();
function search(){
    fetch("search_blog.php?").then(onResponse).then(jsonBlog);
}


function onResponse(response){
    console.log(response);
    return response.json();
}




  