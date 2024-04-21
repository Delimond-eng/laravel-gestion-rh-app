document.addEventListener('DOMContentLoaded', function (e){
    $('#province-select').select2({
        data:[
            "Province_1",
            "Province_2"
        ],
        placeholder: "Sélectionnez une province...",
    });
    $('#bureau-select').select2({
        data:[
            "Bureau_1",
            "Bureau_2"
        ],
        placeholder: "Sélectionnez un bureau...",
    });
    $('#fonction-select').select2({
        data:[
            "fonction_1",
            "fonction_2"
        ],
        placeholder: "Sélectionnez une fonction...",
    });

    $('#grade-select').select2({
        data:[
            "Grade_1",
            "Grade_2"
        ],
        placeholder: "Sélectionnez une grade...",
    });
    creerAgent();
});


/**
 * Permet de soumettre les infos saisies pour un agent
 * */
function creerAgent(){
    const form = document.querySelector('#agent-form');
    form.addEventListener("submit", function (event){
        event.preventDefault();
        let datas = event.target;
        datas.forEach((r)=>{
            console.log(r.value);
        });
    });
}
