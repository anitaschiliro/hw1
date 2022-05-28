function onJsonHome(json){
  console.log(json);

  const dettagli = document.querySelector("#dettagli");

  for(let res of json){
    const div= document.createElement("div");
    const img = document.createElement("img");
    const h1 = document.createElement("h1");
    const p= document.createElement("p");

    img.src=res.immagine;
    h1.textContent=res.titolo;
    p.textContent=res.descrizione;

    div.appendChild(img);
    div.appendChild(h1);
    div.appendChild(p);
    dettagli.appendChild(div);
  }
}

function onResposeHome(response){
  return response.json();
}

  fetch("http://localhost/HW1/php/fetchhome.php").then(onResposeHome).then(onJsonHome);
  