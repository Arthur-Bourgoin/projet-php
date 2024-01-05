import { User } from "./class/User.js";
import { updateNavBar, removeDivFeedback } from "./functions.js";

updateNavBar();
removeDivFeedback();

(function initScript() {
    if(!Array.isArray(usersPHP))
        return;
    const users = new Map();
    usersPHP.forEach(user => {
        users.set(user.idUser, new User(user));
    });

    document.querySelectorAll(".divUser").forEach(divUser => {
        const user = users.get(parseInt(divUser.dataset.idUser));        
        divUser.addEventListener("click", e => {
            user.updateModalModif();
        });
        divUser.querySelector("button").addEventListener("click", e => {
            if(!confirm("Confirmation de la suppression (Tous les RDV associés seront également supprimés)."))
                e.preventDefault();
        });
    });
})();

document.querySelector("#mbody-name div:nth-of-type(1) input").addEventListener("click", e => {
    e.preventDefault();
    e.currentTarget.value === "Mr." ? e.currentTarget.value = "Mme." : e.currentTarget.value = "Mr.";
});

document.querySelector("#btn-newUser").addEventListener("click", e => {
    document.querySelector("#modal-add form").reset();
});