window.addEventListener("load",()=>{

    let mdp1 = document.querySelector("#inputPassword");
    let mdp2 = document.querySelector("#verifinputPassword");

    let handioui = document.querySelector("#radioOui");
    let handinon = document.querySelector("#radioNon");

    handinon.addEventListener("click",masquerchamp);
    handioui.addEventListener("click",afficherchamp)

    selectnon();

});

function selectnon(){
    let bnon = document.querySelector("#radioNon");;
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

function submmitInscr(event) {
    
}