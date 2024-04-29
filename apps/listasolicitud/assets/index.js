/*const tour = new Shepherd.Tour({
    useModalOverlay: true,
    defaultStepOptions: {
        cancelIcon: {
            enabled: true
        },
        classes: 'class-1 class-2',
        scrollTo: true
    }
});*/

tour.addStep({
    id: 'step-1',
    text: 'Escribe el nombre del producto para una búsqueda inteligente.',
    attachTo: {
        element: '#id_producto2',
        on: 'right'
    },
    classes: 'example-step-extra-class',
    buttons: [{
        text: 'Siguiente',
        action: tour.next
    },
    {
        text: 'Omitir',
        action: tour.cancel // Finaliza el tour al hacer clic en "Omitir"
    }
    ]
});

tour.addStep({
    id: 'step-2',
    text: 'Los resultados relacionados aparecerán en la tabla.',
    attachTo: {
        element: '#tb',
        on: 'bottom'
    },
    classes: 'example-step-extra-class',
    buttons: [{
        text: 'Siguiente',
        action: tour.next
    },
    {
        text: 'Omitir',
        action: tour.cancel // Finaliza el tour al hacer clic en "Omitir"
    }
    ]
});

// Inicia el tour
tour.start();
