export class User {
   
    id;
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
     * @param {*} obj
     * @memberof User
     */
    constructor(obj) {
        for (const property in this) {
            this[property] = obj[property];
        }
    }

    updateModal() {
        const modal = document.querySelector("#modal-modif");
        modal.querySelector("img").src = "/assets/images/" + this.picturePath;
    }



}
