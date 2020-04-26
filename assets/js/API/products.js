function PRDCOUNT(r){ $('.number','#prdcount').text(r[0]); }
function PRDSTOCKVALUE(r){ $('.number','#prdstockvalue').text(parseFloat(r[0]['value']).toFixed(2)); }
function PRDNONSTOCKCOUNT(r){ $('.number','#prdnonstockcount').text(parseFloat(r[0]['count']).toFixed(2)); }
