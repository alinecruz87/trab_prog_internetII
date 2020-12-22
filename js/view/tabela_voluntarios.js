class TabelaVoluntarios {
    constructor(controller, seletor){
        this.voluntarioController = controller;
        this.seletor = seletor;
    }


    montarTabela(voluntarios){
        var str=`
        <h2>Tabela de Voluntarios</h2>
        <a id="novo" href="#">Novo</a>
        <div id="tabela">
        <table>
            <tr>
                <th style='text-align: left;'>Id</th>
                <th style='text-align: left;'>Nome</th>
                <th colspan="2">Ação</th>
            </tr>`;
    
        for(var i in voluntarios){
            str+=`<tr id=${voluntarios[i].id}>
                    <td>${voluntarios[i].id}</td>
                    <td>${voluntarios[i].nome}</td>
                    <td><a class="edit" href="#">Editar</a></td>
                    <td><a class="delete" href="#">Deletar</a></td>    
                </tr>`;
                
        } 
        str+= `
        </table>
        </div>`;
    
        var tabela = document.querySelector(this.seletor);
        tabela.innerHTML = str;

        const self = this;
        const linkNovo = document.querySelector("#novo");
        linkNovo.onclick = function(event) {
            self.voluntarioController.carregarFormulario(event);
        }

        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.voluntarioController.deletarVoluntario(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.voluntarioController.carregaFormularioComVoluntario.bind(this.voluntarioController,id));
        }

    }

}