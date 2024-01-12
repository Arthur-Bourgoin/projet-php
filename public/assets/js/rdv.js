import { removeDivFeedback, updateNavBar } from "./functions.js";

updateNavBar();
removeDivFeedback();

const tbody = document.querySelector("tbody");

// function updateTable(idDoctor, idUser) {
//     const rdvs = rdvsPHP.filter(rdv => rdv.doctor.idDoctor == idDoctor);
//     tbody.innerHTML = "";
//     rdvs.forEach(rdv => {
//         const tr = document.createElement("tr");
//     });
//     console.log(rdvs);
// }

document.querySelectorAll(".div-top select").forEach(select => {
    select.addEventListener("change", e => {
        e.currentTarget.closest("form").submit();
    });
});

// tableau.sort(function(a, b) {
//     return a.valeur - b.valeur;
// });