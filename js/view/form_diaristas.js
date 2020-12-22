class FormDiaristas {

    constructor(controller, seletor){
        this.diaristaController = controller;
        this.seletor = seletor;
    }

    montarForm(diarista){
        if(!diarista){
            diarista = new Diarista();
        }
        var str = `
        <h2>Formulario de Diaristas</h2>
        <form id="formulario">
            <input type="hidden" id="idDiarista" value="${diarista.id}" />
            <label for="txtnome">Nome:</label>
            <input type="text" id="txtnome" value="${diarista.nome ?diarista.nome :''}">
            <br />
            <label for="txtendereco">Endereço:</label>
            <input type="text" id="txtendereco" value="${diarista.endereco ?diarista.endereco :''}">
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
            if(!diarista.id){
                self.diaristaController.salvar(event);
            }
            else{
                self.diaristaController.editar(diarista.id,event);
            }
        }

        form.onreset = function(event){
            self.diaristaController.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#txtnome").value="";
        document.querySelector("#txtendereco").value="";
    }

    getDataDiarista(){
        let diarista = new Diarista();
        if(!document.querySelector("#idDiarista").value)
            diarista.id = document.querySelector("#idDiarista").value;
        diarista.nome = document.querySelector("#txtnome").value;
        diarista.endereco = document.querySelector("#txtendereco").value;
        return diarista;        
    }

}