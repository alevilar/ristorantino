 <div data-role="panel" data-id="menu" data-hash="crumbs" data-context="a#default"> 
      <!-- Start of first page --> 
      <div data-role="page" id="main"> 
 
        <div data-role="header" data-backbtn="false" > 
          <h1>Main</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <ul data-role="listview" data-theme="g"> 
            <li>About
              <ul> 
                <li><a href="#aboutus" data-panel="main">About Us</a></li> 
                <li><a href="#aboutsv" data-panel="main">About Splitview</a></li> 
              </ul> 
            </li> 
            <li>Features
              <ul> 
                  <li><a href="#panels" data-panel="main">Panels</a></li> 
                  <li><a href="#orientation" data-panel="main">Orientation</a></li> 
                  <li><a href="#scroll" data-panel="main">Scroll</a></li> 
                  <li><a href="#context" data-panel="main">Context Loading</a></li> 
              </ul> 
            </li> 
            <li><a href="#credits" data-panel="main">Credits</a></li> 
            <li><a href="#source" data-panel="main">Source@Github</a></li> 
          </ul> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
 
 
      <!-- Start of 2nd page --> 
      <div data-role="page" id="demo"> 
 
        <div data-role="header" data-backbtn="false"> 
          <h1>Demos</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <ul data-role="listview" data-theme="g"> 
            <li><a href="#bar" data-panel="main" id="default">Bar</a></li> 
            <li><a href="#badz" data-panel="main">badz</a></li> 
            <li>First level list
              <ul> 
                <li>Second level list
                  <ul> 
                    <li><a href="#bar" data-panel="main">long list test</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                    <li><a href="#badz" data-panel="main">badz</a></li> 
                  </ul> 
                </li> 
                <li><a href="#bar" data-panel="main">Bar</a></li> 
                <li><a href="#badz" data-panel="main">badz</a></li> 
              </ul> 
            </li> 
          </ul> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed"  data-id="ew-footer"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
    </div><!-- panel menu --> 
 
    <div data-role="panel" data-id="main"> 
      <!-- Start of 6th page --> 
      <div data-role="page" id="aboutsv"> 
 
        <div data-role="header"> 
          <h1>About SplitView</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>We first started to look into jQuery Mobile when had a project that needed us to build web applications that would work great on all platforms: Desktop, Tablets(iPad), and Mobile</p> 
 
          <p>Although jQuery Mobile was still in alpha 1 at that time, we felt that it provided the most in terms of what we needed. so we set ahead trying to see if we could help others who had the same interest as we did: get it to work well on the Desktop/iPad - as a SplitView</p> 
 
          <p>A few months later, around alpha 3, we finally got our first splitview to work, and thanks to support from jQuery Mobile's own core team members, Splitview for jQMobile is what it is today</p> 
 
          <p>There are still a lot of things to do, but we hope you enjoy using this plugin, and contribute back to it by reporting bugs, requesting features, and best of all, submitting your own code contributions. Thanks!</p> 
        
          <p><b>NOTE:</b> keep in mind that I added some namespacing to event handlers in jQMobile core. use the version of jQuerymobile found in the experiments/splitview/ folder of my fork.</p> 
        
 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer"  class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <!-- Start of 5th page --> 
      <div data-role="page" id="aboutus"> 
 
        <div data-role="header"> 
          <h1>About Us</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <h3>CS8</h3> 
          <p>We're a bunch of guys who love to code. Ruby on Rails, Wordpress, Drupal, and OpenERP - we love 'em all... and we'll soon be introducing our own open-source project, based on jQueryMobile, and Ruby on Rails.</p> 
 
          <p>So stay tuned, check back here often, or follow us on facebook or twitter! details below:
 
          <p><b>Twitter:</b> asyraf9</p> 
          <p><b>Facebook:</b> asyraf9</p> 
          <p><b>Website:</b> <a href="http://www.cs8.my">www.cs8.my</a></p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <!-- Start of 7th page --> 
      <div data-role="page" id="panels"> 
 
        <div data-role="header"> 
          <h1>Panels</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>In order for splitview to work, we defined two more <b>&lt;div&gt;</b> tags to enclose the pages - one called 'main', the right hand panel, and 'menu' which is the left sidebar panel</p> 
 
          <p>This provides us with a few advantages:</p> 
            
          <p>1. It allows us to define the area new pages should be loaded in. We do this by using data-panel attributes on anchor tags. example:<br/><br/> 
              <b style="padding-left:30px;">&lt;a href="some_other_page" data-panel="main"&gt;</b> 
          </p> 
          <p>2. It allows us to define if a panel's page transitions should be tracked in history or not.</p> 
              <p style="padding-left:30px;"> 
              This uses the data-hash attribute on the panels. It takes three options - 'true','false', and 'crumbs' with true as default. 
              The 'crumbs' setting changes the panel's back button into a button that points to the previous page, and disables jQMobile from tracking the panel's history
              </p> 
          <p>3. It allows us to hide and show the panel depending on screen orientation, and unobtrusively disable it when the site is viewed on mobile browsers</p> 
 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <!-- Start of 8th page --> 
      <div data-role="page" id="orientation"> 
 
        <div data-role="header"> 
          <h1>Orientation and Resize</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>Very simply put, SplitView dynamically lays out the pages based on your tablet's (iPad, etc) orientation, as well as your desktop's screen size. Try it out, resize your browser, or turn your iPad to see it in portrait and landscape modes!</p> 
 
          <p>NOTE: you may have to refresh the view if you scale the browser window down to a mobile size - less than 480px - Splitview determines upon page load if it should lay the pages out in splitview mode or mobile mode (the default jQmobile implementation)</p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <!-- Start of 9th page --> 
      <div data-role="page" id="scroll"> 
 
        <div data-role="header"> 
          <h1>Scrolling</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>Splitview detects if your device is touch enabled or not. it will then implement the proper scrolling mechanism for your device. This is possible thanks to the jQuery Mobile team's experimental momentum scroll implementation, which the team promptly pointed us to. Thanks!
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <!-- Start of 10th page --> 
      <div data-role="page" id="credits"> 
 
        <div data-role="header"> 
          <h1>Credits</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>We could not have made Splitview possible without the work of the following folks:</p> 
 
          <h3><a href="http://www.jquerymobile.com">The jQuery Mobile team</a></h3> 
          <p>For such a wonderfully well thought piece of code that allows us to plug into it. the core that makes Splitview possible. Thank you! especially to Todd Parker, who pointed us to scrollview.js and supported us the whole way.</p> 
 
          <h3>@naugtur from the Jquery Forums</h3> 
          <p>naugtur's initial work on a splitview version of jQuery Mobile helped provide the foundation for us to begin our work on this plugin. You can find his work at: <a href="http://jquerymobiledictionary.dyndns.org/dualColumn.html">http://jquerymobiledictionary.dyndns.org/dualColumn.html</a> Thanks!</p> 
 
          <h3><a href="http://www.fellowshiptech.com">The FellowshipTech Team</a></h3> 
          <p>Fellowshiptech's work on slablet provided us with the foundation to produce the CSS that worked well for a double column layout. You can find their work at: <a href="https://github.com/fellowshiptech/slablet">https://github.com/fellowshiptech/slablet</a> Thanks!</p> 
 
          <h3>Folks at <a href="http://www.cagintranet.com">Cagintranet</a></h3> 
          <p>We couldn't have done the iPad style popover without some help from the tutorial these guys provided at <a href="http://www.cagintranet.com/archive/create-an-ipad-like-dropdown-popover/">http://www.cagintranet.com/archive/create-an-ipad-like-dropdown-popover/</a> Thanks!</p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <div data-role="page" id="source"> 
 
        <div data-role="header"> 
          <h1>Source@Github</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>Get our source at our fork of jquery-mobile at github:<p> 
 
          <p style="padding-left: 30px;"><a href="https://github.com/asyraf9/jquery-mobile/">https://github.com/asyraf9/jquery-mobile/</a></p> 
 
          <p>codes and this sample html file are located in the /experiments/splitview folder. Splitview still needs work, so help us make it better by submitting bug reports, feature request and patches!</p> 
 
          <p>To report bugs (and there are still a few of them!), file an issue under our fork of jquery-mobile at github. Thanks!</p> 
        
          <p><b>NOTE:</b> keep in mind that I added some namespacing to event handlers in jQMobile core. use the version of jQuerymobile found in the experiments/compiled/ folder of my fork.</p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <div data-role="page" id="context"> 
 
        <div data-role="header"> 
          <h1>Context Loading</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>When you navigate on to some menus on the 'menu' panel, you'll find that it is more intuitive for users that the main panel also transitions to a related page. This is what we call context page loading<p> 
 
          <p>Splitview now supports this. you need to define a data-context attribute on the panel with a value of the selector of the link you'd like the main page to transition to. this link has to be inside the page that is transitioning into view in the menu panel, and it has to reference the main panel using the data-panel attribute. Example:</p> 
 
          <p style="padding-left:30px;"><b>data-context="a#default"</b></p> 
 
          <p>This will look for a link with id="default" on the newly transitioned page, and trigger a click event on it, changing the main panel to that page (<b>NOTE:</b> the link needs to refer to the main panel using the data-panel="main" attribute!)</p> 
 
          <p>To see this in action, click on the demo button at the bottom of the menu panel on the left</p> 
 
          <p>Also, you can also define a data-context attribute on a page itself - this will override any data-context attributes defined on the panels</p> 
 
          <p>There are still a few things i need to do to make sense of context for both pages, e.g. when hitting back on history, what happens etc, but they will have to wait for now :)</p> 
          
          <p><b>ANOTHER NOTE:</b> To make this happen, I made some small changes to the changePage method in jQMobile core. use the version of jQuerymobile found in the experiments/compiled/ folder of my fork. It will not break any changePage calls you've made on your own js code</p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
      <!-- Start of 3rd page --> 
      <div data-role="page" id="bar"> 
 
        <div data-role="header"> 
          <h1>Bar</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>I'm first in the source order so I'm shown as the page.</p>    
          <p><a href="#badz">Back to badz</a></p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
 
      <!-- Start of 4th page --> 
      <div data-role="page" id="badz"> 
 
        <div data-role="header"> 
          <h1>badz</h1> 
        </div><!-- /header --> 
 
        <div data-role="content"> 
          <p>I'm first in the source order so I'm shown as the page.</p> 
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque consectetur, ligula quis convallis gravida, tortor odio mattis purus, a fringilla mauris velit eu nisi. Vivamus laoreet tincidunt diam, sit amet tristique purus lobortis ac. Etiam commodo placerat elit. In aliquam dapibus felis, molestie molestie purus scelerisque sit amet. Donec vitae varius arcu. Aliquam dapibus dolor magna, nec posuere felis. Nullam in suscipit massa. Duis nec nulla nec urna sollicitudin fringilla. Proin at rutrum mi. Maecenas vitae urna ante, ac gravida tortor.</p> 
 
          <p>Vestibulum porta pretium nunc, at adipiscing tortor fringilla sit amet. Sed venenatis varius turpis, vel fringilla purus egestas in. Curabitur interdum mauris nec velit vehicula sed aliquam nulla convallis. Nulla id magna libero, sagittis fringilla metus. Suspendisse dapibus tincidunt tristique. Fusce interdum tincidunt tincidunt. Phasellus tempus fringilla augue eget tincidunt. Donec facilisis mauris ut metus eleifend eget scelerisque nulla sagittis. Ut vel elit non risus dapibus luctus. Pellentesque vel nibh tortor.</p> 
 
          <p>Fusce a nisi at dolor rutrum tristique. Donec faucibus metus vitae lorem scelerisque malesuada scelerisque enim imperdiet. Aliquam in erat orci. Ut ultrices, erat eu luctus accumsan, lorem nibh cursus purus, in laoreet nisi tellus interdum sem. Nulla fringilla molestie lectus nec hendrerit. In in mollis tortor. Nunc lectus tortor, porttitor vitae viverra non, dignissim ac ligula. In tincidunt libero id turpis gravida iaculis rhoncus dolor aliquam. Vestibulum congue massa nec nibh sagittis tempor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque quis urna arcu. Quisque feugiat ante id turpis ultrices vel imperdiet ipsum volutpat. Donec enim magna, pretium eu scelerisque ut, pretium placerat risus.</p> Sed sed lacinia ante. Aenean non quam in ipsum pharetra condimentum.
 
          <p>Donec turpis lacus, pharetra ac viverra sit amet, lobortis eu nisl. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur porttitor dignissim orci ut feugiat. Praesent quis auctor purus. Suspendisse non elit accumsan mi pellentesque laoreet. Nullam et sapien sed nibh dictum tempor sit amet ut velit. Vestibulum varius ultricies lorem sed ultricies. Vestibulum auctor velit vitae ante eleifend eget bibendum metus rutrum. Nulla facilisis luctus mi laoreet rutrum. Nunc accumsan urna at elit pellentesque ut venenatis lectus adipiscing. Ut et arcu urna. Aliquam eros leo, ultricies vel porta nec, tempor sit amet leo. Quisque imperdiet facilisis orci ut malesuada. Nunc eget elit mauris. Mauris sed felis lectus.</p> 
 
          <p>Duis purus sem, condimentum eget posuere sed, vulputate non lorem. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras risus urna, commodo quis interdum sit amet, elementum vitae lacus. Ut tempor hendrerit ante et facilisis. Vivamus elementum purus justo, ut auctor arcu. Cras varius rhoncus venenatis. Nulla dignissim velit a erat euismod pretium. In sed leo orci, et consectetur justo. Vestibulum ipsum urna, cursus in placerat in, malesuada eu odio. Nunc eget ullamcorper tortor. In commodo, turpis sed egestas egestas, dolor sem mattis nulla, eu semper lectus metus at eros. Sed cursus nisl id risus fermentum quis aliquam odio pretium. Quisque justo eros, blandit gravida tristique eget, rhoncus in magna. Integer volutpat faucibus dolor, sit amet tempor metus ornare consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc et lacus enim, sit amet consequat turpis.</p>    
          <p><a href="#foo">Back to foo</a></p> 
        </div><!-- /content --> 
 
        <div data-role="footer" data-position="fixed" data-id="ew-footer" class="ui-splitview-hidden"> 
          <div data-role="navbar"> 
            <ul> 
              <li><a href="#main" class="ui-btn-active" data-transition="slideup">Main</a></li> 
              <li><a href="#demo" data-transition="slideup">Demos</a></li> 
            </ul> 
          </div><!-- /navbar --> 
          <h2>Engineworks &copy CS8</h2> 
        </div><!-- /footer --> 
      </div><!-- /page --> 
 
 
    </div><!-- panel main --> 