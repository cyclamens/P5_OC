
class EditProfil{
	constructor(){
		this.submit = document.getElementById("submit");
		this.pseudo = document.getElementById("newpseudo");
		this.mail = document.getElementById("newmail");
		this.mdp = document.getElementById("newmdp1");
		this.mdp2 = document.getElementById("newmdp2");
		

	}//Fin du constructor

	validModif(){
		this.submit.addEventListener("click", ()=> {
			console.log("test");
			if (!this.pseudo.value) {
				alert('Veuillez renseigner votre pseudo !');
			}
			else if(!this.mail.value) {
        		alert("Veuillez renseigner un mail");
    		}
    		
    		else if(!this.mdp.value) {
        		alert("Veuillez renseigner votre mot de passe");
    		}
    		else if(!this.mdp2.value) {
        		alert("Veuillez confirmer votre mot de passe");
    		}
    		else{
    			
    		}
		});
	}

}//Fin de la classe









