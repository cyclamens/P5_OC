
class Topic{
	constructor(){
		this.submit = document.getElementById("submit");
		this.sujet = document.getElementById("sujet");
		this.select = document.getElementById("catSelect");
		this.message = document.getElementById("editor");		
		
	}//Fin du constructor

	validTopic(){
		this.submit.addEventListener("click", ()=> {
			
			if (!this.sujet.value) {
				alert('Veuillez renseigner votre sujet !');
			}
			
    		else if(!this.select.value) {
        		alert("Veuillez selectionner une catégorie !");
    		}
    		
    		else if(!this.message.value) {
        		alert("Veuillez saisir un message !");
    		}

    		else{
    			
    		}
		});
	}

}//Fin de la classe









