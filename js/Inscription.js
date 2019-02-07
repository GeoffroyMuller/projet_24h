window.addEventListener("load",()=>{

    console.log('Module JS charge');
    let mdp1 = document.querySelector("#inputPassword");
    let mdp2 = document.querySelector("#verifinputPassword");

    let handioui = document.querySelector("#radioOui");
    let handinon = document.querySelector("#radioNon");

    handinon.addEventListener("click",masquerchamp);
    handioui.addEventListener("click",afficherchamp);

    mdp1.addEventListener("keyup",verifmdp);
    mdp2.addEventListener("keyup",verifmdp);

    selectnon();

});

function selectnon(){
    let bnon = document.querySelector("#radioNon");
    bnon.click();
}

function afficherchamp(event) {
    let champ =document.querySelector("#descriphandicap");
    $(champ).show();
}


function masquerchamp(event) {
    let champ =document.querySelector("#descriphandicap");
    $(champ).hide();
}

function verifmdp(event) {
    console.log("keytype");
    let mdp1 = document.querySelector("#inputPassword");
    let mdp2 = document.querySelector("#verifinputPassword");

    let inscrir = document.querySelector("#submit");
    console.log(inscrir);


    if(mdp1.value===mdp2.value){
        inscrir.disabled=false;
    }
    else{

        inscrir.disabled=true;
    }
}