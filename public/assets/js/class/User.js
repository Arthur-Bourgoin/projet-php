export class User {
   
    idUser;
    picturePath;
    secuNumber;
    civility;
    lastName;
    firstName;
    city;
    postalCode;
    address;
    birthDate;
    birthPlace;
    referringDoctor;

    /**
     * Creates an instance of User.
     * @param {Object} obj
     * @memberof User
     */
    constructor(obj) {
        for (const property in this) {
            this[property] = obj[property];
        }
    }

    updateModalModif() {
        const modal = document.querySelector("#modal-modif");
        console.log(this.idUser);
        modal.querySelector("#idUser").value = this.idUser;
        modal.querySelector("img").src = this.picturePath;
        modal.querySelector("#mbody-name div:nth-of-type(1) input").value = this.civility === "M" ? "Mr." : "Mme.";
        modal.querySelector("#mbody-name div:nth-of-type(2) input").value = this.lastName;
        modal.querySelector("#mbody-name div:nth-of-type(3) input").value = this.firstName;
        modal.querySelector("#mbody-birth div:nth-child(1)").innerText = this.civility === "M" ? "Né le" : "Née le";
        modal.querySelector("#mbody-birth div:nth-child(2) input").value = this.birthDate;
        modal.querySelector("#mbody-birth div:nth-child(4) input").value = this.birthPlace;
        modal.querySelector("#mbody-nir input").value = this.secuNumber;
        modal.querySelector("#mbody-pcode input").value = this.postalCode;
        modal.querySelector("#mbody-city input").value = this.city;
        modal.querySelector("#mbody-address input").value = this.address;
        if(this.referringDoctor === null) {
            document.querySelector("#mbody-doctor select").value = 0;
        } else {
            document.querySelector("#mbody-doctor select").value = this.referringDoctor;
        }
    }



}
