class VoluntarioController{  
    constructor() {
        this.voluntarioService = new VoluntarioAPIService(); 
        this.tabelaVoluntarios = new TabelaVoluntarios(this,"main");
        this.formVoluntarios = new FormVoluntarios(this,"main");
    } 

    inicializa(){
        this.carregarVoluntarios();
    }

    carregarFormulario(){
        event.preventDefault();
        this.formVoluntarios.montarForm();
    }

    carregarVoluntarios(){
        const self = this;
        
        const sucesso = function(voluntarios){
            self.tabelaVoluntarios.montarTabela(voluntarios);
        }

        
        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }

        this.voluntarioService.buscarVoluntarios(sucesso, trataErro);
    }

    limpar(event){
        event.preventDefault();
        this.formVoluntarios.limparFormulario();
        this.carregarVoluntarios();
    }
    
    salvar(event){        
        event.preventDefault();
        var voluntario = this.formVoluntarios.getDataVoluntario();        
        console.log("Voluntario", voluntario);

        this.salvarVoluntario(voluntario);

    }

    salvarVoluntario(voluntario){
        const self = this;

        const sucesso = function(voluntarioCriado) {
            console.log("Voluntario Criado",voluntarioCriado);
            self.carregarVoluntarios();
            self.formVoluntarios.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
                
        this.voluntarioService.enviarVoluntario(voluntario, sucesso, trataErro);    

    }

    deletarVoluntario(id, event){
        const self = this;
        this.voluntarioService.deletarVoluntario(id, 
            function() {
                self.carregarVoluntarios();
            },
            function(status) { 
                console.log(status);
            }
        );
    }

    carregaFormularioComVoluntario(id, event){
        event.preventDefault();             
        
        const self = this;
        const ok = function(voluntario){
            self.formVoluntarios.montarForm(voluntario);
        }
        const erro = function(status){
            console.log(status);
        }

        this.voluntarioService.buscarVoluntario(id,ok,erro);   
    }

    editar(id,event){
        event.preventDefault();
    
        let voluntario = this.formVoluntarios.getDataVoluntario();
        
        const self = this;

        this.voluntarioService.atualizarVoluntario(id,voluntario, 
            function() {
                self.formVoluntarios.limparFormulario();
                self.carregarVoluntarios();
            },
            function(status) {
                console.log(status);
            } 
        );

    }

        
}