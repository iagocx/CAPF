

    // verificar se o campo é obrigatório 
    function isRequired(id, el) { 

            let valor= el.length; 

            if( valor <= 0 ) {

                document.getElementById("erroRquired").innerHTML = `O valor do campo ${id} é obrigatório!`;
                document.getElementById(`${id}`).focus();
                return false
            }

            if(valor > 0) { {

                document.getElementById("erroRquired").innerHTML = ""
                return true
            }
        }
    }
    
    // 01 - INFORMAÇÕES BASICAS [A-zÀ-ú,.0-9]{1,100}
    // -------------- Nome ---------------- OK
    function validaNome() {

        let nome = document.getElementById("nome").value;
        isRequired("nome", nome)

        var pattern = /^[a-zA-Z]+ [a-zA-Z]{3,50}/;

        if(!pattern.test(nome)){

            document.getElementById("erronome").innerHTML = `O campo nome não está formatado corretamente.
            \n Digite apenas o primeiro e o último nome!" É o tamanho mínimo são 6 caracteres e o máximo 50 `;
            document.getElementById('nome').focus();
            return false;

        }if(pattern.test(nome)){

            document.getElementById("erronome").innerHTML = "";
            return true;
        }
    
    }

    // --------------- CPF ----------------- OK
    function validaMaskCPF(entradaCPF){

        let cpf = entradaCPF;
        cpf.value = mascara(cpf.value);

    }
    function mascara(cpf){

        let valuecpf = document.getElementById("cpf").value;

        if (valuecpf.length < 14) {

            document.getElementById("erroCPF").innerHTML ="O campo CPF é obrigatório e suporta apenas 11 dígitos numerico."; //emite erro
            document.getElementById('cpf').focus();
            

        } if (valuecpf.length == 14) {

            document.getElementById('cpf').focus();
            document.getElementById("erroCPF").innerHTML=""; //limpa
        }

        //função replace para realizar pesquisa por um correpondencia em string e substituir um substring
        cpf = cpf.replace(/\D/g, ""); // permite apenas o uso número em (/g)nível global 
            cpf = cpf.replace(/^(\d{3})/g, "$1."); // \d - qualquer dígito é igual a [0-9] . procurar por três dígitos (global) e vai subituir o valor digitado $1 seguido de ponto
            cpf = cpf.replace(/(\d{3})(\d{3})/g, "$1.$2-") // mas três númenos  e separado os dois ultimo difitos

            
        return cpf
    }

    // 02 - INFORMAÇÕES ENDEREÇO

    // --------------- CEP ----------------- OK
    function validaMaskCEP(dataEnter){
        var data = dataEnter
        data.value = mascaraCEP(data.value);
    }
    function mascaraCEP(data){

        let valuecep = document.getElementById("cep").value
        
        if (valuecep.length < 7 ) {

            document.getElementById("erroCEP").innerHTML="O campo CEP é obrigatório e suporta apenas 8 dígitos numerico." //emite erro
            document.getElementById('cep').focus();

        } if (valuecep.length >= 8){

            document.getElementById("erroCEP").innerHTML="" //limpa
        }

        //função replace para realizar pesquisa por um correpondencia em string e substituir um substring
        data = data.replace(/\D/g, ""); // permite apenas o uso número em (/g)nível global 
            data = data.replace(/^(\d{5})/g, "$1-"); // \d - qualquer dígito é igual a [0-9] . procurar por três dígitos (global) e vai subituir o valor digitado $1 seguido de ponto
            data = data.replace(/(\d{3})/g, "$1") // mas três númenos  e separado os dois ultimo difitos
            
            
        return data
    }

    // ---------- Logradouro --------------
    function validarLogradouro() {

        let logradouroValue = document.getElementById("logradouro").value;
        isRequired("logradouro", logradouroValue)

        var patternLoga = /[A-zÀ-ú,.0-9]{5,50}/g

        if ((!patternLoga.test(logradouroValue)) || (logradouroValue.length <5) ){

            document.getElementById("erroLog").innerHTML = `O campo logradouro só aceita letras, números,vírgula, ponto. Logradouro tem que ter de 6 a 50 caracteres.`;
            document.getElementById('logradouro').focus();
            return false;
            
        } if(patternLoga.test(logradouro)){

            document.getElementById("erroLog").innerHTML = "";
            return true;
        }

    }

    // --------------- Número ----------------
    function validarNumero(){

        let numero = document.getElementById("numero").value;


        if(!(numero.length != 0)){

            document.getElementById("erro").innerHTML = "O campo número é obrigatório!";
            document.getElementById('numero').focus();
            return false;
        }

        if(numero.length > 10){

            document.getElementById("erro").innerHTML = "O campo número suporta no máximo 10 caracteres.";
            document.getElementById('numero').focus();
            return false;
        }
            document.getElementById("erro").innerHTML = "";
            return true;
    
    }


    // ------------ Complemento ---------------
    function validarComplemento(){

        let complemento = document.getElementById("complemento").value;

        if( complemento.length > 30){

            document.getElementById("erroComp").innerHTML = " O tamanho máximo do campo complemnto é de 30 caracteres";
            document.getElementById('complemento').focus();
            return false;
        }

        document.getElementById("erroComp").innerHTML = "";
        return true;
    
    }


    // ------------ Cidade ---------------
    function validarCidade(){
        let cidade = document.getElementById("cidade").value;
        isRequired("cidade", cidade)

        var pattern = /^[A-zÀ-ú,-.0-9]{3,25}/;

        if(!pattern.test(cidade)){

            document.getElementById("erroCity").innerHTML = `O campo cidade é obrigatório não está formatado corretamente. 
            É o tamanho mínimo são 3 caracteres e o máximo 25. `;
            document.getElementById('cidade').focus();
            return false;

        }if(pattern.test(cidade)){

            document.getElementById("erroCity").innerHTML = "";
            return true;
        }
    }


    // ------------ Bairro ---------------
    function validarBairro(){
        let bairro = document.getElementById("bairro").value;
        isRequired("bairro", bairro)

        var pattern = /^[A-zÀ-ú,-.0-9]{3,25}/;

        if(!pattern.test(bairro)){

            document.getElementById("erroBai").innerHTML = `O campo bairro não está formatado corretamente. 
            É o tamanho mínimo são 3 caracteres e o máximo 25`;
            document.getElementById('bairro').focus();
            return false;

        }if(pattern.test(bairro)){

            document.getElementById("erroBai").innerHTML = "";
            return true;
        }
        
    }


    // 03 - INFORMAÇÕES DE CONTATO
    // ------------ Email ---------------
    function validarEmail(){
        let email = document.getElementById("email").value;
        isRequired("email", email)

        patternEmail = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/

        if(!patternEmail.test(email)){

            document.getElementById("erroEmail").innerHTML = `O campo email não está formatado corretamente. Ex.: nome@dominio.com.br`;
            document.getElementById('email').focus();
            return false;

        }if(patternEmail.test(email)){

            document.getElementById("erroEmail").innerHTML = "";
            return true;
        }

    }

    // ---------Telefone fixo -----------

    function validaTelefoneFix(telEnter){
        var telData = telEnter
        telData.value = mascaraTelfix(telData.value);
        
    }

    function mascaraTelfix(telData){

        let valuetelfix = document.getElementById("telfix").value


        if (valuetelfix.length < 11 ) {

            document.getElementById("errotelfix").innerHTML="O campo telefone fixo é obrigatório suporta apenas 10 dígitos numerico." //emite erro
            document.getElementById('telfix').focus();

        } if (valuetelfix.length > 11){

            document.getElementById("errotelfix").innerHTML="" //limpa
        }

        //função replace para realizar pesquisa por um correpondencia em string e substituir um substring
        telData = telData.replace(/\D/g, ""); // permite apenas o uso número em (/g)nível global 
            telData = telData.replace(/^(\d{2})/g, "($1)"); // \d - qualquer dígito é igual a [0-9] . procurar por três dígitos (global) e vai subituir o valor digitado $1 seguido de ponto
            telData = telData.replace(/(\d{4})(\d{4})/g, "$1-$2") // mas três númenos  e separado os dois ultimo difitos
            
            
        return telData
    }



    // --------Telefone celular ----------


    function validarCelular(celEnter){
        var celData = celEnter
        celData.value = mascaraTelcel(celData.value);
    }

    function mascaraTelcel(celData){

        let valuetelcel = document.getElementById("telcel").value
        
        if (valuetelcel.length < 12 ) {

            document.getElementById("errotelcel").innerHTML="O campo telefone celular suporta apenas 11 dígitos numerico." //emite erro
            document.getElementById('telcel').focus();

        } if (valuetelcel.length > 12){

            document.getElementById("errotelcel").innerHTML="" //limpa
        }

        //função replace para realizar pesquisa por um correpondencia em string e substituir um substring
        celData = celData.replace(/\D/g, ""); // permite apenas o uso número em (/g)nível global 
            celData = celData.replace(/^(\d{2})/g, "($1)"); // \d - qualquer dígito é igual a [0-9] . procurar por três dígitos (global) e vai subituir o valor digitado $1 seguido de ponto
            celData = celData.replace(/(\d{5})(\d{4})/g, "$1-$2") // mas três númenos  e separado os dois ultimo difitos
            
            
        return celData
    }


    function validatotal() {
        if(
            validaNome() &&
            validarLogradouro() &&
            validarLogradouro() &&
            validarNumero() &&
            validarComplemento() &&
            validarCidade() &&
            validarBairro() &&
            validarEmail() 
        ){
            alert("OK")
        }

    }

