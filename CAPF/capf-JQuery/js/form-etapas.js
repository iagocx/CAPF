const etapaFormNav = (stepNumber) => {

    // ocultar as sessões do formulário
    let sectionEtapa = document.querySelectorAll(".formulario-etapas")
    for(let i = 0;  i < sectionEtapa.length; i++){
        // console.log("aqui ")
        sectionEtapa[i].classList.add("ocultar");
    }
   

    // Lista etapas do form não checada
    let etapaList = document.querySelectorAll(".etapa-list")
    for (let i = 0; i < etapaList; i++) {
        etapaList[i].classList.add("inativa");
        etapaList[i].classList.remove("etapa-ativa", "completa");
    }


    // Lista etapas do form não checada
    let etapacirculo = document.querySelectorAll(".circulo-etapas")
    for (let i = 0; i < etapacirculo; i++) {
        etapaList[i].classList.add("circulo-inativo");
        etapaList[i].classList.remove("circulo-ativo", "circulo-completo");
    }

    /**
         * Mostra a etapa do formulário atual (conforme passada para a função).
         */
    document.querySelector("#etapa-" + stepNumber).classList.remove("ocultar");
    
     /**
         * Selecione o círculo de etapa do formulário (barra de progresso).
    */
    const formStepCircle = document.querySelector('li[etapa="' + stepNumber + '"]');
  
    /**
         * Marque a etapa de formulário atual como ativa.
    */
    formStepCircle.classList.remove("inativa", "completa");
    formStepCircle.classList.add("etapa-ativa");

    const circulo = document.querySelector('span[etapa="' + stepNumber + '"]')
    circulo.classList.remove("circulo-inativo", "circulo-completo");
    circulo.classList.add("circulo-ativo")
        /**
        * Faça um loop em cada círculo de etapas do formulário.
         * Este loop continuará até o número do passo atual.
         * Exemplo: Se o passo atual for 3,
         * então o loop realizará as operações para os passos 1 e 2.
         */
    for (let i = 0; i < stepNumber; i++) {
        // Selecione o círculo de etapa do formulário (barra de progresso).
        const formStepCircle = document.querySelector('li[etapa="' + i + '"]');
        //Verifique se o elemento existe. Se sim, então prossiga.
        if (formStepCircle) {
            // Marque a etapa do formulário como concluída.
            formStepCircle.classList.remove("inativa", "etapa-ativa");
            formStepCircle.classList.add("completa");
        }
    }
}



let btn = document.querySelectorAll('.btn-form')

//Adicione um ouvinte de evento de clique ao botão.
for (let i = 0; i <= btn.length; i++) {

   
    if(btn[i]){
        btn[i].addEventListener("click", functionEta);
      }
    function functionEta(){
        
        const etapa = parseInt(btn[i].getAttribute("etapa_numero"));
        etapaFormNav(etapa);

    }
   
    
}

