
function loadApiFile (code){
    let script = createScriptTag(code);
    console.log('SCRIPT LENGTH',script.length);
    if(!script.length) appendScript(script);
}

function createScriptTag(name){
    return $('<script>').attr('name',name).attr('src',ASSET_PATH + name).attr('type','text/javascript');
}

function appendScript(script) {
    script.appendTo($('head'));
}
