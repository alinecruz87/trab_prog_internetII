class TabelaDiaristas {
    constructor(controller, seletor){
        this.diaristaController = controller;
        this.seletor = seletor;
    }


    montarTabela(diaristas){
        var str=`
        <h2>Tabela de Diaristas</h2>
        <a id="novo" href="#">Novo</a>
        <div id="tabela">
        <table>
            <tr>
                <th style='text-align: left;'>Id</th>
                <th style='text-align: left;'>Nome</th>
                <th colspan="2">Ação</th>
            </tr>`;
    
        for(var i in diaristas){
            str+=`<tr id=${diaristas[i].id}>
                    <td>${diaristas[i].id}</td>
                    <td>${diaristas[i].nome}</td>
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
            self.diaristaController.carregarFormulario(event);
        }

        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.diaristaController.deletarDiarista(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.diaristaController.carregaFormularioComDiarista.bind(this.diaristaController,id));
        }

    }

}