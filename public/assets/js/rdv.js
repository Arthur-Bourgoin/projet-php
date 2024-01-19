import { removeDivFeedback, updateNavBar } from "./functions.js";

updateNavBar();
removeDivFeedback();

const rdvs = new Map(); 
rdvsPHP.forEach(rdv => {
    rdvs.set(rdv.idRdv, rdv);
});
console.log(rdvs);


const users = new Map();
usersPHP.forEach(user => {
    users.set(user.idUser, user);
});
console.log(users);

document.querySelectorAll(".btn-updateRdv").forEach(btn => {
    btn.addEventListener("click", e => {
        const rdv = rdvs.get(parseInt(e.currentTarget.dataset.idRdv, 10)); 
        document.querySelector("#updateRdv .idRdv").value = rdv.idRdv;
        document.querySelector("#updateRdv .select-doctor").value = rdv.doctor.idDoctor;
        document.querySelector("#updateRdv .select-user").value = rdv.user.idUser;
        document.querySelector("#updateRdv .dateTimeBegin").value = rdv.dateTime;
        document.querySelector("#updateRdv .duration").value = rdv.duration;
    });
});

document.querySelector("#addRdv .select-user").addEventListener("change", e => {
    if(e.currentTarget.value == 0) return;
    const user = users.get(parseInt(e.currentTarget.value, 10));
    console.log(user);
    document.querySelector("#addRdv .select-doctor").value = user.referringDoctor ? user.referringDoctor : 0;
});

document.querySelectorAll(".div-top select").forEach(select => {
    select.addEventListener("change", e => {
        e.currentTarget.closest("form").submit();
    });
});

document.querySelectorAll(".btn-delete").forEach(btn => {
    btn.addEventListener("click", e => {
        if(!confirm("Voulez vous vraiment supprimer cette consultation ?"))
            e.preventDefault();
    })
});



// tableau.sort(function(a, b) {
//     return a.valeur - b.valeur;
// });