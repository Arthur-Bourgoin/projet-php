import { Doctor } from "./class/Doctor.js";
import { updateNavBar, removeDivFeedback, eventChangePicture } from "./functions.js";

updateNavBar();
removeDivFeedback();
eventChangePicture("#pictureAdd", "#modalAddDoctor img");
eventChangePicture("#pictureUpdate", "#modalUpdateDoctor img");

const doctors = new Map();
doctorsPHP.forEach(doctor => {
    doctors.set(doctor.idDoctor, new Doctor(doctor));
});

document.querySelectorAll(".btnUpdateModal").forEach(btn => {
    btn.addEventListener("click", e => {
        doctors.get(parseInt(e.currentTarget.dataset.idDoctor)).updateModal();
    })
    btn.nextElementSibling.querySelector("button").addEventListener("click", e => {
        if(!confirm("Confirmation de la suppression (Tous les RDV associés seront également supprimés)."))
            e.preventDefault();
    })
});

document.querySelector("#btn-newDoctor").addEventListener("click", e => {
    document.querySelector("#modalAddDoctor form").reset();
    document.querySelector("#modalAddDoctor .profilePicture").src = "/assets/images/users/user0.png";
});