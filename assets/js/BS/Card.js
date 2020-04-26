function getCreateBSCard({ title,body,footer,color,outline,maximize,remove,collapse,attrs }) {
    let classes = _.concat(['card'],color ? ['card-'+color]:[],outline ? ['card-outline']:[]).join(' ');
    let tools = Object.assign({},maximize?{maximize:'expand'}:{},remove?{remove:'minus'}:{}), isTools = !!_.keys(tools).length;
    collapse = collapse ? 'CLPS' + Math.random().toString().substr(2) : false;
    return $('<div>',Object.assign({},attrs,{ class:classes })).html(_.concat(
        [$('<div>',{ class:'card-header' }).html(_.concat([],getCreateBSCardTitle(title,collapse),isTools ? getCreateBSCardTools(tools) : []))],
        collapse ? [getCreateBSCardCollapse(collapse,body)] : [getCreateBSCardBody(body)],
        footer ? [getCreateBSCardFooter(footer)] : [],
    ))
}
function getCreateBSCardTitle(title,href){ return $('<h4>',{ class:'card-title' }).html(href ? $('<a>',{ 'data-toggle':'collapse',href:'#'+href }).html(title) : title); }
function getCreateBSCardBody(html){ return $('<div>',{ class:'card-body' }).html(html); }
function getCreateBSCardFooter(html){ return $('<div>',{ class:'card-footer' }).html(html); }
function getCreateBSCardCollapse(id,html){ return $('<div>',{ class:'panel-collapse collapse',id }).html(getCreateBSCardBody(html)); }
function getCreateBSCardTools(tools){ return $('<div>',{ class:'card-tools' }).html(_.map(tools,(icon,name) => $('<button>',{ type:'button',class:'btn btn-tool','data-card-widget':name }).html($('<i>',{ class:'fas fas-'.icon })))); }
