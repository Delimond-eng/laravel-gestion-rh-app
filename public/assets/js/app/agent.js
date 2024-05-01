document.addEventListener('DOMContentLoaded', function (e){
    /*Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Agent créé avec succès !",
        showConfirmButton: !1,
        timer: 1500,
    });*/
});


/**
 * Permet de soumettre les infos saisies pour un agent
 * */
function creerAgent() {
    const form = document.querySelector('#agent-form');
    const formData = new FormData(form);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    formData.append('_token', csrfToken);

    console.log(formData)

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        fetch('/agents.create', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: data.message,
                    showConfirmButton: !1,
                    timer: 1500,
                });
                form.reset();
            })
            .catch(error => {
                console.error('Une erreur s\'est produite:', error);
            });
    });
}

