
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

function fetchApi(code,data,callback){
    callback = callback || function(r){ if(typeof window[code] === 'function') window[code].call(this,r); };
    if(typeof data === "undefined") { data = {} }
    if(typeof data === "function") { callback = data }
    $.getJSON(API_ROOT + code,data,callback);
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
    let url = API_OPTIONS_FETCH.replace(`--type--`,type).replace(`--d0--`,d0).replace(`--d1--`,d1).replace(/\/$/g,''), order = ['option','checkbox','radio'].includes(type);
    $.getJSON(url,function(data){
        if(!data.status || data.count <= 0) return;
        if($(`[name='${name}']`).length) {
            let select = $(`select[name='${name}']`).empty(); select.select2('destroy');
            _(data.options).each((label,val) => {
                val = order ? val.toString().substr(1) : val;
                let selected = (_.toString(value) === _.toString(val));
                select.append(createOption(label,val,selected));
                if(selected) select.val(val);
            });
            let valueAfter = value || $(`[name='${name}']`).attr('data-value-after') || null;
            select.val(valueAfter).select2().trigger('change');
        } else {
            let div = $(`div.${name}_options`).empty(), type = div.data('options-type');
            _(data.options).each((label,val) => {
                val = order ? val.toString().substr(1) : val;
                let checked = (_.toString(value) === _.toString(val));
                div.append(createCustomInput(name,type,label,val,checked));
            });
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

function formValues(formName,values){
    let form = $(`[name='${formName}']`);
    let avoid = ['_token','_form_code','_record_submit'];
    $(':input',form).each(function(i,Ele){
        if(_.includes(avoid,Ele.name)) return;
        let tagName = Ele.tagName.toLowerCase();
        if(tagName === 'input'){
            let type = Ele.type.toLowerCase();
            if(type === 'radio') setRadioValue(Ele,values);
            else if(type === 'checkbox') setCheckboxValue(Ele,values);
            else if(type === 'file') setFileValue(Ele,values);
            else $(Ele).val(_.get(values,Ele.name === '_record_id' ? 'id' : Ele.name));
        } else if (tagName === 'select') setSelectValue(Ele,values);
        else $(Ele).val(_.get(values,Ele.name));
    });
}

function setRadioValue(Ele,Values){
    let name = Ele.name;
    $(Ele).prop('checked',_.get(Values,name) == Ele.value);
}

function setCheckboxValue(Ele,Values){
    let name = Ele.name.substr(0,Ele.name.length-2), value = _.get(Values,name + '_field');
    if(!value || value.toString().substr(0,1) !== '[') value = '[' + value + ']';
    let valArray = _.map(eval(value),_.toString);
    $(Ele).prop('checked',_.includes(valArray,_.toString(Ele.value)));
}

function setFileValue(Ele,Values){
    let name = Ele.name, display = _.get(Values,name), value = _.get(Values,[name + '_object','id']), name_old = name + '_OLD';
    if(!display) return;
    $(Ele).parent().append($('<div>', { class:'custom-control custom-checkbox' }).html([
        $('<input>', { class:'custom-control-input',type:'checkbox',id:name_old,name:name_old,value }),
        $('<label>', { for:name_old,class:'custom-control-label' }).text('Check to remove '+display)
    ])).addClass('mb-3')
}

function setSelectValue(Ele,Values) {
    let name = Ele.name, value = _.get(Values,name + '_field');
    if($('option[value="'+value+'"]',$(Ele)).length) $(Ele).val(value).trigger('change');
    else $(Ele).attr('data-value-after',value);
}
