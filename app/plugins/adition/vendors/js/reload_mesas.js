
setInterval( getMesasAbiertas, 5000 );

var urlDomain, timeText;


self.onmessage = function(obj) {
    postMessage( obj.data );
    urlDomain = obj.data.urlDomain;
    timeText = obj.data.timeText;
}
   
function getMesasAbiertas(){
        var cntx = this;
        
        var timeText = '';
        
        var url = '';
        if (urlDomain) {
            url = urlDomain;
        }
        
        if ( timeText ) {
            url = url + 'mozos/mesas_abiertas/'+timeText+'.json'
        } else {
            url = url + 'mozos/mesas_abiertas.json';
        }
        
        if ( !cntx.ajaxSending ) {
            var xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function(data){
                
                if (data && data.mozos && data.mozos.length) {
                     postMessage(data);                        
                }
            }
            
            xhr.open('GET', url, false);
            xhr.send();
//            postMessage(sha1(xhr.responseText));

            
//
//            $.ajax({
//                url: url,
//                timeout: 93000,
//                success: function(data){
//                    if (data.mozos.length) {
//                         postMessage(data);                        
//                    }
//                },
//                error: function(){},
//                complete: function() {cntx.ajaxSending = false},
//                beforeSend: function() {cntx.ajaxSending = true}
//            });
        }
    }