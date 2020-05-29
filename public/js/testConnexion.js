
class Connexion{
	constructor(){
		this.submit = document.getElementById("submit");
		this.pseudo = document.getElementById("pseudo");
		this.mdp = document.getElementById("mdp");		
		this.validConnexion();
	}//Fin du constructor

	validConnexion(){
		this.submit.addEventListener("click", ()=> {
			
			if (!this.pseudo.value) {
				alert('Veuillez renseigner votre pseudo !');
			}
			
    		else if(!this.mdp.value) {
        		alert("Veuillez renseigner votre mot de passe");
    		}
    		
    		else{
    			
    		}
		});
	}

}//Fin de la classe









