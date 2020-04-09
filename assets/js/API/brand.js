function updateBrand(id) {
    MODAL.modal('show'); modalOverlay(true);
    let criteria = { _record_id:'id',option:'option',order:'order',status:'status' };
    fetchModel('Option',id,function(r){
        for (let x in criteria) $(`[name="${x}"]`,MODAL).val(r[criteria[x]]);
        modalOverlay(false);
    })
}

function doUpdateBrand() {
    $('[name="update-brand-form"]').submit();
}
