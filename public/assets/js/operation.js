$('#transInterBtn').on('click', (e) => {
    Swal.fire({
        title: "Information",
        text: "Vous allez transferer de l'argent vers ce compte",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: 'Confirmez',
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            $("#transForm").submit();
        }
    });
})

$('#transExtBtn').on('click', (e) => {
    Swal.fire({
        title: "Information",
        text: "Vous allez transferer de l'argent vers ce compte",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: 'Confirmez',
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            $("#transExtForm").submit();
        }
    });
})

$('#ribBtn').on('click', (e) => {
    Swal.fire({
        title: "Information",
        text: "Confirmez votre choix s'il vous plait",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: 'Confirmez',
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            $("#ribForm").submit();
        }
    });
})