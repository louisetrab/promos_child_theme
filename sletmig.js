let ktProjekter;
    let projekter;
    let categories;
    let filterVmProjekt = "alle";
    let filterKtProjekt = "alle";
    let klassetrin;

    const dbUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt?per_page=100";
    const catUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/categories?per_page=100";
        const ktUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/klassetrin?per_page=100";

    async function getJson() {
        const data = await fetch(dbUrl);
        const catdata = await fetch(catUrl);
        const ktdata = await fetch(ktUrl);
        projekter = await data.json();
        categories = await catdata.json();
        klassetrin = await ktdata.json();
        console.log(categories);
        visProjekter();
      
        opretKtKnapper();
        opretVmKnapper();
    }


    function opretKtKnapper() {
  klassetrin.forEach(trin =>{
    document.querySelector("#ktFiltrering").innerHTML += `<button class="filter" data-kt="${trin.id}">${trin.name}</button>`
  })
  addEventListenersToKtButton();
}
function addEventListenersToKtButton() {
  document.querySelectorAll("#ktFiltrering button").forEach(elm =>{
    elm.addEventListener("click", ktFiltrering);
  })
  
};




    function opretVmKnapper() {
  categories.forEach(cat =>{
    document.querySelector("#vmFiltrering").innerHTML += `<button class="filter" data-vm="${cat.id}"><img src="${cat.billede.guid}"></button>`
  })
  addEventListenersToVmButton();
}
function addEventListenersToVmButton() {
  document.querySelectorAll("#vmFiltrering button").forEach(elm =>{
    elm.addEventListener("click", vmFiltrering);
  })
  
};

function ktFiltrering(){
     filterKtProjekt = this.dataset.kt;
  console.log(filterKtProjekt);

  visKtProjekter();

}




function visKtProjekter() {
  console.log(visKtProjekter);
  let temp = document.querySelector("template");
  let container = document.querySelector(".projektcontainer");
  container.innerHTML = "";


ktProjekter= projekter.filter(projekt =>projekt.klassetrin.includes(parseInt(filterKtProjekt)) ;

)
  projekter.forEach(projekt => {
    if ( filterKtProjekt == "alle" || projekt.klassetrin.includes(parseInt(filterKtProjekt))){
      let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = projekt.title.rendered;
            klon.querySelector("img").src = projekt.billede.guid;
            klon.querySelector(".verdensml").textContent = projekt.verdensml;
            klon.querySelector(".korttekst").textContent = projekt.korttekst;
            klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.link;})
            container.appendChild(klon);
        }
        })

        // document.querySelector("vmFiltrering")

    }


function vmFiltrering() {
  filterVmProjekt = this.dataset.vm;
  console.log(filterVmProjekt);

  visProjekter();
}

function visProjekter() {
  console.log(visProjekter);
  let temp = document.querySelector("template");
  let container = document.querySelector(".projektcontainer");
  container.innerHTML = "";
  ktProjekter.forEach(projekt => {
    if ( filterVmProjekt == "alle" || projekt.categories.includes(parseInt(filterVmProjekt))){
      let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = projekt.title.rendered;
            klon.querySelector("img").src = projekt.billede.guid;
            klon.querySelector(".verdensml").textContent = projekt.verdensml;
            klon.querySelector(".korttekst").textContent = projekt.korttekst;
            klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.link;})
            container.appendChild(klon);
        }
        })
    }
getJson();