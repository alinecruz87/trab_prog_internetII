class FormVoluntarios {

    constructor(controller, seletor){
        this.voluntarioController = controller;
        this.seletor = seletor;
    }

    montarForm(voluntario){
        if(!voluntario){
            voluntario = new Voluntario();
        }
        var str = `
        <h2>Formulario de Voluntarios</h2>
        <form id="formulario">
            <input type="hidden" id="idVoluntario" value="${voluntario.id_v}" />
            <label for="txtnome">Nome:</label>
            <input type="text" id="txtnome" value="${voluntario.nome_v ?voluntario.nome_v :''}">
            <br />
            <input type="submit" id="btnsalvar" value="Salvar">
            <input type="reset" value="Cancelar">
            <br />
        </form>
        `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!voluntario.id){
                self.voluntarioController.salvar(event);
            }
            else{
                self.voluntarioController.editar(voluntario.id_v,event);
            }
        }

        form.onreset = function(event){
            self.voluntarioController.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#txtnome").value="";
    }

    getDataVoluntario(){
        let voluntario = new Voluntario();
        if(!document.querySelector("#idVoluntario").value)
            voluntario.id_v = document.querySelector("#idVoluntario").value;
        voluntario.nome_v = document.querySelector("#txtnome").value;
        return voluntario;        
    }

}