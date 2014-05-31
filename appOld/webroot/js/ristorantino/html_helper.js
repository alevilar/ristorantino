/**
 * Html Class is a javascript helper
 * for creating url and things tha usually neds some data from PHP
 */
function HtmlHelper(baseUrl, ds){
    this.baseUrl = baseUrl;
    this.ds = ds;

    /**
     * url returns the url path to map controller action
     */
    this.url = function(controller, action, params){
        if (params === undefined) {
            params = '';
        }
        if (action === undefined) {
            action = '';
        } else {
            if (params) {
                action = action+this.ds+params;
            }
        }
        return this.baseUrl+controller+this.ds+action;
    }
}