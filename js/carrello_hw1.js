function onJSON(json)
{
    console.log(json);
    const container = document.querySelector("section");
    container.innerHTML="";
    const title= document.createElement("h1");
    if(json.length===0){
      title.textContent="Il tuo carrello è vuoto!";
      container.appendChild(title);
    }else{
      title.textContent="Il tuo carrello.";
      container.appendChild(title);
      for(art of json)
      {
          const div = document.createElement("div")
          const riepilogo= document.createElement("div")
          const cod=document.createElement("p");
          const descrizione=document.createElement("p");
          const marca=document.createElement("p");
          const prezzo=document.createElement("p");
          const tot= document.createElement("p");
          const img =document.createElement("img");
          const misura=document.createElement("p");
          const quantita= document.createElement("p");

          cod.textContent="Codice articolo: "+ art.codice;
          descrizione.textContent="Descrizione: "+ art.descrizione;
          marca.textContent="Marca: "+ art.marca;
          prezzo.textContent="Prezzo Articolo: "+ art.prezzo;
          tot.textContent="Costo Totale: "+  (art.prezzo*art.quantita);
          img.src= art.immagine;
          misura.textContent="Misura: " + art.misura;
          quantita.textContent="Quantità: "+ art.quantita;

          const elimina = document.createElement("a");
          elimina.href = '#';
          elimina.dataset.articolo = art.codice;
          elimina.textContent = "Elimina";
          elimina.addEventListener("click", eliminaArticolo);

          div.appendChild(img);
          riepilogo.appendChild(cod);
          riepilogo.appendChild(descrizione);
          riepilogo.appendChild(marca);
          riepilogo.appendChild(prezzo);
          riepilogo.appendChild(misura);
          riepilogo.appendChild(quantita);
          riepilogo.appendChild(tot);
          riepilogo.appendChild(elimina);
          div.appendChild(riepilogo);
          container.appendChild(div);
      }
      
      const ordine= document.createElement('a');
      ordine.id="ordina";
      ordine.href="http://localhost/HW1/ordine_hw1.php";
      ordine.textContent="Procedi all'ordine";
      container.appendChild(ordine);
  }
}

function eliminaArticolo(event)
{
    fetch("http://localhost/HW1/php/elimina_carrello.php?art='" + event.currentTarget.dataset.articolo + "'").then(aggiornaCarrello);
}

function responseAggiorna(response)
{
    return response.json();
}

function aggiornaCarrello()
{
    fetch("http://localhost/HW1/php/aggiorna_carrello.php").then(responseAggiorna).then(onJSON);
}

aggiornaCarrello();
