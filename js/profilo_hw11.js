
function onJsonArticoli(json){
  console.log(json);
  for(let result of json ){
    const container= document.getElementById(result.ordine)
    const art = document.createElement('div');
    art.classList.add('articoli');
    art.dataset.id=result.articolo;
    const img=document.createElement("img");
    img.src=result.immagine;
    art.appendChild(img);
    const div= document.createElement('div');

    const code=document.createElement('p');
    code.textContent="Codice Articolo: "+ result.articolo;
    const des=document.createElement('p');
    des.textContent="Descrizione: "+result.descrizione;
    const misura=document.createElement('p');
    misura.textContent="Misura: "+result.misura;
    const q= document.createElement('p');
    q.textContent="Quantità: "+result.quantita;
    const prezzo=document.createElement('p');
    prezzo.textContent="Prezzo: "+result.prezzo + " €";

    div.appendChild(code);
    div.appendChild(des);
    div.appendChild(misura);
    div.appendChild(q);
    div.appendChild(prezzo);

    const button=document.createElement("button");
    button.textContent="Recensisci";
    button.id="recensione";
    div.appendChild(button);
    art.appendChild(div);
    container.appendChild(art);
    
    button.addEventListener('click',gestisciRecensione);

  }
}

function onResponseArticoli(response){
  return response.json();
}
  
  function onJsonOrdini(json){
    console.log(json);
    const section= document.querySelector('section');
    const h1= document.createElement('h1');
    if(json.length===0){
      h1.textContent= "Non hai ancora effettuato ordini";
      section.appendChild(h1);
    }else{
      h1.textContent="I tuoi ordini";
      section.appendChild(h1);
      for(let result of json ){
        const container= document.createElement('div');
        container.classList.add('container');
        container.id=result.id; 
        container.dataset.id=result.id;
        const ordine = document.createElement('div');
        ordine.classList.add('ordini');
        container.appendChild(ordine);
        const code=document.createElement('p');
        code.textContent="Codice: "+result.id;
        const sped=document.createElement('p');
        sped.textContent="Numero Spedizione: "+result.spedizione;
        const ind=document.createElement('p');
        ind.textContent="Indirizzo Spedizione: "+result.indirizzo;
        const costo=document.createElement('p');
        costo.textContent="Costo ordine: "+result.costo + " €";
        ordine.appendChild(code);
        ordine.appendChild(sped);
        ordine.appendChild(ind);
        ordine.appendChild(costo);
        fetch("http://localhost/HW1/php/fetchArticoli.php?id="+result.id).then(onResponseArticoli).then(onJsonArticoli);
        section.appendChild(container);
      }
    }
  }

 function onResponseOrdini(response){
  return response.json();
 }
  
function onResponseElimina(response){
  console.log(response);
}
function eliminaRecensione(event){
    const elimina= event.currentTarget;
    const articolo=elimina.parentNode.parentNode.parentNode;
    const ordine=articolo.parentNode;
    const button=articolo.querySelector('button');
    button.classList.remove('hidden');
    const recContainer=document.getElementsByClassName("recensioni");
    articolo.lastChild.removeChild(articolo.lastChild.lastChild);
    const avviso= document.getElementById("avviso");
    articolo.lastChild.removeChild(avviso);
    fetch("http://localhost/HW1/php/elimina_recensione.php?articolo="+articolo.dataset.id+"&ordine="+ordine.dataset.id).then(onResponseElimina);   
}
function onJSON(json){
    console.log(json);
    const articoli= document.querySelectorAll('.articoli');

    for(rec of json){
        for(let a of articoli){
            if(a.dataset.id === rec.articolo && a.parentNode.dataset.id===rec.ordine){
                const r=document.createElement('div');
                const h1= document.createElement('h1');
                const p= document.createElement('p');

                const button= a.querySelector('button');
                    
                button.addEventListener('click',gestisciRecensione);
                p.textContent=rec.recensione;
                h1.textContent=rec.username;

                const div= button.parentNode;
                r.appendChild(h1);
                r.appendChild(p);

                r.classList.add('recensioni');

                const elimina= document.createElement('a');
                elimina.textContent="Elimina";
                r.appendChild(elimina);
                div.appendChild(r);
                elimina.addEventListener('click',eliminaRecensione);
            }
        }
    }
}
function onResponsePubblica(response){
    console.log(response);
    return response.json();
}
function pubblicaRecensione(articolo,ordine){
 fetch("http://localhost/HW1/php/aggiorna_recensioni_utente.php?articolo="+articolo+"&ordine="+ordine).then(onResponsePubblica).then(onJSON);
}
function onJsonInvia(json){
  console.log(json);
  if(json.success==false){
    const articoli=document.querySelectorAll(".articoli")
    for(let a of articoli){
      if(a.dataset.id===json.articolo && a.parentNode.dataset.id===json.ordine){
        const avviso= document.createElement('p');
        avviso.textContent="Recensione già inviata per questo articolo!";
        a.lastChild.appendChild(avviso);
        avviso.id="avviso";
      }
    }
  }
    pubblicaRecensione(json.articolo,json.ordine);
}
function onResponseInvia(response){
    console.log(response);
    return response.json();
}
function inviaRecensione(event){
 event.preventDefault();
 const form = event.currentTarget;
 const articolo=form.parentNode.parentNode;
 const ordine=form.parentNode.parentNode.parentNode;
 fetch("http://localhost/HW1/php/carica_recensione.php?recensione="+form.firstChild.value+"&articolo="+articolo.dataset.id+"&ordine="
 +ordine.dataset.id).then(onResponseInvia).then(onJsonInvia);
 form.parentNode.removeChild(form);
}
function gestisciRecensione(event){

    const div=event.currentTarget.parentNode;
    const form=document.createElement("form");
    form.method="get";
    const rec = document.createElement('input');
    rec.type="text";
    rec.name="recensione";
    const sub=document.createElement('input');
    sub.type="submit";
    sub.value="Invia Recensione";
    form.appendChild(rec);
    form.appendChild(sub);
    div.appendChild(form);
    event.currentTarget.classList.add("hidden");
    event.currentTarget.removeEventListener('click',gestisciRecensione);
    form.addEventListener('submit',inviaRecensione);
}

fetch("http://localhost/HW1/php/fetchOrdini.php").then(onResponseOrdini).then(onJsonOrdini);
pubblicaRecensione();