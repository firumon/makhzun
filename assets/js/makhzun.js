
function loadApiFile (code,file){
    if(!file.includes('.')) file += '.js';
    let script = createScriptTag(code,file);
    if(!$('script[name="'+code+'"]',$('head')).length) appendScript(script);
}

function createScriptTag(name,file){
    return $('<script>').attr('name',name).attr('src',ASSET_PATH_JS +'/API/'+ file).attr('type','text/javascript');
}

function appendScript(script) {
    script.appendTo($('head'));
}

function fetchApi(code){
    $.getJSON(API_ROOT + code,function(r){
        if(typeof window[code] === 'function') window[code].call(this,r);
    })
}

function fetchModel(model,id,callback) {
    let url = `${API_ROOT}model/${model}/fetch/${id}`;
    $.getJSON(url,callback)
}

function modalOverlay(status) {
    let mOverlay = $('.modal-overlay',MODAL);
    status = (status === undefined) ? (!mOverlay.length) : !!status;
    if(!status) return mOverlay.remove();
    let overlay = $('<div>').addClass('overlay d-flex justify-content-center align-items-center modal-overlay').html('<i class="fas fa-2x fa-sync fa-spin"></i>');
    $('.modal-content',MODAL).prepend(overlay);
}

function fetchOptions(name,type,d0,d1,value){
    let url = API_OPTIONS_FETCH.replace(`--type--`,type).replace(`--d0--`,d0).replace(`--d1--`,d1), order = ['option','checkbox','radio'].includes(type);
    $.getJSON(url,function(data){
        if(!data.status || data.count <= 0) return; console.log(data.options);
        if($(`[name='${name}']`).length) {
            let select = $(`select[name='${name}']:eq(0)`).empty();
            $.each(data.options,function(id,label){ let oVal = id.toString().substr(order ? 1 : 0); select.append(createOption(label,oVal,value == oVal)) });
            select.select2();
        } else {
            let div = $(`div.${name}_options:eq(0)`).empty(), type = div.data('options-type');
            $.each(data.options,function(id,label){ let oVal = id.toString().substr(order ? 1 : 0); div.append(createCustomInput(name,type,label,oVal,value == oVal)) });
        }
    })
}

function createOption(label,value,selected){
    return $('<option>').attr({value,selected}).text(label);
}

function createCustomInput(name,type,label,id,checked){
    let value = id; id = `${name}_${value}`; name = name + (type === 'checkbox' ? '[]' : '');
    return $('<div>').addClass(`custom-control custom-${type}`).html([
        $('<input>').attr({ type,id,name,value,checked }).addClass('custom-control-input'),
        $('<label>').attr({ for:id }).addClass('custom-control-label').text(label)
    ]);
}
