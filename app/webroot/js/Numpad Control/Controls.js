/********************************************************************************
* Numpad control by Sebastien Vanryckeghem (http://saezndaree.wordpress.com/)
* Copyright © 2008 Sebastien Vanryckeghem
*
* THIS SOFTWARE IS PROVIDED "AS IS" AND WITHOUT ANY EXPRESS OR 
* IMPLIED WARRANTIES, INCLUDING, WITHOUT LIMITATION, THE IMPLIED 
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR 
* PURPOSE.
********************************************************************************/

// ---------------------------------------------------------------------
// Provides information about an object's coordinates on screen.
// ---------------------------------------------------------------------
var PositionInfo = function (elm)
{
    var p_elm = elm;  

    var Get = function (obj)
    {
        if(typeof(obj) == "object")
        {
            return obj;
        }
        else
        {
            return document.getElementById(obj);
        }
    }

    var Left = function ()
    {
        var x = 0;
        var elm = Get(p_elm);
        while (elm != null)
        {
            x+= elm.offsetLeft;
            elm = elm.offsetParent;
        }
        return parseInt(x);
    }

    var Width = function ()
    {
        var elm = Get(p_elm);
        return parseInt(elm.offsetWidth);
    }

    var Right = function ()
    {
        return Left(p_elm) + Width(p_elm);
    }

    var Top = function ()
    {
        var y = 0;
        var elm = Get(p_elm);
        while (elm != null)
        {
            y+= elm.offsetTop;
            elm = elm.offsetParent;
        }
        return parseInt(y);
    }

    var Height = function ()
    {
        var elm = Get(p_elm);
        return parseInt(elm.offsetHeight);
    }

    var Bottom = function ()
    {
        return Top(p_elm) + Height(p_elm);
    }

    return {
        Top: Top,
        Right: Right,
        Bottom: Bottom,
        Left: Left,
        Width: Width,
        Height: Height
    };
}

// ---------------------------------------------------------------------
// A virtual numpad that can be attached to a text box, and
// allows entering numbers without having to use the keyboard.
// ---------------------------------------------------------------------
var NumpadControl = function ()
{
    // Create the container
    var div = null;  
    var button = null; 
    var target = null;
    var iframe = document.createElement("iframe");
    
    // Show the control and position it below the target text box.
    var Show = function (control)
    {
        div.style.display = "block";
        iframe.style.display = "block";        
        target = control;        
        var info = null;
        
        // Move the numpad below the target control.        
        info = new PositionInfo(control);
        div.style.top = info.Bottom() + "px";
        div.style.left = info.Left() + "px";
        
        // Move the IFRAME behind the numpad.
        info = new PositionInfo(div);      
        iframe.style.top = info.Top();
        iframe.style.left = info.Left();
        iframe.style.width = info.Width() + "px";
        iframe.style.height = info.Height() + "px";
    } 
    
    // Hide the control    
    var Hide = function ()
    {
        div.style.display = "none";
        iframe.style.display = "none";
    }
    
    // Attach the Numpad control to the page.
    // Create the HTML elements and bind events    
    var Initialize = function ()
    {
        div = document.createElement("div");
        div.style.position = "absolute";
        div.style.zIndex = 999999;
        // div.style.backgroundColor = "#ccc";        
    
        for(var i=1; i<=9; i++)
        {
            button = document.createElement("input");
            button.type = "button";
            button.value = i;
            button.style.width = "30px";
            button.style.height = "30px";
            
            button.onclick = (function (value)
            {
                return function ()
                {
                    target.value += value;
                }          
            })(i);
            
            div.appendChild(button);
        }
        
        // Clear button     
        button = document.createElement("input");
        button.type = "button";
        button.value = "C";
        button.style.width = "30px";
        button.style.height = "30px";
        div.appendChild(button);   
        
        button.onclick = function ()
        {
            target.value = "";        
        }
        
        // 0 button        
        button = document.createElement("input");
        button.type = "button";
        button.value = "0";
        button.style.width = "30px";
        button.style.height = "30px";
        div.appendChild(button);
        
        button.onclick = (function (value)
        {
            return function ()
            {
                target.value += value;
            }          
        })(0);
        
        // Close button
        button = document.createElement("input");
        button.type = "button";
        button.value = "V";
        button.style.width = "30px";
        button.style.height = "30px";
        div.appendChild(button);
        
        button.onclick = function ()
        {
            Hide();        
        }     
        
        div.style.width = "90px"; 
        iframe.style.position = "absolute";
        iframe.frameBorder = 0;
                
        document.body.appendChild(iframe);
        document.body.appendChild(div);
        
        Hide();        
    }
    
    // Call the initialize function to generate the control.    
    Initialize();
    
    // Return the contro object.    
    return {
        Show: Show,
        Hide: Hide
    };
}