$(document).ready(function (){
    $("#agent_table").DataTable({
        language:{
            searchPlaceholder:"Recherche agent...",
            sSearch:"",
        },
        scrollX: true,
        scrollXInner: "100%",

        pageLength:25,
    });
});
