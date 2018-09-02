function gerarCartao(){
    let params = $('#form-card').serialize();

    
    $.ajax({
        url:'app/controllers/gen_card.php' ,
        data: params,
        type: 'POST',
        dataType: 'JSON',
        success: function(res){
            if(res.success === true){
                $('#frame-card').html(res.result);
                $('#frame-card').append("<div class='text-right'><button type='button' onclick='download()' class='btn btn-success cursorpointer'>Download</button></div>");


            }else{
                openModal('Ops... Algo deu errado :(', res.msg);
            }
            
            
        },
        error: function(res){

        }
    });
}

function download(){
    html2canvas(document.querySelector("#cartao"), {width: 600, height: 600}).then(canvas => {
        saveAs(canvas.toDataURL(), 'b-daycard.png');
    }); 
}

function saveAs(uri, filename) {

    var link = document.createElement('a');

    if (typeof link.download === 'string') {

        link.href = uri;
        link.download = filename;

        //Firefox requires the link to be in the body
        document.body.appendChild(link);

        //simulate click
        link.click();

        //remove the link when done
        document.body.removeChild(link);

    } else {

        window.open(uri);

    }
}

function openModal(title, body){
    let modal = '<div class="modal" tabindex="-1" role="dialog" id="modal">\n\
        <div class="modal-dialog" role="document">\n\
            <div class="modal-content">\n\
                <div class="modal-header">\n\
                    <h5 class="modal-title"><strong>'+title+'</strong></h5>\n\
                    <button type="button" class="close cursorpointer" data-dismiss="modal" aria-label="Close" onclick="closeModal()">\n\
                    <span aria-hidden="true">&times;</span>\n\
                    </button>\n\
                </div>\n\
                <div class="modal-body text-center">\n\
                    <p class="text-danger">'+body+'</p>\n\
                </div>\n\
                <div class="modal-footer">\n\
                    <button type="button" class="btn btn-default cursorpointer" data-dismiss="modal" onclick="closeModal()">Fechar</button>\n\
                </div>\n\
            </div>\n\
        </div>\n\
    </div>'; 

    $('#modaldiv').html(modal);
    $('#modal').toggle();

}

function closeModal(){
    $('#modal').toggle();
    $('#modaldiv').html('');
}