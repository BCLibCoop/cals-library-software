// Http (A)Synchonous Agent v1.1 -- Copyright Kevin Douglas, (C) 2008 - All rights reserved.
// * see footer notes for examples of use

function Agent ( action, method, format, async ) {
  this.set_action( action ); // string 'path_to/script.php'
  this.set_method( method ); // string 'POST|GET' 
  this.set_format( format ); // string 'xml|txt|text'
  this.set_async( async );   // boolean true|false
  this.success = null; // custom handler function
  this.failure = null; // custom handler function
  this.loading = null; // custom handler function
  this.respTxt = null; // response txt property
  this.respXml = null; // respones xml property
}

Agent.prototype.set_action = function ( action ) {
  if ( typeof action == 'string' ) {
    this.action = action;
    return true;
  }
  return false;
};

Agent.prototype.set_method = function ( method ) {
  if ( /GET|POST/i.test( method ) ) {
    this.method = method.toUpperCase();
    return true;
  }
  return false;
};

Agent.prototype.set_format = function ( format ) {
  if ( /xml|txt|text/i.test( format ) ) {
    this.format = format.toLowerCase();
    return true;
  }
  return false;
};

Agent.prototype.set_async = function ( async ) {
  if ( typeof async == 'boolean' ) {
    this.async = async;
    return true;
  }
  return false;
};

Agent.prototype.set_queue = function ( queue ) {
  if ( typeof queue == 'boolean' ){
    this.queue = queue;
    return true;
  }
  return false;
};

Agent.prototype.set_success = function ( handler ) {
  if ( typeof handler == 'function' ) {
    this.success = handler;
    return true;
  }
  return false;
};

Agent.prototype.set_failure = function ( handler ) {
  if ( typeof handler == 'function' ) {
    this.failure = handler;
    return true;
  }
  return false;
};

Agent.prototype.set_loading = function ( handler ) {
  if ( typeof handler == 'function' ) {
    this.loading = handler;
    return true;
  }
  return false;
};

Agent.prototype.request = function ( request ) {
  var error = []; // handle empty value errors
  if ( !this.action ) error.push( ' no action' );
  if ( !this.method ) error.push( ' no method' );
  if ( !this.format ) error.push( ' no format' );
  if ( typeof this.async != 'boolean' ) error.push( ' no async' );
  if ( typeof request != 'string' ) error.push( ' no request' );
  if ( error.length ) {
    throw new Error( 'Agent Error:' + error ); 
  }
  if ( this.queue && this.queue_async( request ) ) {
    return true;
  }
  this.initialize();
  this.agent.open( this.method, this.action, this.async );
  if ( this.method == 'POST' ) {
    this.agent.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8' );
    //this.agent.setRequestHeader( 'Content-length', request.length );
    //this.agent.setRequestHeader( 'Connection', 'close' );
    //request = encodeURIComponent( request );
  }
  this.agent.send( request );
  if ( this.async ) { // Asynchronouse request
    var self = this;
    this.agent.onreadystatechange = function () {
      switch ( self.agent.readyState) {
        case 3: 
        case 4: self.response(); break;
        default: self.monitor();
      }
    };
  } else { // Synchronous request
    return this.response();
  }
  return true;
};

/*** END PUBLIC AGENT METHODS -- DO NOT CALL THE FOLLOWING DIRECTLY ***/

// Retry to send request after timeout ...
// Increase timeout or max_attempts if high latency
// Works to delay sending of asynchronous requests
// Ignored if synchronous due to lack of readyStates
// NOTE: native support for multiple request-threads
Agent.prototype.queue_async = function ( request ) {
  if ( this.agent != null && this.agent.readyState != 0 && this.agent.readyState != 4 ) {
    // 10 attempts * 500 timeout, works for 4 second server delay
    var max_attempts = 10;
    this.queued = ( this.queued ) ? this.queued + 1 : 1;
    if ( this.queued > max_attempts ) {
      var error = 'Request Timeout\nUnable to establish connection with server';
      if ( typeof this.failure == 'function' ) {
        this.failure( '408', error );
      }
      //window.status = error;
      return error;
    } else {
      //window.status = 'Delayed agent request action (attempt: ' + this.queued  + ')';
      var self = this;
      window.setTimeout( function () { 
        self.request( request );
      }, 500 );
      return true;
    }
  }
  //window.status = 'Done';
  this.queued = 0;
  return false;
};

