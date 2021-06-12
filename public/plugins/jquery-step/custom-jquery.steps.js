// $("#circle-basic").steps({
//     headerTag: "h3",
//     bodyTag: "section",
//     transitionEffect: "slideLeft",
//     autoFocus: true,
//     cssClass: 'circle wizard'
// });

var form = $("#open-account");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    cssClass: 'circle wizard',
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        // if(currentIndex > 1){
            
        // }
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        form.submit()
        swal({
            title: 'Terminé !',
            text: "Votre demande d'ouverture a été initié avec succès !",
            type: 'success',
            padding: '2em',
            showConfirmButton: false,
            timer: 1500
          })
    }
});