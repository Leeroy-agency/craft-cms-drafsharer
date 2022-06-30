"use strict";

let draftSharerModal = document.getElementById('draft-sharer-modal');
let draftSharerBtn = document.getElementById('draft-sharer-button');
let draftSharerCopyBtn = document.getElementById('draft-sharer-link-btn');

if (draftSharerModal) {
    let modal = new Garnish.Modal(draftSharerModal);
    modal.hide();
    draftSharerModal.classList.remove('hidden');

    draftSharerBtn.addEventListener('click', function() {
        // Add the link into the popup
        $.post('/', {
                'action': 'draft-sharer/share/draft-sharer-link',
                'entryId': draftSharerBtn.dataset['id'],
                'draftId': draftSharerBtn.dataset['draftId'],
                'siteId': draftSharerBtn.dataset['siteId'],
                'CRAFT_CSRF_TOKEN': draftSharerBtn.dataset['csrf']
            }, function(response) {
                document.getElementById('draft-sharer-link').value = response;
                // Then show the modal
                modal.show();
            }
        );
    });

    draftSharerCopyBtn.addEventListener('click', function() {
        navigator.clipboard.writeText(document.getElementById('draft-sharer-link').value);
    });


}