// Attempt to instantiate XMLHttpRequest object
Agent.prototype.initialize = function () {
  this.agent = null;
  var xhr = [ 
    function () { return new XMLHttpRequest(); },
    function () { return new ActiveXObject('Msxml2.XMLHTTP.7.0'); },
    function () { return new ActiveXObject('Msxml2.XMLHTTP.6.0'); },
    function () { return new ActiveXObject('Msxml2.XMLHTTP.5.0'); },
    function () { return new ActiveXObject('Msxml2.XMLHTTP.4.0'); },
    function () { return new ActiveXObject('MSXML2.XMLHTTP.3.0'); },
    function () { return new ActiveXObject('MSXML2.XMLHTTP'); },
    function () { return new ActiveXObject('Microsoft.XMLHTTP'); } 
  ];
  for ( var i = 0; i < xhr.length && this.agent == null; i ++ ) {
    try {
      this.agent = xhr[i]();
    } catch ( error ) {
      // alert( error.name + " :: " + error.message );
    }
  }
  if ( this.agent == null ) {
    var message = 'Unable to initialize XMLHttpRequest object.';
    message += '\nPlease install the newest version of this browser and try again.';
    message += '\nOr, enable \"trusted ActiveX controls\" in Internet Explorer 6 and earlier.';
    throw new Error( message ); 
    return false;
  }
  return true;
};

// Routes response by status, format and synchronous type
// http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
Agent.prototype.response = function () {
  if ( this.agent.status == 200 ) {
    //alert( this.agent.getResponseHeader('Content-type') ); 
    //alert( this.agent.getAllResponseHeaders() ); 
    //alert( this.agent.statusText ); // 'OK' //
    var response = ( /text|txt/.test( this.format ) ) ? 
      this.agent.responseText : this.agent.responseXML;
    this.respTxt = this.agent.responseText;
    this.respXml = this.agent.responseXML;
    if ( typeof this.success == 'function' ) {
      this.success( response );
    } else {
      return response;
    }
  } else if ( this.agent.status != 0 ) {
    //alert( this.agent.getResponseHeader('Content-type') ); 
    //alert( this.agent.getAllResponseHeaders() ); 
    //alert( this.agent.statusText ); // 'OK' //
   
    if ( this.failure == 'function' ) {
      var status = this.agent.status;
      var message = this.agent.statusText;
      this.failure( status, message );
    } else {
    	//if (this.agent.responseText != undefined)
		//	alert( this.agent.responseText ); 
      return false;
    }
  }
  return true;
};

// Pass readyState to loading function
Agent.prototype.monitor = function () {
  if ( typeof this.loading == 'function' ) {
    this.loading( this.agent.readyState );
  }
  return true;
};


/*** EXAMPLES OF USE AND FOOT-NOTES ***

// set global agent defaults // optional //
Agent.prototype.action = 'include/php/matrix.php';
Agent.prototype.method = 'POST';
Agent.prototype.format = 'text'; // text, xml //
Agent.prototype.async = true;

// using default values //
var test = new Agent();
test.success = function ( resp ) {
  alert( resp );
}
test.failure = function ( status, message ) {
  alert( 'Error: ' + status + ' : ' + message );
}
test.loading = function ( state ) {
  switch ( state ) {
    case 1:
    alert('processing');
    break;
    case 2:
    alert('sending');
    break;
    case 3:
    alert('receiving');
  }
}
test.request('some&request&params');

// using override values; longhand //
var alt = new Agent();
alt.set_action('include/php/json.php');
alt.set_method('GET'); // GET|POST
alt.set_format('txt'); // txt|xml
alt.set_async(true);   // true|false
alt.set_success(ajax_success); // custom handler //
alt.set_failure(ajax_failure); // custom handler //
alt.set_loading(ajsx_loading); // custom handler //
alt.request('request_string');

// passing all params on initialization //
// pass a 'null' or false (0,false,'') value to use default
var too = new Agent('include/php/extra.php',null,'xml',false);
var resp = too.request('extra_request'); // Synchronouse
alert( resp.childNodes.length );

// remember that for an XML response to be populate responseXML 
// the server-side script must set the header to 'application/xml' 
// header( 'Content-type: application/xml; charset="utf-8"');

***/

