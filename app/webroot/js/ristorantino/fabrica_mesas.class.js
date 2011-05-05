
var FabricaMesa = function(mesaJSON){
    this.mesa = new Mesa(mesaJSON);

    function getMesa(){
        return this.mesa;
    }
    
};
