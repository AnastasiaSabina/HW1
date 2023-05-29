function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    
    //string prende il valore dell'input e lo trasforma prima in stringa e poi con tolowercase tutto in minuscolo
    if(!/^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/.test(String(emailInput.value).toLowerCase())) {
      
        //seleziona il blocchetto span dell'html e gli sta aggiungendoil testo email non valida, prende lo span per definire la posizione dove inserire il testo di errore
       //textcontent serve a modificare o aggiungere un testo
       document.querySelector('.email span').textContent = "Email non valida";
       
       //seleziona la classe email e aggiunge la classe errore che è una classe inserita per fare spuntare in rosso in maniera dinamica la scritta 'email non valida'

       document.querySelector('.email').classList.add('errore');
        formStatus.email = false;
        //è come se formStatus fosse una variabile è col meno si assegna il suo valore

    } else {

        //encodeURIComponent serve a codificare i caratteri speciali. 
        //emailInput.value passa il valore della mail inserita dall'utente con string lo trasfroma ins tringa e con tolowercase trasfroam tutta la stringa in minuscolo
        //"check_email.php?q=" è una sorta di endpoint
               fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

//La proprietà .ok di sola lettura dell'interfaccia Response contiene un valore booleano che indica se la risposta ha avuto successo o meno.
function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errore');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errore');
    }
}


function checkUsername(event) {
    const input = document.querySelector('.username input');//associa alla costante la casella dove l'utente deve inserire l'username

    if(!/^[a-z0-9_-]{3,15}$/.test(input.value)) {
        
        //prende il valore inserito dell'utente se questo è diverso dal pattern allora nello span farà appire il testo inserito con textcontent
        input.parentNode.querySelector('span').textContent = "Sono ammesse lettere minuscole, numeri e underscore. Max 15 caratteri";


        input.parentNode.classList.add('errore');
        formStatus.username = false;

    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function jsonCheckUsername(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errore');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errore');
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('.password').classList.remove('errore');
    } else {
        document.querySelector('.password span').textContent = "La password deve contenere almeno 8 caratteri";
        document.querySelector('.password').classList.add('errore');
    }

}

function checkConfermaPassword(event) {
    const confermaPasswordInput = document.querySelector('.conferma_password input');
   
    //confronta il valore della password del "conferma password" con il valore della password inserito prima in "password"
    if (formStatus.confermaPassword = confermaPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.conferma_password').classList.remove('errore');
    } else {

        document.querySelector('.conferma_password span').textContent = "Le password non coincidono";
        document.querySelector('.conferma_password').classList.add('errore');
    }
}

function checkName(event) {
    //currentTarget memorizza ciò che clicco dentro la variabile input
    const input = event.currentTarget;
    
    //Node è il padre del nodo corrente. Il genitore di un elemento è un Element nodo, un Document nodo.
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.classList.remove('errore');
    } else {
        input.parentNode.classList.add('errore');
        document.querySelector('.name span').textContent = "Inserisci il tuo nome";
    }
}

function checkLastname(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.lastname] = input.value.length > 0) {
        input.parentNode.classList.remove('errore');
    } else {
        input.parentNode.classList.add('errore');
        document.querySelector('.lastname span').textContent = "Inserisci il tuo cognome";
   
    }
}


function checkUpload(event) {
    const upload_original = document.getElementById('upload_original');
    document.querySelector('#upload .file_name').textContent = upload_original.files[0].name;
    const o_size = upload_original.files[0].size;
    const mb_size = o_size / 1000000;
    document.querySelector('#upload .file_size').textContent = mb_size.toFixed(2)+" MB";
    const ext = upload_original.files[0].name.split('.').pop();

    if (o_size >= 7000000) {
        document.querySelector('.fileupload span').textContent = "Le dimensioni del file superano 7 MB";
        document.querySelector('.fileupload').classList.add('errore');
        formStatus.upload = false;
    } else if (!['jpeg', 'jpg', 'png', 'gif'].includes(ext))  {
        document.querySelector('.fileupload span').textContent = "Le estensioni consentite sono .jpeg, .jpg, .png e .gif";
        document.querySelector('.fileupload').classList.add('errore');
        formStatus.upload = false;
    } else {
        document.querySelector('.fileupload').classList.remove('errore');
        formStatus.upload = true;
    }
}

function clickSelectFile(event) {
    document.querySelector('#upload_original').click();
}

function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    formStatus[checkbox.name] = checkbox.checked;
    //Object.keys fa sì che se la lunghezza della mappa che contiene chiavi è diversa da 8 o se uno dei campi è false cioè non è compilato PREVENTDEFAULT cioè previene che 
    //che l'azione del sign up avvenga. Esempio: se i campi non sono tutti pieni non ci fa registrare
    
    if (Object.keys(formStatus).length !== 8 || Object.values(formStatus).includes(false)) 
    {
        event.preventDefault();
    } 
}

const formStatus = {'upload': true};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.lastname input').addEventListener('blur', checkLastname);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.conferma_password input').addEventListener('blur', checkConfermaPassword);
document.querySelector('#upload').addEventListener('click', clickSelectFile);
document.querySelector('#upload_original').addEventListener('change', checkUpload);
//seleziona un elemento dell'html e aggiungo il listener tramite il submit che mi rimanda alla funzione signup
document.querySelector('.submit submit').addEventListener('submit', checkSignup);