
class Inscription{
	constructor(){
		this.submit = document.getElementById("submit");
		this.pseudo = document.getElementById("pseudo");
		this.mail = document.getElementById("mail");
		this.mail2 = document.getElementById("mail2");
		this.mdp = document.getElementById("mdp");
		this.mdp2 = document.getElementById("mdp2");
		

	}//Fin du constructor

	validInscription(){
		this.submit.addEventListener("click", ()=> {
			console.log("test");
			if (!this.pseudo.value) {
				alert('Veuillez renseigner votre pseudo !');
			}
			else if(!this.mail.value) {
        		alert("Veuillez renseigner un mail");
    		}
    		else if(!this.mail2.value){
        		alert("Veuillez confirmer votre mail");
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









