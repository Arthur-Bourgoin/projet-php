import { User } from "./class/User.js";

(function initScript() {
    if(!Array.isArray(usersPHP))
        return;
    const users = new Map();
    usersPHP.forEach(user => {
        users.set(user.id, new User(user));
    });

    document.querySelectorAll(".divUser").forEach(divUser => {
        const user = users.get(parseInt(divUser.dataset.id));        
        divUser.addEventListener("click", e => {
            user.updateModal();
        });
    });

    document.querySelectorAll(".divUser button").forEach(btn => {
        btn.addEventListener("click", e => {
            if(!confirm("Voulez vous vraiment supprimer cet utilisateur ?"))
                e.preventDefault();
        });
    });
})();