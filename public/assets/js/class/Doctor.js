export class Doctor {

    idDoctor;
    picture;
    civility;
    lastName;
    firstName;
    
    constructor(obj) {
        for (const property in this) {
            this[property] = obj[property];
        }
    }

    updateModal() {
        const modal = document.querySelector("#modalUpdateDoctor");
        modal.querySelector("#idDoctor").value = this.idDoctor;
        modal.querySelector("img").src = this.picture;
        modal.querySelector("#inputLastNameU").value = this.lastName;
        modal.querySelector("#inputFirstNameU").value = this.firstName;
        if(this.civility === "M") {
            modal.querySelector("#inputMU").checked = true;
            modal.querySelector("#inputFU").checked = false;
        } else {
            modal.querySelector("#inputMU").checked = false;
            modal.querySelector("#inputFU").checked = true;
        }
    }

}