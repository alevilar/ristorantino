/********************************************************************************
* Numpad control by Sebastien Vanryckeghem (http://saezndaree.wordpress.com/)
* Modificaco por AlejandroVilar
* 2009 Alevilar Copyleft
*
* THIS SOFTWARE IS PROVIDED "AS IS" AND WITHOUT ANY EXPRESS OR 
* IMPLIED WARRANTIES, INCLUDING, WITHOUT LIMITATION, THE IMPLIED 
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR 
* PURPOSE.
********************************************************************************/

var NumpadControl = Class.create();

// ---------------------------------------------------------------------
// A virtual numpad that can be attached to a text box, and
// allows entering numbers without having to use the keyboard.
// ---------------------------------------------------------------------

NumpadControl.prototype={
		
		
		// Attach the Numpad control to the page.
	    // Create the HTML elements and bind events   
		/**
		 * @params string: emenent_container es el mnombre del contenedor donde yo voy a ahacer el appendChild del numPad, o sea, es donde o voy a querer que se muestre el pad
		 */
	  initialize: function(element_container) {
			
	
			//es el ID el elemento que contendrá al numPPad, por lo general es un div, por lo tanto sera algo asi <div id="xxxthis.element_idxxx"></div>
		    this.element_id = "numPad";
		    
		    
		    //este es el tamaño del boton del Pad numerico
		    this.button_heigth = "50px";
		    this.button_width = "50px";
			
	
			// Create the container
		    this.div = new Element("div",{'id': this.element_id});
		    this.button = null; 
		    this.target = null;
		    this.iframe = document.createElement("iframe");
		    
		    //@ variable global
		    numPad;
		    
		    // crear botones del 1 al 9
	        for(var i=1; i<=9; i++)
	        {
	        	this.button = document.createElement("input");
	        	this.button.type = "button";
	        	this.button.value = i;
	        	this.button.style.width = this.button_width;
	        	this.button.style.height = this.button_heigth;
	            
	        	this.button.onclick = (function (value)
	            {
	                return function ()
	                {
	                	numPad.target.value += value;
	                }          
	            })(i);
	            
	        	this.div.appendChild(this.button);
	        }
	        
	        // crear "Clear" button     
	        this.button = document.createElement("input");
	        this.button.type = "button";
	        this.button.value = "C";
	        this.button.style.width = this.button_width;
	        this.button.style.height = this.button_heigth;
	        this.div.appendChild(this.button);   
	        
	        this.button.onclick = function ()
	        {
	        	numPad.target.value = "";        
	        }
	        
	        // crear "0" button        
	        this.button = document.createElement("input");
	        this.button.type = "button";
	        this.button.value = "0";
	        this.button.style.width = this.button_width;
	        this.button.style.height = this.button_heigth;
	        this.div.appendChild(this.button);
	        
	        this.button.onclick = (function (value)
	        {
	            return function ()
	            {
	            	numPad.target.value += value;
	            }          
	        })(0);
	        
	        // crear "Close" button
	        this.button = document.createElement("input");
	        this.button.type = "button";
	        this.button.value = "X";
	        this.button.style.width = this.button_width;
	        this.button.style.height = this.button_heigth;
	        this.div.appendChild(this.button);
	        
	        this.button.onclick = function ()
	        {
	            this.hide();        
	        }     
	        
	        this.div.style.width = "160px"; 
	        this.iframe.style.position = "absolute";
	        this.iframe.frameBorder = 0;
	                
	        document.body.appendChild(this.iframe);
	        document.body.appendChild(this.div);
	        
	        console.debug(this.div);
	        this.hide();
	        $(element_container).appendChild(this.div);
	  },	  
		
    
    
    // Show the control and position it below the target text box.
	  //@param control es el INPUT, se le pasa el elemento input al cual yo voy a bindear el numpad
    show : function (control) 
    {
		this.div.style.display = "block";
		this.iframe.style.display = "block";        
		this.target = control; 
		this.target.focus();
		
		
        var info = null;
    }, 
    
    // Hide the control    
    hide : function ()
    {
    	this.div.style.display = "none";
    	this.iframe.style.display = "none";
    }
    
};