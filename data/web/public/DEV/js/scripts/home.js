import { updateURLParameter } from "../modules/editURL";

class HomePage {
    constructor() {
        this._init();
        this.ButtonActions();
    }

    _init() {
        const errorBox = $('#errorBox');
        const errorModal = new mdb.Modal(errorBox);

        const simpleBox = $('#simpleBox');
        const simpleModal = new mdb.Modal(simpleBox);

        const urlString = window.location.search
        const urlParams = new URLSearchParams(urlString);

        const myModalEl = document.getElementById('simpleBox')
        myModalEl.addEventListener('hidden.mdb.modal', (event) => {
            let newhref = updateURLParameter(window.location.href, 'modalBox', 'false');
            window.history.pushState("", "", newhref)
        })

        if (urlParams.get('error') != undefined && urlParams.get('error').length > 0) {
            errorBox.find('.bodytext').text(urlParams.get('error'));
            errorModal.show();
        }

        if (urlParams.get('modalBox') != undefined && urlParams.get('modalBox') != 'false') {
            simpleBox.find('.bodytext').text(urlParams.get('modalTitle'));
            simpleModal.show();
        }

        window.$ = $

        $("<style>")
            .prop("type", "text/css")
            .html("body, .card { transition: background-color 1.2s ease; }")
            .appendTo("head");
    }

    ButtonActions() {

        $('#userInfo-expand').click(() => {

        })
    }
}

export default HomePage;