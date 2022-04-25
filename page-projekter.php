<?php

/**
 * The template for displaying front page
 
 */

 get_header ();
 ?>
<template>
    <article>
                    
        <div>
            <img src="" alt="">
            <h2 class="navn"></h2>
            <p class="undertitel"></p>
            <p class="korttekst"></p>
        </div>
    </article>
</template>

 <section id="primary" class="content-area">
<main id="main" class="site-main">

<section class="projektcontainer">
</section>
</main><!-- #main -->

<script>
    let projekter;
    const dbUrl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt?per_page=100";

    async function getJson() {
        const data = await fetch(dbUrl);
        projekter = await data.json();
        console.log(projekter);
        visProjekter();
    }

    function visProjekter() {
        let temp = document.querySelector("template");
        let container = document.querySelector(".projektcontainer")
        projekter.forEach(projekt => {
            let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = projekt.title.rendered;
            klon.querySelector("img").src = projekt.billede.guid;
            klon.querySelector(".undertitel").textContent = projekt.undertitel;
            klon.querySelector(".korttekst").textContent = projekt.korttekst;
            klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.links;
            })
            container.appendChild(klon);
        })
    }

    getJson();

    </script>
    </section><!-- #primary -->

    <?php
    get_footer();

    //NANNA





// <script>
//   let projekter;
//   let categories;
//   let filterProjekt = "alle";

// 	const url = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/projekt?per_page=100";
// 	const caturl = "http://louisetraberg.dk/kea/09_cms/unesco_wp/wp-json/wp/v2/categories";

//   async function hentData() {
//   const data = await fetch(url);
//   const catdata = await fetch(caturl);
//   projekter = await data.json();
//   categories = await catdata.json();
//   console.log(categories);
//   visProjekter();
//   opretKnapper();
// }

// function opretKnapper() {
//   categories.forEach(cat =>{
//     document.querySelector("#filtrering").innerHTML += `<button class="filter" data-projekt="${cat.id}">${cat.name}</button>`
//   })
//   addEventListenersToButton();
// }
// function addEventListenersToButton() {
//   document.querySelectorAll("#filtrering button").forEach(elm =>{
//     elm.addEventListener("click", filtrering);
//   })
  
// };

// function filtrering() {
//   filterProjekt = this.dataset.projekt;
//   console.log(filterProjekt);

//   visProjekter();
// }

// function visProjekter() {
//   console.log(visProjekter);
//   let temp = document.querySelector("template");
//   let container = document.querySelector(".projektcontainer");
//   container.innerHTML = "";

//   projekter.forEach(ret => {
//     if ( filterProjekt == "alle" || projekt.categories.includes(parseInt(filterProjekt))){
//       let klon = temp.cloneNode(true).content;
//     klon.querySelector("h2").textContent = projekt.title.rendered;
//             klon.querySelector("img").src = projekt.billede.guid;
//             klon.querySelector(".undertitel").textContent = projekt.undertitel;
//             klon.querySelector(".korttekst").textContent = projekt.korttekst;
//             klon.querySelector("article").addEventListener("click", ()=> {location.href = projekt.links;
//             })
//             container.appendChild(klon);
//         });

// hentData();

// </script>
