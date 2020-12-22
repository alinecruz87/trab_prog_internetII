class DiaristaController{  
    constructor() {
        this.diaristaService    = new DiaristaAPIService(); 
        this.tabelaDiaristas    = new TabelaDiaristas(this,"main");
        this.formDiaristas      = new FormDiaristas(this,"main");
    } 

    inicializa(){
        this.carregarDiaristas();
    }

    carregarFormulario(){
        event.preventDefault();
        this.formDiaristas.montarForm();
    }

    carregarDiaristas(){
        const self = this;
        const sucesso = function(diaristas){
            self.tabelaDiaristas.montarTabela(diaristas);
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }

        this.diaristaService.buscarDiaristas(sucesso, trataErro);
    }

    limpar(event){
        event.preventDefault();
        this.formDiaristas.limparFormulario();
        this.carregarDiaristas();
    }
    
    salvar(event){        
        event.preventDefault();
        var diarista = this.formDiaristas.getDataDiarista();        
        console.log("Diarista", diarista);

        this.salvarDiarista(diarista);

    }

    salvarDiarista(diarista){
        const self = this;

        const sucesso = function(diaristaCriado) {
            console.log("Diarista Criada",diaristaCriado);
            self.carregarDiaristas();
            self.formDiaristas.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
                
        this.diaristaService.enviarDiarista(diarista, sucesso, trataErro);    

    }

    deletarDiarista(id, event){
        const self = this;
        this.diaristaService.deletarDiarista(id, 
            function() {
                self.carregarDiaristas();
            },
            function(status) { 
                console.log(status);
            }
        );
    }

    carregaFormularioComDiarista(id, event){
        event.preventDefault();             
        
        const self = this;
        const ok = function(diarista){
            self.formDiaristas.montarForm(diarista);
        }
        const erro = function(status){
            console.log(status);
        }

        this.diaristaService.buscarDiarista(id,ok,erro);   
    }

    editar(id,event){
        event.preventDefault();
    
        let diarista = this.formDiaristas.getDataDiarista();
        
        const self = this;

        this.diaristaService.atualizarDiarista(id,diarista, 
            function() {
                self.formDiaristas.limparFormulario();
                self.carregarDiaristas();
            },
            function(status) {
                console.log(status);
            } 
        );

    }

        
}