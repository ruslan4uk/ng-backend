var app = {
    'config': {
        'confirm': {
            'id' : '',
            'modal': '#modalGuideConfirm'
        }
    }
};

((window, document, $, app) => {

    var $doc = $(document);

    app.confirm = {
        init: () => {
            $doc.on('submit','[data-action=confirm]',function(e){
                e.preventDefault();
                $(app.config.confirm.modal).modal('show');
                app.confirm.recipient($(this).attr('data-form'));
            });

            $('#modalGuideConfirm').on('hidden.bs.modal', function (e) {
                $(this).attr('data-id','')
            })

            $doc.on('click', '[data-confirm-btn]', function(){
                let form = $(this).parents('.modal').attr('data-id');
                $('[data-form=' + form + ']')[0].submit();
                console.log($('[data-form=' + form + ']'));
            })
        },
        recipient: (bi) => {
            $(app.config.confirm.modal).attr('data-id', bi);
        }
    }

    // $(document).on('submit','[data-action=confirm]',function(e){
    //     e.preventDefault();
    //     $('#modalGuideConfirm').modal('show');

    //     let bi = this.attr('data-id');
    //     $('#modalGuideConfirm').on('show.bs.modal', function (event) {
    //         let modal = $(this);
    //         modal.attr('data-id') = bi;
    //     });
    // });


    $doc.ready(() => {

        app.confirm.init();

    });

})(window, document, $, app);

// $(app.config.confirm.modal).on('hidden.bs.modal', function (event) {
//     $(this).attr('data-id',' ');
//     console.log($(this).attr('data-id'));
// });

